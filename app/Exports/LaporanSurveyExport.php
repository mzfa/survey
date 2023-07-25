<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class LaporanSurveyExport implements FromView
{
    // $this->awal = '';
    protected $awal;
    protected $akhir;
    protected $jenis_survey;
    protected $kategori_survey;
    public function __construct(String $awal,String $akhir,String $jenis_survey,String $kategori_survey)
    {
        $this->awal = $awal;
        $this->akhir = $akhir;
        $this->jenis_survey = $jenis_survey;
        $this->kategori_survey = $kategori_survey;
    }
    public function view(): View
    {
        // $data = DB::table('jawaban')
        // ->leftJoin('pertanyaan', 'jawaban.pertanyaan_id', '=', 'pertanyaan.pertanyaan_id')
        // ->select([
        //     'pertanyaan.*',
        //     'jawaban.*',
        // ])
        // ->where('tgl_jam',[$this->awal,$this->akhir])
        // ->whereBetween('tgl_jam',[$this->awal,$this->akhir])
        // ->get();
        $whereJenis = '';
        if($this->jenis_survey != 0){
            $whereJenis = 'pertanyaan.jenis_survey_id='.$this->jenis_survey;
        }
        // dd($whereJenis);
        // $data = DB::select('SELECT * FROM jawaban LEFT JOIN pertanyaan ON jawaban.pertanyaan_id=pertanyaan.pertanyaan_id WHERE '.$whereJenis);
        $data = DB::table('jawaban')
        // ->leftJoin('pertanyaan', 'jawaban.pertanyaan_id', '=', 'pertanyaan.pertanyaan_id')
        // ->select([
        //     'pertanyaan.*',
        //     'jawaban.*',
        // ])
        // ->groupBy('user_id')
        ->select('user_id','tgl_jam')
        ->distinct()
        ->whereBetween('tgl_jam',[$this->awal,$this->akhir])
        ->get();
        $data_detail = [];
        $no = 1;
        foreach($data as $item){
            $id = $item->user_id;
            $registrasi = DB::connection('PHIS-V2')
            ->table('registrasi')
            ->leftJoin('pasien', 'registrasi.pasien_id', '=', 'pasien.pasien_id')
            ->where('registrasi_id',$id)
            ->first();
            $detail1 = [
                'no' => $no++,
                'nama_pasien' => $registrasi->nama_pasien,
                'kunjungan' => $registrasi->tgl_masuk,
                'jenis_rawat' => $registrasi->jenis_rawat,
                'di_isi' => $item->tgl_jam,
            ];
            $data2 = DB::table('jawaban')
            ->leftJoin('pertanyaan', 'jawaban.pertanyaan_id', '=', 'pertanyaan.pertanyaan_id')
            ->leftJoin('kategori_survey', 'pertanyaan.kategori_survey_id', '=', 'kategori_survey.kategori_survey_id')
            ->where('user_id',$id)
            ->orderBy('pertanyaan.kategori_survey_id')
            ->get();
            array_push($detail1,$data2);
            // $nomorin = 1;
            // foreach($data2 as $item2){
                
            //     $pertanyaan = 'pertanyaan'.$nomorin++;
            // }
            $data_detail[] = $detail1;
        }
        // dd($data);
        // $data = DB::table('transaksi_kas_masuk')->leftJoin('users', 'transaksi_kas_masuk.created_by', '=', 'users.id')
        // ->select([
        //     'users.username',
        //     'transaksi_kas_masuk.*',
        // ])->whereNull('transaksi_kas_masuk.deleted_at')->get();
        // dd($data_detail);
        return view('export.laporan_survey_excel', [
            'data_detail' => $data_detail,
        ]);
    }
}