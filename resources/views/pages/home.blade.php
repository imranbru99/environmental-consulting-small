@extends('layouts.app')

@section('title', 'VerdantRidge Environmental Advisors')
@section('meta_description', 'VerdantRidge Environmental Advisors — Phase I/II ESAs, stormwater, wetlands & compliance for Pacific Northwest SMEs')

@section('content')
<section class="hero">
    <div class="wrap hero-inner">
        <h1>VerdantRidge<br>Environmental</h1>
        <p>Practical Phase I/II ESAs, stormwater programs, wetland delineations, and compliance audits — so Pacific Northwest projects clear diligence without surprise liabilities.</p>
        <div class="hero-ctas">
            <a class="btn btn-primary" href="{{ route('contact') }}">Request a proposal</a>
            <a class="btn btn-ghost" href="{{ route('services') }}">View consulting services</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="wrap">
        <h2>Services</h2>
        <p class="lede">From ASTM Phase I ESAs to wet-season SWPPP monitoring — advisory packages sized for developers, manufacturers, and municipal clients.</p>
        <div class="grid-3">
            @foreach([
                ['phase-i-esa','Phase I Environmental Site Assessment','ASTM-aligned records review, site reconnaissance, and recognized environmental condition screening.','https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1600&q=80'],
                ['stormwater-swppp','Stormwater SWPPP & Monitoring','Construction and industrial SWPPP authorship plus field monitoring for NPDES compliance.','https://images.unsplash.com/photo-1433086966358-54859d0ed716?auto=format&fit=crop&w=1600&q=80'],
                ['wetland-delineation','Wetland Delineation','Field delineations and ordinary high water mark work for permitting and site planning.','https://images.unsplash.com/photo-1501854140801-50d01698950b?auto=format&fit=crop&w=1600&q=80'],
            ] as [$slug,$title,$blurb,$img])
                <a class="service-tile" href="{{ route('services.show', $slug) }}">
                    <img src="{{ $img }}" alt="{{ $title }}">
                    <div class="pad">
                        <h3>{{ $title }}</h3>
                        <p>{{ $blurb }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="section" style="padding-top:0">
    <div class="wrap">
        <h2>Why VerdantRidge</h2>
        <p class="lede">Field scientists and compliance leads who treat diligence, sampling strategy, and report clarity as one deliverable.</p>
        <div class="grid-3">
            <div class="panel">
                <h3>Survey-grade diligence</h3>
                <p>We map data gaps and REC pathways before recommending a single Phase II boring — so clients are not oversold lab work.</p>
            </div>
            <div class="panel">
                <h3>PNW field fluency</h3>
                <p>Wetlands, wet-season stormwater, and industrial yards across Portland metro are our everyday terrain — not a side practice.</p>
            </div>
            <div class="panel">
                <h3>ERP-run project ops</h3>
                <p>Proposals, field kits, invoices, and monitoring appointments live in one stack so project managers get clean timelines.</p>
            </div>
        </div>
    </div>
</section>

<section class="section" style="padding-top:0">
    <div class="wrap">
        <h2>Ops dashboard preview</h2>
        <p class="lede">A glimpse of the VerdantRidge ERP used to schedule site walks, track monitoring kits, and close project invoices.</p>
        <div class="dash-preview">
            <div>
                <div class="grid-3" style="grid-template-columns:repeat(3,1fr)">
                    <div class="metric"><strong>22</strong> Active projects</div>
                    <div class="metric"><strong>$142k</strong> Pipeline</div>
                    <div class="metric"><strong>94%</strong> On-time reports</div>
                </div>
                <div class="bars">
                    <span style="height:45%"></span><span style="height:70%"></span><span style="height:55%"></span>
                    <span style="height:85%"></span><span style="height:60%"></span><span style="height:92%"></span>
                    <span style="height:68%"></span>
                </div>
            </div>
            <div>
                <h3 style="font-family:var(--font-display);margin-top:0;font-size:1.4rem">Live modules</h3>
                <ul style="line-height:1.9;padding-left:1.1rem;color:rgba(255,255,255,.86)">
                    <li>ESA projects & scheduling</li>
                    <li>Field kit inventory</li>
                    <li>Invoices & retainers</li>
                    <li>AI content + troubleshooting</li>
                </ul>
                <a class="btn btn-primary" style="margin-top:1rem" href="/admin">Open admin ERP</a>
            </div>
        </div>
    </div>
</section>

<section class="section" style="padding-top:0">
    <div class="wrap">
        <h2>Field notes from the Willamette</h2>
        <p class="lede">Practical notes for developers, lenders, and facility managers facing environmental diligence.</p>
        <div class="grid-3">
            @forelse($posts as $post)
                <a class="panel" href="{{ route('blog.show', $post->slug) }}">
                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->excerpt }}</p>
                </a>
            @empty
                <div class="panel"><p>Blog posts will appear after seeding.</p></div>
            @endforelse
        </div>
    </div>
</section>
@endsection