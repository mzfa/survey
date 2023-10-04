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
    public function export_chart($awal,$akhir,$jenis_survey,$kategori_survey)
    {
        $tambahan_jenis_survey = '';
        $tambahan_kategori_survey = '';
        $awal = $awal.' 00:00:00';
        $akhir = $akhir.' 23:59:59';
        if($jenis_survey != "All"){
            $tambahan_jenis_survey = " AND pertanyaan.jenis_survey_id = $jenis_survey";
        }
        if($kategori_survey != "All"){
            $tambahan_kategori_survey = " AND pertanyaan.kategori_survey_id = $kategori_survey";
        }
        $sql = "SELECT distinct user_id,tgl_jam FROM jawaban LEFT JOIN pertanyaan ON jawaban.pertanyaan_id=pertanyaan.pertanyaan_id WHERE tgl_jam BETWEEN '$awal' AND '$akhir' ".$tambahan_jenis_survey.$tambahan_kategori_survey. ' ORDER BY user_id DESC';
        $data = DB::select($sql);
        // dump($sql);
        // dd($data);
        $data_detail = [];
        $no = 1;
        $status_pertanyaan = 0;
        $sp = 0;
        $p = 0;
        $tp = 0;
        $stp = 0;
        foreach($data as $item){
            $id = $item->user_id;
            $tgl_jam = $item->tgl_jam;
            $hasil_header = [
                'No',
                'Nama',
                'Tanggal Masuk',
                'Jenis Rawat',
            ];
            $registrasi = DB::connection('PHIS-V2')
            ->table('registrasi')
            ->select('pasien.nama_pasien','registrasi.tgl_masuk','registrasi.jenis_rawat')
            ->leftJoin('pasien', 'registrasi.pasien_id', '=', 'pasien.pasien_id')
            ->where('registrasi_id',$id)
            ->first();
            $hasil_jawaban = [];
            $data_jawaban = DB::select("SELECT jawaban,pertanyaan FROM jawaban LEFT JOIN pertanyaan ON jawaban.pertanyaan_id=pertanyaan.pertanyaan_id WHERE tgl_jam='$tgl_jam' AND user_id='$id' ORDER BY jawaban_id asc");
            $hasil_jawaban = [
                $no++,
                $registrasi->nama_pasien,
                $registrasi->tgl_masuk,
                $registrasi->jenis_rawat,
            ];
            foreach($data_jawaban as $jawabannya){
                // dump($jawabannya->jawaban);
                if($jawabannya->jawaban == 'A'){
                    $sp+=1;
                }elseif($jawabannya->jawaban == 'B'){
                    $p+=1;
                }elseif($jawabannya->jawaban == 'C'){
                    $tp+=1;
                }elseif($jawabannya->jawaban == 'D'){
                    $stp+=1;
                }
            }
            // $data_detail[] = $hasil_jawaban; 
        }
        $data_detail = [$sp,$p,$tp,$stp];
        $data = [["Sangat Puas", $sp],["Puas",$p],["Tidak Puas", $tp],["Sangat Tidak Puas",$stp]];
        $header = ["Sangat Puas","Puas","Tidak Puas","Sangat Tidak Puas"];
        // dd($header,$data_detail);
        return view('export.laporan_survey_chart', 
        [
            'data' => $data,
            'data_detail' => $data_detail,
            'header' => $header,
        ]
    );        
    }
    
}
