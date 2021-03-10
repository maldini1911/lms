@extends('Admin.index')
@push('css')
<link rel="stylesheet" href="https://uicdn.toast.com/tui-color-picker/v2.2.0/tui-color-picker.css">
<link rel="stylesheet" href="https://uicdn.toast.com/tui-image-editor/v3.3.0/tui-image-editor.css">
</head>
@endpush
@section('title-page') <i class="fas fa-user"></i> {{$row->student['name']}} <hr> @endsection

@section('content')
<section style="height:100vh;width:100%">
<div id="tui-image-editor"></div>
<div class="container">
<div class="images-container row">
    <div class="col-md-3">
        <img src="{{url('/')}}/adminlte/imgs/cat1.jpeg" alt="image" style="margin:20px; border:1px solid black" width="200px" height = "200px" onclick="loadEditor(this.src)">
    </div>
</div>
</div>
</div>

@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/3.6.3/fabric.js"></script>
<script src="https://uicdn.toast.com/tui.code-snippet/latest/tui-code-snippet.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.3/FileSaver.min.js"></script>
<script src="https://uicdn.toast.com/tui-color-picker/latest/tui-color-picker.js"></script>
<script src="https://uicdn.toast.com/tui-image-editor/latest/tui-image-editor.js"></script>
<script src="{{url('/')}}/adminlte/js/white-theme.js"></script>

<script>

    function loadEditor(src){
          $('.images-container').hide();
          var locale_ru_RU = { // override default English locale to your custom
          'Crop': 'Обзрезать',
          'Delete-all': 'Удалить всё'
          // etc...
          };

          var instance = new tui.ImageEditor(document.querySelector('#tui-image-editor'), {
          includeUI: {
           loadImage: {
               path: src,
               name: 'SampleImage'
           },

           locale: locale_ru_RU,
           theme: whiteTheme, // or whiteTheme
           initMenu: 'filter',
           menuBarPosition: 'bottom'
          },
          cssMaxWidth: 700,
          cssMaxHeight: 200,
          selectionStyle: {
          cornerSize: 20,
          rotatingPointOffset: 70
          }
        });
      }
</script>

@endpush
@endsection
