<x-filament::page>
    <form wire:submit.prevent="submit" class="space-y-6" enctype="multipart/form-data">
        @csrf
        {{ $this->form }}

        <div class="flex flex-wrap items-center gap-4 justify-start">
            <x-filament::button type="submit">
                Submit
            </x-filament::button>
        </div>
    </form>
</x-filament::page>
