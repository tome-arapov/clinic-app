<?php
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("Location:../views/dashboard.php");
    die();
}
require_once __DIR__."/../Classes/DB.php";
require_once __DIR__."/../Classes/Validate.php";

require_once __DIR__."/../Classes/Patient.php";

use clinic\Patient;

$patient = Patient::findByVal('clinic_id',$_POST['clinic_id']);
echo json_encode($patient);