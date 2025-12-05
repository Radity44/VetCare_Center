@extends('layouts.admin')
@section('header', 'Edit Kunjungan')
@section('content')

<div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Kunjungan</h2>
    
    @include('kunjungan.form', [
        'action' => route('kunjungan.update', $kunjungan),
        'method' => 'PUT',
        'kunjungan' => $kunjungan,
    ])
</div>

@endsection
