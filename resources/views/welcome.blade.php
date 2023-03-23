<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Registros</title>
    </head>
<body>

<div class="container" style="margin-top: 50px;">

    <h4 class="text-center">Registros</h4><br>

    <h5>Add Users</h5>
    <div class="card card-default">
        <div class="card-body">
            <form id="addCustomer" class="form-inline" method="POST" action="">
                <div class="form-group mb-2">
                    <label for="name" class="sr-only">Nombre</label>
                    <input id="name" type="text" class="form-control" name="name" placeholder="Ingresa tu nombre"
                           required autofocus>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="phone1" class="sr-only">Telefono</label>
                    <input id="phone1" type="phone1" class="form-control" name="phone1" placeholder="Este numero sera tu usuario"
                           required autofocus>
                           </div>
                           <div class="form-group mx-sm-3 mb-2">
                               <label for="password" class="sr-only">Passwor</label>
                               <input id="password" type="password" class="form-control" name="password" placeholder="Password"
                                      required autofocus>
           
                           </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="coordenada_log" class="sr-only">Coordenada_log</label>
                    <input id="coordenada_log" type="coordenada_log" class="form-control" name="coordenada_log" placeholder="Coordenada_log"
                           required autofocus>
                </div>

                

                <div class="form-group mx-sm-3 mb-2">
                    <label for="coordenada_log" class="sr-only">Coordenada_log</label>
                    <input id="coordenada_log" type="coordenada_log" class="form-control" name="coordenada_log" placeholder="Coordenada_log"
                           required autofocus>

                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="coordenada_lat" class="sr-only">Coordenada_lat</label>
                    <input id="coordenada_lat" type="coordenada_lat" class="form-control" name="coordenada_lat" placeholder="Coordenada_lat"
                           required autofocus>

                </div>
                <button id="submitCustomer" type="button" class="btn btn-primary mb-2">Submit</button>
            </form>
        </div>
    </div>

    <br>

    <h5>Users</h5>
    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Phone1</th>
            <th>Phone2</th>
            <th>Coordenada_log</th>
            <th>Coordenada_lat</th>
            <th width="180" class="text-center">Action</th>
        </tr>
        <tr></tr>
        <tr></tr>
        <tbody id="tbody">

        </tbody>
    </table>
</div>

<!-- Update Model -->
<form action="" method="POST" class="users-update-record-model form-horizontal">
    <div id="update-modal" data-backdrop="static" data-keyboard="false" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width:55%;">
            <div class="modal-content" style="overflow: hidden;">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Update</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                    </tr>
                </div>
                <div class="modal-body" id="updateBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                            data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-success updateCustomer">Update
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Delete Model -->
<form action="" method="POST" class="users-remove-record-model">
    <div id="remove-modal" data-backdrop="static" data-keyboard="false" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Delete</h4>
                    <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want to delete this record?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form"
                            data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-danger waves-effect waves-light deleteRecord">Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>


{{--Firebase Tasks--}}
<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.10.1/firebase.js"></script>
<script>
    // Initialize Firebase
    var config = {
        apiKey: "AIzaSyDJ6IdSi6PCpjJh8cXE3DJ9Jo_3pX7ftps",
        authDomain: "crudregistro-1e2e3.firebaseapp.com",
        databaseURL: "https://crudregistro-1e2e3-default-rtdb.firebaseio.com/",
        storageBucket: "crudregistro-1e2e3.appspot.com",
    };
    firebase.initializeApp(config);

    var database = firebase.database();

    var lastIndex = 0;

    // Get Data
    firebase.database().ref('customers/').on('value', function (snapshot) {
        var value = snapshot.val();
        var htmls = [];
        $.each(value, function (index, value) {
            if (value) {
                htmls.push('<tr>\
        		<td>' + value.name + '</td>\
                <td>' + value.phone1 + '</td>\
                <td>' + value.phone2 + '</td>\
                <td>' + value.coordenada_lat + '</td>\
                <td>' + value.coordenada_log + '</td>\
        		<td><button data-toggle="modal" data-target="#update-modal" class="btn btn-info updateData" data-id="' + index + '">Update</button>\
        		<button data-toggle="modal" data-target="#remove-modal" class="btn btn-danger removeData" data-id="' + index + '">Delete</button></td>\
        	</tr>');
            }
            lastIndex = index;
        });
        $('#tbody').html(htmls);
        $("#submitUser").removeClass('desabled');
    });

    // Add Data
    $('#submitCustomer').on('click', function () {
        var values = $("#addCustomer").serializeArray();
        var name = values[0].value;
        var phone1 = values[1].value;
        var phone2 = values[2].value;
        var coordenada_lat = values[3].value;
        var coordenada_log = values[4].value;
        var userID = lastIndex + 1;

        console.log(values);

        firebase.database().ref('customers/' + userID).set({
            name: name,
            phone1: phone1,
            phone2: phone2,
            coordenada_lat: coordenada_lat,
            coordenada_log: coordenada_log,
        });

        // Reassign lastID value
        lastIndex = userID;
        $("#addCustomer input").val("");
    });

    // Update Data
    var updateID = 0;
    $('body').on('click', '.updateData', function () {
        updateID = $(this).attr('data-id');
        firebase.database().ref('customers/' + updateID).on('value', function (snapshot) {
            var values = snapshot.val();
            var updateData = '<div class="form-group">\
		        <label for="first_name" class="col-md-12 col-form-label">Name</label>\
		        <div class="col-md-12">\
		            <input id="first_name" type="text" class="form-control" name="name" value="' + values.name + '" required autofocus>\
		        </div>\
		    </div>\
		    <div class="form-group">\
		        <label for="last_name" class="col-md-12 col-form-label">Email</label>\
		        <div class="col-md-12">\
		            <input id="last_name" type="text" class="form-control" name="email" value="' + values.email + '" required autofocus>\
		        </div>\
		    </div>';

            $('#updateBody').html(updateData);
        });
    });

    $('.updateCustomer').on('click', function () {
        var values = $(".users-update-record-model").serializeArray();
        var postData = {
            name: values[0].value,
            email: values[1].value,
        };

        var updates = {};
        updates['/customers/' + updateID] = postData;

        firebase.database().ref().update(updates);

        $("#update-modal").modal('hide');
    });

    // Remove Data
    $("body").on('click', '.removeData', function () {
        var id = $(this).attr('data-id');
        $('body').find('.users-remove-record-model').append('<input name="id" type="hidden" value="' + id + '">');
    });

    $('.deleteRecord').on('click', function () {
        var values = $(".users-remove-record-model").serializeArray();
        var id = values[0].value;
        firebase.database().ref('customers/' + id).remove();
        $('body').find('.users-remove-record-model').find("input").remove();
        $("#remove-modal").modal('hide');
    });
    $('.remove-data-from-delete-form').click(function () {
        $('body').find('.users-remove-record-model').find("input").remove();
    });
</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    
</body>
</html>