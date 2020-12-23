<?php

    require 'connection.php';
    include_once 'functions.php';


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        

            

        // if ($_POST['title'] && $_POST['author'] && $_POST['content']) {
            $fname = $_POST['fname']; 
            $lname = $_POST['lname'];
            $gender = $_POST['gender'];
            try {
                addAuthor($fname, $lname, $gender);
            } catch (PDOException $e) {
                echo "Error while creating post.";
                echo $e->getMessage();
            } finally {
                header('Location: create_author.php');
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
                <form action="create_author.php" method="post">
                    <input type="text" name="fname" placeholder="First name..." required>
                    <input type="text" name="lname" placeholder="Last name..." required>

                    <div>
                        <br>
                        <label for="gender">Gender</label>
                        <div>
                            <label for="gender">M</label>
                            <input type="radio" name="gender" value="male"><br>
                            <label for="gender">F</label>
                            <input type="radio" name="gender" value="female">
                        </div>

                    </div>

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
