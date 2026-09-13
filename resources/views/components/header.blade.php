<header class="border-b border-gray-200">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

        {{-- Навигация --}}
        <nav class="flex items-center gap-1">
            @if (auth()->user()->isAdmin())
                <a
                    href="{{ route('reports.index') }}"
                    class="rounded-md px-3 py-2 text-sm font-medium text-gray-600
                           transition hover:bg-gray-100 hover:text-gray-900
                           {{ request()->routeIs('reports.*') ? 'bg-gray-100 text-gray-900' : '' }}"
                >
                    Отчёты
                </a>

                <a
                    href="{{ route('users.index') }}"
                    class="rounded-md px-3 py-2 text-sm font-medium text-gray-600
                           transition hover:bg-gray-100 hover:text-gray-900
                           {{ request()->routeIs('users.*') ? 'bg-gray-100 text-gray-900' : '' }}"
                >
                    Сотрудники
                </a>
            @endif
        </nav>
        <div class="flex gap-2">
            <div class="text-sm text-gray-500">
                {{ auth()->user()->fullName() }}
            </div>
            <form
                method="post"
                action="{{ route('logout') }}"
                onsubmit="return confirm('Вы уверены, что хотите выйти?')"
            >
                <button type="submit">
                    <x-heroicon-o-arrow-right-on-rectangle class="h-6 text-grey-500 cursor-pointer" />
                </button>
            </form>
        </div>
    </div>
</header>