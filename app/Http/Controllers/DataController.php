<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use App\Models\SurveyModel;
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
        $survey =  SurveyModel::count();

        return view('dashboard', compact('total', 'new', 'inprogress','complete','inactive', 'open', 'survey'));
        
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
    public function survey1(){
        $q1_1 = SurveyModel::where('q1', 'Very satisfied')->count();
        $q1_2 = SurveyModel::where('q1', 'Satisfied')->count();
        $q1_3 = SurveyModel::where('q1', 'Neutral')->count();
        $q1_4 = SurveyModel::where('q1', 'Dissatisfied')->count();
        $q1_5 = SurveyModel::where('q1', 'Very dissatisfied')->count();


        $data = [
            'labels' => ['Very satisfied', 'Satisfied', 'Neutral', 'Dissatisfied', 'Very dissatisfied'],
            'values' => [$q1_1, $q1_2, $q1_3, $q1_4, $q1_5],
        ];

        return response()->json($data);
    }

    public function survey2(){
        $q2_1 = SurveyModel::where('q2', 'Very easy')->count();
        $q2_2 = SurveyModel::where('q2', 'Easy')->count();
        $q2_3 = SurveyModel::where('q2', 'Neutral')->count();
        $q2_4 = SurveyModel::where('q2', 'Dissatisfied')->count();
        $q2_5 = SurveyModel::where('q2', 'Very dissatisfied')->count();


        $data = [
            'labels' => ['Very easy', 'Easy', 'Neutral', 'Difficult', 'Very difficult'],
            'values' => [$q2_1, $q2_2, $q2_3, $q2_4, $q2_5],
        ];

        return response()->json($data);
    }

    public function survey3(){
        $q3_1 = SurveyModel::where('q3', 'Very satisfied')->count();
        $q3_2 = SurveyModel::where('q3', 'Satisfied')->count();
        $q3_3 = SurveyModel::where('q3', 'Neutral')->count();
        $q3_4 = SurveyModel::where('q3', 'Dissatisfied')->count();
        $q3_5 = SurveyModel::where('q3', 'Very dissatisfied')->count();


        $data = [
            'labels' => ['Very satisfied', 'Satisfied', 'Neutral', 'Dissatisfied', 'Very dissatisfied'],
            'values' => [$q3_1, $q3_2, $q3_3, $q3_4, $q3_5],
        ];

        return response()->json($data);
    }

    public function survey4(){
        $q4_1 = SurveyModel::where('q4', 'Very clear')->count();
        $q4_2 = SurveyModel::where('q4', 'Clear')->count();
        $q4_3 = SurveyModel::where('q4', 'Neutral')->count();
        $q4_4 = SurveyModel::where('q4', 'Unclear')->count();
        $q4_5 = SurveyModel::where('q4', 'Very unclear')->count();


        $data = [
            'labels' => ['Very clear', 'Clear', 'Neutral', 'Unclear', 'Very unclear'],
            'values' => [$q4_1, $q4_2, $q4_3, $q4_4, $q4_5],
        ];

        return response()->json($data);
    }

    public function survey5(){
        $q5_1 = SurveyModel::where('q5', 'Very helpful')->count();
        $q5_2 = SurveyModel::where('q5', 'Helpful')->count();
        $q5_3 = SurveyModel::where('q5', 'Neutral')->count();
        $q5_4 = SurveyModel::where('q5', 'Unhelpful')->count();
        $q5_5 = SurveyModel::where('q5', 'Very unhelpful')->count();


        $data = [
            'labels' => ['Very helpful', 'Helpful', 'Neutral', 'Unhelpful', 'Very unhelpful'],
            'values' => [$q5_1, $q5_2, $q5_3, $q5_4, $q5_5],
        ];

        return response()->json($data);
    }

    public function survey6(){
        $q6_1 = SurveyModel::where('q6', 'Yes, completely')->count();
        $q6_2 = SurveyModel::where('q6', 'Yes, somewhat')->count();
        $q6_3 = SurveyModel::where('q6', 'No, not at all')->count();


        $data = [
            'labels' => ['Yes, completely', 'Yes, somewhat', 'No, not at all'],
            'values' => [$q6_1, $q6_2, $q6_3],
        ];

        return response()->json($data);
    }

    public function survey7(){
        $q7_1 = SurveyModel::where('q7', 'Yes')->count();
        $q7_2 = SurveyModel::where('q7', 'No')->count();


        $data = [
            'labels' => ['Yes', 'No'],
            'values' => [$q7_1, $q7_2],
        ];

        return response()->json($data);
    }

    public function survey8(){
        $q8_1 = SurveyModel::where('q8', 'Very likely')->count();
        $q8_2 = SurveyModel::where('q8', 'Likely')->count();
        $q8_3 = SurveyModel::where('q8', 'Neutral')->count();
        $q8_4 = SurveyModel::where('q8', 'Unlikely')->count();
        $q8_5 = SurveyModel::where('q8', 'Very unlikely')->count();


        $data = [
            'labels' => ['Very likely', 'Likely', 'Neutral', 'Unlikely', 'Very unlikely'],
            'values' => [$q8_1, $q8_2, $q8_3, $q8_4, $q8_5],
        ];

        return response()->json($data);
    }

    public function survey9(){
        $data =  SurveyModel::join('users', 'users.id', '=', 'survey.customer_id')
                    ->select('survey.*', 'users.*')
                    ->get();

                    return datatables()->of($data)->toJson();
    }
    public function survey10(){
        $data = SurveyModel::join('users', 'users.id', '=', 'survey.customer_id')
                    ->select('survey.*', 'users.*')
                    ->get();

                    return datatables()->of($data)->toJson();
    }
}


