@extends('layouts.app')

@section('content')
<style>
      body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #1a1a1a;
            overflow-y: auto;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        .card {
            margin: 20px auto;
            padding: 20px;
            max-width: 800px;
            overflow-x: auto;
        }

        .form-control {
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .card-header h4 {
                font-size: 18px;
            }

            .form-group {
                width: 100%;
            }

            .d-flex {
                flex-direction: column;
                gap: 10px;
            }

            .btn {
                font-size: 14px;
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
<div class="container">
    <div class="row w-100">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="card bg-dark text-white border-secondary">
                <div class="card-header text-center border-secondary" style="background: linear-gradient(135deg, #2d2d2d, #1a1a1a);">
                    <h4>Form Pemesanan Ruangan</h4>
                </div>

                <div class="card-body" style="background: linear-gradient(135deg, #2d2d2d, #1a1a1a);">
                    <form method="POST" action="{{ route('confirm') }}" class="row g-3">
                        @csrf
                        <div class = "col-md-6">
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" id="nama" name="name" class="form-control bg-dark text-white border-secondary" required placeholder="Masukkan Nama Lengkap">
                                <p id="name-alert" class = "alert-message"></p>
                            </div>
                        
                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="email" id="email" name="email" class="form-control bg-dark text-white border-secondary"required placeholder="Masukkan Email">
                            </div>
                        
                            <div class="form-group mb-3">
                                <label for="ruang">Ruangan : </label>
                                <select name="ruang" id="ruang" class="form-control bg-dark text-white border-secondary" required>
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
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kegiatan">{{ __('Kegiatan') }}</label>
                                <input type="text" id="kegiatan" name="kegiatan" class="form-control bg-dark text-white border-secondary" required placeholder="Masukkan Kegiatan">
                            </div>
                            
                            <div class="form-group d-flex gap-2 flex-wrap">
                                <div class="w-50">
                                    <label for="jam" class="form-label-sm d-block">Jam Mulai : </label>
                                    <input type="time" id="jam_mulai" name="jam_mulai" class="form-control bg-dark text-white border-secondary" required>
                                </div>
                                <div class="w-50">
                                    <label for="jam" class="form-label-sm d-block">Jam Selesai : </label>
                                    <input type="time" id="jam_selesai" name="jam_selesai" class="form-control bg-dark text-white border-secondary"required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal : </label>
                                <input type="date" id="tanggal" name="tanggal" class="form-control bg-dark text-white border-secondary"  min="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                            
                        <div class="col-12 text-centerd-flex justify-content-center">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection