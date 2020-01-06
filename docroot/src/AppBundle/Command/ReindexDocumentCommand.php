<?php

namespace AppBundle\Command;

use AppBundle\Tool\Elastic;
use AppBundle\Tool\Text;
use Pimcore\Console\AbstractCommand;
use Pimcore\Console\Dumper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pimcore\Model\DataObject;
use Pimcore\Model\Document;
use Pimcore\Model\Document\Page;

class ReindexDocumentCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('elasticsearch:reindexdocument')
            ->setDescription('Elastic search ReIndex Document');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $listing = new Document\Listing();

        foreach ($listing as $document){
            //$index = "document_".$element->getProperty("language");
            $index = "document";
//            if($element instanceof Document\Snippet) {
//                return;
//            }
//            if(!$document instanceof Page){
//                continue;
//            }
            if($document instanceof Page){
                $content = "";
                //$element = $document->getElements();
                foreach($document->getElements() as $element) {
                    if ($element instanceof \Pimcore\Model\Document\Tag\Textarea) {
                        if ($element->getValue() != null) {
                            $input = Text::getStringAsOneLine(strip_tags($element->getValue()));
                            $content .= $input . ' ';
                        }
                    } elseif ($element instanceof \Pimcore\Model\Document\Tag\Input) {
                        if ($element->getValue() != null) {
                            $input = $element->getValue();
                            $content .= $input . ' ';
                        }
                    } elseif ($element instanceof \Pimcore\Model\Document\Tag\Wysiwyg) {
                        if ($element->getValue() != null) {
                            $input = Text::getStringAsOneLine(strip_tags($element->getValue()));
                            $content .= $input . ' ';
                        }
                    }
                }
                $data['Title_'.$document->getProperty("language")] = $document->getTitle();
                $data['Body_'.$document->getProperty("language")] = $content;
                //$data["Description"] = $element->getDescription();
                //$data["Tag"] = $element->getProperty("tag");
                //$data['ContentDetail'] = $content;
                $data['url'] = $document->getFullPath();


                $elastic = Elastic::addToIndex($index,$document->getId(),$data);
                $this->dump("Id = ".$document->getId()." Has been Reindex");
            }


        }

    }
}
