@extends('layouts.branch-layout')
@section('title','Product Setups')
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
                        All Product Setups
                        <a style="float: right;" href="{{ route('br-productsetup.create') }}"
                           class="btn btn-sm btn-default">
                            Add Product Setup
                        </a>
                    </h3><hr>
                    <?php $i = $product_setups->count(); ?>
                    @if($i > 0)
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Purchased Price</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Details</th>
                                </tr>
                                </thead>
                                <?php $sno = 1; ?>
                                <tbody>
                                @foreach($product_setups as $setup)
                                    <tr>
                                        <td>{{ $sno++ }}</td>
                                        <td>{{ $setup->product_name }}</td>
                                        <td>{{ $setup->product_purchased_price }}</td>
                                        <?php
                                            $quantity = $setup->productInStock->total_stock / $setup->product_unit_quantity;
                                        ?>
                                        <td>{{ $quantity }} {{ $setup->product_purchased_unit }}</td>
                                        <td>
                                            <a href="{{ route('br-productsetup.show',$setup->id) }}" class="btn btn-sm btn-white">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table><br>
                            {{ $product_setups->links() }}
                        </div>
                    @else
                        <p>No record found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div><br>

@endsection