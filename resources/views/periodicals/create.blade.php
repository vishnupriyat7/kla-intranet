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
                            <label for="name_eng" class="form-label">Periodical Master</label>
                            <select class="form-select" id="name_eng" name="name_eng" required>
                                <option value="">Select Periodical Item</option>
                                @foreach ($periodicalMasters as $periodicalMaster)
                                    <option value="{{ $periodicalMaster->id }}">{{ $periodicalMaster->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="path" class="form-label">Upload File (Path)</label>
                            <input type="file" class="form-control" id="path" name="path" required>
                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('periodicals.index') }}" class="btn btn-secondary">Back</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
