@extends('admin.layouts.main')

<section>
    @include('admin.layouts.headers')
    @include('admin.layouts.sidebar')
        @if(request()->is('*/pinjambarang'))
            @include('layouts.pinjambarang')
        @elseif(request()->is('*/pinjambarang/form'))
            @include('layouts.input.pinjamBarangInput')
        @elseif(request()->is('*/pinjamruangan'))
            @include('layouts.pinjamruangan')
        @elseif(request()->is('*/pinjamruangan/form'))
            @include('layouts.input.pinjamRuanganInput')
        @endif
    @include('admin.layouts.footer')
</section>


