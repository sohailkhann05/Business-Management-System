@extends('layouts.branch-layout')
@section('title','Online Customers')
@section('body_content')

    <div class="row">
        <div class="col-md-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <h3>
                        Online Customers
                    </h3>
                    <hr>
                    <?php $i = 1; ?>
                    @if($customers->count() > 0)
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            <?php $user = \App\Customer::find($customer->customer_id); ?>
                                            {{ $user->name }}
                                        </td>
                                        <td>{{ $customer->created_at->toFormattedDateString() }}</td>
                                        <td>
                                            <a href="{{ route('br-onlinecustomer.show',$customer->customer_id) }}"
                                               class="btn btn-sm btn-white">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No online customer record found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection