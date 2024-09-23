<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>
<style>
    /* Styling umum untuk body */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f3f4f7;
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Container utama */
.container {
    max-width: 400px;
    padding: 30px;
    background-color: #fff;
    box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

/* Card styling */
.card {
    border: none;
    border-radius: 10px;
    background-color: #fff;
}

.card-header {
    font-size: 1.8rem;
    font-weight: 600;
    text-align: center;
    color: #fff;
    background-color: #007bff;
    padding: 15px 0;
    border-radius: 10px 10px 0 0;
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
}

.card-body {
    padding: 20px;
}

/* Gaya form */
.form-group {
    margin-bottom: 15px;
    justify-content: space-between;
}

label {
    font-weight: 500;
    font-size: 1rem;
    margin-bottom: 5px;
    display: block;
    color: #333;
    margin: 0 auto;
    flex: 1;
}

input[type="text"], select, input[type="time"], input[type="date"] {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    color: #333;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: all 0.3s ease;
    margin-top: 5px;
    flex: 2;

}

/* Efek saat form fokus */
input:focus, select:focus, input[type="time"]:focus, input[type="date"]:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
}

/* Tombol submit */
button[type="submit"] {
    background-color: #007bff;
    color: white;
    padding: 12px 20px;
    font-size: 1rem;
    border: none;
    border-radius: 8px;
    width: 100%;
    cursor: pointer;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    display: block;
}

button[type="submit"]:hover {
    background-color: #0056b3;
    box-shadow: 0 8px 16px rgba(0, 123, 255, 0.3);
}

/* Styling untuk row dan kolom */
.row {
    display: flex;
    flex-direction: column;
}

.col-md-6 {
    display: flex;
    flex-direction: column;
    width: 100%;
}

/* Tampilan responsif */
@media (min-width: 768px) {
    .row {
        flex-direction: row;
    }
    
    .col-md-6 {
        width: 50%;
    }
}

/* Border dan hover untuk select */
select {
    cursor: pointer;
    background-color: #f9f9f9;
}

/* Tambahan animasi pada hover */
input[type="text"], select, input[type="time"], input[type="date"] {
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

input:hover, select:hover, input[type="time"]:hover, input[type="date"]:hover {
    border-color: #007bff;
}


</style>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit') }}</div>

                <div class="card-body">
                    <form action="{{ route('admin.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="name">Nama : </label>
                            <div class="col-md-6">
                                <input type="text" id="name" name="name" value="{{ old('name') ?? $user->name }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ruang">Ruangan : </label>
                            <div class="col-md-6">
                                <select name="ruang" id="ruang" required>
                                    <option value="ruang1" {{ old('ruang') ?? $user->userData->ruang ?? '' }} >Ruang 1</option>
                                    <option value="ruang2" {{ old('ruang') ?? $user->userData->ruang ?? '' }} >Ruang 2</option>
                                    <option value="ruang3" {{ old('ruang') ?? $user->userData->ruang ?? '' }}>Ruang 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jam_mulai">Jam Mulai : </label>
                            <div class="col-md-6">
                                <input type="time" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') ?? $user->userData->jam_mulai ?? '' }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jam_selesai">Jam Selesai : </label>
                            <div class="col-md-6">
                                <input type="time" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') ?? $user->userData->jam_selesai ?? '' }}" required>
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="tanggal">Tanggal : </label>
                            <div class="col-md-6">
                                <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') ?? $user->userData->tanggal ?? '' }}" required>
                            </div>
                        </div>
                    
                        <div class="form-group row mb-0" style="display: flex; justify-content: center;">
                                <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
    
    
</div>

    
</body>
</html>
