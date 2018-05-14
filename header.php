<style>
    header {
        background: #333;
        color: #eee;
        font-family: "Roboto Condensed";
        padding: 10px;
    }

    .title {
        text-align: center;
    }

    #btn {
        position: absolute;
        right: 15px;
        top: 20px;
    }

    .form-group .col-form-label {
        float: left;
    }

    .addCatContaner {
        display: flex;
        justify-content: center;
        flex-flow: row wrap;
    }

    .addCatBtn {
        display: inline-block;
        vertical-align: top;
    }

    .tCat {
        margin: 10px 5px;
        display: inline-table;
    }
</style>

<header>
    <h1 class="title">Library</h1>
    <button type="button" class="btn btn-primary" id="btn" data-toggle="modal" data-target="#exampleModal">Add Book</button>
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