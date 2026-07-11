@extends('frontend.layouts.master')

@section('content')
<section class="about-hero" style="background-color:#1a1a1a; padding:60px 0;">
    <div class="container-xl text-center">
        <h1 class="text-white">{{ $page->title }}</h1>
    </div>
</section>

<section class="py-5">
    <div class="container-xl">
        @if($page->image)
            <img src="{{ asset('storage/' . $page->image) }}" class="img-fluid rounded mb-4" alt="{{ $page->title }}" style="width: 100%; max-height: 400px; object-fit: cover;">
        @endif
        
        <div class="page-content">
            <!-- The content contains raw HTML from the editor -->
            {!! $page->content !!}
        </div>
    </div>
</section>
@endsection
