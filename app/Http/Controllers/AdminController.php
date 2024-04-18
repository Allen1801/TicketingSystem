<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Notifications\Notification;  
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    // public function dashboard(){

    //     return view('dashboard');

    // }

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

    public function remove(Request $request){
        $id = $request->id;
        $record = User::findOrFail($id);
        $record->delete();

        return response()->json(['success' => true]);
    }

    public function customer(){

        if(request()->ajax()){
            return datatables()->of(User::select('*'))
            ->addColumn('action', 'action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('users');

    }

    public function main(){
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

        return view('index_admin', ['notifications' => $notifications]);
    }

    public function records(){
        // Counting the records where 'column_name' equals the given value
        $total = CustomerModel::count();
        $new = CustomerModel::where('status', 'New')->count();
        $inprogress = CustomerModel::where('status', 'Unresolved')->count();
        $complete = CustomerModel::where('status', 'Resolved')->count();
        $inactive = CustomerModel::where('status', 'Closed')->count();
        $open = CustomerModel::where('status', 'Open')->count();

        return view('dashboard', compact('total', 'new', 'inprogress','complete','inactive', 'open'));
        
    }

    public function chart(){
        $total = CustomerModel::count();
        $new = CustomerModel::where('status', 'New')->count();
        $inprogress = CustomerModel::where('status', 'Unresolved')->count();
        $complete = CustomerModel::where('status', 'Resolved')->count();
        $inactive = CustomerModel::where('status', 'Closed')->count();
        $open = CustomerModel::where('status', 'Open')->count();

        $data = [
            'labels' => ['New', 'Open', 'Resolved', 'Unresolved', 'Closed'],
            'values' => [$new, $open, $complete, $inprogress, $inactive],
        ];

        return response()->json($data);
    }

    public function line(){
        // Get the start and end dates of the current week
        $startOfWeek = date('Y-m-d', strtotime('last sunday'));
        $endOfWeek = date('Y-m-d', strtotime('next saturday'));
    
        // Fetch data for the current week
        $eventCounts = CustomerModel::whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();
    
        // Initialize arrays to store day names and counts
        $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $countByDay = array_fill_keys($daysOfWeek, 0);
    
        // Loop through each data entry and update counts
        foreach ($eventCounts as $count) {
            $dayOfWeek = date('l', strtotime($count->created_at)); // Get day of week for the entry
            $countByDay[$dayOfWeek]++; // Increment count for that day of the week
        }
    
        // Rearrange the counts starting from Sunday
        $startIndex = array_search('Sunday', $daysOfWeek); // Find index of Sunday
        $countByDay = array_merge(array_slice($countByDay, $startIndex), array_slice($countByDay, 0, $startIndex));
    
        $data = [
            'labels' => $daysOfWeek,
            'values' => array_values($countByDay)
        ];
    
        return response()->json($data);
    }
    
    

    public function bar(){
        //$total = CustomerModel::count();
        $zero = CustomerModel::where('prio', '0')->count();
        $one = CustomerModel::where('prio', '1')->count();
        $two = CustomerModel::where('prio', '2')->count();
        $three = CustomerModel::where('prio', '3')->count();
        $four = CustomerModel::where('prio', '4')->count();
        //$five = CustomerModel::where('prio', 5)->count();

        $data = [
            'labels' => ['Very Low', 'Low', 'Medium', 'High', 'Very High'],
            'values' => [$zero, $one, $two, $three, $four],
        ];

        return response()->json($data);
    }

    public function donut(){
        $total = CustomerModel::count();
        $admin1 = CustomerModel::where('handler', 'Admin 1')->count();
        $admin2 = CustomerModel::where('handler', 'Admin 2')->count();
        $admin3 = CustomerModel::where('handler', 'Admin 3')->count();


        $data = [
            'labels' => ['Admin 1', 'Admin 2', 'Admin 3'],
            'values' => [$admin1, $admin2, $admin3],
        ];

        return response()->json($data);
    }

    public function markasread(Request $request){
        $user = Auth::user();

        $user->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
