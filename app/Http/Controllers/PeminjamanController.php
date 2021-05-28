<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class PeminjamanController extends Controller
{
    function transaksi(){
        $data=array(
            'table' =>DB::table('tb_peminjaman')
            ->join('tb_arsip','tb_peminjaman.id_arsip','tb_arsip.id_arsip')
            ->leftJoin('users','tb_peminjaman.id_petugas','users.id')
            ->orderBy('tb_peminjaman.created_at','DESC')
            ->get(),
        );
        return view('transaksi.index',$data);
    }
    function transaksi_create(){
        $data=array(
            'arsip' =>DB::table('tb_arsip')->join('tb_rak','tb_rak.id_rak','tb_arsip.id_rak')->where('tb_arsip.status_arsip',1)->get(),
            'user' => User::all()
        );
        return view('transaksi.create',$data);
    }

    function transaksi_store(Request $request){
     /* echo "ID Arsip : ";
      echo $request->id_arsip ."<br/>";
      echo "nama_peminjam : ";
      echo $request->nama_peminjam ."<br/>";
      echo "date range : ";
      echo $request->daterange ."<br/>";
      echo "ID User : ";
      echo Auth::user()->id ."<br/>";
      echo "Start : ";
      echo substr($request->daterange, 0,10) ."<br/>";
      echo "End : ";
      echo substr($request->daterange, 12) ."<br/>";


      $substrpinjam = substr($request->daterange, 0,10);
      $substrpinjamtglkembali = substr($request->daterange, 12);

      $start = strtotime($substrpinjam);
      $end = strtotime($substrpinjamtglkembali);

      $tglpinjam = date('Y-m-d',$start);
      $tglkembali = date('Y-m-d',$end);
    */
      $cek = DB::table('users')->where('id',$request->nama_peminjam)->first();

      $qry = DB::table('tb_peminjaman')->insert([
            'tanggal_peminjaman' => now(),
            'id_arsip' => $request->id_arsip,
            'nama_peminjam' => $cek->name,
            'id_peminjam' => $request->nama_peminjam,
            'id_petugas' => Auth::user()->id,
            'status_peminjaman' => 2,
            'created_at' => now()
            ]);

      if ($qry) {
          $editarsip = DB::table('tb_arsip')
          ->where('id_arsip',$request->id_arsip)
          ->update([
            'status_arsip' => 2
          ]);

          session()->flash('success', 'Peminjaman Berhasil');
          return redirect(route('transaksi.index'));
      }else{
          session()->flash('error', 'Gagal Meminta Request');
          return redirect(route('transaksi.index'));
      }


    }

    function transaksi_kembali($id){

        $cek = DB::table('tb_peminjaman')->where('id_peminjaman',$id)->first();

        if ($cek) {

          $add = DB::table('tb_pengembalian')->insert([
            'id_peminjaman' => $id,
            'tanggal_pengembalian' => now(),
            'id_arsip' => $cek->id_arsip,
            'created_at' => now()
            ]);

          $qry = DB::table('tb_peminjaman')->where('id_peminjaman',$id)->update([
              'status_peminjaman' => 3,
              'id_petugas' => Auth::user()->id,
              'updated_at' => now(),
              'tanggal_kembali' => now()
            ]);

          $editarsip = DB::table('tb_arsip')
            ->where('id_arsip',$cek->id_arsip)
            ->update([
              'status_arsip' => 1
            ]);

            session()->flash('success', 'Arsip Dikembalikan');
            return redirect()->route('transaksi.index');
        }else{
            session()->flash('error', 'Gagal Meminta Request');
            return redirect()->route('transaksi.index');
        }

    }

    function approval(){
        $data=array(
            'table' =>DB::table('tb_peminjaman')
            ->join('tb_arsip','tb_peminjaman.id_arsip','tb_arsip.id_arsip')
            ->leftJoin('users','tb_peminjaman.id_petugas','users.id')
            ->where('status_peminjaman',1)
            ->get(),
        );
        return view('approval.index',$data);
    }

    function approval_terima($id){
        $qry =  DB::table('tb_peminjaman')
                  ->where('id_peminjaman',$id)
                  ->update([
                    'status_peminjaman' => 2,
                    'id_petugas' => Auth::user()->id,
                    'updated_at' => now()
                  ]);

        $cek = DB::table('tb_peminjaman')->where('id_peminjaman',$id)->first();

        if ($qry) {
            $editarsip = DB::table('tb_arsip')
            ->where('id_arsip',$cek->id_arsip)
            ->update([
              'status_arsip' => 2
            ]);

            session()->flash('success', 'Peminjaman Disetujui');
            return redirect()->route('approval.index');
        }else{
            session()->flash('error', 'Gagal Meminta Request');
            return redirect()->route('approval.index');
        }

        
   }

   function approval_tolak($id){
         $qry =   DB::table('tb_peminjaman')
                  ->where('id_peminjaman',$id)
                  ->update([
                    'status_peminjaman' => 0,
                    'id_petugas' => Auth::user()->id,
                    'updated_at' => now()
                  ]);

        if ($qry) {
          session()->flash('success', 'Peminjaman Ditolak');
          return redirect()->route('approval.index');
        }
   }

    function history(){
        $data=array(
            'table' =>DB::table('tb_peminjaman')
            ->join('tb_arsip','tb_peminjaman.id_arsip','tb_arsip.id_arsip')
            ->join('users','tb_peminjaman.id_petugas','users.id')
            ->where('status_peminjaman',3)
            ->get(),
        );
        return view('history.index',$data);
    }

    function peminjaman_user(){
        $data=array(
            'table' =>DB::table('tb_peminjaman')
            ->join('tb_arsip','tb_peminjaman.id_arsip','tb_arsip.id_arsip')
            ->leftJoin('users','tb_peminjaman.id_petugas','users.id')
            ->orderBy('tb_peminjaman.created_at','DESC')
            ->where('tb_peminjaman.id_peminjam',Auth::user()->id)
            ->get(),
        );
        return view('peminjaman.index',$data);
    }

    function peminjaman_create(){
        $data=array(
            'arsip' =>DB::table('tb_arsip')->join('tb_rak','tb_rak.id_rak','tb_arsip.id_rak')->get(),
        );
        return view('peminjaman.create',$data);
    }

    function peminjaman_post($id){

          DB::table('tb_peminjaman')->insert([
            'tanggal_peminjaman' => now(),
            'id_arsip' => $id,
            'nama_peminjam' => Auth::user()->name,
            'id_peminjam'=> Auth::user()->id,
            'id_petugas' => 0,
            'status_peminjaman' => 1,
            'created_at' => now()
            ]);

      session()->flash('success', 'Peminjaman Berhasil, Silahkan menunggu persetujuan');
      return redirect(route('peminjaman.user'));
    }

     function riwayat_user(){
        $data=array(
            'table' =>DB::table('tb_peminjaman')
            ->join('tb_arsip','tb_peminjaman.id_arsip','tb_arsip.id_arsip')
            ->join('users','tb_peminjaman.id_petugas','users.id')
            ->where('status_peminjaman',3)
            ->where('id_peminjam',Auth::user()->id)
            ->get(),
        );
        return view('history.index',$data);
    }


    function pinjamBarcode(Request $request){

          $cek = DB::table('users')->where('id',$request->id_peminjam)->first();
          $qry = DB::table('tb_peminjaman')->insert([
            'tanggal_peminjaman' => now(),
            'id_arsip' => $request->id_arsip,
            'nama_peminjam' => $cek->name,
            'id_peminjam'=> $request->id_peminjam,
            'id_petugas' => 1,
            'status_peminjaman' => 2,
            'created_at' => now()
            ]);

            if ($qry) {
              $editarsip = DB::table('tb_arsip')
              ->where('id_arsip',$request->id_arsip)
              ->update([
                'status_arsip' => 2
            ]);

              session()->flash('success', 'Peminjaman Berhasil');
              return redirect()->back();

            }else{
              session()->flash('error', 'Gagal Meminta Request');
              return redirect()->back();
            }

    }


    function kembaliBarcode($id){

        $cek = DB::table('tb_peminjaman')->where('id_peminjaman',$id)->first();

        if ($cek) {

          $add = DB::table('tb_pengembalian')->insert([
            'id_peminjaman' => $id,
            'tanggal_pengembalian' => now(),
            'id_arsip' => $cek->id_arsip,
            'created_at' => now()
            ]);

          $qry = DB::table('tb_peminjaman')->where('id_peminjaman',$id)->update([
              'status_peminjaman' => 3,
              'id_petugas' => 1,
              'updated_at' => now(),
              'tanggal_kembali' => now()
            ]);

          $editarsip = DB::table('tb_arsip')
            ->where('id_arsip',$cek->id_arsip)
            ->update([
              'status_arsip' => 1
            ]);

            session()->flash('success', 'Arsip Dikembalikan');
              return redirect()->back();
        }else{
            session()->flash('error', 'Gagal Meminta Request');
              return redirect()->back();
        }

    }

}
