<?php

include './queryAll.php';

$category = $_POST['category'];

$dataOutPut = UserSignUp($fullname, $email, $createon, $location, $ipaddress, $signuplocation, $encrypted, $contactNumber);
echo json_encode($dataOutPut);
