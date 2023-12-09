<?php

declare(strict_types=1);

namespace App\Application\Actions\Notification;

use App\Domain\Notification\Notification;
use Psr\Http\Message\ResponseInterface as Response;

class AddNotificationAction extends NotificationAction
{
    protected function action(): Response
    {
        // $userEmail      = $this->resolveArg('USER_EMAIL');
        // $userFullName   =  $this->resolveArg('USER_FULLNAME');

        $formData       = $this->request->getParsedBody();

        $postId         = (int) $formData['NOTIFICATION_POST_ID'] ?? 0;
        $scheduled      = (int) $formData['NOTIFICATION_SCHEDULED'] ?? null;
        $triggerAt      = $formData['NOTIFICATION_TRIGGER_AT'] ?? null;
        $enabled        = (int) $formData['NOTIFICATION_ENABLED'] ?? 0;

        $notification = new Notification(null,$postId,$scheduled,$triggerAt,$enabled);

        $this->notificationRepository->addNotification($notification);

        $this->logger->info("Notification was added.");

        return $this->respondWithData($formData);
    }
}