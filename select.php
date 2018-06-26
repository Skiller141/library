<?php
require_once('connect.php');
if ($_GET['select'] == 'book') {
    $sql = "SELECT * FROM books";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            $myArr[] = $row;
        }
        $myJSON = json_encode($myArr, JSON_UNESCAPED_UNICODE);
        echo $myJSON;
    }
}

if ($_GET['select'] == 'category') {
    $sql = "SELECT * FROM category";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            $myArr[] = $row;
        }
        $myJSONCategory = json_encode($myArr, JSON_UNESCAPED_UNICODE);
        echo $myJSONCategory;
    }
}

//mysqli_close($conn);
?>