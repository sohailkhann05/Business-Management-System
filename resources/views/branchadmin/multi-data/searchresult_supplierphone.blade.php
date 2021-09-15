<?php $i = $suppliers->count(); ?>
@if($i > 0)
    <br>
    <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Details</th>
            </tr>
            </thead>
            <tbody>
            <?php $z = 1; ?>
            @foreach($suppliers as $supplier)
                @if($supplier->userCategory->user_category_name == 'Supplier')
                    <tr>
                        <td>{{ $z++ }}</td>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->phone }}</td>
                        <td>
                            <a href="{{ route('br-supplier.show',$supplier->id) }}"
                               class="btn btn-sm btn-default" target="_blank">View</a>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
@else
    No supplier record found.
@endif