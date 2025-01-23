<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container mt-5">
        <h1>Edit Periodical</h1>
        <form action="{{ route('periodicals.update', $periodical->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH') <!-- Specify PATCH method explicitly -->

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $periodical->name }}">
            </div>
            <div class="form-group">
                <label for="path">Path</label>
                <input type="file" class="form-control" id="path" name="path" rows="3"
                    value="{{ $periodical->path }}">
            </div>
            <div class="form-group">
                <label for="img">Image</label>
                <input type="text" class="form-control" id="img" name="img" value="{{ $periodical->img }}">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Periodical</button>
            <a href="{{ route('periodicals.index') }}" class="btn btn-secondary mt-4">Back</a>
        </form>
    </div>
</x-app-layout>
