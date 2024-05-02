@extends('layouts.admin_app')

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
                <div class="card-header">
                    <ul class="nav nav-tabs" id="chartTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="line-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">New Tickets Everyday</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="bar-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Ticket Statuses</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                <!-- <canvas id="survey_chart1" width="200" height="200"></canvas> -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <canvas id="line-chart" width="200" height="50"></canvas>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <canvas id="bar-chart" width="200" height="50"></canvas>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<br>
<!-- <div class="container">
    <div class="row justify-content-center">
        TODO: BAR CHART
        <div class="col-md-9">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                <canvas id="bar-chart" width="200" height="58"></canvas>
                </div>
            </div>
        </div>
        TODO: DONUT CHART
        <div class="col-md-3">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                <canvas id="donut-chart" width="200" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="container">
    <div class="row justify-content-center">
        <!-- TODO: DONUT CHART -->
        <!-- <div class="col-md-3">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                <canvas id="donut-chart" width="200" height="200"></canvas>
                </div>
            </div>
        </div> -->
        <!-- TODO: SURVEY CHART -->
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="survey1-tab" data-bs-toggle="tab" data-bs-target="#surveychart1" type="button" role="tab" aria-controls="home" aria-selected="true">Question 1</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#surveychart2" type="button" role="tab" aria-controls="profile" aria-selected="false">Question 2</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#surveychart3" type="button" role="tab" aria-controls="contact" aria-selected="false">Question 3</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="survey1-tab" data-bs-toggle="tab" data-bs-target="#surveychart4" type="button" role="tab" aria-controls="home" aria-selected="true">Question 4</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#surveychart5" type="button" role="tab" aria-controls="profile" aria-selected="false">Question 5</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#surveychart6" type="button" role="tab" aria-controls="contact" aria-selected="false">Question 6</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="survey1-tab" data-bs-toggle="tab" data-bs-target="#surveychart7" type="button" role="tab" aria-controls="home" aria-selected="true">Question 7</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#surveychart8" type="button" role="tab" aria-controls="profile" aria-selected="false">Question 8</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#surveychart9" type="button" role="tab" aria-controls="profile" aria-selected="false">Question 9</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#surveychart8" type="button" role="tab" aria-controls="profile" aria-selected="false">Question 10</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                <!-- <canvas id="donut-chart" width="200" height="200"></canvas> -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="surveychart1" role="tabpanel" aria-labelledby="home-tab">
                            <canvas id="survey-chart1" width="200" height="58"></canvas>
                        </div>
                        <div class="tab-pane fade" id="surveychart2" role="tabpanel" aria-labelledby="profile-tab">
                            <canvas id="survey-chart2" width="200" height="58"></canvas>
                        </div>
                        <div class="tab-pane fade" id="surveychart3" role="tabpanel" aria-labelledby="profile-tab">
                            <canvas id="survey-chart3" width="200" height="58"></canvas>
                        </div>
                        <div class="tab-pane fade" id="surveychart4" role="tabpanel" aria-labelledby="profile-tab">
                            <canvas id="survey-chart4" width="200" height="58"></canvas>
                        </div>
                        <div class="tab-pane fade" id="surveychart5" role="tabpanel" aria-labelledby="profile-tab">
                            <canvas id="survey-chart5" width="200" height="58"></canvas>
                        </div>
                        <div class="tab-pane fade" id="surveychart6" role="tabpanel" aria-labelledby="profile-tab">
                            <canvas id="survey-chart6" width="200" height="58"></canvas>
                        </div>
                        <div class="tab-pane fade" id="surveychart7" role="tabpanel" aria-labelledby="profile-tab">
                            <canvas id="survey-chart7" width="200" height="58"></canvas>
                        </div>
                        <div class="tab-pane fade" id="surveychart9" role="tabpanel" aria-labelledby="profile-tab">
                            <!-- <canvas id="survey-chart8" width="200" height="58"></canvas> -->
                            <table id='suggestionTable'>
                                <!-- <thead>
                                    <th>Name</th>
                                    <th>Suggestions</th>
                                    <th>Date</th>
                                </thead> -->
                                <tbody>
                                    @foreach ($q9 as $suggestions)
                                    <tr>
                                        <td>{{$suggestions->name}}</td>
                                        <td>{{$suggestions->q9}}</td>
                                        <td>{{$suggestions->created_at}}</td>                                  
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="surveychart8" role="tabpanel" aria-labelledby="profile-tab">
                            <!-- <canvas id="survey-chart8" width="200" height="58"></canvas> -->
                            <table>
                                <thead>
                                    <th>Name</th>
                                    <th>Suggestions</th>
                                    <th>Date</th>
                                </thead>
                                <tbody>
                                    @foreach ($q9 as $suggestions)
                                    <tr>
                                        <td>{{$suggestions->name}}</td>
                                        <td>{{$suggestions->q0}}</td>
                                        <td>{{$suggestions->created_at}}</td>                                  
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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

        $(document).ready(function() {
            $.ajax({
                url: '{{ url('/survey1') }}',
                method: 'GET',
                success: function(data) {
                    var ctx = document.getElementById('survey-chart1').getContext('2d');
                    var myPieChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: '1. How satisfied are you with your experience using our ticketing system?',
                                data: data.values,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(153, 102, 255)',
                                    // 'rgb(255, 159, 64)'
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
                url: '{{ url('/survey2') }}',
                method: 'GET',
                success: function(data) {
                    var ctx = document.getElementById('survey-chart2').getContext('2d');
                    var myPieChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: '2. How easy was it to submit a ticket?',
                                data: data.values,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(153, 102, 255)',
                                    // 'rgb(255, 159, 64)'
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
                url: '{{ url('/survey3') }}',
                method: 'GET',
                success: function(data) {
                    var ctx = document.getElementById('survey-chart3').getContext('2d');
                    var myPieChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: '3. How satisfied are you with the response time to your ticket?',
                                data: data.values,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(153, 102, 255)',
                                    // 'rgb(255, 159, 64)'
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
                url: '{{ url('/survey4') }}',
                method: 'GET',
                success: function(data) {
                    var ctx = document.getElementById('survey-chart4').getContext('2d');
                    var myPieChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: '4. How clear was the communication regarding the progress of your ticket?',
                                data: data.values,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(153, 102, 255)',
                                    // 'rgb(255, 159, 64)'
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
                url: '{{ url('/survey5') }}',
                method: 'GET',
                success: function(data) {
                    var ctx = document.getElementById('survey-chart5').getContext('2d');
                    var myPieChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: '5. How helpful were the support staff in resolving your issue?',
                                data: data.values,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(153, 102, 255)',
                                    // 'rgb(255, 159, 64)'
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
                url: '{{ url('/survey6') }}',
                method: 'GET',
                success: function(data) {
                    var ctx = document.getElementById('survey-chart6').getContext('2d');
                    var myPieChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: '6. Were your issues resolved to your satisfaction?',
                                data: data.values,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(153, 102, 255)',
                                    // 'rgb(255, 159, 64)'
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
                url: '{{ url('/survey7') }}',
                method: 'GET',
                success: function(data) {
                    var ctx = document.getElementById('survey-chart7').getContext('2d');
                    var myPieChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: '7. Did you experience any technical issues or system errors while using the ticketing system?',
                                data: data.values,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(153, 102, 255)',
                                    // 'rgb(255, 159, 64)'
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
                url: '{{ url('/survey8') }}',
                method: 'GET',
                success: function(data) {
                    var ctx = document.getElementById('survey-chart8').getContext('2d');
                    var myPieChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: '8. How likely are you to recommend our ticketing system to others?',
                                data: data.values,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(153, 102, 255)',
                                    // 'rgb(255, 159, 64)'
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

        $(document).ready(function(){
    $('#suggestionTable').DataTable({
        "searching": false,
        "lengthChange": false,
        "paging": false,
        "info": false,
        "ordering": false,
        "scrollY": "300px", // Adjust the height as needed
        "columnDefs": [
            { "width": "50%", "targets": 0 }, 
            { "width": "30%", "targets": 1 }, 
            { "width": "50%", "targets": 2 }
            // Add more columns and widths as needed
        ]
    });
});
</script>
@endsection