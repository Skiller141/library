<?php
require_once('connect.php');
require_once('functions.php');

if (isset($_GET['cat'])) {
    $category = $_GET['cat'];
    $myCat = db_select_func($conn, "SELECT * FROM category WHERE b_category='$category'");

    foreach ($myCat as $book) {
        $id = $book['id'];
        $myData[] = db_select_func($conn, "SELECT * FROM books WHERE id='$id'");
    }
    // echo '<pre>';
    // print_r($myData);
    // echo '</pre>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo $_GET['cat']; ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="css/nav.css">
</head>
<body>
	<h1 style="text-align:center; color: #333; padding: 10px 0"><?=ucfirst($_GET['cat']);?></h1>
	<div class="col-md-7" style="margin: 0 auto;">
		<?php
            foreach ($myData as $book) {
                if ($book[0]['b_poster'] == '') {
                    $poster = './img/poster_default.jpg';
                } else {
                    $poster = $book[0]['b_poster'];
                }

                $id = $book[0]['id'];
                $myCat = db_select_func($conn, "SELECT * FROM category WHERE id='$id'");
                $cat_str = '';
                foreach ($myCat as $bookCat) {
                    $cat_str .= '<a href="category.php?cat=' . $bookCat['b_category'] . '">' . $bookCat['b_category'] . '</a>, ';
                }
                $cat_str = substr($cat_str, 0, strrpos($cat_str, ','));
                ?>
                    <div class="mycard">
                        <div class="poster col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3" style="background: url('<?=$poster;?>'); background-size: 100% 100%;"></div>
                        <div class="short-info col-xl-8 col-lg-8 col-md-7 col-sm-12 col-12">
                            <div class="item"><i class="fa fa-book icons" aria-hidden="true"></i><b>Книга:</b> <?=$book[0]['b_title'];?></div>
                            <div class="item"><i class="fa fa-user-o icons" aria-hidden="true"></i><b>Автор:</b> <?=$book[0]['b_author'];?></div>
                            <div class="item"><i class="fa fa-code-fork icons" aria-hidden="true"></i><b>Категории:</b> <?=$cat_str;?></div>
                            <div class="item"><i class="fa fa-calendar icons" aria-hidden="true"></i><b>Год:</b> <?=$book[0]['b_year'];?></div>
                            <div class="item"><i class="fa fa-eye icons" aria-hidden="true"></i><b>Серия:</b> Автостопом по Галактике</div>
                            <div class="item"><i class="fa fa-file-text-o icons" aria-hidden="true"></i><b>Описание:</b> <?=substr($book[0]['b_description'], 0, 255) . '...';?></div>
                            <a href="<?='./' . translit($book['b_title']) . '.html';?>" class="btn btn-success float-right">Подробнее</a>
                        </div>
                    </div>
                <?php
            }
        ?>
	</div>

	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>