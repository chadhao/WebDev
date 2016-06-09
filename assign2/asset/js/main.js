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

function toTitleCase(str)
{
  return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase()})
}

function validateEmail(email) {
  return (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))?true:false
}

function isInt(value) {
  if (isNaN(value)) {
    return false
  }
  var x = parseFloat(value)
  return (x | 0) === x
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

function createPanel(noticeElement, noticeMsg) {
  var obj = document.getElementById(noticeElement)
  while (obj.firstChild) {
    obj.removeChild(obj.firstChild);
  }
  obj.innerHTML = noticeMsg
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
  clearElementByClass('am-alert')
  var noticeElement = 'signupform'
  var email = document.getElementById('email').value
  var psw = document.getElementById('password').value
  var cpsw = document.getElementById('cpassword').value
  var name = toTitleCase(document.getElementById('name').value)
  var phone = document.getElementById('phone').value
  var xhr = createRequest()
  if (validateSignup(noticeElement, email, psw, cpsw) && xhr) {
    var processFile = 'processSignup.php'
    var requestbody = 'email=' + encodeURIComponent(email) + '&psw=' + encodeURIComponent(psw) + '&name=' + encodeURIComponent(name) + '&phone=' + encodeURIComponent(phone)
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

function validateSignup(noticeElement, email, psw, cpsw, name, phone) {
  var signupValid = true
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
  if (!isInt(phone) || !phone) {
    createNotice(noticeElement, 0, 'Phone number is invalid!')
    signupValid = false
  }
  if (!name) {
    createNotice(noticeElement, 0, 'Name cannot be empty!')
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
  document.getElementById('email').value = getCookie('wd_email')
}

function adminOnLoad() {
  if (!getCookie('wd_is_admin')) {
    window.location = 'index.php'
  }
}

function booking() {
  clearElementByClass('am-alert')
  var noticeElement = 'bookingform'
  var user = document.getElementById('user').value
  var email = document.getElementById('email').value
  var p_unitno = document.getElementById('p-unitno').value
  var p_streetno = document.getElementById('p-streetno').value
  var p_streetname = toTitleCase(document.getElementById('p-streetname').value)
  var p_suburb = toTitleCase(document.getElementById('p-suburb').value)
  var p_time = document.getElementById('p-time').value
  var d_suburb = toTitleCase(document.getElementById('d-suburb').value)
  var xhr = createRequest()
  if (validateBooking(noticeElement, p_unitno, p_streetno, p_streetname, p_suburb, p_time, d_suburb) && xhr) {
    var processFile = 'processBooking.php'
    var requestbody = 'user=' + encodeURIComponent(user) + '&email=' + encodeURIComponent(email) + '&p_unitno=' + encodeURIComponent(p_unitno) + '&p_streetno=' + encodeURIComponent(p_streetno) + '&p_streetname=' + encodeURIComponent(p_streetname) + '&p_suburb=' + encodeURIComponent(p_suburb) + '&p_time=' + encodeURIComponent(p_time) + '&d_suburb=' + encodeURIComponent(d_suburb)
    xhr.open('POST', processFile, true)
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var response = xhr.responseText;
        if (response == 0) {
          createNotice(noticeElement, 0, 'Something went wrong, please try again!')
        } else {
          confirmation = '<div class="am-panel am-panel-success"><div class="am-panel-hd"><strong>Booking confirmation</strong></div><div class="am-panel-bd"><p style="text-align:center;">Your booking reference number is</p>'
            + '<h2 style="text-align:center;margin-top:10px;">' + response + '</h2></div>'
            + '<ul class="am-list am-list-static">'
            + '<li><strong>Pick-up Address: </strong>' + (!p_unitno?'':('Unit '+p_unitno+', '))
            + p_streetno + ' ' + p_streetname + ', ' + p_suburb + '</li>'
            + '<li><strong>Pick-up Time: </strong>' + p_time + '</li>'
            + '<li><strong>Destination Suburb: </strong>' + d_suburb + '</li>'
            + '</ul></div>'
          createPanel(noticeElement, confirmation);
        }
      }
    }
    xhr.send(requestbody)
  }
}

function validateBooking(noticeElement, p_unitno, p_streetno, p_streetname, p_suburb, p_time, d_suburb) {
  var bookingValid = true
  if (!p_streetno || !p_streetname || !p_suburb || !p_time || !d_suburb) {
    createNotice(noticeElement, 0, 'All fields except Unit No. are required!')
    bookingValid = false
  }
  if (!isInt(p_unitno)) {
    createNotice(noticeElement, 0, 'Unit No. must be an integer!')
    bookingValid = false
  }
  if (!isInt(p_streetno)) {
    createNotice(noticeElement, 0, 'Street No. must be an integer!')
    bookingValid = false
  }
  return bookingValid
}
