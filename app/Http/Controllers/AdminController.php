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
use PDF;
use Illuminate\Support\Facades\Hash;

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
    
        // // // Find the user based on the email address
        $user = CustomerModel::where('email', $userEmail)->first();
    
        // // // Send email notification to the user if the user exists
        $user->notify(new EmailNotification($findEmail));
        
 
        return response()->json([
            'status' => 200,
            'data' => $accepttix,
            'email' => $userEmail,
            'user' => $user,
            'findEmail' => $findEmail

        ]);
    }

    public function printtix(Request $request){
        $ticket_id = $request->id; 
        $ticket = CustomerModel::find($ticket_id);

        $data = [
            'id' => $ticket->id,
            'email' => $ticket->email,
            'name' => $ticket->name,
            'subject' => $ticket->subject,
            'description' => $ticket->description,
            'department' => $ticket->department,
        ];

        // Generate your PDF here using a library like DOMPDF or TCPDF
        // Example using DOMPDF:
        $pdf = PDF::loadView('layouts.pdf', $data);
        
        // Return the PDF as a response
        return $pdf->download('ticket.pdf');



        // $pdf = new Dompdf();
        // $pdf->loadHtml('<h1>Hello, world!</h1>'); // Replace with your HTML content
        // $pdf->setPaper('A4', 'portrait'); // Set paper size and orientation
        // $pdf->render(); // Render the PDF

        // // Return the PDF as a response
        // return $pdf->stream('example.pdf');
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
        $user = CustomerModel::where('email', $userEmail)->first();
    
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

    public function updateDept(Request $request){

        $ticket_id = $request->editid;

        $user = Departments::where('id', $ticket_id);

        $user->update([
            'department ' => $request->editdepartment,
        ]);

        return response()->json([
            'status' => 201,
            'data' => $user,
            //'ticket' => $ticket

        ]);
    }

    public function insert(Request $request){

        $ticket = [
            'name' =>  $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'dept' => $request->dept,
            'password' => Hash::make($request->password),
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
        $user = CustomerModel::where('email', $userEmail)->first();
    
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

        return response()->json([
            'status' => 201,
            //'ticket' => $ticket

        ]);
    }

    public function Deptremove(Request $request){
        $id = $request->id;
        $record = Departments::findOrFail($id);
        $record->delete();

        return response()->json([
            'status' => 201,
            //'ticket' => $ticket

        ]);;
    }

    public function admin_edit(Request $request){

        $id = $request->id;
        $data = User::find($id);
        return response()->json($data);
    }

    public function admin_update(Request $request){

        $ticket_id = $request->editid;

        $user = User::where('id', $ticket_id);
        
        // $ticket = [

        //     'name' => $request->editname,
        //     'email' => $request->editemail,
        //     'dept' => $request->editdept,
        //     'password' => Hash::make($request->editpassword)
            
        // ];

        $user->update([
            'name' => $request->editname,
            'email' => $request->editemail,
            'dept' => $request->editdept,
        ]);

        if ($request->editpassword) {
            $user->update([
                'password' => Hash::make($request->editpassword),
            ]);
        }

        return response()->json([
            'status' => 202,
            'data' => $user,
            //'ticket' => $ticket

        ]);
    }

    public function reset(Request $request){

        $ticket_id = $request->id;

        $user = User::where('id', $ticket_id);

        $user->update([
            'password' => Hash::make('qwerty123')
        ]);

        return response()->json([
            'status' => 202,
            'data' => $user,
            //'ticket' => $ticket

        ]);
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
