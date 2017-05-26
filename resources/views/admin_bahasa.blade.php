@extends('layouts.app')
@section('title', 'Data Cuti')
@section('content')



    <div class="container">

        <a href="{{ @url('bahasa/tambah') }}" class="btn btn-default">Tambah bahasa</a>
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>#</th>
                <th>Slug</th>
                <th>Bahasa</th>
                <th>Aksi</th>


            </tr>
            </thead>
            <tbody>

            @foreach($data as $key => $list)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $list->slug }}</td>
                    <td>{{ $list->bahasa }}</td>
                    <td>
                        <a href="{{ url('bahasa/hapus/'.$list->slug)}}" class="btn btn-xs btn-danger"><i
                                    class="fa fa-close"></i></a>
                    </td>
                </tr>
            @endforeach


            </tbody>
        </table>
    </div>
@endsection