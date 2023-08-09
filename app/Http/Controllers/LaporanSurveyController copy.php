<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Exports\LaporanSurveyExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanSurveyController extends Controller
{
    public function index()
    {
        $jenis_survey = DB::table('jenis_survey')->whereNull('jenis_survey.deleted_at')->get();
        $kategori_survey = DB::table('kategori_survey')->whereNull('kategori_survey.deleted_at')->get();
        
        // dd($kategori_survey);
        return view('laporan_survey.index', compact('jenis_survey','kategori_survey'));
    }
    public function detail(Request $request)
    {
        dump($request);
        $jenis_survey = $request->jenis_survey_id;
        $jenis_survey_id = $request->jenis_survey_id;
        $kategori_survey = $request->kategori_survey_id;
        $kategori_survey_id = $request->kategori_survey_id;
        $tanggal_awal = $request->tanggal_awal.' 00:00:01';
        $tanggal_akhir = $request->tanggal_akhir.' 23:59:59';
        $jenis_survey = DB::table('jenis_survey')->whereNull('jenis_survey.deleted_at')->get();
        $kategori_survey = DB::table('kategori_survey')->whereNull('kategori_survey.deleted_at')->get();
        // $data = DB::table('jawaban')->leftJoin('pertanyaan','jawaban.pertanyaan_id','=','pertanyaan.pertanyaan_id')->where(['pertanyaan.jenis_survey_id' => $jenis_survey])->get();
        $tambahan_jenis_survey = '';
        $tambahan_kategori_survey = '';
        if($jenis_survey_id != "All"){
            $tambahan_jenis_survey = " AND pertanyaan.jenis_survey_id = $jenis_survey_id";
        }
        if($kategori_survey_id != "All"){
            $tambahan_kategori_survey = " AND pertanyaan.kategori_survey_id = $kategori_survey_id";
        }
        $sql = "SELECT distinct user_id,tgl_jam FROM jawaban LEFT JOIN pertanyaan ON jawaban.pertanyaan_id=pertanyaan.pertanyaan_id WHERE tgl_jam BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ".$tambahan_jenis_survey.$tambahan_kategori_survey;
        $data = DB::select($sql);
        // dd($data);
        // $data = DB::table('jawaban')
        // ->leftJoin('pertanyaan', 'jawaban.pertanyaan_id', '=', 'pertanyaan.pertanyaan_id')
        // // ->select([
        // //     'pertanyaan.*',
        // //     'jawaban.*',
        // // ])
        // ->select('user_id','tgl_jam')
        // ->distinct()
        // ->whereBetween('tgl_jam',[$tanggal_awal,$tanggal_akhir])
        // ->where('pertanyaan.jenis_survey_id',$jenis_survey_id)
        // ->where('pertanyaan.kategori_survey_id',$kategori_survey_id)
        // ->get();
        $data_detail = [];
        foreach($data as $item){
            $id = $item->user_id;
            $registrasi = DB::connection('PHIS-V2')
            ->table('registrasi')
            ->leftJoin('pasien', 'registrasi.pasien_id', '=', 'pasien.pasien_id')
            ->where('registrasi_id',$id)
            ->first();
            
            $data_detail[] = [
                'nama_pasien' => $registrasi->nama_pasien,
                'kunjungan' => $registrasi->tgl_masuk,
                'jenis_rawat' => $registrasi->jenis_rawat,
                'di_isi' => $item->tgl_jam,
            ];
        }
        // dump($data_detail);
        // dump($data_detail);
        return view('laporan_survey.index', compact('jenis_survey_id','kategori_survey_id','data_detail','tanggal_awal','tanggal_akhir','jenis_survey','kategori_survey'));
    }
    public function export_excel($awal,$akhir,$jenis_survey,$kategori_survey)
    {
        // dd($request);
        $jenis_survey = $jenis_survey;
        $kategori_survey = $kategori_survey;
        $tanggal_awal = $awal.' 00:00:00';
        $tanggal_akhir = $akhir.' 23:59:59';
        // $data = DB::table('jawaban')->leftJoin('pertanyaan','jawaban.pertanyaan_id','=','pertanyaan.pertanyaan_id')->where(['pertanyaan.jenis_survey_id' => $jenis_survey])->get();
        $nama_file = 'Laporan_survey_'.date('Y-m-d_H-i-s').'.xlsx';
        return Excel::download(new LaporanSurveyExport($awal,$akhir,$jenis_survey,$kategori_survey), $nama_file);
    }
    // public function export_excel($awal,$akhir,$jenis_survey,$kategori_survey)
    // {
        
    //     $awal = $awal.' 00:00:00';
    //     $akhir = $akhir.' 23:59:59';
    //     $tambahan_jenis_survey = '';
    //     $tambahan_kategori_survey = '';
    //     if($jenis_survey != "All"){
    //         $tambahan_jenis_survey = " AND pertanyaan.jenis_survey_id = $jenis_survey";
    //     }
    //     if($kategori_survey != "All"){
    //         $tambahan_kategori_survey = " AND pertanyaan.kategori_survey_id = $kategori_survey";
    //     }
    //     $sql = "SELECT distinct user_id,tgl_jam FROM jawaban LEFT JOIN pertanyaan ON jawaban.pertanyaan_id=pertanyaan.pertanyaan_id WHERE tgl_jam BETWEEN '$awal' AND '$akhir' ".$tambahan_jenis_survey.$tambahan_kategori_survey;
    //     $data = DB::select($sql);
    //     // dd($data);
    //     $data_detail = [];
    //     $no = 1;
    //     $no_pemisah = 0;
    //     foreach($data as $item){
    //         $id = $item->user_id;
    //         $registrasi = DB::connection('PHIS-V2')
    //         ->table('registrasi')
    //         ->leftJoin('pasien', 'registrasi.pasien_id', '=', 'pasien.pasien_id')
    //         ->where('registrasi_id',$id)
    //         ->first();
    //         $sql2 = "SELECT jawaban,pertanyaan,tgl_jam FROM jawaban LEFT JOIN pertanyaan ON jawaban.pertanyaan_id=pertanyaan.pertanyaan_id WHERE tgl_jam BETWEEN '$awal' AND '$akhir' AND user_id='$id' ".$tambahan_jenis_survey.$tambahan_kategori_survey. ' ';
    //         $data2 = DB::select($sql2);
    //         // dd($data2); GROUP BY jawaban.tgl_jam,jawaban.jawaban,pertanyaan.pertanyaan
    //         $tanggal_pemisah = '-';
    //         $hasil_pemisah = [];
    //         foreach($data2 as $item2){
    //             if($item2->tgl_jam !== $tanggal_pemisah){
    //                 if($tanggal_pemisah !== '-'){
    //                     $detail1 = [
    //                         // 'no' => $no++,
    //                         // 'user_id' => $item->user_id,
    //                         // 'nama_pasien' => $registrasi->nama_pasien,
    //                         // 'kunjungan' => $registrasi->tgl_masuk,
    //                         // 'jenis_rawat' => $registrasi->jenis_rawat,
    //                         // 'di_isi' => $item->tgl_jam,
    //                         [
    //                             'jawaban' =>$no++,
    //                         ],
    //                         [
    //                             'jawaban' =>$registrasi->nama_pasien,
    //                         ],
    //                         [
    //                             'jawaban' => $registrasi->tgl_masuk,
    //                         ],
    //                         [
    //                             'jawaban' => $registrasi->jenis_rawat,
    //                         ],
    //                         [
    //                             'jawaban' => $item->tgl_jam,
    //                         ],
    //                     ];
    //                     // dump($no_pemisah, count($hasil_pemisah));
    //                     $pertanyaannya = [];
    //                     if($no_pemisah !== count($hasil_pemisah)){
    //                         $header = [
    //                             [
    //                                 'jawaban1' =>'#',
    //                             ],
    //                             [
    //                                 'jawaban1' => 'Nama Pasien'
    //                             ],
    //                             [
    //                                 'jawaban1' => 'Kunjungan',
    //                             ],
    //                             [
    //                                 'jawaban1' => 'Jenis Rawat',
    //                             ],
    //                             [
    //                                 'jawaban1' => 'Di Isi Pada',
    //                             ],
    //                             // 'no' =>'#',
    //                             // 'nama_pasien' => 'Nama Pasien',
    //                             // 'kunjungan' => 'Kunjungan',
    //                             // 'jenis_rawat' => 'Jenis Rawat',
    //                             // 'di_isi' => 'Di Isi Pada',
    //                         ];
    //                         foreach($hasil_pemisah as $item3){
    //                             array_push($pertanyaannya,['jawaban1' => $item3->pertanyaan]);
    //                         }
    //                         // array_push($header,$pertanyaannya);
    //                         // dump($header);
    //                         $data_detail[] = $pertanyaannya;
    //                         // dump($header);
    //                         $pertanyaannya = [];
    //                     }
    //                     $no_pemisah = count($hasil_pemisah);
    //                     array_push($detail1,$hasil_pemisah);
    //                     $data_detail[] = $hasil_pemisah;
    //                     $hasil_pemisah = [];
                        
    //                 }
    //                 // dump($hasil_pemisah);
    //                 $hasil_pemisah = [];
    //                 $tanggal_pemisah = $item2->tgl_jam;
    //             }
    //             if($item2->tgl_jam == $tanggal_pemisah){
    //                 array_push($hasil_pemisah, $item2);
    //             }

    //         }
    //         $detail1 = [
    //             // 'no' => $no++,
    //             // 'user_id' => $item->user_id,
    //             // 'nama_pasien' => $registrasi->nama_pasien,
    //             // 'kunjungan' => $registrasi->tgl_masuk,
    //             // 'jenis_rawat' => $registrasi->jenis_rawat,
    //             // 'di_isi' => $item->tgl_jam,
    //             [
    //                 'jawaban' =>$no++,
    //             ],
    //             [
    //                 'jawaban' =>$registrasi->nama_pasien,
    //             ],
    //             [
    //                 'jawaban' => $registrasi->tgl_masuk,
    //             ],
    //             [
    //                 'jawaban' => $registrasi->jenis_rawat,
    //             ],
    //             [
    //                 'jawaban' => $item->tgl_jam,
    //             ],
    //         ];
    //         array_push($detail1,$hasil_pemisah);
    //         $data_detail[] = $hasil_pemisah;
    //         $hasil_pemisah = [];
            
    //     }
    //     return view('export.laporan_survey_excel', [
    //         'data_detail' => $data_detail,
    //     ]);
    // }
    
}
