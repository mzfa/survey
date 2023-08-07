<div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Pertanyaan</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="{{ $data[0]->pertanyaan }}" id="pertanyaan" name="pertanyaan" required>
    </div>
</div>
<div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Jenis Pertanyaan</label>
    <div class="col-sm-10">
        <select name="jenis_pertanyaan" id="jenis_pertanyaan" class="form-control" required>
            <option value=""></option>
            <option value="1" @if($data[0]->jenis_pertanyaan == 1) selected @endif>Jawaban Singkat</option>
            <option value="2" @if($data[0]->jenis_pertanyaan == 2) selected @endif>Kotak Centang</option>
            <option value="3" @if($data[0]->jenis_pertanyaan == 3) selected @endif>Jawaban Panjang</option>
            <option value="4" @if($data[0]->jenis_pertanyaan == 4) selected @endif>Pilihan</option>
            <option value="5" @if($data[0]->jenis_pertanyaan == 5) selected @endif>Input Range</option>
            <option value="5" @if($data[0]->jenis_pertanyaan == 6) selected @endif>Pilihan Custom</option>
        </select>
    </div>
</div>
<div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Ketarangan</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="{{ $data[0]->keterangan }}" id="keterangan" name="keterangan">
    </div>
</div>
<input type="hidden" name="pertanyaan_id" value="{{ Crypt::encrypt($data[0]->pertanyaan_id) }}">
<div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Jenis Survey</label>
    <div class="col-sm-10">
        <select name="jenis_survey_id" id="jenis_survey_id" class="form-control" required>
            <option value=""></option>
            @foreach($jenis_survey as $item)
            <option value="{{ $item->jenis_survey_id }}" @if($data[0]->jenis_survey_id == $item->jenis_survey_id) selected @endif>{{ $item->nama_jenis_survey }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Kategori Survey</label>
    <div class="col-sm-10">
        <select name="kategori_survey_id" id="kategori_survey_id" class="form-control" required>
            <option value=""></option>
            @foreach($kategori_survey as $item)
            <option value="{{ $item->kategori_survey_id }}" @if($data[0]->kategori_survey_id == $item->kategori_survey_id) selected @endif>{{ $item->nama_kategori_survey }}</option>
            @endforeach
        </select>
    </div>
</div>