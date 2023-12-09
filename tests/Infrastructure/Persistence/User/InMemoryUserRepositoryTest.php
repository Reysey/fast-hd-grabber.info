<?php

declare(strict_types=1);

namespace Tests\Infrastructure\Persistence\User;

use App\Domain\User\Post;
use App\Domain\User\PostNotFoundException;
use App\Infrastructure\Persistence\User\PostRepo;
use Tests\TestCase;

class InMemoryUserRepositoryTest extends TestCase
{
    public function testFindAll()
    {
        $user = new Post(1, 'bill.gates', 'Bill', 'Gates');

        $userRepository = new PostRepo([1 => $user]);

        $this->assertEquals([$user], $userRepository->findAll());
    }

    public function testFindAllUsersByDefault()
    {
        $users = [
            1 => new Post(1, 'bill.gates', 'Bill', 'Gates'),
            2 => new Post(2, 'steve.jobs', 'Steve', 'Jobs'),
            3 => new Post(3, 'mark.zuckerberg', 'Mark', 'Zuckerberg'),
            4 => new Post(4, 'evan.spiegel', 'Evan', 'Spiegel'),
            5 => new Post(5, 'jack.dorsey', 'Jack', 'Dorsey'),
        ];

        $userRepository = new PostRepo();

        $this->assertEquals(array_values($users), $userRepository->findAll());
    }

    public function testFindUserOfId()
    {
        $user = new Post(1, 'bill.gates', 'Bill', 'Gates');

        $userRepository = new PostRepo([1 => $user]);

        $this->assertEquals($user, $userRepository->findUserOfId(1));
    }

    public function testFindUserOfIdThrowsNotFoundException()
    {
        $userRepository = new PostRepo([]);
        $this->expectException(PostNotFoundException::class);
        $userRepository->findUserOfId(1);
    }
}
