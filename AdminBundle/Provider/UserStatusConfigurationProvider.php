<?php
namespace Psi\AdminBundle\Provider;

use Psi\ConfigurationBundle\Provider\ConfigurationOptionProviderInterface;
use Psi\UserBundle\Model\UserStatus;

class UserStatusConfigurationProvider implements ConfigurationOptionProviderInterface
{

    /**
     * @var UserStatus
     */
    private $registry;

    public function __construct(UserStatus $registry)
    {
        $this->registry = $registry;
    }

    public function getOptions(): array
    {
        $statuses = $this->registry->getStatuses();
        foreach($statuses as $index => $status) {
            $statuses[$index]['value'] = $status['code'];
        }
        return $statuses;
    }
}
