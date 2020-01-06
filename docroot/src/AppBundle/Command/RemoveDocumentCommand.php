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


class RemoveDocumentCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('elasticsearch:removedocument')
//            ->addArgument('index', InputArgument::REQUIRED, 'What index do you want to delete?')
            ->addArgument('id', InputArgument::REQUIRED, 'What id do you want to delete?')
            ->setDescription('Elastic search ReIndex Object');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
       $index = "document_en";
       $type = '_doc';
       $id = $input->getArgument("id");
       $elastic = Elastic::deleteDocument($index,$type,$id);
       if($elastic){
           $output->writeln("Success Deleted Document");
       }
    }



}
