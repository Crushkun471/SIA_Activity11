<div class="h-11 w-11 rounded-lg overflow-hidden">
    @if (auth()->user()->avatar)
        <img
            class="h-full w-full object-cover"
            src="{{ asset('storage/' . auth()->user()->avatar) }}"
            alt="{{ auth()->user()->name }}"
        >
    @endif
</div>
