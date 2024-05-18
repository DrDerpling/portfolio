<div class="w-64 bg-primary-darkest hidden md:block pt-4 px-4 leading-none">
    <strong class="block">Dennis Lindeboom</strong>
    <em class="text-xs text-primary-darker">Backend Developer</em>
</div>

<div x-data="{}" class="md:hidden p-2">
    <button @click="$dispatch('open-sidebar')" id="menu" type="button"
            class="flex p-2 text-primary-lighter rounded-lg hover:bg-primary-darker items-center justify-center w-full h-full">
        <x-feather-icon name="menu" class="h-5 w-5 stroke-2"/>
    </button>
</div>
<livewire:navigation.components.history/>