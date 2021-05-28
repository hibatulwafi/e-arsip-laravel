<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Setting;
use App\User;

class ArsipController extends Controller
{
    function index(){

        $data=array(
            'table' =>DB::table('tb_arsip')
            ->join('tb_rak','tb_arsip.id_rak','tb_rak.id_rak')->get(),
            'setting'=> $setting = Setting::get()->first()
        );
        return view('arsip.index',$data);
    }

 	public function create()
    {
		$data=array(
	        'rak' =>DB::table('tb_rak')->get()
	    );

    	return view('arsip.create',$data);

    }

    public function store(Request $request)
    {
       
       	$cek = DB::table('tb_arsip')->where('nama_arsip',$request->nama_arsip)->get();

       	if (count($cek) > 0) {
       		session()->flash('error', 'Nama Arsip Sudah Ada');
       	}else{
       		DB::table('tb_arsip')->insert([
            'id_rak' => $request->id_rak,
            'nama_arsip' => $request->nama_arsip,
            'keterangan_arsip' => $request->keterangan_arsip,
            'no_polis' => $request->no_polis,
            'no_kontrak' => $request->no_kontrak,
            'tanggal_valid' => $request->tanggal_valid,
            'nama_customer' => $request->nama_customer,
            'status_arsip' => 1,
            'created_at' => now()
        	]);
        	session()->flash('success', 'Data Berhasil Ditambahkan');
       	}

        return redirect(route('arsip.index'));
    }

	public function edit($id)
    {
        $qry = DB::table ('tb_arsip')
        ->where('id_arsip',$id)
        ->first();

        $data=array(
            'qry' => $qry,
            'rak' =>DB::table('tb_rak')->get(),
            'cek_rak' =>DB::table('tb_rak')->where('id_rak',$qry->id_rak)->first(),
        );
        return view('arsip.edit',$data);

    }

    public function update(Request $request)
    {

        $qry = 	DB::table('tb_arsip')
	       		->where('id_arsip',$request->id_arsip)
				->update([
	            'id_rak' => $request->id_rak,
	            'nama_arsip' => $request->nama_arsip,
	            'keterangan_arsip' => $request->keterangan_arsip,
              'no_polis' => $request->no_polis,
              'no_kontrak' => $request->no_kontrak,
              'tanggal_valid' => $request->tanggal_valid,
              'nama_customer' => $request->nama_customer,
	            'status_arsip' => 1,
	            'updated_at' => now()
	        	]);

      	if ($qry) {
      		session()->flash('success', 'Data Berhasil Diupdate');
       	}else{
       		session()->flash('error', 'Gagal Edit Data');
       	}
        return redirect()->route('arsip.index');
    }

    public function destroy($id)
    {
        $hapus = DB::table('tb_arsip')->where('id_arsip',$id)->delete();
        if ($hapus) {
      		session()->flash('success', 'Data Berhasil Dihapus');
       	}else{
       		session()->flash('error', 'Gagal Hapus Data');
       	}
        return redirect()->back();
    }

    public function generateBarcode(Request $request){
     /* $id = $request->get('id');
      $product = Product::find($id);*/
      return view('arsip.barcode')/*->with('product',$product)*/;
    }

    public function DetailBarcode($id){

      $cek = DB::table('tb_arsip')->where('id_arsip','like', '%'.$id.'%')->get();

      if ( count($cek) > 0) {
            $qry = DB::table ('tb_arsip')
          ->join('tb_rak','tb_arsip.id_rak','tb_rak.id_rak')
          ->where('tb_arsip.id_arsip',$id)
          ->first();

          $peminjaman = DB::table ('tb_arsip')
          ->join('tb_peminjaman','tb_peminjaman.id_arsip','tb_arsip.id_arsip')
          ->where('tb_arsip.id_arsip',$id)
          ->where('tb_peminjaman.status_peminjaman',2)
          ->get();

          $data=array(
              'qry' => $qry,
              'user' => User::all(),
              'peminjaman' => $peminjaman
          );

          return view('arsip.detail',$data);
      } else {
        echo "Tidak Bisa Akses ! ";
      }

    }

}
