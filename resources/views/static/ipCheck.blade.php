@extends('layouts.main')
@section('title', 'IP Check')

@section('content')
@if($errors->any())
    <div class="error-container">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="main-container">
    <h2>Добро пожаловать на сайт для проверки IP-адреса</h2>
    <p>Этот сайт позволяет проверить IP-адрес и получить информацию о нём.</p>
    
    <div class="form-container">
        <form action="{{ route('ipCheck.post') }}" method="POST">
            @csrf
            <label for="ip">Введите IP-адрес:</label>
            <input type="text" placeholder="Введите IP-адрес" name="ip" id="ip" value="{{ old('ip') }}">
            <button type="submit">Проверить IP</button>
        </form>
    </div>
</div>
@endsection