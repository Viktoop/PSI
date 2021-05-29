<?php
// Stefan Erakovic 3086/2016

namespace Psi\UserBundle\Provider;

use Doctrine\Common\Persistence\ObjectManager;
use Psi\UserBundle\Model\EntityUserInterface;

class EntityUserProvider implements ObjectManagerAwareUserProviderInterface
{

    /**
     *
     * @var ObjectManager 
     */
    private $manager;

    /**
     *
     * @var string
     */
    private $userClass;

    /**
     *
     * @var string
     */
    private $entityClass;

    /**
     * 
     * @param string $userClass
     * @param ObjectManager $manager
     */
    public function __construct($userClass, $entityClass, \Doctrine\Common\Persistence\ObjectManager $manager)
    {
        $this->userClass = $userClass;
        $this->entityClass = $entityClass;
        $this->manager = $manager;

        if (!$this->supports($userClass)) {
            throw new \Exception("EntityUserProvider must provide objects that implement the EntityUserInterface.");
        }
        
        
    }

    /**
     * 
     * @return ObjectManager
     */
    public function getObjectManager(): \Doctrine\Common\Persistence\ObjectManager
    {
        return $this->manager;
    }

    public function supports($class): bool
    {
        return ($this->getUserClass() === $class || is_subclass_of($class, $this->getUserClass())) && (is_subclass_of($class, EntityUserInterface::class));
    }

    public function getUserClass(): string
    {
        return $this->userClass;
    }

    public function getEntityUserModel(\Symfony\Component\Security\Core\User\UserInterface $user): EntityUserInterface
    {
        // if passed user model is supported, no need to create a new model
        if ($this->supports(get_class($user))) {
            return $user;
        }

        $userClass = $this->getUserClass();
        $result = $this->getUserRepository()->findBy(['email' => $user->getEmail()]);
        if ($result) {
            return new $userClass($result);
        }
        return null;
    }

    public function getEntityClass(): string
    {
        return $this->entityClass;
    }

    public function createEntityUserModel($username, $email): EntityUserInterface
    {
        $entityClass = $this->getEntityClass();
        $modelClass = $this->getUserClass();
        $entity = new $entityClass();

        $entity->setUsername($username);
        $entity->setEmail($email);

        $model = new $modelClass($entity);
        return $model;
    }

    public function getUserRepository(): \Doctrine\Common\Persistence\ObjectRepository
    {
        return $this->getObjectManager()->getRepository($this->getEntityClass());
    }
}
