<?php
/**
 * Belgian Police Web Platform - Uploads Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

namespace Nooku\Component\Uploads;
use Nooku\Library;

class DatabaseRowUpload extends Library\DatabaseRowTable
{
    public function save() {

        $file = $_FILES["file"];
        $source = $file["tmp_name"];

        $allowedExtensions = array("csv");

        $table = $this->table;

        if(in_array(end(explode(".", strtolower($file['name']))), $allowedExtensions))
        {
            if (($handle = fopen($source, "r")) !== FALSE)
            {
                // get the first (header) line
                $header = fgetcsv($handle, '1000');

                // get the rest of the rows
                $data = array();
                while ($row = fgetcsv($handle, '1000'))
                {
                    $arr = array();
                    foreach ($header as $i => $col)
                        $arr[$col] = $row[$i];
                    $data[] = $arr;
                }

                if($table == 'districts'){
                    $this->_importDistricts($data);
                }

                if($table == 'districts_relations'){
                    $this->_importRelations($data);
                }

                if($table == 'streets'){
                    $this->_importStreets($data);
                }

                fclose($handle);
            }
        }
        return parent::save();
    }

    public function _importDistricts($data)
    {
        foreach($data as $item)
        {
            $row = $this->getObject('com:districts.database.row.district');
            $row->id = $item['districts_district_id'];

            if(!$row->load())
            {
                $row->setData($item);
                $row->save();
            } else {
                $row->title = $item['title'];
                $row->slug = '';
                $row->save();
            }
        }
    }

    public function _importRelations($data)
    {
        // Empty districts_relations table
        $this->getObject('com:districts.model.relations')->getRowset()->delete();

        foreach($data as $item)
        {
            $parity = null;
            switch ($item['range_parity']) {
                case 'Even+Oneven':
                    $parity = 'odd-even';
                    break;
                case 'Even':
                    $parity = 'even';
                    break;
                case 'Oneven':
                    $parity = 'odd';
                    break;
            }

            $item['range_parity'] = $parity;

            // Add row to districts_relations table
            $row = $this->getObject('com:districts.database.row.relation');
            $row->setData($item);
            $row->save();
        }
    }

    public function _importStreets($data)
    {
        foreach($data as $item)
        {
            $city = $this->getObject('com:streets.database.row.postcodes');
            $city->streets_postcode_id = $item['postcode'];
            $city->load();

            $street = $this->getObject('com:streets.database.row.streets');
            $street->title = $item['title'];
            $street->city = $city->streets_city_id;

            if($street->load()){
                // Only save when islp field is empty
                if(!$street->islp){
                    $street->islp = $item['islp'];
                    $street->save();
                }
            }
        }
    }
}