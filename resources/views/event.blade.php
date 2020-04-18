<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <style>
        html {
            font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;
            font-size: 14px;
        }

        h5 {
            font-size: 1.28571429em;
            font-weight: 700;
            line-height: 1.2857em;
            margin: 0;
        }

        .card {
            font-size: 1em;
            overflow: hidden;
            padding: 0;
            border: none;
            border-radius: .28571429rem;
            box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
        }

        .card-block {
            font-size: 1em;
            position: relative;
            margin: 0;
            padding: 1em;
            border: none;
            border-top: 1px solid rgba(34, 36, 38, .1);
            box-shadow: none;
        }

        .card-img-top {
            display: block;
            width: 100%;
            height: auto;
        }

        .card-title {
            font-size: 1.28571429em;
            font-weight: 700;
            line-height: 1.2857em;
        }

        .card-text {
            clear: both;
            margin-top: .5em;
            color: rgba(0, 0, 0, .68);
        }

        .card-footer {
            font-size: 1em;
            position: static;
            top: 0;
            left: 0;
            max-width: 100%;
            padding: .75em 1em;
            color: rgba(0, 0, 0, .4);
            border-top: 1px solid rgba(0, 0, 0, .05) !important;
            background: #fff;
        }

        .card-inverse .btn {
            border: 1px solid rgba(0, 0, 0, .05);
        }

        .profile {
            position: absolute;
            top: -12px;
            display: inline-block;
            overflow: hidden;
            box-sizing: border-box;
            width: 25px;
            height: 25px;
            margin: 0;
            border: 1px solid #fff;
            border-radius: 50%;
        }

        .profile-avatar {
            display: block;
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }

        .profile-inline {
            position: relative;
            top: 0;
            display: inline-block;
        }

        .profile-inline ~ .card-title {
            display: inline-block;
            margin-left: 4px;
            vertical-align: top;
        }

        .text-bold {
            font-weight: 700;
        }

        .meta {
            font-size: 1em;
            color: rgba(0, 0, 0, .4);
        }

        .meta a {
            text-decoration: none;
            color: rgba(0, 0, 0, .4);
        }

        .meta a:hover {
            color: rgba(0, 0, 0, .87);
        }       
    </style>
    <title>Detalle de Evento</title>
</head>
<body>
    <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
        <div class="card card-inverse card-info">
            <img class="card-img-top" src="http://latinosmag.com/wp-content/uploads/2019/05/concert.jpg">
            <div class="card-block">
                <h4 class="card-title mt-3" id="cardtitle"></h4>
                <div class="meta card-text">
                    <a id="cardsubtitle"></a>
                </div>
                <div class="meta card-text">
                    <a id="fechahora"></a>
                </div>
                <div class="meta card-text">
                    <a id="direccion"></a>
                </div>
            </div>
            <table id="localidadestable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Localidad</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                        <tr>
                        </tr>
            </table>



            <div>
                <h4 id="totaltext"></h4>
            </div>
            <div class="card-footer">
                <button class="btn btn-info float-right btn-sm" onClick="comprar()">Comprar</button>
            </div>
        </div>
    </div>
    <script>
        let id = window.location.href.split("id=")[1].split("?")[0];
        let clientid = window.location.href.split("clientid=")[1];
        var event = {};
        var valueSelected;
        var payed = false;
        $.get("http://localhost:8000/api/eventos/"+id, function(val){
            evet = val;
            $('#cardtitle').text(val[0]['nombre']);
            $('#cardsubtitle').text(val[2]['nombre']);
            let total = 0;
            let i=0;
            var trHTML = '';
            val[1].forEach(function (value){
                //$('#localidades').append('<option value="'+i+'" selected="selected">'+value['nombre']+'</option>');
                //valueSelected = i;
                
                trHTML += '<tr><td>' + i+ '</td><td>' + value['nombre'] + '</td>  <td><button onClick=onClickMasLocalidad('+i+')>+</button></td>   <h4 id="localidad'+i+'">0</h4>    <td><button onClick=onClickMenosLocalidad('+i+')>-</button></td>  </tr>';
                i++;
            });
            $('#localidadestable').append(trHTML);
            total = total+val[1][val[1].length-1]['precio'];
            event.lugar = val[2];
            event.evento = val[0];
            event.localidades = val[1];
            event.localidadesSeleccionadas = val[1];
            let j=0;
            event.localidadesSeleccionadas.forEach(function(lc){
                event.localidadesSeleccionadas[j].cupos = 0;
                j++;
            });
            event.total = total;
            event.cantidad = 1;
            $('#direccion').text("Dirección: "+event.evento.direccion);
            $('#totaltext').text("$Total: "+total);
        });
        $('#localidades').change(function () {
            var optionSelected = $(this).find("option:selected");
            valueSelected  = optionSelected.val();
            var textSelected   = optionSelected.text();
            event.total = 0;
            event.total = event.localidades[valueSelected].precio*event.cantidad
            $('#totaltext').text("$Total: "+event.total);
        });
        function onClickMasLocalidad(index){
            console.log(index);
            let canti = event.localidadesSeleccionadas[index].cupos;
            console.log(canti);
            console.log(event.localidades[index].cupos);
            if(canti<event.localidades[index].cupos){
                event.localidadesSeleccionadas[index].cupos = event.localidadesSeleccionadas[index].cupos+1;
                canti = event.localidadesSeleccionadas[index].cupos;
                $("#localidad"+index).text(canti);
            }else{
                alert("No existen tantos asientos para esta localidad");
            }
            
        } 
        function onClickMenosLocalidad(index){
            console.log(index);
            let canti = event.localidadesSeleccionadas[index].cupos;
            if(canti<event.localidades[index].cupos){
                event.localidadesSeleccionadas[index].cupos = event.localidadesSeleccionadas[index].cupos-1;
                canti = event.localidadesSeleccionadas[index].cupos;
                $("#localidad"+index).text(canti);
            }else{
                alert("No existen tantos asientos para esta localidad");
            }
        } 
        function comprar(){
            console.log(event);
            if (confirm('¿Desea realizar su pago ahora?')) {
                // Save it!
                console.log("pagado");
                payed = true;
                order = {
                    "id_cliente": clientid,
                    "total": event.total,
                    "id_evento": id,
                    "id_localidad": event.localidades[valueSelected].id,
                    "asientos": event.cantidad
                };
            } else {
                // Do nothing!
                alert("Debe pagar para obtener su ticket");
            }
        }
    </script>
</body>
</html>