<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Models\User;
use App\Notifications\NewTicketNotification;
use Pusher\Pusher;

class CustomerController extends Controller
{

    public function edit(Request $request)
    {   
        // $where = array('id' => $request->id);
        // $employee  = CustomerModel::where($where)->first();
        // return Response()->json($employee);

        $id = $request->id;
        $data = CustomerModel::find($id);
        return response()->json($data);
    }

    public function update(Request  $request) {

        $ticekt_id = $request->id;
        
        $ticket = [

            'prio' =>  $request->prio,
            'handler' => $request->handler,
            'status' => $request->status,
            //'remarks' => $request->remarks
            
        ];
        $update = CustomerModel::where('id', $ticekt_id)->update($ticket);

        return response()->json([
            'status' => 200,
            'data' => $update,
        ]);
    }
    
    public function store(Request $request){

        $pusher = new Pusher('d2bb2b51e17bf488dfb1', 'eb95694f27dd6b02d92f', '1788049', [
            'cluster' => 'ap1',
        ]);

        $message = 'New Ticket Request';
        $pusher->trigger('my-channel', 'my-event', $message);

        $file =  $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/uploads',$filename);
        //$file->move(public_path('images'), $filename);

        $ticket = [
            'customer_id' => $request->id,
            'subject' =>  $request->subject,
            'email' => $request->email,
            'description' => $request->description,
            'image' => $filename,
            'prio' =>  '1',
            'handler' => 'None',
            'status' => 'New',
            
        ];

        
        $insert = CustomerModel::create($ticket);
        
        $admin = User::where('role', '1')->first(); // Example: Send notification to an admin
        $admin->notify(new NewTicketNotification($insert));

        return response()->json([
            'status' => 200,
            'data' => $insert,
            
        ]);
    }

    // public function note(Request $request)
    // {   
    //     // $where = array('id' => $request->id);
    //     // $employee  = CustomerModel::where($where)->first();
    //     // return Response()->json($employee);

    //     $id = $request->id;
    //     $data = CustomerModel::find($id);
    //     return response()->json($data);
    // }

    public function updatenote(Request $request) {
        $ticket_id = $request->id;
        
        $ticketnote = [
            'remarks' => $request->remarks
        ];
        
        $updatenote = CustomerModel::where('id', $ticket_id)->update($ticketnote);
    
        return response()->json([
            'status' => 200,
            'data' => $updatenote,
            'received_id' => $ticket_id,
        ]);
    }

    public function delete(Request $request){
        $id = $request->id;
        $record = CustomerModel::findOrFail($id);
        $record->delete();

        return response()->json(['success' => true]);
    }
}
