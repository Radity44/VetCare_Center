@extends('layouts.admin')
@section('header', 'Edit Layanan')
@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
    @include('layanan.form', [
        'action' => route('layanan.update', $layanan),
        'method' => 'PUT',
        'layanan' => $layanan,
    ])
</div>
@endsection
