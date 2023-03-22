@extends('admin.layouts.main')

    @include('admin.layouts.headers')
    @include('admin.layouts.sidebar')

    @if(request()->is('admin/datamaster/barang'))
        @include('admin.datamaster.layouts.barang')
    @elseif(request()->is('admin/datamaster/barang/*'))
        @include('admin.datamaster.layouts.barang')
    @elseif(request()->is('admin/datamaster/ruangan'))
        @include('admin.datamaster.layouts.ruangan')
    @elseif(request()->is('admin/datamaster/bahan'))
        @include('admin.datamaster.layouts.bahan')
    @endif

    @include('admin.layouts.footer')
