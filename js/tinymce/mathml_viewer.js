//-------------------------------------------------------------
//	Created by: Ionel Alexandru
//	Mail: ionel.alexandru@gmail.com
//	Site: www.fmath.info
//---------------------------------------------------------------

//---------------------------------------------------------------
//  Configuration
//---------------------------------------------------------------
var urlViewer = "/mathml/mathmlViewer.swf";

// this method is called when click "Edit Formula ..."
function editMathML(htmlId, mathml){
	alert("Here you can display the editor.\nParamters: \n- Id of component is:" + htmlId+";\n- mathml:\n"+mathml);
}



//---------------------------------------------------------------
var nbFlash = 0;
var flashMathML = new Array();

if (window.addEventListener){ // W3C standard
  window.addEventListener('load', fmath_searchAndReplace, false);
}else if (window.attachEvent){ // Microsoft
  window.attachEvent('onload', fmath_searchAndReplace);
}

String.prototype.trim = function(){ return this.replace(/^\s+|\s+$/g,'');}

function fmath_searchAndReplace(){
	var list=document.getElementsByTagName("m:math");
	fmath_replaceAllTags(list)
	list=document.getElementsByTagName("math");
	fmath_replaceAllTags(list);
	list=document.getElementsByTagName("latex");
	fmath_replaceAllTags(list);
}

function fmath_replaceAllTags(list){
	var size = list.length;
	for(var i=0; i<size; i++){
		fmath_replaceTag(list[0]);
	}
}


function fmath_replaceTag(mathmlTag){
	if(mathmlTag==null) return;
	// delete attributes class and id
	fmath_deleteAttributesForNode(mathmlTag);

	var mathmlText = fmath_getMathMLString(mathmlTag.parentNode.innerHTML);
	if(mathmlText.indexOf("<canvas")>-1){
		mathmlText = "<math mathsize='20'><merror><mtext>FMath Google Extension have changed the mathml. Click on button 'Render ...'</mtext></merror></math>"
	}
	var fVars = "n=1";
	var parent = mathmlTag.parentNode;
	var menu = parent.getAttribute("editable");
	if(menu!=null){
		fVars = fVars + "&menuType=true";
	}
	var color = parent.getAttribute("defaultColor");
	if(color!=null){
		fVars = fVars + "&defaultColor="+color;
	}
	var bgcolor = parent.getAttribute("defaultBackground");
	if(bgcolor!=null){
		fVars = fVars + "&defaultBackground="+bgcolor;
	}
	var size = parent.getAttribute("defaultSize");
	if(size!=null){
		fVars = fVars + "&defaultSize="+size;
	}
	var font = parent.getAttribute("defaultFont");
	if(font!=null){
		fVars = fVars + "&defaultFont="+font;
	}

	nbFlash = fmath_getNextId();
	var id = parent.getAttribute("id");
	if(id==null || id==""){
		id = "F" + nbFlash;
	}
	fVars = "htmlId=" + id+"&" + fVars;
	parent.setAttribute("id", "Div" + id);

	parent.style.width=10;
	parent.style.height=10;
	parent.innerHTML = fmath_getFlash(urlViewer, '10', '10', id, fVars);

	parent.style.display="inline-block";
	parent.style.zIndex=0;
	flashMathML[id] = mathmlText;
}

function getMathML(name){
	return flashMathML[name];
}

function fmath_getFlash(flashUrl, w, h, name, vars){
	return '<OBJECT classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" name="'+name+'" id="'+name+'" width="'+w+'" height="'+h+'" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" align="middle"><param name=wmode value="transparent"><PARAM NAME=FlashVars VALUE="'+vars+'"><PARAM NAME="allowScriptAccess" VALUE="always"><PARAM NAME="allowFullScreen" VALUE="true"><PARAM NAME="movie" VALUE="'+flashUrl+'"><PARAM NAME="loop" VALUE="false"><PARAM NAME="quality" VALUE="high"><PARAM NAME="bgcolor" VALUE="#ffffff"><embed src="'+flashUrl+'" wmode="transparent" loop="false" quality="high" bgcolor="#ffffff" width="'+w+'" height="'+h+'" name="'+name+'" id="'+name+'" swliveconnect=true  allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" align="middle" FlashVars="'+vars+'"/></OBJECT>';
}

function fmath_getNextId(){
	do{
		nbFlash = nbFlash + 1;
	}while( getElement("F"+nbFlash) != null || getElement("Div"+nbFlash) != null);

	return nbFlash;
}

function resizeFlash(name, w, h){
	var fl = getSWF(name);
	fl.width = parseFloat(w);
	fl.height = parseFloat(h);

	var obj = getElement("Div" + name);
	obj.style.width = parseFloat(w);
	obj.style.height = parseFloat(h);

	// this is for opera bug display
	var div = getElement("bugWindowId");
	if(div!=null){
		document.body.removeChild(div);
	}
	div = document.createElement('div');
	div.setAttribute("id", "bugWindowId");
	div.style.position = "absolute";
	div.style.width=1000;
	div.style.height=1000;
	div.style.zIndex=-1;
	document.body.appendChild(div);
	setTimeout('fmath_operabug()', 100);
}

function fmath_operabug(){
	var div = getElement("bugWindowId");
	div.style.display = "none";
}

function fmath_getMathMLString(text){
	text = text.trim();
	if(text.indexOf("<?")==0){
		text = text.substring(text.indexOf("/>") + 2);
	}

	text = text.replace(/\n/g,"");
	text = text.replace(/m:m/g,"m");

	return text;
}


function getElement(id) {
	return document.getElementById ? document.getElementById(id) : document.all[id];
}

function getSWF(movieName) {
	if (navigator.appName.indexOf("Microsoft") != -1) {
	return document.getElementById(movieName);
	}else {
		if (document.embeds && document.embeds[movieName]){
			return document.embeds[movieName];
		}
		if(document[movieName]!=null && document[movieName].length != undefined){
			return document[movieName][1];
		}
		return document[movieName];
	}
}


function fmath_deleteAttributesForNode(node){
	if(node.nodeType!=1) return;

	node.removeAttribute("class");
	//node.removeAttribute("id");
	//node.removeAttribute("dir");
	for(var i=0; i<node.childNodes.length; i++){
		fmath_deleteAttributesForNode(node.childNodes[i]);
	}
}
