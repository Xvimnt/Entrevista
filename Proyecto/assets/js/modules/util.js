/* Documento con validaciones numericas y alfabeticas para inputs
actualizado por el Capitan de Artilleria Manuel Francisco sosa Azurdia
Farasi, Septiembre de 2020 */

//funcion para Numeros Enteros
	function enteros(n){
		permitidos=/[^0-9]/;
		cadena = n.value;
		band = false;
		for (i=0;i<cadena.length;i++){
			letra = cadena.substring(i,i + 1);
			if(permitidos.test(letra)){
				cadena2 = cadena;
				cadena = cadena2.replace(letra,"");
				band = true;
			}
		}
		var cont = 0;
		for (i=0;i<cadena.length;i++){
			letra = cadena.substring(i,i + 1);
			if(letra === "-"){
				cont++;
				if(cont > 1){
					cadena2 = cadena;
					cadena = cadena2.substring(0,cadena.length-1);
					break;
				}
			}
		}
		if(band === true){
			n.value = cadena;
		}
	}

	function enterosNegativos(n){
		permitidos=/[^0-9-]/;
		cadena = n.value;
		band = false;
		for (i=0;i<cadena.length;i++){
			letra = cadena.substring(i,i + 1);
			if(permitidos.test(letra)){
				cadena2 = cadena;
				cadena = cadena2.replace(letra,"");
				band = true;
			}
		}
		var cont = 0;
		for (i=0;i<cadena.length;i++){
			letra = cadena.substring(i,i + 1);
			if(letra === "-"){
				cont++;
				if(cont > 1){
					cadena2 = cadena;
					cadena = cadena2.substring(0,cadena.length-1);
					break;
				}
			}
		}
		if(band === true){
			n.value = cadena;
		}
	}


//funcion para Numeros decimales
	function decimales(n){
		permitidos=/[^0-9.]/;
		cadena = n.value;
		band = false;
		for (i=0;i<cadena.length;i++){
			letra = cadena.substring(i,i + 1);
			if(permitidos.test(letra)){
				cadena2 = cadena;
				cadena = cadena2.replace(letra,"");
				band = true;
			}
		}
		var cont = 0;
		var cont2 = 0;
		for (i=0;i<cadena.length;i++){
			letra = cadena.substring(i,i + 1);
			if(letra === "."){
				cont++;
				if(cont > 1){
					cadena2 = cadena;
					cadena = cadena2.substring(0,cadena.length-1);
					break;
				}
			}
			if(letra === "-"){
				cont2++;
				if(cont2 > 1){
					cadena2 = cadena;
					cadena = cadena2.substring(0,cadena.length-1);
					break;
				}
			}
		}
		n.value = cadena;
	}

//funcion para validar caracteres del texto y cantidad maxima de caracteres
	function texto(n){
		cadena = n.value;
		band = false;
		puntoycoma = false;
		max = false;
		if(cadena.length <= 250){
			for (i=0;i<cadena.length;i++){
				letra = cadena.substring(i,i + 1);
				if((letra === "'") || (letra === '"') || (letra === '`') || (letra === '�')|| (letra === '�')|| (letra === '�')|| (letra === '�')|| (letra === '�')|| (letra === '�')|| (letra === '�')|| (letra === '�')|| (letra === '�')|| (letra === '�')){
					cadena2 = cadena;
					cadena = cadena2.replace(letra,"");
					band = true;
				}
				if(letra === ";"){
					cadena2 = cadena;
					cadena = cadena2.replace(letra,". ");
					puntoycoma = true;
				}
			}
		}else{
			max = true;
		}
		if(max === false){
			if(band === true){
				swal("", "No se permiten ingresar comillas simples o dobles, ni letras con tildes u otro caracter desconocido...", "info");
				n.value = cadena;
			}
			if(puntoycoma === true){
				n.value = cadena;
			}
		}else{
			swal("", "El m\u00E1ximo de caracteres en este campo son 250...", "info");
			cadena = cadena.substring(0,250);
			n.value = cadena;
		}
		return;
	}

	function textoLargo(n){
		cadena = n.value;
		band = false;
		puntoycoma = false;
		for (i=0;i<cadena.length;i++){
			letra = cadena.substring(i,i + 1);
			if((letra === "'") || (letra === '"') || (letra === '`') || (letra === '�')|| (letra === '�')|| (letra === '�')|| (letra === '�')|| (letra === '�')|| (letra === '�')|| (letra === '�')|| (letra === '�')|| (letra === '�')|| (letra === '�')){
				cadena2 = cadena;
				cadena = cadena2.replace(letra,"");
				band = true;
			}
			if(letra === ";"){
				cadena2 = cadena;
				cadena = cadena2.replace(letra,". ");
				puntoycoma = true;
			}
		}
		if(band === true){
			swal("", "No se permiten ingresar comillas simples o dobles, ni letras con tildes u otro caracter desconocido...", "info");
			n.value = cadena;
		}
		if(puntoycoma === true){
			n.value = cadena;
		}
		return;
	}

	function maximoLargo(n,textlargo){
		var largo = parseFloat(textlargo);
		cadena = n.value;
		band = false;
		puntoycoma = false;
		max = false;
		if(cadena.length > largo){
			swal("", "El m\u00E1ximo de caracteres en este campo son "+textlargo+"...", "info");
			cadena = cadena.substring(0,textlargo);
			n.value = cadena;
		}
		return;
	}

//funcion para recibir solo letras
	function letras(n){
			permitidos=/[^a-zA-Z]/;
			cadena = n.value;
			band = false;
			for (i=0;i<cadena.length;i++){
				letra = cadena.substring(i,i + 1);
				if(permitidos.test(letra)){
					cadena2 = cadena;
					cadena = cadena2.replace(letra,"");
					band = true;
				}
			}
			if(band === true){
				n.value = cadena;
			}
	}

///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////
/////////////// METODOS PROPIOS ////////////////////////////////////////

	function KeyEnter(inp,Accion){
		inp.onkeypress = function(e){
		if (!e) e = window.event;   // resolve event instance
			if (e.keyCode === 13){
				Accion();
				return;
			}
		}
	}

	function validarEmail(valor) {
		var filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(valor.value === '' || valor.value === ' ' || valor.value === '  '){
			return true;
		}else{
			if (filtro.test(valor)){
				return true;
			} else {
				return false;
			}
		}
	}

	function MonedaTipoCambio(de,para,cuanto){
		var dato = parseFloat(de) * parseFloat(cuanto);
		dato = parseFloat(dato)/parseFloat(para);
		dato = parseFloat(dato) * 100;//-- inicia proceso de redondeo
		dato = Math.round(dato); //javascript redondea solo enteros (hay que multiplicar y dividir por 100 durante el redondeo)
		dato = parseFloat(dato)/100;//-- finaliza proceso de redondeo
		return dato;
	}


//////------ Check's de Listas -----------//////////

	function check_lista_multiple(nombre){
		chkbase = document.getElementById(nombre+"base");
		var filas = parseInt(document.getElementById(nombre+"rows").value);
		//alert(inicia+"-"+cuantos);
		if(chkbase.checked) {
			for(var i = 1; i <= filas; i++){
				document.getElementById(nombre+i).checked = true;
			}
		}else{
			for(var i = 1; i <= filas; i++){
				document.getElementById(nombre+i).checked = false;
			}
		}
	}


///////// VALIDAR INPUT FORMATO FECHA //////////////////////////////
	function validaFechaDDMMAAAA(cadena){

		fec = cadena.split("/");
		bandera = false;
		dia = fec[0];
		mes = fec[1];
		anio = fec[2];
		//--
		anio = (isNaN(fec[2]))?0:anio;
		//alert(dia+"/"+mes+"/"+anio);
		if (dia !== "" && (parseInt(dia) < 1 || parseInt(dia) > 31 || dia.length > 2)) {
			bandera = true;
		}
		if (mes !== "" && (parseInt(mes) < 1 || parseInt(mes) > 12 || mes.length > 2)) {
			bandera = true;
		}
		if (anio !== "" && (parseInt(anio) < 1901 || parseInt(anio) > 2050 || anio.length !== 4)) {
			bandera = true;
		}
		if (bandera === true) {
			return false;
		}else{
			return true;
		}
	}


	function tiene_numeros(texto){
		var numeros="0123456789";
		for(i=0; i<texto.length; i++){
			if (numeros.indexOf(texto.charAt(i),0)!==-1){
				return 1;
			}
		}
		return 0;
	}


	function tiene_letras(texto){
		var letras="abcdefghyjklmn�opqrstuvwxyz";
		texto = texto.toLowerCase();
		for(i=0; i<texto.length; i++){
			if (letras.indexOf(texto.charAt(i),0)!==-1){
				return 1;
			}
		}
		return 0;
	}


	function tiene_minusculas(texto){
		var letras="abcdefghyjklmn�opqrstuvwxyz";
		for(i=0; i<texto.length; i++){
			if (letras.indexOf(texto.charAt(i),0)!==-1){
				return 1;
			}
		}
		return 0;
	}


	function tiene_mayusculas(texto){
		var letras_mayusculas="ABCDEFGHYJKLMN�OPQRSTUVWXYZ";
		for(i=0; i<texto.length; i++){
			if (letras_mayusculas.indexOf(texto.charAt(i),0)!==-1){
				return 1;
			}
		}
		return 0;
	}
