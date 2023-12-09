<?php
/**
 * Created by PhpStorm.
 * User: Reysey
 * Date: 12/3/2023
 * Time: 8:58 AM
 */

namespace App\Application\Actions\User;


use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class UpdateUserTokenAction extends UserAction
{
    protected function action(): Response
    {
        // TODO: Implement action() method.
    }

}