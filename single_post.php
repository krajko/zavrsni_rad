<?php

    require 'connection.php';
    include_once 'functions.php';



    $post_id = $_GET['id'];

    try {
        $post = getPost($post_id);
    } catch (PDOException $e) {
        echo "Error while fetching post.";
        // echo $e->getMessage();
    }

    try {
        $authors = getAuthors($post['author_id']);
    } catch (PDOException $e) {
        echo "Error while fetching author with id " .$post['author_id'].".";
        // echo $e->getMessage();
    }

    try {
        $author = getAuthor($post['author_id']);
    } catch (PDOException $e) {
        echo "Error while fetching author with id " .$post['author_id'].".";
        // echo $e->getMessage();
    }

    try {
        $comments = getComments($post_id);
    } catch (PDOException $e) {
        echo "Error while fetching post.";
        // echo $e->getMessage();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $author_id = $_POST['author_id'];
        $content = $_POST['content'];

        addComment($author_id, $content, $post_id);
        header('Location: single_post.php?id=' . $post_id);
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
                <h2 class="blog-post-title <?php echo $author['gender']; ?>">
                    <?php echo $post['title']; ?>
                </h2>
                <p class="blog-post-meta">
                    <?php echo $post['created_at']; ?> by 
                    <a class="<?php echo $author['gender']; ?>" href="#">
                        <?php echo $author['fname']." .".$author['lname']; ?>
                    </a>
                </p>
                
                <p> <?php echo $post['body']; ?> </p>
                <hr>
            </div><!-- /.blog-post -->

            <div class="comments">
                <h2> Comments </h2>

                <ul>
                <?php foreach ($comments as $comment) {
                            try {
                                $COMMENT_author = getAuthor($comment['author_id']);
                            } catch (PDOException $e) {
                                echo "Error while fetching author with id " .$comment['author_id'].".";
                                // echo $e->getMessage();
                            }
                ?>
                    
                        <li> 
                            <h3 class="<?php echo $author['gender']; ?>"> <?php echo $author['fname']." ".$author['lname']; ?>
                            <br>
                            <p> <?php echo $comment['text']; ?>
                            <hr>
                        </li>
                        
                <?php } ?>
                </ul>

                <h3>Add comment</h3>

                <form action="" method="post">
                    <select name="author_id">
                        <?php foreach($authors as $author) { ?>
                            <option value="<?php echo $author['id']; ?>"> <?php echo $author['fname'] . " " . $author['lname']; ?></option>
                        <?php } ?>
                    </select>
                    <input type="text" name="content" placeholder="Comment...">
                    <br>
                    <div>
                        <button class="btn btn-outline-primary">Submit</button>
                    </div>
                    <br>
                </form>
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
