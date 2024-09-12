@extends('layouts.app')

@section('content')
</head>
<body>
    <h1>Booking Confirmation</h1>
    <p>Dear {{ $data['name'] }},</p>
    <p>Your booking for {{ $data['ruang'] }} on {{ $data['tanggal'] }} has been successfully received.</p>
    <p>Thank you for your booking!</p>
</body>

@endsection
