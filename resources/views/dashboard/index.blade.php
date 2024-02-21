@extends('layouts.template')

@section('content')
    @if (auth()->user()->thisAdmin())
        @include('admin.index', [
            $logs,
        ])
    @elseif (auth()->user()->thisGudang())
        @include('barang.index')
    @elseif (auth()->user()->thisKasir())
        @include('kasir.index')
    @endif
@endsection
