// file simpleajax.js
var xhr = createRequest();
function getData(dataSource, divID, aName, aPwd)  {
    if(xhr) {
	    var obj = document.getElementById(divID);
      var requestbody = "name=" + encodeURIComponent(aName) + "&pwd=" + encodeURIComponent(aPwd);
	    xhr.open("POST", dataSource, true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	    xhr.onreadystatechange = function() {
			    if (xhr.readyState == 4 && xhr.status == 200) {
              var response = xhr.responseText;
              if (response == '1') {
                  alert("Name does not exist in database!");
              } else if (response == '2') {
                  alert("Password is incorrect!");
              } else {
                  obj.innerHTML = xhr.responseText;
              }
		      } // end if
	    } // end anonymous call-back function
	    xhr.send(requestbody);
	} // end if
} // end function getData()
