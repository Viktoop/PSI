<?php
// Nemanja Djokic - 496/2013
namespace Psi\UserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class UpdatePasswordCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('psi:user:password')
            ->setDescription('Changes a user password by Id.');

        $this
            ->addArgument('id', InputArgument::REQUIRED, 'User id.')
            ->addArgument('password', InputArgument::REQUIRED, 'New password.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $userId = $input->getArgument('id');
        $password = $input->getArgument('password');
        $manager = $this->getContainer()->get('psi.user.manager');

        if ($user = $manager->findUser(['id' => $userId])) {
            $manager->updatePassword($user, $password);
            $output->writeln('User password updated');
        }
    }
}
