<?php

namespace AppBundle\Command;

use AppBundle\Tool\Elastic;
use AppBundle\Tool\Text;
use Pimcore\Console\AbstractCommand;
use Pimcore\Console\Dumper;
use Pimcore\Tool;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Pimcore\Model\DataObject;
use Pimcore\Model\Document;
use Pimcore\Model\Document\Page;

class ReindexObjectCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('elasticsearch:reindexobject')
//            ->addOption('object',
//                "o",
//                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
//                "which object do you like to reindex?",
//                ["all","news","blog"])
            ->setDescription('Elastic search ReIndex Object');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
      // $option = $input->getOption("object");

//        if($option[0] == "news"){
//            $this->insertNews();
//        } elseif ($option[0] == "blog"){
//            $this->insertBlog();
//        } else {

            $this->insertNews();
            $this->insertBlog();

        //}
    }

    public function getData($object){
//        $config = Tool::getValidLanguages();
//        $validLanguages = strval($config->general->validLanguages);
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
            $data['Body_'.$lang] = strip_tags($object->getContent($lang));
            if($object->getClassName() == "News"){
                $url = '/'.$lang.'/news/'.$object->getSlug();
                $data['url'] = $url;
            }else{
                $url = '/'.$lang.'/blog/'.$object->getSlug();
                $data['url'] = $url;
            }
            // }
        }
        return $data;

    }


    public function insertNews(){
        $news = new DataObject\News\Listing();
        $news->load();
        $index = "document";
        //$this->dump($promos);
        foreach($news as $key => $value){
            $data = $this->getData($value);
            if(Elastic::addToIndex($index,$value->getId(),$data)){
                $this->dump($value->getId().' success to reindex');
            }

        }
    }

    public function insertBlog(){

        $article = new DataObject\BlogArticle\Listing();
        $article->load();
        $index = "document";
        //$this->dump($promos);
        foreach($article as $key => $value){
            $data = $this->getData($value);
            if(Elastic::addToIndex($index,$value->getId(),$data)){
                $this->dump($value->getId().' success to reindex');
            }

        }
    }



}
