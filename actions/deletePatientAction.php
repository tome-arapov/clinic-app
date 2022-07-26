<?php
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("Location:../views/dashboard.php");
    die();
}
require_once __DIR__."/../classes/DB.php";
require_once __DIR__."/../classes/Patient.php";
use clinic\Patient;

$selectedPatient = Patient::findById($_POST['patient_id'],'object');
$res = $selectedPatient->delete();

if($res) {
    echo 200;
} else {
    echo 500;
}