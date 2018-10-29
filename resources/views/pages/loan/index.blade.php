@extends('layouts.aspire')

@section('title', 'Home')


@section('content')
    <div class="col-12 mx-auto">
        <div class="card">
            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{session('success')}}!</strong>
                    </div>
                @endif
                @if(session('failed'))
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{session('failed')}}!</strong>
                    </div>
                @endif

                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Receive Loan</th>
                        <th>Duration</th>
                        <th>Per Installment</th>
                        <th>Total</th>
                        <th>Paid Amount</th>
                        <th>Status</th>
                        <th>Pay Now</th>
                        <th>Show Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i=1)
                    @foreach($loans as $loan)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$loan->amount}}</td>
                            <td>{{$loan->duration}} Months</td>
                            <td>{{$loan->per_installment_amount}} $</td>
                            <td>{{$loan->total_amount}} $</td>
                            <td>
                                @php($repay_total=0)
                                @foreach($repayments as $repayment)
                                    @if($repayment->loan_id==$loan->loan_id)

                                        @php($repay_total=$repay_total+$repayment->receive_amount)

                                    @endif
                                @endforeach
                                {{$repay_total}} $
                            </td>
                            <td> @if($loan->paid_status==true or $loan->total_amount<=$repay_total)
                                    <span class="badge badge-primary badge-pill">Full Paid</span>
                                @else
                                    <span class="badge badge-danger badge-pill">Due</span>
                                @endif
                            </td>
                            <td><a href="/loan/pay/{{$loan->loan_id}}" class="btn btn-outline-info">Pay Now</a></td>
                            <td><a href="/loan/details/{{$loan->loan_id}}" class="btn btn-outline-secondary">Details</a></td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>

@endsection