<?php

namespace AppBundle\Command;

use AppBundle\Tool\Elastic;
use AppBundle\Tool\Text;
use Pimcore\Console\AbstractCommand;
use Pimcore\Console\Dumper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Pimcore\Model\DataObject;
use Pimcore\Model\Document;
use Pimcore\Model\Document\Page;


class RemoveIndexCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('elasticsearch:removeIndex')
//           ->addArgument('index', InputArgument::REQUIRED, 'What index do you want to delete?')
            ->setDescription('Elastic search ReIndex Object');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
       $index = "document";
       $elastic = Elastic::deleteIndex($index);
       if($elastic){
           $output->writeln("Success Deleted Index");
       }
    }



}
