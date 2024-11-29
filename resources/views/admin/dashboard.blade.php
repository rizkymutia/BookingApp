<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>

    <style>
        body {
            display: flex;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        th,td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
    </style>
    
</head>

<body>
    <div style="flex-grow: 1; padding: 20px;">
        <nav style="display: flex; align-items: center; justify-content: space-between;">
            <div class="logo">
                <h4>Order Management</h4>
            </div>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <button class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </button>   
        </nav>
        <form action="{{ route('admin.massDelete') }}" method="POST">
            @csrf
            @method('DELETE')

            <table>
                <thead>
                    <tr>
                        <th>Check</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Ruangan</th>
                        <th>Kegiatan</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Ubah Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userData as $data)
                    <tr>
                        <td><input type="checkbox" name="selected_ids[]" value="{{ $data->user_id }}" class="select-item"></td>
                        <td>{{ $data->user_id }}</td>
                        <td> {{ $data->name }}</td>
                        <td>{{ $data->ruang }}</td> 
                        <td>{{ $data->kegiatan }}</td>
                        <td>{{ $data->tanggal }} {{ $data->jam_mulai }} - {{ $data->jam_selesai }}</td>
                        <td>{{ $data->status }}</td>
                        <td>{{ $data->ubah_status }}
                            <div id="status-buttons-{{ $data->user_id }}">
                                <button class="btn btn-success" onclick="alertSuccess(event, '{{ $data->user_id }}')">Diterima</button>

                                <button class="btn btn-danger" onclick="alertRejected(event, '{{ $data->user_id }}')">Ditolak</button>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('admin.edit', $data->user_id) }}" class="btn btn-warning">
                                Edit
                            </a>
                           
                            <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus {{ $data->user_id }}?')">Delete</button>
                        </td>
                    </tr>
                    @endforeach

                
                </tbody>
            </table>
            <input type="checkbox" id="select-all" onclick="toggleSelectAll(this)"> SelectAll</input>

            <button class="btn btn-danger" style="margin-left: 10px;" onclick="return confirmMassDelete()">Delete All</button>
        </form>
    </div>

        
    <script>
        function toggleSelectAll(source) {
            checkboxes = document.querySelectorAll('.select-item');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = source.checked;
            }
        }

        function confirmMassDelete() {
            return confirm('Apakah anda yakin ingin menghapus semuanya?');
        }

        function alertSuccess(event, userId) {
            event.preventDefault();
            Swal.fire({
                title: "Berhasil!",
                text: "Permintaan user telah diterima!",
                icon: "success",
                timer: 5000,
            }).then(() => {
                fetch(`/admin/accept-booking/${userId}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    
                    
                    
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Status berhasil diperbarui menjadi diterima");
                        location.reload();
                    }else { 
                        console.error('Gagal memperbarui status.')
                    }
                })
                // After the alert is closed, submit the form
                .catch(error => console.error('Error:', error));
            });
        }

        function alertRejected(event, userId) {
            event.preventDefault();
            Swal.fire({
                title: "Ditolak!",
                text: "Permintaan user telah ditolak!",
                icon: "rejected",
                timer: 5000,
            }).then(() => {
                fetch(`/admin/reject-booking/${userId}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Status berhasil diperbarui menjadi ditolak.");
                        location.reload();
                    }else {
                        console.error('Gagal memperbarui status.')
                    }
                })
                // After the alert is closed, submit the form
                .catch(error => console.error('Error:', error));
            });
        }
    
    </script>
</body>
</html>
