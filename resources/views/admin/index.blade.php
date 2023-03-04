@extends('layouts.main')

<main>
    @include('layouts.alert')
    @include('admin.layouts.headers')

    <div class="container-fluid">
        <div class="row">
            @include('admin.layouts.sidebar')
            @include('admin.layouts.dashboard')
        </div>
    </div>

</main>
    
