<?php
require_once __DIR__."/../classes/DB.php";
require_once __DIR__."/../classes/Patient.php";
use clinic\Patient;

$editPatientInfo = Patient::findById($_GET['patient_id'],'array');
echo json_encode($editPatientInfo);