<?php
// database connection
include './local_resources/connections/database.php';
// including the header
require_once './local_resources/components/header.php';

//starting session
session_start();

//get the candidate name
$canName=$_GET["candidateName"];

// connect database
databaseConnection();

// get the selected candidate details
$candidateArray=candidateConnection($canName);



?>




















<?php require_once './local_resources/components/footer.php';?>
