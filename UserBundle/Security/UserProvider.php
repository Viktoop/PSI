<?php
// Nemanja Djokic - 496/2013
namespace Psi\UserBundle\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Psi\UserBundle\Provider\ObjectManagerAwareUserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserProvider implements UserProviderInterface
{

    /**
     * Actual user provider implementation
     * @var ObjectManagerAwareUserProviderInterface 
     */
    protected $provider;

    public function __construct(ObjectManagerAwareUserProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    protected function getUserClass()
    {
        return $this->provider->getUserClass();
    }

    /**
     * Loads user by email (not username)
     * @param string $username
     * @return UserInterface
     * @throws UsernameNotFoundException
     */
    public function loadUserByUsername($username): UserInterface
    {
        $userClass = $this->provider->getUserClass();
        $entity = $this->getUserRepository()->findOneBy(['email' => $username]);

        if (!$entity) {
            throw new UsernameNotFoundException("User with email: $username doesn't exist.");
        }

        return new $userClass($entity);
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        $model = $this->provider->getEntityUserModel($user);
        if ($model) {
            return $model;
        }
        throw new UsernameNotFoundException("User with email: {$user->getEmail()} doesn't exist.");
    }

    public function supportsClass($class): bool
    {
        return $this->provider->supports($class);
    }
}
