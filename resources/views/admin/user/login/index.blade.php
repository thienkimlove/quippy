
@extends('admin')
@section('content')



    <body>
    <div id="wrapper">
        <div class="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Login</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form action="{{ url('/admin/authenticate') }}" method="post">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <td>Username </td>
                                            <td><input type="text" name="username"/></td>
                                        </tr>
                                        <tr>
                                            <td>Password</td>
                                            <td><input type="password" name="password"/></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <button class="btn btn-primary edit-cate" type="submit">Login</button>&nbsp;
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

@endsection

<script>
    function send() {
        alert('kakak');
    }



</script>