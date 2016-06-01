var XHR = createRequest()

function validateEmail(email) {
  return (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))?true:false
}

function createNotice(noticeElement, noticeType, noticeMsg) {
  var oldAlert = document.getElementsByClassName("am-alert")
  if (oldAlert.length != 0) {
    oldAlert[0].parentNode.removeChild(oldAlert[0])
  }
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
  var processFile = 'processSignup.php'
  var noticeElement = 'signupform'
  var email = document.getElementById('email').value
  var psw = document.getElementById('password').value
  var cpsw = document.getElementById('cpassword').value
  if (!validateEmail(email)) {
    createNotice(noticeElement, 0, 'The E-mail you entered is invalid!')
  }
}
