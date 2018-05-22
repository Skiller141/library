<?php
if (isset($_GET['id'])){
    require_once('connect.php');
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
                for ($i = 0; $i < 8; $i++ ) {
                    unset($row[$i]);
                }
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
        <!-- <h2 class="title"><?php echo $myData[0]['b_title'] ?></h2>
            <div class="left-side col-md-3">
            <img class="poster col-md-12 mt-3" src="<?php echo $myData[0]['b_poster'] ?>"/>
            <a href="<?php echo $myData[0]['path_to_book'] ?>" class="btn btn-success myBtn" download>Скачать</a>
            <a href="reader.php?id=<?php echo $_GET['id'] ?>" class="btn btn-danger myBtn">Читать</a>
        </div>
        <div class="items-contaner col-md-8">
            <p class="item"><b>Автор:</b> <?php echo $myData[0]['b_author'] ?></p>
            <p class="item"><b>Год:</b> <?php echo $myData[0]['b_year'] ?></p>
            <p class="item"><b>Категории: </b><span id="category"></span></p>
            <p class="item"><b>Описание:</b> <?php echo $myData[0]['b_description'] ?></p>
        </div> -->
        <div class="mycard col-md-12">
            <div class="row">
                <div class="left-contaner col-md-3">
                    <div class="poster" style="background: url('<?php echo $myData[0]['b_poster'] ?>'); background-size: 100% 100%;"></div>
                    <a href="<?php echo $myData[0]['path_to_book'] ?>" class="btn btn-success myBtn" download>Скачать</a>
                    <a href="reader.php?id=<?php echo $_GET['id'] ?>" class="btn btn-danger myBtn">Читать</a>
                </div>
                
                <div class="short-info col-md-9">
                    <div class="item"><i class="fa fa-book icons" aria-hidden="true"></i><b>Книга:</b> <?php echo $myData[0]['b_title'] ?></div>
                    <div class="item"><i class="fa fa-user-o icons" aria-hidden="true"></i><b>Автор:</b> <?php echo $myData[0]['b_author'] ?></div>
                    <div class="item" id="category"><i class="fa fa-code-fork icons" aria-hidden="true"></i><b>Категории:</b> </div>
                    <div class="item"><i class="fa fa-calendar icons" aria-hidden="true"></i><b>Год:</b> <?php echo $myData[0]['b_year'] ?></div>
                    <div class="item"><i class="fa fa-eye icons" aria-hidden="true"></i><b>Серия:</b> Автостопом по Галактике</div>
                    <div class="item"><i class="fa fa-file-text-o icons" aria-hidden="true"></i><b>Описание:</b> <?php echo $myData[0]['b_description'] ?></div>
                </div>
            </div>
        </div>
        <div class="readOut" style="display:none;"><div id="wait" style="display: none;">Wait...</div></div>
    </div>
    
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        var catStr = document.getElementById('category');
        var categories = <?php echo $myCatJson ?>;
        for (var i = 0; i < categories.length / 2; i++) {
            catStr.innerHTML += '<a href="category.php?cat=' + categories[i]['b_category'] + '" />' + categories[i]['b_category'] + '</a>' + ', ';
        }
        catStr.innerHTML = catStr.innerHTML.slice(0, catStr.innerHTML.lastIndexOf(','));
        
    </script>
</body>
</html>