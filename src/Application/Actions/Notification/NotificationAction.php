<?php

declare(strict_types=1);

namespace App\Application\Actions\Notification;

use App\Application\Actions\Action;
use App\Domain\Notification\NotificationRepository;
use Psr\Log\LoggerInterface;

abstract class NotificationAction extends Action
{
    protected NotificationRepository $notificationRepository;

    public function __construct(LoggerInterface $logger, NotificationRepository $notificationRepository)
    {
        parent::__construct($logger);

        $this->notificationRepository = $notificationRepository;
    }
}
