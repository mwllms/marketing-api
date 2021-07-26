<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function show(Request $request, $id)
    {
        $newsletter = Newsletter::where('campaign_id', $id)->firstOrFail();

        return response()->json([
            'data' => $newsletter
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $input = $request->only([
            'from_name',
            'from_email',
            'subject',
            'content',
            'html',
            'json',
            'planned',
            'send',
            'status',
        ]);

        $newsletter = Newsletter::where('campaign_id', $id)->firstOrFail();
        
        if (!$newsletter->update($input)) {
            return response()->json([
                'error' => 'Updaten van de nieuwsbrief is niet gelukt.'
            ], 400);
        }

        return response()->json([
            'data' => $newsletter
        ], 200);
    }
}
