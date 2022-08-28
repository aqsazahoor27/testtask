@extends('layout.header')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/plugins/forms/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/plugins/forms/form-file-uploader.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/css/forms/select/select2.min.css')}}">
@endsection
@section('content')
@section('breadcrumb')
<h2 class="content-header-title float-left mb-0">
    {{$data['page_title']}}
</h2>
<div class="breadcrumb-wrapper">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('admin/products')}}">
              
                Products
                </a>
        </li>

        <li class="breadcrumb-item"><a href="#">
                {{$data['page_title']}}
            </a>
        </li>
    </ol>
</div>
@endsection
<div class="content-body">
    <section id="basic-input">
        <div class="card">
            <div class="card-body">

                <form action="{{ url('admin/saveproduct') }}" class="" id="form_submit" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label>Title </label>
                                <input class="form-control" name="title" type="text" value="{{(isset($data['results']->id) ? $data['results']->title : '')}}">
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label>Slug </label>
                                <input class="form-control" name="slug" type="text" value="{{(isset($data['results']->id) ? $data['results']->slug : '')}}">
                            </div>
                        </div>
                       
                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" data-option-id="{{(isset($data['results']->id) ? $data['results']->status : '')}}">
                                    <option value="">Select</option>
                                    <option>Published</option>
                                    <option>Unpublished</option>
                                </select>
                            </div>
                        </div>
                      
                    </div>
                    <div class="row">
                       
                       

                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label>Categories</label>
                                <select name="category_id" class=" form-control" data-option-id="{{(isset($data['results']->id) ? $data['results']->category_id : '')}}">
                                    @foreach($data['categories'] as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label>Price </label>
                                <input class="form-control" name="price" type="text" value="{{(isset($data['results']->id) ? $data['results']->price : 0)}}">
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        
                        <div class="col-md-8 col-12">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Description" name="description">{{(isset($data['results']->description) ? $data['results']->description : '')}}</textarea>
                            </div>
                        </div>
                       

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    Upload File
                                </label>
                                <div action="{{url('admin/upload_file?url=-uploads-tutorials') }}" class="dropzone" id="dropzoneupload">
                                    <div class="dz-message">Drop files here or click to upload.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if(isset($data['results']->id))
                           
                            <img class="img-fluid mt-3" src="{{$data['results']->file_upload }}">
                            @endif
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control mb-3" type="hidden" placeholder="File URL" name="file_upload" value="{{(isset($data['results']->id) ? $data['results']->file_upload : url('/uploads/tutorials/notfound.png'))}}">
                            </div>
                        </div>
                    </div>
                    <input class="form-control" name="id" type="hidden" value="{{(isset($data['results']->id) ? $data['results']->id : '')}}">
                    <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Save Changes</button>
                    <a class="btn btn-outline-secondary" href="{{url('admin/products')}}">Go To List</a>

                  
                </form>

            </div>
        </div>

    </section>
</div>
@endsection


@section('js')
<script src="{{asset('/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/extensions/dropzone.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('/app-assets/js/scripts/forms/form-select2.js')}}"></script>

<script type="text/javascript">
    $('.tariningR').addClass('sidebar-group-active');
    var type = 'post';
    $('.' + type).addClass('active');

   


    $('select.classrooms').select2({
        dropdownAutoWidth: true,
        width: '100%',
        placeholder: 'Select '
    });

 
        DropzoneSinglefunc('dropzoneupload', '.png,.jpg,.jpge', 1., 'file_upload');
    window.ResetValidationForm = "{{(isset($data['results']->id) ? $data['results']->id : 0)}}"
    window.formValidationObj = $('#form_submit').validate({
        rules: {
            'title': {
                required: true,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            'description': {
                required: true,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            'status': {
                required: true,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            'duration': {
                required: true,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            'training_slug': {
                required: true,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            'user_id': {
                required: true,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            'price': {
                required: true,
                number: true,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
        }
    });
</script>
    <!-- form submission -->
    <script src="{{asset('/app-assets/js/scripts/forms/submitter.js')}}"></script>
@endsection