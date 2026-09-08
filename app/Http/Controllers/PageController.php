<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Halaman utama (index).
     */
    public function home()
    {
        $featured = [
            [
                'name' => 'Hi-Court Canvas',
                'type' => 'High-Top',
                'grade' => 'DS 10/10',
                'price' => 9150000,
                'image' => 'items-Hi Court Canvas.png',
                'description' => 'Cream canvas high-top with navy leather trim and brass eyelets. Original box and hang tag included.',
            ],
            [
                'name' => 'Court Racer Leather',
                'type' => 'Low-Top',
                'grade' => 'VNDS 9/10',
                'price' => 7800000,
                'image' => 'items-Court Racer Leather.png',
                'description' => 'White and pine-green leather low-top with gold branding. Worn twice by the original owner.',
            ],
            [
                'name' => 'Atelier Leather High',
                'type' => 'Premium',
                'grade' => 'DS 10/10',
                'price' => 12600000,
                'image' => 'items-Atelier Leather High.png',
                'description' => 'Full-grain cream leather high-top with burgundy heel tab. Deadstock, hand-conditioned on arrival.',
            ],
        ];

        return view('home', compact('featured'));
    }

    /**
     * Halaman Workshop.
     */
    public function workshop()
    {
        $steps = [
            [
                'num' => '01',
                'eyebrow' => 'Intake',
                'title' => 'Photograph & Log',
                'body' => "Every pair is unboxed on camera. We shoot uppers, soles, box, tags, and any paperwork before anything is touched or cleaned, so there's a record of exactly how it arrived.",
                'detail_title' => 'What we capture',
                'detail_items' => [
                    'Full 360° photo set, uncleaned',
                    'Box, hang tag, and lace condition',
                    'Seller history and chain of custody notes',
                ],
            ],
            [
                'num' => '02',
                'eyebrow' => 'Cross-Check',
                'title' => 'Box & Tag Codes',
                'body' => 'Style numbers, factory codes, and date stamps get checked against our internal archive of confirmed-original releases and known reproduction markers.',
                'detail_title' => 'Reference archive',
                'detail_items' => [
                    '4,300+ previously authenticated pairs',
                    'Factory and country-of-origin code library',
                    'Known counterfeit and reissue flags',
                ],
            ],
            [
                'num' => '03',
                'eyebrow' => 'Material Analysis',
                'title' => 'Stitching & Compound Aging',
                'body' => "We examine stitch density, glue lines, and how the midsole compound has yellowed or cracked. Genuine age leaves a signature that's very hard to fake — we know what to look for.",
                'detail_title' => 'Under the loupe',
                'detail_items' => [
                    'Stitch-per-inch count against period spec',
                    'Foam density and oxidation pattern',
                    'Adhesive and outsole compound texture',
                ],
            ],
            [
                'num' => '04',
                'eyebrow' => 'Restoration (If Needed)',
                'title' => 'Period-Correct Repair Only',
                'body' => 'If a pair needs work — foxing tape, laces, cracked foam — we repair with period-correct materials sourced for that release. We never repaint, never resew from parts, never reproduce a missing piece.',
                'detail_title' => 'Logged every time',
                'detail_items' => [
                    'Every intervention dated and photographed',
                    'Materials used recorded on the provenance file',
                    'Original components never discarded',
                ],
            ],
            [
                'num' => '05',
                'eyebrow' => 'Sign-Off',
                'title' => 'Provenance File & Grading',
                'body' => 'A senior authenticator reviews the full file, assigns a condition grade, and signs off. That file — not just the shoe — is what ships with the pair.',
                'detail_title' => 'What ships with the pair',
                'detail_items' => [
                    'Full photo history, pre and post restoration',
                    "Condition grade and authenticator's notes",
                    'Lifetime authenticity guarantee',
                ],
            ],
        ];

        $restorations = [
            [
                'name' => 'Hi-Court Canvas',
                'tag' => 'Foxing tape · relaced',
                'image' => 'before-after-Hi Court Canvas.png',
                'before' => 'Foxing tape aged & peeling, laces frayed',
                'after' => 'Foxing tape stabilized & repaired, relaced with period-correct cotton',
            ],
            [
                'name' => 'Court Racer Leather',
                'tag' => 'Conditioned · deep clean',
                'image' => 'before-after-Court Racer Leather.png',
                'before' => 'Leather dull, scuffed, deep grime',
                'after' => 'Deep clean & conditioning performed, leather supple',
            ],
            [
                'name' => 'Atelier Leather High',
                'tag' => 'Foam stabilized',
                'image' => 'before-after-Atelier Leather High.png',
                'before' => 'Foam collar & midsole cracked & crumbling',
                'after' => 'Foam stabilized & restored, structure reinforced',
            ],
        ];

        return view('workshop', compact('steps', 'restorations'));
    }

    /**
     * Halaman Shop / Katalog.
     */
    public function shop()
    {
        $products = \App\Models\Product::all()->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'type' => $product->type,
                'type_label' => $product->type_label,
                'grade' => $product->grade,
                'grade_label' => $product->grade_label,
                'rating' => $product->rating,
                'price' => $product->price,
                'stock' => $product->stock,
                'image' => $product->image,
                'description' => $product->description,
                'sizes' => $product->sizes ? json_decode($product->sizes, true) : ['39', '40', '41', '42', '43'],
            ];
        })->toArray();

        return view('shop', compact('products'));
    }

    public function warrantyCard(Request $request)
    {
        $purchaseDate = $request->date('purchase_date') ?? now();
        $warrantyMonths = 12;
        $serial = strtoupper(substr(hash('sha256', implode('|', [
            $request->input('purchase_id', 'draft'),
            $request->input('name', 'pair'),
            $request->input('size', '-'),
        ])), 0, 10));

        return view('warranty-card', [
            'customerName' => $request->string('customer')->trim()->value() ?: 'Customer name',
            'customerEmail' => $request->string('email')->trim()->value() ?: 'Customer email',
            'productName' => $request->string('name')->trim()->value() ?: 'Sneaker name',
            'size' => $request->string('size')->trim()->value() ?: '-',
            'purchaseDate' => $purchaseDate,
            'expiresAt' => $purchaseDate->copy()->addMonths($warrantyMonths),
            'warrantyMonths' => $warrantyMonths,
            'serial' => $serial,
        ]);
    }

    /**
     * Halaman Events / Meetups.
     */
    public function events()
    {
        $events = [
            [
                'day' => '14', 'month' => 'Aug 2026',
                'title' => 'Vault Open Bench Night',
                'description' => "Watch a live authentication and restoration session, ask the bench team anything, and get first look at three pairs going into next week's drop.",
                'time' => '6:00 PM – 9:00 PM', 'location' => 'The Vault, Jl. Braga No. 12', 'note' => 'Free · RSVP required',
            ],
            [
                'day' => '30', 'month' => 'Aug 2026',
                'title' => 'Bandung Trade Circle',
                'description' => "Bring pairs you're looking to trade or sell peer-to-peer. Vault authenticators are on hand for free spot-checks so every trade happens with confidence.",
                'time' => '1:00 PM – 5:00 PM', 'location' => 'The Vault, Jl. Braga No. 12', 'note' => 'Free · Walk-ins welcome',
            ],
            [
                'day' => '19', 'month' => 'Sep 2026',
                'title' => 'Archive Talk: Collecting Before The Internet',
                'description' => "A conversation with three longtime collectors on how sourcing, grading, and trading worked before online marketplaces existed — and what's been lost since.",
                'time' => '7:00 PM – 8:30 PM', 'location' => 'The Vault, Jl. Braga No. 12', 'note' => 'Free · RSVP required',
            ],
        ];

        $tradeBoard = [
            ['status' => 'Wanted', 'want' => 'Hi-Court Canvas, size 42–43', 'handle' => '@dwi_r'],
            ['status' => 'Wanted', 'want' => 'Any Atelier Leather, DS only', 'handle' => '@sneakerarchive_bdg'],
            ['status' => 'Trading', 'want' => 'Court Racer Leather → Trail Suede', 'handle' => '@fajarw'],
            ['status' => 'Wanted', 'want' => 'Foundry Canvas High, size 41', 'handle' => '@nadia.k'],
        ];

        $recap = [
            ['image' => 'meetup-Sneaker Talk.png', 'alt' => 'Collectors examining a sneaker at a past Vault meetup', 'caption' => 'Sneaker Talk'],
            ['image' => 'meetup-Creative Sync.png', 'alt' => 'Trade table at a past Vault meetup', 'caption' => 'Creative Sync'],
            ['image' => 'meetup-Craftsmanship Workshop.png', 'alt' => 'Authenticator demonstrating a bench check at a past meetup', 'caption' => 'Craftsmanship Workshop'],
            ['image' => 'meetup-Archive Vault.png', 'alt' => 'Group of collectors gathered at The Vault', 'caption' => 'The Archive Vault'],
        ];

        return view('events', compact('events', 'tradeBoard', 'recap'));
    }
}
