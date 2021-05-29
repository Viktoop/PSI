<?php
// Viktor Galindo - 655/2013
namespace Psi\UserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Psi\UserBundle\Entity\User;

class ListUserCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('psi:user:list')
            ->setDescription('List all users in the system.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $users = $em->getRepository(User::class)->findBy([]);

        $output->writeln("ID | Username | Email | Roles");
        foreach ($users as $user) {
            $roles = $user->getRoles();
            $_roles = [];
            foreach ($roles as $role) {
                $_roles[] = $role->getName();
            }
            $output->writeln($user->getId() . " | " . $user->getUsername() . " | " . $user->getEmail() . " | " . implode(',', $_roles));
        }
    }
}
