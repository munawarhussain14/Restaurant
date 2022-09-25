@extends('admin.layouts.app')

@push('styles')
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush

@push('scripts')
<script src="{{asset('assets/admin/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
  $(function () {
    $(".select2").select2({theme: 'bootstrap4'});
    $('.image-file').change(function() {
        var fileName = this.files[0].name;
        $(this).parent().find(".custom-file-label").text(fileName);
        
        let reader = new FileReader();

        reader.onload = function(e){
          $(".logo-image img").attr("src",e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    });

    $('input[type="file"]').change(function() {
        var fileName = this.files[0].name;
        $(this).parent().find(".custom-file-label").text(fileName);
    });

  });

</script>
@endpush

@section("content")
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">{{$params['singular_title']}}</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form id="data-form" action="{{(isset($row))?route($params['route'].".update",$parm):route($params['route'].'.store')}}" 
    method="post" 
    enctype="multipart/form-data">
    @csrf
    @if(isset($row))
      @method('put')
    @endif
      <div class="card-body">
        <div class="row">
          <div class="col-12">
              <div class="form-group">
                <label>Restaurant</label>
                <select name="restaurant" class="form-control select2 @error('restaurant') is-invalid @enderror" style="width: 100%;">
                  <option selected disabled>Select Restaurant</option>
                  @foreach($restaurants as $item)
                  <option {{ old('restaurant',(isset($restaurant_id))?$restaurant_id:"")==$item->id?"selected":"" }} value="{{$item->id}}">
                    {{$item->name}}
                  </option>
                  @endforeach
                </select>
                @error('test_type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label for="name">Waiter Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" 
              id="name" 
              required
              name="name"
              placeholder="Enter Name"
              value="{{ old('name',(isset($row))?$row->name:"") }}"
              />
              @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
                <label for="logo">QR Code</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input 
                    type="file" 
                    name="qrcode"
                    required
                    accept="application/jpg,jpeg,png,gif" 
                    value="{{ old('qrcode') }}" 
                    class="image-file"
                    id="qrcode">
                    <label class="custom-file-label" for="qrcode">{{ old('logo',"Choose file") }}</label>
                  </div>
                </div>
                @error('qrcode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
          </div>
          <div class="col-6">
            <div class="logo-image">
                <img width="150" src="{{asset(isset($row->qrcode)?Storage::url($row->qrcode):'assets/images/no-image.jpg')}}"/>
              </div>
          </div>
        </div>
      </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
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
  </form>
</div>
@endsection