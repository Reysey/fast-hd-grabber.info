<?php

declare(strict_types=1);

namespace App\Domain\Post;

interface PostRepository
{
    /**
     * @return Post[]
     */
    public function findAllPosts(): array;

    /**
     * @param int $post_id
     * @return Post
     * @throws PostNotFoundException
     */
    public function findPostById(int $post_id): Post;

    /**
     * @param Post $post
     * @return int
     */
    public function addPost(Post $post): bool;

    /**
     * @param int $post_id
     * @return bool
     */
    public function deletePost(int $post_id): bool;

    /**
     * @param Post $post
     * @return bool
     */
    public function updatePost(Post $post): bool;

    /**
     * @return array
     */
    public function listpostTypes(): array;
}
