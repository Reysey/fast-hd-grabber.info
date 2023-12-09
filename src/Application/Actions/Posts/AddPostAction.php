<?php
/**
 * Created by PhpStorm.
 * User: Reysey
 * Date: 12/3/2023
 * Time: 8:58 AM
 */

declare(strict_types=1);

namespace App\Application\Actions\Posts;

use App\Domain\Post\Post;
use Psr\Http\Message\ResponseInterface as Response;


class AddPostAction extends PostAction
{
    protected function action(): Response
    {
        // $userEmail      = $this->resolveArg('USER_EMAIL');
        // $userFullName   =  $this->resolveArg('USER_FULLNAME');

        $formData = $this->request->getParsedBody();

        $post_title         =   $formData['POST_TITLE'] ?? '';
        $post_description   =   $formData['POST_DESCRIPTION'] ?? '';
        $post_type          =   (int) $formData['POST_TYPE'] ?? 0;
        $post_tags          =   isset($formData['POST_TAGS']) ? implode(",", $formData['POST_TAGS']) : '';
        $post_thumbnail_url =   $formData['POST_THUMBNAIL_URL'] ?? '';
        $post_link          =   $formData['POST_LINK'] ?? '';

        $post = new Post(
            null
            , $post_title
            , $post_description
            , $post_type
            , $post_tags
            , $post_thumbnail_url
            , $post_link
        );

        $return = $this->postRepository->addPost($post);

        $this->logger->info("Post of title `{$post_title}` was added.");

        return $this->respondWithData($return);
    }
}