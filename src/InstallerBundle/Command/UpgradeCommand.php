<?php
/* For licensing terms, see /license.txt */

namespace Chamilo\InstallerBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

use Chamilo\InstallerBundle\CommandExecutor;

/**
 * Class UpgradeCommand
 * * Based in OroInstallBundlePlatformUpdateCommand
 * @package Chamilo\InstallerBundle\Command
 */
class UpgradeCommand extends ContainerAwareCommand
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('chamilo:platform:update')
            ->setDescription(
                'Execute platform application update commands and init platform assets.'
            )
            ->addOption(
                'force',
                null,
                InputOption::VALUE_NONE,
                'Forces operation to be executed.'
            )
            ->addOption(
                'timeout',
                null,
                InputOption::VALUE_OPTIONAL,
                'Timeout for child command execution',
                300
            );
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $force = $input->getOption('force');

        if ($force) {
            $commandExecutor = new CommandExecutor(
                $input->hasOption('env') ? $input->getOption('env') : null,
                $output,
                $this->getApplication()
            );
            $commandExecutor->setDefaultTimeout($input->getOption('timeout'));

            $commandExecutor
                // Load migrations
                ->runCommand(
                    'oro:migration:load',
                    array('--force' => true)
                )
                // Load data migrations
                ->runCommand(
                    'oro:migration:data:load',
                    array(
                        '--no-interaction' => true,
                    )
                )
            ;
        } else {
            $output->writeln(
                '<comment>ATTENTION</comment>: Database backup is highly recommended before executing this command.'
            );
            $output->writeln(
                '           Please make sure that application cache is up-to-date before run this command.'
            );
            $output->writeln(
                '           Use <info>cache:clear</info> if needed.'
            );
            $output->writeln('');
            $output->writeln(
                'To force execution run command with <info>--force</info> option:'
            );
            $output->writeln(
                sprintf('    <info>%s --force</info>', $this->getName())
            );
        }
    }
}
