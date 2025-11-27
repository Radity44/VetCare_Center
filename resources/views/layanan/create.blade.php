@extends('layouts.admin')
@section('header', 'Tambah Layanan')
@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
    @include('layanan.form', [
        'action' => route('layanan.store'),
        'method' => 'POST',
        'layanan' => null,
    ])
</div>
@endsection
