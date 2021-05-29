<?php
namespace Psi\AdminBundle\Manager;

use Psi\AdminBundle\Manager\UserManagerInterface;

class UserManager implements UserManagerInterface
{

    /**
     *
     * @var \Psi\UserBundle\Manager\UserManagerInterface
     */
    private $userManager;

    public function __construct(\Psi\UserBundle\Manager\UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    public function deleteUser(\Symfony\Component\Security\Core\User\UserInterface $user): boolean
    {
        return $this->userManager->deleteUser($user);
    }

    public function findUser($criteria)
    {
        return $this->userManager->findUser($criteria);
    }

    public function getProvider(): \Psi\UserBundle\Provider\ObjectManagerAwareUserProviderInterface
    {
        return $this->userManager->getProvider();
    }

    public function getUserManager(): \Psi\UserBundle\Manager\UserManagerInterface
    {
        return $this->userManager;
    }

    public function newUser($username, $email, $password): \Symfony\Component\Security\Core\User\UserInterface
    {
        return $this->userManager->newUser($username, $email, $password);
    }

    public function saveUser(\Symfony\Component\Security\Core\User\UserInterface $user)
    {
        return $this->userManager->saveUser($user);
    }

    public function updatePassword(\Symfony\Component\Security\Core\User\UserInterface $user, $password)
    {
        return $this->userManager->updatePassword($user, $password);
    }

    public function validateCredentials($email, $password)
    {
        return $this->userManager->validateCredentials($email, $password);
    }

    public function hasAdminPrivileges(\Symfony\Component\Security\Core\User\UserInterface $user)
    {
        foreach ($user->getRoles() as $role) {
            if ($role->getName() == "ROLE_ADMIN") {
                return true;
            }
        }

        return false;
    }
}
