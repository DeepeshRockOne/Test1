<!DOCTYPE html>
<html lang="en">
<head>
  <title>Test6</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>

<div class="p-5 bg-primary text-white text-center">
  <h1>Login With G</h1>
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
  <div class="text-center my-3">
    @if (Session()->has('success'))
      <span class="alert alert-success">{!! Session()->get('success') !!}</span>
    @endif
    @if (Session()->has('fail'))
      <span class="alert alert-success">{!! Session()->get('fail') !!}</span>
    @endif
  </div>
  <div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <div class="text-center">
            <a class="btn btn-primary" href="{{ route('login.with.google') }}">Login With Google</a>
        </div>
    </div>
    <div class="col-lg-3"></div>
  </div>
</div>

</body>
</html>
