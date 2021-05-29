<?php
// Viktor Galindo - 655/2013
namespace Psi\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Psi\UserBundle\Entity\Role;
use Psi\UserBundle\Manager\UserManager;

class LoadUserRoles implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {

        if (!$manager->getRepository(Role::class)->findOneBy(['name' => UserManager::AUTHENTHICATED_ROLE])) {
            $authenthicatedUser = new Role();
            $authenthicatedUser->setName(UserManager::AUTHENTHICATED_ROLE);
            $manager->persist($authenthicatedUser);
        }

        if (!$manager->getRepository(Role::class)->findOneBy(['name' => UserManager::ADMIN_ROLE])) {
            $adminUser = new Role();
            $adminUser->setName(UserManager::ADMIN_ROLE);
            $manager->persist($adminUser);
        }

        $manager->flush();
    }
}
