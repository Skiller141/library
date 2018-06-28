<?php
    require_once('../connect.php');
    require_once('functions.php');

	$myData = db_select_func($conn, "SELECT * FROM books");

	if (isset($_GET['remove'])) {
        ?>
        <script>
        var c = confirm('You are sure?')
            if (c == true) {
                <?php
                $removeID = $_GET['remove'];
                $sql = "DELETE FROM books WHERE id='$removeID';";
                $sql .= "DELETE FROM category WHERE id='$removeID';";
                if (mysqli_multi_query($conn, $sql)) {
                    echo "Record deleted successfully";
                } else {
                    echo "Error deleting record: " . mysqli_error($conn);
                }
                header("Location: ?p=all");
                ?>
            } else {
                console.log(false);
            }
        </script>
        <?php
	}

    $catArr = [];
    
    function openCategoryJSON() {
        if (filesize("category.json") > 0) {
            // global $catArr;
			$catJSON = fopen('category.json', 'r');
			$catJSONRead = fread($catJSON, filesize("category.json"));
			$catArr = json_decode($catJSONRead);
            fclose($catJSON);
            return $catArr;
        }
    }

	if (isset($_POST['addCat'])) {
        $addCatInp = $_POST['addCatInp'];
        $addCatInp = mb_convert_case($addCatInp, MB_CASE_LOWER, "UTF-8");
        // $addCatInp = explode(' ', $addCatInp);
        // $addCatInp = str_replace($addCatInp[0], mb_convert_case($addCatInp[0], MB_CASE_TITLE, "UTF-8"), $addCatInp);
        
        // echo $addCatInp;
        
		$catArr = openCategoryJSON();
        if (count($catArr) == 0) {
            $catArr[] = $addCatInp;
            header("Refresh:0");
        } else if (!in_array($addCatInp, $catArr)) {
			$catArr[] = $addCatInp;
			header("Refresh:0");
		} else {
            // echo "<script>alert('The category $addCatInp already exists!');</script>";
            ?>
                <div class="alert alert-danger alert-dismissible fade show animated fadeInDown" id="catExistsAlert" role="alert">
                    The category <strong><?php echo $addCatInp; ?></strong> already exists!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
		}

		$catJSON = fopen('category.json', 'w');
		fwrite($catJSON, json_encode($catArr, JSON_UNESCAPED_UNICODE));
		fclose($catJSON);
    }

    if (isset($_GET['removecat'])) {
        $catArr = openCategoryJSON();
        $removeCat = mb_convert_case($_GET['removecat'], MB_CASE_LOWER, "UTF-8");
        echo $removeCat;
        
        foreach($catArr as $k => $v) {
            if ($v != $removeCat) {
                $newArr[] = $v;
            } 
        }
        
        $catJSON = fopen('category.json', 'w');
		fwrite($catJSON, json_encode($newArr, JSON_UNESCAPED_UNICODE));
        fclose($catJSON);
        header("Location: ?category");
    }

    //mysqli_close($conn);
    
    function translit($s) {
        $s = (string) $s; // преобразуем в строковое значение
        $s = strip_tags($s); // убираем HTML-теги
        $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
        $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
        $s = trim($s); // убираем пробелы в начале и конце строки
        $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
        $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
        $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
        $s = str_replace(" ", "-", $s); // заменяем пробелы знаком минус
        return $s; // возвращаем результат
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/animate.css" rel="stylesheet">
	<link rel="stylesheet" href="css/admin.css">
	<title>Admin panel</title>
</head>
<body>
	<div class="main-contater">
		<div class="left-sidebar col-md-3">
			<h1 align="center">Admin panel</h1>
			<ul class="ls-menu">
				<a href="./" class="items"><li>Dashboard</li></a>
				<a href="all-books" class="items"><li>All Books</li></a>
				<a href="categories" class="items"><li>Category</li></a>
				<li class="items">Item-4</li>
				<li class="items">Item-5</li>
			</ul>
		</div>
		<div class="content col-md-9">
			<div class="content-header">
				<a href="add-new-book" class="btn btn-success">Add Book</a>
			</div>
			<?php require_once('content.php'); ?>
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