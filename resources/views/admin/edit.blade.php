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
    <label for="ruang">Ruangan : </label>
    <input type="text" id="ruang" name="ruang" value="{{ $user->ruang }}">
    <br>
    <label for="foto">Foto : </label>
    <input type="file" id="foto" name="foto" value="{{ $user->foto }}">
    <br>
    <button type="submit">Update</button>
</form>
    
</body>
</html>
