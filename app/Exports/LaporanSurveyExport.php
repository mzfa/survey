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
        // $awal = $awal.' 00:00:00';
        // $akhir = $akhir.' 23:59:59';
        $tambahan_jenis_survey = '';
        $tambahan_kategori_survey = '';
        if($this->jenis_survey != "All"){
            $tambahan_jenis_survey = " AND pertanyaan.jenis_survey_id = $this->jenis_survey";
        }
        if($this->kategori_survey != "All"){
            $tambahan_kategori_survey = " AND pertanyaan.kategori_survey_id = $this->kategori_survey";
        }
        $sql = "SELECT distinct user_id,tgl_jam,pertanyaan.pertanyaan FROM jawaban LEFT JOIN pertanyaan ON jawaban.pertanyaan_id=pertanyaan.pertanyaan_id WHERE tgl_jam BETWEEN '$this->awal' AND '$this->akhir' ".$tambahan_jenis_survey.$tambahan_kategori_survey. ' ORDER BY pertanyaan.jenis_survey_id,jawaban.jawaban_id DESC';
        $data = DB::select($sql);
        // dump($sql);
        $data_pasien_survey = [];
        $indikator = [];
        foreach($data as $item){
            $data_pasien_survey[$item->user_id] = $item;
            $indikator[$item->pertanyaan]['A'] = 0;
            $indikator[$item->pertanyaan]['B'] = 0;
            $indikator[$item->pertanyaan]['C'] = 0;
            $indikator[$item->pertanyaan]['D'] = 0;
        }
        // foreach($data_pasien_survey as $item1){
        //     echo $item1->user_id.'<br>';
        // }
        // dd($data_pasien_survey);
        $data_detail = [];
        $no = 1;
        $status_pertanyaan = 0;
        foreach($data_pasien_survey as $item){
            $id = $item->user_id;
            $tgl_jam = $item->tgl_jam;
            $hasil_header = [
                'No',
                'Nama',
                'Tanggal Masuk',
                'Jenis Rawat',
                'Jenis Pengisian survey'
            ];
            $registrasi = DB::connection('PHIS-V2')
            ->table('registrasi')
            ->select('pasien.nama_pasien','registrasi.tgl_masuk','registrasi.jenis_rawat','pasien.no_hp')
            ->rightJoin('pasien', 'registrasi.pasien_id', '=', 'pasien.pasien_id')
            ->where('registrasi.registrasi_id',$id)
            ->first();
            // if($id == '216868'){
            //     $registrasi = DB::connection('PHIS-V2')
            //     ->table('registrasi')
            //     ->select('pasien.nama_pasien','registrasi.tgl_masuk','registrasi.jenis_rawat')
            //     ->rightJoin('pasien', 'registrasi.pasien_id', '=', 'pasien.pasien_id')
            //     ->where('registrasi.registrasi_id',$id)
            //     ->get();
            //     dd($registrasi,$id);
            // }
            $hasil_jawaban = [];
            $data_jawaban = DB::select("SELECT DISTINCT jawaban,pertanyaan,pertanyaan.pertanyaan_id FROM jawaban LEFT JOIN pertanyaan ON jawaban.pertanyaan_id=pertanyaan.pertanyaan_id WHERE tgl_jam='$tgl_jam' AND user_id='$id' ORDER BY pertanyaan.pertanyaan_id asc");
            $tanggal_masuk = date('d-m-Y', strtotime($tgl_jam));
            $jenis_pengisian_survey = ($id == 1) ? 'Scan Barcode Dirumah sakit' : 'Whatsapp Blast';
            $jenis_rawat = ($id == 1) ? 'RI' : $registrasi->jenis_rawat;
            $hasil_jawaban = [
                $no++,
                $registrasi->nama_pasien,
                date('d-m-Y', strtotime($registrasi->tgl_masuk)),
                $jenis_rawat,
                $jenis_pengisian_survey
            ];
            $skor = 0;
            $skor_utama = 0;
            foreach($data_jawaban as $jawabannya){
                if(in_array($jawabannya->jawaban,['A','B','C','D'])){
                    $skor_utama += 4;
                }
                if($jawabannya->jawaban == 'A'){
                    $indikator[$jawabannya->pertanyaan]['A'] += 1;
                    $skor += 4;
                }elseif($jawabannya->jawaban == 'B'){
                    $indikator[$jawabannya->pertanyaan]['B'] += 1;
                    $skor += 3;
                }elseif($jawabannya->jawaban == 'C'){
                    $indikator[$jawabannya->pertanyaan]['C'] += 1;
                    $skor += 2;
                }elseif($jawabannya->jawaban == 'D'){
                    $indikator[$jawabannya->pertanyaan]['D'] += 1;
                    $skor += 1;
                }
                array_push($hasil_jawaban, $jawabannya->jawaban);
            }
            if(count($hasil_jawaban) !== $status_pertanyaan){
                foreach($data_jawaban as $jawabannya){
                    array_push($hasil_header, $jawabannya->pertanyaan);
                }
                array_push($hasil_header, 'skor ('.$skor_utama.')');
                $status_pertanyaan = count($hasil_jawaban);
                // dump($hasil_header);
                $data_detail[] = $hasil_header; 
            }
            array_push($hasil_jawaban, $skor);
            $data_detail[] = $hasil_jawaban; 
        }
        $data_detail[] = ['Pertanyaan', 'Sangat Puas','Puas','Tidak Puas','Sangat Tidak Puas','Total Responden'];
        // dd($indikator);
        foreach($indikator as $key => $indi){
            if($indi['A'] != 0 || $indi['B'] != 0 || $indi['C'] != 0 || $indi['D'] != 0){
                $total_responden = $indi['A'] + $indi['B'] + $indi['C'] + $indi['D'];
                $data_detail[] = [$key, $indi['A'], $indi['B'], $indi['C'], $indi['D'], $total_responden];
            }
        }
        $no_pemisah = 0;
        // dd($data_detail);
        return view('export.laporan_survey_excel', [
            'data_detail' => $data_detail,
        ]);
    }
    // public function view(): View
    // {
    //     // $data = DB::table('jawaban')
    //     // ->leftJoin('pertanyaan', 'jawaban.pertanyaan_id', '=', 'pertanyaan.pertanyaan_id')
    //     // ->select([
    //     //     'pertanyaan.*',
    //     //     'jawaban.*',
    //     // ])
    //     // ->where('tgl_jam',[$this->awal,$this->akhir])
    //     // ->whereBetween('tgl_jam',[$this->awal,$this->akhir])
    //     // ->get();
    //     // $whereJenis = '';
    //     // if($this->jenis_survey != 0){
    //     //     $whereJenis = 'pertanyaan.jenis_survey_id='.$this->jenis_survey;
    //     // }
    //     // dd($whereJenis);
    //     // // $data = DB::select('SELECT * FROM jawaban LEFT JOIN pertanyaan ON jawaban.pertanyaan_id=pertanyaan.pertanyaan_id WHERE '.$whereJenis);
    //     // $data = DB::table('jawaban')
    //     // // ->leftJoin('pertanyaan', 'jawaban.pertanyaan_id', '=', 'pertanyaan.pertanyaan_id')
    //     // // ->select([
    //     // //     'pertanyaan.*',
    //     // //     'jawaban.*',
    //     // // ])
    //     // // ->groupBy('user_id')
    //     // ->select('user_id','tgl_jam')
    //     // ->distinct()
    //     // ->whereBetween('tgl_jam',[$this->awal,$this->akhir])
    //     // ->get();
    //     $tambahan_jenis_survey = '';
    //     $tambahan_kategori_survey = '';
    //     if($this->jenis_survey != "All"){
    //         $tambahan_jenis_survey = " AND pertanyaan.jenis_survey_id = $this->jenis_survey";
    //     }
    //     if($this->kategori_survey != "All"){
    //         $tambahan_kategori_survey = " AND pertanyaan.kategori_survey_id = $this->kategori_survey";
    //     }
    //     $sql = "SELECT distinct user_id,tgl_jam FROM jawaban LEFT JOIN pertanyaan ON jawaban.pertanyaan_id=pertanyaan.pertanyaan_id WHERE tgl_jam BETWEEN '$this->awal' AND '$this->akhir' ".$tambahan_jenis_survey.$tambahan_kategori_survey;
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
    //         $sql2 = "SELECT jawaban,pertanyaan,tgl_jam FROM jawaban LEFT JOIN pertanyaan ON jawaban.pertanyaan_id=pertanyaan.pertanyaan_id WHERE tgl_jam BETWEEN '$this->awal' AND '$this->akhir' AND user_id='$id' ".$tambahan_jenis_survey.$tambahan_kategori_survey. ' ';
    //         $data2 = DB::select($sql2);
    //         // dd($data2); GROUP BY jawaban.tgl_jam,jawaban.jawaban,pertanyaan.pertanyaan
    //         $tanggal_pemisah = '-';
    //         $hasil_pemisah = [];
    //         foreach($data2 as $item2){
    //             if($item2->tgl_jam !== $tanggal_pemisah){
    //                 if($tanggal_pemisah !== '-'){
    //                     $detail1 = [
    //                         'no' => $no++,
    //                         'user_id' => $item->user_id,
    //                         'nama_pasien' => $registrasi->nama_pasien,
    //                         'kunjungan' => $registrasi->tgl_masuk,
    //                         'jenis_rawat' => $registrasi->jenis_rawat,
    //                         'di_isi' => $item->tgl_jam,
    //                     ];
    //                     // dump($no_pemisah, count($hasil_pemisah));
    //                     $pertanyaannya = [];
    //                     if($no_pemisah !== count($hasil_pemisah)){
    //                         $header = [
    //                             // [
    //                             //     'jawaban' =>'#',
    //                             // ],
    //                             // [
    //                             //     'jawaban' => 'Nama Pasien'
    //                             // ],
    //                             // [
    //                             //     'jawaban' => 'Kunjungan',
    //                             // ],
    //                             // [
    //                             //     'jawaban' => 'Jenis Rawat',
    //                             // ],
    //                             // [
    //                             //     'jawaban' => 'Di Isi Pada',
    //                             // ],
    //                             'no' =>'#',
    //                             'nama_pasien' => 'Nama Pasien',
    //                             'kunjungan' => 'Kunjungan',
    //                             'jenis_rawat' => 'Jenis Rawat',
    //                             'di_isi' => 'Di Isi Pada',
    //                         ];
    //                         foreach($hasil_pemisah as $item3){
    //                             array_push($pertanyaannya,['jawaban' => $item3->pertanyaan]);
    //                         }
    //                         array_push($header,$pertanyaannya);
    //                         // dump($header);
    //                         $data_detail[] = $header;
    //                         // dump($header);
    //                         $header = [];
    //                     }
    //                     $no_pemisah = count($hasil_pemisah);
    //                     array_push($detail1,$hasil_pemisah);
    //                     $data_detail[] = $detail1;
    //                     $detail1 = [];
                        
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
    //             'no' => $no++,
    //             'nama_pasien' => $registrasi->nama_pasien,
    //             'kunjungan' => $registrasi->tgl_masuk,
    //             'jenis_rawat' => $registrasi->jenis_rawat,
    //             'di_isi' => $item->tgl_jam,
    //         ];
    //         array_push($detail1,$hasil_pemisah);
    //         $data_detail[] = $detail1;
    //         $detail1 = [];
    //         // dd($data_detail);
    //         // dd($data_detail);
    //         // $data2 = DB::table('jawaban')
    //         // // ->leftJoin('pertanyaan', 'jawaban.pertanyaan_id', '=', 'pertanyaan.pertanyaan_id')
    //         // // ->leftJoin('kategori_survey', 'pertanyaan.kategori_survey_id', '=', 'kategori_survey.kategori_survey_id')
    //         // ->where('user_id',$id)
    //         // // ->groupBy('tgl_jam')
    //         // // ->groupBy('tgl_jam')
    //         // // ->orderBy('pertanyaan.kategori_survey_id')
    //         // ->get();
    //         // $nomorin = 1;
    //         // dump($data2);
    //         // foreach($data2 as $item2){
                
    //         //     $pertanyaan = 'pertanyaan'.$nomorin++;
    //         // }
            
    //     }
    //     // echo '<pre>';
    //     // print_r($data_detail);
    //     // echo '</pre>';
    //     // die();
    //     // $data = DB::table('transaksi_kas_masuk')->leftJoin('users', 'transaksi_kas_masuk.created_by', '=', 'users.id')
    //     // ->select([
    //     //     'users.username',
    //     //     'transaksi_kas_masuk.*',
    //     // ])->whereNull('transaksi_kas_masuk.deleted_at')->get();
    //     // dd($data_detail);
    //     return view('export.laporan_survey_excel', [
    //         'data_detail' => $data_detail,
    //     ]);
    // }
}