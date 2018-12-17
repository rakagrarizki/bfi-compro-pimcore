<?php

namespace AppBundle\Command;

use Pimcore\Console\AbstractCommand;
use Pimcore\Console\Dumper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\Kelurahan as Kelurahan;

class ImportKelurahanCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('importkelurahan:command')
            ->setDescription('importkelurahan command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $parent = DataObject::getByPath("/Kelurahan");

        if ($parent == null) {
            die("/Kelurahan path not found");
        }

        $file = new \SplFileObject(PIMCORE_TEMPORARY_DIRECTORY . "/kelurahan.csv");


        while (!$file->eof() && ($row = $file->fgetcsv(",")) && $row[0] !== null) {

            list($no, $no2, $name) = $row;

            $key = \Pimcore\File::getValidFilename($name."-".$no);
            $check = Kelurahan::getByCode($no, 1);


            if($check) {
                $this->writeError("SKIP - SAVE : ".$name);
            }else{
                $data = new DataObject\Kelurahan();
                $data->setParent($parent);
                $data->setKey($key);
                $data->setPublished(true);
                $data->setName($name);
                $data->setCode($no);
                $data->setKecamatanCode($no2);
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