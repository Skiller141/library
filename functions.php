<?php
    function RusToLat($source=false) {
        if ($source) {
            $rus = [
                'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я',
                'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я'
            ];
            $lat = [
                'A', 'B', 'V', 'G', 'D', 'E', 'Yo', 'Zh', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Shch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya',
                'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'zh', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'shch', 'y', 'y', 'y', 'e', 'yu', 'ya'
            ];
            return str_replace($rus, $lat, $source);
        }
    }

    function myHeader($title, $styles) {
        $html = '<!DOCTYPE html>
            <html lang="en">
            <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>'.$title.'</title>
            '.$styles.'
            </head>
            <body>
            <header>
                <h1 class="title">Library</h1>
                <button type="button" class="btn btn-primary" id="btn" data-toggle="modal" data-target="#exampleModal">Add Book<i class="fas fa-audio-description"></i></button>
            </header>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <form id="addBookForm" action="upload.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="random">
                        <div class="form-group">
                        <label for="title" class="col-form-label col-md-3">Book:</label>
                        <input type="text" class="form-control col-md-8" name="title">
                        </div>
                        <div class="form-group">
                        <label for="author" class="col-form-label col-md-3">Author:</label>
                        <input type="text" class="form-control col-md-8" name="author">
                        </div>
                        <div class="form-group">
                        <label for="year" class="col-form-label col-md-3">Year:</label>
                        <input type="text" class="form-control col-md-8" name="year">
                        </div>
                        <div class="form-group">
                            <label for="categories" class="col-form-label col-md-3">Category:</label>
                            <input type="text" class="form-control col-md-6" name="categories" style="display: inline-block;">
                            <div class="btn btn-success addCatBtn">Add</div>
                            <div class="addCatContaner"></div>
                        </div>
                        <div class="form-group">
                        <label for="poster" class="col-form-label col-md-3">Image url:</label>
                        <input type="text" class="form-control col-md-8" name="poster">
                        </div>
                        <div class="form-group">
                        <label for="description" class="col-form-label col-md-3">Description:</label>
                        <textarea class="form-control col-md-8" name="description"></textarea>
                        </div>
                        <div class="form-group">
                        <label for="uploadFile" class="col-form-label col-md-3">Upload:</label>
                        <input type="file" class="form-control col-md-8" name="uploadFile" id="uploadFile">
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">Add book</button>
                        </div>
                    </form>
                    </div>
                </div>
                </div>
            </div>

            <script src="js/header.js"></script>
            ';
        return $html;
    }

    function test($text, $text2) {
        return $text.'<br>'.$text2;
    }
?>