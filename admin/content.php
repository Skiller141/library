<div class="out">
<?php

if (isset($_GET['all'])) {
	echo '<h1 class="aTitle">All books</h1>';
	if (count($myData) == 0) {
		echo '<h3>Not Found!</h3>';
	} else {
        echo '<ul class="list-group">';
		for ($i = 0; $i < count($myData); $i++) {
            echo '
                <li class="list-group-item" style="padding: 0!important;">
                    <a href="'. translit($myData[$i]['b_title']) . '" style="position: relative; padding: .75rem 1.25rem; display: block;">
                    ' . $myData[$i]['b_title'] . '
                    </a>
                    <span class="book-settings">
                        <a href="' . translit($myData[$i]['b_title']) . '" class="edit-book">Edit</a>
                        <a class="remove-book" onclick="removeConfirm(\'' . $myData[$i]['id'] . '\')">Remove</a>
                    </span>
                </li>
            ';
        }
		echo '</ul>';
    }  
}

if (isset($_GET['add'])) {
	?>
	<h1 class="aTitle">Add book</h1>
	<form action="upload.php" method="post" id="addBook" name="addBook">
        <div class="left-side">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Название книги</span>
                </div>
                <input type="text" class="form-control" name="title" placeholder="Title" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Автор</span>
                </div>
                <input type="text" class="form-control" name="author" placeholder="Author" aria-label="Author" aria-describedby="basic-addon1">
            </div>

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
                                    $catArr = openCategoryJSON('./category.json');
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
        </div>
        <div class="right-side">
            <div class="card poster-contaner">
                <h5 style="text-align: center">Poster</h5>
                <div class="input-group mb-3 poster-inp-contaner">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">URL</span>
                    </div>
                    <input type="text" class="form-control" name="poster" placeholder="URL to poster" aria-label="Poster" aria-describedby="basic-addon1">
                </div>
                <p style="text-align: center;">OR</p>
                <div class="custom-file poster-inp-contaner">
                    <input type="file" class="custom-file-input" id="customFile" name="uploadPoster">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>

            <div class="card" style="margin: 10px; padding: 15px;">
            <h5 class="aTitle">Upload book</h5>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="uploadBook">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
        </div>

			<input type="submit" class="btn btn-primary submit" name="submit" value="Submit">
		</form>
	<?php
}

 if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    
    require_once('edit.php');
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
        // $catArr = [];
        $catArr = openCategoryJSON('./category.json');
        
        if (count($catArr) > 0) {
            echo '<ul class="list-group catList">';
            foreach($catArr as $k => $v) {
                $v = mb_convert_case($v, MB_CASE_TITLE, "UTF-8");
                echo '<li class="list-group-item">' . $v . '<a href="?removecat=' . $v . '" class="removeCat">&times;</a></li><br>';
            }
            echo '</ul>';
        }
		
?>
	</div>
<?php
}

if (isset($_GET['settings'])) {
    if (isset($_POST['settings'])) {
        $title = $_POST['title'];
        $pagination = $_POST['pagination'];

        $settings = db_select_func($conn, "SELECT * FROM settings");
        if (count($settings) == 0) {
            $sql = "INSERT INTO settings (title, pagination) VALUES ('$title', '$pagination')";
            mysqli_query($conn, $sql);
        } else {
            $sql = "UPDATE settings SET title='$title', pagination='$pagination' WHERE id='0'";
            mysqli_query($conn, $sql);
        }
        header('Location: settings');
    }
    $settings = db_select_func($conn, "SELECT * FROM settings");
    ?>
        <h1>Settings</h1>
        <form action="" method="post">
            <label for="title">Title: </label>
            <input type="text" name="title" id="title" value="<?=$settings[0]['title']?>">
            <hr>
            <label for="pagination">Books on a page: </label>
            <input type="number" name="pagination" id="pagination" value="<?=$settings[0]['pagination']?>" style="width: 50px;">
            <hr>
            <button type="submit" class="btn btn-success" id="settings" name="settings">Save</button>
        </form>
    <?php
}

?>
</div>