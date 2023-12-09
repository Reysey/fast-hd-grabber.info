<?php

declare(strict_types=1);

namespace App\Application\Actions\Posts;

use Psr\Http\Message\ResponseInterface as Response;

class ListPostsAction extends PostAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {


        $posts = $this->postRepository->findAllPosts();

        $this->logger->info("Users list was viewed.");

        return $this->respondWithData($posts);
    }
}
