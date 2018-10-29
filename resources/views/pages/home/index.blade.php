@extends('layouts.aspire')

@section('title', 'Home')


@section('content')
    <div class="col-12 mx-auto" ng-app="myAngular" ng-controller="calculate">
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


                <form class="form-inline" action="/loan/store" method="post">
                    <label>Say you wanted to draw</label>
                    <input type="number" class="form-control" name="amount" ng-model="amount_money" >
                    <input type="hidden" class="form-control" name="_token"
                           value="{{csrf_token()}}">
                    <label>for up to:</label>
                    <select class="form-control" name="duration" ng-model="duration">
                        <option value="1" ng-selected>1 Month</option>
                        <option value="2">2 Months</option>
                        <option value="3">3 Months</option>
                        <option value="4">4 Months</option>
                        <option value="5">5 Months</option>
                        <option value="6">6 Months</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Apply Now</button>
                </form>

                <hr>
                <div class="row">
                    <div class="col-6">
                        Fees would start at <span>@{{  perMonthCharge() }}</span> per month
                    </div>
                    <div class="col-6">

                        <p>This puts my monthly repayment at @{{  monthlyRepayment() }}</p>

                        <p>and brings the total outstanding to  @{{  totalRepayment() }}</p>

                    </div>
                </div>

            </div>
        </div>

    </div>

    <script>
        var myAngularApp = angular.module('myAngular', []);

        myAngularApp.controller("calculate", function ($scope, $http) {
            console.log("lol");

            $scope.intilizing = function () {
                $scope.amount_money = 10000;

                $scope.duration = '1';

            };

            $scope.intilizing();

            $scope.perMonthCharge = function () {

                return  1.5/100*$scope.amount_money;
            };

            $scope.monthlyRepayment = function () {

                return  ((1.5/100*$scope.amount_money)*$scope.duration+$scope.amount_money)/$scope.duration;
            };
            $scope.totalRepayment = function () {

                return  (1.5/100*$scope.amount_money)*$scope.duration+$scope.amount_money;
            }


        });
    </script>

@endsection