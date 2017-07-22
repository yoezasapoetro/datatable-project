<!DOCTYPE html>
<html>
    <head>
        <title>Project Datatable</title>

        <link href="{{ asset('style.css') }}" rel="stylesheet" />
        <link href="{{ asset('datatable.css') }}" rel="stylesheet" />

        <style>
            body {
                padding-top: 20px;
                padding-bottom: 100px; 
            }

            .navbar {
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        
        <div class="container">

        <!-- Static navbar -->
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{ url('/') }}" title="Project?">Project Datatable</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{ url('/logout') }}" title="Logout">Welcome, {{ auth()->user()->username }}</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div><!--/.container-fluid -->
            </nav>

            <!-- Main component for a primary marketing message or call to action -->
            <div class="content">
                <h3>Comments Datatable</h3>

                <table id="comments" class="display table table-responsive table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Body</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Body</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div> <!-- /container -->

        <script src="{{ asset('script.js') }}"></script> 
        <script src="{{ asset('datatables.js') }}"></script> 
        <script>
            var apiUrl = "http://jsonplaceholder.typicode.com/comments";

            $(document).ready(function() {
                $('#comments tfoot tr td').each(function() {
                    $(this).html( '<input type="text" class="form-control input-sm" style="width: 100%" placeholder="Search '+$(this).text()+'" />' );
                });

                var table = $('#comments').DataTable({
                    "processing": true,
                    // "serverSide": true,
                    "ajax": {
                        "url": apiUrl,
                        "dataSrc": ""
                    },
                    "columns": [
                        { "data": "name" },
                        { "data": "email" },
                        { "data": "body" }
                    ],
                    "pagingType": "simple_numbers"
                });

                table.columns().every(function() {
                    var th = this;
                    $('input', this.footer()).on('keyup change', function() {
                        if(th.search() !== this.value) {
                            th.search(this.value).draw();
                        }
                    });
                });
            } );
        </script>
    </body>
</html>
