<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <script>
        // Function to select/deselect all checkboxes
        function toggleSelectAll(source) {
            checkboxes = document.querySelectorAll('.select-item');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = source.checked;
            }
        }
    </script>
</head>

<body>
    <nav>
        <div class="logo">
            <h4>Admin Dashboard</h4>
        </div>

        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        </div>
    </nav>


    <!-- Form untuk penghapusan massal -->
    <form action="{{ route('admin.massDelete') }}" method="POST">
        @csrf
        @method('DELETE')

        <table>
            <thead>
                <tr>
                    <th>Select All  <input type="checkbox" onclick="toggleSelectAll(this)"></th>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Ruangan</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Tanggal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td><input type="checkbox" name="selected_ids[]" value="{{ $user->id }}" class="select-item"></td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->userData ? $user->userData->ruang : 'No Data' }}</td> 
                    <td>{{ $user->userData ? $user->userData->jam_mulai : 'No Data' }}</td>
                    <td>{{ $user->userData ? $user->userData->jam_selesai : 'No Data' }}</td>
                    <td>{{ $user->userData ? $user->userData->tanggal : 'No Data' }}</td>
                    <td>
                        <a href="{{ route('admin.edit', $user->id) }}">Edit</a>
                    </td>
                </tr>
                @endforeach

               
            </tbody>
        </table>

        <!-- Tombol untuk hapus semua data yang dipilih -->
        <button type="submit">Delete</button>
    </form>
    
</body>
</html>
