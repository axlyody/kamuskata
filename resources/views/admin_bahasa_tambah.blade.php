@extends('layouts.app')
@section('title','Tambah Menu')
@section('content')


    <div class="container">
        <form class="form-horizontal" method="post">
            <fieldset>
                <legend>Tambah menu</legend>
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))

                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close"
                                                                                                 data-dismiss="alert"
                                                                                                 aria-label="close">&times;</a>
                        </p>
                    @endif
                @endforeach


                <div class="form-group">
                    <label class="col-lg-2 control-label">Slug</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="slug">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Bahasa</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="bahasa">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary">Buat</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>


@endsection
