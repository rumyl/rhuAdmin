<?php

class CRUD
{
    private $conn;
    
    public function __construct($connection)
    {
        $this->conn = $connection;
    }
    
    public function create($table, $data)
    {
        $fields = implode(',', array_keys($data));
        $values = "'" . implode("','", array_values($data)) . "'";
        $sql = "INSERT INTO $table ($fields) VALUES ($values)";
        
        if ($this->conn->query($sql) === TRUE) {
            return $this->conn->insert_id;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }
    }
    
    public function read($sql)
    {
        $result = $this->conn->query($sql);
    
        if ($result->num_rows > 0) {
            $records = array();
            while ($row = $result->fetch_assoc()) {
                $records[] = $row;
            }
            return $records;
        } else {
            //echo "No records found";
            return false;
        }
    }
    

    public function getSingleRow($sql)
    {
        $result = $this->conn->query($sql);
        
        if ($result->num_rows === 1) {
            return $result->fetch_assoc();
        } else {
            return false; 
        }
    }



    public function update($table, $condition, $data)
    {
        // Check if any changes are made in the data
        $changed = false;
        $existingData = $this->getSingleRow("SELECT * FROM $table WHERE $condition");
        
        if ($existingData) {
            foreach ($data as $key => $value) {
                if ($existingData[$key] !== $value) {
                    $changed = true;
                    break;
                }
            }
            
            if (!$changed) {
                return true; // No changes, no need to update
            }
        } else {
            return false; // Record not found
        }
        
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "$key = '$value',";
        }
        $set = rtrim($set, ',');

        $sql = "UPDATE $table SET $set WHERE $condition";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }
    }

    
    public function delete($table, $conditions)
    {
        $whereClause = "";
        $firstCondition = true;

        foreach ($conditions as $field => $value) {
            if (!$firstCondition) {
                $whereClause .= " AND ";
            }
            $whereClause .= "$field = '$value'";
            $firstCondition = false;
        }

        $sql = "DELETE FROM $table WHERE $whereClause";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }
    }
    

    public function delete_one($table, $field, $value)
    {
    
        $sql = "DELETE FROM $table WHERE $field = '$value'";
        
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
            return false;
        }
    }


    public function isValueUnique($table, $column, $value)
    {
        $escapedValue = $this->conn->real_escape_string($value);
        $sql = "SELECT COUNT(*) AS count FROM $table WHERE $column = '$escapedValue'";
        $result = $this->conn->query($sql);

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();
            return intval($row['count']) === 0; // Return true if count is 0 (value is unique)
        } else {
            // Error occurred or no result returned
            return false;
        }
    }

    
    public function areValuesUnique($table, $conditions)
    {
        // Build the WHERE clause with column-value pairs
        $whereClause = '';
        foreach ($conditions as $column => $value) {
            $escapedValue = $this->conn->real_escape_string($value);
            $whereClause .= "AND $column  = '$escapedValue' ";
        }
        $whereClause = 'WHERE ' . ltrim($whereClause, 'AND ');

        // Construct the SQL query
        $sql = "SELECT COUNT(*) AS count FROM $table $whereClause";

        $result = $this->conn->query($sql);

        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();
            return intval($row['count']) === 0; 
        } else {

            return false;
        }
    }
    
    

    public function calculateAge($birthdate) {
        $birthdate = new DateTime($birthdate);
        $currentDate = new DateTime();
        $age = $currentDate->diff($birthdate);
        $years = $age->y; 
        $months = $age->m; 
        return "$years years and $months months";
    }


    public function dateToWords($date) {
        // Convert the date to a timestamp
        $timestamp = strtotime($date);
        
        // Format the date using strftime
        $formattedDate = strftime('%B %d, %Y', $timestamp);
    
        return $formattedDate;
    }

    public function timeToWords($date) {
        // Convert the date to a timestamp
        $timestamp = strtotime($date);
        
        // Format the time using strftime
        $formattedTime = strftime('%I:%M %p', $timestamp);
    
        return $formattedTime;
    }
    

    public function displayRelativeDate($date) {
        $now = time();
        $dateTimestamp = strtotime($date);
        
        $difference = $now - $dateTimestamp;
        $secondsInMinute = 60;
        $secondsInHour = 3600;
        $secondsInDay = 86400;
        $secondsInMonth = 2592000; // Average month length in seconds (30 days)
        $secondsInYear = 31536000; // Average year length in seconds (365 days)
    
        if ($difference < $secondsInMinute) {
            return 'Just now';
        } elseif ($difference < $secondsInHour) {
            $minutes = floor($difference / $secondsInMinute);
            return $minutes == 1 ? '1 minute ago' : "$minutes minutes ago";
        } elseif ($difference < $secondsInDay) {
            $hours = floor($difference / $secondsInHour);
            return $hours == 1 ? '1 hour ago' : "$hours hours ago";
        } elseif ($difference < $secondsInMonth) {
            $days = floor($difference / $secondsInDay);
            return $days == 1 ? 'Yesterday' : "$days days ago";
        } elseif ($difference < $secondsInYear) {
            $months = floor($difference / $secondsInMonth);
            return $months == 1 ? '1 month ago' : "$months months ago";
        } else {
            $years = floor($difference / $secondsInYear);
            return $years == 1 ? '1 year ago' : "$years years ago";
        }
    }

    function getMonthName($monthNumber) {
        $monthNames = [
            1 => 'January', 2 => 'February', 3 => 'March',
            4 => 'April', 5 => 'May', 6 => 'June',
            7 => 'July', 8 => 'August', 9 => 'September',
            10 => 'October', 11 => 'November', 12 => 'December'
        ];
    
        // Check if the provided month number is valid
        if ($monthNumber >= 1 && $monthNumber <= 12) {
            return $monthNames[$monthNumber];
        } else {
            return 'Please choose what month';
        }
    }


}

