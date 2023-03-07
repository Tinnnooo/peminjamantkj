@extends('admin.layouts.main')
    @include('layouts.alert')

<section>
    @include('admin.layouts.headers')
    @include('admin.layouts.sidebar')
    @include('admin.layouts.dashboard')
    <div class="dashboard-list">
        @include('admin.layouts.listbarang')
        @include('admin.layouts.listruangan')
    </div>
</section>


