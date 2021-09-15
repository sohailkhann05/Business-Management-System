<div class="form-group">
    {{ Form::label('','Purchased Unit') }}
    <small style="color: red;"> *</small>
    {{ Form::text('product_purchased_unit',$product->product_purchased_unit,['class' => 'form-control','required','readonly']) }}
</div>

<div class="form-group">
{{ Form::label('','Purchased Quantity') }}
<small style="color: red;"> * e.g. 10 Liter & 5 Milli-Liter.</small>
    <div class="row">
        <div class="col-md-6">
            {{ Form::number('purchased_quantity_1',null,['class' => 'form-control','required','placeholder' => 'Total Liter']) }}
        </div>
        <div class="col-md-6">
            {{ Form::number('purchased_quantity_2',null,['class' => 'form-control','required','placeholder' => 'Total MilliLiter']) }}
        </div>
    </div>
</div>