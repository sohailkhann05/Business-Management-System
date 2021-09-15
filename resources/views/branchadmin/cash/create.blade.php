@extends('layouts.branch-layout')
@section('title','Create Cash')
@section('body_content')

    @if($errors->any())
        <div class="card bg-secondary shadow border-0">
            <div class="card-header bg-white">
                <h3>Alert</h3>
            </div>
            <div class="card-body ">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        </div><br>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>
                        Create Cash
                        <a style="float: right;" href="{{ route('br-cash.index') }}"
                           class="btn btn-sm btn-default">
                            View All
                        </a>
                    </h3><hr>
                    {{ Form::open(['action' => 'BrCashController@store','onsubmit' => 'return loadingCss(this);']) }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Total Amount') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('total_amount',null,['class' => 'form-control','required','placeholder' => 'Total amount']) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" id="adding-form">
                                {{ Form::submit('Create Cash',['class' => 'btn btn-sm btn-default']) }}
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div><br>

@endsection