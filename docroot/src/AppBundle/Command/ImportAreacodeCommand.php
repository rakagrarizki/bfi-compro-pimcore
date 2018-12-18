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
            $city = City::getByName(strtoupper($branch->branch), 1);
            if($city){
                $city->setAreaCode($branch->area_code);
                try {
                    $city->save();
                    $this->dump("Succes save AreaCode " . strtoupper($branch->branch));
                } catch (\Exception $exception) {
                    $this->writeError("Failed save AreaCode " . strtoupper($branch->branch) . " because " . $exception->getMessage());
                }
            }else{
                $this->writeError("Kota Tidak ditemukan ");
            }
        }


    }
}