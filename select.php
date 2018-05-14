<?php
require_once('connect.php');
$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    function out($result) {
        while($row = mysqli_fetch_array($result)) {
            for ($i = 0; $i < 8; $i++ ) {
                unset($row[$i]);
            }
            $myArr[] = $row;
        }
        return $myArr;
    }
    $myJSON = json_encode(out($result), JSON_UNESCAPED_UNICODE);
    echo $myJSON;
} else {
    echo "0 results";
}

mysqli_close($conn);
?>