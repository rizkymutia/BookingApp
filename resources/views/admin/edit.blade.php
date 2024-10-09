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
                            <label for="nomor">Nomor HP : </label>
                            <div class="col-md-6">
                                <input type="text" id="nomor" name="nomor" value="{{ old('nomor') ?? $userData->nomor }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ruang">Ruangan : </label>
                            <div class="col-md-6">
                                <select name="ruang" id="ruang" required>
                                    <option value="ruang1" {{ (old('ruang') ?? $userData->ruang ?? '') === 'ruang1' ? 'selected' : '' }}>Ruang 1</option>
                                    <option value="ruang2" {{ (old('ruang') ?? $userData->ruang ?? '') === 'ruang2' ? 'selected' : '' }}>Ruang 2</option>
                                    <option value="ruang3" {{ (old('ruang') ?? $userData->ruang ?? '') === 'ruang3' ? 'selected' : '' }}>Ruang 3</option>
                                </select>
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
