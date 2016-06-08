function setCookie(cname, cvalue, exdays) {
  var d = new Date()
  d.setTime(d.getTime() + (exdays*24*60*60*1000))
  var expires = "expires="+ d.toUTCString()
  document.cookie = cname + "=" + cvalue + "; " + expires
}

function getCookie(cname) {
  var name = cname + "="
  var ca = document.cookie.split(';')
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i]
    while (c.charAt(0)==' ') {
      c = c.substring(1)
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length,c.length)
    }
  }
  return ""
}

function validateEmail(email) {
  return (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))?true:false
}

function createNotice(noticeElement, noticeType, noticeMsg) {
  var obj = document.getElementById(noticeElement)
  var newDiv = document.createElement('div')
  newDiv.setAttribute('class', (noticeType==1?'am-alert am-alert-success':'am-alert am-alert-danger'))
  newDiv.setAttribute('data-am-alert', '')
  var newCloseButton = document.createElement('button')
  newCloseButton.setAttribute('type', 'button')
  newCloseButton.setAttribute('class', 'am-close')
  newCloseButton.innerHTML = '&times;'
  var newMsg = document.createElement('p')
  newMsg.innerHTML = noticeMsg
  newDiv.appendChild(newCloseButton)
  newDiv.appendChild(newMsg)
  obj.insertBefore(newDiv, obj.childNodes[0])
  if (noticeType == 1) {
    clearElementByClass('am-form')
    var newPara = document.createElement('p')
    newPara.setAttribute('style', 'text-align:center')
    newPara.innerHTML = '<a href="index.php">Book a cab now!</a>'
    obj.appendChild(newPara)
  }
}

function clearElementByClass(cname) {
  var oldE = document.getElementsByClassName(cname)
  while (oldE.length > 0) {
    oldE[0].parentNode.removeChild(oldE[0])
  }
}

function createRequest() {
  var xhr = false
  if (window.XMLHttpRequest) {
    xhr = new XMLHttpRequest()
  } else if (window.ActiveXObject) {
    xhr = new ActiveXObject("Microsoft.XMLHTTP")
  }
  return xhr;
}

function signup() {
  var noticeElement = 'signupform'
  var email = document.getElementById('email').value
  var psw = document.getElementById('password').value
  var cpsw = document.getElementById('cpassword').value
  var xhr = createRequest()
  if (validateSignup(noticeElement, email, psw, cpsw) && xhr) {
    var processFile = 'processSignup.php'
    var requestbody = 'email=' + encodeURIComponent(email) + '&psw=' + encodeURIComponent(psw)
    xhr.open('POST', processFile, true)
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var response = xhr.responseText;
        if (response == 2) {
          createNotice(noticeElement, 1, 'You signed up successfully!')
        } else if (response == 1) {
          createNotice(noticeElement, 0, 'Something went wrong, please try again!')
        } else {
          createNotice(noticeElement, 0, 'E-mail already exists!')
        }
      }
    }
    xhr.send(requestbody)
  }
}

function validateSignup(noticeElement, email, psw, cpsw) {
  var signupValid = true
  clearElementByClass('am-alert')
  if (!email || !validateEmail(email)) {
    createNotice(noticeElement, 0, 'The E-mail you entered is invalid!')
    signupValid = false
  }
  if (!psw || !cpsw) {
    createNotice(noticeElement, 0, 'The password cannot be empty!')
    signupValid = false
  }
  if (psw != cpsw) {
    createNotice(noticeElement, 0, 'Password does not match confirm password!')
    signupValid = false
  }
  return signupValid
}

function login() {
  clearElementByClass('am-alert')
  var noticeElement = 'loginform'
  var email = document.getElementById('email').value
  var psw = document.getElementById('password').value
  var xhr = createRequest()
  if (!validateEmail(email)){
    createNotice(noticeElement, 0, 'The E-mail you entered is invalid!')
  } else if (!email || !psw) {
    createNotice(noticeElement, 0, 'All fields must be filled!')
  } else {
    if (xhr) {
      var processFile = 'processLogin.php'
      var requestbody = 'email=' + encodeURIComponent(email) + '&psw=' + encodeURIComponent(psw)
      xhr.open('POST', processFile, true)
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          var response = xhr.responseText;
          if (response == 2) {
            window.location = 'booking.htm'
          } else if (response == 1) {
            createNotice(noticeElement, 0, 'Password is wrong, please try again!')
          } else {
            createNotice(noticeElement, 0, 'E-mail does not exist!')
          }
        }
      }
      xhr.send(requestbody)
    }
  }
}

function bookingOnLoad() {
  if (!getCookie('wd_is_loggedin')) {
    window.location = 'index.php'
  }
  if (getCookie('wd_is_admin') != '1') {
    var thisE = document.getElementById('adminlink')
    thisE.parentElement.removeChild(thisE)
  }
  document.getElementById('user').value = getCookie('wd_user')
}

function booking() {

}
