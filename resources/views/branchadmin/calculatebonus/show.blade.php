@extends('layouts.branch-layout')
@section('title','Calculate Bonus')
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
    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
            <span class="alert-inner--text"><strong>Warning!</strong> {{ session('warning') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div><br>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card card-profile shadow">
                <div class="card-body">
                    <h3>
                        Incomplete Bonus
                        <a style="float: right;" href="{{ route('br-supplier.show',$client->id) }}"
                           class="btn btn-sm btn-white">
                            Back To Profile
                        </a>
                    </h3>
                    <hr>
                    <?php $bonuses = $client->productBonuses()->where('status', 0)->get(); ?>
                    @if($bonuses->count() > 0)
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Percentage</th>
                                    <th scope="col">Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $sno = 1; ?>
                                @foreach($bonuses as $bonus)
                                    <tr>
                                        <td>{{ $sno++ }}</td>
                                        <td>{{ $bonus->start_date }}</td>
                                        <td>{{ $bonus->end_date }}</td>
                                        <td>{{ $bonus->percentage }}%</td>
                                        <td>
                                            <a href="{{ route('br-supplierbonus.edit',$client->id) }}" class="btn btn-sm btn-default">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No incomplete bonus record found.</p>
                    @endif
                </div>
            </div>
            <br>
            <div class="card card-profile shadow">
                <div class="card-body">
                    <h3>Bonus Details</h3>
                    <hr>
                    {{ Form::open(['action' => 'BrBonusController@store','onsubmit' => 'return loadingCss(this);']) }}
                    {{ Form::hidden('user_id',$client->id) }}
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Select Date</label>
                                <small style="color: red;"> *</small>
                                {{ Form::date('start_date',null,['class' => 'form-control','required']) }}
                            </div>
                            <div class="form-group">
                                <label for="">Percentage</label>
                                <small style="color: red;"> * e.g. 5.</small>
                                {{ Form::text('percentage',null,['class' => 'form-control','required']) }}
                            </div>
                            <div class="form-group" id="adding-form">
                                {{ Form::submit('Next',['class' => 'btn btn-sm btn-default']) }}
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">End Date</label>
                                <small style="color: red;"> *</small>
                                {{ Form::date('end_date',null,['class' => 'form-control','required']) }}
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div><br>

@endsection