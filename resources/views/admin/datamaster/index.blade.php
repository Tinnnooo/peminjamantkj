@extends('admin.layouts.main')

    @include('admin.layouts.headers')
    @include('admin.layouts.sidebar')

    @if(request()->is('dashboard/admin/datamaster/barang'))
        @include('admin.datamaster.layouts.barang')
    @elseif(request()->is('dashboard/admin/datamaster/ruangan'))
        <h1 class="mt-5">ruangan</h1>
    @elseif(request()->is('dashboard/admin/datamaster/bahan'))
        <h1 class="mt-5">bahan</h1>
    @endif

    @include('admin.layouts.footer')