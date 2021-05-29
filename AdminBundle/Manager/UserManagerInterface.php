<?php
namespace Psi\AdminBundle\Manager;

use Psi\UserBundle\Manager\UserManagerInterface as BaseUserManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface UserManagerInterface extends BaseUserManagerInterface
{
    
    /**
     * Returns underlying user manager
     * @return \Psi\UserBundle\Manager\UserManagerInterface
     */
    public function getUserManager();
    
    /**
     * 
     * @param UserInterface $user
     * @return bool
     */
    public function hasAdminPrivileges(UserInterface $user);
    
}
