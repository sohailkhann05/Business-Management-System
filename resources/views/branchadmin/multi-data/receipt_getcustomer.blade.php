@if($users->count() > 0)
    <select name="customer_id" id="customer" class="form-control">
        <option value="">Select Customer (Name / Phone)</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}">
                {{ $user->name }} - {{ $user->phone }}
            </option>
        @endforeach
    </select>
@else
    <select name="customer_id" id="customer" class="form-control">
        <option value="">Select Customer</option>
    </select>
@endif
