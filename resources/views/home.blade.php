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
                    <form method="POST" action="{{ route('confirm') }}">
                        @csrf
                        <div class = "row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class = "col-md-6">
                                <input type="text" id="nama" name="name" required placeholder="Masukkan Nama Lengkap">
                                <p id="name-alert" class = "alert-message"></p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input type="email" id="email" name="email" required placeholder="Masukkan Email">
                            </div>
                        </div>
                        <div>
                            <label for="ruang">Ruangan : </label>
                            <select name="ruang" id="ruang" required>
                                <option value="Aula Lantai III :R.Ki Hajar Dewantara" >Aula Lantai III :R.Ki Hajar Dewantara</option>
                                <option value="R.Rapat Kecil Lantai III :R.P.Diponegoro" >R.Rapat Kecil Lantai III :R.P.Diponegoro</option>
                                <option value="R.Rapat 1 Lantai II :R.Pangsar Sudirman">R.Rapat 1 Lantai II :R.Pangsar Sudirman</option>
                                <option value="R.Dr.Sutomo :R.Rapat II Lantai II">R.Dr.Sutomo :R.Rapat II Lantai II</option>
                                <option value="R.Dr.Wahidin Sudiro Husodo :R.Rapat Hall">R.Dr.Wahidin Sudiro Husodo :R.Rapat Hall</option>
                                <option value="R.Rapat R.A Kartini :R.Rapat Lantai I">R.Rapat R.A Kartini :R.Rapat Lantai I</option>
                                <option value="R.H.Cokroaminoto :Ex SKB Utara">R.H.Cokroaminoto :Ex SKB Utara</option>
                                <option value="R.H.Agus Salim :Aula Ex SKB">R.H.Agus Salim :Aula Ex SKB</option>
                                <option value="R.Sekretariat Dewan Pendidikan :Ex SKB Utara">R.Sekretariat Dewan Pendidikan :Ex SKB Utara</option>
                                <option value="R.Rapat Sultan Agung :R.Rapat Lantai III Kecil">R.Rapat Sultan Agung :R.Rapat Lantai III Kecil</option>
                            </select>
                        </div>
                        <div class="row mb-3">
                            <label for="kegiatan" class="col-md-4 col-form-label text-md-end">{{ __('Kegiatan') }}</label>
                            <div class="col-md-6">
                                <input type="text" id="kegiatan" name="kegiatan" required placeholder="Masukkan Kegiatan">
                            </div>
                        </div>
                        <div>
                            <label for="jam">Jam Mulai : </label>
                            <input type="time" id="jam_mulai" name="jam_mulai" required>
                            <label for="jam">Jam Selesai : </label>
                            <input type="time" id="jam_selesai" name="jam_selesai" required>
                        </div>
                        <div>
                            <label for="tanggal">Tanggal : </label>
                            <input type="date" id="tanggal" name="tanggal"  min="{{ date('Y-m-d') }}" required>
                        </div>
                        <button type="submit">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection