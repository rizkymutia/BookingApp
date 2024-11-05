<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Mohon Maaf Pemesanan Ruangan Anda Ditolak.</h1>
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