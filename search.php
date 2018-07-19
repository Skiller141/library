<?php
require_once('./connect.php');
require_once('./functions.php');
if (isset($_GET['searchSubmit'])) {
    $value = $_GET['search'];
    $value_lower = mb_convert_case($_GET['search'], MB_CASE_LOWER, "UTF-8");
    // echo $value;
    // echo $value_lower;
    // $OR = "";
    // if ($value !== $value_lower) {
    //     $OR = "OR b_title='$value_lower'";
    // }
    $sql = "SELECT * FROM books WHERE b_title='$value' OR b_title='$value_lower'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $myData[] = $row;
        }
    } else {
        echo 'err';
    }
    // echo '<pre>';
    // print_r($myData);
    // echo '</pre>';
    // foreach($myData as $book) {
    //     $book_str = $book['b_title'] . '<br>';
    // }
    // echo $book_str;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
</body>
</html>