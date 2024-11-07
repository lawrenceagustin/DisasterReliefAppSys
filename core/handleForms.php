<?php  

require_once 'dbConfig.php';
require_once 'models.php';


if (isset($_POST['insertUserBtn'])) {
	$insertUser = insertNewUser($pdo,$_POST['first_name'], $_POST['last_name'], $_POST['nationality'], $_POST['age'], $_POST['gender'],
                                    $_POST['email'], $_POST['contact_no'], $_POST['home_address'], $_POST['position'], $_POST['location_pref']);

	if ($insertUser) {
		$_SESSION['message'] = "Successfully inserted!";
		header("Location: ../index.php");
	}
}


if (isset($_POST['editUserBtn'])) {
	$editUser = editUser($pdo,$_POST['first_name'], $_POST['last_name'], $_POST['nationality'], $_POST['age'], $_POST['gender'],
                             $_POST['email'], $_POST['contact_no'], $_POST['home_address'], $_POST['position'], $_POST['location_pref'], $_GET['id']);

	if ($editUser) {
		$_SESSION['message'] = "Successfully edited!";
		header("Location: ../index.php");
	}
}

if (isset($_POST['deleteUserBtn'])) {
	$deleteUser = deleteUser($pdo,$_GET['id']);

	if ($deleteUser) {
		$_SESSION['message'] = "Successfully deleted!";
		header("Location: ../index.php");
	}
}

if (isset($_GET['searchBtn'])) {
	$searchForAUser = searchForAUser($pdo, $_GET['searchInput']);
	foreach ($searchForAUser as $row) {
		echo "<tr> 
          <td>{$row['first_name']}</td>
					<td>{$row['last_name']}</td>
          <td>{$row['nationality']}</td>
          <td>{$row['age']}</td>
          <td>{$row['gender']}</td>
          <td>{$row['email']}</td>
          <td>{$row['contact_no']}</td>
          <td>{$row['home_address']}</td>
          <td>{$row['position']}</td>
          <td>{$row['location_pref']}</td>
			  </tr>";
	}
}

?>