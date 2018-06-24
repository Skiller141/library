<?php
if (isset($_GET['id'])) {
    require_once('connect.php');
    $sql = "SELECT * FROM books WHERE id='".$_GET['id']."'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            $myData[] = $row;
        }
    } else {
        echo "0 results books";
    }

    // $file = fopen('uploads/Lukyanenko_Sergey_Spektr.txt', 'r');
    // $text = fread($file, filesize('uploads/Lukyanenko_Sergey_Spektr.txt'));
    // fclose($file);
    //mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reader | <?php echo $myData[0]['b_title'] ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/reader.css" rel="stylesheet">
</head>
<body>
    <?php require_once('header.php') ?>
    <div class="main-wrapper">
        <div class="chapters"></div>
        <div class="content col-md-8"><?php echo nl2br(file_get_contents('uploads/Lukyanenko_Sergey_Spektr.txt')); ?></div>
    </div>
    
    <script src="js/jquery-3.3.1.min.js"></script>
	<!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
