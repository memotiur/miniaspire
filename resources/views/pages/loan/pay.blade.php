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

                <form class="form-horizontal" method="post" action="/repayment/store"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Installment</label>
                        <select class="form-control" name="installment">
                            @for($i=1;$i<=$loan->duration;$i++)
                                <option value="{{$i}}">{{$i}} Installment</option>

                            @endfor
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Receive Amount:</label>
                        <input type="text" class="form-control" name="receive_amount"
                               value="{{$loan->per_installment_amount}}" required>
                        <input type="hidden" class="form-control" name="loan_id"
                               value="{{$loan->loan_id}}">

                        <input type="hidden" class="form-control" name="_token"
                               value="{{csrf_token()}}">
                    </div>


                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

            </div>
        </div>

    </div>

@endsection