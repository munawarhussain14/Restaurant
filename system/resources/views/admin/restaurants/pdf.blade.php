@extends('admin.layouts.pdfApp')

@section("content")
<div class="body">
    <div class="border"></div>
    <div class="content">
        <table class="main-table" border="0">
            <tr>
                <td align="center">
                   <img class="logo" src="{{Storage::url($row->logo)}}" width="100"/> 
                </td>
            </tr>
            <tr>
                <td>
                    <div class="qr-container">
                        <p>
                            SCAN TO VIEW<br>
                        OUR MENU 
                        </p>
                        <div class="qr">
                            <img src="{{Storage::url($row->qrcode)}}" width="150"/>
                        </div> 
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <p>
                        Use the camera on your phone to point at<br>
                        the QR Code above to view our menu
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>
                    <span>Phone Number</span><br>
                    {{$row->phone}}
                    </p>
                    <p>
                    <span>Liceria & CO.</span><br>
                    {{$row->address}}
                    </p>
                </td>
            </tr>
            <tr>
                <td align="center">
                   <div class="line">
                    </div> 
                </td>
            </tr>
            <tr>
                <td align="center">
                    <img src="{{asset('assets/images/power_by.jpg')}}" width="100"/>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection

@push("styles")
{{-- <link rel="preconnect" href="https://fonts.googleapis.com"> --}}
{{-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
{{-- <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;600&display=swap" rel="stylesheet"> --}}
<style>
    .line{
        border-bottom:lightgrey solid 1px;
        width:100px;
        margin: auto;
    }

    span{
        font-size: 10px;
        font-weight: 400;
    }

    p{
        text-align:center; font-size:12px;
        font-weight: bold;
    }

    .logo{
        margin:5mm;
    }
    .main-table{
        margin:auto;
        width: 280px;
    }

    .qr-container{
        padding: 1mm 8mm 5.5mm 8mm;
        background-color:{{$row->primary_color}};
        color:white;
        text-align: center;
        border-radius: 15px;
    }

    .qr img{
        width: 100%;
        background: white;
        display: inline;
        margin: auto;
        padding:3mm;
        border-radius: 10px;
    }

    .border{
        background:{{$row->secondary_color}};
        height: 20px;
    }

    .content{
        background:white;
        width:520px;
        height:750px;
        margin: auto;
        border-radius: 15px;
    }

    .body{
        background:{{$row->secondary_color}};
        width:100%;
        height:100%;
        font-family: 'Overpass', sans-serif;
    }

    body{
        margin: 0;
        padding: 0;
    }
    @page { margin:0px; }
</style>
@endpush