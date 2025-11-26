@extends('layouts.admin')
@section('header', 'Edit Dokter')
@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
    @include('dokter.form', [
        'action' => route('dokter.update', $dokter),
        'method' => 'PUT',
        'dokter' => $dokter,
    ])
</div>
@endsection
