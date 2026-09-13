@extends('layout')

@section('title')
    Загрузка
@endsection

@section('content')
    <form 
        method="post"
        action="{{ route('reports.store') }}"
        class="flex items-center justify-center"
        enctype="multipart/form-data"
    >
        <x-card>
            <div class="flex flex-col gap-4">
            
                <h1 class="text-2xl font-bold text-center">
                    Загрузка отчета
                </h1>
                <div>

                    <input
                        type="file"
                        name="report"
                        id="report"
                        class="w-full text-sm text-gray-500
                            file:mr-3 file:rounded-md
                            file:border file:border-gray-300
                            file:bg-white file:px-3 file:py-2
                            file:text-sm file:text-gray-700
                            hover:file:bg-gray-50
                            cursor-pointer"
                    />
                    @error('report')
                        <div class="text-red-500 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <label for="type" class="text-gray-500 text-sm">Тип</label>
                    <select
                        name="type"
                        id="type"
                        class="w-full rounded-md border border-gray-200
                            bg-white p-3 text-sm text-gray-600
                            focus:border-gray-300 focus:outline-none cursor-pointer"
                    >
                        <option value="">Выберите тип</option>
                        @foreach ($types as $type => $label)
                            <option value="{{ $type }}" @selected(old('type') === $type)>{{$label}}</option>
                        @endforeach
                    </select>

                    @error('type')
                        <span class="text-red-500 text-sm">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <label for="type" class="text-gray-500 text-sm">Получатель</label>
                    <select
                        name="recipient"
                        id="recipient"
                        class="w-full rounded-md border border-gray-200
                            bg-white p-3 text-sm text-gray-600
                            focus:border-gray-300 focus:outline-none cursor-pointer"
                        value
                    >
                        <option value="">Выберите получателя</option>
                        <option value="1">Отдел продаж</option>
                        
                    </select>

                    @error('recipient')
                        <span class="text-red-500 text-sm">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <x-button
                    label="Загрузить"
                />

                <a
                    href="{{ route('reports.index') }}"
                    class="text-center"
                    onclick="return confirm('Вы уверены, что хотите отменить?')"
                >
                    Отмена
                </a>

            </div>
        </x-card>
    </form>
@endsection