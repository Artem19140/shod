@props([
    'types' => [],
    'organizations' => [],
    'users' => []
])

<div
    x-data="{
        open: false,

        reset() {
            this.$refs.form.reset()
        }
    }"
>
    <button
        type="button"
        @click="open = true"
        class=" rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-500 cursor-pointer"
    >
        Фильтры
    </button>

    <div
        x-cloak
        x-show="open"
        x-transition.opacity
        class="fixed inset-0 z-50 overflow-y-auto"
    >
        <div
            class="fixed inset-0 bg-black/40"
            @click="open = false"
        ></div>

        <div class="relative flex min-h-full items-center justify-center p-4">

            <div
                x-show="open"
                x-transition
                @click.outside="open = false"
                class="relative w-full max-w-lg rounded-xl bg-white shadow-xl p-4"
            >

                <div class="flex items-center justify-between px-6 py-4 ">
                    <h2 class="text-lg font-semibold text-gray-500">
                        Фильтры
                    </h2>

                    <button
                        type="button"
                        @click="open = false"
                        class="text-2xl leading-none text-gray-400 hover:text-gray-600 cursor-pointer"
                    >
                        &times;
                    </button>
                </div>

                <form
                    x-ref="form"
  
                    action="{{ url()->current() }}"
                    class="space-y-5 p-6"
                >
                    <div class="input-container">
                        <label
                            for="type"
                            class="input-label"
                        >
                            Тип отчёта
                        </label>

                        <select
                            id="type"
                            name="type"
                            class="select"
                        >
                            <option value="">Любой</option>
                            @foreach ($types as $type => $label)
                                <option 
                                    value="{{ $type }}" 
                                    @selected( request('type') === $type )
                                >
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-container">
                        <label
                            for="organization"
                            class="input-label"
                        >
                            Для кого
                        </label>

                        <select
                            id="organization"
                            name="organization"
                            class="select"
                        >
                            <option value="">Все</option>

                            @foreach ($organizations as $organization)
                                <option
                                    value="{{ $organization->id }}"
                                    @selected(request('organization') == $organization->id)
                                >
                                    {{ $organization->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-container">
                        <label
                            for="organization"
                            class="input-label"
                        >
                            Автор
                        </label>

                        <select
                            id="author"
                            name="author"
                            class="select"
                        >
                            <option value="">Любой</option>

                            @foreach ($users as $user)
                                <option
                                    value="{{ $user->id }}"
                                    @selected(request('author') == $user->id)
                                >
                                    {{ $user->fullName() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">

                        <div class="input-container">
                            <label
                                for="date_from"
                                class="input-label"
                            >
                                С
                            </label>

                            <input
                                type="date"
                                id="date_from"
                                name="date_from"
                                value="{{ request('date_from') }}"
                                class="input"
                            >
                        </div>

                        <div class="input-container">
                            <label
                                for="date_to"
                                class="input-label"
                            >
                                По
                            </label>

                            <input
                                type="date"
                                id="date_to"
                                name="date_to"
                                value="{{ request('date_to') }}"
                                class="input"
                            >
                        </div>

                    </div>

                    <div class="flex items-center justify-between">

                        <a
                            href="{{route('reports.index')}}"
                            class="text-sm text-gray-500 hover:text-gray-800"
                        >
                            Сбросить
                        </a>

                        <div class="flex gap-2">

                            <button
                                type="button"
                                @click="open = false"
                                class="rounded-lg  px-4 py-2 text-sm cursor-pointer"
                            >
                                Отмена
                            </button>

                            <button
                                type="submit"
                                class="btn"
                            >
                                Применить
                            </button>

                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>