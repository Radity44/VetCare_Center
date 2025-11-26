@extends('layouts.admin')
@section('header', 'Tambah Dokter')
@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
    @include('dokter.form', [
        'action' => route('dokter.store'),
        'method' => 'POST',
        'dokter' => null,
    ])
</div>
@endsection
