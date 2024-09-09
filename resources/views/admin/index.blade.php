<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Information</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                <h4>User List</h4>

                <!-- Notifikasi menggunakan flash session data -->
                @if (session('message'))
                    <div>
                        {{ session('message') }}
                    </div>
                @endif

                <div>
                    <a href="{{ route('user.create') }}" class="mb-3 float-end">New
                        User</a>

                    <table class="mt-1 text-center">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Create At</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                          action="{{ route('user.destroy', $user->id) }}" method="POST">
                                        <a href="{{ route('user.edit', $user->id) }}">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">DELETE</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center text-mute" colspan="4">Data user tidak tersedia</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>


   
</body>
    
</html>

