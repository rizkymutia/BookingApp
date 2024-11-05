<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit') }}</div>

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

                        <div class="form-group row">
                            <label for="name">Nama : </label>
                            <div class="col-md-6">
                                <input type="text" id="name" name="name" value="{{ old('name') ?? $userData->name }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email">Email : </label>
                            <div class="col-md-6">
                                <input type="email" id="email" name="email" value="{{ old('email') ?? $userData->email }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ruang">Ruangan : </label>
                            <div class="col-md-6">
                                <select name="ruang" id="ruang" required>
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
                        </div>
                        <div class="form-group row">
                            <label for="kegiatan">Kegiatan : </label>
                            <div class="col-md-6">
                                <input type="text" id="kegiatan" name="kegiatan" value="{{ old('kegiatan') ?? $userData->kegiatan ?? '' }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jam_mulai">Jam Mulai : </label>
                            <div class="col-md-6">
                                <input type="time" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') ?? $userData->jam_mulai ?? '' }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jam_selesai">Jam Selesai : </label>
                            <div class="col-md-6">
                                <input type="time" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') ?? $userData->jam_selesai ?? '' }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tanggal">Tanggal : </label>
                            <div class="col-md-6">
                                <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') ?? $userData->tanggal ?? '' }}" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
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
