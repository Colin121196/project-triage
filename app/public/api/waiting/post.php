<?php

// Step 0: Validate Data

// Step 1: Get a database connection from our help class
$db = DbConnection:: getConnection();

// Step 2: Prepare & Run Query
$stmt = $db->prepare(
  'INSERT INTO PatientVisit
  (patientGuid, visitDescription, priority)
  VALUES (?,?,?)' //These are parameterized queries so they are protected from SQL injection. Lines 16-18 are also done to protect from this
);

$stmt = execute([
  $_POST['patientGuid'],
  $_POST['visitDescription'],
  $_POST['priority']
]);

// Step 4: Output
header('HTTP/1.1 303 See Other'); //The 303 status code means redirect/send somewhere else with a GET.
header('Location: ../waiting/');  //Here is where you need to go