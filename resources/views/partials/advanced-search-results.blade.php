@if (isset($results) && count($results) > 0)
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Number</th>
                    <th>Date</th>
                    @if($orderType == 'G')
                        <th>Type</th>
                    @endif
                    <th>Title</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $index => $result)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $result->number }}</td>
                        <td>{{ $result->date ? \Carbon\Carbon::parse($result->date)->format('d-m-Y') :
                        ($result->published_date ? \Carbon\Carbon::parse($result->published_date)->format('d-m-Y') :
                        'N/A') }}</td>
                        @if($orderType == 'G')
                            <td>{{
                            $result->go_type == 'M' ? 'Manuscript (കയ്യെഴുത്ത്)' :
                            ($result->go_type == 'R' ? 'Routine (സാധാ)' :
                                ($result->go_type == 'P' ? 'Print' : 'N/A'))
                                                            }}</td>
                        @endif
                        <td>{{ $result->title ?? 'N/A' }}</td>
                        <td>
                            @if (isset($result->path))
                                <a href="{{ asset('storage/' . $result->path) }}" class="h6" data-bs-toggle="modal"
                                    data-bs-target="#pdfModal" data-pdf="{{ asset('storage/' . $result->path) }}"
                                    data-title="{{ $result->title }}">
                                    <i class="bi bi-eye-fill" style="font-size:18px;color:rgb(60, 93, 240)"></i>
                                </a>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@elseif(isset($results))
    <div class="alert alert-warning mt-4">Please select an Order Type to proceed with the search.</div>
@endif
