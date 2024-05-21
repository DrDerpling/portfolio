<div class="mx-auto flex flex-col justify-center items-center">
    <div class="xl:flex items-center space-y-8 xl:space-y-0 xl:space-x-16">
        <div class="xl:mr-6 max-w-lg">
            <p class="text-lg">Hi there, I'm</p>
            <h1 class="text-5xl font-semibold mb-4">
                <span class="text-secondary">Dennis</span> Lindeboom
            </h1>
            <p class="text-lg mb-6">
                A <span class="text-secondary">Backend Developer</span> specializing in integration work and
                e-commerce solutions, with a plethora of technologies.
            </p>
            <div class="flex space-x-4">
                <a href="#contact">
                    <button class="bg-secondary py-2 px-6 text-darkest shadow-md hover:bg-secondary-dark transition duration-300">
                        Contact Me
                    </button>
                </a>
                <a href="https://github.com/DrDerpling" target="_blank"
                   class="p-2 bg-primary-darkest shadow-lg hover:bg-primary-darker transition duration-300">
                    <x-feather-icon name="github" class="text-secondary h-6 w-6"/>
                </a>
                <a href="https://www.linkedin.com/in/dennis-lindeboom-353a87154/" target="_blank"
                   class="p-2 bg-primary-darkest shadow-lg hover:bg-primary-darker transition duration-300">
                    <x-feather-icon name="linkedin" class="text-secondary h-6 w-6"/>
                </a>
            </div>
            <div class="flex items-center my-8">
                <hr class="flex-grow border-t border-primary">
                <span class="mx-4 text-primary-lighter">OR</span>
                <hr class="flex-grow border-t border-primary">
            </div>
            <p class="text-center text-primary-darker">Scroll down to find out more about what I do</p>
        </div>
        <div class="relative w-64 h-64 mx-auto bg-primary-lighter border-2 border-b-4 border-secondary">
            <img src="{{ asset('images/f1-with-background.png') }}"
                 class="w-full h-full object-cover">
        </div>
    </div>
</div>