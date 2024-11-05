<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi Pemesanan Ruangan</title>
</head>
<body>
    <h1>Pemesanan Ruangan Anda Diterima</h1>
    <p>Keterangan : </p>
    <p>Nama: {{ $bookingDetails['name'] }}</p>
    <p>Email: {{ $bookingDetails['email'] }}</p>
    <p>Ruangan: {{ $bookingDetails['ruang'] }}</p>
    <p>Jam Mulai: {{ $bookingDetails['jam_mulai'] }}</p>
    <p>Jam Selesai: {{ $bookingDetails['jam_selesai'] }}</p>
    <p>Tanggal: {{ $bookingDetails['tanggal'] }}</p>
    <p>Terima kasih!</p>
</body>
</html>
