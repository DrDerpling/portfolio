@extends('layouts.code-editor')

@section('content')
    <article class="prose lg:prose-xl">
        {!!
            $page->content
        !!}
    </article>
@endsection
