@extends('admin.layouts.main')

    @include('admin.layouts.headers')
    @include('admin.layouts.sidebar')

    @if(request()->is('dashboard/admin/datamaster/barang'))
        @include('admin.datamaster.layouts.barang')
    @elseif(request()->is('dashboard/admin/datamaster/ruangan'))
        @include('admin.datamaster.layouts.ruangan')
    @elseif(request()->is('dashboard/admin/datamaster/bahan'))
        @include('admin.datamaster.layouts.bahan')
    @endif

    @include('admin.layouts.footer')
