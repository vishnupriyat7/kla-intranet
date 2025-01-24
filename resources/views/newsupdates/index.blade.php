<x-app-layout>
    <div class="container mt-5">
        <h2 class="mb-4">News List</h2>
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('newsupdates.create') }}" class="btn btn-primary">Add News</a>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Path</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($newsupdates as $news)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $news->title }}</td>
                        <td>
                            @if ($news->path)
                                {{ $news->path }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $news->order }}</td>
                        <td>
                            @if ($news->status)
                                Published
                            @else
                                Unpublished
                            @endif
                        </td>
                        <td>
                            {{-- <a href="{{ route('newsupdates.edit', $news->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('newsupdates.destroy', $news->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form> --}}
                        </td>
                    </tr>

                @endforeach
            </tbody>

        </table>

    </div>




</x-app-layout>
