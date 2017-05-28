function login() {
    var formData = new FormData();
    formData.append("txtNombre",$("#txtNombre").val());
    formData.append("txtPassword",$("#txtPassword").val());
    formData.append("queHago","1");

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
            window.location.href="home.php";
        }
        else{
            alert("No se pudo redirigir");
        }
    })
    .fail(function(jqXHR,textStatus,errorThrown){
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}

function logout(){
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

function color(){
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