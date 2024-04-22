<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class DataController extends Controller
{

    // public function dashboard(){

    //     return view('dashboard');

    // }

    public function getRecords()
    {
        $data = CustomerModel::query();
    
        return DataTables::of($data)->make(true);
    }

    public function index(){

        $post = CustomerModel::select('tickets.*', "users.name as user_name")
                                ->join('users', 'users.id', '=', 'tickets.customer_id')
                                ->get();


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
}


