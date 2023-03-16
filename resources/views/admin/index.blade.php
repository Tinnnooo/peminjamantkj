@extends('admin.layouts.main')

<section>
    @include('admin.layouts.headers')
    @include('admin.layouts.sidebar')
    @include('admin.layouts.dashboard')
    @if(auth()->user()->hasAnyRole(['admin', 'guru']))
    <div class="dashboard-list">
        @include('admin.layouts.listbarang')
        @include('admin.layouts.listruangan')
    </div>
    @endif
    @include('admin.layouts.footer')
</section>


