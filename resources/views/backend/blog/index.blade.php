@extends('layouts.admin_layout')
@section('title', 'Blog Index')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">
    <div class="content-wrapper text-lime-50 p-20 bg">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="">
                            <div class="">
                                <div class="d-flex justify-content-end">
                                    <ol class=" mx-3 mt-3 m-0">
                                        <a href="{{ route('admin.blog.create') }}" class="p-2 bg-green-500 mx-5"><i
                                                class="fa fa-plus" aria-hidden="true"></i>
                                            Add Blog</a>
                                    </ol>
                                </div>
                            </div>
                            <h4 class="page-title m-10">Blog List</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="px-5">
                    <div class="col-12">
                        <div class="card bg-gray-500 text-lime-50">
                            <div class="card-body">


                                <table id="myTable" class="text-white w-100 bg-slate-900">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Blog Name </th>
                                            <th>Blog Title </th>
                                            <th>Blog Image </th>
                                            <th>Footer Description </th>
                                            <th>Status </th>
                                            <th>Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($blogs as $key => $item)
                                            <tr class="text-gray-500">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td><img src="{{ $item->image }}" height="40px" width="40px"
                                                        alt=""></td>
                                                <td>{!! $item->desc !!}</td>
                                                <td>{{ $item->status == 1 ? 'active' : 'Inactive' }}</td>
                                                <td class="row">
                                                    <a href="{{ route('admin.blog.edit', $item->id) }}"
                                                        class="bg-sky-400 p-2 text-gray-900 m-2">Edit</a>
                                                    <form action="{{ route('admin.blog.destroy', $item->id) }}">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit"
                                                            class="bg-red-400 p-2 text-gray-900 m-2"
                                                            id="delete">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <!-- end row-->



            </div> <!-- container -->

        </div> <!-- content -->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.36/build/pdfmake.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfmake@0.1.36/build/vfs_fonts.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>


@endsection
