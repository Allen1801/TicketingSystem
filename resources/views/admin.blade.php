@extends('layouts.app')

@section('content')
<button class="btn float-start" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button">
    <i class="bi bi-arrow-right-square-fill fs-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvas"></i>
</button>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-header">{{__('This is the Admin Dashboard')}}</div>
                <div class="card-body">
                    <label for="filter-dropdown">Status:</label>
                    <select id="filter-dropdown">
                        <option value="">All</option>
                        <option value="New">New</option>
                        <option value="Open">Open</option>
                        <option value="Resolved">Resolved</option>
                        <option value="Unresolved">Unresolved</option>
                        <option value="Closed">Closed</option>
                        
                    </select>

                    <label for="filter-dropdowN-priority">Priority:</label>
                    <select id="filter-dropdown-priority">
                        <option value="">All</option>
                        <option value="0">Very Low</option>
                        <option value="1">Low</option>
                        <option value="2">Medium</option>
                        <option value="3">High</option>
                        <option value="4">Very High</option>
                        
                    </select>
                    
                    <table class="table table-bordered" id="DataTable">
                        <thead>
                            <tr>
                                <th>Ticket No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Priority Level</th>
                                <th>Handler</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->

<div class="modal" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your form for editing data goes here -->
                <form method="POST" action="javascript:void(0)" name="updateForm" id="updateForm" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" id="id" >
                        <input type="hidden" name="dataimage" id="dataimage" >

                        <div class="row mb-3 modal-lg">
                            <label for="subject" class="col-md-4 col-form-label text-md-end">{{ __('Subject') }}</label>

                            <div class="col-md-6 .input-lg">
                                <input id="subject" type="text" class="form-control  @error('name') is-invalid @enderror" name="subject" disabled  required autocomplete="subject" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  disabled required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="description" id="description" rows="3" disabled></textarea>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Upload Image') }}</label>

                            <div class="col-md-6">
                                <div class="image" id="image">

                                </div>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="prio" class="col-md-4 col-form-label text-md-end">{{ __('Priority') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" name="prio" id="prio">
                                    <option value="0">Very Low</option>
                                    <option value="1">Low</option>
                                    <option value="2">Medium</option>
                                    <option value="3">High</option>
                                    <option value="4">Very High</option>
                                </select>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="handler" class="col-md-4 col-form-label text-md-end">{{ __('Handler') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" name="handler" id="handler">
                                    <option value="Admin 1">Admin 1</option>
                                    <option value="Admin 2">Admin 2</option>
                                    <option value="Admin 3">Admin 3</option>
                                    <option value="None">None</option>
                                </select>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" name="status" id="status">
                                    <option value="Open">Open</option>
                                    <option value="Resolved">Resolved</option>
                                    <option value="Unresolved">Unresolved</option>
                                    <option value="Closed">Closed</option>
                                </select>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="btn-save"class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

TODO://NOTIFICATION
  $(document).ready(function () {
    toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "toastClass": "toast-info",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "500",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
  });

Pusher.logToConsole = true;

var pusher = new Pusher('d2bb2b51e17bf488dfb1', {
  cluster: 'ap1'
});
var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(message) {
        // alert(JSON.stringify(data));
        toastr.info(JSON.stringify(message));
        // notify()success(JSON.stringify(data));
    });
    
$(document).ready( function () {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

            $('#DataTable').DataTable({
                processing: true,
                serverSide: true,
                //select: true,
                "order": [[0, 'desc']],
                columnDefs: [{ width: '11%', targets: 8 },
                            {width: '15%',targets: 1}],
                ajax: '{!! url('/datatables') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    {data: 'user_name', name: 'user_name'},
                    { data: 'email', name: 'email' },
                    { data: 'subject', name: 'subject' },
                    { data: 'description', name: 'description' },
                    { data: 'status', name: 'status' },
                    { data: 'prio', name: 'prio'},
                    { data: 'handler', name: 'handler'},
                    {data: 'action', name: 'action', orderable: false}
                    // Add other columns here
                ],
            });
        });


    function add(){
        $('#editModal').modal('show');
    }

    $('#updateForm').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{url( '/update' )}}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) =>{
                $("#editModal").modal('hide');
                $("#btn-save").html('Submit');
                $("#btn-save"). attr("disabled", false);
                $('#DataTable').DataTable().ajax.reload();
                console.log(data);
            },
            error: function(data){
                console.log(data);
            }

        });
    });

    function editFunc(id){
     //$('#editModal').modal('show');
    $.ajax({
        type:"POST",
        url: "{{ url('/edit') }}",
        data: { id: id },
        dataType: 'json',
        success: function(res){
            $('#EditModal').html("Edit Employee");
            $('#editModal').modal('show');
            $('#subject').val(res.subject);
            $('#email').val(res.email);           
            $('#description').val(res.description);
            $('#image').html(`<img src="{{asset('storage/uploads/')}}/${res.image}" class="img-fluid img-thumbnail" >`)
            $('#prio').val(res.prio); 
            $('#handler').val(res.handler);
            // $('#status').val(res.status);
            $('#id').val(res.id);
            $('#dataimage').val(res.image)
            console.log(res);
        }
    });
}

function delFunc(id){

    $.ajax({
        type: "POST",
        url: "{{ url('/delete') }}",
        data: {id:id},
        dataType: 'json',
        success: function(response){
            $('#DataTable').DataTable().ajax.reload();
        },
    });
}

$(document).ready(function() {
    // Apply the filter when the dropdown value changes
    $('#filter-dropdown').on('change', function() {
        var selectedValue = $(this).val();
        $('#DataTable').DataTable().column(5).search(selectedValue).draw();
        
    });
});
$(document).ready(function() {
    // Apply the filter when the dropdown value changes
    $('#filter-dropdown-priority').on('change', function() {
        var selectedValue = $(this).val();
        $('#DataTable').DataTable().column(6).search(selectedValue).draw();
        
    });
});
</script>
@endsection


