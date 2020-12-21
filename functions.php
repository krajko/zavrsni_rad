<?php

    function setPost($title, $body, $author) {
        global $connection;

        $sql = "INSERT INTO posts (title, body, author)
                VALUES (?, ?, ?);
        ";

        $statement = $connection->prepare($sql);

        try {
            $statement->execute([$title, $body, $author]);
        } catch (PDOException $e) {
            return "Error while creating post.";
        } finally {
            return "Success.";
        }
    }

    function getPost(int $id) {
        global $connection;

        $sql = "SELECT title, body, author, created_at
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

        $sql = "SELECT id, title, body, author, created_at
                FROM posts
                ORDER BY created_at DESC;";
        $statement = $connection->prepare($sql);

        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $posts = $statement->fetchAll();

        return $posts;
    }

    function getComments(int $id) {
        global $connection;

        $sql = "SELECT author, text
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