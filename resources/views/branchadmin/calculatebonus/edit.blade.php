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

    <div class="card card-profile shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h3>
                        {{ $user->name }} ({{ $user->userCategory->user_category_name }})
                    </h3>
                    <p>Products on which bonus will be received</p>
                    <hr>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">S.No</th>
                                <th scope="col">Product</th>
                                <th scope="col">Details</th>
                                <th scope="col">Marked</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sno = 1;
                            $orders = $user->purchasedOrders;
                            $product_id = null;
                            ?>
                            @foreach($orders as $order)
                                @foreach($order->productPurchased as $product)
                                    @if($product_id == $product->product_id)
                                        @continue
                                    @else
                                        @if($product->product->bonus_check == 1)
                                            <tr>
                                                <td>{{ $sno++ }}</td>
                                                <td>
                                                    {{ $product->product->product_name }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('br-productsetup.show',$product->product_id) }}"
                                                       target="_blank" class="btn btn-sm btn-default">View</a>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-default"
                                                            data-toggle="modal" data-target="#marked"
                                                            onclick="addProduct('{{ $product->product_id }}')">
                                                        Mark
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                        <?php $product_id = $product->product_id; ?>
                                    @endif
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card card-profile shadow">
        <div class="card-body">
            <h3>Bonus Details</h3>
            <hr>
            <?php
            $bonus = $user->productBonuses()->where('status', 0)->first();
            ?>
            <div class="row">
                <div class="col-md-6">
                    <p>Starting Date: {{ $bonus->start_date }}</p>
                    <p>Bonus Percentage: {{ $bonus->percentage }}%</p>
                </div>
                <div class="col-md-6">
                    <p>Ending Date: {{ $bonus->end_date }}</p>
                </div>
            </div>
        </div>
    </div><br>
    <div class="card card-profile shadow">
        <div class="card-body">
            <?php $i = $bonus->productBonusDetails()->count(); ?>
            <h3>
                Products to Calculate Bonus
                @if($i > 0)
                    {{ Form::open(['method' => 'put','action' => ['BrBonusDetailController@update',$bonus->id],'onsubmit' => 'return loadingCss(this);']) }}
                    <button type="submit" class="btn btn-sm btn-success" style="float: right;">Calculate Bonus</button>
                    {{ Form::close() }}
                    <br>
                @endif
            </h3>
            <hr>
            @if($i > 0)
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Product</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sno = 1;?>
                        @foreach($bonus->productBonusDetails as $bonus)
                            <tr>
                                <td>{{ $sno++ }}</td>
                                <td>{{ $bonus->product->product_name }}</td>
                                <td>
                                    {{ Form::open(['method' => 'delete','action' => ['BrBonusController@destroy',$bonus->id]]) }}
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="ni ni-fat-remove"></i>
                                    </button>
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>No product marked.</p>
            @endif
        </div>
    </div><br>
    <div class="modal fade" id="marked" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-default">Mark Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure?</p>
                </div>
                <div class="modal-footer">
                    {{ Form::open(['method' => 'put','action' => ['BrBonusController@update',$bonus->id],'onsubmit' => 'return loadingCss(this);']) }}
                    {{ Form::hidden('product_id',null,['id' => 'productId']) }}
                    <div class="form-group" id="adding-form">
                        <button type="submit" class="btn btn-sm btn-success">Confirm</button>
                    </div>
                    {{ Form::close() }}
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-link" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script_content')

    <script>

        function addProduct(id) {
            $('#productId').val(id);
        }

    </script>

@endsection