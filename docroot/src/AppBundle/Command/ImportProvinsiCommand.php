<?php

namespace AppBundle\Command;

use Pimcore\Console\AbstractCommand;
use Pimcore\Console\Dumper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\Province as Province;

class ImportProvinsiCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('importprovinsi:command')
            ->setDescription('import provinsi command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $parent = DataObject::getByPath("/Provinsi");

        if ($parent == null) {
            die("/Provinsi path not found");
        }

        $file = new \SplFileObject(PIMCORE_TEMPORARY_DIRECTORY . "/provinces.csv");

        while (!$file->eof() && ($row = $file->fgetcsv(",")) && $row[0] !== null) {

            list($no, $name) = $row;

            $key = \Pimcore\File::getValidFilename($name."-".$no);
            $check = Province::getByCode($no, 1);

            if($check) {
                $this->writeError("SKIP - SAVE : ".$name);
            }else{
                $data = new DataObject\Province();
                $data->setParent($parent);
                $data->setKey($key);
                $data->setPublished(true);
                $data->setCode($no);
                $data->setName($name);
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