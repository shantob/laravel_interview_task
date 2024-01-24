@extends('layouts.admin_layout')
@section('title', 'Blog Add')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="p-20">
        <section class="p-10">

            <!-- Start Content-->
            <div class="text-white">

                <div class="row">
                    <div class="col-12">
                        <div class="">
                            <div class="">
                                <div class="flex justify-end">
                                    <ol class=" mx-3 mt-3 m-0">
                                        <a href="{{ route('admin.blog.index') }}" class="p-2 cursor-pointer bg-green-700"><i class="fa fa-list"
                                                aria-hidden="true"></i>
                                            Back To List</a>
                                    </ol>
                                </div>
                            </div>
                            <h4 class="page-title mx-3">Blog Add</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <!-- Form row -->
                <div class="flexx">
                    <div class="col-12">
                        <div class="card bg-gray-900">
                            <div class="card-body" style="background-color: rgb(39, 36, 36)">

                                <form id="myForm" method="post" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="p-5">

                                        <div class="grid gap-6 mb-6 md:grid-cols">
                                            <label for="inputEmail4" class="form-label">Blog Name <span
                                                    class="text-red-500 ">*</span></label>
                                            <input type="text" name="name"
                                                class="text-gray-600 @error('name') border-red-600 @enderror" id="inputEmail4"
                                                placeholder="Add Blog Name" value="{{ old('name') }}">
                                        </div>

                                        <div class="grid gap-6 mb-6 md:grid-cols">
                                            <label for="inputEmail4" class="form-label">Blog Title <span
                                                    class="text-red-500 ">*</span></label>
                                            <input type="text" name="title"
                                                class="text-gray-600 @error('title') border-red-600 @enderror" id="inputEmail4"
                                                placeholder="Add Blog Title" value="{{ old('title') }}">
                                        </div>

                                        <div class="grid gap-6 mb-6 md:grid-cols">
                                            <label for="inputEmail4" class="form-label">Descripton <span
                                                    class="text-red-500">*</span> </label>
                                            <textarea type="text" name="desc" class="text-gray-600 @error('desc') border-red-600 @enderror" id="inputEmail4"
                                                placeholder="Add Blog descruotuib"> {!! old('desc') !!}</textarea>
                                        </div>


                                        <div class="grid gap-6 mb-6 md:grid-cols">
                                            <label for="logo" class="form-label">Image </label>
                                            <input type="file" name="image" class="text-gray-600" id="logo"
                                                onChange="mainThamUrl(this)">
                                            <div class="mx-3">
                                                <img src="" id="mainThmb">
                                            </div>
                                        </div>

                                        <div class="grid gap-6 mb-6 md:grid-cols">
                                            <label for="inputEmail4" class="form-label">Is Active <span
                                                    class="text-red-500">*</span> </label>
                                            <input type="checkbox" name="status" value="1" class="form-chedk"
                                                id="inputEmail4" placeholder="Add Blog Icon">
                                        </div>
                                    </div>
                                    <button type="submit" class="p-2 m-5 bg-green-800 text-lime-50">Save
                                        Changes</button>

                                </form>

                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container -->

        </section> <!-- content -->
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
@endsection
