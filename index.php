<?php require_once('functions.php');?>
<?php
    require_once('connect.php');

    function in_array_r($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
                return true;
            }
        }

        return false;
    }

    $sql = "SELECT * FROM category";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            for ($i = 0; $i < 8; $i++ ) {
                unset($row[$i]);
            }
            $myCat[] = $row;
        }
        $myCatJson = json_encode($myCat, JSON_UNESCAPED_UNICODE);
    }

    $sql = "SELECT * FROM books";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            $myData[] = $row;
        }
    }

    // echo '<pre>';
    // print_r($myData);
    // echo '</pre>';
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
  <i class="fa fa-arrow-circle-right mt-1 ml-1" id='showArrow' aria-hidden="true"></i>
  <div class="main-contaner">
    <div class="left-sidebar col-md-2 animated fadeInLeft">
        <ul class="list-group" id="left-sidebar-categories">
            <!-- auto generate -->
        </ul>
        <i class="fa fa-arrow-left mt-1 ml-1" id='hideArrow' aria-hidden="true"></i>
    </div>
    <div class="card-contaner col-md-9">
        <!-- auto generate -->
        <?php
            foreach ($myData as $book) {
                $book['b_poster'] === '' ? $poster = 'http://www.artistsimageresource.org/Wordpress/wp-content/themes/dante/images/default-thumb.png' : $poster = $book['b_poster'];
                ?>
                    <div class="mycard col-md-12">
                        <div class="poster col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3" style="background: url('<?php echo $poster; ?>'); background-size: 100% 100%;"></div>
                        <div class="short-info col-xl-8 col-lg-8 col-md-7 col-sm-12 col-12">
                            <div class="item"><i class="fa fa-book icons" aria-hidden="true"></i><b>Книга:</b> <?php echo $book['b_title']; ?></div>
                            <div class="item"><i class="fa fa-user-o icons" aria-hidden="true"></i><b>Автор:</b> <?php echo $book['b_author']; ?></div>
                            <div class="item"><i class="fa fa-code-fork icons" aria-hidden="true"></i><b>Категории:</b> Фантастика, Космос, Сатира</div>
                            <div class="item"><i class="fa fa-calendar icons" aria-hidden="true"></i><b>Год:</b> <?php echo $book['b_year']; ?></div>
                            <div class="item"><i class="fa fa-eye icons" aria-hidden="true"></i><b>Серия:</b> Автостопом по Галактике</div>
                            <div class="item"><i class="fa fa-file-text-o icons" aria-hidden="true"></i><b>Описание:</b> <?php echo substr($book['b_description'], 0, 255) . '...'; ?></div>
                            <a href="full.php?id=` + myData[key].id + `" class="btn btn-success float-right">Подробнее</a>
                        </div>
                    </div>
                <?php
            }
        ?>
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

        var hideArrow = document.getElementById('hideArrow');
        var leftSidebar = document.getElementsByClassName('left-sidebar')[0];
        var showArrow = document.getElementById('showArrow');
        
        hideArrow.addEventListener('click', () => {
            leftSidebar.classList.replace('fadeInLeft', 'fadeOutLeft');
            showArrow.style.display = 'block';
        });

        showArrow.addEventListener('click', () => {
            leftSidebar.classList.replace('fadeOutLeft', 'fadeInLeft');
            showArrow.style.display = 'none';
        });
    </script>
</body>
</html>