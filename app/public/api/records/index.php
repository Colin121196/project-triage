<?php

// Step 1: Get a datase connection from our help class, db is now a connection object
$db = DbConnection::getConnection();

// Step 2: Create & run the query Prepare is an included database library
if (isset($_GET['guid'])) {
  $stmt = $db->prepare(
    'SELECT * FROM Patient
    WHERE patientGuid = ?'
  );
  $stmt->execute([$_GET['guid']]);
} else{
  $stmt = $db->prepare('SELECT * FROM Patient');
  $stmt->execute();
}
 //Runs the query, now has access to all the data that is returned
$patients = $stmt->fetchAll();  //Fetch results of the query

// patientGuid VARCHAR(64) PRIMARY KEY,
// firstName VARCHAR(64),
// lastName VARCHAR(64),
// dob DATE DEFAULT NULL,
// sexAtBirth CHAR(1) DEFAULT ''

// Step 3: Convert to JSON
$json = json_encode($patients, JSON_PRETTY_PRINT); //Take entire thing and changes it to JSON. Pretty Print is an option to print that makes it human legible

// Step 4: Output
header('Content-Type: application/json');
echo $json;
