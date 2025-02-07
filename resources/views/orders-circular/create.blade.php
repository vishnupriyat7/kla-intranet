<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="text-center">
                        <h2 class="mb-4 fw-bold">Add New Govt Order</h2>
                    </div>

                    <form action="{{ route('orders-circular.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="type" class="form-label">Select Type</label>
                            <select class="form-select" id="type" name="type" required
                                onchange="toggleGoType()">
                                <option value="">Select Type</option>
                                <option value="G">Govt Order</option>
                                <option value="O">Office Order</option>
                                <option value="C">Circular</option>
                            </select>
                            @error('type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- I want to display select GO Type only if Type is Govt Order --}}
                        <div class="mb-3" id="goType" style="display: none">
                            <label for="go_type" class="form-label">Select GO Type</label>
                            <select class="form-select" id="go_type" name="go_type" required>
                                <option value="">Select GO Type</option>
                                <option value="M">സർക്കാർ ഉത്തരവുകൾ കയ്യെഴുത്തു (Govt.Order Manuscript)</option>
                                <option value="R">സർക്കാർ ഉത്തരവുകൾ സാധാ (Govt.Order Routine)</option>
                                <option value="P">സർക്കാർ ഉത്തരവുകൾ അച്ചടി (Govt. Order Print) </option>

                            </select>
                            @error('go_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="go_no" class="form-label">Number</label>
                            <input type="text" class="form-control" id="go_no" name="go_no"
                                placeholder="Enter No" required>
                            @error('go_no')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="go_date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="go_date" name="go_date"
                                placeholder="Enter Date" required>
                            @error('go_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="go_title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="go_title" name="go_title"
                                placeholder="Enter Title" required>
                            @error('go_title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="go_keyword" class="form-label">Keyword</label>
                            <input type="text" class="form-control" id="go_keyword" name="go_keyword"
                                placeholder="Enter Keyword" required>
                            @error('go_keyword')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="go_path" class="form-label">Choose File</label>
                            <input type="file" class="form-control" id="go_path" name="go_path" required>
                            @error('go_path')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('orders-circular.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function toggleGoType() {
        var type = document.getElementById('type').value;
        if (type == 'G') {
            document.getElementById('goType').style.display = 'block';
            document.getElementById('go_type').setAttribute('required', 'required');
        } else {
            document.getElementById('goType').style.display = 'none';
            document.getElementById('go_type').removeAttribute('required');
        }
    }
</script>
