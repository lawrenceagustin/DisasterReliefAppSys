<?php

require_once 'dbConfig.php';

function getAllUsers($pdo) {
	$sql = "SELECT * FROM applicant_data 
			ORDER BY first_name ASC";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getUserByID($pdo, $id) {
	$sql = "SELECT * from applicant_data WHERE id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function searchForAUser($pdo, $searchQuery) {
	
	$sql = "SELECT * FROM applicant_data WHERE 
			CONCAT(first_name,last_name,nationality,age,gender,email,
				contact_no,home_address,position,location_pref,date_added) 
			LIKE ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute(["%".$searchQuery."%"]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function insertNewUser($pdo, $first_name, $last_name, $nationality, 
	$age, $gender, $email, $contact_no, $home_address, $position, $location_pref) {

	$sql = "INSERT INTO applicant_data 
			(
				first_name,
				last_name,
				nationality,
				age,
				gender,
				email,
				contact_no,
				home_address,
        position,
        location_pref
			)
			VALUES (?,?,?,?,?,?,?,?,?,?)
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([
		$first_name, $last_name, $nationality, 
	  $age, $gender, $email, $contact_no, 
    $home_address, $position, $location_pref
	]);

	if ($executeQuery) {
		return true;
	}
}

function editUser($pdo, $first_name, $last_name, $nationality, 
$age, $gender, $email, $contact_no, $home_address, $position, $location_pref, $id) {

	$sql = "UPDATE applicant_data
				      SET first_name = ?,
				          last_name = ?,
				          nationality = ?,
				          age = ?,
				          gender = ?,
				          email = ?,
				          contact_no = ?,
				          home_address = ?,
                  position = ?,
                  location_pref = ?
				      WHERE id = ? 
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, $nationality, 
  $age, $gender, $email, $contact_no, $home_address, $position, $location_pref, $id]);

	if ($executeQuery) {
		return true;
	}
}


function deleteUser($pdo, $id) {
	$sql = "DELETE FROM applicant_data 
			WHERE id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$id]);

	if ($executeQuery) {
		return true;
	}
}

?>