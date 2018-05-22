<?php require_once('functions.php');?>
<?php
    require_once('connect.php');
    $sql = "SELECT * FROM category";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            for ($i = 0; $i < 8; $i++ ) {
                unset($row[$i]);
            }
            $myCat[] = $row;
        }
        // for ($i = 0; $i < count($myCat); $i++ ) {
        //     if ($myCat[$i]['b_category'] === $myCat[$i]['b_category']) {
        //         unset($myCat[++$i]);
        //         ++$i;
        //     }
        // }
        // echo '<pre>';
        // print_r($myCat);
        // echo '</pre>';
        $myCatJson = json_encode($myCat, JSON_UNESCAPED_UNICODE);
    } else {
        echo "0 results categories";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <?php require_once('header.php') ?>
  <!-- <div class="card-contaner d-flex justify-content-center">

  </div> -->
  <div class="main-contaner">
    <div class="left-sidebar col-md-2">
        <ul class="list-group" id="left-sidebar-categories">
            <!-- auto generate -->
        </ul>
    </div>
    <div class="card-contaner col-md-9">
        <!-- auto generate -->
    </div>
  </div>

  <div id="myChapters"></div>
  <div id="myText"><h1>Chapter 1</h1> Lorem, ipsum dolor sit amet consectetur adipisicing elit.Beatae ea sequi iste eius quos qui ducimus, voluptas deserunt unde saepe minima accusamus praesentium pariatur! Aliquid necessitatibus, laboriosam quidem minima, neque omnis harum itaque ratione deserunt aliquam quae magni atque dolor totam, officiis maxime veritatis veniam vero tempore beatae saepe commodi. <h1>Chapter 2</h1> Lorem ipsum dolor sit amet consectetur adipisicing elit.Tenetur officia animi natus blanditiis quod quisquam quis numquam! Atque unde dolore, tempora nemo corrupti perferendis assumenda quod illum recusandae, vitae, ex maiores amet sit cum at dignissimos.Est eos deserunt tempora iusto quam doloribus eius illo a fuga! Nisi, fugiat illum nulla, doloribus veritatis quisquam, deleniti nihil velit debitis libero officiis ut. <h1>Chapter 3</h1> Vitae mollitia beatae tempora praesentium saepe nam consequuntur incidunt a ipsa quidem quibusdam non, obcaecati et quae vel eaque.Totam, odit vero ? Iste pariatur at beatae sapiente unde.Nostrum consequuntur quaerat et dicta doloremque reprehenderit nihil hic commodi rerum! Lorem ipsum dolor, sit amet consectetur adipisicing elit.Dignissimos alias omnis ut unde itaque! Autem repellendus totam libero sit molestiae ?</div>
	
<!--Footer-->
<footer class="page-footer font-small elegant-color-dark pt-4 mt-4">
    <!--Footer Links-->
    <div class="container-fluid text-center text-md-left">
        <div class="row">
            <!--First column-->
            <div class="col-md-6">
                <h5 class="text-uppercase">Footer Content</h5>
                <p>Here you can use rows and columns here to organize your footer content.</p>
            </div>
            <!--/.First column-->
            <!--Second column-->
            <div class="col-md-6">
                <h5 class="text-uppercase">Links</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="#!">Link 1</a>
                    </li>
                    <li>
                        <a href="#!">Link 2</a>
                    </li>
                    <li>
                        <a href="#!">Link 3</a>
                    </li>
                    <li>
                        <a href="#!">Link 4</a>
                    </li>
                </ul>
            </div>
            <!--/.Second column-->
        </div>
    </div>
    <!--/.Footer Links-->
    <!--Copyright-->
    <div class="footer-copyright py-3 text-center">
        © 2018 Copyright:
        <a href="https://mdbootstrap.com/material-design-for-bootstrap/"> MDBootstrap.com </a>
    </div>
    <!--/.Copyright-->
</footer>
<!--/.Footer-->
                      
	<script src="js/jquery-3.3.1.min.js"></script>
	<!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript">
        var lsc = document.getElementById('left-sidebar-categories');
        var categories = <?php echo $myCatJson ?>;

        var result = categories.reduce((unique, o) => {
            if(!unique.find(obj => obj.b_category === o.b_category)) {
            unique.push(o);
            }
            return unique;
        },[]);
        console.log(result);

        for (var key in result) {
            var countCat = categories.reduce(function (n, option) {
                return n + (option.b_category == result[key]['b_category']);
            }, 0);

            lsc.innerHTML += `
            <a href="category.php?cat=` + result[key]['b_category'] + `">
                <li class="list-group-item d-flex justify-content-between align-items-center catItems">
                    ` + result[key]['b_category'] + `
                    <span class="badge badge-primary badge-pill">` + countCat + `</span>
                </li>
            </a>`;
        }

    </script>
</body>
</html>