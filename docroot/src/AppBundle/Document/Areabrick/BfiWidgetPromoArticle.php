<?php
/**
 * Created by PhpStorm.
 * User: salt
 * Date: 03/12/18
 * Time: 17:44
 */

namespace AppBundle\Document\Areabrick;
use Pimcore\Model\DataObject;
use Pimcore\Model\Document\Tag\Area\Info;
use Carbon\Carbon;

class BfiWidgetPromoArticle extends AbstractAreabrick
{
    public function action(Info $info){
        $newsDate = [];
        
        $promos = new DataObject\Promo\Listing();
        $promos->addConditionParam("PromoEndDate > ?",time());
        $promos->setOrderKey("o_creationDate");
        $promos->setOrder("desc");
        $promos->setLimit(1);

        $news = new DataObject\BlogArticle\Listing();
        $news->setOrderKey('Date');
        $news->setOrder('desc');

        $limit = ($promos->getData() != NULL) ? 2 : 3;
        $news->setLimit($limit);

        $category = ($promos->getData() != NULL) ? 'promo' : 'blog';

        $contents = ($category == 'blog' ) ? reset($news->getData()) : reset($promos->getData());
        $date = ($category == 'blog') ? $contents->getDate() : $contents->getPromoEndDate();
        $timestampDate = Carbon::parse($date);
        $contentsDate = date("F d, Y", $timestampDate->timestamp);

        $newsItem = $news->getData();
        if ($category == 'blog') {
            array_shift($newsItem);
        }
        
        foreach ($newsItem as $key => $item) {
            $timestampDate = Carbon::parse($item->getDate());
            $newsDate[] = date("F d, Y", $timestampDate->timestamp);
        }

        $info->getView()->data = [
            'category' => $category,
            'contents' => $contents,
            'contentsDate' => $contentsDate,
            'news' => $newsItem,
            'newsDate' => $newsDate
        ];
    }
}