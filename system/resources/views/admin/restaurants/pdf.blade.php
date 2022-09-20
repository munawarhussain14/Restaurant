@extends('admin.layouts.pdfApp')

@section("content")
<div class="body">
    <div class="content"></div>
</div>
@endsection

@push("styles")
<style>
    .content{
        background:white;
        width:90%;
        height:80%;
        margin: auto;
    }

    .body{
        background:#760a13;
        width:100%;
        height:100%;
    }

    body{
        margin: 0;
        padding: 0;
    }
    @page { margin:0px; }
</style>
@endpush