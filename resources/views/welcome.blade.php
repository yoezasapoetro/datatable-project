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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Body</td>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div> <!-- /container -->

        <script src="{{ asset('script.js') }}"></script> 
        <script src="{{ asset('datatables.js') }}"></script> 
        <script>
            var apiUrl = "http://jsonplaceholder.typicode.com/comments";

            var DataTable_Comments = $('#comments').DataTable({
                "processing": true,
                "ajax": {
                    "url": apiUrl,
                    "dataSrc": ""
                },
                "columns": [
                    { "data": "name" },
                    { "data": "email" },
                    { "data": "body" },
                    { "data": "id",
                        "render": function(data, type, row, meta) {
                        return '<button type="button" class="btn btn-link btn-sm" onclick="editForm('+data+')" title="Edit"><i class="glyphicon glyphicon-pencil"></i></button>' + '&emsp;' +
                        '<button type="button" class="btn btn-link btn-sm" onclick="destroy('+data+')" title="Hapus"><i class="glyphicon glyphicon-trash"></i></button>'
                    } }
                ],
                "pagingType": "simple_numbers"
            });
            
            $('#comments tfoot tr td').each(function() {
                $(this).html( '<input type="text" class="form-control input-sm" style="width: 100%" placeholder="Search '+$(this).text()+'" />' );
            });

            DataTable_Comments.columns().every(function() {
                var th = this;
                $('input', this.footer()).on('keyup change', function() {
                    if(th.search() !== this.value) {
                        th.search(this.value).draw();
                    }
                });
            });
            
            function editForm(id) {
                var _this = this;
                $.getJSON({
                    url: apiUrl + '/' + id,
                    success: function(d) {
                        bootbox.dialog({
                            title: 'Edit Data #' + d.id,
                            message: _this.form(d),
                            buttons: {
                                main: {
                                    label: 'Save',
                                    className: 'btn-info btn-sm',
                                    callback: function() {
                                        _this.putForm(d.id, $('form.editForm').serialize());
                                    }
                                }
                            }
                        });
                    }
                });
            }
            
            function putForm(id, serializeData) {
                $.ajax({
                    url: apiUrl + '/' + id,
                    type: 'PUT',
                    data: serializeData,
                    success: function(res) {
                        DataTable_Comments.draw();
                        bootbox.alert('[EDIT] Message From Server: ' + JSON.stringify(res));
                    }
                });
            }
            
            function form(d) {
                var _form = $('<form></form>').addClass('editForm').addClass('form').attr('role', 'form');
                
                var inputName = _form.append($('<div></div>').addClass('form-group'));
                inputName.append($('<label></label>').addClass('label-control').text('Name'));
                inputName.append($('<input></input>').addClass('form-control').attr('name', 'name').attr('type', 'text').val(d.name));
                
                var inputEmail = _form.append($('<div></div>').addClass('form-group'));
                inputEmail.append($('<label></label>').addClass('label-control').text('Email'));
                inputEmail.append($('<input></input>').addClass('form-control').attr('name', 'email').attr('type', 'email').val(d.email));
                
                var inputBody = _form.append($('<div></div>').addClass('form-group'));
                inputBody.append($('<label></label>').addClass('label-control').text('Body'));
                inputBody.append($('<textarea></textarea>').addClass('form-control').attr('name', 'body').attr('rows', 4).val(d.body));
                
                return _form;
            }
            
            function destroy(id) {
                bootbox.confirm('Are You Sure', function(res) {
                    if(res == true) {
                        $.ajax({
                            url: apiUrl + '/' + id,
                            type: 'DELETE',
                            success: function(r) {
                                DataTable_Comments.draw();
                                bootbox.alert('[DELETE] Message From Server: ' + JSON.stringify(r));
                            }
                        });
                    }
                });
                
                return true;
            }
        </script>
    </body>
</html>
