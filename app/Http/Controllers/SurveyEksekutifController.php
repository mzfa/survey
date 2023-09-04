<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SurveyEksekutifController extends Controller
{
    public function form($jenis,$id)
    {
        $jenis_survey = DB::table('jenis_survey')->where('akronim_jenis_survey', $jenis)->first();
        if(!empty($jenis_survey)){
            $list_pertanyaan = DB::table('pertanyaan')->where('jenis_survey_id', $jenis_survey->jenis_survey_id)->whereNull('deleted_by')->orderBy('urutan','asc')->get();
            // dd($list_pertanyaan);
            $jenis_survey_id = $jenis_survey->jenis_survey_id;
            return view('survey', compact('list_pertanyaan','id','jenis_survey_id'));
        }
        return Redirect('https://webrs.rsumumpekerja-kbn.com')->with(['success' => 'Maaf Survey Tidak dapat di temukan!']);
        // dd($jenis_survey);
    }
    // public function kuis($jenis,$user_id)
    // {
    //     // $kategori_kuis = DB::table('kategori_kuis')->where('url', $jenis)->first();
    //     // if(empty($kategori_kuis)){
    //     //     return view('404');
    //     // }
    //     $urutan = '';
    //     $list_pertanyaan = DB::table('pertanyaan')->where('urutan', 2)->get();
    //     dd($list_pertanyaan)
    //     return view('form/index', compact('list_pertanyaan','user_id','urutan'));
    // }
    // public function ranap($user_id)
    // {
    //     $urutan = 2;
    //     $list_pertanyaan = DB::table('pertanyaan')->where('jenis_survey_id', 1)->get();
    //     return view('survey', compact('list_pertanyaan','user_id','urutan'));
    // }
    // public function rajal($user_id)
    // {
    //     $urutan = 3;
    //     $list_pertanyaan = DB::table('pertanyaan')->where('jenis_survey_id', 1)->get();
    //     return view('survey', compact('list_pertanyaan','user_id','urutan'));
    // }
    public function action(Request $request)
    {
        // $user_id = DB::table('jawaban')->max('user_id');
        // $user_id += 1;
        // dump($request);
        $user_id = $request->id;
        $data = [];
        $no = 1;
        foreach($request->pertanyaan_id as $item){

            $kode_jawab = "jawaban".$no++;
            // dd($kode_jawab);
            // $jwb = explode('|', $kode_jawab);
            // $jwb = $request->$kode_jawab;
            $kode_jawab = $request->$kode_jawab;
            $jawaban = '';
            if(!empty($kode_jawab[1])){
                // dump($kode_jawab[0]);
                // if($kode_jawab)
                foreach($kode_jawab as $item2){
                    $jawaban .= $item2 .'|';
                }
            }else{
                $jawaban = $kode_jawab[0];
            }
            // for($i = 0; $i < count($jwb); $i++){
            // }
            $tgl = now();
            $data[] = [
                'user_id' => $user_id,
                'pertanyaan_id' => $item,
                'tgl_jam' => $tgl,
                'jawaban' => $jawaban,
            ];
        }
        // DB::table('jawaban')->insert($data);
        // dd($data);
        // for ($i = 1; $i <= 25; $i++) {
        //     $jawaban_point = "jawaban" . $i;
        //     $pertanyaan = "pertanyaan" . $i;
        //     $data = [
        //         'user_id' => $user_id,
        //         'pertanyaan_id' => $request->$pertanyaan,
        //         'jawaban' => $request->$jawaban_point,
        //     ];
        // }
        // $data = [
        //     'user_id' => $user_id,
        //     'pertanyaan_id' => $request->saran_id,
        //     'jawaban' => $request->saran,
        // ];
        DB::table('jawaban')->insert($data);
        return Redirect::back()->with(['success' => 'Data Berhasil Di Perbarui!']);
    }
}
