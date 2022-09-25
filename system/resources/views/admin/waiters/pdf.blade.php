@extends('admin.layouts.pdfApp')

@section("content")
<div class="body">
    <div class="border"></div>
    <div class="content">
        <div>
            {{-- <img src="{{asset("assets/images/pdf_bg.png")}}" /> --}}
        </div>
        <table width="380" style="margin: auto;" border="0">
            <tr>
                <td align="center">
                   <img class="logo" src="{{Storage::url($row->restaurant->logo)}}" width="100"/> 
                </td>
            </tr>
            <tr>
                <td align="center">
                    <p style="font-size:15px; font-weight:400; margin-top:0;">
                        Should you wish to show appriciation to <span class="special">{{ucwords($row->name)}}</span> in the<br>
                    restaurant who worked hard to ensure you enjoyed your<br>
                    food and drinks.
                    </p>
                    <p style="font-size:15px; font-weight:400; margin-bottom:0;">
                        We now accept <span class="special">cashless</span> tips.
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="qr-container">
                        <div class="qr">
                            <img src="{{Storage::url($row->qrcode)}}" width="100"/>
                        </div> 
                    </div>
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
        margin:2mm auto;
    }

    .label-title{
        /* border:1px solid; */
        font-size: 10px;
        font-weight: 400;
        margin:0 0 0.8mm 0;
    }
    
    .p-content{
        margin:0;
    }
    
    .phone-label{
        
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
        margin:15mm 10mm 5mm 10mm;
    }

    .main-table{
        margin:auto;
        width: 280px;
    }

    .qr-container{
        padding: 1mm 7mm 4mm 7mm;
        text-align: center;
        border-radius: 15px;
        width: 48mm;
        margin: auto;
    }

    .qr{}

    .qr img{
        width: 100%;
        background: white;
        display: inline;
        margin: auto;
        padding:2mm;
        border: 1px solid black;
        border-radius: 4px;
    }

    .border{
        background:{{$row->secondary_color}};
        height: 20px;
    }

    .content{
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
        background-size:100% 100%;
        background-repeat: no-repeat;
        background-image:url({{asset("assets/images/pdf_bg.png")}});
        
    }

    .special{
        color: #437eb6;
        font-size:16px;
        font-weight:bold;
    }

    @page { margin:0px; }
</style>
@endpush