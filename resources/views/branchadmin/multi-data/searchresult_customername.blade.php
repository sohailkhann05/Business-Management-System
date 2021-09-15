<?php $i = $suppliers->count(); ?>
@if($i > 0)
    <br>
    <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Phone</th>
                <th scope="col">Details</th>
            </tr>
            </thead>
            <tbody>
            <?php $z = 1; ?>
            @foreach($suppliers as $supplier)
                <tr>
                    <td>{{ $z++ }}</td>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->userCategory->user_category_name }}</td>
                    <td>{{ $supplier->phone }}</td>
                    @if($supplier->userCategory->user_category_name == 'Supplier')
                        <td>
                            <a href="{{ route('br-supplier.show',$supplier->id) }}"
                               class="btn btn-sm btn-white">View</a>
                        </td>
                    @else
                        <td>
                            <a href="{{ route('br-customer.show',$supplier->id) }}"
                               class="btn btn-sm btn-white">View</a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <hr>
    <p>No customer record found.</p>
@endif