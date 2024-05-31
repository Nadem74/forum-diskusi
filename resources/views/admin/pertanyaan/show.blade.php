@extends('layout.main')

@section('title')
    <h1>DATA TABLE PERTANYAAN</h1>
@endsection
@section('content')
    <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Bordered Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th style="width: 10px">no</th>
                        <th>user</th>
                        <th>judul</th>
                        <th>Isi pertanyaan</th>
                        <th>Jawaban pertanyaan benar</th>
                        <th>kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>1</td>
                        <td>{{$tanya->user->profile->nama_lengkap}}</td>
                        <td>
                            {{$tanya->judul}}
                        </td>
                        <td>
                            {!!$tanya->isi!!}
                        </td>

                        <td>{{ !empty($tanya->tepat->isi) ? $tanya->tepat->isi:'Jawaban belum benar' }}
                        </td>
                        <td>
                          
                                <button class="btn btn-primary btn-sm">{{$tanya->kat->nama ? $tanya->kat->nama:'No kategori' }}</button>
                           
                        </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a href="/Pertanyaan" class="float-right btn btn-default">
                        kembali
                    </a>
                </div>
                </div>
@endsection
