<?php

namespace App\Http\Controllers;

use App\Loan;
use App\Repayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LoanController extends Controller
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
        return view('pages.home.index');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $loan_rate = 1.5;
        unset($request['_token']);
        $request->request->add(['user_id' => Session::get('id')]);
        $request->request->add(['loan_rate' => $loan_rate]);

        $total_amount = $request['amount'] * $loan_rate / 100 * $request['duration'] + $request['amount'];
        $per_installment_amount = ceil($total_amount / $request['duration']);
        $request->request->add(['total_amount' => $total_amount]);

        $request->request->add(['per_installment_amount' => $per_installment_amount]);

        try {
            Loan::create($request->all());
            return back()->with('success', "Successfully submitted ");
        } catch (\Exception $exception) {
            return back()->with('failed', "There is a problem " . $exception->getMessage());
        }
    }


    public function show(Loan $loan)
    {
        $repayments = Repayment::where('user_id', Session::get('id'))->get();
        $result = Loan::where('user_id', Session::get('id'))
            ->orderBy('loan_id', 'DESC')
            ->get();
        return view('pages.loan.index')
            ->with('repayments', $repayments)
            ->with('loans', $result);
    }

    public function pay($id)
    {
        return view('pages.loan.pay')
            ->with('loan', Loan::where('loan_id', $id)->first());
    }


    public function details($id)
    {
        $results = Repayment::where('loan_id', $id)->get();
        return view('pages.loan.details')
            ->with('repayments', $results);
    }


    public function destroy(Loan $loan)
    {
        //
    }
}
