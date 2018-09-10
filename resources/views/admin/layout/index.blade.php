<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Khóa Học Lập Trình Laravel Framework 5.x Tại Khoa Phạm">
    <meta name="author" content="">
    <base href="{{ asset('') }}">
    <title>Admin - Khoa Phạm</title>

    <!-- Bootstrap Core CSS -->
    <link href="admin-asset/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="admin-asset/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="admin-asset/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="admin-asset/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="admin-asset/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="admin-asset/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <link rel="stylesheet" href="admin-asset/css/jquery-ui.css">
    <link rel="stylesheet" href="admin-asset/css/style.css">
</head>

<body>

    <div id="wrapper">
        @include('admin.layout.header')
        @yield('content-admin')

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="admin-asset/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="admin-asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="admin-asset/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="admin-asset/dist/js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->
    <script src="admin-asset/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script src="admin-asset/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    {{-- <script src="admin-asset/js/jquery-1.9.1.js"></script> --}}
    <script src="admin-asset/js/jquery-ui.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
        // CONFIRM DELETE
        $('a.comfil-delete').on('click', () => {
            if (!confirm("Bạn muốn xóa không?")) return false; //chac chan muon xoa k
        });
        $( "#datepicker" ).click(function() {
              alert( "Handler for .click() called." );
        });
        
    });
    </script>
    <script type="text/javascript" language="javascript" src="admin-asset/ckeditor/ckeditor.js" ></script>
    @yield('script-admin')
</body>

</html>
