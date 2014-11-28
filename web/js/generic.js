
function inici() {
	document.getElementById('dins').style.width="100%";
	document.getElementById('dins').style.width="40%";
	window.setTimeout("inici2()",100);
}
function inici2() {

	if(document.body.clientWidth < 840) {
		var e=document.getElementById("menu");
		e.style.left="395px";
		var elms=e.getElementsByTagName("li");
		for (i in elms) {
			if (elms[i].className=="actiu") elms[i].style.marginRight="20px";
		}
		document.getElementById("icones").style.left="428px";
	}

	if (document.getElementById("nofix").offsetWidth>document.getElementById("nofix").clientWidth) {
		document.getElementById("contingut").style.marginLeft = "60px";
		document.getElementById("contingut").style.width = "410px";
	}

	if (document.getElementById("nofix").offsetHeight>document.getElementById("nofix").clientHeight) {
		document.getElementById("fix_baix").style.bottom = "15px";
		document.getElementById("icones").style.bottom = "10px";
	}
	var elm=document.getElementById("contingut");
}

function arreglarFormulari(frm)
{
	for (elm in frm.elements) {
		if (frm.elements[elm].type=="checkbox") {
			if (!frm.elements[elm].checked) {
				frm.elements[elm].value=0;
				frm.elements[elm].checked=true;
			}
		}
	}
}

function ferError(str_err,frm,camp) {
	alert(str_err);
	if ((frm==null)||(camp==null)) return (false);
	frm.elements[camp].focus();
	return (false);
}

function validarObligat(frm,camp,max,min) {
	var el=frm.elements[camp];
	if (el==null) return(false);
	var  n=el.value;
	if (n=='') return ("el valor no pot ser buit");
	if ((max!=null) && (n.length>max)) return ("el valor no pot tenir més de "+max+" caràcters");
	if ((min!=null) && (n.length<min)) return ("el valor no pot tenir menys de "+min+" caràcters");
	return (false);
}

function validarDataCurta(frm,camp) {
	var el=frm.elements[camp];
	if (el==null) return(false);
	var  n=el.value;
	if (n=="") return (false);
	var punts=0;
	for (var i=0;i<n.length; i++) if (n.charAt(i)=='.') punts++;
	if (punts!=2) return ("el format ha de ser dia.mes.any");
	var dia="";
	var mes="";
	var any="";
	punts=0;
	for (var i=0;i<n.length; i++) {
		var c = n.charAt(i);
		if (c=='.') punts++;
		else {
			var es_digit=((c=='0')||(c=='1')||(c=='2')||(c=='3')||(c=='4')
				||(c=='5')||(c=='6')||(c=='7')||(c=='8')||(c=='9'));
			if (!es_digit) return ("ha de ser en el format dia.mes.any i no pot contenir cap més símbol que el punt i els números");
			if (punts==0) { if (dia!="" || c!="0") dia += c; }
			else if (punts==1) { if (mes!="" || c!="0") mes += c; }
			else { if (any!="" || c!="0") any += c; }
		}
	}
	if (dia=="") return ("el dia no és correcte");
	if (mes=="") return ("el mes no és correcte");
	if (any=="") return ("l'any no és correcte");
	dia=parseInt(dia);
	mes=parseInt(mes);
	any=parseInt(any);
	if ((dia==0)||(dia>31)) return ("el dia no és correcte");
	if ((mes==0)||(mes>12)) return ("el mes no és correcte");
	if ((any<1000)||(any>2100)) return ("l'any no és correcte - ha de ser de 4 xifres");
	if (dia<10) data="0"+dia+".";
	else data=dia + ".";
	if (mes<10) data += "0" + mes + ".";
	else data += mes + ".";
	data += any;
	if (n!=data) el.value=data;
	return (false);
}

function validarNumero(frm,camp,decimals,max,min) {
	var el=frm.elements[camp];
	var  n=el.value;
	if (n=="") n="0";
	if (n.indexOf(",")>=0) {
		n=n.replace(",",".");
		frm.elements[camp].value=n;
	}
	var num_decimals=0;
	var es_decimal=false;
	for (var i=0;i<n.length; i++) {
		var c = n.charAt(i);
		var es_digit=((c=='0')||(c=='1')||(c=='2')||(c=='3')||(c=='4')
			||(c=='5')||(c=='6')||(c=='7')||(c=='8')||(c=='9'));
		var es_simbol=(c=='.');
		if (!es_digit && !es_simbol) return ("el valor no és un número");
		if (es_simbol && es_decimal) return ("el valor té més d'un símbol decimal (. o ,)");
		if (es_simbol) es_decimal=true;
		else if (es_decimal) num_decimals++;
		if (num_decimals>decimals) {
			if (decimals==0) return ("el valor no és un número enter"); 
			else return ("el valor no pot tenir més de "+decimals+ " xifres decimals");
		}
	}
	n = parseFloat(n);
	if ((max!=null) && (n>max)) return ("el valor no pot ser superior a "+max);
	if ((min!=null) && (n<min)) return ("el valor no pot ser inferior a "+min);
	if (n==0) el.value="";
	return (false);
}

function validarMail(frm,camp,str_err) {
	l = str.length;
	at=str.indexOf("@");
	lastdot = str.lastIndexOf(".");
	if (at < 1 || (lastdot > l-3) || (lastdot-at < 2)) 
	return false;
}