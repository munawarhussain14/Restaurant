@extends('admin.layouts.app')

@push("scripts")
<script type="text/javascript">
    
</script>
@endpush

@section("content")
<div class="row">
    <div class="col-9">
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">{{$params['singular_title']}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <p>{{$row->name}}</p>
                        </div>
                        <hr>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="phone">Restaurant</label>
                            <p>{{$row->restaurant->name}}</p>
                        </div>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pdf_menu">Flyer</label>
                            <p>
                                <a target="_blank" class="attach_icon" href="{{url("admin/waiters/pdf/$row->id")}}">
                                    <i class="fas fa-scroll"></i>
                                </a>
                            </p>
                        </div>  
                    </div>
                </div>
            <!-- /.card-body -->
            </div>
            <div class="card-footer">
                <a href="{{route($params['route'].".edit",$parm)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-header">
                <h5 for="pdf_menu">QR Code</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <p class="text-center">
                        @if($row->qrcode)
                        <div id="qrcode-container">
                            <img width="100%" src="{{Storage::url($row->qrcode)}}"/>
                        </div>
                        @else
                        No PDF Menue
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection