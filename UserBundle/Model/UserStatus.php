<?php
// Viktor Galindo - 655/2013
namespace Psi\UserBundle\Model;

use Psi\UserBundle\Model\StatusRegistry;

class UserStatus extends StatusRegistry
{

    const STATUS_DISABLED = 'disabled';
    const STATUS_ENABLED = 'enabled';

    public function __construct()
    {
        parent::__construct();
        $this->addStatus(self::STATUS_DISABLED, "Disabled");
        $this->addStatus(self::STATUS_ENABLED, "Enabled");
    }
}
