<?php

namespace AppBundle\Tool;
use Elasticsearch;
use Pimcore\Event\Model\ElementEventInterface;

class Elastic
{

   public static function addToIndex($index,$id,$data){
        if(ENV != "staging"){
            $client = Elasticsearch\ClientBuilder::create()->setHosts(ELASTICHOST)->build();
        }
        else{
            $client = Elasticsearch\ClientBuilder::create()->setSSLVerification(false)->setHosts(ELASTICHOST)->build();
        }



       $params = [
           'index' => $index,
           'type' => '_doc',
           'id' =>$id,
           'body' => $data,
       ];
       $response = $client->index($params);
       return $response;


   }
   public static function getIndex($index, $type, $id){
       $client = Elasticsearch\ClientBuilder::create()->build();
       $params = [
           'index' => $index,
           'type' => '_doc',
           'id' => $id
       ];
       $response = $client->get($params);
   }

   public static function getSource($index, $type, $id){
       $client = Elasticsearch\ClientBuilder::create()->build();
       $params = [
           'index' => $index,
           'type' => $type,
           'id' => $id
       ];
       $response = $client->getSource($params);
   }

   public static function deleteIndex($index){
       $client = Elasticsearch\ClientBuilder::create()->build();
       $deleteParams = [
           'index' => $index,
       ];
       $response = $client->indices()->delete($deleteParams);
       return $response;
   }
   public static function deleteDocument($index,$type,$id){
       $client = Elasticsearch\ClientBuilder::create()->build();
       $params = [
           'index' => $index,
           'type' => $type,
           'id' => $id
       ];
       $response = $client->delete($params);
       return $response;
   }


}