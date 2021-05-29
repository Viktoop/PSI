<?php
// Stefan Erakovic 3086/2016
namespace Psi\UserBundle\Provider;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\User\UserInterface;
use Psi\UserBundle\Model\EntityUserInterface;
use Doctrine\Common\Persistence\ObjectRepository;

interface ObjectManagerAwareUserProviderInterface
{

    /**
     * Returns ObjectManager instance
     * @return ObjectManager
     */
    public function getObjectManager(): ObjectManager;

    /**
     * Returns whether the provider supports the user class
     * @param string
     * @return bool
     */
    public function supports($class): bool;

    /**
     * Returns the class of the provided user model
     * @return string
     */
    public function getUserClass();

    /**
     * Loads a user model with an underlying entity
     * @param UserInterface $user
     * @return EntityUserInterface
     */
    public function getEntityUserModel(UserInterface $user);

    /**
     * Returns entity class name of the underlying entity in user model
     * @return string
     */
    public function getEntityClass();

    /**
     * Returns a new user model with a new underlying entity
     * The user model isn't yet persisted to the database, only filled
     * @param string $username
     * @param string $email
     * @return EntityUserInterface
     */
    public function createEntityUserModel($username, $email);

    /**
     * Returns underlying user entity repository
     * @return ObjectRepository
     */
    public function getUserRepository();
}
