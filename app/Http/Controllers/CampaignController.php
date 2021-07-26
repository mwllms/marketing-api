<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->cannot('show campaigns')) {
            return response()->json([
                'error' => 'U bent niet gemachtigd om campagnes te bekijken.'
            ], 403);
        }

        $campaigns = Campaign::where('company_id', $user->company_id)->get();
        
        foreach ($campaigns as $campaign) {
            $c = explode(',', $campaign->channels);
            $channels = array();
            if (in_array('newsletter', $c)) {
                $newsletter = Newsletter::where('campaign_id', $campaign->id)->firstOrFail();
                $collection = collect([
                    'name' => 'newsletter', 
                    'status' => $newsletter->status
                ]);
                array_push($channels, $collection);
            }
            $campaign->channels = $channels;
        }

        if ($campaigns->isEmpty()) {
            return response()->json([
                'error' => 'Geen campagnes gevonden.'
            ], 404);
        }

        return response()->json([
            'data' => $campaigns
        ], 200);
    }

    public function create(Request $request)
    {
        $user = $request->user();

        if ($user->cannot('create campaigns')) {
            return response()->json([
                'error' => 'U bent niet gemachtigd om campagnes aan te maken.'
            ], 403);
        }

        $this->validate($request, [
            'name' => 'required',
            'channels' => 'required'
        ]);
        
        $campaign = Campaign::create([
            'company_id' => $user->company_id,
            'name' => $request->name,
            'channels' => $request->channels
        ]);
        
        $channels = explode(',', $request->channels);

        if (in_array('newsletter', $channels)) {
            $newsletter = Newsletter::create([
                'campaign_id' => $campaign->id
            ]);
        }

        return response()->json([
            'data' => $campaign
        ], 200);
    }
}
