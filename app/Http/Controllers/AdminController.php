<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use App\Models\User;
use App\Models\Departments;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Notifications\Notification;  
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function accepttix(Request $request)
    {   
        $handler=Auth::user()->name;
        $ticket_id = $request->id;
        
        $ticket = [

            // 'prio' =>  $request->prio,
            'handler' => $handler,
            'status' => "Open",
            //'remarks' => $request->remarks
            
        ];
        $accepttix = CustomerModel::where('id', $ticket_id)->update($ticket);

        // Get the email address of the user associated with the ticket
        $findEmail = CustomerModel::find($ticket_id);
        $userEmail = $findEmail->email;
    
        // // Find the user based on the email address
        $user = User::where('email', $userEmail)->first();
    
        // // Send email notification to the user if the user exists
        $user->notify(new EmailNotification($findEmail));
        
 
        return response()->json([
            'status' => 200,
            'data' => $accepttix,
            'email' => $userEmail,
            'user' => $user,
            'findEmail' => $findEmail

        ]);
    }

    public function statuschange(Request $request)
    {   
        $ticket_id = $request->id;
        
        $ticket = [

            'status' => 'Resolved',
            'solution' => $request->solution,
            //'remarks' => $request->remarks
            
        ];
        $statuschange = CustomerModel::where('id', $ticket_id)->update($ticket);

        // Get the email address of the user associated with the ticket
        $findEmail = CustomerModel::find($ticket_id);
        $userEmail = $findEmail->email;
    
        // // Find the user based on the email address
        $user = User::where('email', $userEmail)->first();
    
        // // Send email notification to the user if the user exists
        $user->notify(new EmailNotification($findEmail));
        
 
        return response()->json([
            'status' => 200,
            'data' => $statuschange,
            'email' => $userEmail,
            'user' => $user,
            'findEmail' => $findEmail

        ]);
    }

    public function insertDept(Request $request){

        $ticket = [
            'department' =>  $request->department,
        ];

        Departments::create($ticket);
        return response()->json([
            'status' => 200
        ]);
    }

    public function editDept(Request $request)
    {   
        $id = $request->id;
        $data = Departments::find($id);
        return response()->json($data);
    }

    public function insert(Request $request){

        $ticket = [
            'name' =>  $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'dept' => $request->dept,
            'password' => $request->password,
            'status' => 'Active'
        ];

        User::create($ticket);
        return response()->json([
            'status' => 200
        ]);
    }

    public function update(Request  $request) {

        $ticekt_id = $request->id;
        
        $ticket = [

            'prio' =>  $request->prio,
            // 'handler' => $request->handler,
            'status' => $request->status,
            'remarks' => $request->remarks
            
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

    public function remove(Request $request){
        $id = $request->id;
        $record = User::findOrFail($id);
        $record->delete();

        return response()->json(['success' => true]);
    }

    public function Deptremove(Request $request){
        $id = $request->id;
        $record = Departments::findOrFail($id);
        $record->delete();

        return response()->json(['success' => true]);
    }

    public function main(){

        $user = Auth::user();
        $notifications = $user->unreadNotifications;

        return view('index_admin', ['notifications' => $notifications]);
    }

    public function markasread(Request $request){
        $user = Auth::user();

        $user->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
