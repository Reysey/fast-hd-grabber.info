<?php
/**
 * Created by PhpStorm.
 * User: Reysey
 * Date: 12/2/2023
 * Time: 11:40 AM
 */

declare(strict_types=1);

namespace App\Domain\Notification;

use JsonSerializable;

class Notification implements JsonSerializable
{
    private ?int $notificationId;

    private int $postId;

    private int $scheduled;

    private string $triggerAt;

    private int $enabled;


    /**
     * @param int|null $notificationId
     * @param int $postId
     * @param int $scheduled
     * @param string $triggerAt
     * @param int $enabled
     */
    public function __construct(?int $notificationId, int $postId, int $scheduled, string $triggerAt, int $enabled)
    {
        $this->notificationId = $notificationId;
        $this->postId = $postId;
        $this->scheduled = $scheduled;
        $this->triggerAt = $triggerAt;
        $this->enabled = $enabled;
    }

    public function getNotificationId(): ?int
    {
        return $this->notificationId;
    }

    public function setNotificationId(?int $notificationId): void
    {
        $this->notificationId = $notificationId;
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function setPostId(int $postId): void
    {
        $this->postId = $postId;
    }

    public function getScheduled(): int
    {
        return $this->scheduled;
    }

    public function setScheduled(int $scheduled): void
    {
        $this->scheduled = $scheduled;
    }

    public function getTriggerAt(): string
    {
        return $this->triggerAt;
    }

    public function setTriggerAt(string $triggerAt): void
    {
        $this->triggerAt = $triggerAt;
    }

    public function getEnabled(): int
    {
        return $this->enabled;
    }

    public function setEnabled(int $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function jsonSerialize() : array
    {
        // $row['NOTIFICATION_ID'], $row['POST_ID'], $row['SCHEDULED'], $row['TRIGGER_DATE'], $row['ENABLED'], $row['USER_TOKEN']);
        return [
            'NOTIFICATION_ID'   => $this->notificationId,
            'POST_ID'           => $this->postId,
            'SCHEDULED'         => $this->scheduled,
            'TRIGGER_DATE'      => $this->triggerAt,
            'ENABLED'           => $this->enabled
        ];

    }
}