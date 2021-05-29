<?php
// Stefan Erakovic 3086/2016
namespace Psi\UserBundle\Manager;

use Doctrine\ORM\EntityManager;
use Psi\UserBundle\Manager\AccessTokenManagerInterface;
use Psi\UserBundle\Entity\AccessToken;
use Psi\UserBundle\Entity\User;
use Psi\UserBundle\Model\TokenStatus;

class AccessTokenManager implements AccessTokenManagerInterface
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Updates states of all expired tokens
     */
    public function expireTokens()
    {
        $query = $this->entityManager->createQuery('UPDATE PsiUserBundle:AccessToken t SET t.state = :state WHERE t.expires < CURRENT_DATE()');
        $query->setParameter('state', TokenStatus::STATUS_EXPIRED);
        $query->execute();
    }

    public function tokenExists($token)
    {
        // expire tokens first
        $this->expireTokens();

        $repository = $this->entityManager->getRepository(AccessToken::class);
        $result = $repository->findOneBy([
            'token' => $token,
            'state' => TokenStatus::STATUS_VALID,
        ]);
        return $result;
    }

    /**
     * @return AccessToken
     */
    public function newToken()
    {
        $accessToken = new AccessToken();
        $token = md5(rand(0, 100000) + time());

        // wait for unique token
        while ($this->tokenExists($token)) {
            $token = md5(rand(0, 100000) + time());
        }
        $accessToken->setToken($token);

        return $accessToken;
    }
}
