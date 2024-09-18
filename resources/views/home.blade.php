@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div>
                    <h1>User Dashboard</h1>
                    <form method="POST" action="{{ route('dashboard') }}">
                        @csrf
                        <div>
                            <label for="nama">Nama : </label>
                            <input type="text" id="nama" name="name" required>
                        </div>
                        <div>
                            <label for="ruang">Ruangan : </label>
                            <select name="ruang" id="ruang" required>
                                <option value="ruang1" >Ruang 1</option>
                                <option value="ruang2" >Ruang 2</option>
                                <option value="ruang3">Ruang 3</option>
                            </select>
                        </div>
                        <div>
                            <label for="jam">Jam Mulai : </label>
                            <input type="time" id="jam_mulai" name="jam_mulai" required>
                            <label for="jam">Jam Selesai : </label>
                            <input type="time" id="jam_selesai" name="jam_selesai" required>
                            
                        <div>
                        
                            <label for="tanggal">Tanggal : </label>
                            <input type="date" id="tanggal" name="tanggal" required>
                        </div>
                        <button type="submit">Submit</button>
                        @if (session('success'))
                        <div class="alert alert-success">
                             {{ session('success') }}
                        </div>
                        @endif (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection