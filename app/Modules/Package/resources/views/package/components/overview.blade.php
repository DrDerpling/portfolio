<div>
    @foreach($packages as $package)
        <div class="w-1/3">
            <x-package-tile :package="$package"/>
        </div>
    @endforeach
</div>