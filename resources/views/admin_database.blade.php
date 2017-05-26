@extends('layouts.app')
@section('title', 'Data Cuti')
@section('content')


    @if(isset($_GET['bahasa']))


        <div class="container">

            <h3>{{ $judul->bahasa }}</h3>

            <table class="table table-striped table-hover ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Kata</th>
                    <th>Ke</th>
                    <th>Arti</th>
                    <th>Status</th>
                    <th>Submitter</th>
                    <th>Aksi</th>

                </tr>
                </thead>
                <tbody>

                @foreach($data as $key => $list)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $list->kata }}</td>
                        <td>{{ $list->bahasa_akhir_slug }}</td>
                        <td>{{ $list->arti }}</td>
                        <td>
                            @if($list->disetujui == TRUE)
                                Diterima
                            @elseif($list->disetujui == FALSE)
                                Menunggu
                            @endif
                        </td>
                        <td>{{ $list->submitter }}</td>
                        <td>
                            <a href="{{ url('database/hapus/'.$judul->slug.'/'.$list->kamus_id) }}"
                               class="btn btn-xs btn-danger"><i class="fa fa-close"></i></a>
                            <a href="{{ url('database/terima/'.$judul->slug.'/'.$list->kamus_id) }}"
                               class="btn btn-xs btn-success"><i class="fa fa-check"></i></a>
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>
    @else

        <div class="container">
            <h3>Pilih bahasa</h3>
            <div class="row">
                @foreach($bahasa as $tampilbahasa)
                    <div class="col-md-2 col-xs-3">
                        <a href="{{ url('database/?bahasa='.$tampilbahasa->slug) }}" class="grid-lang-link">
                            <div class="grid-lang">
                                <div class="col-md-12" style="text-align: center;margin-top: 30%;">
                                    <h3>{{ $tampilbahasa->bahasa }}</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

    @endif


@endsection
