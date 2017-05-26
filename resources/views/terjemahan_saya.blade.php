@extends('layouts.app')
@section('title', 'Terjemahan Saya')
@section('content')

    <div class="container">

        <h3>Terjemahan saya</h3>

        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>#</th>
                <th>Kata</th>
                <th>Ke</th>
                <th>Arti</th>
                <th>Status</th>

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

                </tr>
            @endforeach


            </tbody>
        </table>
    </div>
@endsection