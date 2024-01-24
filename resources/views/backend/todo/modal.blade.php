<!-- resources/views/todos/layouts/modal.blade.php -->

@section('modal')
    <div id="modal" class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center hidden">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Todo</p>
                    <div onclick="closeModal()" class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 18 18">
                            <path d="M1 1l6 6m0 0l6-6m-6 6l6 6m-6-6l6-6" stroke="white" stroke-width="2" fill="none"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>

                <!--Body-->
                <div class="mb-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
  
@endsection
