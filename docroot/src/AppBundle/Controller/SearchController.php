<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Pimcore\Model\WebsiteSetting;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Elasticsearch;
use ONGR\ElasticsearchDSL\Query\Compound\BoolQuery;
use ONGR\ElasticsearchDSL\Query\FullText\MatchQuery;
use ONGR\ElasticsearchDSL\Query\FullText\MatchPhraseQuery;
use ONGR\ElasticsearchDSL\Query\TermLevel\TypeQuery;
use ONGR\ElasticsearchDSL\Sort;
use ONGR\ElasticsearchDSL\Search;
use ONGR\ElasticsearchDSL\BuilderInterface;
use Pimcore\Event\Model\ElementEventInterface;
use Pimcore\Model\DataObject;
use Pimcore\Model\Document;
use Zend\Paginator\Adapter\Callback;
use Zend\Paginator\Paginator;


class SearchController extends FrontendController
{
    /**
     * @Route("/search")
    @Method({"GET","POST"})

     */
    public function defaultAction(Request $request)
    {
        $queryString = htmlentities($request->get("q"));
        $page = htmlentities($request->get("page",1));
        $lang = $request->getLocale();
        //$lang = htmlentities($request->get("lang"));


        //$cse = WebsiteSetting::getByName("cse")->getData();


      /*  if (!empty($queryString)) {
            $page = (int)$request->get('page', 1);
            $perPage = 10;
            $result = \Pimcore\Google\Cse::search($queryString, (($page - 1) * $perPage), null, [
                'cx' => $cse
            ], $request->get('facet'));

            $paginator = new Paginator($result);
            $paginator->setCurrentPageNumber($page);
            $paginator->setItemCountPerPage($perPage);
            $this->view->queryString = $queryString;
            $this->view->paginator   = $paginator;
            $this->view->result      = $result;
        }*/

        if(!empty($queryString)){
            $document = $this->searchDocument("document",$lang, $queryString, $page);
            //$object = $this->searchObject("document",$lang, $queryString,$page);

            $this->view->queryString = $queryString;
            $this->view->page = $page;
            $this->view->totalResult = $document['totalItem'];
            $this->view->totalPage = $document["totalPage"];
            //dump($document);exit;
            $this->view->paginator = $document;

//            $paginator = new Paginator($document);
//            $paginator->setCurrentPageNumber($page);
//            $paginator->setItemCountPerPage(3);
//            $this->view->paginator = $paginator;
            //dump($document);exit;
        }

//        $this->view->blog = $blog;
//        $this->view->news = $news;

    }

    public function searchDocument($index,$lang, $query, $page){
        $itemsPerPage = 10;
        $offset = ($page - 1) * $itemsPerPage;

        $params = [
            'size' => $itemsPerPage,
            'from' => $offset,
            'index' => $index,
            'type' => '_doc',
            'body' => [
                'query' => [
                    'bool' => [
                        'should' =>[
                            'multi_match' => [
                                'query' => $query,
                                'fields' => ["Title_".$lang, "Body_".$lang],
                                'minimum_should_match' => "50%"

                            ],

                        ]


                    ]
                ]


            ]
        ];


        if(ENV != "staging"){
            $client = Elasticsearch\ClientBuilder::create()->setHosts(ELASTICHOST)->build();
        }
        else{
            $client = Elasticsearch\ClientBuilder::create()->setSSLVerification(false)->setHosts(ELASTICHOST)->build();
        }

        $resultRaw = $client->search($params);
        $results = $resultRaw['hits']['hits'];
//        $adapter = new Callback(
//            function ($offset, $itemsPerPage) use ($resultRaw){
//                $return = [];
//                foreach ($results as $hit){
//                    $return[] = new Hal\Entity($hit["_source"]);
//                }
//                return $return;
//            },
//            function () use ($resultRaw){
//                return $return["hits"]["total"];
//            }
//        );
//        $paginator = new Paginator($adapter);
//        $paginator->setItemCountPerPage($itemsPerPage);
//        $paginator->setCurrentPageNumber($page);

//        $hal = new Hal\Collection();
//        $hal->setCollectionName("listing");


        $pagination['items'] = $results;

        $pagination['totalPage'] = (integer)ceil($resultRaw['hits']['total'] / $itemsPerPage);
        $pagination['totalItem'] = $resultRaw['hits']['total'];
        return $pagination;
    }

    public function searchObject($index,$query,$page,$lang){
        $itemsPerPage = 3;
        $offset = ((int)$page - 1) * $itemsPerPage;
        $index = ["index" => $index];
        $params = [
            'index' => $index,
            'type' => '_doc',
            'body' => [
                'query' => [
                    'bool' => [
                        'should' =>[
                            'multi_match' => [
                                'query' => $query,
                                'fields' => ["Title_".$lang, "Body_".$lang],
                                'minimum_should_match' => "50%"

                            ],

                        ]


                    ]

                ],

            ]
        ];

        if(ENV != "staging"){
            $client = Elasticsearch\ClientBuilder::create()->setHosts(ELASTICHOST)->build();
        }
        else{
            $client = Elasticsearch\ClientBuilder::create()->setSSLVerification(false)->setHosts(ELASTICHOST)->build();
        }

        $bool = $client->indices()->exists($index);
        if($bool){
            $resultRaw = $client->search($params);


            $results = $this->arrayToObjects($resultRaw['hits']['hits']);

            $pagination['items'] = $results;
            $pagination['totalPage'] = (integer)ceil($resultRaw['hits']['total'] / $itemsPerPage);
            $pagination['totalItem'] = $resultRaw['hits']['total'];
            return $pagination;
        }
        else {
            //throw new \Exception("Index Not Exists");
        }



    }

    public function arrayToObjects($hits){
        $ret = [];
        foreach($hits as $result){
            $id = $result['_id'];
            $ret[] = DataObject::getById($id);
        }

        return $ret;
    }
}
