<?php
if (isset($_GET['cat'])) {
    require_once('connect.php');

    $sql = "SELECT * FROM category WHERE b_category='" . $_GET['cat'] . "'";
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
        // echo '<pre>';
        // print_r($myCat);
        // echo '</pre>';
    } else {
        echo "0 results categories";
    }

    $sql = "SELECT * FROM books WHERE id='".$myCat[0]['id']."'";
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
		$myDataJSON = json_encode($myData, JSON_UNESCAPED_UNICODE);
        // echo '<pre>';
        // print_r($myData);
        // echo '</pre>';
     } else {
        echo "0 results books";
	}
	
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Document</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<?php require_once('header.php'); ?>
		<h1 style="text-align:center; color: #333; padding: 10px 0"><?php echo $_GET['cat']; ?></h1>
		<div class="card-contaner d-flex justify-content-center">
			<!-- auto generate -->
		</div>

		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script>
			let divContaner = document.getElementsByClassName('card-contaner')[0]
			let myData = <?php echo $myDataJSON; ?>;
			// console.log(myDataJSON[0].id);
			// let myData = JSON.parse(myDataJSON);
			// console.log(myData);
			for (var key in myData) {
				let divCard = []
				divCard[key] = document.createElement('div')
				divCard[key].classList.add('card', 'm-3', 'clearfix')
				divCard[key].style = 'width: 18rem; display: inline-block'
				divContaner.appendChild(divCard[key])

				let listGroup = []
				listGroup[key] = document.createElement('ul')
				listGroup[key].classList.add('list-group', 'list-group-flush')
				divCard[key].appendChild(listGroup[key])

				let cardImg = []
				cardImg[key] = document.createElement('img')
				cardImg[key].classList.add('card-img-top')
				cardImg[key].alt = 'Card image cap'
				cardImg[key].src = myData[key].b_poster
				cardImg[key].style.height = '200px'
				listGroup[key].appendChild(cardImg[key])

				let cardTitle = []
				cardTitle[key] = document.createElement('h5')
				cardTitle[key].classList.add('card-title', 'list-group-item')
				cardTitle[key].innerHTML = myData[key].b_title
				listGroup[key].appendChild(cardTitle[key])

				let author = []
				author[key] = document.createElement('li')
				author[key].classList.add('list-group-item')
				author[key].innerHTML = myData[key].b_author
				listGroup[key].appendChild(author[key])

				let year = []
				year[key] = document.createElement('li')
				year[key].classList.add('list-group-item')
				year[key].innerHTML = myData[key].b_year
				listGroup[key].appendChild(year[key])

				let cardText = []
				cardText[key] = document.createElement('p')
				cardText[key].classList.add('list-group-item')
				cardText[key].innerHTML = myData[key].b_description.slice(0, 255) + '...'
				cardText[key].style.fontSize = '14px'
				listGroup[key].appendChild(cardText[key])

				let linkMore = []
				linkMore[key] = document.createElement('a')
				linkMore[key].innerHTML = 'Подробнее'
				linkMore[key].classList.add('btn', 'btn-success', 'btnMore')
				linkMore[key].setAttribute('href', 'full.php?id=' + myData[key].id)
				listGroup[key].appendChild(linkMore[key])
			}
		</script>
	</body>
	</html>
	<?php
    mysqli_close($conn);
}
?>