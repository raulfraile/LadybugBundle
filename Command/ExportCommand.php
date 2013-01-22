<?php
namespace RaulFraile\Bundle\LadybugBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;

/**
 * The export CLI command.
 */
class ExportCommand extends AbstractCommand
{
    /**
     * Configure the command.
     */
    protected function configure()
    {
        $this
            ->setName('ladybug:export')
            ->setDescription('Exports info of a class using Ladybug')
            ->addArgument('class', InputArgument::REQUIRED, 'Class name, "Symfony\Component\HttpFoundation\Request" for instance')
            ->addArgument('target', InputArgument::REQUIRED, 'Path to save the data')
            ->addOption('format', null, InputOption::VALUE_OPTIONAL, 'Format: yaml, xml or json', 'yaml');
    }

    /**
     * Executes the command.
     *
     * @param InputInterface  $input  The input
     * @param OutputInterface $output The output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $class  = $input->getArgument('class');
        $target = $input->getArgument('target');
        $format = $input->getOption('format');

        if (class_exists($class)) {
            $obj = new $class;

            $data = ladybug_dump_return($format, $obj);

            if (@file_put_contents($target, $data) === false) {
                $lines = array(
                    '[Invalid Target]',
                    'Export file could not be saved in "' . $target . '". '
                );

                $this->addMessage($output, $lines, 'error');
            } else {
                $lines = array(
                    'Object "' . $class . '" succesfully exported in "' . $target . '". '
                );

                $this->addMessage($output, $lines, 'info');
            }
        } else {
            $lines = array(
                '[Invalid Class]',
                'Class "' . $class . '" not found. '
            );

            $this->addMessage($output, $lines, 'error');
        }
    }
}