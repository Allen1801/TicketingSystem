@extends('layouts.admin_app')

@section('content')
<button class="btn float-start" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button">
    <i class="bi bi-arrow-right-square-fill fs-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvas"></i>
</button>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{__('Department')}}</div>
                <div class="card-body">
                    <a href="javascript:void(0)" class="btn btn-primary" onclick="add()">Add Department</a>

                    <p></p>

                    <table class="table table-bordered" id="UserTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Department</th>
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

<div class="modal" id="addModal" tabindex="-1" role="dialog">
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
                <form method="POST" action="javascript:void(0)" name="addForm" id="addForm" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" id="id">

                        <div class="row mb-3 modal-lg">
                            <label for="department" class="col-md-4 col-form-label text-md-end">{{ __('Department Name') }}</label>

                            <div class="col-md-6 .input-lg">
                                <input id="department" type="text" class="form-control  @error('name') is-invalid @enderror" name="department" required autocomplete="name" autofocus>

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

                        <input type="hidden" name="editid" id="editid">

                        <div class="row mb-3 modal-lg">
                            <label for="department" class="col-md-4 col-form-label text-md-end">{{ __('Department Name') }}</label>

                            <div class="col-md-6 .input-lg">
                                <input id="editdepartment" type="text" class="form-control  @error('name') is-invalid @enderror" name="editdepartment" required autocomplete="name" autofocus>

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
                <button type="submit" id="editbtn-save"class="btn btn-primary">Save changes</button>
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

            $('#UserTable').DataTable({
                processing: true,
                serverSide: true,
                //select: true,
                columnDefs: [{ width: '80%', targets: 1 }],
                ajax: '{!! url('/department') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'department', name: 'department' },
                    {data: 'action', name: 'action', orderable: false}
                    // Add other columns here
                ],
            });
        });

        function add(){
        $('#addModal').modal('show');
    }

    $('#addForm').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{url( '/insertDept' )}}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(res){
                if (res.status == 200){
                    Swal.fire({
                        title: "Department Added Successfully",
                        icon: "success"
                    });
                }
                //$("#editModal").reset();
                $("#editModal").modal('hide');
                $("#btn-save").html('Submit');
                $("#btn-save"). attr("disabled", false);
                $('#UserTable').DataTable().ajax.reload();
                console.log(res.status);
            }
        });
    });

    $('#updateForm').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{url( '/updateDept' )}}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(res){
                if (res.status == 201){
                    Swal.fire({
                        title: "Department Updated Successfully",
                        icon: "success"
                    });
                }
                //$("#editModal").reset();
                $("#editModal").modal('hide');
                $("#btn-save").html('Submit');
                $("#btn-save"). attr("disabled", false);
                $('#UserTable').DataTable().ajax.reload();
                console.log(res.status);
            }
        });
    });

    function editFunc(id){
     //$('#editModal').modal('show');
    $.ajax({
        type:"POST",
        url: "{{ url('/editDept') }}",
        data: { id: id },
        dataType: 'json',
        success: function(res){
            $('#EditModal').html("Edit Employee");
            $('#editModal').modal('show');
            $('#editid').val(res.id);
            $('#editdepartment').val(res.department);
            console.log(res);
        }
    });
}

    function delFunc(id){

$.ajax({
    type: "POST",
    url: "{{ url('/Deptremove') }}",
    data: {id:id},
    dataType: 'json',
    success: function(res){
        if (res.status == 201){
                    Swal.fire({
                        title: "Department Removed Successfully",
                        icon: "success"
                    });
                }
        $('#UserTable').DataTable().ajax.reload();
    },
});
}
</script>

@endsection