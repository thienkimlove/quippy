@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Favourite Restaurant</h1>
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
                                <th>User_Id</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($favors as $favor)
                                <tr>
                                    <td>{{$favor->id}}</td>
                                    <td>{{$favor->user_id}}
                                    </td>
                                    <td>
                                        &nbsp;
                                        <button id-attr="{{$favor->id}}" id-user="{{$favor->user_id}}" class="btn btn-danger btn-sm remove-favour"
                                                type="button">Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

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
            $('.remove-favour').click(function () {
//                alert('hihi');
                window.location.href = window.baseUrl + '/admin/user/favour/' + $(this).attr('id-attr')+'/'+ $(this).attr('id-user')+'/remove';
            });
        });
    </script>
@endsection
