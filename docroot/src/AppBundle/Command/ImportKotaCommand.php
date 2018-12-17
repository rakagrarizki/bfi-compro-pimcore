<?php

namespace AppBundle\Command;

use Pimcore\Console\AbstractCommand;
use Pimcore\Console\Dumper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\City as City;

class ImportKotaCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('importkota:command')
            ->setDescription('importkota command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $parent = DataObject::getByPath("/Kota");

        if ($parent == null) {
            die("/Kota path not found");
        }

        $file = new \SplFileObject(PIMCORE_TEMPORARY_DIRECTORY . "/kota.csv");


        while (!$file->eof() && ($row = $file->fgetcsv(",")) && $row[0] !== null) {

            list($no, $no2, $name) = $row;

            $key = \Pimcore\File::getValidFilename($name."-".$no);
            $check = City::getByCode($no, 1);

            if($check) {
                $this->writeError("SKIP - SAVE : ".$name);
            }else{
                $data = new DataObject\City();
                $data->setParent($parent);
                $data->setKey($key);
                $data->setPublished(true);
                $data->setName($name);
                $data->setCode($no);
                $data->setProvinceCode($no2);
                try {
                    $data->save();
                    $this->dump("Succes save " . $name);
                } catch (\Exception $exception) {
                    $this->writeError("Failed save " . $name . " because " . $exception->getMessage());
                }
            }
        }

    }
}