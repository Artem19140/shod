<div>
    <div class="flex flex-col">
        <label for="{{ $name }}" class="text-gray-500">{{ $label }}</label>
        <input
            class="border border-gray-300 p-2 rounded-md"
            type="{{ $type }}"
            value="{{ $value }}"
            name="{{ $name }}"
            id="{{ $name }}"
        >
        <span class="text-red-500 pl-2 text-sm" >{{ $error }}</span>
    </div>
</div>