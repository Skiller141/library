<?php
if (isset($_GET['id'])){
  require('connect.php');
    $sql = "SELECT * FROM books WHERE id='".$_GET['id']."'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            for ($i = 0; $i < 8; $i++ ) {
                unset($row[$i]);
            }
            $myData[] = $row;
        }

        $sql = "SELECT * FROM category WHERE id='".$_GET['id']."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) {
                // for ($i = 0; $i < 8; $i++ ) {
                //     unset($row[$i]);
                // }
                $myCat[] = $row;
            }
            $myCatJson = json_encode($myCat, JSON_UNESCAPED_UNICODE);
        } else {
            echo "0 results categories";
        }
    } else {
        echo "0 results books";
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
  <!-- My fonts -->
  <!-- <link rel="stylesheet" href="css/fonts.css"> -->
  <style>
    header {
        background: #333;
        color: #eee;
        font-family: "Roboto Condensed";
        padding: 10px;
    }

    .title {
        text-align: center;
    }

    #btnAdd {
        position: absolute;
        right: 15px;
        top: 10px;
    }

    #btnEdit {
        position: absolute;
        right: 150px;
        top: 10px;
    }

    .form-group .col-form-label {
        float: left;
    }

    .addCatContaner {
        display: flex;
        justify-content: center;
        flex-flow: row wrap;
    }

    .addCatBtn {
        display: inline-block;
        /* vertical-align: top; */
        padding: 10px 20px;
    }

    .tCat {
        margin: 10px 5px;
        display: inline-table;
    }
</style>
</head>
<body>
<header>
    <h1 class="title"><a href="index.php" style="color: #eee;">Library</a></h1>
    <?php 
    if (isset($_GET['id'])){
      ?>
        <button type="button" class="btn btn-success" id="btnEdit" data-toggle="modal" data-target="#editBookModal">Edit book</button>
      <?php
    }
    ?>
    <button type="button" class="btn btn-primary" id="btnAdd" data-toggle="modal" data-target="#addBookModal">Add Book</button>
</header>
<!-- Add book modal -->
<div class="modal fade" id="addBookModal" tabindex="-1" role="dialog" aria-labelledby="addBookModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addBookModalLabel">Add book</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="addBookForm" action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="random">
            <div class="form-group">
              <label for="title" class="col-form-label col-md-3">Book:</label>
              <input type="text" class="form-control col-md-8" name="title">
            </div>
            <div class="form-group">
              <label for="author" class="col-form-label col-md-3">Author:</label>
              <input type="text" class="form-control col-md-8" name="author">
            </div>
            <div class="form-group">
              <label for="year" class="col-form-label col-md-3">Year:</label>
              <input type="text" class="form-control col-md-8" name="year">
            </div>
            <div class="form-group">
                <label for="categories" class="col-form-label col-md-3">Category:</label>
                <input type="text" class="form-control col-md-6" name="categories" style="display: inline-block;">
                <div class="btn btn-success addCatBtn">Add</div>
                <div class="addCatContaner"></div>
            </div>
            <div class="form-group">
              <label for="poster" class="col-form-label col-md-3">Image url:</label>
              <input type="text" class="form-control col-md-8" name="poster">
            </div>
            <div class="form-group">
              <label for="description" class="col-form-label col-md-3">Description:</label>
              <textarea class="form-control col-md-8" name="description"></textarea>
            </div>
            <div class="form-group">
              <label for="uploadFile" class="col-form-label col-md-3">Upload:</label>
              <input type="file" class="form-control col-md-8" name="uploadFile" id="uploadFile">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="submit">Add book</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>

<!-- Edit book modal -->
<div class="modal fade" id="editBookModal" tabindex="-1" role="dialog" aria-labelledby="editBookModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editBookModalLabel">Edit book</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="addBookForm" action="edit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <div class="form-group">
              <label for="title" class="col-form-label col-md-3">Book:</label>
              <input type="text" class="form-control col-md-8" name="title" value="<?php echo $myData[0]['b_title'] ?>">
            </div>
            <div class="form-group">
              <label for="author" class="col-form-label col-md-3">Author:</label>
              <input type="text" class="form-control col-md-8" name="author" value="<?php echo $myData[0]['b_author'] ?>">
            </div>
            <div class="form-group">
              <label for="year" class="col-form-label col-md-3">Year:</label>
              <input type="text" class="form-control col-md-8" name="year" value="<?php echo $myData[0]['b_year'] ?>">
            </div>
            <div class="form-group">
                <label for="categories" class="col-form-label col-md-3">Category:</label>
                <input type="text" class="form-control col-md-6" name="categories" style="display: inline-block;">
                <div class="btn btn-success addCatBtn">Add</div>
                <div class="addCatContaner"></div>
            </div>
            <div class="form-group">
              <label for="poster" class="col-form-label col-md-3">Image url:</label>
              <input type="text" class="form-control col-md-8" name="poster" value="<?php echo $myData[0]['b_poster'] ?>">
            </div>
            <div class="form-group">
              <label for="description" class="col-form-label col-md-3">Description:</label>
              <textarea class="form-control col-md-8" name="description"><?php echo $myData[0]['b_description'] ?></textarea>
            </div>
            <div class="form-group">
              <label for="uploadFile" class="col-form-label col-md-3">Upload:</label>
              <input type="file" class="form-control col-md-8" name="uploadFile" id="uploadFile">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="submit">Edit book</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>

<script>
document.getElementById('btnAdd').addEventListener('click', function () {
    var ID = function () {
        return '_' + Math.random().toString(36).substr(2, 9);
    };
    document.getElementsByName('random')[0].value = ID();
});

let myArr = [];
let catInp = document.getElementsByName('categories')[0];
document.getElementsByClassName('addCatBtn')[0].addEventListener('click', () => {
    catInpValue = catInp.value.toLowerCase();
    catInpValue = catInpValue[0].toUpperCase() + catInpValue.slice(1);
    // console.log(catInpValue);

    for (var key in myArr) {
        if (myArr[key] === catInpValue) {
            alert('Вы уже выбрали такую категорию!');
            return false;
        }
    }

    myArr.push(catInpValue);
    console.log(myArr);

    let tCat = document.createElement('span');
    tCat.classList.add('tCat', 'alert', 'alert-dark', 'alert-dismissible', 'fade', 'show');
    tCat.setAttribute('role', 'alert');
    tCat.innerHTML = catInpValue;
    document.getElementsByClassName('addCatContaner')[0].appendChild(tCat);

    let closeBtn = document.createElement('button');
    closeBtn.type = "button";
    closeBtn.classList.add('close', 'catClose');
    closeBtn.name = 'closeBtn';
    closeBtn.setAttribute('data-dismiss', 'alert');
    closeBtn.setAttribute('aria-label', 'Close');
    closeBtn.setAttribute('myattr', catInpValue);
    tCat.appendChild(closeBtn);
    closeBtn.onclick = closeClick;

    let closeIcon = document.createElement('span');
    closeIcon.setAttribute('aria-hidden', 'true');
    closeIcon.innerHTML = '&times;';
    closeBtn.appendChild(closeIcon);

    let hiddenCatInput = document.createElement('input');
    hiddenCatInput.type = "hidden";
    hiddenCatInput.classList.add('hiddenCatInp');
    hiddenCatInput.name = "hiddenCatInput[]";
    hiddenCatInput.value = catInpValue;
    document.getElementsByClassName('addCatContaner')[0].appendChild(hiddenCatInput);

    catInp.value = "";
});

var categories;
  <?php
    $url = $_SERVER["REQUEST_URI"]; 
    $pos = strrpos($url, "full.php"); 

    if($pos != false) {
        ?>
          categories = <?php echo $myCatJson; ?>;
          document.getElementById('btnEdit').addEventListener('click', () => {
            for (var i = 0; i < categories.length / 2; i++) {
              console.log(categories[i]['b_category']);
              let tCat = document.createElement('span');
              tCat.classList.add('tCat', 'alert', 'alert-dark', 'alert-dismissible', 'fade', 'show');
              tCat.setAttribute('role', 'alert');
              tCat.innerHTML = categories[i]['b_category'];
              document.getElementsByClassName('addCatContaner')[1].appendChild(tCat);

              let closeBtn = document.createElement('button');
              closeBtn.type = "button";
              closeBtn.classList.add('close', 'catClose');
              closeBtn.name = 'closeBtn';
              closeBtn.setAttribute('data-dismiss', 'alert');
              closeBtn.setAttribute('aria-label', 'Close');
              closeBtn.setAttribute('myattr', categories[i]['b_category']);
              tCat.appendChild(closeBtn);
              closeBtn.onclick = closeClick;

              let closeIcon = document.createElement('span');
              closeIcon.setAttribute('aria-hidden', 'true');
              closeIcon.innerHTML = '&times;';
              closeBtn.appendChild(closeIcon);

              let hiddenCatInput = document.createElement('input');
              hiddenCatInput.type = "hidden";
              hiddenCatInput.classList.add('hiddenCatInp');
              hiddenCatInput.name = "hiddenCatInput[]";
              hiddenCatInput.value = categories[i]['b_category'];
              document.getElementsByClassName('addCatContaner')[1].appendChild(hiddenCatInput);
            }
        });
        <?php
    }
  ?>

function closeClick() {
    var index = myArr.indexOf(this.getAttribute('myattr'));
    var hiddenInp = document.getElementsByClassName('hiddenCatInp');

    myArr.splice(index, 1);
    hiddenInp[index].remove();
}

document.forms['addBookForm'].addEventListener('submit', function () {
    $('#exampleModal').modal('hide');
});

</script>
