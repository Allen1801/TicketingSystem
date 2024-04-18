@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Welcome ') }} {{ Auth::user()->name }}</div>
                <div class="card-body">
                <a href="javascript:void(0)" class="btn btn-primary" onclick="add()">Request Ticket</a>
                <p></p>
                <table class="table table-bordered" id="DataTable">
                    <thead>
                        <tr>
                            <th>Ticket No.</th>
                            <th>Customer No.</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Description</th>
                            <!-- <th>Image</th> -->
                            <th>Status</th>
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

                        <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}">

                        <div class="row mb-3 modal-lg">
                            <label for="subject" class="col-md-4 col-form-label text-md-end">{{ __('Subject') }}</label>

                            <div class="col-md-6 .input-lg">
                                <input id="subject" type="text" class="form-control  @error('name') is-invalid @enderror" name="subject" value="{{ old('subject') }}" required autocomplete="subject" autofocus>

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <textarea class="form-control" name="description" id="description" rows="3"></textarea>

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
                                <input type="file" id="image" name="image">

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
            </div>
        </div>
    </div>
</div>
<script>

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
                columnDefs: [{ width: '17%', targets: 6 }],
                ajax: '{!! url('/datacustom') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'customer_id', name: 'customer_id' },
                    { data: 'email', name: 'email' },
                    { data: 'subject', name: 'subject' },
                    { data: 'description', name: 'description' },
                    //{ data: 'image', name: 'image' },
                    { data: 'status', name: 'status' },
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
            url: "{{url( '/store' )}}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(res){
                if (res.status == 200){
                    Swal.fire({
                        title: "Ticket Sent Successfully",
                        text: "Your Ticket Will be Processed Soon",
                        icon: "success"
                    });
                }
                // $("#editModal").reset();
                $("#editModal").modal('hide');
                $("#btn-save").html('Submit');
                $("#btn-save"). attr("disabled", false);
                $('#DataTable').DataTable().ajax.reload();
                console.log(res.status);
            }
        });
    });
</script>
@endsection