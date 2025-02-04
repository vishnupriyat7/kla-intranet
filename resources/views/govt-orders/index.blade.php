<x-app-layout>
    <div class="container">
        <div class="mb-4 d-flex justify-content-end">
            <a href="{{ route('govt-orders.create') }}" class="btn btn-primary">Add New</a>
        </div>
        <h2 class="mb-4">Govt Order List</h2>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>GO.Type</th>
                    <th>GO.No</th>
                    <th>GO.Date</th>
                    <th>GO.Title</th>
                    <th>GO.Keyword</th>
                    <th>GO.Path</th>
                    <th>GO.File</th>
                    {{-- <th>Action</th> --}}
                </tr>
            </thead>
            <tbody>
            </tbody>

        </table>
  {{-- Provide Pagination --}}
        <div class="d-flex justify-content-center">
            {{ $periodicals->links() }}

        </div>
    </div>
</x-app-layout>
