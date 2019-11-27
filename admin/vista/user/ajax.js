function buscarC(codigo){
    var motivo = document.getElementById("buscarMotivo").value;
    if(motivo == ""){
        document.getElementById("informacion").innerHTML = "";
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
        xmlhttp.open("GET","buscar.php?codigo="+codigo+"&motivo="+motivo,true);
        xmlhttp.send();
    }

}