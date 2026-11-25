@extends('layouts.app')

@section('title', 'VerdantRidge Blog')
@section('meta_description', 'Practical notes for developers, lenders, and facility managers facing environmental diligence.')

@section('content')
<section class="section">
    <div class="wrap">
        <h2>Field notes from the Willamette</h2>
        <p class="lede">Practical notes for developers, lenders, and facility managers facing environmental diligence.</p>
        <div class="grid-3">
            @forelse($posts as $post)
                <a class="panel" href="{{ route('blog.show', $post->slug) }}">
                    @if($post->cover_image)
                        <img src="{{ $post->cover_image }}" alt="" style="width:100%;height:160px;object-fit:cover;margin-bottom:.8rem;border-radius:.3rem;">
                    @endif
                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->excerpt }}</p>
                </a>
            @empty
                <div class="panel"><p>No posts yet.</p></div>
            @endforelse
        </div>
        <div style="margin-top:2rem">{{ $posts->links() }}</div>
    </div>
</section>
@endsection