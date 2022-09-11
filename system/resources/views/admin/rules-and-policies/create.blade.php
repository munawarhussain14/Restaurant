@extends('admin.layouts.app')

@section('styles')
 <!-- summernote -->
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/summernote/summernote-bs4.min.css')}}"/>
@endsection

@section('scripts')
<!-- Summernote -->
<script>
  $(function () {
    // Summernote
    $('input[type="file"]').change(function() {
        var fileName = this.files[0].name;
        $(this).parent().find(".custom-file-label").text(fileName);
    });

    $('#meeting_date').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
  })
</script>
@endsection

@section("content")
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{$params['singular_title']}}</h3>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{(isset($row))?route($params['route'].".update",$parm):route($params['route'].'.store')}}" 
                method="post" 
                enctype="multipart/form-data">
                @csrf
                @if(isset($row))
                  @method('put')
                @endif
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                    id="title" 
                    name="title"
                    required
                    placeholder="Enter Title"
                    value="{{ old('title',(isset($row))?$row->title:"") }}"
                    />
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <!-- Date -->
                  <div class="form-group">
                    <label for="exampleInputFile">Attachment</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input 
                        type="file" 
                        name="attachment" 
                        accept="application/pdf" 
                        value="{{ old('attachment') }}" 
                        class="custom-file-input" 
                        id="attachment">
                        <label class="custom-file-label" for="attachment">{{ old('attachment',"Choose file") }}</label>
                      </div>
                      {{-- <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div> --}}
                    </div>
                    @error('attachment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
@endsection