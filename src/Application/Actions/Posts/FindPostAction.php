<?php

declare(strict_types=1);

namespace App\Application\Actions\Posts;

use Psr\Http\Message\ResponseInterface as Response;

class FindPostAction extends PostAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        // $userId = (int) $this->resolveArg('id');

        $post_id    =   $formData['POST_ID'] ?? '';

        $post       = $this->postRepository->findPostById($post_id);

        $this->logger->info("Post of id `{$post_id}` was viewed.");

        return $this->respondWithData($post);
    }
}
