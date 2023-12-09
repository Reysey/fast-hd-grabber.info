<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Notification;

use App\Domain\Notification\Notification;
use App\Domain\Notification\NotificationNotFoundException;
use App\Domain\Notification\NotificationRepository;
use PDO;

class NotificationRepo implements NotificationRepository
{
private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT NOTIFICATION_ID, POST_ID, SCHEDULED, TRIGGER_DATE, ENABLED, USER_TOKEN ,USER_TIMEZONE FROM notification');
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $notifications = [];
        foreach ($results as $row) {
            $notifications[] = new Notification((int) $row['NOTIFICATION_ID'], $row['POST_ID'], $row['SCHEDULED'], $row['TRIGGER_DATE'], $row['ENABLED'], $row['USER_TOKEN'],$row['USER_TIMEZONE']);
        }

        return $notifications;
    }

    public function findNotificationById(int $id): Notification
    {
        $stmt = $this->pdo->prepare('SELECT NOTIFICATION_ID, POST_ID, SCHEDULED, TRIGGER_DATE, ENABLED, USER_TOKEN FROM notification WHERE id = :NOTIFICATION_ID');
        $stmt->execute(['USER_ID' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            throw new NotificationNotFoundException();
        }

        return new Notification((int) $row['NOTIFICATION_ID'], $row['POST_ID'], $row['SCHEDULED'], $row['TRIGGER_DATE'], $row['ENABLED'], $row['USER_TOKEN']);
    }

    public function addNotification(Notification $notification): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO notification (POST_ID, SCHEDULED,TRIGGER_DATE,ENABLED) VALUES (:POST_ID, :SCHEDULED, :TRIGGER_DATE, :ENABLED)");
        $stmt->bindValue(':POST_ID'         , $notification->getPostId());
        $stmt->bindValue(':SCHEDULED'       , $notification->getScheduled());
        $stmt->bindValue(':TRIGGER_DATE'    , $notification->getTriggerAt());
        $stmt->bindValue(':ENABLED'         , $notification->getEnabled());
        $stmt->execute();
    }
}
