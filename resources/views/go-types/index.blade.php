<x-app-layout>
    <div class="container">
        <div class="mb-4 d-flex justify-content-end">
            <a href="{{ route('go-types.create') }}" class="btn btn-primary">Add New</a>
        </div>
        <h2 class="mb-4">Go Type List</h2>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @if ($goTypes->count() == 0)
                    <tr>
                        <td colspan="3" class="text-center">No Go Type List Found, Please Add</td>
                    </tr>
                @else
                    @foreach ($goTypes as $key => $goType)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $goType->go_type }}</td>
                            <td>
                                <a href="{{ route('go-types.edit', $goType->id) }}" class="btn btn-primary">Edit</a>

                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</x-app-layout>
