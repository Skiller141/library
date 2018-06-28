<?php
if (isset($_GET['id'])){
    require_once('connect.php');
    require_once('functions.php');

    $id = $_GET['id'];
    $myData = db_select_func($conn, "SELECT * FROM books WHERE id='$id'");
    $myCat = db_select_func($conn, "SELECT * FROM category WHERE id='$id'");
    
    $cat_string = '';
    for ($i = 0; $i < count($myCat); $i++) {
        $cat_string .= '<a href="category.php?cat=' . $myCat[$i]['b_category'] . '">' . $myCat[$i]['b_category'] . '</a>, ';
    }
    $cat_string = substr($cat_string, 0, strrpos($cat_string, ','));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $myData[0]['b_title'] ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/full.css" rel="stylesheet">
    <link rel="stylesheet" href="css/nav.css">
</head>
<body>
    <?php require_once('header.php'); ?>
    <div class="main-wrap col-md-10">
        <div class="mycard col-md-12">
            <div class="row">
                <div class="left-contaner col-md-3">
                    <div class="poster" style="background: url('<?php echo $myData[0]['b_poster'] ?>'); background-size: 100% 100%;"></div>
                    <a href="<?php echo $myData[0]['path_to_book'] ?>" class="btn btn-success myBtn" download>Скачать</a>
                    <a href="reader.php?id=<?php echo $_GET['id'] ?>" class="btn btn-danger myBtn">Читать</a>
                </div>
                
                <div class="short-info col-md-9">
                    <div class="item"><i class="fa fa-book icons" aria-hidden="true"></i><b>Книга:</b> <?=$myData[0]['b_title']?></div>
                    <div class="item"><i class="fa fa-user-o icons" aria-hidden="true"></i><b>Автор:</b> <?=$myData[0]['b_author']?></div>
                    <div class="item" id="category"><i class="fa fa-code-fork icons" aria-hidden="true"></i><b>Категории:</b> <?=$cat_string;?></div>
                    <div class="item"><i class="fa fa-calendar icons" aria-hidden="true"></i><b>Год:</b> <?=$myData[0]['b_year']?></div>
                    <div class="item"><i class="fa fa-eye icons" aria-hidden="true"></i><b>Серия:</b> Автостопом по Галактике</div>
                    <div class="item"><i class="fa fa-file-text-o icons" aria-hidden="true"></i><b>Описание:</b> <?=$myData[0]['b_description']?></div>
                </div>
            </div>
        </div>
        <div class="readOut" style="display:none;"><div id="wait" style="display: none;">Wait...</div></div>
    </div>
    
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- <script>
        var catStr = document.getElementById('category');
        var categories = <?php echo $myCatJson ?>;
        for (var i = 0; i < categories.length / 2; i++) {
            catStr.innerHTML += '<a href="category.php?cat=' + categories[i]['b_category'] + '" />' + categories[i]['b_category'] + '</a>' + ', ';
        }
        catStr.innerHTML = catStr.innerHTML.slice(0, catStr.innerHTML.lastIndexOf(','));
        
    </script> -->
</body>
</html>