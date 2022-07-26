<?php
require_once __DIR__."/../classes/DB.php";
require_once __DIR__."/../classes/Patient.php";
require_once __DIR__."/../classes/Validate.php";
use clinic\Patient;
use clinic\Validate;

$everythingOkey = true;
$messages = ['Successfully updated patient\'s info.'];

// var_dump($_POST);die();
if(!Validate::minChars(1,null,$_POST)) {
    $messages[] = "All input fields are required.";
    $everythingOkey = false;
}

if(!Validate::minChars(2,null,[$_POST['name'],$_POST['blood_type']])) {
    $messages[] = "Name and blood type must have at least 2 characters.";
    $everythingOkey = false;
}

if(!Validate::isValueNumeric($_POST['phone_number'])) {
    $messages[] = "Phone number field must contain only numbers.";
    $everythingOkey = false;
}

if(!Validate::minChars(3,$_POST['medical_condition'])) {
    $messages[] = "Medical condition must have at least 3 characters.";
    $everythingOkey = false;
}

if($everythingOkey) {
    $updatedPatient = Patient::find($_POST['id'],'object');
    $updatedPatient->update($_POST);
    
    $newlyUpdatedPatient = Patient::find($_POST['id'],'array');
    if($updatedPatient) {
        echo json_encode(['message' => $messages[0],'status' => $everythingOkey ,'updated' => $newlyUpdatedPatient]);

    } else {
        echo json_encode(['message' => 'Something went wrong with the update...']);
    }
} else {
    echo json_encode([ 'message' => $messages[1],'status' => $everythingOkey]);
}