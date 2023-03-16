@extends('admin.layouts.main')

<section>
    @include('admin.layouts.headers')
    @include('admin.layouts.sidebar')
        @if(request()->is('user/pinjambarang'))
            @include('layouts.pinjambarang')
        @endif
    @include('admin.layouts.footer')
</section>


