<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Models\User;
use App\Notifications\NewTicketNotification;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Notification;
use Pusher\Pusher;
use Illuminate\Support\Facades\Auth;    

class CustomerController extends Controller
{

    public function usermain(){
        // Counting the records where 'column_name' equals the given value
        // $total = CustomerModel::count();
        // $new = CustomerModel::where('status', 'New')->count();
        // $inprogress = CustomerModel::where('status', 'Unresolved')->count();
        // $complete = CustomerModel::where('status', 'Resolved')->count();
        // $inactive = CustomerModel::where('status', 'Closed')->count();
        // $open = CustomerModel::where('status', 'Open')->count();

        // return view('index_admin', compact('total', 'new', 'inprogress','complete','inactive', 'open'));

        $user = Auth::user();
        $notifications = $user->unreadNotifications;

        return view('index_user', ['notifications' => $notifications]);
    }

    public function edit(Request $request)
    {   
        // $where = array('id' => $request->id);
        // $employee  = CustomerModel::where($where)->first();
        // return Response()->json($employee);

        $id = $request->id;
        $data = CustomerModel::find($id);
        return response()->json($data);
    }

    public function userupdate(Request  $request) {

        $ticekt_id = $request->id;

        $file =  $request->file('previewimage');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/uploads',$filename);
        
        $ticket = [

            // 'prio' =>  $request->prio,
            // 'handler' => $request->handler,
            // 'status' => $request->status,
            // 'remarks' => $request->remarks
            'subject' => $request->previewsubject,
            'description' => $request->previewdescription,
            'email' => $request->previewemail,
            'image' => $filename,

            
        ];
        $update = CustomerModel::where('id', $ticekt_id)->update($ticket);

        // Get the email address of the user associated with the ticket
        $findEmail = CustomerModel::find($ticekt_id);
        $userEmail = $findEmail->email;
    
        // Find the user based on the email address
        $user = User::where('email', $userEmail)->first();
    
        // Send email notification to the user if the user exists
        $user->notify(new EmailNotification($findEmail));
        
 
        return response()->json([
            'status' => 200,
            'data' => $update,
            'email' => $userEmail,
            'user' => $user,
            'findEmail' => $findEmail

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
            'name' => $request->name,
            'department' => $request->dept,
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

    public function updatenote(Request $request) {
        $ticket_id = $request->id;
        
        $ticketnote = [
            'handler' => $request->handler
        ];
        
        $updatenote = CustomerModel::where('id', $ticket_id)->update($ticketnote);
    
        return response()->json([
            'status' => 200,
            'data' => $updatenote,
            // 'received_id' => $ticket_id,
        ]);
    }

    public function delete(Request $request){
        $id = $request->id;
        $record = CustomerModel::findOrFail($id);
        $record->delete();

        return response()->json(['success' => true]);
    }

    public function survey(){
        return view('survey');
    }
}
