@extends('layouts.main')

@section('content')
    <article class="prose lg:prose-xl">
        {!!
            $page->content
        !!}
    </article>
@endsection
