<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                @if($order)
                    <h3 class="mb-4">Sell Order Return</h3>
                    {{ Form::open(['action' => 'BrSellOrderReturnController@store','onsubmit' => 'return loadingCss(this);']) }}
                    {{ Form::hidden('sell_order_id',$order->id) }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Invoice No') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('invoice_no',$order->invoice_no,['class' => 'form-control','required','disabled']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Deducted Amount') }}
                                <small style="color: red;"> *</small>
                                {{ Form::text('deducted_amount',null,['class' => 'form-control','required','placeholder' => 'Deducted amount']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('','Description') }}
                                <small style="color: red;"> *</small>
                                {{ Form::textarea('description',null,['class' => 'form-control','required','rows' => 3,'placeholder' => 'Description']) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" id="adding-form">
                                {{ Form::submit('Create Sell Order Return',['class' => 'btn btn-sm btn-default']) }}
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                @else
                    <p>No result found...</p>
                @endif
            </div>
        </div>
    </div>
</div><br>