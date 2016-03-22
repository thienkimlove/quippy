@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">User</h1>
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
                                <th>#</th>
                                <th>System_token</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $cate)
                                <tr>
                                    <td>{{$cate->id}}</td>
                                    <td><a href="{{url('admin/user/'. $cate->id.'/setting')}}">{{$cate->system_token}}</a>
                                    </td>
                                    <td>
                                        <button id-attr="{{$cate->id}}" class="btn btn-danger btn-sm remove-cate"
                                                type="button">Delete
                                        </button>

                                        <button id-attr="{{$cate->id}}" class="btn btn-info btn-sm favor-res"
                                                type="button">Favourite
                                        </button>

                                        <button id-attr="{{$cate->id}}" class="btn btn-info btn-sm setting-user"
                                                type="button">Setting
                                        </button>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="row">

                        <div class="col-sm-6">{!!$categories->render()!!}</div>
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
            $('.favor-res').click(function () {
                window.location.href = window.baseUrl + '/admin/user/'+ $(this).attr('id-attr')+'/favourite';
            });
            $('.setting-user').click(function () {
                window.location.href = window.baseUrl + '/admin/user/'+ $(this).attr('id-attr')+'/setting';
            });

            $('.add-cate').click(function () {
                window.location.href = window.baseUrl + '/admin/user/create';
            });
            $('.edit-cate').click(function () {
                window.location.href = window.baseUrl + '/admin/user/' + $(this).attr('id-attr') + '/edit';
            });

            $('.remove-cate').click(function () {
                window.location.href = window.baseUrl + '/admin/user/' + $(this).attr('id-attr')+'/remove';
            });
        });

    </script>
@endsection
