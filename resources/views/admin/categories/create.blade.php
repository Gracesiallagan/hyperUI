@extends('layouts.admin')
@section('title', 'Tambah Kategori')
@section('page_title', 'Tambah Kategori')
@section('page_subtitle', 'Buat kategori produk baru')

@section('content')
@include('admin.categories.form', [
    'action' => route('admin.categories.store'),
    'method' => 'POST',
    'button' => 'Simpan Kategori',
])
@endsection
