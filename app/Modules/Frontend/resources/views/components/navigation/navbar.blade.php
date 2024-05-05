<nav>
    <ul>

        <li>
            <a href="#">Dennis portfolio</a>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('skills') }}">Skills</a>
            <a href="{{ route('about-me') }}">About me</a>
        </li>

        @if($devMode)
            <li>
                <a href="#">Dev pages</a>
                <a href="{{ route('components') }}">Components</a>
            </li>
        @endif
    </ul>
</nav>
