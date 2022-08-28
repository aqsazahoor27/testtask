@extends('layout.header')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/plugins/forms/form-validation.css')}}">
@endsection
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">Product Management</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin/product-categories')}}"> Categories</a>
            </li>
            <li class="breadcrumb-item"><a href="#">{{$data['page_title']}}</a>
            </li>
        </ol>
    </div>
@endsection
@section('content')
    <div class="content-body">
    <section id="basic-input">
                            <div class="card">
                                <div class="card-body">
                                           <form action="{{ url('admin/saveproduct-category') }}" class="" id="form_submit" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>
                                                                    Category Name
                                                                </label>
                                                                <input  class="form-control" name="name" type="text" value="{{(isset($data['results']->name) ? $data['results']->name : '')}}">
                                                                </input>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <input class="form-control" name="id" type="hidden" value="{{(isset($data['results']->id) ? $data['results']->id : '')}}">
                                               <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Save Changes</button>
                                               <a href="{{url('admin/course-categories')}}" class="btn btn-outline-secondary">Back</a>
                                            </input>
                                            </input>
                                        </form>
                                </div>
                            </div>


 </section>
</div>
@endsection
@section('js')
    <script src="{{asset('/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
        $('.tariningR').addClass('sidebar-group-active');
        $('.classrooms').addClass('active');
        window.ResetValidationForm = "{{(isset($data['results']->id) ? $data['results']->id : 0)}}"
        window.formValidationObj = $('#form_submit').validate({
            rules: {
                'name': {
                    required: true, 
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
