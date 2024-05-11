<!DOCTYPE html>
<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Ticket</title>
    <style>

    .signature-line {
            border-top: 1px solid #000;
            margin-top: 20px;
            padding-top: 10px;
            display: flex; /* Use flexbox */
            justify-content: flex-end; /* Align content to the end (right) */
            align-items: center; /* Center items vertically */
        }

        .signature-name {
            margin-left: 10px; /* Add some space between the line and the name */
        }


    </style>
</head>
<body>

    <!-- <img src="{{ public_path('storage/images/pasig_logo.png') }}" alt="Header Image" style="width: 100%;">
    <hr>
    <br> -->
    <h4 class="text-left m-0">Ticket Request No. {{ $id }}</h4>
    <p class="text-left m-0">Name: <span class="name">{{ $name }}</span></p>
    <p class="text-left m-0">Department: {{ $department }}</p>
    <p class="text-left m-0">Email: {{ $email }}</p>
    <br>
    <p class="text-left">Subject: {{ $subject }}</p>
    <p class="text-left m-0">Description:</p>
    <p class="text-justify">{{ $description }}</p>
    <br>
        <div class="col">
            <p class="text-right">______________________</p>
            <p class="text-right signature-name"> {{ $name }} </p>
        </div>
    
    
    <!-- Add more content as needed -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</body>
</html>