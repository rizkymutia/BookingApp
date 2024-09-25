@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Result</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h2>Data yang Telah Dimasukkan</h2>
                    <p><strong>Nama:</strong> {{ session('name') }}</p>
                    <p><strong>Ruangan:</strong> {{ session('ruang') }}</p>
                    <p><strong>Jam Mulai:</strong> {{ session('jam_mulai') }}</p>
                    <p><strong>Jam Selesai:</strong> {{ session('jam_selesai') }}</p>
                    <p><strong>Tanggal:</strong> {{ session('tanggal') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
