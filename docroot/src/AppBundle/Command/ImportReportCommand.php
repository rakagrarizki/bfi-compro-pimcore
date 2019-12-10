<?php

namespace AppBundle\Command;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Pimcore\Console\AbstractCommand;
use Pimcore\Console\Dumper;
use Pimcore\Model\Asset;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\City as City;
use AppBundle\Service\SendApi;
use Pimcore\Model\WebsiteSetting;
use Symfony\Component\Console\Input\InputArgument;


class ImportReportCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('importreport:command')
//            ->addArgument('category','InputArgument::REQUIRED', 'Report category id')
//            ->addArgument('filename','InputArgument::REQUIRED','Csv File name')
            ->setDescription('import report command')
            ->setDefinition(
                new InputDefinition(array(
                    new InputArgument('category', InputArgument::REQUIRED)
                ))
            );

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $parent = DataObject::getByPath("/Report");
        $category = $input->getArgument('category');
        $reportcategory = DataObject\ReportCategory::getById($category);
        //$filename = $input->getArgument('filename');
        $filename = "report.csv";

        if ($parent == null) {
            die("/Report path not found");
        }

        $file = new \SplFileObject(tmp . "/" . $filename);

        $report = new DataObject\Report\Listing();
        $report->load();
        if(count($report) != 0){
            $this->dump("Deleting old Data ...");
            foreach($report as $data){
                $data->delete();
            }
        }

        $this->dump("Uploading Data ...");
        while (!$file->eof() && ($row = $file->fgetcsv(",")) && $row[0] !== null) {

            //list($name, $address, $map) = $row;
            list($url) = $row;
            $guzzleClient = new Client();
            $getAssets = $guzzleClient->request('GET', $url, [
                'verify' => false,
                'debug' => true,
            ]);
            $urlname = basename($url);
            $noExtension = basename($url,".pdf");
            $date = Carbon::now()->timestamp;
            $newAsset = new Asset();
            $newAsset->setFilename($date."-".$urlname);
            $newAsset->setData($getAssets->getBody()->getContents());
            $newAsset->setParent(Asset::getByPath("/pdf"));
            $newAsset->save();

            $name = $newAsset->getFilename();


            $key = \Pimcore\File::getValidFilename($name);


            $r = new DataObject\Report();
            $r->setParent($parent);
            $r->setKey($key);
            $r->setPublished(true);
            $r->setFileName($noExtension);
            $r->setDate(Carbon::today());
            $r->setCategory($reportcategory);
            $r->setUrl($url);
            $r->setPdf($newAsset);



            try {
                $r->save();
                $this->dump("Success save " . $url);
            } catch (\Exception $exception) {
                $this->writeError("Failed save " . $url . " because " . $exception->getMessage());
            }

        }
    }
}
