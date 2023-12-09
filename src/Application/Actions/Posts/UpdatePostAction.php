<?php

namespace App\Application\Actions\Posts;

use App\Application\Actions\Posts\PostAction;
use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Domain\Post\Post;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class UpdatePostAction extends PostAction
{
    protected function action(): Response
    {

        $formData = $this->request->getParsedBody();

        $post_id            =   (int) $formData['POST_ID'] ?? '';
        $post_title         =   $formData['POST_TITLE'] ?? '';
        $post_description   =   $formData['POST_DESCRIPTION'] ?? '';
        $post_type          =   (int) $formData['POST_TYPE'] ?? 0;
        $post_tags          =   implode(",", $formData['POST_TAGS']) ?? '';
        $post_thumbnail_url =   $formData['POST_THUMBNAIL_URL'] ?? '';
        $post_link          =   $formData['POST_LINK'] ?? '';

        $post = new Post(
              $post_id
            , $post_title
            , $post_description
            , $post_type
            , $post_tags
            , $post_thumbnail_url
            , $post_link
        );

        $return = $this->postRepository->updatePost($post);

        $this->logger->info("Post of title `{$post_title}` was updated.");

        return $this->respondWithData($return);
    }

}