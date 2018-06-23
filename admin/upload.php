<?php

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

if (isset($_POST['submit'])) {
    require_once('../connect.php');
    $id = uniqid();
    $title = $_POST['title'];
    $author = $_POST['author'];
    // $year = $_POST['year'];
    $poster = $_POST['poster'];
    $description = $_POST['description'];
    // $book = $_FILES['uploadFile'];

    $category = $_POST['fcb'];

    // echo '<pre>';
    // print_r($category);
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
                $htaccess = fopen('../.htaccess', 'a');
                fwrite($htaccess, 'RewriteRule ^admin/' . translit($title) . '.html$ admin/index.php?edit=' . $id . PHP_EOL);
                fclose($htaccess);
                header('Location: all-books');
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