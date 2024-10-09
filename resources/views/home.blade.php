@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div>
                    <h1>User Dashboard</h1>
                    <form method="POST" action="{{ route('dashboard') }}">
                        @csrf
                        <div class = "row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class = "col-md-6">
                                <input type="text" id="nama" name="name" required>
                                <p id="name-alert" class = "alert-message"></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nomor" class="col-md-4 col-form-label text-md-end">{{ __('Nomor HP') }}</label>
                            <div class="col-md-6">
                                <input type="text" id="nomor" name="nomor" required>
                            </div>
                        </div>
                        <div>
                            <label for="ruang">Ruangan : </label>
                            <select name="ruang" id="ruang" required>
                                <option value="ruang1" >Ruang 1</option>
                                <option value="ruang2" >Ruang 2</option>
                                <option value="ruang3">Ruang 3</option>
                            </select>
                        </div>
                        <div>
                            <label for="jam">Jam Mulai : </label>
                            <input type="time" id="jam_mulai" name="jam_mulai" required>
                            <label for="jam">Jam Selesai : </label>
                            <input type="time" id="jam_selesai" name="jam_selesai" required>
                        </div>
                        <div>
                            <label for="tanggal">Tanggal : </label>
                            <input type="date" id="tanggal" name="tanggal" required>
                        </div>
                        <button type="submit" onclick="alertSuccess(event)">Submit</button>
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
            text: "Berhasil mengisi data!",
            icon: "success",
            timer: 5000,
        }).then(() => {
            // After the alert is closed, submit the form
            event.target.closest('form').submit();
        });
    }
</script>
@endsection