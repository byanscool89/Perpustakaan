<!-- resources/views/denda/edit.blade.php -->
@extends('layout.main')

@section('content')
<div class="container">
    <h1>Edit Denda</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('denda.update', $denda->id_denda) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="kategori_denda" class="form-label">Kategori Denda</label>
            <input type="text" class="form-control" id="kategori_denda" name="kategori_denda" value="{{ $denda->kategori_denda }}" required>
        </div>
        <div class="mb-3">
            <label for="biaya" class="form-label">Biaya</label>
            <input type="number" class="form-control" id="biaya" name="biaya" value="{{ $denda->biaya }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('denda.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
