<div
        class="mx-auto relative"
        x-data="{ activeSlide: 1, slides: [1, 2, 3] }"
>
    <!-- Slides -->

    <div x-show="activeSlide === 1" :key="1"
         class="px-24 px-12  py-4 flex items-center">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div class="overflow-hidden shadow-lg hover:shadow-2xl bg-primary-darkest transition-shadow duration-300 flex flex-col">
                <img src="{{ asset('storage/projects/project_gezond.png') }}" alt="Project Gezond App Interface"
                     class="w-full h-48 object-contain flex-shrink-0">
                <div class="p-4 flex-col bg-primary-darker flex justify-between flex-1">
                    <h2 class="font-semibold text-xl text-primary-lighter mb-2">Project Gezond</h2>
                    <p class="text-primary-lighter text-base mb-4 overflow-hidden">
                        {{ Str::limit('As a backend developer for Project Gezond, a dual-platform health and diet app designed to promote sustainable eating habits without causing hunger, I developed a comprehensive backend using Laravel Nova and crafted an API to seamlessly integrate with an Ionic-based frontend. My collaboration extended to assisting with complex Ionic issues and enhancing the application into a Progressive Web App (PWA), optimizing its accessibility and performance across web and mobile platforms.', 300)}}
                    </p>
                    <div class="flex flex-wrap gap-1 items-start mb-4 overflow-hidden">
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#Laravel Nova</span>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#Ionic</span>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#API Development</span>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#PWA</span>
                    </div>
                    <div class="flex justify-between items-center mt-auto">
                        <a href="#" class="text-sm text-primary-lighter font-semibold hover:underline">Read More</a>
                        <a href="https://projectgezond.nl" target="_blank"
                           class="px-3 py-1 border border-primary-darkest text-primary-content rounded hover:bg-primary-darkest hover:text-primary-lighter transition-colors">Visit
                            Website</a>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden shadow-lg hover:shadow-2xl bg-primary-darkest transition-shadow duration-300 flex flex-col">
                <img src="{{ asset('storage/projects/just_carpets.png') }}" alt="Just Carpets Custom Mats"
                     class="w-full h-48 object-contain flex-shrink-0">
                <div class="p-4 bg-primary-darker flex flex-col justify-between flex-1">
                    <h2 class="font-semibold text-xl text-primary-lighter mb-2">Just Carpets</h2>
                    <p class="text-primary-lighter text-base mb-4 overflow-hidden">
                        {{ Str::limit('Engineered and developed a robust E-commerce Management System (EMS) for Just Carpets, a company specializing in custom car and trunk mats, serving customers across Europe. My role as an architect and backend developer involved leveraging Laravel, Livewire, Swagger, and Elasticsearch to ensure scalable multi-region deployment and seamless integration with Exact, Copernica, and Sales Layer.', 300)}}
                    </p>
                    <div class="flex flex-wrap gap-1 items-start mb-4 overflow-hidden">
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#Laravel</span>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#Livewire</span>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#Swagger</span>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#Elasticsearch</span>
                    </div>
                    <div class="flex justify-between items-center mt-auto">
                        <a href="#" class="text-sm text-primary-lighter font-semibold hover:underline">Read More</a>
                        <a href="https://justcarpets.nl" target="_blank"
                           class="px-3 py-1 border border-primary-darkest text-primary-content rounded hover:bg-primary-darkest hover:text-primary-lighter transition-colors">Visit
                            Website</a>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden shadow-lg hover:shadow-2xl bg-primary-darkest transition-shadow duration-300 flex flex-col">
                <img src="{{ asset('storage/projects/bunzlau_castle.png') }}" alt="Bunzlau Castle Tableware"
                     class="w-full h-48 object-contain flex-shrink-0">
                <div class="p-4 bg-primary-darker flex flex-col justify-between flex-1">
                    <h2 class="font-semibold text-xl text-primary-lighter mb-2">Bunzlau Castle (Clip Quality
                        Brands)</h2>
                    <p class="text-primary-lighter text-base mb-4 overflow-hidden">
                        {{ Str::limit('As a backend developer for Bunzlau Castle, a premium tableware brand, I was instrumental in normalizing data for Akeneo integration. I established templates for efficient data entry and managed the setup of a CI/CD pipeline to streamline development. Additionally, I enhanced the frontend user interaction using Alpine.js within the Hyva theme framework.', 300)}}
                    </p>
                    <div class="flex flex-wrap gap-1 items-start mb-4 overflow-hidden">
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#Magento 2</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#Akeneo</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#Hyva</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#AlpineJS</span>
                    </div>
                    <div class="flex justify-between items-center mt-auto">
                        <a href="#" class="text-sm text-primary-lighter font-semibold hover:underline">Read More</a>
                        <a href="https://bunzlaucastle.com" target="_blank"
                           class="px-3 py-1 border border-primary-darkest text-primary-content rounded hover:bg-primary-darkest hover:text-primary-lighter transition-colors">Visit
                            Website</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div x-show="activeSlide === 2" :key="2"
         class="px-24 px-12  py-4 flex items-center">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div class="overflow-hidden shadow-lg hover:shadow-2xl bg-primary-darkest transition-shadow duration-300 flex flex-col">
                <img src="{{ asset('storage/projects/just_carpets.png') }}" alt="Just Carpets Custom Mats"
                     class="w-full h-48 object-contain flex-shrink-0">
                <div class="p-4 bg-primary-darker flex flex-col justify-between flex-1">
                    <h2 class="font-semibold text-xl text-primary-lighter mb-2">Just Carpets</h2>
                    <p class="text-primary-lighter text-base mb-4 overflow-hidden">
                        {{ Str::limit('Engineered and developed a robust E-commerce Management System (EMS) for Just Carpets, a company specializing in custom car and trunk mats, serving customers across Europe. My role as an architect and backend developer involved leveraging Laravel, Livewire, Swagger, and Elasticsearch to ensure scalable multi-region deployment and seamless integration with Exact, Copernica, and Sales Layer.', 300)}}
                    </p>
                    <div class="flex flex-wrap gap-1 items-start mb-4 overflow-hidden">
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#Laravel</span>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#Livewire</span>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#Swagger</span>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#Elasticsearch</span>
                    </div>
                    <div class="flex justify-between items-center mt-auto">
                        <a href="#" class="text-sm text-primary-lighter font-semibold hover:underline">Read More</a>
                        <a href="https://justcarpets.nl" target="_blank"
                           class="px-3 py-1 border border-primary-darkest text-primary-content rounded hover:bg-primary-darkest hover:text-primary-lighter transition-colors">Visit
                            Website</a>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden shadow-lg hover:shadow-2xl bg-primary-darkest transition-shadow duration-300 flex flex-col">
                <img src="{{ asset('storage/projects/bunzlau_castle.png') }}" alt="Bunzlau Castle Tableware"
                     class="w-full h-48 object-contain flex-shrink-0">
                <div class="p-4 bg-primary-darker flex flex-col justify-between flex-1">
                    <h2 class="font-semibold text-xl text-primary-lighter mb-2">Bunzlau Castle (Clip Quality
                        Brands)</h2>
                    <p class="text-primary-lighter text-base mb-4 overflow-hidden">
                        {{ Str::limit('As a backend developer for Bunzlau Castle, a premium tableware brand, I was instrumental in normalizing data for Akeneo integration. I established templates for efficient data entry and managed the setup of a CI/CD pipeline to streamline development. Additionally, I enhanced the frontend user interaction using Alpine.js within the Hyva theme framework.', 300)}}
                    </p>
                    <div class="flex flex-wrap gap-1 items-start mb-4 overflow-hidden">
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#Magento 2</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#Akeneo</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#Hyva</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#AlpineJS</span>
                    </div>
                    <div class="flex justify-between items-center mt-auto">
                        <a href="#" class="text-sm text-primary-lighter font-semibold hover:underline">Read More</a>
                        <a href="https://bunzlaucastle.com" target="_blank"
                           class="px-3 py-1 border border-primary-darkest text-primary-content rounded hover:bg-primary-darkest hover:text-primary-lighter transition-colors">Visit
                            Website</a>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden shadow-lg hover:shadow-2xl bg-primary-darkest transition-shadow duration-300 flex flex-col">
                <img src="{{ asset('storage/projects/project_gezond.png') }}" alt="Project Gezond App Interface"
                     class="w-full h-48 object-contain flex-shrink-0">
                <div class="p-4 flex-col bg-primary-darker flex justify-between flex-1">
                    <h2 class="font-semibold text-xl text-primary-lighter mb-2">Project Gezond</h2>
                    <p class="text-primary-lighter text-base mb-4 overflow-hidden">
                        {{ Str::limit('As a backend developer for Project Gezond, a dual-platform health and diet app designed to promote sustainable eating habits without causing hunger, I developed a comprehensive backend using Laravel Nova and crafted an API to seamlessly integrate with an Ionic-based frontend. My collaboration extended to assisting with complex Ionic issues and enhancing the application into a Progressive Web App (PWA), optimizing its accessibility and performance across web and mobile platforms.', 300)}}
                    </p>
                    <div class="flex flex-wrap gap-1 items-start mb-4 overflow-hidden">
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#Laravel Nova</span>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#Ionic</span>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#API Development</span>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#PWA</span>
                    </div>
                    <div class="flex justify-between items-center mt-auto">
                        <a href="#" class="text-sm text-primary-lighter font-semibold hover:underline">Read More</a>
                        <a href="https://projectgezond.nl" target="_blank"
                           class="px-3 py-1 border border-primary-darkest text-primary-content rounded hover:bg-primary-darkest hover:text-primary-lighter transition-colors">Visit
                            Website</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div x-show="activeSlide === 3" :key="3"
         class="px-24 px-12  py-4 flex items-center">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div class="overflow-hidden shadow-lg hover:shadow-2xl bg-primary-darkest transition-shadow duration-300 flex flex-col">
                <img src="{{ asset('storage/projects/bunzlau_castle.png') }}" alt="Bunzlau Castle Tableware"
                     class="w-full h-48 object-contain flex-shrink-0">
                <div class="p-4 bg-primary-darker flex flex-col justify-between flex-1">
                    <h2 class="font-semibold text-xl text-primary-lighter mb-2">Bunzlau Castle (Clip Quality
                        Brands)</h2>
                    <p class="text-primary-lighter text-base mb-4 overflow-hidden">
                        {{ Str::limit('As a backend developer for Bunzlau Castle, a premium tableware brand, I was instrumental in normalizing data for Akeneo integration. I established templates for efficient data entry and managed the setup of a CI/CD pipeline to streamline development. Additionally, I enhanced the frontend user interaction using Alpine.js within the Hyva theme framework.', 300)}}
                    </p>
                    <div class="flex flex-wrap gap-1 items-start mb-4 overflow-hidden">
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#Magento 2</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#Akeneo</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#Hyva</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#AlpineJS</span>
                    </div>
                    <div class="flex justify-between items-center mt-auto">
                        <a href="#" class="text-sm text-primary-lighter font-semibold hover:underline">Read More</a>
                        <a href="https://bunzlaucastle.com" target="_blank"
                           class="px-3 py-1 border border-primary-darkest text-primary-content rounded hover:bg-primary-darkest hover:text-primary-lighter transition-colors">Visit
                            Website</a>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden shadow-lg hover:shadow-2xl bg-primary-darkest transition-shadow duration-300 flex flex-col">
                <img src="{{ asset('storage/projects/project_gezond.png') }}" alt="Project Gezond App Interface"
                     class="w-full h-48 object-contain flex-shrink-0">
                <div class="p-4 flex-col bg-primary-darker flex justify-between flex-1">
                    <h2 class="font-semibold text-xl text-primary-lighter mb-2">Project Gezond</h2>
                    <p class="text-primary-lighter text-base mb-4 overflow-hidden">
                        {{ Str::limit('As a backend developer for Project Gezond, a dual-platform health and diet app designed to promote sustainable eating habits without causing hunger, I developed a comprehensive backend using Laravel Nova and crafted an API to seamlessly integrate with an Ionic-based frontend. My collaboration extended to assisting with complex Ionic issues and enhancing the application into a Progressive Web App (PWA), optimizing its accessibility and performance across web and mobile platforms.', 300)}}
                    </p>
                    <div class="flex flex-wrap gap-1 items-start mb-4 overflow-hidden">
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#Laravel Nova</span>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#Ionic</span>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#API Development</span>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#PWA</span>
                    </div>
                    <div class="flex justify-between items-center mt-auto">
                        <a href="#" class="text-sm text-primary-lighter font-semibold hover:underline">Read More</a>
                        <a href="https://projectgezond.nl" target="_blank"
                           class="px-3 py-1 border border-primary-darkest text-primary-content rounded hover:bg-primary-darkest hover:text-primary-lighter transition-colors">Visit
                            Website</a>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden shadow-lg hover:shadow-2xl bg-primary-darkest transition-shadow duration-300 flex flex-col">
                <img src="{{ asset('storage/projects/just_carpets.png') }}" alt="Just Carpets Custom Mats"
                     class="w-full h-48 object-contain flex-shrink-0">
                <div class="p-4 bg-primary-darker flex flex-col justify-between flex-1">
                    <h2 class="font-semibold text-xl text-primary-lighter mb-2">Just Carpets</h2>
                    <p class="text-primary-lighter text-base mb-4 overflow-hidden">
                        {{ Str::limit('Engineered and developed a robust E-commerce Management System (EMS) for Just Carpets, a company specializing in custom car and trunk mats, serving customers across Europe. My role as an architect and backend developer involved leveraging Laravel, Livewire, Swagger, and Elasticsearch to ensure scalable multi-region deployment and seamless integration with Exact, Copernica, and Sales Layer.', 300)}}
                    </p>
                    <div class="flex flex-wrap gap-1 items-start mb-4 overflow-hidden">
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#Laravel</span>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#Livewire</span>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#Swagger</span>
                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#Elasticsearch</span>
                    </div>
                    <div class="flex justify-between items-center mt-auto">
                        <a href="#" class="text-sm text-primary-lighter font-semibold hover:underline">Read More</a>
                        <a href="https://justcarpets.nl" target="_blank"
                           class="px-3 py-1 border border-primary-darkest text-primary-content rounded hover:bg-primary-darkest hover:text-primary-lighter transition-colors">Visit
                            Website</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Prev/Next Arrows -->
    <div class="absolute inset-0 flex">
        <div class="absolute inset-0 flex">
            <div class="flex items-center justify-start w-1/2">
                <button
                        class="border border-primary-darkest text-primary hover:bg-secondary hover:text-darkest hover:shadow-lg rounded-md px-4 py-2"
                        x-on:click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1">
                    <x-feather-icon name="chevron-left" className="h-6 w-6"/>
                </button>
            </div>
            <div class="flex items-center justify-end w-1/2">
                <button
                        class="border border-primary-darkest text-primary hover:bg-secondary hover:text-primary-lighter hover:shadow-lg rounded-md px-4 py-2"
                        x-on:click="activeSlide = activeSlide === slides.length ? 1 : activeSlide + 1">
                    <x-feather-icon name="chevron-right" className="h-6 w-6"/>
                </button>
            </div>
        </div>

    </div>


    <!-- Buttons -->
    <div class="absolute w-full flex items-center justify-center px-4">
        <template x-for="slide in slides" :key="slide">
            <button
                    class="flex-1 w-4 h-2 mt-4 mx-2 mb-0 rounded overflow-hidden transition-colors duration-200 ease-out hover:bg-teal-600 hover:shadow-lg"
                    :class="{
              'bg-secondary': activeSlide === slide,
              'bg-primary-darkest': activeSlide !== slide
          }"
                    x-on:click="activeSlide = slide"
            ></button>
        </template>
    </div>
</div>


{{--<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">--}}
{{--    <!-- Card 1: Just Carpets -->--}}


<!-- Card 2: Bunzlau Castle -->


{{--    <!-- Card 3: Project Gezond -->--}}

{{--</div>--}}
