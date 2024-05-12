<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
    <div class="bg-primary overflow-hidden shadow-lg hover:shadow-2xl bg-primary-darker transition-shadow duration-300">
        <img src="{{ asset('storage/projects/just_carpets.png') }}" alt="Just Carpets Custom Mats"
             class="w-full h-48 object-contain">
        <div class="p-4 bg-primary-darker flex flex-col justify-between flex-1"> <!-- This needs to be full height of its parent -->
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
            <div class="flex justify-between items-center items-end">
                <a href="#" class="text-sm text-primary-lighter font-semibold hover:underline">Read More</a>
                <a href="https://justcarpets.nl" target="_blank"
                   class="px-3 py-1 border border-primary-darkest text-primary-content rounded hover:bg-primary-darkest hover:text-primary-lighter transition-colors">Visit
                    Website</a>
            </div>
        </div>
    </div>

    <div class="bg-primary overflow-hidden shadow-lg hover:shadow-2xl bg-primary-darker transition-shadow duration-300">
        <img src="{{ asset('storage/projects/bunzlau_castle.png') }}" alt="Bunzlau Castle Tableware"
             class="w-full h-48 object-contain">
        <div class="p-4 bg-primary-darker flex-col flex justify-between">
            <h2 class="font-semibold text-xl text-primary-lighter mb-2">Bunzlau Castle (Clip Quality Brands)</h2>
            <p class="text-primary-lighter text-base mb-4 overflow-hidden">
                {{ Str::limit('As a backend developer for Bunzlau Castle, a premium tableware brand, I was instrumental in normalizing data for Akeneo integration. I established templates for efficient data entry and managed the setup of a CI/CD pipeline to streamline development. Additionally, I enhanced the frontend user interaction using Alpine.js within the Hyva theme framework.', 300)}}
            </p>
            <div class="flex flex-wrap gap-1 items-start mb-4 overflow-hidden">
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#Magento 2</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#Akeneo</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#Hyva</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#AlpineJS</span>
            </div>
            <div class="flex justify-between items-center">
                <a href="#" class="text-sm text-primary-lighter font-semibold hover:underline">Read More</a>
                <a href="https://bunzlaucastle.com" target="_blank"
                   class="px-3 py-1 border border-primary-darkest text-primary-content rounded hover:bg-primary-darkest hover:text-primary-lighter transition-colors">Visit
                    Website</a>
            </div>
        </div>
    </div>

    <div class="bg-primary overflow-hidden shadow-lg hover:shadow-2xl bg-primary-darker transition-shadow duration-300">
        <img src="{{ asset('storage/projects/project_gezond.png') }}" alt="Project Gezond App Interface"
             class="w-full h-48 object-contain">
        <div class="p-4 flex-col flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-primary-lighter mb-2">Project Gezond</h2>
                <p class="text-primary-lighter text-base mb-4 overflow-hidden">
                    {{ Str::limit('As a backend developer for Project Gezond, a dual-platform health and diet app designed to promote sustainable eating habits without causing hunger, I developed a comprehensive backend using Laravel Nova and crafted an API to seamlessly integrate with an Ionic-based frontend. My collaboration extended to assisting with complex Ionic issues and enhancing the application into a Progressive Web App (PWA), optimizing its accessibility and performance across web and mobile platforms.', 300)}}
                </p>
            </div>
            <div>
                <div class="flex flex-wrap gap-1 items-start mb-4 overflow-hidden">
                    <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#Laravel Nova</span>
                    <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#Ionic</span>
                    <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#API Development</span>
                    <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#PWA</span>
                </div>
                <div class="flex justify-between items-center">
                    <a href="#" class="text-sm text-primary-lighter font-semibold hover:underline">Read More</a>
                    <a href="https://projectgezond.nl" target="_blank"
                       class="px-3 py-1 border border-primary-darkest text-primary-content rounded hover:bg-primary-darkest hover:text-primary-lighter transition-colors">Visit
                        Website</a>
                </div>
            </div>
        </div>
    </div>
</div>
