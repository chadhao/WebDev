// JavaScript Document

function makeTable(){
	var theTable =document.getElementById("tbl");
	//IE requires rows to be added to a tBody element
	//IE automatically creates a tBody element - delete it and then manually create
	if (theTable.firstChild != null){
		var badIEBody = theTable.childNodes[0];  
		theTable.removeChild(badIEBody);
	}
	var tBody = document.createElement("TBODY");
	theTable.appendChild(tBody);

	var newRow = document.createElement("tr");
	var c1 = document.createElement("td");
	var v1 = document.createTextNode("7308");
	c1.appendChild(v1);
	newRow.appendChild(c1);
	var c2 = document.createElement("td");
	var v2 = document.createTextNode("software engineering");
	c2.appendChild(v2);
	newRow.appendChild(c2);
	tBody.appendChild(newRow);

	newRow = document.createElement("tr");
	c1 = document.createElement("td");
	v1 = document.createTextNode("7003");
	c1.appendChild(v1);
	newRow.appendChild(c1);
	c2 = document.createElement("td");
	v2 = document.createTextNode("Web Development");
	c2.appendChild(v2);
	newRow.appendChild(c2);
	tBody.appendChild(newRow);
}

function appendRow() {
	var c1_value = prompt("Please enter column 1 value", "1234");
	var c2_value = prompt("Please enter column 2 value", "Programming 1");
	var color = prompt("Please enter row color", "red");
	
	var theTable = document.getElementById("tbl");
	var tBody = document.createElement("TBODY");
	theTable.appendChild(tBody);
	
	var newRow = document.createElement("tr");
	var c1 = document.createElement("td");
	var v1 = document.createTextNode(c1_value);
	c1.appendChild(v1);
	newRow.appendChild(c1);
	var c2 = document.createElement("td");
	var v2 = document.createTextNode(c2_value);
	c2.appendChild(v2);
	newRow.appendChild(c2);
	
	newRow.style.backgroundColor = color;
	tBody.appendChild(newRow);
}
