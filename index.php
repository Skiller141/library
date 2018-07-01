<?php
    require_once('connect.php');
    require_once('functions.php');

    $settings = db_select_func($conn, "SELECT * FROM settings");

    $sql = "SELECT * FROM books";
    $result = mysqli_query($conn, $sql);
    $count_rows = mysqli_num_rows($result);
    // echo $count_rows;
    if (count($settings) == 0) {
        $books_per_page = 5;
    } else {
        $books_per_page = $settings[0]['pagination'];
    }
    $number_of_pages = ceil($count_rows / $books_per_page);
    // echo $number_of_pages;

    if (!isset($_GET['page'])) {
        $page = 1;
        $current_page = 1;
    } else {
        $page = $_GET['page'];
        $current_page = $_GET['page'];
    }

    $this_page_first_result = ($page - 1) * $books_per_page;

    $sql = "SELECT * FROM books LIMIT " . $this_page_first_result . ',' . $books_per_page;
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($result)) {
        $myData[] = $row;
    }  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$settings[0]['title']?></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
    <div class="card-contaner col-md-6">
        <?php
            foreach ($myData as $book) {
                if ($book['b_poster'] == '') {
                    $poster = './img/poster_default.jpg';
                } else {
                    $poster = $book['b_poster'];
                }

                $id = $book['id'];
                $myCat = db_select_func($conn, "SELECT * FROM category WHERE id='$id'");
                $cat_str = '';
                foreach ($myCat as $bookCat) {
                    $cat_str .= '<a href="category.php?cat=' . $bookCat['b_category'] . '">' . $bookCat['b_category'] . '</a>, ';
                }
                $cat_str = substr($cat_str, 0, strrpos($cat_str, ','));
                ?>
                    <div class="mycard col-md-12">
                        <div class="poster col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3" style="background: url('<?=$poster;?>'); background-size: 100% 100%;"></div>
                        <div class="short-info col-xl-8 col-lg-8 col-md-7 col-sm-12 col-12">
                            <div class="item"><i class="fa fa-book icons" aria-hidden="true"></i><b>Книга:</b> <?=$book['b_title'];?></div>
                            <div class="item"><i class="fa fa-user-o icons" aria-hidden="true"></i><b>Автор:</b> <?=$book['b_author'];?></div>
                            <div class="item"><i class="fa fa-code-fork icons" aria-hidden="true"></i><b>Категории:</b> <?=$cat_str;?></div>
                            <div class="item"><i class="fa fa-calendar icons" aria-hidden="true"></i><b>Год:</b> <?=$book['b_year'];?></div>
                            <div class="item"><i class="fa fa-eye icons" aria-hidden="true"></i><b>Серия:</b> Автостопом по Галактике</div>
                            <div class="item"><i class="fa fa-file-text-o icons" aria-hidden="true"></i><b>Описание:</b> <?=substr($book['b_description'], 0, 255) . '...';?></div>
                            <a href="<?='./' . translit($book['b_title']) . '.html';?>" class="btn btn-success float-right">Подробнее</a>
                        </div>
                    </div>
                <?php
            }

            echo '<div class="pagination">';
            // echo $page . '<br>';
            // echo '<span>' . $number_of_pages . '</span>';
            ($current_page != 1) ? $pag_left = $current_page - 1 : $pag_left = 0;
            ($current_page != $number_of_pages) ? $pag_right = $current_page + 1 : $pag_right = $number_of_pages;
            if ($current_page == 0 || $pag_left == 0) {
                echo '<span class="pagHollow"><i class="fas fa-arrow-left"></i></span>';
            } else {
                echo '<a href="?page=' . $pag_left . '" class="pagItem"><i class="fas fa-arrow-left"></i></a>';
            }
            for($page = 1; $page <= $number_of_pages; $page++) {
                if ($page == $current_page) {
                    echo '<span class="pagHollow">' . $page . '</span>';
                } else {
                    echo '<a href="?page=' . $page . '" class="pagItem">' . $page . '</a>';
                }
            }
            if ($current_page == $number_of_pages) {
                echo '<span class="pagHollow"><i class="fas fa-arrow-right"></i></span>';
            } else {
                echo '<a href="?page=' . $pag_right . '" class="pagItem"><i class="fas fa-arrow-right"></i></a>';
            }
            echo '</div>';
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