<?php
// Stefan Erakovic 3086/2016
namespace Psi\UserBundle\Model;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Psi\UserBundle\Model\UserStatus;

class User implements AdvancedUserInterface, EntityUserInterface, EquatableInterface
{

    /**
     * @var \Psi\UserBundle\Entity\User
     */
    private $entity;

    /**
     * @var string
     */
    private $entityClass;

    public function __construct(\Psi\UserBundle\Entity\User $entity)
    {
        $this->entity = $entity;
        $this->entityClass = get_class($entity);
    }

    public function eraseCredentials()
    {
        /* @todo */
    }

    public function getId()
    {
        return $this->entity->getId();
    }

    public function getPassword(): string
    {
        return $this->entity->getPassword();
    }

    public function getRoles()
    {
        return $this->entity->getRoles();
    }

    public function getSalt()
    {
        return $this->entity->getSalt();
    }

    public function getUsername(): string
    {
        return $this->entity->getEmail();
    }

    public function getEmail(): string
    {
        return $this->entity->getEmail();
    }

    public function getStatus(): string
    {
        return $this->entity->getStatus();
    }

    public function isAccountNonExpired(): bool
    {
        return true;
    }

    public function isAccountNonLocked(): bool
    {
        return ($this->entity->getStatus() !== UserStatus::STATUS_DISABLED);
    }

    public function isCredentialsNonExpired(): bool
    {
        return false;
    }

    public function isEnabled(): bool
    {
        return $this->isAccountNonLocked();
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function getEntityClass(): string
    {
        return $this->entityClass;
    }

    public function updatePassword($password, $salt)
    {
        $this->entity->setPassword($password);
        $this->entity->setSalt($salt);
        return $this;
    }

    public function isEqualTo(\Symfony\Component\Security\Core\User\UserInterface $user): bool
    {
        return $this->getUsername() == $user->getUsername();
    }
}
