@extends('layouts.admin_app')

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

                    <label for="filter-dropdown-priority">Priority:</label>
                    <select id="filter-dropdown-priority">
                        <option value="">All</option>
                        <option value="0">Very Low</option>
                        <option value="1">Low</option>
                        <option value="2">Medium</option>
                        <option value="3">High</option>
                        <option value="4">Very High</option>
                        
                    </select>

                    <label for="filter-dropdown-handler">Handler:</label>
                    <select id="filter-dropdown-handler">
                        <option value="">All</option>
                        
                    </select>
                    
                    <table class="table table-bordered" id="DataTable">
                        <thead>
                            <tr>
                                <th>Ticket No.</th>
                                <!-- <th>Customer ID</th> -->
                                <th>Name</th>
                                <th>Department</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <!-- <th>Description</th> -->
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
                <form method="POST" action="" name="updateForm" id="updateForm" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" id="id" >
                        <input type="hidden" name="dataimage" id="dataimage" >

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
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" name="status" id="status">
                                    <option value="Open">Open</option>
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

                        <div class="row mb-3 modal-lg">
                            <label for="remarks" class="col-md-4 col-form-label text-md-end">{{ __('Note/Remarks') }}</label>

                            <div class="col-md-6 .input-lg">
                                <textarea name="remarks" id="remarks" cols="50" rows="5"></textarea>
                                @error('name')
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
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Transfer Modal -->

<div class="modal" id="noteModal" tabindex="-1" role="dialog">
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
                <form method="POST" action="" name="remarksForm" id="remarksForm" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" id="idnote" >

                        <div class="row mb-3">
                            <label for="handler" class="col-md-4 col-form-label text-md-end">{{ __('Handler') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" name="handler" id="handler1">
                                    <option value="None">None</option>

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
                <button type="submit" id="btn-save1" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Resolved Modal -->

<div class="modal" id="solutionModal" tabindex="-1" role="dialog">
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
                <form method="POST" action="" name="solutionForm" id="solutionForm" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" id="idsolution" >

                        <div class="row mb-3 modal-lg">
                            <label for="solution" class="col-md-4 col-form-label text-md-end">{{ __('Solution') }}</label>

                            <div class="col-md-6 .input-lg">
                                <textarea name="solution" id="solution" cols="50" rows="5"></textarea>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="btn-save2" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('bottom-js')
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

  var notificationsWrapper   = $('.dropdown-notifications');
    var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('i[data-count]');
    var notificationsCount     = parseInt(notificationsCountElem.data('count'));
    var notifications          = notificationsWrapper.find('div.dropdown-menu');

Pusher.logToConsole = true;

var pusher = new Pusher('d2bb2b51e17bf488dfb1', {
  cluster: 'ap1'
});
var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(message) {
        var existingNotifications = notifications.html();
        var newNotificationHtml = `
        <li class="dropdown-item">`+message+`</>
        `;
        notifications.html(newNotificationHtml + existingNotifications);

        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);
        notificationsWrapper.show();
        
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
                columnDefs: [{ width: '12%', targets: 8 },
                            {width: '10%',targets: 4},
                            {width: '5%',targets: 0},
                            {width: '15%',targets: 1},
                            {width: '5%',targets: 6}],
                ajax: '{!! url('/datatables') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    // { data: 'customer_id', name: 'Customer_id' },
                    {data: 'name', name: 'name'},
                    {data: 'department', name: 'department'},
                    { data: 'email', name: 'email' },
                    { data: 'subject', name: 'subject' },
                    // { data: 'description', name: 'description' },
                    { data: 'status', name: 'status' },
                    { data: 'prio', name: 'prio'},
                    { data: 'handler', name: 'handler'},
                    {data: 'action', name: 'action', orderable: false}
                    // Add other columns here
                ],
            });
        });

    function transferFunc(id){
        $.ajax({
        type:"POST",
        url: "{{ url('/edit') }}",
        data: { id: id },
        dataType: 'json',
        success: function(res){
            $('#NoteModal').html("Edit Employee");
            $('#noteModal').modal('show');
            $('#idnote').val(res.id); 
            $('#handler1').val(res.handler);
            console.log(res);
        }
    });
}

function markFunc(id){
        $.ajax({
        type:"POST",
        url: "{{ url('/edit') }}",
        data: { id: id },
        dataType: 'json',
        success: function(res){
            $('#NoteModal').html("Edit Employee");
            $('#solutionModal').modal('show');
            $('#idsolution').val(res.id); 
            $('#solution').val(res.solution);
            console.log(res);
        }
    });
}

function acceptFunc(id){
        $.ajax({
        type:"POST",
        url: "{{ url('/accepttix') }}",
        data: { id: id },
        dataType: 'json',
        success: function(res){
            if (res.status == 200){
                    Swal.fire({
                        title: "Ticket Accepted",
                        icon: "success"
                    });
                }
            $('#DataTable').DataTable().ajax.reload();
            console.log(res);
        }
    });
}

function printFunc(id){
        $.ajax({
        type:"POST",
        url: "{{ url('/printtix') }}",
        data: { id: id },
        // dataType: 'json',
        xhrFields: {
            responseType: 'blob' // Set the response type to blob
        },
        success: function(response) {
            // Create a Blob from the response
            var blob = new Blob([response], { type: 'application/pdf' });

            // Create a URL for the Blob
            var url = window.URL.createObjectURL(blob);

            // Create a link element to trigger the download
            var a = document.createElement('a');
            a.href = url;
            a.download = 'ticket.pdf'; // Set the filename
            a.style.display = 'none';

            // Append the link to the document body and trigger the download
            document.body.appendChild(a);
            a.click();

            // Clean up
            window.URL.revokeObjectURL(url);
            $(a).remove();
        },  
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            // Handle any errors
        }
    });
}

$('#solutionForm').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{url( '/statuschange' )}}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (res) =>{
                if (res.status == 200){
                    Swal.fire({
                        title: "Ticket Successfully Edited",
                        icon: "success"
                    });
                }
                $("#noteModal").modal('hide');
                $("#btn-save2").html('Submit');
                $("#btn-save2"). attr("disabled", false);
                $('#DataTable').DataTable().ajax.reload();
                console.log(res);
            },

        });
    });

$('#remarksForm').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{url( '/updatenote' )}}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (res) =>{
                if (res.status == 200){
                    Swal.fire({
                        title: "Ticket Successfully Edited",
                        icon: "success"
                    });
                }
                $("#noteModal").modal('hide');
                $("#btn-save1").html('Submit');
                $("#btn-save1"). attr("disabled", false);
                $('#DataTable').DataTable().ajax.reload();
                console.log(res);
            },

        });
    });

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
            success: (res) =>{
                if (res.status == 200){
                    Swal.fire({
                        title: "Ticket Successfully Edited",
                        icon: "success"
                    });
                }
                $("#editModal").modal('hide');
                $("#btn-save").html('Submit');
                $("#btn-save"). attr("disabled", false);
                $('#DataTable').DataTable().ajax.reload();
                console.log(res);
            },

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
            $('#status').val(res.status);
            $('#remarks').val(res.remarks);
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
    // Fetch department choices from the server
    $.ajax({
        url: '{{url ('/fetchAdmin')}}',
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            // Update dropdown with fetched data
            var departmentDropdown = $('#filter-dropdown-handler');
            var departmentDropdown2 = $('#handler1');
            $.each(data, function(index, handlers) {
                departmentDropdown.append('<option value="' + handlers.name + '">' + handlers.name + '</option>');
                departmentDropdown2.append('<option value="' + handlers.name + '">' + handlers.name + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching departments:', error);
        }
    });
});

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
$(document).ready(function() {
    // Apply the filter when the dropdown value changes
    $('#filter-dropdown-handler').on('change', function() {
        var selectedValue = $(this).val();
        $('#DataTable').DataTable().column(7).search(selectedValue).draw();
        
    });
});
</script>
@endsection


