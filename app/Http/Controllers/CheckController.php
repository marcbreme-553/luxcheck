<?php

namespace App\Http\Controllers;

use App\Models\Check;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CheckController extends Controller
{
    public function create(Item $item)
    {
        abort_unless($item->user_id === auth()->id(), 403);

        return view('checks.create', compact('item'));
    }

    public function store(Request $request, Item $item)
    {
        abort_unless($item->user_id === auth()->id(), 403);

        $check = new Check();

        $check->item_id = $item->id;
        $check->status = $request->status;
        $check->confidence = $request->confidence;
        $check->notes = $request->notes;

        $check->save();

        return redirect('/items/' . $item->id);
    }

    public function aiCheck(Item $item)
    {
        abort_unless($item->user_id === auth()->id(), 403);

        $item->load('media');

        if ($item->media->isEmpty()) {
            return back()->with('error', 'Please upload at least one image first.');
        }

        $content = [
            [
                'type' => 'input_text',
                'text' => "
                    You are analyzing a luxury item for a university demo app called LuxCheck.

                    Brand: {$item->brand}
                    Category: {$item->category}
                    Serial number: {$item->serial_number}

                    Review the uploaded images and provide a cautious visual assessment.

                    Return ONLY valid JSON in exactly this format:
                    {
                        \"status\": \"likely authentic|suspicious|more images needed\",
                        \"confidence\": 0,
                        \"notes\": \"short explanation\"
                    }

                    Do not claim certainty. This is only a visual AI assessment.
                ",
            ],
        ];

        foreach ($item->media as $media) {
            $fullPath = Storage::disk('public')->path($media->path);

            $mimeType = mime_content_type($fullPath);
            $base64 = base64_encode(file_get_contents($fullPath));

            $content[] = [
                'type' => 'input_image',
                'image_url' => "data:{$mimeType};base64,{$base64}",
            ];
        }

        $response = Http::withToken(env('OPENAI_API_KEY'))
            ->post('https://api.openai.com/v1/responses', [
                'model' => 'gpt-6-luna',
                'input' => [
                    [
                        'role' => 'user',
                        'content' => $content,
                    ],
                ],
            ]);

        if ($response->failed()) {
            return back()->with('error', 'AI check failed.');
        }

        $text = null;

        foreach ($response->json('output', []) as $output) {
            if (($output['type'] ?? null) === 'message') {
                foreach ($output['content'] ?? [] as $part) {
                    if (($part['type'] ?? null) === 'output_text') {
                        $text = $part['text'] ?? null;
                        break 2;
                    }
                }
            }
        }

        if (!$text) {
            return back()->with('error', 'AI returned no result.');
        }

        $text = preg_replace('/^```json\s*|\s*```$/', '', trim($text));

        $result = json_decode($text, true);

        if (!$result) {
            return back()->with('error', 'AI returned an invalid response.');
        }

        $check = new Check();

        $check->item_id = $item->id;
        $check->status = $result['status'] ?? 'more images needed';
        $check->confidence = $result['confidence'] ?? null;
        $check->notes = $result['notes'] ?? null;

        $check->save();

        return redirect('/items/' . $item->id);
    }
}
