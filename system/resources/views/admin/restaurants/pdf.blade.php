@extends('admin.layouts.pdfApp')

@section("content")
<div>
<img src="{{asset($row->qrcode)}}"/>
</div>
@endsection