@extends('layouts.app')

@section('content')
<style>
     body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #1a1a1a;
            overflow-y: auto;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        .data-table {
            margin: 20px auto;
            width: 100%;
            max-width: 400px;
            border-collapse: collapse;
            word-wrap: break-word;
        }

        .data-table td {
            padding: 10px;
            text-align: left;
        }

        .data-table td:first-child {
            font-weight: bold;
            width: 40%;
        }

        .btn {
            padding: 8px 15px;
            font-size: 14px;
        }

        .card {
            margin: 20px auto;
            padding: 20px;
            max-width: 100%;
            overflow-x: auto;
        }
        @media (max-width: 768px) {
            .card-header h4 {
                font-size: 18px;
            }
        }

        @media (max-width: 480px) {
            .card-header h4 {
                font-size: 16px;
            }

            .btn {
                font-size: 12px;
            }
        }

</style>
<body>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-light border-light-shadow" style="background: linear-gradient(135deg, #2d2d2d, #1a1a1a)">
                <div class="card-header bg-secondary text-center text-light d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #2d2d2d, #1a1a1a)">
                    <h4>Konfirmasi Pemesanan!</h4> 
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <button class="btn btn-danger btn-sm" style="margin-left: 100px;"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </button> 
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                
                    <h5 class="text-warning" style="font-weight: bold; text-align: center;">Data yang Telah Dimasukkan</h5>
                    <table class="data-table">
                        <tr>
                            <td><strong>Nama:</strong></td>
                            <td>{{ session('confirmData')['name'] ?? 'No data' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong></td>
                            <td>{{ session('confirmData')['email'] ?? 'No data' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Ruangan:</strong></td>
                            <td>{{ session('confirmData')['ruang'] ?? 'No data' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Kegiatan:</strong></td>
                            <td>{{ session('confirmData')['kegiatan'] ?? 'No data' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Jam Mulai:</strong></td>
                            <td>{{ session('confirmData')['jam_mulai'] ?? 'No data' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Jam Selesai:</strong></td>
                            <td>{{ session('confirmData')['jam_selesai'] ?? 'No data' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal:</strong></td>
                            <td>{{ session('confirmData')['tanggal'] ?? 'No data' }}</td>
                        </tr>
                    </table>
                    
                    <p style="font-weight: bold; text-align: center;"><strong>Apa anda yakin mengirim formulir ini ?</strong></p>

                    <form action="{{ route('booking.confirmBooking') }}" method="POST">
                        @csrf
                        <input type="hidden" name="nama" value="{{ session('confirmData')['name'] ?? 'No data' }}">
                        <input type="hidden" name="email" value="{{ session('confirmData')['email'] ?? 'No data' }}">
                        <input type="hidden" name="ruang" value="{{ session('confirmData')['ruang'] ?? 'No data' }}">
                        <input type="hidden" name="kegiatan" value="{{ session('confirmData')['kegiatan'] ?? 'No data' }}">
                        <input type="hidden" name="jam_mulai" value="{{ session('confirmData')['jam_mulai'] ?? 'No data' }}">
                        <input type="hidden" name="jam_selesai" value="{{ session('confirmData')['jam_selesai'] ?? 'No data' }}">
                        <input type="hidden" name="tanggal" value="{{ session('confirmData')['tanggal'] ?? 'No data' }}">
                        <input type="hidden" name="booking_details" value="{{ json_encode(session('booking_details')) }}">

                        
                        <div class="text-center">
                            <button type="button" class="btn btn-danger mx-2" onclick="window.location.href='{{ route('home') }}'">Kembali</button>
                            <button type="submit" class="btn btn-success mx-2"onclick="alertSuccess(event)">Submit</button>     
                        </div>
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        const nameInput = document.getElementById('nama');
        const nameAlert = document.getElementById('name-alert');

        nameInput.addEventListener('input', function() {
            const nameValue = nameInput.value;
            const regex = /^[a-zA-Z\s]+$/;
            if (!regex.test(nameValue) || nameValue.length < 3) {
                nameAlert.textContent = 'Nama harus berupa huruf dan minimal 3 karakter';
                nameAlert.classList.add('error');
            } else {
                nameAlert.textContent = '';
                nameAlert.classList.remove('error');
            }
        });
    });

    function alertSuccess(event) {
        event.preventDefault();
        Swal.fire({
            title: "Berhasil!",
            text: "Permintaan anda sudah terkirim!. Silahkan menunggu email konfirmasi.",
            icon: "success",
            timer: 5000,
        });    
    }
</script>
@endsection