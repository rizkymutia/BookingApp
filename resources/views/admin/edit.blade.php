<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Edit</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center font-weight-bold">
                    {{ __('Edit Data') }}
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.update', $userData->user_id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Nama : </label>
                                <input type="text" class="form-control"id="name" name="name" value="{{ old('name') ?? $userData->name }}" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="ruang">Ruangan : </label>
                                <select class="form-control"name="ruang" id="ruang" required>
                                    <option value="Aula Lantai III :R.Ki Hajar Dewantara" {{ (old('ruang') ?? $userData->ruang ?? '') === 'Aula Lantai III :R.Ki Hajar Dewantara' ? 'selected' : '' }}>Aula Lantai III :R.Ki Hajar Dewantara</option>
                                    <option value="R.Rapat Kecil Lantai III :R.P.Diponegoro" {{ (old('ruang') ?? $userData->ruang ?? '') === 'R.Ruant Kecil Lantai III :R.P.Diponegoro' ? 'selected' : '' }}>R.Ruant Kecil Lantai III :R.P.Diponegoro</option>
                                    <option value="R.Rapat 1 Lantai II :R.Pangsar Sudirman" {{ (old('ruang') ?? $userData->ruang ?? '') === 'R.Rapat 1 Lantai II :R.Pangsar Sudirman' ? 'selected' : '' }}>R.Rapat 1 Lantai II :R.Pangsar Sudirman</option>
                                    <option value="R.Dr.Sutomo :R.Rapat II Lantai II" {{ (old('ruang') ?? $userData->ruang ?? '') === 'R.Dr.Sutomo :R.Rapat II Lantai II' ? 'selected' : '' }}>R.Dr.Sutomo :R.Rapat II Lantai II</option>
                                    <option value="Dr.Wahidin Sudiro Husodo :R.Rapat Hall" {{ (old('ruang') ?? $userData->ruang ?? '') === 'Dr.Wahidin Sudiro Husodo :R.Rapat Hall' ? 'selected' : '' }}>Dr.Wahidin Sudiro Husodo :R.Rapat Hall</option>
                                    <option value="R.Rapat R.A Kartini :R.Rapat Lantai I" {{ (old('ruang') ?? $userData->ruang ?? '') === 'R.Rapat R.A Kartini :R.Rapat Lantai I' ? 'selected' : '' }}>R.Rapat R.A Kartini :R.Rapat Lantai I</option>
                                    <option value="R.H.Cokroaminoto :Ex SKB Utara" {{ (old('ruang') ?? $userData->ruang ?? '') === 'R.H.Cokroaminoto :Ex SKB Utara' ? 'selected' : '' }}>R.H.Cokroaminoto :Ex SKB Utara</option>
                                    <option value="R.H.Agus Salim :Aula Ex SKB" {{ (old('ruang') ?? $userData->ruang ?? '') === 'R.H.Agus Salim :Aula Ex SKB' ? 'selected' : '' }}>R.H.Agus Salim :Aula Ex SKB</option>
                                    <option value="R.Sekretariat Dewan Pendidikan :Ex SKB Utara" {{ (old('ruang') ?? $userData->ruang ?? '') === 'R.Sekretariat Dewan Pendidikan :Ex SKB Utara' ? 'selected' : '' }}>R.Sekretariat Dewan Pendidikan :Ex SKB Utara</option>
                                    <option value="R.Rapat Sultan Agung: R.Rapat Lantai III Kecil" {{ (old('ruang') ?? $userData->ruang ?? '') === 'R.Rapat Sultan Agung :R.Rapat Lantai III Kecil' ? 'selected' : '' }}>R.Rapat Sultan Agung :R.Rapat Lantai III Kecil</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="kegiatan">Kegiatan : </label>
                                <input type="text" class="form-control" id="kegiatan" name="kegiatan" value="{{ old('kegiatan') ?? $userData->kegiatan ?? '' }}" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="tanggal">Tanggal : </label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') ?? $userData->tanggal ?? '' }}" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="jam_mulai">Jam Mulai : </label>
                                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') ?? $userData->jam_mulai ?? '' }}" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="jam_selesai">Jam Selesai : </label>
                                <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') ?? $userData->jam_selesai ?? '' }}" required>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" onclick="alertSuccess(event)" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div> 
            </div> 
        </div> 
    </div> 
</div> 

<script>
    function alertSuccess(event) {
        event.preventDefault(); // Prevent form submission
        
        Swal.fire({
            title: "Berhasil!",
            text: "Data telah diperbarui!",
            icon: "success",
            timer: 2000,
            showConfirmButton: false
        }).then(() => {
            // After the alert is closed, submit the form
            event.target.closest('form').submit();
        });
    }
  
    
</script>
</body>
</html>
