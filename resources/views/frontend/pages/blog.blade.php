@extends('frontend.layouts.master')

@section('content')
<section class="about-hero" style="background-color:#1a1a1a; padding:60px 0;">
    <div class="container-xl text-center">
        <h1 class="text-white">Our <span>Blog</span></h1>
        <p class="text-white-50">Latest news, recipes, and articles.</p>
    </div>
</section>

<section class="py-5">
    <div class="container-xl">
        <div class="row g-4">
            @forelse($posts as $post)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm border-0">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 250px; object-fit: cover;">
                    @else
                        <img src="https://images.unsplash.com/photo-1607746882042-944635dfe10e?auto=format&fit=crop&w=500&q=85" class="card-img-top" alt="{{ $post->title }}" style="height: 250px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <small class="text-muted">{{ $post->created_at->format('M d, Y') }}</small>
                        <h4 class="card-title mt-2">{{ $post->title }}</h4>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 100) }}</p>
                        <a href="{{ route('blog.details', $post->slug) }}" class="btn btn-outline-dark mt-2">Read More</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <h4>No posts available at the moment.</h4>
            </div>
            @endforelse
        </div>
        
        <div class="mt-5 d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
</section>
@endsection
