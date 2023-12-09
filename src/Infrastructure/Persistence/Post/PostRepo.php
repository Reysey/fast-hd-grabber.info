<?php

namespace App\Infrastructure\Persistence\Post;

use App\Domain\Post\Post;
use App\Domain\Post\PostNotFoundException;
use App\Domain\Post\PostRepository;
use App\Domain\Post\PostType;
use PDO;

class PostRepo implements PostRepository
{

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAllPosts(): array
    {
        $stmt       = $this->pdo->query('SELECT POST_ID, POST_TYPE_ID, POST_TITLE, POST_DESCRIPTION, POST_THUMBNAIL_URL, POST_WEB_URL FROM post');
        $results    = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $post = [];
        foreach ($results as $row) {

            $post[] = new Post((int) $row['POST_ID'], $row['POST_TITLE'], $row['POST_DESCRIPTION'],(int) $row['POST_TYPE_ID'],  '',$row['POST_THUMBNAIL_URL'], $row['POST_WEB_URL']);
        }

        return $post;
    }

    public function findPostById(int $post_id): Post
    {
        $stmt = $this->pdo->prepare('SELECT POST_ID, POST_TYPE_ID, POST_TITLE, POST_DESCRIPTION, POST_THUMBNAIL_URL, POST_WEB_URL FROM post WHERE id = :POST_ID');
        $stmt->execute(['POST_ID' => $post_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            throw new PostNotFoundException();
        }

        return new Post((int) $row['POST_ID'], $row['POST_TYPE_ID'], $row['POST_TITLE'], $row['POST_DESCRIPTION'], $row['POST_THUMBNAIL_URL'], $row['POST_WEB_URL']);
    }

    public function addPost(Post $post): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO post (POST_TYPE_ID, POST_TITLE,POST_DESCRIPTION,POST_THUMBNAIL_URL,POST_WEB_URL) VALUES (:POST_TYPE_ID, :POST_TITLE, :POST_DESCRIPTION, :POST_THUMBNAIL_URL,:POST_WEB_URL)");
        $stmt->bindValue(':POST_TYPE_ID'        , $post->getPostType());
        $stmt->bindValue(':POST_TITLE'          , $post->getPostTitle());
        $stmt->bindValue(':POST_DESCRIPTION'    , $post->getPostDescription());
        $stmt->bindValue(':POST_THUMBNAIL_URL'  , $post->getPostThumbnailUrl());
        $stmt->bindValue(':POST_WEB_URL'        , $post->getPostLink());
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function deletePost(int $post_id): bool
    {
        $sql = "DELETE FROM post WHERE id = :postId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':postId', $post_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function updatePost(Post $post): bool
    {
        $sql = "UPDATE post SET
                    post_title          = :post_title,
                    post_description    = :post_description,
                    post_type_id        = :post_type,
                    post_tags           = :post_tags,
                    post_thumbnail_url  = :post_thumbnail_url,
                    post_web_url           = :post_link
                WHERE post_id           = :post_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':post_id', $post->getPostId(), PDO::PARAM_INT);
        $stmt->bindValue(':post_title', $post->getPostTitle());
        $stmt->bindValue(':post_description', $post->getPostDescription());
        $stmt->bindValue(':post_type', $post->getPostType(), PDO::PARAM_INT);
        $stmt->bindValue(':post_tags', $post->getPostTags());
        $stmt->bindValue(':post_thumbnail_url', $post->getPostThumbnailUrl());
        $stmt->bindValue(':post_link', $post->getPostLink());
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function listpostTypes(): array
    {
        $stmt       = $this->pdo->query('SELECT POST_TYPE_ID, POST_TYPE_LABEL FROM post_type');
        $results    = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $post_types = [];
        foreach ($results as $row) {

            $post_types[] = new PostType((int) $row['POST_TYPE_ID'], $row['POST_TYPE_LABEL']);
        }

        return $post_types;
    }
}