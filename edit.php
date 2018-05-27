<?php
if (isset($_POST['submit'])) {
	require_once('connect.php');
	$id = $_POST['id'];
	$title = $_POST['title'];
	$author = $_POST['author'];
	$year = $_POST['year'];
	$poster = $_POST['poster'];
	$description = $_POST['description'];
	$book = $_FILES['uploadFile'];
    $category = $_POST['hiddenCatInput'];
    
    $sql = "UPDATE books SET 
    b_title = '$title', 
    b_author = '$author',
    b_year = '$year', 
    b_poster = '$poster', 
    b_description = '$description' WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
			echo "The record updated successfully<br>";
	} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	
	for ($i = 0; $i < count($category); $i++){
		$sql .= "UPDATE category SET b_category = '$category[$i]' WHERE id='$id'";
		if (mysqli_query($conn, $sql)) {
			echo "The category updated successfully<br>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
    
    mysqli_close($conn);
}
?>