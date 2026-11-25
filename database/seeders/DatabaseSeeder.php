<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\KnowledgeArticle;
use App\Models\Payment;
use App\Models\Post;
use App\Models\Product;
use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['admin', 'manager', 'staff'] as $role) {
            Role::findOrCreate($role);
        }

        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '(503) 555-0188',
            ]
        );
        $admin->syncRoles(['admin']);

        User::query()->updateOrCreate(
            ['email' => 'manager@aldercrestenvironmental.com'],
            [
                'name' => 'Aisha Rahman',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'phone' => '(503) 555-0188',
            ]
        )->syncRoles(['manager']);

        User::query()->updateOrCreate(
            ['email' => 'field@aldercrestenvironmental.com'],
            [
                'name' => 'Cole Whitaker',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'phone' => '(503) 555-0188',
            ]
        )->syncRoles(['staff']);

        $settings = [
            'company_name' => 'Aldercrest Environmental',
            'company_phone' => '(503) 555-0188',
            'company_email' => 'hello@aldercrestenvironmental.com',
            'whatsapp' => '15035550188',
            'service_area' => 'Portland, Beaverton, Hillsboro, Vancouver WA & Willamette Valley',
            'tax_rate' => '0.00',
        ];
        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }

        $products = array (
  0 => 
  array (
    'name' => 'Phase I ESA Package',
    'sku' => 'ENV-P1-STD',
    'category' => 'assessment',
    'unit_cost' => 1200,
    'unit_price' => 2800,
    'stock_qty' => 999,
    'unit' => 'project',
  ),
  1 => 
  array (
    'name' => 'Phase II Boring Day',
    'sku' => 'ENV-P2-DAY',
    'category' => 'investigation',
    'unit_cost' => 1800,
    'unit_price' => 4200,
    'stock_qty' => 999,
    'unit' => 'day',
  ),
  2 => 
  array (
    'name' => 'SWPPP Authoring',
    'sku' => 'ENV-SWP-1',
    'category' => 'stormwater',
    'unit_cost' => 450,
    'unit_price' => 1250,
    'stock_qty' => 999,
    'unit' => 'plan',
  ),
  3 => 
  array (
    'name' => 'Turbidity Monitoring Kit',
    'sku' => 'ENV-TURB-K',
    'category' => 'equipment',
    'unit_cost' => 85,
    'unit_price' => 175,
    'stock_qty' => 24,
    'unit' => 'kit',
  ),
  4 => 
  array (
    'name' => 'Wetland Delineation Acre',
    'sku' => 'ENV-WET-AC',
    'category' => 'wetlands',
    'unit_cost' => 320,
    'unit_price' => 780,
    'stock_qty' => 999,
    'unit' => 'acre',
  ),
  5 => 
  array (
    'name' => 'Compliance Audit Day',
    'sku' => 'ENV-AUD-DY',
    'category' => 'audit',
    'unit_cost' => 900,
    'unit_price' => 2100,
    'stock_qty' => 999,
    'unit' => 'day',
  ),
  6 => 
  array (
    'name' => 'VOC Screening Canister',
    'sku' => 'ENV-VOC-1',
    'category' => 'air',
    'unit_cost' => 55,
    'unit_price' => 140,
    'stock_qty' => 40,
    'unit' => 'each',
  ),
  7 => 
  array (
    'name' => 'Rush Lab Courier',
    'sku' => 'ENV-LAB-R',
    'category' => 'logistics',
    'unit_cost' => 40,
    'unit_price' => 95,
    'stock_qty' => 60,
    'unit' => 'trip',
  ),
);
        foreach ($products as $product) {
            Product::query()->updateOrCreate(['sku' => $product['sku']], $product + ['is_active' => true]);
        }

        $customers = collect(array (
  0 => 
  array (
    'name' => 'Lena Ortiz',
    'email' => 'lena@cascadebuild.com',
    'phone' => '(503) 555-2201',
    'company' => 'Cascade Build Partners',
    'city' => 'Portland',
    'state' => 'OR',
    'zip' => '97209',
    'address' => '1120 NW Couch St',
  ),
  1 => 
  array (
    'name' => 'Marcus Hale',
    'email' => 'mhale@beaverton.dev',
    'phone' => '(503) 555-2210',
    'company' => 'Beaverton Development LLC',
    'city' => 'Beaverton',
    'state' => 'OR',
    'zip' => '97005',
    'address' => '4755 SW Griffith Dr',
  ),
  2 => 
  array (
    'name' => 'Nina Cho',
    'email' => 'nina@willamettefoods.com',
    'phone' => '(503) 555-2299',
    'company' => 'Willamette Foods Co.',
    'city' => 'Hillsboro',
    'state' => 'OR',
    'zip' => '97124',
    'address' => '2200 NE Cornell Rd',
  ),
  3 => 
  array (
    'name' => 'Greg Pulaski',
    'email' => 'greg.pulaski@example.com',
    'phone' => '(360) 555-2188',
    'company' => NULL,
    'city' => 'Vancouver',
    'state' => 'WA',
    'zip' => '98660',
    'address' => '401 W 8th St',
  ),
  4 => 
  array (
    'name' => 'Priya Sethi',
    'email' => 'priya@rivergatemuni.gov',
    'phone' => '(503) 555-2177',
    'company' => 'City of Rivergate Public Works',
    'city' => 'Portland',
    'state' => 'OR',
    'zip' => '97203',
    'address' => '5001 N Columbia Blvd',
  ),
))->map(fn ($c) => Customer::query()->updateOrCreate(['email' => $c['email']], $c));

        $projects = array (
  0 => 
  array (
    'customer' => 0,
    'title' => 'Warehouse acquisition Phase I ESA',
    'service_type' => 'phase_i',
    'status' => 'scheduled',
    'sq_ft' => 85000,
    'quoted_amount' => 3200,
  ),
  1 => 
  array (
    'customer' => 1,
    'title' => 'Mixed-use Phase II soil boring',
    'service_type' => 'phase_ii',
    'status' => 'in_progress',
    'sq_ft' => 42000,
    'quoted_amount' => 9800,
  ),
  2 => 
  array (
    'customer' => 2,
    'title' => 'Food plant stormwater SWPPP refresh',
    'service_type' => 'swppp',
    'status' => 'quoted',
    'sq_ft' => 120000,
    'quoted_amount' => 4100,
  ),
  3 => 
  array (
    'customer' => 3,
    'title' => 'Residential wetland delineation',
    'service_type' => 'wetland',
    'status' => 'completed',
    'sq_ft' => 3,
    'quoted_amount' => 2400,
    'final_amount' => 2350,
  ),
  4 => 
  array (
    'customer' => 4,
    'title' => 'Public works compliance audit',
    'service_type' => 'audit',
    'status' => 'invoiced',
    'sq_ft' => 0,
    'quoted_amount' => 6500,
    'final_amount' => 6720,
  ),
);

        $projectModels = [];
        foreach ($projects as $i => $p) {
            $customer = $customers[$p['customer']];
            $projectModels[] = Project::query()->updateOrCreate(
                ['job_number' => 'JOB-26'.str_pad((string) ($i + 1), 3, '0', STR_PAD_LEFT)],
                [
                    'customer_id' => $customer->id,
                    'title' => $p['title'],
                    'service_type' => $p['service_type'],
                    'status' => $p['status'],
                    'sq_ft' => $p['sq_ft'],
                    'quoted_amount' => $p['quoted_amount'],
                    'final_amount' => $p['final_amount'] ?? null,
                    'start_date' => now()->subDays(10 - $i)->toDateString(),
                    'site_address' => trim(($customer->address ?? '').', '.$customer->city.', '.$customer->state),
                    'notes' => 'Seeded demo environmental consulting engagement for Aldercrest ERP. sq_ft stores site area where relevant.',
                ]
            );
        }

        foreach ([0, 1, 3, 4] as $idx) {
            $project = $projectModels[$idx];
            $invoice = Invoice::query()->updateOrCreate(
                ['invoice_number' => 'INV-26'.str_pad((string) ($idx + 1), 3, '0', STR_PAD_LEFT)],
                [
                    'customer_id' => $project->customer_id,
                    'project_id' => $project->id,
                    'issue_date' => now()->subDays(8 - $idx)->toDateString(),
                    'due_date' => now()->addDays(14)->toDateString(),
                    'subtotal' => $project->final_amount ?? $project->quoted_amount,
                    'tax' => round(($project->final_amount ?? $project->quoted_amount) * 0, 2),
                    'total' => round(($project->final_amount ?? $project->quoted_amount) * (1 + 0), 2),
                    'amount_paid' => in_array($project->status, ['completed', 'invoiced'], true) ? round(($project->final_amount ?? $project->quoted_amount) * (1 + 0), 2) : 0,
                    'status' => in_array($project->status, ['completed', 'invoiced'], true) ? 'paid' : 'sent',
                ]
            );

            if ($invoice->status === 'paid') {
                Payment::query()->updateOrCreate(
                    ['reference' => 'PMT-'.$invoice->invoice_number],
                    [
                        'invoice_id' => $invoice->id,
                        'amount' => $invoice->total,
                        'paid_at' => now()->subDays(3)->toDateString(),
                        'method' => 'ach',
                        'notes' => 'Demo payment',
                    ]
                );
            }
        }

        Appointment::query()->updateOrCreate(
            ['title' => 'Phase I walk — Cascade warehouse'],
            [
                'customer_id' => $customers[0]->id,
                'project_id' => $projectModels[0]->id,
                'type' => 'site_walk',
                'starts_at' => now()->addDays(2)->setTime(9, 0),
                'ends_at' => now()->addDays(2)->setTime(12, 0),
                'status' => 'scheduled',
                'location' => $customers[0]->address,
            ]
        );
        Appointment::query()->updateOrCreate(
            ['title' => 'SWPPP inspection — Willamette Foods'],
            [
                'customer_id' => $customers[2]->id,
                'project_id' => $projectModels[2]->id,
                'type' => 'monitoring',
                'starts_at' => now()->addDays(5)->setTime(7, 0),
                'ends_at' => now()->addDays(5)->setTime(10, 0),
                'status' => 'confirmed',
                'location' => $customers[2]->address,
            ]
        );

        $posts = array (
  0 => 
  array (
    'title' => 'When a Portland Property Needs a Phase I ESA',
    'excerpt' => 'Lender requirements, REC red flags, and how a scoped Phase I protects Willamette Valley deals.',
    'cover' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1400&q=80',
    'body' => 'Most commercial closings in Portland still hinge on a clean Phase I. Aldercrest maps historical uses, walks the site, and writes an opinion lenders can underwrite.

If RECs appear, we size Phase II so you are not oversampling empty dirt — or undersampling the one tank pit that matters.',
  ),
  1 => 
  array (
    'title' => 'Wet Season SWPPP Tips for Oregon Jobsites',
    'excerpt' => 'Turbidity, inlet protection, and inspection cadence when the PNW rain will not quit.',
    'cover' => 'https://images.unsplash.com/photo-1433086966358-54859d0ed716?auto=format&fit=crop&w=1400&q=80',
    'body' => 'October through April tests every SWPPP. We coach crews on BMP sequencing, document visual monitoring, and keep inspection logs audit-ready before DEQ or Ecology shows up.',
  ),
  2 => 
  array (
    'title' => 'Reading a Wetland Delineation Before You Grade',
    'excerpt' => 'Hydrophytic vegetation, hydric soils, and ordinary high water — what planners should verify first.',
    'cover' => 'https://images.unsplash.com/photo-1501854140801-50d01698950b?auto=format&fit=crop&w=1400&q=80',
    'body' => 'Buildable envelopes shrink fast when seasonal wetlands sit under blackberry. Get delineation early so civil plans, buffer strategies, and permitting timelines stay honest.',
  ),
);
        foreach ($posts as $post) {
            Post::query()->updateOrCreate(
                ['slug' => Str::slug($post['title'])],
                [
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'body' => $post['body'],
                    'cover_image' => $post['cover'],
                    'is_published' => true,
                    'published_at' => now()->subDays(random_int(2, 20)),
                ]
            );
        }

        $articles = array (
  0 => 
  array (
    'category' => 'issues',
    'title' => 'Phase I delayed — incomplete historical records',
    'body' => '1. Expand Sanborn/fire insurance and city directory search radius.
2. Interview long-tenure neighbors and prior owners.
3. Document data gaps explicitly in the report.
4. Recommend Phase II only where RECs remain unresolved.',
  ),
  1 => 
  array (
    'category' => 'issues',
    'title' => 'Stormwater BMP failing after heavy rain',
    'body' => 'Stabilize slopes, replace clogged inlet protection, re-seed bare soil, and update the SWPPP inspection log the same day. Call Aldercrest if turbidity exceeds permit thresholds.',
  ),
  2 => 
  array (
    'category' => 'guides',
    'title' => 'How to prepare for a Phase I site walk',
    'body' => 'Unlock mechanical rooms and yard access. Gather prior Phase I/II reports, ASTs/USTs paperwork, and spill logs. Walk Aldercrest through known fill areas and tenant operations.',
  ),
  3 => 
  array (
    'category' => 'guides',
    'title' => 'Environmental consulting timeline from proposal to report',
    'body' => 'Day 0: Proposal.
Days 1–5: Records review.
Day 6: Site reconnaissance.
Closeout: Draft Phase I, client comments, final opinion letter.',
  ),
  4 => 
  array (
    'category' => 'admin',
    'title' => 'Admin ERP quick start',
    'body' => 'Login at /admin with admin@example.com / password.
1. Add clients in CRM.
2. Create projects with service type and quote.
3. Schedule site walks and monitoring.
4. Invoice completed work and record payments.
5. Use AI Studio for blog drafts.
6. Update Settings for phone, WhatsApp, and tax.',
  ),
  5 => 
  array (
    'category' => 'admin',
    'title' => 'Roles: Admin, Manager, Staff',
    'body' => 'Admin: full ERP + settings + users.
Manager: projects, inventory, invoices, scheduling.
Staff: field records and appointment updates.',
  ),
  6 => 
  array (
    'category' => 'troubleshoot',
    'title' => 'Lab hold on Phase II samples',
    'body' => 'Confirm chain-of-custody signatures, cooler temperature, and hold times. Re-collect only the affected media. Document the hold in project notes before releasing results.',
  ),
  7 => 
  array (
    'category' => 'troubleshoot',
    'title' => 'Chatbot giving demo answers only',
    'body' => 'Demo mode is expected without API keys. Add OPENAI_API_KEY or GEMINI_API_KEY to .env, then clear config cache.',
  ),
);
        foreach ($articles as $article) {
            KnowledgeArticle::query()->updateOrCreate(
                ['slug' => Str::slug($article['title'])],
                [
                    'title' => $article['title'],
                    'category' => $article['category'],
                    'body' => $article['body'],
                    'is_published' => true,
                ]
            );
        }
    }
}