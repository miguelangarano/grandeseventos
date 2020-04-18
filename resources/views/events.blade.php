<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <style>
        .custab{
            border: 1px solid #ccc;
            padding: 5px;
            margin: 5% 0;
            box-shadow: 3px 3px 2px #ccc;
            transition: 0.5s;
            }
        .custab:hover{
            box-shadow: 3px 3px 0px transparent;
            transition: 0.5s;
            }
    </style>
    <title>Eventos</title>
</head>
<body>
    <div class="container">
        <div class="row col-md-6 col-md-offset-2 custyle">
            <table id="eventos" class="table table-striped custab">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Evento</th>
                        <th>Ver</th>
                    </tr>
                </thead>
                        <tr>
                        </tr>
            </table>
        </div>
    </div>
    <script>
        $.get("http://localhost:8000/api/eventos", function(val){
            var trHTML = '';
            for(let i=0; i<val.length; i++) {
                trHTML += '<tr><td>' + val[i]['id'] + '</td><td>' + val[i]['nombre'] + '</td>  <td class="text-center"><a class="btn btn-info btn-xs" onClick="onEventClick('+val[i]['id']+')"><span class="glyphicon glyphicon-edit"></span> Edit</a></td></tr>';
            }
            $('#eventos').append(trHTML);
        });
    </script>
    <script>
        function onEventClick(id){
            window.location.href = 'http://localhost:8000/login?id='+id;
        }
    </script>
</body>
</html>