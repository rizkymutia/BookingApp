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
                    <th>Nama</th>
                    <th>Nomor HP</th>
                    <th>Ruangan</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Tanggal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userData as $data)
                <tr>
                    <td><input type="checkbox" name="selected_ids[]" value="{{ $data->user_id }}" class="select-item"></td>
                    <td>{{ $data->user_id }}</td> <!-- Pastikan ini sesuai dengan kolom yang ada di user_data -->
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->nomor }}</td>
                    <td>{{ $data->ruang }}</td> 
                    <td>{{ $data->jam_mulai }}</td>
                    <td>{{ $data->jam_selesai }}</td>
                    <td>{{ $data->tanggal }}</td>
                    <td>
                        <a href="{{ route('admin.edit', $data->user_id) }}">Edit</a>
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
