<?php
namespace RaulFraile\Bundle\LadybugBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;

/**
 * Class for AbstractCommand
 */
class DumpCommand extends AbstractCommand
{
    /**
     * Configure the command.
     */
    protected function configure()
    {
        $this
            ->setName('ladybug:dump')
            ->setDescription('Displays info of a class using Ladybug')
            ->addArgument('class', InputArgument::REQUIRED, 'Class name, "Symfony\Component\HttpFoundation\Request" for instance')
            ->addOption('all', null, InputOption::VALUE_NONE, 'Show object data, class constants, class info, public properties and methods');
    }

    /**
     * Executes the command.
     *
     * @param InputInterface  $input  The input
     * @param OutputInterface $output The output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $class = $input->getArgument('class');

        if (class_exists($class)) {
            $obj = new $class;

            // configure ladybug
            if ($input->getOption('all')) {
                ladybug_set('object.show_data', true);
                ladybug_set('object.show_classinfo', true);
                ladybug_set('object.show_constants', true);
                ladybug_set('object.show_methods', true);
                ladybug_set('object.show_properties', true);
            } else {
                ladybug_set('object.show_data', true);
                ladybug_set('object.show_classinfo', false);
                ladybug_set('object.show_constants', false);
                ladybug_set('object.show_methods', true);
                ladybug_set('object.show_properties', true);
            }
            ladybug_set('object.max_nesting_level', 2);

            ladybug_dump($obj);
        } else {
            $lines = array(
                '[Invalid Class]',
                'Class "' . $class . '" not found. '
            );

            $this->addMessage($output, $lines, 'error');
        }
    }
}