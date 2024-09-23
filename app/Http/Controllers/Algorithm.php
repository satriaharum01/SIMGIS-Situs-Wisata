<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Arr;
use App\Models\Reseller;


class Algorithm extends Controller
{
    /**
     * Distributor Cordinates
     * @var array
     */
    private array $__awal = array();
    /**
     * New Temp Array
     * @var array
     */
    private array $__temp = array();
    /**
     * Jarak
     * @var array
     */
    private array $__jarak = array();
    /**
     * Constant
     * @var array
     */
    private $__const = 111.319;
    /**
     * Constant
     * @var array
     */
    private $__count = 1;
    /**
     * Constant
     * @var array
     */
    private $__list = array();

    public function __construct($list)
    {
        $this->__list = $list;
        $list = $this->objectArray($this->__list);
        //Equlident

        $jarak = 0;
        $datalist = $this->__split($list);
        foreach ($datalist as $data) {
            $counter = count($data) - 1;
            $jarak = 0;

            for ($i = 1; $i <= $counter; $i++) {
                $sampel = array();
                $sampel[0] = $data[$i - 1];
                $sampel[1] = $data[$i];

                $hasil = $this->__star($sampel);
                $jarak = $jarak + $hasil;
                $this->__jarak[$this->__count]['jarak'] = $hasil;
                $this->__jarak[$this->__count]['jalur'] = $data[$i]['jalur'];
                $this->__jarak[$this->__count]['id_wisata'] = $data[$i]['id_wisata'];
            }
            $this->__jarak[$this->__count]['jarak'] = $jarak;
            $this->__count++;
        }
        //print_r($this->__jarak);
    }

    public function __star(array $get)
    {
        $data = array();
        foreach ($get as $null) {
            $data[] = $null;
        }

        $vallat = $data[0]['lat'] - $data[1]['lat'];
        $vallong = $data[0]['long'] - $data[1]['long'];

        $power = pow($vallat, 2) + pow($vallong, 2);
        $sqrt = sqrt($power);
        $result = $sqrt * $this->__const;
        $final = $result + ($data[1]['jarak'] / 1000);

        return $final;
    }

    public function __split(array $list)
    {
        $rute = 0;
        $data = array();
        foreach ($list as $null) {
            if ($null['jalur'] != $rute) {
                $rute = $null['jalur'];
                $data[$null['jalur']][] = $null;
            } else {
                $data[$rute][] = $null;
            }
        }

        return $data;
    }

    public function getjarak()
    {
        return $this->__jarak;
    }

    public function shortestpath()
    {
        $data = $this->__jarak;
        $nullity = 0;
        $i = 1;
        foreach ($data as $rute) {
            if ($nullity == 0) {
                $datacollect = $data[$i];
                $nullity = $rute['jarak'];
            } else {
                if ($nullity >= $rute['jarak']) {
                    $nullity = $rute['jarak'];
                    $datacollect = $data[$i];
                }
            }
            $i++;
        }

        return $datacollect;
    }

    public function _sort($array, $column)
    {
        usort($myArray, function ($a, $b) {
            return $a[$column] <=> $b[$column];
        });
    }

    public function indexes($array)
    {
        $i = 1;
        $j = 0;
        foreach ($array as $row) {
            $array[$j]['index'] = $i;
            $i++;
            $j++;
        }

        return $array;
    }

    public function get_length($origin, $destination)
    {
        // return distance in meters

        $lon1 = $this->toRadian($origin[1]);
        $lat1 = $this->toRadian($origin[0]);
        $lon2 = $this->toRadian($destination[1]);
        $lat2 = $this->toRadian($destination[0]);

        $deltaLat = $lat2 - $lat1;
        $deltaLon = $lon2 - $lon1;

        $a =   pow(sin($deltaLat / 2), 2) +   cos($lat1) *   cos($lat2) *   pow(sin($deltaLon / 2), 2);
        $c = 2 *   asin(sqrt($a));
        $EARTH_RADIUS = 6371;
        return $c * $EARTH_RADIUS;
    }
    public function toRadian($degree)
    {
        return $degree * (pi() / 180);
    }

    public function distance($data)
    {
        $distance = $this->get_length([$data[0]['latitude'], $data[0]['longitude']], [$data[1]['latitude'], $data[1]['longitude']]);
        return $distance;
    }

    public function objectArray($data)
    {
        $temp = array();
        foreach ($data as $row) {
            $array = json_decode(json_encode($row), true);
            $temp[] = $array;
        }
        return $temp;
    }

    public function equlident($data)
    {

        $vallat = $data[0]['latitude'] - $data[1]['latitude'];
        $vallong = $data[0]['longitude'] - $data[1]['longitude'];

        $power = pow($vallat, 2) + pow($vallong, 2);
        $sqrt = sqrt($power);
        $result = $sqrt * $this->__const;
        $gn = $this->distance($data);
        $final = $result + $gn;

        return $final;
    }

    public function manhattan($data)
    {

        $vallat = $data[0]['latitude'] - $data[1]['latitude'];
        $vallong = $data[0]['longitude'] - $data[1]['longitude'];

        $last = abs($vallat) + abs($vallong);
        $result = $last * $this->__const;
        $gn = $this->distance($data);
        $final = $result + $gn;

        return $final;
    }
}
