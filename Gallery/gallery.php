<!DOCTYPE>
<html>
    <head>
        <title>
            Gallery
        </title>
    </head>
    <link rel="stylesheet" href="css/gallery.css">
    <body>
    <?php include("config.php") ?>
        <div>
            <h1>
                Add New Image
            </h1>
            <form class="galleryForm" method="post" enctype="multipart/form-data">
                <label>
                    User Name
                </label>
                <input type="text" name="user_name" required>
                <label>
                    Image
                </label>
                <input type="file" name="image" accept="*/image"required>
                <button type="submit" name="add_btn">
                    Add
                </button>
            </form>
        </div>
        <script type="text/javascript" src="js/bootstrap.min.js">
        </script>
    </body>
</html>