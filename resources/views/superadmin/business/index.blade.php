@extends('layouts.admin-layout')
@section('title','Business')
@section('body_content')

    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3 class="mb-0">
                        All Businesses
                        <a href="{{ route('admin-business.create') }}" class="btn btn-sm btn-white"
                           style="float: right;">
                            Add Business
                        </a>
                    </h3>
                    <p>Order on recent account creation.</p>
                    <hr>
                    <?php $i = $businesses->count(); ?>
                    @if($i > 0)
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Business Title</th>
                                    <th scope="col">Business Owner</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($businesses as $business)
                                    <tr>
                                        <td>{{ $i-- }}</td>
                                        <td>{{ $business->business_title }}</td>
                                        <td>{{ $business->businessAdmin->name }}</td>
                                        <td>{{ $business->created_at->toFormattedDateString() }}</td>
                                        <td><a href="{{ route('admin-business.show',$business->id) }}"
                                               class="btn btn-sm btn-white">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No record found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div><br>

@endsection