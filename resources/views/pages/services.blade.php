@extends('layouts.app')
@section('title', 'VerdantRidge Services')
@section('content')
<section class="section">
    <div class="wrap">
        <h2>Services</h2>
        <p class="lede">From ASTM Phase I ESAs to wet-season SWPPP monitoring — advisory packages sized for developers, manufacturers, and municipal clients.</p>
        <div class="grid-3">
            @foreach([
                ['phase-i-esa','Phase I Environmental Site Assessment','https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1600&q=80'],
                ['phase-ii-investigation','Phase II Site Investigation','https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=1600&q=80'],
                ['stormwater-swppp','Stormwater SWPPP & Monitoring','https://images.unsplash.com/photo-1433086966358-54859d0ed716?auto=format&fit=crop&w=1600&q=80'],
                ['wetland-delineation','Wetland Delineation','https://images.unsplash.com/photo-1501854140801-50d01698950b?auto=format&fit=crop&w=1600&q=80'],
                ['air-quality-assessment','Air Quality Assessment','https://images.unsplash.com/photo-1611273426858-450d8e3c9fce?auto=format&fit=crop&w=1600&q=80'],
                ['compliance-audit','Environmental Compliance Audit','https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1600&q=80'],
            ] as [$slug,$title,$img])
                <a class="service-tile" href="{{ route('services.show', $slug) }}">
                    <img src="{{ $img }}" alt="{{ $title }}">
                    <div class="pad"><h3>{{ $title }}</h3></div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endsection