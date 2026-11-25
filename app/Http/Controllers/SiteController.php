<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\KnowledgeArticle;
use App\Models\Post;
use App\Services\AiService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        $posts = Post::query()->where('is_published', true)->latest('published_at')->take(3)->get();

        return view('pages.home', compact('posts'));
    }

    public function services(): View
    {
        return view('pages.services');
    }

    public function serviceShow(string $slug): View
    {
        $services = $this->serviceCatalog();
        abort_unless(isset($services[$slug]), 404);

        return view('services.show', [
            'slug' => $slug,
            'service' => $services[$slug],
            'services' => $services,
        ]);
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function contactStore(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'phone' => ['nullable', 'string', 'max:40'],
            'subject' => ['nullable', 'string', 'max:180'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        ContactMessage::query()->create($data);

        return back()->with('success', 'Thanks! VerdantRidge will follow up within one business day.');
    }

    public function blog(): View
    {
        $posts = Post::query()->where('is_published', true)->latest('published_at')->paginate(9);

        return view('blog.index', compact('posts'));
    }

    public function blogShow(string $slug): View
    {
        $post = Post::query()->where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('blog.show', compact('post'));
    }

    public function knowledge(): View
    {
        $articles = KnowledgeArticle::query()->where('is_published', true)->orderBy('category')->orderBy('title')->get()->groupBy('category');

        return view('kb.index', compact('articles'));
    }

    public function knowledgeShow(string $slug): View
    {
        $article = KnowledgeArticle::query()->where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('kb.show', compact('article'));
    }

    public function chat(Request $request, AiService $ai)
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
            'session_id' => ['nullable', 'string', 'max:80'],
        ]);

        $result = $ai->chat($data['message'], $data['session_id'] ?? null);

        return response()->json($result);
    }

    /** @return array<string, array<string, string>> */
    protected function serviceCatalog(): array
    {
        return array (
  'phase-i-esa' => 
  array (
    'title' => 'Phase I Environmental Site Assessment',
    'summary' => 'ASTM-aligned records review, site reconnaissance, and recognized environmental condition screening.',
    'body' => 'VerdantRidge delivers Phase I ESAs for Portland lenders, buyers, and developers — historical records, regulatory databases, interviews, and a clear REC opinion so transactions move without surprise liabilities.',
    'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1600&q=80',
  ),
  'phase-ii-investigation' => 
  array (
    'title' => 'Phase II Site Investigation',
    'summary' => 'Targeted soil and groundwater sampling when Phase I flags recognized environmental conditions.',
    'body' => 'When a Phase I identifies RECs, we design a scoped Phase II with boring plans, analytical suites, and data quality objectives sized for Willamette Valley sites — not cookie-cutter lab packages.',
    'image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=1600&q=80',
  ),
  'stormwater-swppp' => 
  array (
    'title' => 'Stormwater SWPPP & Monitoring',
    'summary' => 'Construction and industrial SWPPP authorship plus field monitoring for NPDES compliance.',
    'body' => 'We author SWPPPs, train site crews, and run turbidity/visual monitoring so Oregon and Washington construction sites stay inspection-ready through wet-season rains.',
    'image' => 'https://images.unsplash.com/photo-1433086966358-54859d0ed716?auto=format&fit=crop&w=1600&q=80',
  ),
  'wetland-delineation' => 
  array (
    'title' => 'Wetland Delineation',
    'summary' => 'Field delineations and ordinary high water mark work for permitting and site planning.',
    'body' => 'PNW sites often hide seasonal wetlands. Our biologists map hydrophytic vegetation, soils, and hydrology so planners know buildable envelopes before grading plans freeze.',
    'image' => 'https://images.unsplash.com/photo-1501854140801-50d01698950b?auto=format&fit=crop&w=1600&q=80',
  ),
  'air-quality-assessment' => 
  array (
    'title' => 'Air Quality Assessment',
    'summary' => 'Indoor and ambient screening for VOCs, particulates, and industrial emission concerns.',
    'body' => 'From warehouse odor complaints to small industrial stack questions, VerdantRidge designs practical sampling plans and translates lab data into actionable recommendations.',
    'image' => 'https://images.unsplash.com/photo-1611273426858-450d8e3c9fce?auto=format&fit=crop&w=1600&q=80',
  ),
  'compliance-audit' => 
  array (
    'title' => 'Environmental Compliance Audit',
    'summary' => 'Multi-media audits covering hazardous waste, SPCC, air permits, and stormwater programs.',
    'body' => 'We walk facilities with operators, score gaps against federal/state rules, and deliver a prioritized corrective-action roadmap your staff can execute without a 200-page binder nobody reads.',
    'image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1600&q=80',
  ),
);
    }
}