@extends('admin.layouts.pdfApp')

@section("content")
<div>
<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate('Make me into an QrCode!')) !!} ">
  {{-- {!! QrCode::format('png')->size(150)->generate(asset($row->pdf_menu)) !!} --}}
{{-- <img src="{!!$message->embedData(QrCode::format('png')->generate(asset($row->pdf_menu)), 'QrCode.png', 'image/png')!!}"> --}}
</div>
@endsection