@extends('admin.layouts.main')

<section>
    @include('admin.layouts.headers')
    @include('admin.layouts.sidebar')
    @include('admin.layouts.dashboard')
    <div class="dashboard-list">
        @include('admin.layouts.listbarang')
        @include('admin.layouts.listruangan')
    </div>
    @include('admin.layouts.footer')
</section>


