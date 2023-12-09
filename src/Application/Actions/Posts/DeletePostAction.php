<?php

declare(strict_types=1);

namespace App\Application\Actions\Posts;

use Psr\Http\Message\ResponseInterface as Response;
class DeletePostAction extends PostAction
{
    protected function action(): Response
    {
        // $userEmail      = $this->resolveArg('USER_EMAIL');
        // $userFullName   =  $this->resolveArg('USER_FULLNAME');

        $formData = $this->request->getParsedBody();

        $post_id         =   $formData['POST_ID'] ?? '';

        $return = $this->postRepository->deletePost($post_id);

        $this->logger->info("Post of id `{$post_id}` was deleted.");

        return $this->respondWithData($return);
    }
}