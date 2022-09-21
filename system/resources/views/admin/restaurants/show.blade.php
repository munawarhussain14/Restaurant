@extends('admin.layouts.app')

@push("scripts")
<script src="{{asset('assets/admin/plugins/qrcode/qrcode.min.js')}}"></script>
{{-- https://www.cssscript.com/qr-code-generator-logo-title/ --}}
<script type="text/javascript">
    $(document).ready(function(){
        @if($row->pdf_menu)
        var qrcode = new QRCode(document.getElementById("qrcode"), "{{route("download.pdf",["restaurant_id"=>$row->id])}}");
        @if(!file_exists($row->qrcode))
        setTimeout(function(){
            let image = $("#qrcode img").attr("src");
            $.post("{{route("admin.restaurants.qrcode",["restaurant_id"=>$row->id])}}", {qrcode: image}, 
            function(result){
                console.log(result);
                $("#qrcode-container img").attr("src",result.qrcode);
                $(".loading").fadeOut(function(){
                    $("#qrcode-container").fadeIn();
                });
            });
        },1000);
        @else
        $("#qrcode-container img").attr("src","{{url($row->qrcode)}}");
        $(".loading").fadeOut(function(){
            $("#qrcode-container").fadeIn();
        });
        @endif
        @endif
    });
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
                            <label for="phone">Phone No</label>
                            <p>{{$row->phone}}</p>
                        </div>
                        <hr>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <p>{{$row->address}}</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="address">Color</label>
                            <table>
                                <tr>
                                    <td>Primary Color</td>
                                    <td>
                                        <div class='color-box' style='background:{{$row->primary_color}}'></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Secondary Color</td>
                                    <td>
                                        <div class='color-box' style='background:{{$row->secondary_color}};'></div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <p>
                                <a target="_blank" class="logo" href="{{Storage::url($row->logo)}}">
                                    <img src="{{Storage::url($row->logo)}}" width="250"/>
                                </a>
                            </p>
                        </div>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pdf_menu">PDF Menu</label>
                            <p>
                                @if($row->pdf_menu)
                                <a target="_blank" class="attach_icon" href="{{Storage::url($row->pdf_menu)}}">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                                @else
                                No PDF Menue
                                @endif
                            </p>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="pdf_menu">Flyer</label>
                            <p>
                                <a target="_blank" class="attach_icon" href="{{url("admin/restaurants/pdf/$row->id")}}">
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
                        @if($row->pdf_menu)
                        <div id="qrcode" style="display: none;">
                        </div>
                        <div class="loading text-center">
                            <div class="spinner-border text-success" role="status">
                              <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div id="qrcode-container" style="display: none;">
                            <img src=""/>
                        </div>
                        {{-- {!! QrCode::size(150)->generate(asset($row->pdf_menu)) !!} --}}
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