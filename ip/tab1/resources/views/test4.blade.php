<!DOCTYPE html>
<html lang="en">

<head>
    <title>Test4</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>

    <div class="p-5 bg-primary text-white text-center">
        <h1>Test4</h1>
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
            <div class="col-lg-3"></div>
            <div class="col-lg-6 input_fields_wrap">
                <div id="item" class="input-group my-3">
                    <input type="text" name="name" class="my_text_box form-control" />
                </div>
                <button name="add_text_box" class="btn btn-primary add_text_box">Add</button>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>

</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        var max = 5;

        var x = 1;
        $('.add_text_box').click(function(e) {

            e.preventDefault();
            $('.my_text_box').append('<p>test</p>');
            if (x < max) {
                x++;

                if (x == 2) {
                    $('<div id="item_'+x+'" class="input-group my-3"><input type="text" name="name" class="my_text_box_' + x + ' form-control" />&nbsp;&nbsp;&nbsp;<span class="input-group-btn"><button name="remove_text_box" class="btn btn-danger remove_text_box">Remove</button></span></div>').insertAfter('#item');
                } else {
                    $('<div id="item_'+x+'" class="input-group my-3"><input type="text" name="name" class="my_text_box_' + x + ' form-control" />&nbsp;&nbsp;&nbsp;<span class="input-group-btn"><button name="remove_text_box" class="btn btn-danger remove_text_box">Remove</button></span></div>').insertAfter("#item_"+(x-1));
                }
            }
        });

        $('.input_fields_wrap').on('click', 'button.remove_text_box', function(e) {
            e.preventDefault();

            if( $('#item_'+x).length) {
                $('#item_'+x).remove();
                x--;
            }
        });
    });
</script>