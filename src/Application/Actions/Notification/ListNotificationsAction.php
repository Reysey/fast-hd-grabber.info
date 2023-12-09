<?php

declare(strict_types=1);

namespace App\Application\Actions\Notification;

use Psr\Http\Message\ResponseInterface as Response;

class ListNotificationsAction extends NotificationAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {


        $notifications = $this->notificationRepository->findAll();

        $this->logger->info("Notification list was viewed.");

        return $this->respondWithData($notifications);
    }
}