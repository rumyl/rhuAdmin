<?php

class Token
{
    private $tokenName = 'csrf_token';
    private $token;

    public function __construct()
    {
        $this->generateToken();
    }

    private function generateToken()
    {
        if (!isset($_SESSION[$this->tokenName])) {
            $randomBytes = random_bytes(32); // Generating 32 random bytes
            $this->token = bin2hex($randomBytes); // Converting bytes to hexadecimal format
            $_SESSION[$this->tokenName] = $this->token;
        } else {
            $this->token = $_SESSION[$this->tokenName];
        }
    }

    public function getToken()
    {
        return $this->token;
    }

    public function checkToken($otherToken)
    {
        return strcasecmp($this->token, $otherToken) === 0;
    }
}
