<?php
if (isset($_POST['submit'])) {
	require_once('connect.php');
	$id = $_POST['random'];
	$title = $_POST['title'];
	$author = $_POST['author'];
	$year = $_POST['year'];
	$poster = $_POST['poster'];
	$description = $_POST['description'];
	$book = $_FILES['uploadFile'];
	$category = $_POST['hiddenCatInput'];

	// echo "<pre>";
	// print_r($_POST['hiddenCatInput']);
	// echo "</pre>";

	$oldPath = $_FILES["uploadFile"]["tmp_name"];
	// $oldPath = iconv("utf-8", "cp936", $oldPath);
	$newPath = 'uploads/'.basename($_FILES["uploadFile"]["name"]);
	if (file_exists($oldPath)) {
		if (move_uploaded_file($oldPath, $newPath)){
			echo 'ok';
		}
	}
	
	// $myfile = fopen($newPath, "r") or die("Unable to open file!");
	// $orgContent = fread($myfile, filesize($newPath));
	// fclose($myfile);
	
	// $string = $orgContent;
	// function nl2br2($string) { 
	// 	$string = str_replace(array("\r\n", "\r", "\n"), "<br />", $string); 
	// 	return $string; 
	// } 

	// $myNewFile = fopen("uploads/test.html", "w");
	// fwrite($myNewFile, nl2br2($string));
	// fclose($myNewFile);

	function insertBook() {
		global $conn, $id, $title, $author, $year, $poster, $description, $newPath;
		$sql = "INSERT INTO books (id, b_title, b_author, b_year, b_poster, b_description, path_to_book) VALUES ('$id', '$title', '$author', '$year', '$poster', '$description', '$newPath')";
		if (mysqli_query($conn, $sql)) {
				echo "New record created successfully<br>";
		} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}

	$sql = "SELECT * FROM books";
	if (!mysqli_query($conn, $sql)) {
		$sql = "CREATE TABLE books (
			id VARCHAR(10) PRIMARY KEY,
			b_title VARCHAR(255),
			b_author VARCHAR(255),
			b_year INT(10),
			b_poster VARCHAR(255),
			b_description TEXT(65535),
			path_to_book VARCHAR(255),
			add_date TIMESTAMP(6)
		)";
		if (mysqli_query($conn, $sql)) {
			echo "The table was created<br>";
			insertBook();
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	} else {
		insertBook();
	}

	function insertCategory() {
		global $conn, $id, $category;
		for ($i = 0; $i < count($category); $i++){
			$sql = "INSERT INTO category (id, b_category) VALUES ('$id', '$category[$i]')";
			if (mysqli_query($conn, $sql)) {
				echo "New record created successfully<br>";
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
	}

	$sql = "SELECT * FROM category";
	if (!mysqli_query($conn, $sql)) {
		$sql = "CREATE TABLE category (
			count_number INT(255) NULL AUTO_INCREMENT PRIMARY KEY,
			id VARCHAR(10),
			b_category VARCHAR(255)
		)";
		if (mysqli_query($conn, $sql)) {
			echo "The table (category) was created<br>";
			insertCategory();
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	} else {
		insertCategory();
	}

	mysqli_close($conn);
}
?>