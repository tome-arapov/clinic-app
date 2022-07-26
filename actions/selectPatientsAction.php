<?php
session_start();
if(!isset($_SESSION['email'])) {
    header("Location:../views/login.php");
    die();
}
require_once __DIR__."/../Classes/DB.php";
require_once __DIR__."/../Classes/Patient.php";

use clinic\Patient;

$patients = Patient::all();
echo json_encode(['patients' => $patients]);