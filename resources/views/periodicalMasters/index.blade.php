<x-app-layout>

    <div class="container mt-5">
        <div class="mb-4 d-flex justify-content-end">
            <a href="{{ route('periodical-masters.create') }}" class="btn btn-primary">Add New</a>
        </div>
        <h2 class="mb-4">Periodical List</h2>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Image</th>

                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($periodicalMasters->count() == 0)
                    <tr>
                        <td colspan="3" class="text-center">No Periodical List Found, Please Add</td>
                    </tr>
                @else
                    @foreach ($periodicalMasters as $key => $periodicalMaster)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $periodicalMaster->name }}</td>
                            <td>
                                @if ($periodicalMaster->img)
                                    <img src="{{ asset('storage/' . $periodicalMaster->img) }}"
                                        alt="{{ $periodicalMaster->name }}" style="max-width: 100px;">
                                @else
                                    N/A
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('periodical-masters.edit', $periodicalMaster->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>

                                {{-- If no foreign key constrains only display delete button else no delete button  --}}

                                @if ($periodicalMaster->periodicals->count() == 0)
                                    <form action="{{ route('periodical-masters.destroy', $periodicalMaster->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-danger btn-sm" disabled>Delete</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

</x-app-layout>
