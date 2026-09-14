@extends('layout')

@section('title')
    Организации
@endsection

@section('content')
<div class="w-3/4 m-auto">
    <x-card class="flex items-center justify-center ">
        <div class="pb-4">
            <div class="flex items-center justify-between">
                <div>Организации</div>
                <a
                    href="{{ route('organizations.create') }}"
                    class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md"
                >Добавить</a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left min-w-max">
                <thead class="border-b border-gray-200 text-xs uppercase tracking-wide text-gray-500">
                    <tr>
                        <th scope="col" class="px-4 py-3 font-medium">№</th>
                        <th scope="col" class="px-4 py-3 font-medium">Название</th>
                    </tr>
                </thead>
                    
                <tbody>
                    @if (count($organizations) > 0)
                    
                        @foreach ($organizations as $organization)
                        <tr>
                            <td class="px-4 py-4 font-medium text-gray-900">
                                {{$loop->iteration}}
                            </td>

                            <td class="px-4 py-4 font-medium text-gray-900">
                                {{ $organization->name }}
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody> 
                
            </table>
            @if (count($organizations) === 0)
                <div class="text-center mt-8">Организации не найдены.</div>
            @endif
        </div>
    </x-card>
</div>
@endsection