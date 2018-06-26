<?php
    function in_array_r($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
                return true;
            }
        }

        return false;
    }

    // echo '<pre>';
    // print_r($selectBook);
    // echo '</pre>';

    // echo '<pre>';
    // print_r($selectCategory);
    // echo '</pre>';

	if (isset($_POST['edit_submit'])) {
		$title = $_POST['title'];
		$author = $_POST['author'];
		$poster = $_POST['poster'];
        $description = $_POST['description'];
        // $poster = '';
        
        if (isset($_POST['fcb'])) {
            $category = $_POST['fcb'];
        } else {
            $category = [];
            $sql = "DELETE FROM category WHERE id='$id'";
            mysqli_query($conn, $sql);
        }

        // echo '<pre>';
        // print_r($_FILES);
        // echo '</pre>';

        $oldPath = $_FILES["posterFile"]["tmp_name"];
        $newPath = "../uploads/" . basename($_FILES["posterFile"]["name"]);
        $uploadPoster = move_uploaded_file($oldPath, $newPath);
        // $update_poster_db = mysqli_query($conn, "UPDATE books SET b_poster = '$poster' WHERE id='$id'");
        // if (file_exists($oldPath)) {
            if ($uploadPoster) {
                $poster = substr($newPath, 3);
                mysqli_query($conn, "UPDATE books SET b_poster = '$poster' WHERE id='$id'");
            } else if ($poster != '') {
                mysqli_query($conn, "UPDATE books SET b_poster = '$poster' WHERE id='$id'"); 
            }
        // }
        // move_uploaded_file($oldPath, $newPath);
        // $poster = substr($newPath, 3);

        function editAlert($inner_text, $alert_type) {
            ?>
                <div class="alert <?php echo $alert_type; ?> alert-dismissible fade show animated bounceInLeft" id="adminAlert" role="alert">
                    <?php echo $inner_text; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
        }

        if (count($category) > 0) {
            $sql = "DELETE FROM category WHERE id='$id'";
            mysqli_query($conn, $sql);

            for ($i = 0; $i < count($category); $i++) {
                $sql = "INSERT INTO category (id, b_category) VALUES ('$id', '$category[$i]')";
                mysqli_query($conn, $sql);
            }
        }
        
        $selectBook = [];
        $sql = "SELECT * FROM books WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result)) {
                    $selectBook[] = $row;
                }
            }
        }
            
        $sql = "UPDATE books SET 
        b_title = '$title', 
        b_author = '$author',
        b_description = '$description' WHERE id='$id'";

        if (mysqli_query($conn, $sql)) {
            editAlert('<strong>Success:</strong> The record updated successfully', 'alert-success');
        } else {
            editAlert('Error: ' . $sql . \n . mysqli_error($conn), 'alert-danger');
        }          
        ?>
            <script>
                let adminAlert = document.querySelector('#adminAlert');
                if (adminAlert.classList.contains('bounceInLeft')) {
                    setTimeout(() => {
                        adminAlert.classList.replace('bounceInLeft', 'bounceOutUp');
                    }, 5000);
                }
                
            </script>
        <?php
    }

    $selectBook = [];
    $sql = "SELECT * FROM books WHERE id='$id'";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_array($result)) {
				$selectBook[] = $row;
			}
		}
    }
    
    $selectCategory = [];
    $sql = "SELECT * FROM category WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) {
                $selectCategory[] = $row;
            }
        }
    }
?>
<h1 class="aTitle">Edit <?php echo $selectBook[0]['b_title']; ?></h1>
<form action="" method="post" id="editBook" name="editBook" enctype="multipart/form-data">
    <div class="form-contaner">
        <div class="left-side">
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
                <input type="text" class="form-control" value="<?php echo $selectBook[0]['b_author']; ?>" name="author" placeholder="Author" aria-label="Author" aria-describedby="basic-addon1">
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
                                $catArr = openCategoryJSON();
                                if (count($catArr) > 0) {
                                    foreach($catArr as $k => $v) {
                                        in_array_r($catArr[$k], $selectCategory) ? $check = 'checked' : $check = '';
                                        in_array_r($catArr[$k], $selectCategory) ? $style = 'color: green; font-weight: bold;' : $style = '';
                                        $v = mb_convert_case($v, MB_CASE_TITLE, "UTF-8");
                                        ?>
                                            <input class="form-check-input catCheckBox" type="checkbox" name="fcb[]" value="<?php echo $catArr[$k]; ?>" catIndex="<?php echo $k; ?>" id="defaultCheck<?php echo $k; ?>" <?php echo $check; ?>>
                                            <label class="form-check-label catCheckBoxLabel" for="defaultCheck<?php echo $k; ?>" style = "<?php echo $style; ?>">
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
                    <input type="file" class="custom-file-input" id="posterFile" name="posterFile">
                    <label class="custom-file-label" for="posterFile">Choose file</label>
                </div>
            </div>
            <div class="card" style="margin: 10px 0; padding: 15px;">
            <h5 class="aTitle">Upload book</h5>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="uploadBook" name="uploadBook">
                    <label class="custom-file-label" for="uploadBook">Choose file</label>
                </div>
            </div>
        </div>
    </div>
    <input type="submit" class="btn btn-primary submit" style="display: block; margin: 0 auto;" name="edit_submit" value="Edit">

</form>
