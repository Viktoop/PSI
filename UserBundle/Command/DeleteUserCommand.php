<?php
// Viktor Galindo - 655/2013
namespace Psi\UserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class DeleteUserCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('psi:user:delete')
            ->setDescription('Deletes a user by id.');

        $this
            ->addArgument('id', InputArgument::REQUIRED, 'User id.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $userId = $input->getArgument('id');
        $manager = $this->getContainer()->get('psi.user.manager');
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        if ($user = $manager->findUser(['id' => $userId])) {
            $manager->deleteUser($user);
            $output->writeln('User deleted');
        }
    }
}
