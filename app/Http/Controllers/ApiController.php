<?php

namespace App\Http\Controllers;

use App\Loan;
use App\Repayment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{

    public function newUser(Request $request)
    {
        $status = 1;
        $request->request->add(['password' => Hash::make($request['password'])]);
        if ($request['email'] == null OR $request['name'] == null OR $request['password'] == null) {
            $message = "Parameter missing";
            $status = 0;
        } else {

            try {
                $id = User::insertGetId($request->all());
                $request->session()->put('id', $id);
                $message = "Successfully saved";

            } catch (\Exception $exception) {
                $status = 0;
                $message = "There is an Error " . $exception->getMessage();
            }
        }

        $data = [
            'status' => $status,
            'message' => $message,
            'json' => $request->all(),
        ];
        return $data;
    }

    public function saveLoan(Request $request)
    {
        $status = 1;
        $values = "";
        $user_id = $request['user_id'];
        $amount = $request['amount'];
        $duration = $request['duration'];
        $loan_rate = $request['loan_rate'];
        if ($user_id == null OR $amount == null OR $duration == null OR $loan_rate == null) {
            $message = "Parameter missing";
            $status = 0;
        } else {
            $total_amount = $request['amount'] * $loan_rate / 100 * $request['duration'] + $request['amount'];
            $per_installment_amount = ceil($total_amount / $request['duration']);
            $array_value = array(
                'user_id' => $user_id,
                'amount' => $amount,
                'duration' => $duration,
                'loan_rate' => $loan_rate,
                'total_amount' => $total_amount,
                'per_installment_amount' => $per_installment_amount
            );
            $values = $array_value;
            try {
                Loan::create($array_value);
                $message = "Successfully saved";

            } catch (\Exception $exception) {
                $status = 0;
                $message = "There is an Error " . $exception->getMessage();
            }
        }

        $data = [
            'status' => $status,
            'message' => $message,
            'json' => $values,
        ];
        return $data;
    }

    public function saveRepayment(Request $request)
    {
        $status = 1;
        $values = "";
        $user_id = $request['user_id'];
        $loan_id = $request['loan_id'];
        $installment = $request['installment'];
        $receive_amount = $request['receive_amount'];
        if ($user_id == null OR $loan_id == null OR $installment == null OR $receive_amount == null) {
            $message = "Parameter missing";
            $status = 0;
        } else {

            $array_value = array(
                'user_id' => $user_id,
                'loan_id' => $loan_id,
                'installment' => $installment,
                'receive_amount' => $receive_amount
            );
            $values = $array_value;
            try {
                Repayment::create($array_value);
                $message = "Successfully saved";

            } catch (\Exception $exception) {
                $status = 0;
                $message = "There is an Error " . $exception->getMessage();
            }
        }

        $data = [
            'status' => $status,
            'message' => $message,
            'json' => $values,
        ];
        return $data;
    }
}
