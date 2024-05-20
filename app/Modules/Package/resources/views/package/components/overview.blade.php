<div class="lg:flex">
    @foreach($packages as $package)
        <div class="md:w-full lg:w-1/2 xl:w-1/3">
            <x-package-tile :package="$package"/>
        </div>
    @endforeach
</div>