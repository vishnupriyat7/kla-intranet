<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container py-12">
        <div class="card">
            <div class="card-header p-3">

                <h2 class="fw-bold">Add New Order / Circular</h2>
            </div>
            <div class="card-body">

                <form action="{{ route('orders-circular.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="type" class="form-label">Select Type</label>
                        <select class="form-select" id="type" name="type" required onchange="toggleGoType()">
                            <option value="">Select Type</option>
                            <option value="G">Govt Order</option>
                            <option value="O">Office Order</option>
                            <option value="C">Circular</option>
                        </select>
                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- I want to display select GO Type only if Type is Govt Order --}}
                    <div class="mb-3" id="goType" style="display: none">
                        <label for="go_type" class="form-label">Select GO Type</label>
                        <select class="form-select" id="go_type" name="go_type" required
                            onchange="toggleServiceorMember()">
                            <option value="">Select GO Type</option>
                            <option value="M">സർക്കാർ ഉത്തരവുകൾ കയ്യെഴുത്തു (Govt.Order Manuscript)</option>
                            <option value="R">സർക്കാർ ഉത്തരവുകൾ സാധാ (Govt.Order Routine)</option>
                            <option value="P">സർക്കാർ ഉത്തരവുകൾ അച്ചടി (Govt. Order Print) </option>

                        </select>
                        @error('go_type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- I want to display select MS Type only if GO Type is Govt Order Manuscript --}}
                    <div class="mb-3" id="service_member" style="display: none">
                        <label for="service_member" class="form-label">Select Service / Member Related</label>
                        <select class="form-select" id="serviceMember" name="serviceMember" required
                            onchange="toggleServiceMember()">
                            <option value="">Select Service / Member Related</option>
                            <option value="Service">Service Related</option>
                            <option value="Member">Members Related</option>
                            <option value="Accounts">Accounts Related</option>
                        </select>
                        @error('service_member')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- I want to display select Service only if Service / Member Related is Service Related --}}
                    <div class="mb-3" id="service" style="display: none">
                        <label for="service" class="form-label">Select Service</label>
                        <select class="form-select" id="servc" name="servc" required>
                            <option value="">Select Service Related</option>
                            <option value="TP">Transfer & Posting</option>
                            <option value="CRS">Claim / Reimbursements</option>
                            <option value="G">General</option>
                        </select>
                        @error('service')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- I want to display select Member only if Service / Member Related is Members Related --}}
                    <div class="mb-3" id="member" style="display: none">
                        <label for="member" class="form-label">Select Member</label>
                        <select class="form-select" id="memb" name="memb" required>
                            <option value="">Select Member Related</option>
                            <option value="CRM">Claim / Reimbursements</option>
                            <option value="PA">PA Postings</option>

                        </select>
                        @error('member')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- I want to display office order types --}}
                    {{-- <div class="mb-3" id="offcOrder" style="display: none">
                        <label for="offc_order" class="form-label">Select Office Order Type</label>
                        <select class="form-select" id="offc_order" name="offc_order" required>
                            <option value="">Select Office Order Type</option>
                            <option value="SR">Service Related</option>
                            <option value="AR">Accounts Related</option>
                            <option value="O">Other</option>

                        </select>
                        @error('offc_order')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="mb-3">
                        <label for="no" class="form-label">Number</label>
                        <input type="text" class="form-control" id="no" name="no" placeholder="Enter No"
                            required>
                        @error('no')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date"
                            placeholder="Enter Date" required>
                        @error('date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Enter Title" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="keywords" class="form-label">Keyword</label>
                        <input type="text" class="form-control" id="keywords" name="keywords"
                            placeholder="Enter Keyword" required>
                        @error('keywords')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="path" class="form-label">Choose File</label>
                        <input type="file" class="form-control" id="path" name="path" required>
                        @error('path')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{ route('orders-circular.index') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
<script>
    function toggleGoType() {
        var type = document.getElementById('type').value;
        if (type == 'G') {
            document.getElementById('goType').style.display = 'block';
            document.getElementById('go_type').setAttribute('required', 'required');
        } else {
            document.getElementById('goType').style.display = 'none';
            document.getElementById('go_type').removeAttribute('required');
        }
    }

    function toggleGoType() {
        var type = document.getElementById('type').value;
        if (type == 'G') {
            document.getElementById('goType').style.display = 'block';
            document.getElementById('go_type').setAttribute('required', 'required');
        } else if (type == 'O') {
            document.getElementById('offcOrder').style.display = 'block';
            document.getElementById('offc_order').setAttribute('required', 'required');
        } else {
            document.getElementById('goType').style.display = 'none';
            document.getElementById('go_type').removeAttribute('required');
            document.getElementById('offcOrder').style.display = 'none';
            document.getElementById('offc_order').removeAttribute('required');
        }

    }

    // function toggleServiceorMember() {
    //     var go_type = document.getElementById('go_type').value;
    //     if (go_type == 'M') {
    //         document.getElementById('service_member').style.display = 'block';
    //         document.getElementById('service_member').setAttribute('required', 'required');
    //     } else {
    //         document.getElementById('service_member').style.display = 'none';
    //         document.getElementById('service_member').removeAttribute('required');
    //     }
    // }

    // function toggleServiceMember() {
    //     var serviceMember = document.getElementById('serviceMember').value;

    //     if (serviceMember === 'Service') {
    //         document.getElementById('service').style.display = 'block';
    //         document.getElementById('servc').setAttribute('required', 'required');
    //         document.getElementById('member').style.display = 'none';
    //         document.getElementById('memb').removeAttribute('required');
    //     } else if (serviceMember === 'Member') {
    //         document.getElementById('member').style.display = 'block';
    //         document.getElementById('memb').setAttribute('required', 'required');
    //         document.getElementById('service').style.display = 'none';
    //         document.getElementById('servc').removeAttribute('required');
    //     } else {
    //         document.getElementById('service').style.display = 'none';
    //         document.getElementById('servc').removeAttribute('required');
    //         document.getElementById('member').style.display = 'none';
    //         document.getElementById('memb').removeAttribute('required');
    //     }
    // }
</script>
