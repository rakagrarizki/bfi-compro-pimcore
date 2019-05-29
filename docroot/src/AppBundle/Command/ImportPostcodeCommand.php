<?php

namespace AppBundle\Command;

use Pimcore\Console\AbstractCommand;
use Pimcore\Console\Dumper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\Kelurahan as Kelurahan;

class ImportPostcodeCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('importpostcode:command')
            ->setDescription('import postcode command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = new \SplFileObject(PIMCORE_TEMPORARY_DIRECTORY . "/postcode.csv");

        while (!$file->eof() && ($row = $file->fgetcsv(",")) && $row[0] !== null) {

            list($name, $code) = $row;

            $kelurahan = Kelurahan::getByName(strtoupper($name), 1);

            if($kelurahan) {
                $kelurahan->setPostCode($code);
                try {
                    $kelurahan->save();
                    $this->dump("Succes save Poscode " . strtoupper($name));
                } catch (\Exception $exception) {
                    $this->writeError("Failed save poscode " . strtoupper($name) . " because " . $exception->getMessage());
                }
            }else{
                $this->writeError("Not Found " . strtoupper($name));
            }


        }
    }
}