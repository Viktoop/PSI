<?php
// Stefan Erakovic 3086/2016
namespace Psi\UserBundle\Manager;

use Psi\UserBundle\Manager\UserManagerInterface;
use Psi\UserBundle\Provider\ObjectManagerAwareUserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Psi\UserBundle\Model\UserStatus;
use Psi\UserBundle\Entity\AccessToken;
use Psi\UserBundle\Model\TokenStatus;
use Psi\UserBundle\Manager\AccessTokenManagerInterface;

class UserManager implements UserManagerInterface
{

    const AUTHENTHICATED_ROLE = "IS_AUTHENTICATED_FULLY";
    const ADMIN_ROLE = "ROLE_ADMIN";

    /**
     *
     * @var ObjectManagerAwareUserProviderInterface
     */
    private $provider;

    /**
     *
     * @var EncoderFactoryInterface 
     */
    private $encoderFactory;

    /**
     *
     * @var AccessTokenManagerInterface
     */
    private $tokenManager;

    public function __construct(
    ObjectManagerAwareUserProviderInterface $provider, EncoderFactoryInterface $encoderFactory, AccessTokenManagerInterface $tokenManager)
    {
        $this->provider = $provider;
        $this->encoderFactory = $encoderFactory;
        $this->tokenManager = $tokenManager;
    }

    public function deleteUser(UserInterface $user)
    {
        $model = $this->provider->getEntityUserModel($user);
        if ($model) {
            $manager = $this->provider->getObjectManager();
            $entity = $model->getEntity();
            $entity->setConfirmationToken(null);
            $entity->setResetToken(null);
            $manager->persist($entity);
            $manager->remove($entity);
            $manager->flush();
            unset($model);
            return true;
        }
    }

    public function findUser($criteria)
    {
        $userClass = $this->provider->getUserClass();
        $entity = $this->provider->getUserRepository()->findOneBy($criteria);
        if ($entity) {
            return new $userClass($entity);
        }
        return null;
    }

    public function getProvider(): ObjectManagerAwareUserProviderInterface
    {
        return $this->provider;
    }

    public function newUser($username, $email, $password): UserInterface
    {

        if ($this->findUser(['email' => $email])) {
            throw new \Exception("User with specified email allready exists [$email].");
        }


        $user = $this->provider->createEntityUserModel($username, $email);

        //$user->getEntity()->addRole();
        $user->getEntity()->setStatus(UserStatus::STATUS_DISABLED);
        $this->updatePassword($user, $password);
        $confirmationToken = $this->generateAccessToken($user->getEntity());
        $user->getEntity()->setConfirmationToken($confirmationToken);
        $this->saveUser($user);

        return $user;
    }

    public function saveUser(UserInterface $user)
    {

        $model = $this->provider->getEntityUserModel($user);
        if ($model) {
            $entity = $model->getEntity();
            $this->provider->getObjectManager()->persist($entity);
            $this->provider->getObjectManager()->flush();
            return true;
        }
        return false;
    }

    public function updatePassword(UserInterface $user, $password)
    {
        $model = $this->provider->getEntityUserModel($user);
        if ($model) {
            $encoder = $this->encoderFactory->getEncoder($model->getEntity());
            $salt = time();
            $encodedPassword = $encoder->encodePassword($password, $salt);

            $model->updatePassword($encodedPassword, $salt);
            $this->saveUser($model);
        }
    }

    public function generateAccessToken($userEntity)
    {
        $accessToken = $this->tokenManager->newToken();
        $expires = new \DateTime();
        $expires->setTimestamp(time() + 3600 * 24);
        $accessToken->setExpires($expires);
        $accessToken->setUser($userEntity);
        $accessToken->setState(TokenStatus::STATUS_VALID);
        $this->provider->getObjectManager()->persist($accessToken);
        return $accessToken;
    }

    public function validateCredentials($email, $password)
    {
        $user = $this->findUser(['email' => $email, 'status' => UserStatus::STATUS_ENABLED]);

        if ($user) {
            $model = $this->provider->getEntityUserModel($user);
            $encoder = $this->encoderFactory->getEncoder($model->getEntity());
            $salt = $model->getSalt();

            if ($encoder->isPasswordValid($model->getPassword(), $password, $salt)) {
                return $model;
            }
        }

        return false;
    }
}
