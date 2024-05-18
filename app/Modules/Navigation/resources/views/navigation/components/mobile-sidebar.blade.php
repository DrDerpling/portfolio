<div x-data="{ open: false }"
     @open-sidebar.window="open = true"
     @close-sidebar.window="open = false"
     class="fixed inset-0 z-50 flex md:hidden"
     :class="{ 'hidden': !open }">

    <!-- Overlay -->
    <div class="fixed inset-0 bg-black bg-opacity-50"
         @click="open = false"></div>

    <!-- Sidebar -->
    <aside class="relative bg-primary-darker w-64 transition-transform transform -translate-x-full"
           :class="{ 'translate-x-0': open, '-translate-x-full': !open }">
        <div class="bg-primary-darkest p-4 leading-none">
            <strong class="block">Dennis Lindeboom</strong>
            <em class="text-xs text-primary-darker">Backend Developer</em>
        </div>
        <x-navigation-sidebar class="p-4"/>
    </aside>
</div>