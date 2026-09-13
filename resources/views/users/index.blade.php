@extends('layout')

@section('title')
    Сотрудники
@endsection

@php
$headers = [
    '№',
    'ФИО',
    'Доступ',
    'Дата регистрации',
    ''
]
@endphp

@section('content')

<div class="w-3/4 m-auto">
    <x-card class="flex items-center justify-center ">
        <div class="pb-4">
            <div class="flex items-center justify-between">
                <div>Сотрудники</div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left min-w-max">
                <thead class="border-b border-gray-200 text-xs uppercase tracking-wide text-gray-500">
                    <tr>
                        @foreach ($headers as $header)
                        <th scope="col" class="px-4 py-3 font-medium"> {{ $header }} </th>
                        @endforeach
                    </tr>
                </thead>
                    
                <tbody>
                    @if (count($users ?? []) > 0)
                    
                        @foreach ($users as $user)
                        <tr>
                            <td class="px-4 py-4 font-medium text-gray-900">{{$loop->iteration}}</td>
                            <td class="px-4 py-4 font-medium text-gray-900">
                                {{ $user->fullName() }}
                            </td>

                            <td class="px-4 py-4 font-medium text-gray-900">
                                <form
                                    method="POST"
                                    action="{{ route('users.verification', ['user' => $user]) }}"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <label class="inline-flex items-center cursor-pointer">
                                        <input
                                            type="checkbox"
                                            class="sr-only peer"
                                            name="is_verified"
                                            onchange="this.form.submit()"
                                            {{ $user->isVerified() ? 'checked' : '' }}
                                        >

                                        <div class="relative w-11 h-6 bg-gray-200 rounded-full
                                                    peer-focus:outline-none peer-focus:ring-2
                                                    peer-checked:bg-blue-600
                                                    after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                                    after:bg-white after:border-gray-300 after:border
                                                    after:rounded-full after:h-5 after:w-5
                                                    after:transition-all
                                                    peer-checked:after:translate-x-full">
                                        </div>
                                    </label>
                                </form>
                            </td>

                            <td class="px-4 py-4 font-medium text-gray-900">
                                {{ $user->created_at->format('d.m.Y') }}
                            </td>

                        </tr>
                        @endforeach
                    @endif
                    
                </tbody> 
                
            </table>
            @if (count($users ?? []) === 0)
                <div class="text-center mt-8">Отчеты не найдены.</div>
            @endif
        </div>
        
    </x-card>
</div>

@endsection