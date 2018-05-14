<?php
if (isset($_GET['id'])){
    require_once('connect.php');
    require_once('functions.php');
    $sql = "SELECT * FROM books WHERE id='".$_GET['id']."'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        function dataOut($result) {
            while($row = mysqli_fetch_array($result)) {
                for ($i = 0; $i < 8; $i++ ) {
                    unset($row[$i]);
                }
                $myArr[] = $row;
            }
            return $myArr;
        }
        $myData = dataOut($result); //Data book

        $sql = "SELECT * FROM category WHERE id='".$_GET['id']."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            function CatOut($result) {
            while($row = mysqli_fetch_array($result)) {
                for ($i = 0; $i < 8; $i++ ) {
                    unset($row[$i]);
                }
                $myArr[] = $row;
            }
            return $myArr;
            }
            $myCat = catOut($result); //Data category
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
    <title><?php echo $myData[0]['b_title'] ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/full.css">
</head>
<body>
    <?php require_once('header.php'); ?>
    <div class="main-wrap col-md-10">
        <h2 class="title"><?php echo $myData[0]['b_title'] ?></h2>
            <div class="left-side col-md-3">
            <img class="poster col-md-12 mt-3" src="<?php echo $myData[0]['b_poster'] ?>"/>
            <a href="<?php echo $myData[0]['path_to_book'] ?>" class="btn btn-success" id="btn-download" download>Скачать</a>
            <button class="btn btn-danger myBtn">Читать</button>
        </div>
        <div class="items-contaner col-md-8">
            <p class="item"><b>Автор:</b> <?php echo $myData[0]['b_author'] ?></p>
            <p class="item"><b>Год:</b> <?php echo $myData[0]['b_year'] ?></p>
            <p class="item"><b>Категории: </b><span id="category"></span></p>
            <p class="item"><b>Описание:</b> <?php echo $myData[0]['b_description'] ?></p>
        </div>
        <div class="readOut"></div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        var catStr = document.getElementById('category');
    <?php 
        for ($i= 0; $i < count($myCat); $i++) { 
    ?>
        var categories = "<?php echo $myCat[$i]['b_category'] ?>";
        catStr.innerHTML += '<a href="category.php?cat=' + categories + '" />' + categories + '</a>' + ', ';
    <?php } ?>
        catStr.innerHTML = catStr.innerHTML.slice(0, catStr.innerHTML.lastIndexOf(','));
            var xhr = new XMLHttpRequest();
            xhr.onload = function () {
                if (this.readyState === this.DONE) {
                    if (this.status === 200) {
                        document.getElementsByClassName('readOut')[0].innerHTML = this.responseText;
                    }
                }
            }
            xhr.open('get', '<?php echo $myData[0]['path_to_book']; ?>', true);
            xhr.send();
            document.getElementsByClassName('myBtn')[0].addEventListener('click', () => {
                document.getElementsByClassName('readOut')[0].style.display = 'block';
            });
    </script>
</body>
</html>