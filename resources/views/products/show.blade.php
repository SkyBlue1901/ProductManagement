<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Product Details</h1>

        <div class="card">
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="width: 100px;height:100px;">
            @else
                <img src="https://via.placeholder.com/600x400" class="card-img-top" alt="No Image">
            @endif

            <div class="card-body">
                <p class="card-text"><strong>Product Name:</strong> {{ $product->name}}</p>
                <p class="card-text"><strong>Product ID:</strong> {{ $product->product_id}}</p>
                <p class="card-text "><strong>Price:</strong>${{ number_format($product->price, 2) }}</p>
                <p class="card-text"><strong>Stock:</strong> {{ $product->stock}}</p>
                <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
            </div>

            <div class="card-footer text-center">
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-warning" onclick="return confirm('Delete this product, permanently lose information');">Delete</button>
                </form>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
