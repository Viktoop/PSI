<?php
// Nemanja Djokic - 496/2013
namespace Psi\UserBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Psi\UserBundle\Model\TokenStatus;

class AccessTokenRepository extends EntityRepository
{

    public function findAllExpiredTokens()
    {
        return $this->getEntityManager()
                ->createQuery(
                    'SELECT t FROM UserBundle:AccessToken t WHERE t.expires < CURRENT_DATE()'
                )
                ->getResult();
    }


}
