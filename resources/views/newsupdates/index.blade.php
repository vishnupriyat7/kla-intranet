<x-app-layout>
    <div class="container mt-5">
        <h2 class="mb-4">News List</h2>
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('news-updates.create') }}" class="btn btn-primary">Add News</a>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($newsupdates as $news)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $news->title }}</td>
                        <td>{{ $news->date }}</td>
                        <td>
                            @if ($news->status)
                                Published
                            @else
                                Unpublished
                            @endif
                        </td>
                        <td>
                            @if ($news->path)
                                <button class="ri ri-eye-fill btn btn-info" data-bs-toggle="modal" data-bs-target="#newsModal{{ $loop->iteration }}"></button>
                            @else
                                N/A
                            @endif
                            <div class="modal fade" id="newsModal{{ $loop->iteration }}" tabindex="-1" role="dialog"
                                aria-labelledby="newsModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="newsModalLabel">{{ $news->title }}</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe src="{{ asset('storage/' . $news->path) }}" width="100%"
                                                height="500px"></iframe>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('news-updates.edit', $news->id) }}" class="ri-edit-fill btn btn-primary"></a>
                            <form action="{{ route('news-updates.destroy', $news->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ri-delete-bin-2-fill btn btn-danger"></button>
                            </form>
                        </td>
                    </tr>

                @endforeach
            </tbody>

        </table>

    </div>




</x-app-layout>
