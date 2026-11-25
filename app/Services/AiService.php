<?php

namespace App\Services;

use App\Models\ChatLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AiService
{
    /** @var array<int, array{q: string, a: string}> */
    protected array $faq = array (
  0 => 
  array (
    'q' => 'phase i esa assessment recognized environmental condition rec lender',
    'a' => 'A Phase I ESA reviews records, interviews, and a site walk to identify recognized environmental conditions. VerdantRidge delivers ASTM-aligned opinions for Portland lenders and buyers — call (503) 555-0142 to schedule.',
  ),
  1 => 
  array (
    'q' => 'phase ii soil groundwater boring sample investigation',
    'a' => 'Phase II investigates RECs with targeted soil and groundwater sampling. We design boring plans and analytical suites sized for Willamette Valley sites, not generic lab packages.',
  ),
  2 => 
  array (
    'q' => 'stormwater swppp npdes turbidity monitoring construction',
    'a' => 'We author SWPPPs, train crews, and run turbidity/visual monitoring so Oregon and Washington jobsites stay NPDES-ready through wet season.',
  ),
  3 => 
  array (
    'q' => 'wetland delineation buffer hydric vegetation permit',
    'a' => 'Wetland delineations map vegetation, soils, and hydrology so planners know buildable envelopes and buffer needs before grading.',
  ),
  4 => 
  array (
    'q' => 'air quality voc particulate industrial screening',
    'a' => 'Air quality assessments cover indoor/ambient VOC and particulate screening with practical sampling plans and plain-language recommendations.',
  ),
  5 => 
  array (
    'q' => 'compliance audit hazardous waste spcc permit gap',
    'a' => 'Multi-media compliance audits score gaps across hazardous waste, SPCC, air, and stormwater — then prioritize corrective actions your staff can execute.',
  ),
  6 => 
  array (
    'q' => 'schedule quote portland beaverton hillsboro vancouver cost price',
    'a' => 'Call (503) 555-0142, use the contact form, or WhatsApp us. We serve Portland, Beaverton, Hillsboro, Vancouver WA, and the Willamette Valley. Pricing depends on acreage, media, and turnaround.',
  ),
  7 => 
  array (
    'q' => 'turnaround report how long phase timeline',
    'a' => 'Typical Phase I turnaround is about one to two weeks after the site walk, depending on records access. Phase II and lab work add analytical time — ask estimating when you book.',
  ),
);

    public function chat(string $message, ?string $sessionId = null): array
    {
        $reply = null;
        $source = 'demo';

        if ($key = config('services.openai.key')) {
            try {
                $reply = $this->callOpenAi($message, $key);
                $source = 'openai';
            } catch (\Throwable) {
                $reply = null;
            }
        }

        if (! $reply && ($gemini = config('services.gemini.key'))) {
            try {
                $reply = $this->callGemini($message, $gemini);
                $source = 'gemini';
            } catch (\Throwable) {
                $reply = null;
            }
        }

        if (! $reply) {
            $reply = $this->demoReply($message);
            $source = 'demo';
        }

        ChatLog::query()->create([
            'session_id' => $sessionId,
            'message' => $message,
            'reply' => $reply,
            'source' => $source,
        ]);

        return ['reply' => $reply, 'source' => $source];
    }

    public function generate(string $type, string $prompt): string
    {
        $message = match ($type) {
            'blog' => "Write a concise SEO blog post outline and intro for a environmental consulting business about: {$prompt}",
            'description' => "Write a compelling service description for environmental consulting: {$prompt}",
            'automation' => "Suggest 5 practical AI automations for a environmental consulting SME ERP related to: {$prompt}",
            'troubleshoot' => "Troubleshoot this environmental consulting operations issue with clear steps: {$prompt}",
            default => $prompt,
        };

        $result = $this->chat($message);

        return $result['reply'];
    }

    protected function demoReply(string $message): string
    {
        $hay = Str::lower($message);
        $best = null;
        $bestScore = 0;

        foreach ($this->faq as $item) {
            $score = 0;
            foreach (explode(' ', $item['q']) as $word) {
                if ($word !== '' && str_contains($hay, $word)) {
                    $score++;
                }
            }
            if ($score > $bestScore) {
                $bestScore = $score;
                $best = $item['a'];
            }
        }

        if ($best && $bestScore > 0) {
            return $best;
        }

        return 'Thanks for reaching VerdantRidge Environmental Advisors. We provide Phase I/II ESAs, stormwater SWPPP, wetland delineation, air quality assessments, and compliance audits across Portland and the Pacific Northwest. Ask about scope, timelines, or scheduling—or call (503) 555-0142.';
    }

    protected function callOpenAi(string $message, string $key): string
    {
        $response = Http::withToken($key)
            ->timeout(30)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => config('services.openai.model', 'gpt-4o-mini'),
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are the VerdantRidge Environmental Advisors assistant for a Portland, OR environmental consulting SME. Be concise and practical about Phase I/II ESAs, stormwater SWPPP, wetland delineation, air quality, compliance audits, and scheduling. Never invent illegal claims or regulatory guarantees.',
                    ],
                    ['role' => 'user', 'content' => $message],
                ],
                'temperature' => 0.4,
            ]);

        $response->throw();

        return (string) data_get($response->json(), 'choices.0.message.content', 'Unable to generate a response.');
    }

    protected function callGemini(string $message, string $key): string
    {
        $model = config('services.gemini.model', 'gemini-1.5-flash');
        $response = Http::timeout(30)
            ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$key}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => "VerdantRidge Environmental Advisors assistant (Portland / Pacific Northwest environmental consulting). Answer briefly:
{$message}"],
                        ],
                    ],
                ],
            ]);

        $response->throw();

        return (string) data_get($response->json(), 'candidates.0.content.parts.0.text', 'Unable to generate a response.');
    }
}