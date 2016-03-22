@extends('admin')

@section('content')
    <body>
    <div id="wrapper">
        <div class="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Setting</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form action="{{ url('/admin/user/setting/'.$setting->id.'/submit') }}" method="get">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <td>Push</td>
                                            <td><input value="{{$setting->push}}" type="text" name="push"/></td>
                                        </tr>
                                        <tr>
                                            <td>Morning</td>
                                            <td><input value="{{$setting->morning}}" type="text" name="morning"/></td>
                                        </tr>
                                        <tr>
                                            <td>Noon</td>
                                            <td><input value="{{$setting->noon}}" type="text" name="noon"/></td>
                                        </tr>
                                        <tr>
                                            <td>Evening</td>
                                            <td><input value="{{$setting->evening}}" type="text" name="evening"/></td>
                                        </tr>
                                        <tr>
                                            <td>Other</td>
                                            <td><input value="{{$setting->other}}" type="text" name="other"/></td>
                                        </tr>
                                        <tr>
                                            <td>Follower</td>
                                            <td><input value="{{$setting->follower}}" type="text" name="follower"/></td>
                                        </tr>
                                        <tr>
                                            <td>Following</td>
                                            <td><input value="{{$setting->following}}" type="text" name="following"/></td>
                                        </tr>

                                        <tr>
                                            <td>Limit</td>
                                            <td><input value="{{$setting->limit}}" type="text" name="limit"/></td>
                                        </tr>
                                        <tr>
                                            <td>Favor</td>
                                            <td><input value="{{$setting->favor_restaurant_around}}" type="text" name="favor"/></td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <button class="btn btn-primary  edit-cate" type="submit">Submit</button>&nbsp;
                                                <a href="javascript:void(0)" class="btn btn-danger btn-mini" id="btnEdit">Cancel</a>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
        </div>
    </div>
    </body>
@stop

@section('footer')
    <script>
        $('#btnEdit').click(function () {
            window.location.href = window.baseUrl + '/admin/user/'+ {{$setting->id}}+ '/setting';
        });
    </script>
@endsection