@extends('layout')

@section('title')
    Вход
@endsection

@section('content')
    <form 
        method="post"
        action="/login"
        class="flex items-center justify-center min-h-screen"
    >
        @csrf
        <x-card>
            <div class="flex flex-col gap-4 w-75">
            
                <h1 class="text-2xl font-bold text-center">
                    Вход
                </h1>

                <div class="input-container">
                    <label class="input-label">Логин</label>
                    <input 
                        name="login"
                        value="{{ old('login') }}"
                        class="input"
                    >
                    <span class="error-validation">{{ $errors->first('login') }}</span>
                </div>

                <div class="input-container">
                    <label class="input-label">Пароль</label>
                    <input 
                        name="password"
                        class="input"
                        type="password"
                    >
                    <span class="error-validation">{{ $errors->first('password') }}</span>
                </div>

                <button
                    type="submit"
                    class="btn" 
                >Войти</button>

            </div>
        </x-card>
    </form>
@endsection
