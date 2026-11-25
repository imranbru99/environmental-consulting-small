@extends('layouts.app')
@section('title', 'Aldercrest Environmental')
@section('meta_description', 'Portland-area Phase I/II ESAs, wetland delineation, stormwater/SWPPP, remediation oversight, and NEPA/SEPA support by Aldercrest Environmental.')
@section('content')
<section class="hero">
    <div class="wrap hero-inner">
        <h1>Aldercrest<br>Environmental</h1>
        <p>Due-diligence ESAs, wetland flags, SWPPP updates, and remediation oversight — so lenders, developers, and agencies keep Willamette Valley projects on calendar with audit-ready documentation.</p>
        <div class="hero-ctas">
            <a class="btn btn-primary" href="{{ route('contact') }}">Request a proposal</a>
            <a class="btn btn-ghost" href="{{ route('services') }}">View consulting services</a>
        </div>
    </div>
</section>
<section class="section">
    <div class="wrap">
        <h2>Consulting services</h2>
        <p class="lede">From due-diligence site walks to wetland delineations and industrial stormwater inspections — scopes sized for Portland metro and Willamette Valley clients.</p>
        <div class="grid-3">
            @foreach([
                ['phase-i-esa','Phase I ESA','ASTM-aligned ESAs for acquisitions, refinances, and portfolio reviews.','https://images.unsplash.com/photo-1425913397330-cfb49202dff3?auto=format&fit=crop&w=1200&q=80'],
                ['phase-ii-investigation','Phase II Investigation','Targeted soil and groundwater sampling with clear next-step packages.','https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&w=1200&q=80'],
                ['wetland-delineation','Wetland Delineation','Field flags, data sheets, and maps that support DSL/Corps conversations.','https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=1200&q=80'],
            ] as [$slug,$title,$blurb,$img])
                <a class="service-tile" href="{{ route('services.show', $slug) }}">
                    <img src="{{ $img }}" alt="{{ $title }}">
                    <div class="pad"><h3>{{ $title }}</h3><p>{{ $blurb }}</p></div>
                </a>
            @endforeach
        </div>
    </div>
</section>
<section class="section" style="padding-top:0">
    <div class="wrap">
        <h2>Why project teams choose Aldercrest</h2>
        <p class="lede">Field scientists and compliance leads who treat scoping, documentation, and client communication as one deliverable.</p>
        <div class="grid-3">
            <div class="panel"><h3>Lender-ready due diligence</h3><p>Phase I and Phase II packages highlight RECs, data gaps, and practical recommendations so closings stay on calendar.</p></div>
            <div class="panel"><h3>Wetland & stormwater clarity</h3><p>Delineations, SWPPP updates, and SPCC support keep civil teams aligned with Oregon and federal expectations.</p></div>
            <div class="panel"><h3>ERP-run consulting ops</h3><p>Projects, sampling kits, invoices, and site appointments live in one stack.</p></div>
        </div>
    </div>
</section>
<section class="section" style="padding-top:0">
    <div class="wrap">
        <h2>Ops dashboard preview</h2>
        <p class="lede">A glimpse of the Aldercrest ERP used to track field projects, kit inventory, and client billing.</p>
        <div class="dash-preview">
            <div>
                <div class="grid-3" style="grid-template-columns:repeat(3,1fr)">
                    <div class="metric"><strong>24</strong> Active projects</div>
                    <div class="metric"><strong>$312k</strong> Pipeline</div>
                    <div class="metric"><strong>94%</strong> On-time reports</div>
                </div>
                <div class="bars"><span style="height:45%"></span><span style="height:70%"></span><span style="height:55%"></span><span style="height:85%"></span><span style="height:60%"></span><span style="height:92%"></span><span style="height:68%"></span></div>
            </div>
            <div>
                <h3 style="font-family:var(--font-display);margin-top:0;font-size:1.4rem">Live modules</h3>
                <ul style="line-height:1.9;padding-left:1.1rem;color:rgba(255,255,255,.86)">
                    <li>Field projects & site scheduling</li><li>Sampling kit inventory</li><li>Invoices & retainers</li><li>AI content + troubleshooting</li>
                </ul>
                <a class="btn btn-primary" style="margin-top:1rem" href="/admin">Open admin ERP</a>
            </div>
        </div>
    </div>
</section>
<section class="section" style="padding-top:0">
    <div class="wrap">
        <h2>Field notes</h2>
        <p class="lede">Practical guidance for lenders, developers, and facility managers navigating Oregon environmental due diligence.</p>
        <div class="grid-3">
            @forelse($posts as $post)
                <a class="panel" href="{{ route('blog.show', $post->slug) }}"><h3>{{ $post->title }}</h3><p>{{ $post->excerpt }}</p></a>
            @empty
                <div class="panel"><p>Blog posts will appear after seeding.</p></div>
            @endforelse
        </div>
    </div>
</section>
@endsection