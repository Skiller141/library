<?php
	require_once('../connect.php');

	$myData = [];
	$sql = "SELECT * FROM books";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_array($result)) {
			$myData[] = $row;
		}
		// echo '<pre>';
		// print_r($myData);
		// echo '</pre>';
	}

	if (isset($_GET['remove'])) {
		$removeID = $_GET['remove'];
		$sql = "DELETE FROM books WHERE id='$removeID';";
		$sql .= "DELETE FROM category WHERE id='$removeID';";
		if (mysqli_multi_query($conn, $sql)) {
			echo "Record deleted successfully";
		} else {
			echo "Error deleting record: " . mysqli_error($conn);
		}
	}

		$catArr = [];
	if (isset($_POST['addCat'])) {
				$addCatInp = $_POST['addCatInp'];
				if (filesize("category.json") > 0) {
						$catJSON = fopen('category.json', 'r');
						$catJSONRead = fread($catJSON, filesize("category.json"));
						$catArr = json_decode($catJSONRead);
						fclose($catJSON);
				}

				if (!in_array($addCatInp, $catArr)) {
						$catArr[] = $addCatInp;
						header("Refresh:0");
				} else {
						?>
								<script>
										alert('The category <?php echo $addCatInp; ?> already exists!');
								</script>
						<?php
				}

				$catJSON = fopen('category.json', 'w');
		fwrite($catJSON, json_encode($catArr));
		fclose($catJSON);
	}

	mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/admin.css">
	<title>Admin panel</title>
</head>
<body>
	<div class="main-contater">
		<div class="left-sidebar col-md-3">
			<h1 align="center">Admin panel</h1>
			<ul class="ls-menu">
				<a href="" class="items"><li>Dashboard</li></a>
				<a href="?p=all" class="items"><li>All Books</li></a>
				<a href="?category" class="items"><li>Category</li></a>
				<li class="items">Item-4</li>
				<li class="items">Item-5</li>
			</ul>
		</div>
		<div class="content col-md-9">
			<div class="content-header">
				<a href="?book=add" class="btn btn-success">Add Book</a>
			</div>
			<div class="out">
			<?php
				if (isset($_GET['p']) == 'all') {
					echo '<h1 class="aTitle">All books</h1>';
					if (count($myData) == 0) {
						echo '<h3>Not Found!</h3>';
					} else {
						echo '<ul class="list-group">';
						for ($i = 0; $i < count($myData); $i++) {
							echo '<li class="list-group-item">' . $myData[$i]['b_title'] . '<a href="?remove=' . $myData[$i]['id'] . '" class="remove-book">Remove</a></li>';
						}
						echo '</ul>';
					}
				}

				if (isset($_GET['book']) == 'add') {
					?>
						<h1 class="aTitle">Add book</h1>
						<form action="upload.php" method="post" id="addBook" name="addBook">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Название книги</span>
								</div>
								<input type="text" class="form-control" name="bTitle" placeholder="Title" aria-label="Username" aria-describedby="basic-addon1">
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">Автор</span>
								</div>
								<input type="text" class="form-control" name="bAuthor" placeholder="Author" aria-label="Author" aria-describedby="basic-addon1">
							</div>

							<div class="card poster-contaner">
								<h3 style="text-align: center">Poster</h3>
								<div class="input-group mb-3 poster-inp-contaner">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">URL</span>
									</div>
									<input type="text" class="form-control" name="bPoster" placeholder="URL to poster" aria-label="Poster" aria-describedby="basic-addon1">
								</div>
								<span style="float: left; margin: 5px 20px;">OR</span>
								<div class="custom-file poster-inp-contaner">
									<input type="file" class="custom-file-input" id="customFile">
									<label class="custom-file-label" for="customFile">Choose file</label>
								</div>
							</div>
							<br />
							<div class="accordion" id="accordionExample">
								<div class="card">
									<div class="card-header" id="headingOne">
									<h5 class="mb-0">
										<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										Категории:
										</button>
									</h5>
									</div>
									<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
										<div class="card-body">
											<div class="form-check">
											 <!-- <input class="form-check-input catCheckBox" type="checkbox" value="0" id="defaultCheck1">
											 <label class="form-check-label catCheckBoxLabel" for="defaultCheck1">
												Checkbox 1
											 </label><br />
											 <input class="form-check-input catCheckBox" type="checkbox" value="1" id="defaultCheck2">
											 <label class="form-check-label catCheckBoxLabel" for="defaultCheck2">
												Checkbox 2
											 </label><br />
											 <input class="form-check-input catCheckBox" type="checkbox" value="2" id="defaultCheck3">
											 <label class="form-check-label catCheckBoxLabel" for="defaultCheck3">
												Checkbox 3
											 </label><br /> -->
											 <?php
													if (filesize("category.json") > 0) {
														$catJSON = fopen('category.json', 'r');
														$catJSONRead = fread($catJSON, filesize("category.json"));
														$catArr = json_decode($catJSONRead);
														fclose($catJSON);

														for ($i = 0; $i < count($catArr); $i++) {
															// echo $catArr[$i] . ',<br>';
															?>
																<input class="form-check-input catCheckBox" type="checkbox" value="<?php echo $i; ?>" id="defaultCheck<?php echo $i; ?>">
																<label class="form-check-label catCheckBoxLabel" for="defaultCheck<?php echo $i; ?>">
																	<?php echo $catArr[$i]; ?>
																</label><br />
															<?php
														}
													}
												?>
											</div>
										</div>
										<!-- </div> -->
									</div>
								</div>
							</div>

							<input type="submit" class="btn btn-primary submit" name="submit" value="Submit">
						</form>
					<?php
				}

				if (isset($_GET['category'])) {
					?>
						<h1 class="aTitle">Category</h1>
						<form action="" method="post">
							<label for="addCatInp">Add category</label>
							<input type="text" name="addCatInp" id="addCatInp">
							<button type="submit" class="btn btn-success" name="addCat" id="addCat">ADD</button>
						</form>
						<div class="catOut">
				<?php
						if (filesize("category.json") > 0) {
								$catJSON = fopen('category.json', 'r');
								$catJSONRead = fread($catJSON, filesize("category.json"));
								$catArr = json_decode($catJSONRead);
								fclose($catJSON);

								for ($i = 0; $i < count($catArr); $i++) {
										echo $catArr[$i] . ',<br>';
								}
						}
				?>
						</div>
				<?php
				}
			?>
			</div>
		</div>
	</div>

	<script src="../js/jquery-3.3.1.min.js"></script>
 <!-- Bootstrap tooltips -->
	<script type="text/javascript" src="../js/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script src="js/admin.js"></script>
</body>
</html>