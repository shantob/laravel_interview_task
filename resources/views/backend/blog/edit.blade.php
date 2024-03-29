@extends('layouts.admin_layout')
@section('title', 'Blog Edit')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="p-20">
        <div class="content">

            <!-- Start Content-->
            <div class="text-white">

                <div class="row">
                    <div class="col-12">
                        <div class="">
                            <div class="">
                                <div class="flex justify-end">
                                    <ol class=" mx-3 mt-3 m-0">
                                        <a href="{{ route('admin.blog.index') }}" class="bg-green-600 p-2"><i class="fa fa-list"
                                                aria-hidden="true"></i>
                                            Back To List</a>
                                    </ol>
                                </div>
                            </div>
                            <h4 class="my-2 bg-slate-500 p-2">Blog Edit</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <!-- Form row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-gray-900">
                            <div class="card-body">

                                <form id="myForm" method="post" action="{{ route('admin.blog.update', $blog->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <div class="row">
                                        <div class="grid gap-6 mb-6 md:grid-cols">
                                            <label for="inputEmail4" class="form-label">Blog Name <span
                                                    class="text-danger ">*</span></label>
                                            <input type="text" name="name"
                                                class="text-gray-600 @error('name') is-invalid @enderror" id="inputEmail4"
                                                placeholder="Add Blog Name" value="{{ $blog->name }}">
                                        </div>

                                        <div class="grid gap-6 mb-6 md:grid-cols">
                                            <label for="inputEmail4" class="form-label">Blog Title <span
                                                    class="text-danger ">*</span></label>
                                            <input type="text" name="title"
                                                class="text-gray-600 @error('title') is-invalid @enderror" id="inputEmail4"
                                                placeholder="Add Blog Title" value="{{ $blog->title }}">
                                        </div>

                                        <div class="grid gap-6 mb-6 md:grid-cols">
                                            <label for="inputEmail4" class="form-label">Descripton <span
                                                    class="text-danger">*</span> </label>
                                            <textarea type="text" name="desc" class="text-gray-600 @error('desc') is-invalid @enderror" id="inputEmail4"
                                                placeholder="Add Blog descruotuib"> {!! $blog->desc !!}</textarea>
                                        </div>

                                        <div class="grid gap-6 mb-6 md:grid-cols">
                                            <label for="logo" class="form-label">Image </label>
                                            <input type="file" name="image" class="" id="logo"
                                                onChange="mainThamUrl(this)">
                                            <div class="mx-3">
                                                <img src="" id="mainThmb">
                                            </div>
                                            <img src="{{$blog->image}}" height="60px" width="60px" alt="">
                                        </div>

                                        <div class="grid gap-6 mb-6 md:grid-cols">
                                            <label for="inputEmail4" class="form-label">Is Active <span
                                                    class="text-danger">*</span> </label>
                                            <input type="checkbox" name="status" value="1" {{$blog->status==1? "checked":''}} class="form-chedk"
                                                id="inputEmail4" placeholder="Add Blog Icon">
                                        </div>
                                    </div>
                                    <button type="submit" class="bg-green-600 p-3">Save
                                        Changes</button>



                                </form>

                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->



            </div> <!-- container -->

        </div> <!-- content -->
    </div>
    <script type="text/javascript">
        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    amount: {
                        required: true,
                    },
                },
                messages: {
                    amount: {
                        required: 'Please Enter Blog Name',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
