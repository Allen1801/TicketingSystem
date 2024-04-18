@extends('layouts.app')

@section('content')
<button class="btn float-start" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button">
    <i class="bi bi-arrow-right-square-fill fs-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvas"></i>
</button>
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-2">
            <div class="card">
                <div class="card-header">{{__('Total Tickets')}}</div>
                <div class="card-body text-center">
                    <a href="javascript:void(0)" class="btn btn-primary">{{ $total }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">{{__('New Tickets')}}</div>
                <div class="card-body text-center">
                    <a href="javascript:void(0)" class="btn btn-primary">{{ $new }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">{{__('Unresolved')}}</div>
                <div class="card-body text-center">
                    <a href="javascript:void(0)" class="btn btn-primary">{{ $inprogress }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">{{__('Resolved')}}</div>
                <div class="card-body text-center">
                    <a href="javascript:void(0)" class="btn btn-primary">{{ $complete }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">{{__('Closed')}}</div>
                <div class="card-body text-center">
                    <a href="javascript:void(0)" class="btn btn-primary">{{ $inactive }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">{{__('Open')}}</div>
                <div class="card-body text-center">
                    <a href="javascript:void(0)" class="btn btn-primary">{{ $open }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row justify-content-center">
        <!-- TODO: PIE CHART -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                <canvas id="pie-chart" width="200" height="200"></canvas>
                </div>
            </div>
        </div>
        <!-- TODO: LINE CHART -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                <canvas id="line-chart" width="200" height="58"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row justify-content-center">
        <!-- TODO: BAR CHART -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                <canvas id="bar-chart" width="200" height="58"></canvas>
                </div>
            </div>
        </div>
        <!-- TODO: DONUT CHART -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                <canvas id="donut-chart" width="200" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>



<script>

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

    TODO://CHARTS
        $(document).ready(function() {
            $.ajax({
                url: '{{ url('/chart') }}',
                method: 'GET',
                success: function(data) {
                    var ctx = document.getElementById('pie-chart').getContext('2d');
                    var myPieChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                data: data.values,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(153, 102, 255)',
                                    'rgb(255, 159, 64)'
                                ],
                                hoverOffset: 4
                            }]
                        },
                        options: {
                            // Additional options for the pie chart
                        }
                    });
                }
            });
        });

        $(document).ready(function() {
            $.ajax({
                url: '{{ url('/line') }}',
                method: 'GET',
                success: function(data) {
                    var ctx = document.getElementById('line-chart').getContext('2d');
                    var myPieChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'New Tickets Everyday',
                                data: data.values,
                                backgroundColor: [
                                    //'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                    //'rgb(255, 205, 86)',
                                    //'rgb(75, 192, 192)',
                                    //'rgb(153, 102, 255)',
                                    //'rgb(255, 159, 64)'
                                ],
                                hoverOffset: 4
                            }]
                        },
                        options: {
                            // Additional options for the pie chart
                        }
                    });
                }
            });
        });

        $(document).ready(function() {
            $.ajax({
                url: '{{ url('/bar') }}',
                method: 'GET',
                success: function(data) {
                    var ctx = document.getElementById('bar-chart').getContext('2d');
                    var myPieChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Ticket Statuses',
                                data: data.values,
                                backgroundColor: [
                                    'rgb(54, 162, 235)',
                                    'rgb(75, 192, 192)',
                                    'rgb(255, 205, 86)',
                                    // 'rgb(153, 102, 255)',
                                    'rgb(255, 159, 64)',
                                    'rgb(255, 99, 132)',
                                    
                                ],
                                hoverOffset: 4
                            }]
                        },
                        options: {
                            // Additional options for the pie chart
                        }
                    });
                }
            });
        });

        $(document).ready(function() {
            $.ajax({
                url: '{{ url('/donut') }}',
                method: 'GET',
                success: function(data) {
                    var ctx = document.getElementById('donut-chart').getContext('2d');
                    var myPieChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                data: data.values,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(153, 102, 255)',
                                    'rgb(255, 159, 64)'
                                ],
                                hoverOffset: 4
                            }]
                        },
                        options: {
                            // Additional options for the pie chart
                        }
                    });
                }
            });
        });
</script>
@endsection