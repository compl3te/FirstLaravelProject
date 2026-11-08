@extends('layouts.main')
@section('title', 'IP Check')

@section('content')

<div class="main-container">
    <h2>Добро пожаловать на сайт для проверки IP-адреса</h2>
    <p>Этот сайт позволяет проверить IP-адрес и получить информацию о нём.</p>
    
    <div class="form-container">
        <form id="ipForm" action="{{ route('ipCheck.post') }}" method="POST">
            @csrf
            <label for="ip">Введите IP-адрес:</label>
            <input type="text" placeholder="Введите IP-адрес" name="ip" id="ip" value="{{ old('ip') }}">
            <button type="submit" id="checkIpBtn">Проверить IP</button>
        </form>
    </div> 
    <div class="result-container">
        <h1>Результат проверки IP-адреса</h1>
        <div class="result" id="result">

        </div>
    </div>
</div>
@endsection
