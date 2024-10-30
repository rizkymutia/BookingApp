@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                
                    <h2>Data yang Telah Dimasukkan</h2>
                    <p><strong>Nama:</strong> {{ session('confirmData')['name'] ?? 'No data' }}</p>
                    <p><strong>Nomor:</strong> {{ session('confirmData')['nomor'] ?? 'No data' }}</p>
                    <p><strong>Ruangan:</strong> {{ session('confirmData')['ruang'] ?? 'No data' }}</p>
                    <p><strong>Jam Mulai:</strong> {{ session('confirmData')['jam_mulai'] ?? 'No data' }}</p>
                    <p><strong>Jam Selesai:</strong> {{ session('confirmData')['jam_selesai'] ?? 'No data' }}</p>
                    <p><strong>Tanggal:</strong> {{ session('confirmData')['tanggal'] ?? 'No data' }}</p>
                    <p><strong>Apa anda yakin mengirim formulir ini ?</strong></p>
                
                    <!-- Formulir HTML -->
                    <form action="{{ route('booking.confirmBooking') }}" method="POST">
                        @csrf
                        <input type="hidden" name="nama" value="{{ session('confirmData')['name'] ?? 'No data' }}">
                        <input type="hidden" name="nomor" value="{{ session('confirmData')['nomor'] ?? 'No data' }}">
                        <input type="hidden" name="ruang" value="{{ session('confirmData')['ruang'] ?? 'No data' }}">
                        <input type="hidden" name="jam_mulai" value="{{ session('confirmData')['jam_mulai'] ?? 'No data' }}">
                        <input type="hidden" name="jam_selesai" value="{{ session('confirmData')['jam_selesai'] ?? 'No data' }}">
                        <input type="hidden" name="tanggal" value="{{ session('confirmData')['tanggal'] ?? 'No data' }}">
                        <input type="hidden" name="booking_details" value="{{ json_encode(session('booking_details')) }}">


                        <button type="submit" onclick="alertSuccess(event)">Submit</button>
                        <button type="button" onclick="window.location.href='{{ route('home') }}'">Kembali</button>

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
            text: "Berhasil mengisi data! Email akan segera dikirimkan!",
            icon: "success",
            timer: 5000,
        }).then(() => {
            fetch("{{ route('booking.confirmBooking') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    booking_details: {
                        name: "{{ session('confirmData')['name'] ?? 'No data' }}",
                        nomor: "{{ session('confirmData')['nomor'] ?? 'No data' }}",
                        ruang: "{{ session('confirmData')['ruang'] ?? 'No data' }}",
                        jam_mulai: "{{ session('confirmData')['jam_mulai'] ?? 'No data' }}",
                        jam_selesai: "{{ session('confirmData')['jam_selesai'] ?? 'No data' }}",
                        tanggal: "{{ session('confirmData')['tanggal'] ?? 'No data' }}"
                    }
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log("Email konfirmasi terkirim");
                }else {
                    console.error(data.error);
                    alert('Gagal mengirim email konfirmasi')
                }
            })
            // After the alert is closed, submit the form
            .catch(error => console.error('Error:', error));
        });
    }
</script>
@endsection