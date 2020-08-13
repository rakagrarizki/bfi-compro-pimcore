<?php

namespace AppBundle\Command;

use Pimcore\Console\AbstractCommand;
use Pimcore\Console\Dumper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\City as City;
use AppBundle\Service\SendApi;
use Pimcore\Model\WebsiteSetting;

class ImportAreacodeCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('importareacode:command')
            ->setDescription('import areacode command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = WebsiteSetting::getByName('URL_GET_BRANCH')->getData();

        $sendApi = new SendApi();
        try {
            $data = $sendApi->getBranch($url);
        } catch (\Exception $e) {
            $this->writeError("cannot connect api bfi ");
        }

        if($data->code != 1){
            $this->writeError("something wroong / cannot connect api bfi");
        }

        foreach ($data->data as $branch){

            $nameKota = preg_replace("/(?:^|\W)KAB.(?:$|\W)/", "", strtoupper($branch->branch));
            $nameKota = preg_replace("/(?:^|\W)KAB(?:$|\W)/", "", $nameKota);
            $nameKota = str_replace('.', '', $nameKota);

            if($nameKota != ""){
                $data = new City\Listing();
                $data->addConditionParam("Name LIKE ?", "%" . $nameKota . "%", "AND");
                $data->setOrderKey("Name");
                $data->setOrder("DESC");

                if($data->getObjects()){
                    foreach($data->getObjects() as $city){
                        $city->setAreaCode($branch->area_code);

                        try {
                            $city->save();
                            $this->dump("Succes save AreaCode " . strtoupper($nameKota));
                        } catch (\Exception $exception) {
                            $this->writeError("Failed save AreaCode " . strtoupper($nameKota) . " because " . $exception->getMessage());
                        }
                    }
                }else{
                    $this->writeError("Kota " . strtoupper($nameKota) . " Tidak ditemukan ");
                }
            }
        }
    }
}