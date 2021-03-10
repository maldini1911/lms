@extends('Admin.index')

@section('title-page') <i class="fas fa-users"></i>  Assignment @endsection

@section('content')

<div class="row">
  <div class="col-md-12">
  <div class="card">
            <div class="card-header">
              <h3 class="card-title">
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              </h3>
                @if($texts)
                    @foreach($texts as $text)
                    <div class="col-lg-12">
                        <div class="session-box">
                            <div class="card" style="width: 18rem;">
                            <iframe width="460" height="215" class="card-img-top" src="https://www.youtube.com/embed/668nUCeBHyY" allowfullscreen></iframe>
                                <div class="card-body">
                                <h5 class="card-title">Session title</h5>
                                <hr>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            <!-- /.card-body -->
          </div>
  </div>
</div>
@push('js')
<script>
  $(function () {
    $("#example1").DataTable(
      {
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "paging": false
      }
    );

  });
</script>
@endpush
@endsection
