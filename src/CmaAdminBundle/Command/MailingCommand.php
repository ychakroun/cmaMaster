<?php

namespace CmaAdminBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Container;

class MailingCommand extends Command
{
    protected $em;
    protected $container;

    public function setEntityManager(ObjectManager $em)
    {
        $this->em = $em;
    }

    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    protected function configure()
    {
        $this->setName('mailing:run')
             ->setDescription('Send newsletter\'s mails');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $repository         = $this->em->getRepository('CmaAdminBundle:Newsletter');
        /** @var \CmaAdminBundle\Entity\Newsletter $newsletter */
        $newsletter         = $repository->findOneBy(['finished' => 0]);
        $repository         = $this->em->getRepository('CmaUserBundle:User');
        $users              = $repository->getNewsletterUsers($newsletter->getOffset());
        if($users) {
            $mailer     = $this->container->get('mailer');
            $message    = \Swift_Message::newInstance()
                ->setSubject($newsletter->getSubject())
                ->setFrom('no-reply@cma.com', 'Custom my art')
                ->setContentType('text/html')
                ->setBody($newsletter->getContent(),'text/html');
                foreach($users as $user) {
                    $message->setTo($user->getEmail());
                    $mailer->send($message);
                }
            $newsletter->setOffset($newsletter->getOffset() + 100);
            $this->em->persist($newsletter);
            $this->em->flush();
            $output->writeln('Mails envoyer');
        } else {
            $output->writeln('Aucun mail');
        }
    }
}