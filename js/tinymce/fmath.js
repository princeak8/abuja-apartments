function displayLatexFormulaJs(name) {
	var textarea = document.getElementById("T" + name);
	drawLatexFormulaOnCanvas("C" + name, textarea.value);
}
function displayFormulaJs(name) {
	var textarea = document.getElementById("T" + name);
	drawFormulaOnCanvas("C" + name, textarea.value);
}
function drawLatexFormulaOnCanvas( id, latex){
	var c=document.getElementById(id);
	if(c==null) return;
	var formula = new FMATH.MathMLFormula();
	var mathml = formula.convertLatexToMathML(latex)
	//alert(mathml);
	formula.drawImage(c, mathml);
}
function drawFormulaOnCanvas( id, mathml){
	var c=document.getElementById(id);
	if(c==null) return;
	var formula = new FMATH.MathMLFormula();
	formula.drawImage(c, mathml);
}
function displayFormulaFlash(source, dest) {
	var textarea = document.getElementById(source);
	var swf = getSWF(dest);
	try{
		swf.setMathML(textarea.value);
	}catch(e){
		// this is for Firefox and Opera
		swf = swf.childNodes[8];
		swf.setMathML(textarea.value);
	}
}

function displayLatexFormulaFlash(source, dest) {
	var textarea = document.getElementById(source);
	var swf = getSWF(dest);
	var latex = textarea.value;
	try{
		swf.setLaTeX(latex);
	}catch(e){
		// this is for Firefox and Opera
		swf = swf.childNodes[8];
		swf.setLaTeX(latex);
	}
}

function exportToWord(sourceId, fileName){
	var textarea = document.getElementById(sourceId);

	var formula = new FMATH.MathMLFormula();
	formula.downloadWordFromMathML(textarea.value, fileName);
}

