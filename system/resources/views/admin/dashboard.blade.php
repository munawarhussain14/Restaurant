@extends('admin.layouts.app')

@push("styles")
 <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush

@section("content")
<div class="row justify-content-center">
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$labours->count()}}</h3>

                <p>Labours</p>
              </div>
              <div class="icon">
                <i class="ion ion-persons"></i>
              </div>
              <a href="{{route("admin.labours.index")}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
@endsection