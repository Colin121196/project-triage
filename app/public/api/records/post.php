<?php
use Ramsey\Uuid\Uuid;

// Step 0: Validate Data

// Step 1: Get a database connection from our help class
$db = DbConnection:: getConnection();

// Step 2: Prepare & Run Query
$stmt = $db->prepare(
  'INSERT INTO Patient
  (patientGuid, firstName, lastName, dob, sexAtBirth)
  VALUES (?,?,?,?,?)' //These are parameterized queries so they are protected from SQL injection. Lines 16-18 are also done to protect from this. Put in the # of columns you have
);


$guid = Uuid::uuid4()->toString();

$stmt = execute([
  $guid,  // i.e. 25769c6c-d34d-4bfe-ba98-e0ee856f3e7a
  $_POST['patientGuid'],
  $_POST['firstName'],
  $_POST['lastName'],
  $_POST['dob'],
  $_POST['sexAtBirth']
]);

// Step 4: Output
header('HTTP/1.1 303 See Other'); //The 303 status code means redirect/send somewhere else with a GET.
header('Location: ../records/?guid='.$guid);  //Here is where you need to go. Get me 1 of the records, not all of the records
