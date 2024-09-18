<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>
<body>
    <h1>Edit</h1>

<form action="{{ route('admin.update', $user->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <label for="name">Nama : </label>
    <input type="text" id="name" name="name" value="{{ old('name') ?? $user->name }}" required>
    <div>
        <label for="ruang">Ruangan : </label>
        <select name="ruang" id="ruang" required>
            <option value="ruang1" {{ old('ruang') ?? $user->userData->ruang ?? '' }} >Ruang 1</option>
            <option value="ruang2" {{ old('ruang') ?? $user->userData->ruang ?? '' }} >Ruang 2</option>
            <option value="ruang3" {{ old('ruang') ?? $user->userData->ruang ?? '' }}>Ruang 3</option>
        </select>
    </div>
    <div>
        <label for="jam_mulai">Jam Mulai : </label>
        <input type="time" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') ?? $user->userData->jam_mulai ?? '' }}" required>
        <label for="jam_selesai">Jam Selesai : </label>
        <input type="time" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') ?? $user->userData->jam_selesai ?? '' }}" required>
    </div>

    <div>
        <label for="tanggal">Tanggal : </label>
        <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') ?? $user->userData->tanggal ?? '' }}" required>
    </div>

    <button type="submit">Update</button>
</form>
    
</body>
</html>
