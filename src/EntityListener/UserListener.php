<?php


namespace App\EntityListener;


use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Hashage password
 * Class UserListener
 * @package App\EntityListener
 */
class UserListener
{

    private  UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    // Sera appelé avec chaque persist d'un objet user
    public function prePersist(User $user)
    {
        $this->encodePassword($user);
    }

    // Sera appelé avec chaque update d'un objet user
    public function preUpdate(User $user)
    {
        $this->encodePassword($user);
    }

    public function encodePassword(User $user)
    {
        if($user->getPlainPassword() === null) {
            return;
        }

        $user->setPassword(
            $this->hasher->hashPassword(
                $user,
                $user->getPlainPassword()
            )
        );
    }
}