<!DOCTYPE html>
<html lang="en">

<head>
    <title>Test3</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>

    <div class="p-5 bg-primary text-white text-center">
        <h1>Test3</h1>
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
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="text-center"><h3>Orders</h3></div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Price</th>
                                    <th>Order Date</th>
                                    <th>Customer Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($data) > 0)
                                @foreach ($data as $d)
                                <tr>
                                    <td>{{$d->id}}</td>
                                    <td>{{$d->price}}</td>
                                    <td>{{$d->order_date}}</td>
                                    <td>{{$d->cutomer_name}}</td>
                                    <td>
                                        <!-- <a href="{{url('/view_orders/'.$d->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a> -->
                                        <a href="{{url('/delete_orders/'.$d->id)}}" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5" class="text-center">There is no records available.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>

</body>

</html>