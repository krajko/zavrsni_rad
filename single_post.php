<?php

    include 'connection.php';
    include_once 'functions.php';


    $id = $_GET['id'];

    try {
        $post = getPost($id);
    } catch (PDOException $e) {
        echo "Error while fetching post.";
        echo $e->getMessage();
    }

    try {
        $comments = getComments($id);
    } catch (PDOException $e) {
        echo "Error while fetching post.";
        echo $e->getMessage();
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
                <h2 class="blog-post-title">
                    <?php echo $post['title']; ?>
                </h2>
                <p class="blog-post-meta">
                    <?php echo $post['created_at']; ?> by 
                    <a href="#">
                        <?php echo $post['author']; ?>
                    </a>
                </p>
                
                <p> <?php echo $post['body']; ?> </p>
                <hr>
            </div><!-- /.blog-post -->

            <div class="comments">
                <h2> Comments </h2>
                <hr>
                <ul>
                <?php foreach ($comments as $comment) { ?>
                    
                        <li> 
                            <h3> <?php echo $comment['author']; ?>
                            <br>
                            <p> <?php echo $comment['text']; ?>
                            <hr>
                        </li>
                        
                <?php } ?>
                </ul>
            </div>


            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="javascript: history.back()">Back</a>
            </nav>

        </div><!-- /.blog-main -->

        <?php include 'sidebar.php'; ?>

    </div><!-- /.row -->

</main><!-- /.container -->

<?php include 'footer.php'; ?>
</body>
</html>
