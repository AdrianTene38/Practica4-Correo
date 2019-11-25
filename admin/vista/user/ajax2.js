function buscarC2(codigo){
    var correo = document.getElementById("correoBuscar").value;
    if(correo == ""){
        document.getElementById("informacion").innerHTML = document.getElementById("buzon");
    }else {
        if (window.XMLHttpRequest){
            //code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            //Code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("informacion").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","buscar2.php?codigo="+codigo+"&correo="+correo,true);
        xmlhttp.send();
    }

}