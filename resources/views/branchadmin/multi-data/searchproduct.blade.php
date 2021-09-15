<div class="card bg-secondary shadow">
    <div class="card-header bg-white border-0">
        <h3>Search Result...</h3><br>
        @if($products->count() > 0)
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Product</th>
                        <th scope="col">Purchased Price</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Details</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <?php $sno = 1; ?>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $sno++ }}</td>
                            <td>
                                {{ $product->product_name }}
                            </td>
                            <td>
                                Rs. {{ $product->product_purchased_price }}
                            </td>
                            <?php
                            $quantity = $product->productInStock->total_stock / $product->product_unit_quantity;
                            ?>
                            <td>{{ $quantity }} {{ $product->product_purchased_unit }}</td>
                            <td>
                                <a href="{{ route('br-productsetup.show',$product->id) }}" target="_blank"
                                   class="btn btn-sm btn-neutral">View</a>
                            </td>
                            <td id="product_{{ $product->id }}">
                                <button type="button" class="btn btn-sm btn-default"
                                        data-toggle="modal" data-target="#add_product"
                                        onclick="addProduct('{{ $product->id }}','{{ $product->product_purchased_unit }}')">
                                    Add to Cart
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No search result found.</p>
        @endif
    </div>
</div>
<hr>
