<?php
/**
 * Created by PhpStorm.
 * User: Kiky Adryan
 * Date: 01/01/2018
 * Time: 22:07
 */
include("../../../Pimcore/config/startup.php");

use Pimcore\Model\DataObject;

$parent = DataObject::getByPath("/Branch");

if ($parent == null) {
    die("/Branch path not found");
}

$file = new SplFileObject(PIMCORE_TEMPORARY_DIRECTORY . "/branchdocument2.csv");

while ($file->eof()) {
    $data = $file->fgetcsv();

    list($name, $address, $map) = $data;

    /*$key = \Pimcore\File::getValidFilename($name . "-" . $city);
    $marketingOffice = new DataObject\BranchOffice();
    $marketingOffice->setParent($parent);
    $marketingOffice->setKey($key);
    $marketingOffice->setPublished(true);
    $marketingOffice->setName($name);
    $marketingOffice->setAddress($address);
    $map = new DataObject\Data\Geopoint();
    $map->setLatitude($lat);
    $map->setLongitude($long);

    $marketingOffice->setMap($map);
    try {
        $marketingOffice->save();
        echo "Succes save " . $name . "\n";
    } catch (\Exception $exception) {
        echo "Failed save " . $name . " because " . $exception->getMessage() . "\n";
    }*/

}

