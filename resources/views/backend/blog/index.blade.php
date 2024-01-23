@extends('layouts.admin_layout')
@section('title', 'Blog Index')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="">
                            <div class="">
                                <div class="d-flex justify-content-end">
                                    <ol class=" mx-3 mt-3 m-0">
                                        <a href="{{ route('admin.blog.create') }}" class="btn btn-success"><i class="fa fa-plus"
                                                aria-hidden="true"></i>
                                            Add Blog</a>
                                    </ol>
                                </div>
                            </div>
                            <h4 class="page-title mx-3">Blog List</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card bg-gray-900">
                            <div class="card-body">


                                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Blog Name </th>
                                            <th>Blog Title  </th>
                                            <th>Blog Image  </th>
                                            <th>Footer Description  </th>
                                            <th>Status </th>
                                            <th>Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($blogs as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td><img src="{{$item->image}}" height="40px" width="40px" alt=""></td>
                                                <td>{!! $item->desc !!}</td>
                                                <td>{{ $item->status == 1 ? 'active' : 'Inactive' }}</td>
                                                <td class="row">
                                                    <a href="{{ route('admin.blog.edit', $item->id) }}"
                                                        class="btn btn-primary rounded-pill waves-effect waves-light">Edit</a>
                                                    <form action="{{ route('admin.blog.destroy', $item->id) }}">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger rounded-pill waves-effect waves-light"
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
@endsection
