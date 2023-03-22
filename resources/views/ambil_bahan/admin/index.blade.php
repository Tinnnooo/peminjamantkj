@extends('admin.layouts.main')

<section>
    @include('admin.layouts.headers')
    @include('admin.layouts.sidebar')

    @if (request()->is('admin/ambilbahan'))
        @include('ambil_bahan.admin.ambilbahan')
    @elseif (request()->is('guru/ambilbahan'))
        @include('guru.ambilBahan')
    @elseif(request()->is('guru/ambilbahan/form'))
        @include('guru.ambilBahanInput')
    @endif

    @include('admin.layouts.footer')
</section>


