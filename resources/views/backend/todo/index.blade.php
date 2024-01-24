@extends('layouts.admin_layout')
@section('title', 'Todo Index')
@section('content')
    <style>
        .dt-buttons .dt-button span {
            background-color: green;
            color: white;
            padding: 5px 7px
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">
    <div class=" text-lime-50 p-20 bg">
        <div class="">
            <div class="flex justify-end mb-4">
                <button onclick="openModal('create')" class="bg-blue-500 text-white p-2 rounded">Create Todo</button>
            </div>

            <table id="myTable" class="min-w-full bg-gray-500 border border-gray-300">
                <thead>
                    <tr>
                        <th class="border border-gray-300">ID</th>
                        <th class="border border-gray-300">Title</th>
                        <th class="border border-gray-300">Description</th>
                        <th class="border border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-900">
                    @foreach ($todos as $todo)
                        <tr class="">
                            <td class="border border-gray-300">{{ $todo->id }}</td>
                            <td class="border border-gray-300">{{ $todo->title }}</td>
                            <td class="border border-gray-300">{{ $todo->desc }}</td>
                            <td class="border border-gray-300">
                                <button onclick="openModal('edit', {{ $todo->id }})"
                                    class="bg-green-500 text-white p-2 rounded">Edit
                                </button>
                                <button onclick="deleteTodo({{ $todo->id }})"
                                    class="bg-red-500 text-white p-2 rounded">Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> <!-- content -->
    </div>

    <!-- Modal -->
    <div id="modal" class="hidden fixed inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modal content-->
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <!-- Heroicon name: outline/exclamation -->
                            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m0-8m-8 8h16M5 12h14"></path>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Create/Edit Todo
                            </h3>
                            <div class="mt-2">
                                <!-- Add your form fields here -->
                                <form id="todoForm" method="post">
                                    @csrf
                                    <input type="hidden" id="todoId">
                                    <div class="mb-4">
                                        <label for="title" class="block text-gray-600 text-sm font-medium">Title</label>
                                        <input type="text" name="title" id="title"
                                            class="mt-1 p-2 border rounded-md w-full" />
                                    </div>
                                    <div class="mb-4">
                                        <label for="desc"
                                            class="block text-gray-600 text-sm font-medium">Description</label>
                                        <textarea name="desc" id="desc" class="mt-1 p-2 border rounded-md w-full"></textarea>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="button"
                                            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                            onclick="saveTodo()">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    <script>
        function openModal(type, id = null) {
            const modal = document.getElementById('modal');
            modal.classList.remove('hidden');

            // Your logic for create/edit goes here

            if (type === 'edit') {
                // Fetch todo details by ID and populate the form for editing
                fetch(`/admin/todos/${id}/edit`)
                    .then(response => response.json())
                    .then(todo => {
                        // Assuming you have input fields in your modal with IDs like 'title' and 'desc'
                        document.getElementById('title').value = todo.title;
                        document.getElementById('desc').value = todo.desc;

                        // You might want to store the ID for later use
                        document.getElementById('todoId').value = todo.id;
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                // Handle logic for create
                // Clear the form or set default values
                document.getElementById('title').value = '';
                document.getElementById('desc').value = '';
                // Add other fields as needed
            }
        }

        function closeModal() {
            const modal = document.getElementById('modal');
            modal.classList.add('hidden');
            // Clear the form or reset values if needed
            document.getElementById('title').value = '';
            document.getElementById('desc').value = '';
            // Add other fields as needed
        }

        function deleteTodo(id) {
            if (confirm('Are you sure you want to delete this todo?')) {
                // Perform the deletion
                fetch(`/admin/todos/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Assuming you have a function to refresh the todo list
                        // You can update the logic based on your UI update requirements
                        refreshTodoList();
                    })
                    .catch(error => console.error('Error:', error));
            }
        }

        function refreshTodoList() {
         
        }

        function saveTodo() {
            const todoId = $('#todoId').val();
            const title = $('#title').val();
            const desc = $('#desc').val();

            const data = {
                id: todoId,
                title: title,
                desc: desc,
            };

            const url = `/admin/todos/${todoId ? todoId : 'store'}`;
            const method = todoId ? 'PUT' : 'POST';
            // Add CSRF token to the data
            data['_token'] = '{{ csrf_token() }}';
            $.ajax({
                url: url,
                method: method,
                data: data,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                success: function(data) {
                    refreshTodoList();
                    closeModal();
                },
                error: function(error) {
                    // console.error('Error:', error);
                },
            });

        }
    </script>

@endsection
