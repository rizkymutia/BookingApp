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
            <th>ID |</th>
            <th>Email |</th>
            <th>Nama |</th>
            <th>Ruangan |</th>
            <th>Tanggal |</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->email }}</td>
        </tr>
        @endforeach

        @foreach($data as $item)
        <tr>
            <td colspan="2"></td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->ruang }}</td>
            <td>{{ $item->tanggal }}</td>
            <td colspan="3"> 
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





