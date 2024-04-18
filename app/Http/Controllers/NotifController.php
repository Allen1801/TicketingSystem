<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class NotifController extends Controller
{
    public function send(Request $request)
    {
        $pusher = new Pusher('d2bb2b51e17bf488dfb1', 'eb95694f27dd6b02d92f', '1788049', [
            'cluster' => 'ap1',
        ]);

        $data = 'New Ticket Request';
        $pusher->trigger('my-channel', 'my-event', $data);

        return redirect()->route('index');
    }
}
