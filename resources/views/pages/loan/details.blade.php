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
                        <th>Installment</th>
                        <th>Receive Amount</th>
                        <th>Date</th>

                    </tr>
                    </thead>
                    <tbody>
                    @php($total=0)
                    @foreach($repayments as $repayment)
                        <tr>

                            <td>{{$repayment->installment}} Installment</td>
                            <td>{{$repayment->receive_amount}} $</td>
                            <td>{{$repayment->created_at}}</td>
                        </tr>
                        @php($total=$total+$repayment->receive_amount)
                    @endforeach
                    <tr>
                        <td colspan="">Total</td>
                        <td colspan="">Total: {{$total}}$</td>
                    </tr>

                    </tbody>
                </table>

            </div>
        </div>

    </div>

@endsection