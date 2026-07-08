@extends('layouts.admin')
@section('title', 'Edit Kategori')
@section('page_title', 'Edit Kategori')
@section('page_subtitle', 'Perbarui kategori produk')

@section('content')
@include('admin.categories.form', [
    'action' => route('admin.categories.update', $category),
    'method' => 'PUT',
    'button' => 'Simpan Perubahan',
])
@endsection
