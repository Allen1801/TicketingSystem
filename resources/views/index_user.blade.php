@extends('layouts.app')

@section('content')
<button class="btn float-start" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button">
    <i class="bi bi-arrow-right-square-fill fs-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvas2"></i>
</button>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{__('Notification')}}</div>
                <div class="card-body ">
                    @forelse($notifications as $notification)
                        <div class="alert alert-success" role="alert">
                            [{{ $notification->created_at }}] User {{ $notification->data['id'] }}  {{ $notification->data['message'] }}
                            <a href="{{url('/markasread')}}" class="float-right mark-as-read" data-id="{{ $notification->id }}">Mark as read</a>
                        </div>
                        @if($loop->last)
                            <a href="{{url('/markasread')}}" id="mark-all">Mark all as read</a>
                        @endif
                        @empty
                            There are no new notifications
                    @endforelse   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection