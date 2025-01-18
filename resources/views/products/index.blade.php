<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5 my-5 ">
        <h2 class="text-center mb-3">Product Management System</h2>
                @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
                @endif

                <form action="{{ route('products.search') }}" method="post">
                    <input class="form-control" type="text" name="search" placeholder="Search">
                    <button type="submit">Search</button>
                </form>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a style="margin-top: 12px" href="{{ route('products.create') }}" class="btn btn-success mb-3 mt-3 me-md-2">Create New Product</a>
        </div>

        
        <!-- <a style="margin-top: 12px" href="{{ route('products.create') }}" class="btn btn-primary mb-3 mt-3 me-md-2">Create New Product</a> -->

       
        <div style="margin-bottom:12px " class="sorting-links">
            <a href="{{ route('products.index', ['sort' => 'name', 'direction' => (request('sort') == 'name'  && request('direction')== 'asc') ? 'desc' : 'asc']) }}">
                Sort by Name 
                @if (request('sort') == 'name')
                    ({{ request('direction')== 'asc' ? '↓' : '↑' }})
                @endif
            </a>
        
            <a style='margin-left:15px' href="{{ route('products.index', ['sort' => 'price', 'direction' => (request('sort') == 'price' && request('direction')== 'asc') ? 'desc' : 'asc']) }}">
                Sort by Price
                @if (request('sort') == 'price')
                    ({{ request('direction')== 'asc' ? '↓' : '↑' }})
                @endif
            </a>
        </div>
        <!-- Product Table -->
        <table class="table table-bordered table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Product_id</th>
                    <th>Name</th>
                    <th> Price</th>
                    <th>Description</th>
                    <th>Stock</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->product_id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->stock }}</td>
                        <td> @if ($product->image)
                            <img src="{{ asset('storage/'. $product->image) }}" alt="{{ $product->name }}" style="width: 50px;height:50px;border-radius: 25px;"></td>
                        @else
                        <img src=" " class="card-img-top" alt="No Image">
                        @endif
                        <td class="d-flex p-2 grid gap-3">
                            
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm p-2 g-col-6">Show</a>

                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm p-2 g-col-6">Edit</a>


                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning btn-sm p-2 g-col-6" onclick="return confirm('Delete this product, permanently lose information')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $products->appends(request()->query())->links() }}    
</body>
</html>

