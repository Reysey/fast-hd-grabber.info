<?php

declare(strict_types=1);

namespace App\Domain\User;

use JsonSerializable;

class User implements JsonSerializable
{
    private ?int $userId;

    private string $userEmail;

    private string $userFullName;

    public function __construct(?int $userId, string $userEmail, string $userFullName)
    {
        $this->userId = $userId;
        $this->userEmail = strtolower($userEmail);
        $this->userFullName = ucfirst($userFullName);
    }

    /**
     * @return string
     */
    public function getUserEmail(): string
    {
        return $this->userEmail;
    }

    /**
     * @param string $userEmail
     */
    public function setUserEmail(string $userEmail): void
    {
        $this->userEmail = $userEmail;
    }

    /**
     * @return string
     */
    public function getUserFullName(): string
    {
        return $this->userFullName;
    }

    /**
     * @param string $userFullName
     */
    public function setUserFullName(string $userFullName): void
    {
        $this->userFullName = $userFullName;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     */
    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
    }



    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'USER_ID' => $this->userId,
            'USER_EMAIL' => $this->userEmail,
            'USER_FULLNAME' => $this->userFullName
        ];
    }
}
