<?php
namespace Psi\UserBundle\Manager;

use Psi\UserBundle\Provider\ObjectManagerAwareUserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface UserManagerInterface
{

    /**
     * Returns a new user, created from data supplied with default status/roles assigned
     * @return UserInterface
     */
    public function newUser($username, $email, $password);

    /**
     * 
     * @param mixed $criteria
     * @return UserInterface|null
     */
    public function findUser($criteria);

    /**
     * 
     * @param UserInterface $user
     */
    public function saveUser(UserInterface $user);

    /**
     * 
     * @param UserInterface $user
     * @param string $password
     */
    public function updatePassword(UserInterface $user, $password);

    /**
     * Deletes user by username, returns true if the user was deleted
     * @param UserInterface $user
     * @return boolean
     */
    public function deleteUser(UserInterface $user);

    /**
     * Returns provider
     * @return ObjectManagerAwareUserProviderInterface
     */
    public function getProvider();
    
    /**
     * Validates user credentials vs database user
     * @param string $email
     * @param string $password
     */
    public function validateCredentials($email, $password);
    
}
