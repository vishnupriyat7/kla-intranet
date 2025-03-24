<div class="tab-class">
    <!-- Month Tabs for the selected Order Type -->
    <div class="d-flex justify-content-between border-bottom mb-4">
        <ul class="nav nav-pills d-inline-flex text-center">
            @foreach ($months as $month)
                <li class="nav-item mb-3">
                    <a class="d-flex py-2 bg-light rounded-pill me-2 {{ $month['no'] == date('n') ? 'active' : '' }}"
                        data-bs-toggle="pill" href="#{{ $type }}-tab-{{ $month['no'] }}">
                        <span class="text-dark" style="width: 200px;">
                            {{ $month['name'] }}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
        <!-- Records Per Page Dropdown -->
        <div>
            <label for="recordsPerPage" class="me-2">Show</label>
            <select id="recordsPerPage" class="form-select form-select-sm" style="width: auto; display: inline-block;">
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="200">200</option>
                <option value="500">500</option>
            </select>
            <span>records</span>
        </div>
    </div>

    <!-- Month-wise Order Listings -->
    <div class="tab-content">
        @foreach ($months as $month)
            <div id="{{ $type }}-tab-{{ $month['no'] }}"
                class="tab-pane fade show {{ $month['no'] == date('m') ? 'active' : '' }}">
                <div class="row g-4">
                    <div class="col-12">
                        @foreach ($orders as $order)
                            @if (\Carbon\Carbon::parse($order->date)->format('m') == $month['no'] && $order->go_type == $type)
                                <div class="features-content d-flex flex-column mt-3">
                                    {{-- <a href="{{ asset('storage/' . $order->path) }}" class="h6" target="_blank">
                                        <i class="fas fa-solid fa-paperclip me-1"></i> {{ $order->title }}
                                    </a> --}}
                                    <a href="{{ asset('storage/' . $order->path) }}" class="h6"
                                        data-bs-toggle="modal" data-bs-target="#pdfModal"
                                        data-pdf="{{ asset('storage/' . $order->path) }}"
                                        data-title="{{ $order->title }}">

                                        <i class="fas fa-solid fa-paperclip me-1" style="color:rgb(60, 93, 240)"></i>
                                        {{ $order->title }}
                                        {{ $order->title }}
                                    </a>
                                    <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i>
                                        {{ \Carbon\Carbon::parse($order->date)->format('M d Y') }}
                                    </small>
                                    </br>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- 🔹 Single PDF Modal -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">PDF Viewer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="pdfViewer" src="" width="100%" height="700px" style="border: none;"></iframe>
            </div>
        </div>
    </div>
</div>
<script>
    // PDF POP UP MODAL Script
    document.addEventListener("DOMContentLoaded", function() {
        var pdfModal = document.getElementById("pdfModal");

        pdfModal.addEventListener("show.bs.modal", function(event) {
            var link = event.relatedTarget; // Link that triggered the modal
            var pdfUrl = link.getAttribute("data-pdf");
            var pdfTitle = link.getAttribute("data-title");

            // Set modal title and PDF source
            document.getElementById("pdfModalLabel").textContent = pdfTitle;
            document.getElementById("pdfViewer").src = pdfUrl;
        });

        pdfModal.addEventListener("hidden.bs.modal", function() {
            document.getElementById("pdfViewer").src = ""; // Reset iframe when modal is closed
        });

    });
</script>
