<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
                    <th>Status</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Ruangan</th>
                    <th>Kegiatan</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Tanggal</th>
                    <th>Ubah Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userData as $data)
                <tr>
                    <td><input type="checkbox" name="selected_ids[]" value="{{ $data->user_id }}" class="select-item"></td>
                    <td id="status-{{ $data->user_id }}">{{ $data->status }}</td>
                    <td>{{ $data->user_id }}</td> <!-- Pastikan ini sesuai dengan kolom yang ada di user_data -->
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->ruang }}</td> 
                    <td>{{ $data->kegiatan }}</td>
                    <td>{{ $data->jam_mulai }}</td>
                    <td>{{ $data->jam_selesai }}</td>
                    <td>{{ $data->tanggal }}</td>
                    <td>{{ $data->ubah_status }}
                        
                        <div id="status-buttons-{{ $data->user_id }}">
                            <button type="button" onclick="alertSuccess(event, '{{ $data->user_id }}')">Diterima</button>

                            <button type="button" onclick="alertRejected(event, '{{ $data->user_id }}')">Ditolak</button>
                        </div>
                    <td>
                        <a href="{{ route('admin.edit', $data->user_id) }}">Edit</a>
                    </td>
                </tr>
                @endforeach

               
            </tbody>
        </table>

        <!-- Tombol untuk hapus semua data yang dipilih -->
        <button type="submit" onclick="return confirmMassDelete()">Delete</button>
    </form>
    
</body>
<script>
    function confirmMassDelete() {
        return confirm('Apakah anda yakin ingin menghapus semuanya?');
    }

    function alertSuccess(event) {
        event.preventDefault();
        Swal.fire({
            title: "Berhasil!",
            text: "Permintaan user telah diterima!",
            icon: "success",
            timer: 5000,
        }).then(() => {
            fetch("{{ route('booking.confirmBooking') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    booking_details: {
                        name: "{{ session('confirmData')['name'] ?? 'No data' }}",
                        nomor: "{{ session('confirmData')['email'] ?? 'No data' }}",
                        ruang: "{{ session('confirmData')['ruang'] ?? 'No data' }}",
                        jam_mulai: "{{ session('confirmData')['jam_mulai'] ?? 'No data' }}",
                        jam_selesai: "{{ session('confirmData')['jam_selesai'] ?? 'No data' }}",
                        tanggal: "{{ session('confirmData')['tanggal'] ?? 'No data' }}"
                    }
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log("Email konfirmasi terkirim");
                }else {
                    console.error(data.error);
                    alert('Gagal mengirim email konfirmasi')
                }
            })
            // After the alert is closed, submit the form
            .catch(error => console.error('Error:', error));
        });
    }

    function alertRejected(event) {
        event.preventDefault();
        Swal.fire({
            title: "Ditolak!",
            text: "Permintaan user telah ditolak!",
            icon: "rejected",
            timer: 5000,
        }).then(() => {
            fetch("{{ route('booking.cancelBooking') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    booking_details: {
                        name: "{{ session('confirmData')['name'] ?? 'No data' }}",
                        nomor: "{{ session('confirmData')['email'] ?? 'No data' }}",
                        ruang: "{{ session('confirmData')['ruang'] ?? 'No data' }}",
                        jam_mulai: "{{ session('confirmData')['jam_mulai'] ?? 'No data' }}",
                        jam_selesai: "{{ session('confirmData')['jam_selesai'] ?? 'No data' }}",
                        tanggal: "{{ session('confirmData')['tanggal'] ?? 'No data' }}"
                    }
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log("Email konfirmasi terkirim");
                }else {
                    console.error(data.error);
                    alert('Gagal mengirim email konfirmasi')
                }
            })
            // After the alert is closed, submit the form
            .catch(error => console.error('Error:', error));
        });
    }
    
</script>
</html>
