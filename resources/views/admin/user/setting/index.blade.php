@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Setting</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Push</th>
                                <th>Morning</th>
                                <th>Noon</th>
                                <th>Evening</th>
                                <th>Other</th>
                                <th>Follower</th>
                                <th>Favor_restaurant_around</th>
                                <th>Limit</th>
                                <th>Radius</th>


                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$setting->id}}</td>
                                <td>{{$setting->push}}</td>
                                <td>{{$setting->morning}}</td>
                                <td>{{$setting->noon}}</td>
                                <td>{{$setting->evening}}</td>
                                <td>{{$setting->other}}</td>
                                <td>{{$setting->follower}}</td>
                                <td>{{$setting->favor_restaurant_around}}</td>
                                <td>{{$setting->limit}}</td>
                                <td>{{$setting->radius}}</td>
                                <td>
                                    <button id-attr="{{$setting->id}}" class="btn btn-primary btn-sm edit-cate"
                                            type="button">Edit
                                    </button>
                                    &nbsp;
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="row">

                        {{--<div class="col-sm-6">{!!$categories->render()!!}</div>--}}
                    </div>


                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>

    </div>
@endsection
@section('footer')
    <script>
        $(function () {
            $('.edit-cate').click(function () {
                window.location.href = window.baseUrl + '/admin/user/setting/' + $(this).attr('id-attr') + '/edit';
            });
        });

    </script>
@endsection
