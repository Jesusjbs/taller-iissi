function valida() {
    var error1 = validarFechaMenorActual();
    return (error1.length == 0 );
}

function validarFechaMenorActual(){

    var fechaCita = document.getElementById("id_dia");
    var valor = fechaCita.value;
    var x=new Date();
    var fecha = valor.split("/");
    x.setFullYear(fecha[2],fecha[1]-1,fecha[0]);
	var today = new Date();
	
    if (x < today) var error= 'La fecha elegida tiene que ser posterior a la del dia de hoy.';
    else    var error = '';
    fechaCita.setCustomValidity(error);
    return error;

}
/*function validarFecha(fecha) {  
      
     try{        
	     var fecha = fecha.split("/");        
	     var dia = fecha[0];        
	     var mes = fecha[1];        
	     var ano = fecha[2];        
	     var estado = true;  
	      
	     if ((dia.length == 2) && (mes.length == 2) && (ano.length == 4)) {        
		     switch (parseInt(mes)) {        
			     case 1:dmax = 31;break;        
			     case 2: if (ano % 4 == 0) dmax = 29; else dmax = 28;        
			     break;        
			     case 3:dmax = 31;break;        
			     case 4:dmax = 30;break;        
			     case 5:dmax = 31;break;        
			     case 6:dmax = 30;break;        
			     case 7:dmax = 31;break;        
			     case 8:dmax = 31;break;        
			     case 9:dmax = 30;break;        
			     case 10:dmax = 31;break;       
			     case 11:dmax = 30;break;      
			     case 12:dmax = 31;break;       
		     }  
	           
		     dmax!=""?dmax:dmax=-1;if ((dia >= 1) && (dia <= dmax) && (mes >= 1) && (mes <= 12)) {        
		     for (var i = 0; i < fecha[0].length; i++) {         
			     diaC = fecha[0].charAt(i).charCodeAt(0);        
			     (!((diaC > 47) && (diaC < 58)))?estado = false:'';       
			     mesC = fecha[1].charAt(i).charCodeAt(0);        
			     (!((mesC > 47) && (mesC < 58)))?estado = false:'';       
		     }  
	      
	     } for (var i = 0; i < fecha[2].length; i++) {  
	      
	     anoC = fecha[2].charAt(i).charCodeAt(0);  
	      
	     (!((anoC > 47) && (anoC < 58)))?estado = false:'';        
	     }} else estado = false;        
	     return estado;    
         
    }catch(err){  
     alert("Error fechas");   
}*/ 