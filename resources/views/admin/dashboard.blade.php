<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>
<body>
    <h1>Admin Dashboard</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Ruangan</th>
            <th>Foto</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->ruang }}</td>
            <td>{{ $user->foto }}</td>
            <td>
                <a href="{{ route('admin.edit', $user->id) }}">Edit</a>
                <form action="{{ route('admin.delete', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
    
</body>
</html>





