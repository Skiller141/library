<?php
if (isset($_POST['submit'])) {
    require_once('../connect.php');
    $id = uniqid();
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $poster = $_POST['poster'];
    $description = $_POST['description'];
    // $book = $_FILES['uploadFile'];

    $category = $_POST['fcb'];

    // echo '<pre>';
    // print_r($fcb);
    // echo '</pre>';

    function insertBook() {
		global $conn, $id, $title, $author, $poster, $description, $newPath;
		$sql = "INSERT INTO books (
            id,
            b_title,
            b_author,
            b_poster,
            b_description
            ) VALUES (
                '$id', 
                '$title', 
                '$author', 
                '$poster', 
                '$description'
                )";
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
}
?>