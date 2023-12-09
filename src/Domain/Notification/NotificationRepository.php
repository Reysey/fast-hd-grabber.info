<?php
/**
 * Created by PhpStorm.
 * User: Reysey
 * Date: 12/2/2023
 * Time: 2:40 PM
 */

declare(strict_types=1);

namespace App\Domain\Notification;

interface NotificationRepository
{
    /**
     * @return Notification[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findNotificationById(int $id): Notification;

    /**
     * @param User $user
     */
    public function addNotification(Notification $notification): void;
}