@extends('layouts.default')

@section('content')
    <!-- Single Product Start -->
    <div class="container-fluid populer-news py-5">
        <div class="container py-5">
            <h1>New Order/Circular Upload Request</h1>
            </br>
            @if($save_request)
                <div class="alert alert-success alert-dismissible fade show">
                    <strong>Success!</strong> Your request has been saved successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <div class="container py-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('home.store-upload-request') }}" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                @csrf
                                <div class="mb-3 col-6">
                                    {{-- <label for="type" class="form-label">Select Type</label> --}}
                                    <select class="form-select" id="type_fe" name="type" required
                                    onchange="toggleGoType()"
                                    >
                                        <option value="">Select Order Type</option>
                                        <option value="G">Govt Order</option>
                                        <option value="O">Office Order</option>
                                        <option value="C">Circular</option>
                                    </select>
                                    @error('type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-6" id="goType_fe"
                                style="display: none"
                                >
                                    {{-- <label for="go_type" class="form-label">Select GO Type</label> --}}
                                    <select class="form-select" id="go_type_fe" name="go_type" required
                                        {{-- onchange="toggleServiceorMember()" --}}
                                        >
                                        <option value="">Select GO Type</option>
                                        <option value="M">സർക്കാർ ഉത്തരവുകൾ കയ്യെഴുത്തു (Govt.Order Manuscript)</option>
                                        <option value="R">സർക്കാർ ഉത്തരവുകൾ സാധാ (Govt.Order Routine)</option>
                                        <option value="P">സർക്കാർ ഉത്തരവുകൾ അച്ചടി (Govt. Order Print) </option>
                                    </select>
                                    @error('go_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6" id="service_member_fe"
                                {{-- style="display: none" --}}
                                >
                                    {{-- <label for="service_member" class="form-label">Select Service / Member Related</label> --}}
                                    <select class="form-select" id="serviceMember_fe" name="serviceMember" required
                                        {{-- onchange="toggleServiceMember()" --}}
                                        >
                                        <option value="">Select Service/Member Related</option>
                                        <option value="Service">Service Related</option>
                                        <option value="Member">Member Related</option>
                                    </select>
                                    @error('service_member')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-6" id="service_fe"
                                {{-- style="display: none" --}}
                                >
                                    {{-- <label for="service" class="form-label">Select Category</label> --}}
                                    <select class="form-select" id="category_fe" name="category" required>
                                        <option value="">Select Category</option>
                                        <option value="TP">Transfer & Posting</option>
                                        <option value="CR">Claim / Reimbursements</option>
                                        <option value="AR">Accounts Related</option>
                                        <option value="PA">PA Posting</option>
                                        <option value="G">General</option>
                                    </select>
                                    @error('service')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    {{-- <label for="no" class="form-label">Number</label> --}}
                                    <input type="text" class="form-control" id="no_fe" name="no" placeholder="Enter Order/Circular Number"
                                        required>
                                    @error('no')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-6">
                                    {{-- <label for="date" class="form-label">Date</label> --}}
                                    <input type="date" class="form-control" id="date_fe" name="date"
                                        placeholder="Enter Date" required>
                                    @error('date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                {{-- <label for="title" class="form-label">EnTitle</label> --}}
                                <input type="text" class="form-control" id="title_fe" name="title" placeholder="Enter Title"
                                    required>
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{-- <label for="keywords" class="form-label">Keyword</label> --}}
                                <input type="text" class="form-control" id="keywords_fe" name="keywords"
                                    placeholder="Enter Keywords">
                                @error('keywords')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->
@endsection

<script>
    function toggleGoType() {
        var type = document.getElementById('type_fe').value;
        if (type == 'G') {
            document.getElementById('goType_fe').style.display = 'block';
            document.getElementById('go_type_fe').setAttribute('required', 'required');
        } else {
            document.getElementById('goType_fe').style.display = 'none';
            document.getElementById('go_type_fe').removeAttribute('required');
            document.getElementById('go_type_fe').value = '';
        }
    }
</script>