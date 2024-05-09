@extends('layouts.code-editor')

@section('content')
    <div class="prose lg:prose-xl">
        {!!
            $page->content
        !!}
    </div>
@endsection
