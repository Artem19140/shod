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
        <x-card>
            <div class="flex flex-col gap-4 w-75">
            
                <h1 class="text-2xl font-bold text-center">
                    Вход
                </h1>

                <x-input 
                    label="Логин"
                    name="login"
                    value="{{ old('login') ?? 'studman2' }}"
                    :error="$errors->first('login')"
                />

                <x-input 
                    label="Пароль"
                    type="password"
                    name="password"
                    value="{{ old('password') ?? 'straus' }}"
                    :error="$errors->first('password')"
                />

                <x-button
                    label="Войти"
                />

            </div>
        </x-card>
    </form>
@endsection
