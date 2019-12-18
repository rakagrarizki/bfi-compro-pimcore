<?php
namespace AppBundle\EventListener;

use Pimcore\Bundle\EcommerceFrameworkBundle\IndexService\Worker\ElasticSearch\DefaultElasticSearch5;
use Pimcore\Event\Model\ElementEventInterface;
use Pimcore\Event\Model\DataObjectEvent;
use Pimcore\Event\Model\DocumentEvent;
use Pimcore\Model\Document;
use Pimcore\Model\Document\Page;
use AppBundle\Tool\Text;
use AppBundle\Tool\Elastic;
use Pimcore\Model\DataObject\BlogArticle;
use Pimcore\Model\DataObject\BlogCategory;
use Pimcore\Model\DataObject\News;
use Pimcore\Model\DataObject\NewsCategory;
use Pimcore\Tool;



class ElasticListener {
    public function onObjectPostUpdate (ElementEventInterface $e) {
        $data = [];
        if ($e instanceof DataObjectEvent){
            $object = $e->getObject();
            $data['path'] = $object->getFullPath();

            if($object instanceof News){
                $index = "news";
                $data = $this->getData($object);
                $elastic = Elastic::addToIndex($index, $object->getId(),$data);
            }
            if ($object instanceof BlogArticle){
                $index = "blog";
                $data = $this->getData($object);
                $elastic = Elastic::addToIndex($index, $object->getId(),$data);
            }



        }
    }

    public function onDocumentPostUpdate(ElementEventInterface $e) {
        $data = [];
        //$index = "document";
        $index ="";
        if($e instanceof DocumentEvent){
            $document = $e->getDocument();
            if(!$document instanceof Document\Snippet && !$document instanceof Document\Link ){

                if($document instanceof Page){
                    $content = '';
                    foreach($document->getElements()  as $element){
                        if($element instanceof \Pimcore\Model\Document\Tag\Textarea){
                            if($element->getValue() != null){
                                $input = Text::getStringAsOneLine(strip_tags($element->getValue()));
                                $content .= $input . ' ';
                            }
                        }
                        elseif($element instanceof \Pimcore\Model\Document\Tag\Input){
                            if($element->getValue() != null ){
                                $input = $element->getValue();
                                $content .= $input . ' ';
                            }
                        }
                        elseif ($element instanceof \Pimcore\Model\Document\Tag\Wysiwyg) {
                            if($element->getValue() !=  null) {
                                $input = Text::getStringAsOneLine(strip_tags($element->getValue()));
                                $content .= $input . ' ';
                            }
                        }
                    }
                    //$index =$document->();
                    $index = "document_".$document->getProperty("language");

    //                $data['parentid'] = $document->getParentId();
    //                $data['grandparentid'] = $grandParent;

                    $data['Title'] = $document->getTitle();
                    $data["Description"] = $document->getDescription();
                    //$data["Tag"] = $document->getProperty("tag");
                    $data['ContentDetail'] = $content;
                    $data['url'] = $document->getFullPath();

                }
                $elastic = Elastic::addToIndex($index,$document->getId(),$data);
            }
        }

    }

    function getData($object){
//        foreach($object->getLocalizedfields()->getItems() as $lang => $fields){
//            foreach($fields as $key=> $val){
//                $data[$key.'_'.$lang] = strip_tags($val);
//            }
//        }
//        return $data;
        $validLanguages = Tool::getValidLanguages();
//var_dump($validLanguages);exit;
        foreach($validLanguages as $lang){
            //foreach($object->getObject() as $key=> $val){
            $data['Title_'.$lang] = strip_tags($object->getTitle($lang));
            $data['Content_'.$lang] = strip_tags($object->getContent($lang));

            // }
        }
        return $data;

    }

}
