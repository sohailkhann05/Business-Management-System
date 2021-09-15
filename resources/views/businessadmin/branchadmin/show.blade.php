@extends('layouts.business-layout')
@section('title',$admin->name)
@section('body_content')

    @if(session('info'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-inner--text"><strong>Success!</strong> {{ session('info') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    <div class="card card-profile shadow">
        <div class="card-body pt-0 pt-md-4">
            <h3>
                {{ $admin->name  }} details
                <a style="float: right;" href="{{ route('business-branchadmin.index') }}"
                   class="btn btn-sm btn-white">
                    View All
                </a>
            </h3>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <p>Name: {{ $admin->name }}</p>
                    <p>Password: {{ $admin->hint }}</p>
                </div>
                <div class="col-md-6">
                    <p>E-Mail address: {{ $admin->email }}</p>
                </div>
            </div>
        </div>
    </div><br>

@endsection