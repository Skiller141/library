<?php
	$selectBook = [];
    $sql = "SELECT * FROM books WHERE b_title='Спектр'";
	$result = mysqli_query($conn, $sql);
	// echo $result;
	if ($result) {
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_array($result)) {
				$selectBook[] = $row;
			}
		}
    }
    // echo '<pre>';
    // print_r($selectBook);
    // echo '</pre>';

?>

<h1 class="aTitle">Edit <?php echo $selectBook[0]['b_title']; ?></h1>
<form action="upload.php" method="post" id="addBook" name="addBook">
	<div class="input-group mb-3">
		<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Название книги</span>
		</div>
		<input type="text" class="form-control" value="<?php echo $selectBook[0]['b_title']; ?>" name="title" placeholder="Title" aria-label="Username" aria-describedby="basic-addon1">
	</div>
	<div class="input-group mb-3">
		<div class="input-group-prepend">
			<span class="input-group-text" id="basic-addon1">Автор</span>
		</div>
		<input type="text" class="form-control" name="author" placeholder="Author" aria-label="Author" aria-describedby="basic-addon1">
	</div>

	<div class="card poster-contaner">
		<h5 style="text-align: center">Poster</h5>
		<div class="input-group mb-3 poster-inp-contaner">
			<div class="input-group-prepend">
				<span class="input-group-text" id="basic-addon1">URL</span>
			</div>
			<input type="text" class="form-control" name="poster" placeholder="URL to poster" aria-label="Poster" aria-describedby="basic-addon1">
		</div>
		<span style="float: left; margin: 5px 20px;">OR</span>
		<div class="custom-file poster-inp-contaner">
			<input type="file" class="custom-file-input" id="customFile" name="uploadPoster">
			<label class="custom-file-label" for="customFile">Choose file</label>
		</div>
	</div>
	<br />
	<div class="accordion">
		<div class="card" id="accordionExample">
			<div class="card-header addCatAccordion" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" id="headingOne">
				<span class="mb-0">Категории</span>
				<i class="fas fa-sort-down mr-1 myArrow" style="float:right;"></i>
			</div>
			<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
				<div class="card-body">
					<div class="form-check">
					 <?php
							$catArr = openCategoryJSON();
							if (count($catArr) > 0) {
								foreach($catArr as $k => $v) {
									$v = mb_convert_case($v, MB_CASE_TITLE, "UTF-8");
									?>
										<input class="form-check-input catCheckBox" type="checkbox" name="fcb[]" value="<?php echo $catArr[$k]; ?>" catIndex="<?php echo $k; ?>" id="defaultCheck<?php echo $k; ?>">
										<label class="form-check-label catCheckBoxLabel" for="defaultCheck<?php echo $k; ?>">
											<?php echo $v; ?>
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
	<div class="input-group" style="margin: 15px 0;">
		<div class="input-group-prepend">
			<span class="input-group-text">Description</span>
		</div>
		<textarea class="form-control" name="description" aria-label="With textarea"></textarea>
	</div>
	<div class="card col-md-5" style="margin: 10px auto; padding: 15px;">
	<h5 class="aTitle">Upload book</h5>
		<div class="custom-file">
			<input type="file" class="custom-file-input" id="customFile" name="uploadBook">
			<label class="custom-file-label" for="customFile">Choose file</label>
		</div>
	</div>

	<input type="submit" class="btn btn-primary submit" name="submit" value="Submit">
</form>