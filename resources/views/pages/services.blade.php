@extends('layouts.app')
@section('title', 'Environmental Consulting Services')
@section('meta_description', 'Phase I/II ESAs, wetland delineation, stormwater/SPCC, remediation oversight, NEPA/SEPA support, and vapor screening from Aldercrest Environmental.')
@section('content')
<section class="section">
    <div class="wrap">
        <h2>Services</h2>
        <p class="lede">Aldercrest supports due diligence, wetlands, stormwater, remediation, and indoor surveys with Portland-area field teams.</p>
        <div class="grid-3">
            @foreach([
                ['phase-i-esa','Phase I ESA','https://images.unsplash.com/photo-1425913397330-cfb49202dff3?auto=format&fit=crop&w=1200&q=80'],
                ['phase-ii-investigation','Phase II Soil & Groundwater','https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&w=1200&q=80'],
                ['stormwater-compliance','Stormwater & SPCC','https://images.unsplash.com/photo-1505142468610-359e7d316be0?auto=format&fit=crop&w=1200&q=80'],
                ['remediation-oversight','Remediation Oversight','https://images.unsplash.com/photo-1581094794329-cd11d7054d3d?auto=format&fit=crop&w=1200&q=80'],
                ['nepa-sepa-support','NEPA / SEPA Support','https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1200&q=80'],
                ['vapor-indoor-screening','Vapor & Indoor Air Screening','https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1200&q=80'],
                ['wetland-delineation','Wetland Delineation','https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=1200&q=80'],
            ] as [$slug,$title,$img])
                <a class="service-tile" href="{{ route('services.show', $slug) }}"><img src="{{ $img }}" alt="{{ $title }}"><div class="pad"><h3>{{ $title }}</h3></div></a>
            @endforeach
        </div>
    </div>
</section>
@endsection