@extends('layouts.app')
@section('title','Tambah kata')
@section('content')


    <div class="container">


        <form class="form-horizontal" method="post" id="tambah">
            <fieldset>
                <legend>Tambah Kata</legend>


                <div class="form-group">
                    <label class="col-lg-2 control-label">Kata</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="kata">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Dari</label>
                    <div class="col-lg-10">
                        <select class="selectpicker form-control" data-live-search="true" name="bahasa_awal_slug">
                            @foreach($bahasa as $bahasa1)
                                <option value="{{ $bahasa1->slug }}">{{ $bahasa1->bahasa }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Ke</label>
                    <div class="col-lg-10">
                        <select class="selectpicker form-control" data-live-search="true" name="bahasa_akhir_slug">
                            @foreach($bahasa as $bahasa2)
                                <option value="{{ $bahasa2->slug }}">{{ $bahasa2->bahasa }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-2 control-label">Arti</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="arti">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary" id="kirim">Buat</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>

@endsection
