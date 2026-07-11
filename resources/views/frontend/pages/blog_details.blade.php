@extends('frontend.layouts.master')

@section('content')
<section class="about-hero contactmain-contact-hero" style="background-color:#1a1a1a; padding:150px 0 60px 0;">
    <div class="container-xl text-center" style="display: flex; flex-direction: column; align-items: center; justify-content: center; width: 100%;">
        <h1 class="text-white" style="text-align: center !important; margin: 0 auto;">{{ $post->title }}</h1>
        <p class="text-white-50 mt-2" style="text-align: center !important; margin: 0 auto;">Published on {{ $post->created_at->format('M d, Y') }}</p>
    </div>
</section>

<section class="py-5">
    <div class="container-xl" style="max-width: 800px;">
        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded mb-4" alt="{{ $post->title }}" style="width: 100%; max-height: 500px; object-fit: cover;">
        @endif
        
        <div class="blog-content">
            <!-- The content contains raw HTML from the editor -->
            {!! $post->content !!}
        </div>
        
        <div class="mt-5">
            <a href="{{ route('blog') }}" class="btn btn-outline-dark">&larr; Back to Blog</a>
        </div>
    </div>
</section>
@endsection
