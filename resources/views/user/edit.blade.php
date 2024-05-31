@extends('layout.home')
@section('header')
@FilemanagerScript
<script src="https://cdn.tiny.cloud/1/fgqrscals95tb0fn22n4ghcififfafuq39xyub3ybpxb0i8j/tinymce/4/tinymce.min.js" referrerpolicy="origin"></script>

@endsection
@section('content')
    <section class="card" style="background: #ffffff;">
        <div class="card-header">
            <h3 class="card-title text-dark">Edit pertanyaan anda</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="/forum/update/{{$pertanyaan->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                 <div class="form-group">
                     <label for="judul">Masukan judul</label>
                    <input type="text" class="form-control  @error('judul') is-invalid @enderror" name="judul" placeholder="masukan judul" id="judul" value="{{$pertanyaan->judul}}">
                </div>
                <div class="form-group">
                        <label for="exampleInputPassword1">Masukan pertanyaan anda</label>
                        <textarea name="isi" id="isi" class="form-control my-editor">{{$pertanyaan->isi}}</textarea>
                        @error('isi')
                        <div class="invalid-feedback mt-2">{{ $message }}</div>
                        @enderror
                    </div>
              <div class="form-group @error('kategori') is-invalid @enderror">
                <label for="inputGroupSelect01">Kategori</label>
                    <select name="kategori_id" value="{{old('kategori_id', $pertanyaan->kategori_id)}}" id="inputGroupSelect01" class="form-control">
            <option value="">--Pilih Salah satu Kategoti--</option>
            @forelse ($kat as $item)
                @if ($item->id === $pertanyaan->kategori_id)
                <option value="{{$item->id}}" selected>{{$item->nama}}</option>
                
                @else 
                <option value="{{$item->id}}">{{$item->nama}}</option> 
                @endif
                   
            @empty
                <option value="">Tidak ada Kategori</option>
            @endforelse
        @error('kategori_id')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
        </select>
                </div>

                    <a href="/forum/show/{{$pertanyaan->id}}" type="submit" class="btn btn-warning mt-3">kembali</a>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>
            <!-- /.card-body -->
        </form>
    </section>
@endsection
@section('footer')
    <script>
        var editor_config = {
        path_absolute : "/",
        selector: "textarea.my-editor",
        height : "480",
        plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
            file : cmsURL,
            title : 'Filemanager',
            width : x * 0.8,
            height : y * 0.8,
            resizable : "yes",
            close_previous : "no"
        });
        }
    };

    tinymce.init(editor_config);
    </script>
@endsection
