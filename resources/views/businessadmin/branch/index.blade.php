@extends('layouts.business-layout')
@section('title','Branches')
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
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>
                        All Branches
                        <a style="float: right;" href="{{ route('business-branch.create') }}"
                           class="btn btn-sm btn-white">
                            Add Branch
                        </a>
                    </h3><hr>
                    <?php $i = $branches->count(); ?>
                    @if($i > 0)
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Branch</th>
                                    <th scope="col">Admin</th>
                                    <th scope="col">Branch Contact</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $sno = 1;?>
                                @foreach($branches as $branch)
                                    <tr>
                                        <td>{{ $sno++ }}</td>
                                        <td>{{ $branch->branch_title }}</td>
                                        <td>{{ $branch->branchAdmin->name }}</td>
                                        <td>{{ $branch->branch_phone_no }}</td>
                                        <td>{{ $branch->created_at->toFormattedDateString() }}</td>
                                        <td><a href="{{ route('business-branch.show',$branch->id) }}"
                                               class="btn btn-sm btn-white">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p style="padding: 20px;">No record found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div><br>

@endsection