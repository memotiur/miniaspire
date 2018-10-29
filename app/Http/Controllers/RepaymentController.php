<?php

namespace App\Http\Controllers;

use App\Repayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class RepaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check()) {
                return Redirect::to('/user/login');
            }
            return $next($request);
        });
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        //after confirming udata will be stored

        unset($request['_token']);
        $request->request->add(['user_id' => Session::get('id')]);

        $result = Repayment::where('installment', $request['installment'])->where('loan_id', $request['loan_id'])->first();


        try {
            if (is_null($result)) {
                Repayment::create($request->all());
                return back()->with('success', "Successfully submitted ");
            } else {
                return back()->with('failed', "Already paid " . $request['installment'] . " installment");
            }

        } catch (\Exception $exception) {
            return back()->with('failed', "There is a problem " . $exception->getMessage());
        }
    }


    public function show(Repayment $repayment)
    {
        //
    }


    public function edit(Repayment $repayment)
    {
        //
    }


    public function update(Request $request, Repayment $repayment)
    {
        //
    }


    public function destroy(Repayment $repayment)
    {
        //
    }
}
