<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <h3>Search result</h3>
                <hr>
                <?php $i = 1; ?>
                @if($customers->count() > 0)
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">S.No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Details</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->userCategory->user_category_name }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>
                                        <a href="{{ route('br-customer.show',$customer->id) }}" target="_blank"
                                           class="btn btn-sm btn-default">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('br-createorder.show',$customer->id) }}"
                                           class="btn btn-sm btn-default">Create Order</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No result found.</p>
                @endif
            </div>
        </div>
    </div>
</div>