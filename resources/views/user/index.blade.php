@extends('admin.layouts.main')

<section>
    @include('admin.layouts.headers')
    @include('admin.layouts.sidebar')
        @if(request()->is('user/pinjambarang'))
            @include('layouts.pinjambarang')
        @elseif(request()->is('user/pinjambarang/form'))
            @include('layouts.input.pinjamBarangInput')
        @endif
    @include('admin.layouts.footer')
</section>


