<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Algorithm;

//Models
use App\Models\Nodes;
use App\Models\Wisata;
use App\Models\Category;
use App\Models\Graf;
use Illuminate\Support\Arr;

class PublicController extends Controller
{
    private $__const = 111.319;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        $distance = $this->get_length([$data[0]['lat'], $data[0]['long']], [$data[1]['lat'], $data[1]['long']]);
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

        $vallat = $data[0]['lat'] - $data[1]['lat'];
        $vallong = $data[0]['long'] - $data[1]['long'];

        $power = pow($vallat, 2) + pow($vallong, 2);
        $sqrt = sqrt($power);
        $result = $sqrt * $this->__const;
        $gn = $this->distance($data);
        $final = $result + $gn;

        return $final;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('public.landing.index');
    }

    public function rute()
    {
        return view('public.engine.index');
    }

    public function about()
    {
        return view('public.landing.about');
    }

    public function wisata()
    {
        return view('public.landing.wisata');
    }

    public function peta()
    {
        return view('public.landing.peta');
    }

    public function article_wisata($id)
    {
        $this->data['id_article'] = $id;
        $wisata = Wisata::find($id);
        $this->data['image'] = $wisata->foto;
        $this->data['rows'] = $wisata;
        return view('public.landing.detail', $this->data);
    }

    public function json_situs()
    {
        $data = Wisata::select('*')
            ->orderby('id_wisata', 'ASC')
            ->get();

        $i = 0;
        foreach ($data as $row) {
            if ($row->category->nama_category == 'Titik Awal') {
                unset($data[$i]);
            }
            $i++;
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function json_tujuan($lokasi)
    {
        $data = Wisata::select('*')
            ->Where('lokasi', '=', $lokasi)
            ->orderby('id_wisata', 'ASC')
            ->get();

        $i = 0;
        foreach ($data as $row) {
            if ($row->category->nama_category == 'Titik Awal') {
                unset($data[$i]);
            }
            $i++;
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function json_titik_awal()
    {
        $data = Wisata::select('*')
            ->orderby('id_wisata', 'ASC')
            ->get();

        $i = 0;
        foreach ($data as $row) {
            if ($row->category->nama_category != 'Titik Awal') {
                unset($data[$i]);
            }
            $i++;
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function getjson_wisata($id)
    {
        $data = Wisata::find($id);

        return json_encode(array('data' => $data));
    }

    public function get_Graf($id)
    {
        $data = array();

        $public = Graf::select('*')
            ->where('id_wisata', '=', $id)
            ->get();

        foreach ($public as $row) {
            $row->lat = $row->nodes->lat;
            $row->long = $row->nodes->long;
        }
        $astar = new Algorithm($public);
        $shortpath = $astar->shortestpath();

        $polyline = Graf::select('*')
            ->where('id_wisata', '=', $shortpath['id_wisata'])
            ->where('jalur', '=', $shortpath['jalur'])
            ->get();

        foreach ($polyline as $row) {
            $row->nama_jalan = $row->nodes->nama_jalan;
            $row->lat = $row->nodes->lat;
            $row->long = $row->nodes->long;
        }
        $data['data'] = $polyline;
        $data['jarak'] = $shortpath['jarak'];

        return $data;
    }

    public function wisata_sekitar($id)
    {
        $data = array();
        $shortpath = array();

        $wisata = Wisata::select('*')
            ->where('id_wisata', '=', $id)
            ->first()->toArray();

        $public = Wisata::select('*')
            ->where('id_wisata', '!=', $wisata['id_wisata'])
            ->where('lokasi', '=', $wisata['lokasi'])
            ->where('id_category', '!=', 9)
            ->get()->toArray();

        $data[0] = $wisata;
        $i = 0;
        foreach ($public as $row) {
            $data[1] = $row;
            $equildent = $this->equlident($data);
            if ($equildent < 50) {
                $shortpath[$i]['id_wisata'] = $row['id_wisata'];
                $shortpath[$i]['wisata'] = $row['nama'];
                $shortpath[$i]['lat'] = $row['lat'];
                $shortpath[$i]['foto'] = $row['foto'];
                $shortpath[$i]['long'] = $row['long'];
                $shortpath[$i]['jarak'] = $equildent;

                $i++;
            }
        }

        $columns = array_column($shortpath, 'jarak');
        array_multisort($columns, SORT_ASC, $shortpath);
        $count = count($shortpath);

        for ($i = $count; $i > 5; $i--) {
            unset($shortpath[$i - 1]);
        }

        return $shortpath;
    }

    public function wisata_all($li = 6)
    {
        $data = Wisata::select('*')
            ->where('id_category', '!=', 9)
            ->orderby('nama', 'ASC')
            ->limit($li)
            ->get();
        foreach ($data as $row) {
            $row->to_html = '<div class="col">
            <div class="card">
                <a href="#" class="badge ribbon">' . $row->category->nama_category . '</a>
                <a href="#" class="card-img">
                    <img src="' . url("images/situs") . '/' . $row->foto . '" class="card-img-top" alt="foto BATU MEGALITH HILI LAWELU"></a>
                <div class="card-body">
                        <a href="' . url("welcome/wisata/article/" . $row->id_wisata . "") . '"> <h3 class="card-title">' . $row->nama . '</h3></a>
                    <div class="card-text">
                        ' . $row->alamat . '
                    </div><!-- End of Card Text -->
                </div><!-- End of Card Body -->
            </div><!-- End of Card -->
        </div><!-- End of col -->';
        }
        return $data;
    }

    public function wisata_load($multiplier)
    {
        $limit = 6 * $multiplier;
        $data = $this->wisata_all($limit);

        return $data;
    }

    public function wisata_peta()
    {
        $data = Wisata::select('*')
            ->where('id_category', '!=', 9)
            ->orderby('nama', 'ASC')
            ->get();

        return $data;
    }

    public function wisata_spesifik($cat)
    {
        $category = Category::select('id_category')
            ->where('nama_category', 'like', "%$cat%")
            ->get()->first();

        $data = Wisata::select('*')
            ->where('id_category', '=', $category->id_category)
            ->orderby('nama', 'ASC')
            ->get();

        foreach ($data as $row) {
            $row->to_html = '<div class="col">
            <div class="card">
                <a href="#" class="badge ribbon">' . $row->category->nama_category . '</a>
                <a href="#" class="card-img">
                    <img src="' . url("images/situs") . '/' . $row->foto . '" class="card-img-top" alt="foto BATU MEGALITH HILI LAWELU"></a>
                <div class="card-body">
                <a href="' . url("welcome/wisata/article/" . $row->id_wisata . "") . '"> <h3 class="card-title">' . $row->nama . '</h3></a>
                    <div class="card-text">
                        ' . $row->alamat . '
                    </div><!-- End of Card Text -->
                </div><!-- End of Card Body -->
            </div><!-- End of Card -->
        </div><!-- End of col -->';
        }
        return  $data;
    }

    public function peta_spesifik($id)
    {
        $data = Wisata::find($id);

        return $data;
    }
}
