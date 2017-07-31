hostapi='http://localhost/ESTACIONAMIENTO_2017';


function logout(){ //OK
    var formData = new FormData();
    formData.append("queHago","2");

    $.ajax({
        type:'post',
        url:'administrador.php',
        dataType:'TEXT',
        data:formData,
        contentType:false,
        processData:false,
        async:true
    })
    .done(function(respuesta){
        if(respuesta == "ok"){
            alert("ingreso ok");
            window.location.href="index.php";
        }
        else{
            alert("No se logro cerrar la session");
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown){
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    })
}

function color(){ //ok
    var formData = new FormData();
    formData.append("color",$("#color").val());
    formData.append("queHago","3");

    $.ajax({
        type:'post',
        url:'administrador.php',
        dataType:'TEXT',
        data:formData,
        contentType:false,
        processData:false,
        async:true
    })
    .done(function(respuesta){
         if(respuesta == "ok"){
            alert("ingreso ok");
            window.location.reload(true);
        }
        else{
            alert("Error al asignar color");
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown){
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    })
}

function guardarUsuario() { //OK
    var formData = new FormData();
    formData.append("nombre",$("#nombre").val());
    formData.append("legajo",$("#legajo").val());
    formData.append("tipo",$("#tipo").val());
    formData.append("password",$("#password").val());
    formData.append("turno",$("#turno").val());
    formData.append("estado",$("#estado").val());

    $.ajax({
        type:'post',
        url:hostapi+'/apiRest.php/insertarUsuario',
        dataType:'JSON',
        data:formData,
        contentType:false,
        processData:false,
        async:true
    })
    .done(function(respuesta){ 
        alert(respuesta.Mensaje);
       // window.location.reload(true);
       traerUsuarios();
    })
    .fail(function(jqXHR,textStatus,errorThrown){
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}

function traerUsuarios() { //OK

    $.ajax({
        type:'get',
        url:hostapi+'/apiRest.php/traerUsuarios',
        dataType:'JSON',
        contentType:false,
        processData:false,
        async:true
    })
    .done(function(data){ 
        alert(data);
        //console.log(json);
        tabla="";
        $.each(data, function(i, item) {
            console.log(item);
          
            switch (item.tipo) {
                case 0:
                    tipo="administrador";
                    break;
                case 1:
                    tipo="usuario";
                    break;
                default:
                    break;
            }

            switch (item.turno) {
                case 1:
                    turno="mañana";
                    break;
                case 2:
                    turno="tarde";
                    break;
                case 3:
                    turno="noche";
                    break;
                default:
                    break;
            }
            
            switch (item.estado) {
                case 1:
                    estado="habilitado";
                    boton="<button type='button' class='btn btn-success' onclick='modificarEstado("+item.legajo+",2)'>suspender</button>";
                    break;
                case 2:
                    estado="suspendido";
                    boton="<button type='button' class='btn btn-warning' onclick='modificarEstado("+item.legajo+",1)'>habilitar</button>";
                    break;
                default:
                    break;
            }

            tabla+="<tr>";
                tabla+="<td>"+item.nombre+"</td>";
                tabla+="<td id='leg'>"+item.legajo+"</td>";
                tabla+="<td>"+tipo+"</td>";
                tabla+="<td id='turn'>"+turno+"</td>";
                tabla+="<td>"+estado+"</td>";
                tabla+="<td>";
                tabla+="<button type='button' class='btn btn-danger' onclick='eliminarUsuario("+item.legajo+")'>eliminar</button>";
                tabla+="<button type='button' class='btn btn-primary' data-toggle='collapse' data-target='#modtur' onclick='traerUnUsuario("+item.legajo+")'>modificar</button>";
                tabla+=boton;
                tabla+="</td>";
            tabla+="</tr>";
        });
         $('#traerUs').html(tabla);
        //window.location.reload(true);
    })
    .fail(function(jqXHR,textStatus,errorThrown){
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}

function eliminarUsuario(legajo) { //OK

    $.ajax({
        type:'delete',
        url:hostapi+'/apiRest.php/eliminarUsuario/'+legajo,
        dataType:'JSON',
        contentType:false,
        processData:false,
        async:true
    })
    .done(function(respuesta){ 
        alert(respuesta.Mensaje);
        traerUsuarios();
    })
    .fail(function(jqXHR,textStatus,errorThrown){
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}

////TRAE EL TURNO DEL USUARIO ////
function traerUnUsuario(legajo) { //OK

    $.ajax({
        type:'get',
        url:hostapi+'/apiRest.php/traerUsuario/'+legajo,
        dataType:'JSON',
        data:legajo,
        contentType:false,
        processData:false,
        async:true
    })
    .done(function(json){ 
        alert(json[0]);
        us = json[0];
        $("#legajoMod").val(us.legajo);
        $("#turnoMod").val(us.turno);
        //traerUsuarios();
    })
    .fail(function(jqXHR,textStatus,errorThrown){
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}

function modificarUsuario() { //OK

    var legajo = $("#legajoMod").val();
    var turno = $("#turnoMod").val();

    $.ajax({
        type:'put',
        url:hostapi+'/apiRest.php/modificaUsuario/'+legajo+"/"+turno,
        dataType:'JSON',
        contentType:false,
        processData:false,
        async:true
    })
    .done(function(respuesta){ 
        alert(respuesta.Mensaje);
       // window.location.reload(true);
        traerUsuarios();
    })
    .fail(function(jqXHR,textStatus,errorThrown){
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}

function modificarEstado(legajo,estado) { //OK

   // var legajo = $("#legajoMod").val();
   // var turno = $("#turnoMod").val();

    $.ajax({
        type:'put',
        url:hostapi+'/apiRest.php/modificaEstado/'+legajo+"/"+estado,
        dataType:'JSON',
        contentType:false,
        processData:false,
        async:true
    })
    .done(function(respuesta){ 
        alert(respuesta.Mensaje);
       // window.location.reload(true);
        traerUsuarios();
    })
    .fail(function(jqXHR,textStatus,errorThrown){
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}
/////////////////////////////// ESTACIONAMIENTO //////////////////////////////////////////
function traerPisos() { //OK

   // var legajo = $("#legajoMod").val();
   // var turno = $("#turnoMod").val();

    $.ajax({
        type:'get',
        url:hostapi+'/apiRest.php/traerPisos',
        dataType:'JSON',
        contentType:false,
        processData:false,
        async:true
    })
    .done(function(data){ 
        //alert(data);
        
        tabla="";
        $.each(data, function(i, item) {
            tabla+="<option value='"+item.piso+"'>"+item.piso+"</option>";
        });
        $('#piso').html(tabla);
        traerLugar();
        //traerUsuarios();
    })
    .fail(function(jqXHR,textStatus,errorThrown){
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}

function traerLugar() { //OK

    var piso = $("#piso").val();
   // var turno = $("#turnoMod").val();

    $.ajax({
        type:'get',
        url:hostapi+'/apiRest.php/traerLugar/'+piso,
        dataType:'JSON',
        contentType:false,
        processData:false,
        async:true
    })
    .done(function(data){ 
        //alert(data);
        
        tabla="";
        $.each(data, function(i, item) {
            tabla+="<option value='"+item.lugar+"'>"+item.lugar+"</option>";
        });
        $('#lugar').html(tabla);
        //$('#lugar').reload();
        //traerUsuarios();
    })
    .fail(function(jqXHR,textStatus,errorThrown){
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}

function traerEstacionamiento() { //OK

    $.ajax({
        type:'get',
        url:hostapi+'/apiRest.php/traerEstacionamiento',
        dataType:'JSON',
        contentType:false,
        processData:false,
        async:true
    })
    .done(function(data){ 
        //alert(data);
        
        tabla="";
        $.each(data, function(i, item) {
            switch (item.ocupado) {
                case 1:
                    ocupado="ocupado";
                    break;
                case 0:
                    ocupado="libre";
                    break;
                default:
                    break;
            }

            switch (item.discapacitado) {
                case 0:
                    discapacitado="playa comun";
                    break;
                case 1:
                    discapacitado="playa discapacitados";
                    break;
                default:
                    break;
            }
            tabla+="<tr>";
                tabla+="<td>"+item.piso+"</td>";
                tabla+="<td id='leg'>"+item.lugar+"</td>";
                tabla+="<td id='leg'>"+ocupado+"</td>";
                tabla+="<td id='leg'>"+discapacitado+"</td>";
            tabla+="<tr>";
        });
        $('#traerEs').html(tabla);
        //traerLugar();
        //traerUsuarios();
    })
    .fail(function(jqXHR,textStatus,errorThrown){
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}

/////////////////////////////// AUTO ///////////////////////////////
function guardarAuto() { //OK
    var formData = new FormData();
    formData.append("marca",$("#marca").val());
    formData.append("patente",$("#patente").val());
    formData.append("color",$("#color").val());
    //formData.append("piso",$("#piso").val());
    formData.append("lugar",$("#lugar").val());

    $.ajax({
        type:'post',
        url:hostapi+'/apiRest.php/insertarauto',
        dataType:'JSON',
        data:formData,
        contentType:false,
        processData:false,
        async:true
    })
    .done(function(respuesta){ 
        alert(respuesta.Mensaje);
        window.location.reload(true);
       
    })
    .fail(function(jqXHR,textStatus,errorThrown){
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}