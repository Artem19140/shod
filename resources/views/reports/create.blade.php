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
        @csrf
        <x-card>
            <div class="flex flex-col gap-4">
                
                <h1 class="text-2xl font-bold text-center">
                    Загрузка отчета
                </h1>
                <div class="input-container">
                    <label for="report" class="input-label">Отчет</label>
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

                <div class="input-container">
                    <label for="type" class="input-label">Тип</label>
                    <select
                        name="type"
                        id="type"
                        class="select"
                    >
                        <option value="">Выберите тип</option>
                        @foreach ($types as $type => $label)
                            <option 
                                value="{{ $type }}" 
                                @selected(old('type') === $type)
                            >
                                {{$label}}
                            </option>
                        @endforeach
                    </select>

                    @error('type')
                        <span class="text-red-500 text-sm">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="input-container">
                    <label for="organization" class="input-label">Для кого</label>
                    <select
                        name="organization"
                        id="organization"
                        class="select"
                    >
                        <option value="">Выберите организацию</option>
                        @foreach ($organizations as $organization)
                            <option 
                                value="{{ $organization->id }}" 
                                @selected((int)old('organization') === $organization->id)
                            >
                                {{ $organization->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('recipient')
                        <span class="text-red-500 text-sm">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn">
                    Загрузить
                </button>

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