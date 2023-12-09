<?php
/**
 * Created by PhpStorm.
 * User: Reysey
 * Date: 12/3/2023
 * Time: 8:58 AM
 */

declare(strict_types=1);

namespace App\Application\Actions\User;

use App\Domain\User\Post;
use Psr\Http\Message\ResponseInterface as Response;


class AddUserAction extends UserAction
{
    protected function action(): Response
    {
        // $userEmail      = $this->resolveArg('USER_EMAIL');
        // $userFullName   =  $this->resolveArg('USER_FULLNAME');

        $formData = $this->request->getParsedBody();

        $userEmail = $formData['USER_EMAIL'] ?? null;
        $userFullName = $formData['USER_FULLNAME'] ?? null;

        $user = new Post(null, $userEmail, $userFullName);

        $this->userRepository->addUser($user);

        $this->logger->info("User of id `{$userFullName}` was added.");

        return $this->respondWithData($user);
    }
}