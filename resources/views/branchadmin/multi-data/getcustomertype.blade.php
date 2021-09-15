@if($category_collection->count() > 0)
    <label for="">Select Customer</label>
    <select name="customer_id" id="customer_id" class="form-control">
        <option value="">Select Customer</option>
        @foreach($category_collection as $object)
            @foreach($object->users as $user)
                <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->phone }}</option>
            @endforeach
        @endforeach
    </select>
@else
    <label for="">Select Customer</label>
    <select name="customer_id" id="customer_id" class="form-control">
        <option value="">Select Customer</option>
    </select>
@endif