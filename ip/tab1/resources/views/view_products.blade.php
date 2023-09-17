<!DOCTYPE html>
<html lang="en">

<head>
    <title>Products</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>

    <div class="p-5 bg-primary text-white text-center">
        <h1>Products</h1>
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
                    <a href="{{ route('add.product') }}" class="btn btn-primary">Add Product</a>
                    <a href="javascript:void(0);" class="btn btn-primary add_product_m">Add Product Modal</a>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Images</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($data) > 0)
                                @foreach ($data as $d)
                                <tr>
                                    <td>{{$d->id}}</td>
                                    <td>{{$d->name}}</td>
                                    <td>{{$d->description}}</td>
                                    <td>{{$d->price}}</td>
                                    <td id="table_td_a">
                                        <a href="javascript:void(0);" data-productId="{{$d->id}}" class="viewImages">images</a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" data-productId="{{$d->id}}" class="btn btn-primary editProduct"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="javascript:void(0);" data-productId="{{$d->id}}" class="btn btn-danger deleteProduct"><i class="fa fa-trash-o"></i> Delete</a>
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
    <div class="modal fade" id="myModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-sm-12 img_div">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Product Modal Box -->
    <div class="modal fade" id="add_product_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="add_product_form" name="addProductForm" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Product name" value="{{old('name')}}" />
                                @error('name')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-12">
                                <textarea name="description" id="description" class="form-control" placeholder="Product description">{{old('description')}}</textarea>
                                @error('description')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price" id="price" class="form-control" placeholder="Product price" value="{{old('price')}}" />
                            @error('price')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group img_group">
                            <label>Image</label>
                            <input type="file" id="images" name="images[]" class="form-control" multiple />
                            @error('images')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-sm-offset-2 col-sm-10 text-center my-3">
                            <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                        </div>
                        <input type="hidden" name="product_id" class="product_id_for_update">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Product Modal Box -->
    <div class="modal fade" id="delete_product_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading">Do you want to remove ?</h4>
                </div>
                <div class="modal-body">
                    <form id="delete_product_form" name="deleteProductForm" class="form-horizontal">
                        <input type="hidden" name="product_id" class="product_id_for_delete">
                        <div class="col-sm-offset-2 col-sm-10 text-center my-3">
                            <button type="submit" class="btn btn-danger" id="deleteBtn">Delete</button>
                            <a href="javascript:void(0);" class="btn btn-primary cancel_delete">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    $(document).ready(function() {
        //view images from product records
        $('.viewImages').click(function(){

            var product_id = $(this).attr('data-productId');
            var product_images_view_url = "{{ route('view.product.images', ['product_id' => ':product_id']) }}";
            product_images_view_url = product_images_view_url.replace(':product_id', product_id);

            $('.img_div').html('');

            $.ajax({
                //url: "{{ route('view.product.images', '') }}"+"/"+product_id,
                url: product_images_view_url,
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    $('#myModel').modal('show');
                    if($.isEmptyObject(data)) {
                        if ($('.product_image_removed_alert').length > 0) {
                            $('.product_image_removed_alert').remove();
                        }
                        $('.img_div').html("<h3><b>There is no image in this product</b></h3>");
                    } else {
                        var imgHtml = '';
                        $('#modelHeading').html('Images for productid '+product_id);

                        for (var i=0; i< data.length; i++) {
                            var imgu = "{{ url('upload/images/product/', '') }}"+"/"+data[i].name;
                            imgHtml = '<div class="product_img_div_'+data[i].id+' my-3"><img src='+imgu+' alt="'+data[i].name+'" width="100px" height="100px"/><a href="javascript:void(0);" class="remove_product_image" data-productImageId="'+data[i].id+'">Remove</a></div>';
                            $('.img_div').append(imgHtml);
                        }

                        $('.img_div').append('<div class="img_delete_error"></div>')
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });

        //remove product image
        $('.modal-body').on('click', '.remove_product_image', function(){
            var product_image_id = $(this).attr('data-productImageId');
            var product_image_delete_url = "{{ route('delete.product.image', ['delete_id' => ':delete_id']) }}";
            product_image_delete_url = product_image_delete_url.replace(':delete_id', product_image_id);

            $.ajax({
                url: product_image_delete_url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'success') {
                        $('.img_delete_error').html('');
                        if ($('.product_image_removed_alert').length > 0) {
                            $('.product_image_removed_alert').remove();
                        }
                        if($('.product_img_div_'+product_image_id).length > 0) {
                            $('.product_img_div_'+product_image_id).remove();
                        }
                        $('.modal-body').prepend('<span class="alert alert-success product_image_removed_alert">'+data.message+'</span>');
                    } else {
                        $('.img_delete_error').append('<span class="alert alert-danger">Something went wrong.</span>');
                    }
                },
                error: function(data) {
                    console.log('Error: ', data);
                }
            });
        });

        //add product modal
        $('.add_product_m').click(function(){
            $('#add_product_form').trigger('reset');
            $('#add_product_modal').modal('show');
            if ($('.pro_img').length > 0) {
                $('.pro_img').remove();
            }
            if ($('.product_edit_alert').length > 0) {
                $('.product_edit_alert').remove();
            }
            $('#add_product_modal #modelHeading').html('Add Product');
            $('#saveBtn').html('Save');
            $('.product_id_for_update').val('');
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //add product using modal
        $('#saveBtn').click(function(e){
            e.preventDefault();

            var formData = new FormData($('#add_product_form')[0]);
            var TotalImages = $('#images')[0].files.length;
            
            if (TotalImages > 0) {
                var images = $('#images')[0];
                for (let i = 0; i < TotalImages; i++) {
                    formData.append('images' + i, images.files[i]);
                }
                formData.append('TotalImages', TotalImages);
            }

            $.ajax({
                url: "{{ route('store.product.ajax') }}",
                data: formData,
                type: 'POST',
                processData: false,
                cache: false,
                contentType: false,
                success: function(data) {
                    if ($('.product_image_added_alert').length > 0) {
                        $('.product_image_added_alert').remove();
                    }

                    $('#add_product_form').trigger('reset');
                    $('#add_product_modal').modal('hide');
                    //table.draw();

                    if(data.status == 'success') {
                        $('.table-responsive').prepend('<span class="alert alert-success product_image_added_alert">'+data.message+'</span>');
                    }
                },
                error: function(data) {
                    console.log('Error: ', data);
                }
            });
        });

        //edit product using modal
        $('.editProduct').click(function(){
            var product_id = $(this).attr('data-productId');
            var product_edit_url = "{{ route('edit.product.ajax', ['edit_id' => ':edit_id']) }}"
            product_edit_url = product_edit_url.replace(':edit_id', product_id);

            $.ajax({
                url: product_edit_url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'success') {
                        $('#add_product_modal').modal('show');
                        $('#add_product_modal #modelHeading').html('Edit Product');
                        if ($('.product_edit_alert').length > 0) {
                            $('.product_edit_alert').remove();
                        }
                        $('.product_id_for_update').val(data.product_data.id);
                        $('#name').val(data.product_data.name);
                        $('#description').val(data.product_data.description);
                        $('#price').val(data.product_data.price);
                        $('#saveBtn').html('Update');

                        if ($('.pro_img').length > 0) {
                            $('.pro_img').remove();
                        }
                        if(!$.isEmptyObject(data.product_images_data)){
                            data.product_images_data.forEach(function(val){
                                var img_src = "{{ url('upload/images/product/', '') }}"+"/"+val.name;
                                $('.img_group').append('<img src='+img_src+' alt='+val.name+' class="pro_img" width="50px" height="50px" />');
                            });
                        } else {
                            if ($('.pro_img').length > 0) {
                                $('.pro_img').remove();
                            }
                        }
                    } else {
                        $('.modal-body').prepend('<span class="alert alert-success product_edit_alert">'+data.message+'</span>');
                    }
                },
                error: function(data) {
                    console.log('Error: ', data);
                }
            });
        });

        //open delete product modal
        $('.deleteProduct').click(function(){
            var product_id = $(this).attr('data-productId');
            var product_images_count_url = "{{ route('count.product.images.ajax', ['product_id' => ':product_id']) }}"
            product_images_count_url = product_images_count_url.replace(':product_id', product_id);

            $.ajax({
                url: product_images_count_url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if ($('.product_delete_img_alert').length > 0) {
                        $('.product_delete_img_alert').remove();
                    }
                    if ($('.product_image_removed_alert').length > 0) {
                        $('.product_image_removed_alert').remove();
                    }
                    $('#delete_product_modal').modal('show');
                    if(data.status == 'success') {
                        $('#deleteBtn').attr('disabled', true);
                        $('.product_id_for_delete').val('');
                        $('#delete_product_form').prepend('<div class="text-center product_delete_img_alert"><span class="alert alert-danger">Product has images first remove those.</span></div>');
                    } else {
                        $('#deleteBtn').removeAttr('disabled');
                        $('.product_id_for_delete').val(product_id);
                    }
                },
                error: function(data) {
                    console.log('Error: ', data);
                }
            });
        });

        //close delete product modal
        $('.cancel_delete').click(function(){
            $('#delete_product_modal').modal('hide');
        });

        //delete product
        $('#deleteBtn').click(function(e){
            e.preventDefault();
            
            var product_id = $('.product_id_for_delete').val();
            var product_delete_url = "{{ route('delete.product.ajax', ['delete_id' => ':delete_id']) }}"
            product_delete_url = product_delete_url.replace(':delete_id', product_id);

            $.ajax({
                url: product_delete_url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if ($('.product_image_deleted_alert').length > 0) {
                        $('.product_image_deleted_alert').remove();
                    }

                    if(data.status == 'success') {
                        $('#delete_product_modal').modal('hide');
                        $('.table-responsive').prepend('<span class="alert alert-success product_image_deleted_alert">'+data.message+'</span>');
                    }
                },
                error: function(data) {
                    console.log('Error: ', data);
                }
            });
        });
    });
</script>

</html>