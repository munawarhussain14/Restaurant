@extends('admin.layouts.app')

@push("scripts")
<script src="{{asset('assets/admin/plugins/qrcode/qrcode.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.10.377/build/pdf.min.js"></script>
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
                $("#qrcode-container img").attr("src",result.qrcode+"?datetime={{date("Y.m.d-h:m:s")}}");
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
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                       <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            Registration Type
                          </label>			
                        </div>
                      </div>
                      <p class="form-control">
                        @if($row->purpose=="labour")
                        Active Mine Labour
                        @elseif($row->purpose=="deceased labour")
                        Labour died in Mine Accident
                        @elseif($row->purpose=="permanent disabled")
                        Permanent Disabled Labour due to Mine Accident                        
                        @elseif($row->purpose=="occupational desease")
                        Mine Labour with Occupational Pulmonary Disease
                        @endif
                      </p>
                    </div>
                  </div>
                  
                  @if($row->doa)
                  <div class="col-sm-6 id="doa_date">
                    <div class="form-group">
                       <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            Date of Accident
                          </label>			
                        </div>
                      </div>
                      <p class="form-control">
                        {{$row->doa}}
                      </p>
                    </div>
                  </div>
                  @endif
            
                  @if($row->death_date)
                  <div class="col-sm-6">
                    <div class="form-group">
                       <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            Date of Death
                          </label>			
                        </div>
                      </div>
                      <p class="form-control">{{$row->death_date}}</p>
                    </div>
                  </div>
                  @endif
            
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <h2 class="section-title">
                      <div class="row">
                        <div class="col-sm-6 col-6">
                          <span class="english">Personal Information</span>			
                        </div>
                        <div class="col-12">
                          <hr>
                        </div>						
                      </div>
                    </h2>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            Labour Name
                          </label>			
                        </div>						
                      </div>
                        <p class="form-control">{{$row->name}}</p>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                       <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            Labour CNIC No
                          </label>			
                        </div>
                      </div>
                      <p class="form-control">{{$row->cnic}}</p>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                       <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            Father Name
                          </label>			
                        </div>						
                      </div>
                      <p class="form-control">{{$row->father_name}}</p>
            
                    </div>
                  </div>
            
                  <div class="col-sm-4">
                    <div class="form-group">
                       <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            Date of Birth
                          </label>			
                        </div>
                      </div>
                      <p class="form-control">{{$row->dob}}</p>
                    </div>
                  </div>
            
                  <div class="col-sm-4">
                    <div class="form-group">
                       <div class="row">
                        <div class="col-sm-7 col-7">
                          <label class="english">
                            Mobile No (Primary Non-Convertable)
                          </label>			
                        </div>
                      </div>
                      <p class="form-control">{{$row->cell_no_primary}}</p>
                    </div>
                  </div>
            
                  <div class="col-sm-4">
                    <div class="form-group">
                       <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            Mobile No (Secondary)
                          </label>			
                        </div>
                      </div>
                      <p class="form-control">{{$row->cell_no_secondary}}</p>
                    </div>
                  </div>
            
                  <div class="col-sm-4">
                    <div class="form-group">
                       <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            Gender
                          </label>			
                        </div>
                      </div>
                      <p class="form-control">{{ucwords($row->gender)}}</p>
                    </div>
                  </div>
            
                  <div class="col-sm-4">
                    <div class="form-group">
                       <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            Domicile District
                          </label>			
                        </div>
                      </div>
                        <p class="form-control">
                            {{$row->district->name}}
                        </p>
                    </div>
                  </div>
            
                  <div class="col-sm-4">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            Married
                          </label>			
                        </div>
                      </div>
                      <p class="form-control">{{ucwords($row->married)}}</p>
                    </div>
                  </div>
            
                  <div class="col-sm-4">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            EOBI
                          </label>			
                        </div>
                      </div>
                      <p class="form-control">{{ucwords($row->eobi)}}</p>
                    </div>
                  </div>
            
                  <div class="col-sm-4">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            EOBI No
                          </label>			
                        </div>
                      </div>
                      <p class="form-control">{{$row->eobi_no}}</p>
                    </div>
                  </div>
                </div>
            
                <div class="row">
            
                  <div class="col-sm-12">
                    <h5 class="section-title">
                      <div class="row">
                        <div class="col-sm-6 col-6">
                          <span class="english">Work Information</span>
                        </div>
                        <div class="col-12">
                          <hr>
                        </div>
                      </div>
                    </h5>
                  </div>
            
            
                  <div class="col-sm-4">
                    <div class="form-group">
                       <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            Work Start From
                          </label>			
                        </div>
                      </div>
                      <p class="form-control">{{$row->work_from}}</p>
                    </div>
                  </div>
            
                  <div class="col-sm-4">
                    <div class="form-group">
                       <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            Nature of Work
                          </label>			
                        </div>
                        <div class="col-sm-6 col-6 text-right">
                          <label class="urdu">
                             
                          </label>
                        </div>
                      </div>
                        <p 
                        class="form-control" >
                        {{$row->work->title}}
                        </p>
                     </div>
                  </div>
            
                  <div class="col-sm-12">
                    <h5 class="section-title">
                      <div class="row">
                        <div class="col-sm-6 col-6">
                          <span class="english">Permanent Address</span>
                        </div>
                        <div class="col-12">
                          <hr>
                        </div>
                      </div>
                    </h5>
                  </div>
            
                  <div class="col-sm-6">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            Village/Town Address
                          </label>			
                        </div>
                      </div>
                      <p class="form-control">{{$row->perm_address}}</p>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                       <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            District
                          </label>			
                        </div>
                      </div>
                    <p
                        class="form-control">
                        {{$row->perm_district->name}}
                    </p>
            
                    </div>
                  </div>
            
                  <div class="col-sm-12">
                    <h5 class="section-title">
                      <div class="row">
                        <div class="col-sm-6 col-6">
                          <span class="english">Postal Address</span>
                        </div>
                        <div class="col-12">
                          <hr>
                        </div>
                      </div>
                    </h5>
                  </div>
            
                  <div class="col-sm-6">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            Postal Address
                          </label>			
                        </div>
                      </div>
                      <p
                        class="form-control">
                        {{$row->perm_postal_address}}
                    </p>
            
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                       <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            District
                          </label>			
                        </div>
                      </div>
                        <p class="form-control">
                            {{$row->postal_district->name}}
                        </p>
                    </div>
                  </div>
            
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <h2 class="section-title">
                      <div class="row">
                        <div class="col-sm-6 col-6">
                          <span class="english">Lease Holder</span>
                        </div>
                        <div class="col-12">
                          <hr>
                        </div>
                      </div>
                    </h2>
                  </div>
                  <div id="other_lease_holder" class="col-sm-6">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            Lease Holder/Company Name
                          </label>			
                        </div>
                      </div>
                      <p
                        class="form-control">
                        {{$row->lease_owner_name}}
                    </p>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            Lease No
                          </label>			
                        </div>
                      </div>
                      <p
                        class="form-control">
                        {{$row->lease_no}}
                    </p>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            Lease District
                          </label>			
                        </div>
                      </div>
                        <p 
                        class="form-control"
                        >
                        {{$row->lease_district->name}}
                    </p>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            Mineral
                          </label>			
                        </div>
                      </div>
                        <p 
                        class="form-control"
                        >
                        {{$row->mineral->name}}
                    </p>
            
                      @error('mineral')
                      <small class="text-danger">
                        {!! $message !!}
                      </small>
                       @enderror
            
                    </div>
                  </div>
            
                  <div class="col-sm-12">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-6 col-6">
                          <label class="english">
                            Lease Address
                          </label>		
                        </div>
                      </div>
                      <p
                        class="form-control">
                        {{$row->lease_address}}
                    </p>
            
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-check">
                      <div class="row">
                        <div class="col-lg-6">
                            <input type="checkbox" name="confirm" {{(old('confirm')=="on")?"checked":"" }} class="form-check-input" id="confirm"/>
                            <label class="form-check-label" for="confrim" required>Above information is correct to best of my Knowladge</label>
                        </div>
                        <div class="col-lg-12">
                          <hr>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
    <div class="col-12">
      <div class="card">
        <h5 class="card-header">
          Children
        </h5>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Reg No</th>
              </tr>
            </thead>
            <tbody>
              @foreach($row->children as $child)
              <tr>
                <td>{{$child->name}}</td>
                <td>{{$child->reg_no}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>

@endsection