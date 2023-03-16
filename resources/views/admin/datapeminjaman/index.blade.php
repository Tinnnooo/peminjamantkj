@extends('admin.layouts.main')

    @include('admin.layouts.headers')
    @include('admin.layouts.sidebar')

    @if(request()->is('admin/datapeminjaman/barangdipinjam'))
        @include('admin.datapeminjaman.layouts.barangDipinjam')
    @elseif(request()->is('admin/datapeminjaman/barangkembali'))
        @include('admin.datapeminjaman.layouts.barangKembali')
    @elseif(request()->is('admin/datapeminjaman/barangbatal'))
        @include('admin.datapeminjaman.layouts.barangBatal')
    @elseif(request()->is('admin/datapeminjaman/ruangandipinjam'))
        @include('admin.datapeminjaman.layouts.ruanganDipinjam')
    @elseif(request()->is('admin/datapeminjaman/ruangankembali'))
        @include('admin.datapeminjaman.layouts.ruanganKembali')
    @endif

    @include('admin.layouts.footer')
