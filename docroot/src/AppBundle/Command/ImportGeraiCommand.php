<?php

namespace AppBundle\Command;

use Pimcore\Console\AbstractCommand;
use Pimcore\Console\Dumper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\BranchOffice;

class ImportGeraiCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('importgerai:command')
            ->setDescription('import gerai command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $parent = DataObject::getByPath("/Branch");

        if ($parent == null) {
            die("/Branch path not found");
        }

        $file = new \SplFileObject(PIMCORE_TEMPORARY_DIRECTORY . "/gerai.csv");


        while (!$file->eof() && ($row = $file->fgetcsv(",")) && $row[0] !== null) {

            list($name, $address, $map) = $row;

            $mapArray = explode(",",$map);

            $key = \Pimcore\File::getValidFilename($name);
            $marketingOffice = new BranchOffice();
            $marketingOffice->setParent($parent);
            $marketingOffice->setKey($key);
            $marketingOffice->setPublished(true);
            $marketingOffice->setName($name);
            $marketingOffice->setAddress($address);
            $marketingOffice->setIsGerai(true);
            $map = new DataObject\Data\Geopoint();
            $map->setLatitude($mapArray[0]);
            $map->setLongitude($mapArray[1]);

            $marketingOffice->setMap($map);
            try {
                $marketingOffice->save();
                $this->dump("Succes save " . $name);
            } catch (\Exception $exception) {
                $this->writeError("Failed save " . $name . " because " . $exception->getMessage());
            }

        }
    }
}