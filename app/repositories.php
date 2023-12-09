<?php

declare(strict_types=1);

use App\Domain\Notification\NotificationRepository;
use App\Domain\Post\PostRepository;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\Notification\NotificationRepo;
use App\Infrastructure\Persistence\Post\PostRepo;
use App\Infrastructure\Persistence\User\UserRepo;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its implementation
    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(UserRepo::class),
        NotificationRepository::class => \DI\autowire(NotificationRepo::class),
        PostRepository::class => \DI\autowire(PostRepo::class),
    ]);
};
