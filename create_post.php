<?php

    require 'connection.php';
    include_once 'functions.php';

    try {
        $authors = getAuthors();
    } catch (PDOException $e) {
        echo "Error while fetching authors.";
        echo $e->getMessage();
    }

    // var_dump($authors);


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // if ($_POST['title'] && $_POST['author'] && $_POST['content']) {
            $title = $_POST['title']; 
            $author_id = $_POST['author_id'];
            $content = $_POST['content'];
            try {
                addPost($title, $content, $author_id);
            } catch (PDOException $e) {
                echo "Error while creating post.";
                echo $e->getMessage();
            } finally {
                header('Location: posts.php');
            }
        // } else {
        //     echo "Please fill out all the fields.";
        // }
    }

?>

<!-- <!doctype html> -->
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Vivify Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="/styles/blog.css">
    <link rel="stylesheet" href="/styles/styles.css">

</head>
<body>

<?php include 'header.php'; ?>

<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">


            <div class="blog-post">
                <form action="create_post.php" method="post">
                    <input type="text" name="title" placeholder="Title..." required>

                    <select name="author_id">
                        <?php foreach($authors as $author) { ?>
                            <option value="<?php echo $author['id']; ?>"> <?php echo $author['fname'] . " " . $author['lname']; ?></option>
                        <?php } ?>
                    </select>

                    <textarea name="content" placeholder="Content..." oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' required></textarea>

                    <div>
                        <button class="btn btn-outline-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div><!-- /.blog-post -->


            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="#">Older</a>
                <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
            </nav>

        </div><!-- /.blog-main -->

        <?php include 'sidebar.php'; ?>

    </div><!-- /.row -->

</main><!-- /.container -->

<?php include 'footer.php'; ?>
</body>
</html>
