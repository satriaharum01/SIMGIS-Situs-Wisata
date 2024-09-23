<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use File;

//Models
use App\Models\Nodes;
use App\Models\Wisata;
use App\Models\Category;
use App\Models\Graf;
use App\Models\User;

use function PHPUnit\Framework\isEmpty;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function count_wisata()
    {
        $data = Wisata::select('*')
            ->where('id_category','!=',9)
            ->get()->count();

        return $data;
    }

    public function count_user()
    {
        $data = User::select('*')
            ->get()->count();

        return $data;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->data['wisata'] = $this->count_wisata();
        $this->data['userr'] = $this->count_user();
        //return redirect('/dashboard');
        return view('admin.dashboard.index', $this->data);
    }

    public function nodes()
    {
        return view('admin.node.index');
    }

    public function graf()
    {
        return view('admin.graf.index');
    }

    public function situs()
    {
        return view('admin.situs.index');
    }

    // CRUD Mode
    //Category

    public function json_cat()
    {
        $data = DB::table('category')
            ->orderBy('nama_category', 'ASC')
            ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store_cat(Request $request)
    {
        DB::table('category')->insert([
            'nama_category' => $request->category
        ]);

        return redirect('/category');
    }

    public function update_cat(Request $request, $id)
    {
        $rows = Category::find($id);
        $rows->update([
            'nama_category' => $request->category
        ]);

        return redirect('/category');
    }

    public function destroy_cat($id)
    {
        $rows = Category::findOrFail($id);
        $rows->delete();

        return redirect('/category');
    }

    public function getjson_cat($id)
    {
        $data = Category::find($id);

        return json_encode(array('data' => $data));
    }

    //Situs Wistata
    public function json_wisata()
    {
        $data = Wisata::select('*')
            ->where('id_category', '!=', 9)
            ->orderby('id_wisata', 'ASC')
            ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function get_wisata($id)
    {
        $data = Graf::select('*')
            ->where('id_wisata', '=', $id)
            ->get();

        foreach ($data as $row) {
            $row->nama_wisata = $row->wisata->nama;
            $row->nama_jalan = $row->nodes->nama_jalan;
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function json_situs()
    {
        $data = Wisata::select('*')
            ->orderby('id_wisata', 'ASC')
            ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store_situs(Request $request)
    {
        $name = preg_replace('/\s+/', '_', $request->nama);
        $file = $request->file('foto');
        $ext = '.' . $file->getClientOriginalExtension();
        $filename = $name . '-' . date('Y-m-d') . '-' . $ext;
        $this->foto_destroy($filename);
        $file->storeAs('situs', $filename, ['disk' => 'public_uploads']);

        DB::table('wisata')->insert([
            'nama' => $request->nama,
            'alamat' =>  $request->alamat,
            'lokasi' =>  $request->lokasi,
            'lat' =>  $request->lat,
            'long' =>  $request->long,
            'id_category' =>  $request->id_cat,
            'deskripsi' =>  $request->deskripsi,
            'foto' =>  $request->foto
        ]);

        return redirect('/situs');
    }

    public function update_situs(Request $request, $id)
    {
        $name = preg_replace('/\s+/', '_', $request->nama);
        $file = $request->file('foto');
        $ext = '.' . $file->getClientOriginalExtension();
        $filename = $name . '-' . date('Y-m-d') . '-' . $ext;

        $this->foto_destroy($filename);
        $file->storeAs('situs', $filename, ['disk' => 'public_uploads']);

        $rows = Wisata::find($id);
        $rows->update([
            'nama' => $request->nama,
            'alamat' =>  $request->alamat,
            'lokasi' =>  $request->lokasi,
            'lat' =>  $request->lat,
            'long' =>  $request->long,
            'id_category' =>  $request->id_cat,
            'deskripsi' =>  $request->deskripsi,
            'foto' =>  $filename
        ]);

        return redirect('/situs');
    }

    public function destroy_situs($id)
    {
        $rows = Wisata::findOrFail($id);
        $rows->delete();

        return redirect('/situs');
    }

    public function getjson_situs($id)
    {
        $data = Wisata::find($id);

        return json_encode(array('data' => $data));
    }

    //Nodes
    public function json_node()
    {
        $data = DB::table('node')
            ->orderBy('id_node', 'ASC')
            ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store_node(Request $request)
    {
        DB::table('node')->insert([
            'nama_jalan' => $request->nama,
            'lat' =>  $request->lat,
            'long' =>  $request->long
        ]);

        return redirect('/nodes');
    }

    public function update_node(Request $request, $id)
    {
        $rows = Nodes::find($id);
        $rows->update([
            'nama_jalan' => $request->nama,
            'lat' =>  $request->lat,
            'long' =>  $request->long
        ]);

        return redirect('/nodes');
    }

    public function destroy_node($id)
    {
        $rows = Nodes::findOrFail($id);
        $rows->delete();

        return redirect('/nodes');
    }

    public function getjson_node($id)
    {
        $data = Nodes::find($id);

        return json_encode(array('data' => $data));
    }

    //Graf
    public function json_graf()
    {
        $data = Graf::select('*')
            ->orderby('id_graf', 'ASC')
            ->get();

        foreach ($data as $row) {
            $row->nama_wisata = $row->wisata->nama;
            $row->nama_jalan = $row->nodes->nama_jalan;
        }

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store_graf(Request $request)
    {
        DB::table('graf')->insert([
            'jalur' => $request->jalur,
            'id_node' => $request->node,
            'jarak' => $request->jarak,
            'id_wisata' => $request->situs
        ]);

        return redirect('/graf');
    }

    public function update_graf(Request $request, $id)
    {
        $rows = Graf::find($id);
        $rows->update([
            'jalur' => $request->jalur,
            'id_node' => $request->node,
            'jarak' => $request->jarak,
            'id_wisata' => $request->situs
        ]);

        return redirect('/graf');
    }

    public function destroy_graf($id)
    {
        $rows = Graf::findOrFail($id);
        $rows->delete();

        return redirect('/graf');
    }

    public function getjson_graf($id)
    {
        $data = Graf::find($id);

        return json_encode(array('data' => $data));
    }

    public function foto_destroy($filename)
    {
        if (File::exists(public_path('images/situs/' . $filename . ''))) {
            File::delete(public_path('images/situs/' . $filename . ''));
        }
    }
}
