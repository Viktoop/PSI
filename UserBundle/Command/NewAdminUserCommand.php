<?php
// Stefan Erakovic 3086/2016
namespace Psi\UserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Psi\UserBundle\Entity\Role;
use Psi\UserBundle\Manager\UserManager;
use Psi\UserBundle\Model\UserStatus;

class NewAdminUserCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('psi:user:admin')
            ->setDescription('Creates a new admin user.')
            ->setHelp('This command allows you to create a user...');

        $this
            ->addArgument('email', InputArgument::REQUIRED, 'Admin user email.')
            ->addArgument('first_name', InputArgument::REQUIRED, 'Admin first name.')
            ->addArgument('last_name', InputArgument::REQUIRED, 'Admin last name.')
            ->addArgument('password', InputArgument::REQUIRED, 'Password.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $firstName = $input->getArgument('first_name');
        $lastName = $input->getArgument('last_name');
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        $username = $firstName . " " . $lastName;
        $manager = $this->getContainer()->get('psi.user.manager');
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $enabledStatus = $this->getContainer()->get('psi.user.model.user.status')->getStatusByCode(UserStatus::STATUS_ENABLED);
        $adminRole = $em->getRepository(Role::class)->findOneBy(['name' => UserManager::ADMIN_ROLE]);
        if (!$adminRole) {
            $this->get()->getContainer('psi.user.data.fixtures.orm.loadUserRoles')->load($em);
            $adminRole = $em->getRepository(Role::class)->findOneBy(['name' => UserManager::ADMIN_ROLE]);
        }
        $admin = $manager->newUser($username, $email, $password)->getEntity();
        $admin->addRole($adminRole);
        $admin->setStatus($enabledStatus['code']);
        $em->persist($admin);
        $em->flush();

        $output->writeln('New admin created: ' . $admin->getId());
    }
}
