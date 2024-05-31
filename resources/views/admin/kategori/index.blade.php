@extends('layout.main2')
@section('title')
    <h1>DATA TABLE PERTANYAAN</h1>
@endsection
@section('header')
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
@endsection
@section('content')
    <div class="card">
                <div class="card-header">
                    <button class="btn  btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah data [+]</button>
                    <div class="float-right">
                    @if (session('sukses'))
                    <div class="alert alert-success" style="margin-top: -8%">
                    {{ session('sukses') }}
                    </div>
                    @endif
                    @if (session('eror'))
                    <div class="alert alert-danger" style="margin-top: -8%">
                    {{ session('eror') }}
                    </div>
                    @endif
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th style="width: 10px">no</th>
                        <th>Nama Kategori</th>
                        <th style="width: 280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($kategori as $kat)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            {{$kat->nama}}
                        </td>
                        <td>    
                            <a href="kategori/{{$kat->id}}/edit" class="btn  btn-primary">UPDATE</a>
                            <form action="kategori/{{$kat->id}}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                            <button  class="submit btn badge-danger">HAPUS</button>
                            </form>
                        </td>

                    @endforeach
                        </tr>
                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right text-secondary">
                    {{$kategori->links()}}
                    </ul>
                </div>
                </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah pertanyaan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form action="kategori/store" method="POST">
        @csrf     
        <div class="form-group">
            <label for="exampleInputPassword1">Kategori</label>
            <input type="text" class="form-control  @error('nama') is-invalid @enderror" name="nama" id="exampleInputPassword1" placeholder="Masukan pertanyaan">
            @error('nama')
            <div class="invalid-feedback mt-2">{{ $message }}</div>
            @enderror
        </div>
       
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">back</button>
            <button type="submit" class="btn btn-primary">simpan</button>
        </div>
        </form>
        </div>
    </div>

    </div>
@include('sweetalert::alert')
@endsection

