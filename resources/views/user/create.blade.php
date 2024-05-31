@extends('layout.home')
@section('header')
@FilemanagerScript
<script src="https://cdn.tiny.cloud/1/ua95h8cslfj41h4ax3prlueosh8dmdw30vaviwmpfrdcofyv/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    {{-- <script src="//cdn.tinymce.com/4/tinymce.min.js"></script> --}}
@endsection
@section('content')
    <section class="card" style="background: #ffff;">
        <div class="card-header">
            <h3 class="card-title text-dark">Masukan pertanyaan anda</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="/forum/store" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                 <div class="form-group">
                     <label for="judul">Masukan judul</label>
                    <input type="text" class="form-control  @error('judul') is-invalid @enderror" name="Judul" placeholder="masukan judul" id="judul">
                </div>
<div class="form-group">
<label for="exampleInputPassword1">Masukan pertanyaan anda</label>
<textarea name="isi" id="textarea" class="form-control my-editor"></textarea>
  <script>
     tinymce.init({
      selector: 'textarea.my-editor',
      plugins: 'a11ychecker autosave advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      height: 500,
      file_browser_callback: filemanager.tinyMCECallback
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
    </script>
                        {{-- <label for="exampleInputPassword1">Masukan pertanyaan anda</label> --}}
                        {{-- <textarea name="isi" id="isi" class="form-control my-editor"></textarea> --}}
                        @error('isi')
                        <div class="invalid-feedback mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                <div class="form-group @error('kategori_id') is-invalid @enderror">
                <label for="inputGroupSelect01">Kategori</label>
                    <select name="kategori_id" id="inputGroupSelect01" class="form-control">
                    @foreach ($kat as $kategori)
                        <option value="{{$kategori->id}}">{{$kategori->nama}}</option>
                    @endforeach
                    </select>
                    @error('kategori_id')
                    <div class="invalid-feedback mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <a href="/" type="submit" class="btn btn-warning mt-3">kembali</a>
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
