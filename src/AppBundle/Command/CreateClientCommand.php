<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateClientCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('acme:oauth-server:client:create')
            ->setDescription('Creates a new client')
            ->addOption(
                'grant-type',
                null,
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
                'Sets allowed grant type for client. Use this option multiple times to set multiple grant types..',
                null
            )
            ->setHelp(
                <<<EOT
                    The <info>%command.name%</info>command creates a new client.
<info>php %command.full_name% [--redirect-uri=...] [--grant-type=...] name</info>
EOT
            );
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $clientManager = $this->getContainer()->get('fos_oauth_server.client_manager.default');
        $client = $clientManager->createClient();
        $client->setAllowedGrantTypes($input->getOption('grant-type'));
        $clientManager->updateClient($client);
        $output->writeln(
            sprintf(
                'Added a new client with public id <info>%s</info>, secret <info>%s</info>',
                $client->getPublicId(),
                $client->getSecret()
            )
        );
    }
}