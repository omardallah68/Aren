<?php


namespace App\Http\Controllers;

use App\Models\Card;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;
use Spatie\DiscordAlerts\DiscordAlert;

class CardController extends Controller
{
    public function index()
    {
        $cards = Card::latest()->select('id', 'content', 'created_at')->get();
        return response()->json([
            'cards' => $cards
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        (new DiscordAlert)->to('notes')->message($request->input('content'));

        $notification['content'] = strip_tags($request->input('content'));
        Notification::route('telegram', 999720736)->notify(new \App\Notifications\TelegramNotification($notification));
        if(str_contains($request->input('content'), 'error')){
            return response()->json([
                'message' => 'Error! Text cannot contains "error"',
                'bannerStyle' => 'danger'
            ]);
        }
        else{

            $card = new Card([
                'content' => $request->input('content'),
                'created_at' => Carbon::now()
            ]);

            $card->save();


            return response()->json([
                'message' => 'Successfully saved! The Text already saved in Database',
                'bannerStyle' => 'success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $card = Card::find($id);
        $card->content = $request->input('content');
        $card->save();

        return response()->json([
            'message' => 'Successfully updated! The Text already updated in Database',
            'bannerStyle' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
