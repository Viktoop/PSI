<?php
// Nemanja Djokic - 496/2013
namespace Psi\UserBundle\Manager;

use Psi\UserBundle\Entity\User;
use Psi\UserBundle\Entity\AccessToken;

interface AccessTokenManagerInterface
{

    /**
     * Creates a new unique valid token
     * @return AccessToken
     */
    public function newToken();

    /**
     * Checks if a valid token with value $token exists
     * @param string
     * @return AccessToken|null
     */
    public function tokenExists($token);

    /**
     * Expires all old tokens
     */
    public function expireTokens();
}
