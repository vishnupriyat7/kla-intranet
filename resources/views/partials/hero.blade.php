 <!-- Hero Section Start -->
 <div class="container-fluid hero py-5">
     <div class="container py-5">
         <div class="tab-class mb-1">
             <div class="row g-4">
                 <div class="col-lg-12 col-xl-12">
                     <div class="d-flex flex-column flex-md-row justify-content-md-between border-bottom mb-4">
                         <h1 class="mb-4">What’s New</h1>
                         <ul class="nav nav-pills d-inline-flex text-center">
                             <li class="nav-item mb-3">
                                 <a class="d-flex py-2 bg-light rounded-pill active me-2" data-bs-toggle="pill"
                                     href="#tab-1">
                                     <span class="text-dark" style="width: 100px;">Gov.Order</span>
                                 </a>
                             </li>
                             <li class="nav-item mb-3">
                                 <a class="d-flex py-2 bg-light rounded-pill me-2" data-bs-toggle="pill" href="#tab-2">
                                     <span class="text-dark" style="width: 100px;">Off.Order</span>
                                 </a>
                             </li>
                             <li class="nav-item mb-3">
                                 <a class="d-flex py-2 bg-light rounded-pill me-2" data-bs-toggle="pill" href="#tab-3">
                                     <span class="text-dark" style="width: 100px;">Circular</span>
                                 </a>
                             </li>
                             <li class="nav-item mb-3">
                                 <a class="d-flex py-2 bg-light rounded-pill me-2" data-bs-toggle="pill" href="#tab-4">
                                     <span class="text-dark" style="width: 100px;">News</span>
                                 </a>
                             </li>

                         </ul>
                     </div>
                     <div class="tab-content mb-4">
                         <div id="tab-1" class="tab-pane fade show p-0 active">
                             <div class="row g-4">
                                 <div class="col-lg-12">
                                     <div class="features-content d-flex flex-column mt-3">
                                         @foreach ($gos as $go)
                                             <div class="mb-4">

                                                 {{-- <i class="bi bi-link"></i> --}}
                                                 <i class="bi bi-eye-fill"
                                                     style="font-size:20px;color:rgb(60, 93, 240)"></i>

                                                 <a href="#" class="h6" data-bs-toggle="modal"
                                                     data-bs-target="#pdfModal"
                                                     data-pdf="{{ asset('storage/' . $go->path) }}"
                                                     data-title="{{ $go->title }}">
                                                     {{-- <i class="ri-eye-fill"></i> --}}
                                                     {{ $go->title }}
                                                 </a>
                                                 <small class="text-body d-block">
                                                     <i class="fas fa-calendar-alt me-1"></i>
                                                     {{ \Carbon\Carbon::parse($go->date)->format('M d Y') }}
                                                 </small>
                                             </div>
                                         @endforeach
                                         <div class="mt-2 d-flex justify-content-center">
                                             <div class="col-4">
                                                 <a href="{{ route('home.order-circular', 'go') }}"
                                                     class="btn btn-outline-primary w-100 py-3 mb-4 rounded-pill text-dark
                                            hover-bg-primary text-hover-white border-primary">View
                                                     All >></a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div id="tab-2" class="tab-pane fade show p-0">
                             <div class="row g-4">
                                 <div class="col-lg-12">
                                     <div class="features-content d-flex flex-column mt-3">
                                         @foreach ($oos as $oo)
                                             <div class="mb-4">
                                                 <i class="bi bi-eye-fill"
                                                     style="font-size:18px;color:rgb(60, 93, 240)"></i>
                                                 <a href="#" class="h6"data-bs-toggle="modal"
                                                     data-bs-target="#pdfModal"
                                                     data-pdf="{{ asset('storage/' . $oo->path) }}"
                                                     data-title="{{ $oo->title }}">
                                                     {{-- <i class="fas fa-solid fa-paperclip me-1"></i> --}}
                                                     {{ $oo->title }}
                                                 </a>
                                                 <small class="text-body d-block">
                                                     <i class="fas fa-calendar-alt me-1"></i>
                                                     {{ \Carbon\Carbon::parse($oo->date)->format('M d Y') }}
                                                 </small>
                                             </div>
                                         @endforeach
                                         <div class="mt-2 d-flex justify-content-center">
                                             <div class="col-4">
                                                 <a href="{{ route('home.order-circular', 'oo') }}"
                                                     class="btn btn-outline-primary w-100 py-3 mb-4 rounded-pill text-dark
      hover-bg-primary text-hover-white border-primary">
                                                     View All >>
                                                 </a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div id="tab-3" class="tab-pane fade show p-0">
                             <div class="row g-4">
                                 <div class="col-lg-12">
                                     <div class="features-content d-flex flex-column mt-3">
                                         @foreach ($crcls as $crclr)
                                             <div class="mb-4">
                                                 <i class="bi bi-eye-fill"
                                                     style="font-size:18px;color:rgb(60, 93, 240)"></i>
                                                 <a href="#" class="h6" data-bs-toggle="modal"
                                                     data-bs-target="#pdfModal"
                                                     data-pdf="{{ asset('storage/' . $crclr->path) }}"
                                                     data-title="{{ $crclr->title }}">
                                                     {{-- <i class="fas fa-solid fa-paperclip me-1"></i> --}}
                                                     {{ $crclr->title }}
                                                 </a>
                                                 <small class="text-body d-block">
                                                     <i class="fas fa-calendar-alt me-1"></i>
                                                     {{ \Carbon\Carbon::parse($crclr->date)->format('M d Y') }}
                                                 </small>
                                             </div>
                                         @endforeach
                                         <div class="mt-2 d-flex justify-content-center">
                                             <div class="col-4">
                                                 <a href="{{ route('home.order-circular', 'cr') }}"
                                                     class="btn btn-outline-primary w-100 py-3 mb-4 rounded-pill text-dark
                                            hover-bg-primary text-hover-white border-primary">View
                                                     All >></a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div id="tab-4" class="tab-pane fade show p-0">
                             <div class="row g-4">
                                 <div class="col-lg-12">
                                     <div class="features-content d-flex flex-column mt-3">
                                         @foreach ($newsupdates as $news)
                                             <div class="mb-4">
                                                 <i class="bi bi-eye-fill"
                                                     style="font-size:18px;color:rgb(60, 93, 240)"></i>
                                                 <a href="{{ asset('storage/' . $news->path) }}" class="h6"
                                                     data-bs-toggle="modal" data-bs-target="#pdfModal"
                                                     data-pdf="{{ asset('storage/' . $news->path) }}"
                                                     data-title="{{ $news->title }}">
                                                     {{-- <i class="fas fa-comment-dots me-1"></i> --}}
                                                     {{ $news->title }}
                                                 </a>
                                                 <small class="text-body d-block">
                                                     <i class="fas fa-calendar-alt me-1"></i>
                                                     {{ \Carbon\Carbon::parse($news->date)->format('M d Y') }}</small>
                                             </div>
                                         @endforeach
                                         <div class="mt-2 d-flex justify-content-center">
                                             <div class="col-4">
                                                 <a href="{{ route('updatesmore') }}"
                                                     class="btn btn-outline-primary w-100 py-3 mb-4 rounded-pill text-dark
                                            hover-bg-primary text-hover-white border-primary">View
                                                     All >></a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 {{-- <div class="col-lg-5 col-xl-5">
                     <div class="row g-4">
                         <div class="col-12">
                             <div class="p-3 rounded border h-100" style="min-height: 600px;">
                                 <div id="calendar" class="h-100"></div>
                                 <h4 class="my-4 mt-5">Periodicals</h4>
                                <div class="row g-4">
                                    <div class="col-12">
                                        <div class="row g-2">
                                            @foreach ($periodicals as $periodical)
                                                <div class="col-12">
                                                    <a href="{{ asset('storage/' . $periodical->path) }}"
                                                        target="_blank"
                                                        class="link-hover btn btn-light w-100 rounded text-uppercase text-dark py-3">
                                                        {{ $periodical->periodicalMaster->name ?? 'N/A' }}
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                             </div>
                         </div>
                     </div>
                 </div> --}}
             </div>
         </div>
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
                 <iframe id="pdfViewer" src="" width="100%" height="700px"
                     style="border: none;"></iframe>
             </div>
         </div>
     </div>
 </div>

 {{-- Hero Section End --}}
 <script>
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
