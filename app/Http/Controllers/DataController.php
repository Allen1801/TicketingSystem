<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use App\Models\Departments;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Notifications\Notification;  
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Auth;


class DataController extends Controller
{
    public function index(){

        $post = CustomerModel::select('*')->get();


        if(request()->ajax()){
            return datatables()->of($post)
            ->addColumn('action', 'layouts.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin');
    }

    public function filter(){
        if(request()->ajax()){
            $userid = auth()->user()->id;
            return datatables()->of(CustomerModel::select('*')->where('customer_id', $userid)->get())
            ->addColumn('action', 'layouts.useraction')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('home');
    }

    public function fetchDept()
    {
        $departments = Departments::all();
        return response()->json($departments);
    }

    public function fetchAdmin()
    {
        $handlers = User::where('role', 1)->get();
        return response()->json($handlers);
    }

    public function customer(){

        if(request()->ajax()){
            return datatables()->of(User::where('role', 0))
            ->addColumn('action', 'layouts.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('users');

    }

    public function adminusers(){

        if(request()->ajax()){
            return datatables()->of(User::where('role', 1))
            ->addColumn('action', 'layouts.adminaction')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin-users');

    }

    public function department(){

        if(request()->ajax()){
            return datatables()->of(Departments::select('*'))
            ->addColumn('action', 'layouts.adminaction')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('department');

    }

     // TODO:CHARTS AND ANALYTICS

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
}


