@extends('admin')

@section('content')




    <body>
    <div id="wrapper">
        <div class="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Form</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form action="action_page.php" method="get">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <td>ID</td>
                                            <td><input type="text" name=""/></td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td><input type="text" name=""/></td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td><input type="text" name=""/></td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td><input type="text" name=""/></td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <button class="btn btn-primary btn-sm edit-cate" type="submit">Submit</button>&nbsp;
                                                <button type="submit" class="btn btn-danger btn-mini">Cancel</button>
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
@section('footer')

@endsection