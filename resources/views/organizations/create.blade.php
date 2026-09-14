@extends('layout')

@section('title')
    Организации
@endsection

@section('content')
    <form 
        method="post"
        action="{{ route('organizations.store') }}"
        class="flex items-center justify-center"
        enctype="multipart/form-data"
    >
        <x-card>
            <div class="flex flex-col gap-4">
            
                <h1 class="text-2xl font-bold text-center">
                    Создание органиазции
                </h1>
                <div class="flex flex-col">
                    <label for="name" class="text-gray-500 text-sm">Название</label>
                    <input
                        name="name"
                        id="name"
                        class="border border-gray-300 p-2 rounded-md"
                    >
                    @error('name')
                        <span class="text-red-500 text-sm">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="btn"
                >Создать</button>

                <a
                    href="{{ route('organizations.index') }}"
                    class="text-center"
                    onclick="return confirm('Вы уверены, что хотите отменить?')"
                >
                    Отмена
                </a>

            </div>
        </x-card>
    </form>
@endsection