<?php
// Nemanja Djokic - 496/2013
namespace Psi\UserBundle\Model;

use Psi\UserBundle\Model\StatusRegistry;

class TokenStatus extends StatusRegistry
{

    const STATUS_EXPIRED = "expired";
    const STATUS_VALID = "valid";
    const STATUS_INVALID = "invalid";

    public function __construct()
    {
        parent::__construct();
        $this->addStatus(self::STATUS_EXPIRED, "Disabled");
        $this->addStatus(self::STATUS_VALID, "Enabled");
        $this->addStatus(self::STATUS_INVALID, "Enabled");
    }
}
