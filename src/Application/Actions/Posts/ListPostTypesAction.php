<?php

declare(strict_types=1);

namespace App\Application\Actions\Posts;

use Psr\Http\Message\ResponseInterface as Response;

class ListPostTypesAction extends PostAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {


        $posts_types = $this->postRepository->listpostTypes();

        $this->logger->info("Post types list was viewed.");

        return $this->respondWithData($posts_types);
    }
}
