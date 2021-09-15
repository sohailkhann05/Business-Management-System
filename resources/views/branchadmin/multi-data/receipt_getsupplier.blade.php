@if($users->count() > 0)
    <select name="supplier_id" id="supplier" class="form-control">
        <option value="">Select Supplier (Name / Phone)</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}">
                {{ $user->name }} - {{ $user->phone }}
            </option>
        @endforeach
    </select>
@else
    <select name="supplier_id" id="supplier" class="form-control">
        <option value="">Select Supplier</option>
    </select>
@endif
