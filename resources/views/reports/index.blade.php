@extends('layout')

@section('title')
    Отчеты
@endsection

@php
$headers = [
    'Название',
    'Тип',
    'Размер',
    'Автор',
    'Для кого',
    'Дата загрузки',
    'Действия'
]
@endphp

@section('content')
<div class="w-3/4 m-auto">
    <x-card class="flex items-center justify-center ">
    
        <div class="pb-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div>Отчеты</div>
                    <x-filters-reports
                        :organizations="$organizations"
                        :types="$types "
                        :users="$users"
                    />
                </div>
                <a
                    href="{{ route('reports.create') }}"
                    class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md"
                >Добавить</a>
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
                    @if (count($reports) > 0)
                    
                        @foreach ($reports as $report)
                        <tr>
                            <td class="px-4 py-4 font-medium text-gray-900">
                                {{ $report->original_file_name }}
                            </td>

                            <td class="px-4 py-4 font-medium text-gray-900">
                                {{ $report->types()[$report->type] }}
                            </td>

                            <td class="px-4 py-4 font-medium text-gray-900">
                                {{ round($report->size / 1024 , 2) }} Kb
                            </td>

                            <td class="px-4 py-4 font-medium text-gray-900">
                                {{ $report->user->fullName() }}
                            </td>

                            <td class="px-4 py-4 font-medium text-gray-900">
                                {{ $report->organization->name }}
                            </td>

                             <td class="px-4 py-4 font-medium text-gray-900">
                                {{ $report->created_at->format('d.m.Y') }}
                            </td>

                            <td class="px-4 py-4 font-medium text-gray-900">
                                <div class="flex gap-2">
                                    <a href="{{ route('reports.download', ['report'=>$report]) }}">
                                        <x-heroicon-o-arrow-down-tray class="h-6 text-gray-500 cursor-pointer" />
                                    </a>    
                                    @if ($report->user_id === auth()->user()->id)
                                        <form
                                            method="POST"
                                            action="{{ route('reports.destroy', ['report'=> $report]) }}"
                                            onsubmit="return confirm('Вы уверены, что хотите удалить отчет?')"
                                        >
                                            @method('DELETE')
                                            <button type="submit">
                                                <x-heroicon-o-trash class="h-6 text-red-500 cursor-pointer" />
                                            </button>
                                        </form>
                                        
                                    @endif
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    @endif
                    
                </tbody> 
                
            </table>
            @if (count($reports) === 0)
                <div class="text-center mt-8">Отчеты не найдены.</div>
            @endif
            <div class="mt-4">
                {{ $reports->links() }}
            </div>
        </div>
        
    </x-card>
</div>
@endsection