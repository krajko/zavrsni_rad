<?php

    require 'connection.php';
    include_once 'functions.php';

    try {
        $posts = getPosts();
    } catch (PDOException $e) {
        echo "Error while fetching posts.";
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

        <?php foreach ($posts as $post) { 

            try {
                $author = getAuthor($post['author_id']);
            } catch (PDOException $e) {
                echo "Error while fetching author with id " .$post['author_id'].".";
                echo $e->getMessage();
            }

        ?>
            

            <div class="blog-post">
                <h2 class="blog-post-title">
                    <a class="<?php echo $author['gender']; ?>" href="single_post.php?id=<?php echo $post['id']; ?>">
                        <?php echo $post['title']; ?>
                    </a>
                </h2>
                <p class="blog-post-meta">
                    <?php echo $post['created_at']; ?> by 
                    <a class="<?php echo $author['gender']; ?>" href="#">
                        <?php echo $author['fname']." ".$author['lname']; ?>
                    </a>
                </p>

                <p> <?php echo $post['body']; ?> </p>
            </div><!-- /.blog-post -->

        <?php } ?>




        </div><!-- /.blog-main -->

        <?php include 'sidebar.php'; ?>

    </div><!-- /.row -->

</main><!-- /.container -->

<?php include 'footer.php'; ?>
</body>
</html>
