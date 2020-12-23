<?php

    function addPost($title, $body, $author_id) {
        global $connection;

        $sql = "INSERT INTO posts (title, body, author_id)
                VALUES (?, ?, ?);
                ";
        $statement = $connection->prepare($sql);

        $statement->execute([$title, $body, $author_id]);
    }

    function addAuthor($fname, $lname, $gender) {
        global $connection;

        $sql = "INSERT INTO authors (fname, lname, gender)
                VALUES (?, ?, ?);
                ";
        $statement = $connection->prepare($sql);

        $statement->execute([$fname, $lname, $gender]);
    }

    function getAuthors() {
        global $connection;

        $sql = "SELECT *
                FROM authors
                ;";
        $statement = $connection->prepare($sql);

        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $authors = $statement->fetchAll();

        return $authors;
    }

    function getAuthor($author_id) {
        global $connection;

        $sql = "SELECT fname, lname, gender
                FROM authors
                WHERE id = ?
                ;";
        $statement = $connection->prepare($sql);

        $statement->execute([$author_id]);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $author = $statement->fetch();

        return $author;
    }

    function getPost(int $id) {
        global $connection;

        $sql = "SELECT title, body, author_id, created_at
                FROM posts
                WHERE id = ?
                ;";
        $statement = $connection->prepare($sql);

        $statement->execute([$id]);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $posts = $statement->fetch();

        return $posts;
    }

    function getPosts() {
        global $connection;

        $sql = "SELECT id, title, body, author_id, created_at
                FROM posts
                ORDER BY created_at DESC
                ;";
        $statement = $connection->prepare($sql);

        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $posts = $statement->fetchAll();

        return $posts;
    }

    function addComment($author_id, $content, $post_id) {
        global $connection;

        $sql = "INSERT INTO comments (author_id, text, post_id)
                VALUES (?, ?, ?);
                ";
        $statement = $connection->prepare($sql);

        $statement->execute([$author_id, $content, $post_id]);
    }

    function getComments(int $id) {
        global $connection;

        $sql = "SELECT author_id, text
                FROM comments
                WHERE post_id = ?
                ;";
        $statement = $connection->prepare($sql);

        $statement->execute([$id]);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $posts = $statement->fetchAll();

        return $posts;
    }




?>