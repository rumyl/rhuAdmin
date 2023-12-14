<?php
$init_configs = parse_ini_file("APPS.ini");
 require_once $_SERVER['DOCUMENT_ROOT'] . '/' . $init_configs['SITE_FOLDER'] . '/core/init.php';

$req_date = $_GET['req_date'];
$res_id = $_GET['res_id'];
$info = DB::select("*","tbl_residents","id='$res_id'");


$html ='';
$html .='
<style>

		@page *{
		    margin-top: 2.54cm;
		    margin-bottom: 2.54cm;
		    margin-left: 2.54cmcm;
		    margin-right: 2.54cmcm;
		}



        table {
            border-collapse: collapse;
            width:100%;
        }
        td {
            padding: 5px;
        }
        th {
            text-align: left;
        }
</style>

    <table>
        <tr>
            <td style="width:45%;border-top:1 solid black;border-left:1 solid black;border-right:1 solid black;text-align:center;">
					<img src="logo.png" width="90px" height="80px">

					<br><br>
					<span style="font-size:12pt;">
		            <b>MARIBETH V. CUAL</b>
					</span>
					<br>
					<span style="font-size:10pt;">
		            Punong Barangay
					</span>

            </td>
            <td style="width:55%;border-top:1 solid black;border-right:1 solid black;text-align:center;">
		            <br>
		            <span style="font-size:10pt;">
		            Republic of the Philippines<br>
					Province of Aklan<br>
					Municipality of Kalibo<br>
					<b>Barangay Bakhaw Norte</b>
					</span>

					<br><br>
					<span style="font-size:12pt;">
		            <b>OFFICE OF THE PUNONG BARANGAY</b>
					</span>
					<br><br><br>
					<span style="font-size:14pt;">
		            <b>BARANGAY CLEARANCE</b>
					</span>

			</td>
        </tr>
        <tr>
        	<td style="text-align:center;border-left:1 solid black;border-right:1 solid black;">
					<span style="font-size:10pt;">
		            <b>Sangguniang Barangay Members:</b>
					</span>
        	</td>
        	<td style="border-right:1 solid black;text-align:left;">
        			<br><br>
					<span style="font-size:10pt;text-align:left;">
		            <b>TO WHOM IT MAY CONCERN:</b>
					</span>
        	</td>
        </tr>
 		<tr>
        	<td style="text-align:center;border-left:1 solid black;border-right:1 solid black;">
					<p style="font-size:9pt;">
		            <b>
		            DUVILL V. DURAN		<br><br>
		            RICKY R. BULOS		<br><br>
					HELEN M. CASTILLO	<br><br>
					FREDDIE I. ANDRADE	<br><br>
					LILIBETH S. RANIGO	<br><br>
					ALDIE Y. PALIO		<br><br>
					NELLY A. ROLDAN		<br><br><br><br><br><br><br><br>
        	</td>


        	<td style="border-right:1 solid black;text-align:justify;line-height:1.6;padding:5px;">
					<p style="font-size:10pt;">
		             <i>
		             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		             This is to certify that according to our records in this barangay, <b>'.$info['fname'].' '.$info['mname'].' '.$info['lname'].'</b>, '.$info['sex'].', of legal age, '.$info['status'].', Filipino and duly resident of Barangay Bakhaw Norte, Kalibo, Aklan is personally known to me as law abiding citizen in our locality with no derogatory records or pending cases whatsoever as far as existing records of this office is concerned.
					</i>
					<br><br>
					<i>
		             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		             Issuance of which is upon request of the above-named person for whatever legal intent that it may serve her best.
					</i>
					<br><br>
					<i>
		             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		             Given this '.date("jS \of F, Y",strtotime($req_date)).' at Barangay Bakhaw Norte, Kalibo, Aklan, Philippines.
					</i>
					</p>
        	</td>
        </tr>

 		<tr>
        	<td style="text-align:center;border-left:1 solid black;border-right:1 solid black;border-bottom:1 solid black;">
        			<span style="font-size:9pt;">
        			<b>
        			JEONARD D. PRADO<br>
					</b>
					SK Chairperson		<br><br><br>
					<b>JULIE ANN B. FOJAS<br></b>
					Barangay Secretary	<br><br><br>

					<b>DELIA I. ALBERTO</b><br>
					Barangay    Treasurer<br><br><br><br><br><br>
        	</td>
        	<td style="border-right:1 solid black;border-bottom:1 solid black;text-align:right;">
 
					<br><br><br>
		            <b>MARIBETH V. CUAL&nbsp;&nbsp;</b><br>
					Punong Barangay&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<br><br><br><br><br><br><br>
					<br><br><br><br><br><br><br>
        	</td>
        </tr>
    </table>';


echo $html;
//$mpdf->WriteHTML($html);
//$mpdf->Output();
?>
