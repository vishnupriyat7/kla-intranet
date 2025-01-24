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

            </tbody>

        </table>

    </div>




</x-app-layout>
