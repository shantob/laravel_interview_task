@extends('layouts.admin_layout')
@section('title', 'Dashboard')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h2 class=" text-center text-gray-100">Admin Dashboard</h2>
    </div>
@endsection
