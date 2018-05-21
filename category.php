<?php
if (isset($_GET['cat'])) {
	require_once('connect.php');
	require_once('functions.php');

    $sql = "SELECT * FROM category WHERE b_category='" . $_GET['cat'] . "'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            $myCat[] = $row;
        }
    } else {
        echo "0 results categories";
    }

	for ($i = 0; $i < count($myCat); $i++) {
		$sql = "SELECT * FROM books WHERE id='".$myCat[$i]['id']."'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_array($result)) {
				$myData[] = $row;
			}
			$myDataJSON = json_encode($myData, JSON_UNESCAPED_UNICODE);
		} else {
			echo "0 results books";
		}
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
	<title><?php echo $_GET['cat']; ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/mdb.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="css/nav.css">
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
		console.log(myData);
		for (var key = 0; key < myData.length; key++) {
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