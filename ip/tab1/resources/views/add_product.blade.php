<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Product</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>

    <div class="p-5 bg-primary text-white text-center">
        <h1>Add Product</h1>
    </div>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="text-center">
            @if (Session()->has('success'))
                <span class="alert alert-success">{!! Session()->get('success') !!}</span>
            @endif
            @if (Session()->has('fail'))
                <span class="alert alert-danger">{!! Session()->get('fail') !!}</span>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <div class="text-right p-3">
                    <a href="{{ route('view.products') }}" class="btn btn-primary">View Products</a>
                </div>
                <form action="{{ route('store.product') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control" placeholder="Product name" value="{{old('name')}}" />
                        @error('name')
							<div class="alert alert-danger">{{$message}}</div>
						@enderror
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <textarea name="description" class="form-control" placeholder="Product description">{{old('description')}}</textarea>
                        @error('description')
							<div class="alert alert-danger">{{$message}}</div>
						@enderror
                    </div>
                    <div class="form-group">
                        <label>Price:</label>
                        <input type="text" name="price" class="form-control" placeholder="Product price" value="{{old('price')}}" />
                        @error('price')
							<div class="alert alert-danger">{{$message}}</div>
						@enderror
                    </div>
                    <div class="form-group">
                        <label>Image:</label>
                        <input type="file" name="images[]" class="form-control" multiple />
                        @error('images')
							<div class="alert alert-danger">{{$message}}</div>
						@enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary my-3">Add Product</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>

</body>

</html>
