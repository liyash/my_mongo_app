<?php

namespace App\Service;

use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;

class UserService
{
    public function __construct(private DocumentManager $dm) {}

    public function createUser(string $name, string $email, int $age): User
    {
        $user = new User();
        $user->setName($name)->setEmail($email)->setAge($age);

        $this->dm->persist($user);
        $this->dm->flush();

        return $user;
    }

    public function getAllUsers(): array
    {
        return $this->dm->getRepository(User::class)->findAll();
    }

    public function getUser(string $id): ?User
    {
        return $this->dm->getRepository(User::class)->find($id);
    }

    public function updateUser(string $id, string $name, string $email, int $age): ?User
    {
        $user = $this->getUser($id);
        if (!$user) {
            return null;
        }

        $user->setName($name)->setEmail($email)->setAge($age);
        $this->dm->flush();

        return $user;
    }

    public function deleteUser(string $id): bool
    {
        $user = $this->getUser($id);
        if (!$user) {
            return false;
        }

        $this->dm->remove($user);
        $this->dm->flush();

        return true;
    }
    
    public function getUsersWithAgeGreaterThan(int $minAge): array
    {
        $qb = $this->dm->createQueryBuilder(User::class);
        $qb->field('age')->gt($minAge);
        return $qb->getQuery()->execute()->toArray();
    }
}
