<?php
namespace Psi\UserBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

interface EntityUserInterface extends UserInterface
{

    /**
     * Returns underlying entity object
     */
    public function getEntity();

    /**
     * @return string
     */
    public function getEntityClass();

    /**
     * Updates user password & salt
     * @param string $password
     * @param string $salt
     * @return EntityUserInterface
     */
    public function updatePassword($password, $salt);
}
