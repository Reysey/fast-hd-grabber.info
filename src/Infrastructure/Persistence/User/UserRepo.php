<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;
use PDO;

class UserRepo implements UserRepository
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
        $stmt = $this->pdo->query('SELECT USER_ID, USER_EMAIL, USER_FULLNAME FROM user_facebook');
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($results as $row) {
            $users[] = new User((int) $row['USER_ID'], $row['USER_EMAIL'], $row['USER_FULLNAME']);
        }

        return $users;
    }

    /**
     * {@inheritdoc}
     */
    public function findUserOfId(int $id): User
    {
        $stmt = $this->pdo->prepare('SELECT USER_ID, USER_EMAIL, USER_FULLNAME FROM user_facebook WHERE id = :USER_ID');
        $stmt->execute(['USER_ID' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            throw new UserNotFoundException();
        }

        return new User((int) $row['USER_ID'], $row['USER_EMAIL'], $row['USER_FULLNAME']);
    }

    public function addUser(User $user): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO user_facebook (USER_EMAIL, USER_FULLNAME) VALUES (:USER_EMAIL, :USER_FULLNAME)");
        $stmt->bindValue(':USER_EMAIL', $user->getUserEmail());
        $stmt->bindValue(':USER_FULLNAME', $user->getUserFullName());
        $stmt->execute();
    }


}
