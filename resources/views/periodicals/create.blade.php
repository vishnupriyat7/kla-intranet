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


                    <form action="{{ route('periodicals.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter periodical name" required>
                        </div>
                        <div class="mb-3">
                            <label for="path" class="form-label">Upload File (Path)</label>
                            <input type="file" class="form-control" id="path" name="path" required>
                        </div>
                        <div class="mb-3">
                            <label for="img" class="form-label">Image</label>
                            <input type="text" class="form-control" id="img" name="img"
                                placeholder="Enter image name or URL">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
