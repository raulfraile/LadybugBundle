<?php

namespace RaulFraile\Bundle\LadybugBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;

/**
 * The AbstractCommand class.
 */
abstract class AbstractCommand extends ContainerAwareCommand
{
    /**
     * @param OutputInterface $output toot
     * @param type            $lines  toto
     * @param type            $color  toto
     */
    protected function addMessage(OutputInterface $output, $lines, $color)
    {
        // look for the longest line
        $longestLine = 0;
        foreach ($lines as $l) {
            $len = strlen($l);
            if ($len > $longestLine) {
                $longestLine = $len;
            }
        }

        // show message
        $output->writeln(' ');
        $output->writeln(sprintf('<%s> %s </%s>', $color, str_repeat(' ', $longestLine), $color));
        foreach ($lines as $l) {
            $output->writeln(sprintf('<%s> %s </%s>', $color, $l. str_repeat(' ', $longestLine - strlen($l)), $color));
        }
        $output->writeln(sprintf('<%s> %s </%s>', $color, str_repeat(' ', $longestLine), $color));
        $output->writeln(' ');
    }
}