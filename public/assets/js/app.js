/*!
 * Oloma Dev.
 * Copyright (c) 2022-2024, Oloma Software.
 * 
 * app.js v1.1
 */
/**
 * Initialize application
 */
function initAppJs(axiosInstance) {
  setSessionId(axiosInstance);
  var url = window.location.href;
  if (url.indexOf("#welcome") > 0) {
    setCrossDomainCookies(axiosInstance); // authenticate other domains
  }
  if (csrToken !== "null" && csrToken !== null) { // set cross domain cookies for refreshed token
    setCrossDomainCookies(axiosInstance);
  }
  var loginForm = document.getElementById("loginForm");
  if (loginForm) {
    loginForm.addEventListener("submit", (e) => {
      e.preventDefault();
      crossDomainLogin();
    });
  }
}
function crossDomainLogin() {
  var defaultValue = document.getElementById("login-button").innerHTML;
  var loadingValue = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;Loading...';
  if (locale == 'tr') {
    loadingValue = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>&nbsp;Yükleniyor...';
  }
  document.getElementById('login-button').innerHTML = loadingValue;
  setTimeout(function(){
      axios({
        withCredentials: true,
        method: "POST",
        url: loginPostUrl,
        headers: {
          'X-Client-Locale': locale,
          'Content-Type': 'application/json',
        },
        data: { 
          username: document.getElementById('username').value, 
          password: document.getElementById('password').value 
        },
      }).then(function(response){
        if (response 
          && response["status"] 
          && response["status"] == 200
          && response["data"]
          && response["data"]["data"]
        ) {
          var data = {
            remove: false,
            cookies: [
              { name: cookieUser, value: JSON.stringify(response.data.data.user) },
              { name: cookieToken, value: response["data"]["data"].token },
            ],
          }
          setCookie(cookieUser, JSON.stringify(response.data.data.user), 1);
          setCookie(cookieToken, response.data.data.token, 1);
          sendCookieRequest(axios, data);
          setTimeout(function(){
            window.location.href = currentOrigin;
          }, 300);
        }
      }).catch(function (error) {
        var errorHtml = parseApiErrors(error);
        if (errorHtml !== '') {
          errorHtml = errorHtml.replace("E-Posta:", "<b>E-Posta:</b>");
          errorHtml = errorHtml.replace("E-Mail:", "<b>E-Mail:</b>");
          errorHtml = errorHtml.replace("Password:", "<b>Password:</b>");
          errorHtml = errorHtml.replace("Şifre:", "<b>Şifre:</b>");
          document.getElementById('messages').innerHTML = errorHtml;
          document.getElementById('messages').style.display = 'block'; 
        } else {
          document.getElementById('messages').innerHTML = '';
          document.getElementById('messages').style.display = 'none'; 
        }
        document.getElementById('login-button').innerHTML = defaultValue;
      });
  }, 300);
}
function crossDomainLogout() {
  setCrossDomainCookies(axios, true); // cross domain logout if it's enabled
  //
  // we need to standart logout operation to remove current domain cookies 
  // that's why we use current origin variable.
  // 
  setTimeout(function(){
    window.location.href = currentOrigin + '/logout';
  }, 300);
}
function setSessionId(axiosInstance) {
  var sessionId = getCookie('sid');
  if (!sessionId || sessionId == "") {
    sessionId = makeId(36);
    setCookie('sid', sessionId, 365);
    var data = {
      cookies: [
        { name: 'sid', value: sessionId, day: 365 },
      ],
    }
    sendCookieRequest(axiosInstance, data);
  }
}
function setCrossDomainCookies(axiosInstance, remove = false) {
  if (false == enableCrossDomainCookies) {
    return;
  }
  var data = {
    remove: remove,
    cookies: [
      { name: cookieUser, value: getCookie(cookieUser), },
      { name: cookieToken, value: getCookie(cookieToken), },
    ],
  }
  sendCookieRequest(axiosInstance, data);       
}
function sendCookieRequest(axiosInstance, data) {
  var crossDomainUrl = null;
  var host = window.location.hostname;
  if (httpReferer 
    && httpReferer.includes('your-secondary-domain')
    && host.includes('your-primary-domain')
  ) {
    crossDomainUrl = primaryOrigin + '/cookies';
  } else if (host.includes('your-primary-domain')) {
    crossDomainUrl = secondaryOrigin + '/cookies';
  } else {
    crossDomainUrl = primaryOrigin + '/cookies';
  }
  axiosInstance({
    withCredentials: true,
    method: "POST",
    url: crossDomainUrl,
    headers: {
      'Content-Type': 'application/json',
    },
    data: JSON.stringify(data),
  });
}
function setCookie(name, value, days) {
  var expires = "";
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days*24*60*60*1000));
    expires = "; expires=" + date.toUTCString();
  }
  var sameSite = '';
  if (location.protocol === 'https:') {
    sameSite = ';SameSite=None;Secure';  
  }
  document.cookie = name + "=" + (value || "")  + expires + "; domain=." + currentOriginWithoutPrefix + "; path=/" + sameSite;
}
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for (var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
function removeCookie(name) {
  var sameSite = '';
  if (location.protocol === 'https:') {
    sameSite = ';SameSite=None;Secure';
  }
  document.cookie = name +'=; Domain=' + currentOriginWithoutPrefix + '; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT' + sameSite;
}
function getAxiosSessionInstance(axios) {
  axios.defaults.baseURL = '/';
  axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
  axios.interceptors.response.use((response) => {
    if (response 
        && response["data"]
        && response["data"]["data"]
        && response["data"]["data"]["status"]
        ) {
      if (response.data.data.status == 'Token Refresh') {
        setCrossDomainCookies(axios); // set new token for cross domain browsers
      } 
      var config = response.config;
      var delayRetryRequest = new Promise((resolve) => {
        setTimeout(() => {
          resolve();
        }, 5 * 60 * 1000); // every 5 minutes  5 * 60 * 1000
      });
      return delayRetryRequest.then(() => axios(config));
    }
    return response;
  });
  return axios;
}
function makeId(length) {
  var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  var charactersLength = characters.length;
  var result = '';
  var counter = 0;
  while (counter < length) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
    counter += 1;
  }
  return result;
}
/**
 * parse validation errors
 */
function parseApiErrors(error) {
  // single error
  if (error.response["status"] 
    && error.response.status == 401) {
    if (error.response["data"] 
      && error.response["data"]["data"] 
      && error.response["data"]["data"]["error"]) {
      return error.response["data"]["data"]["error"];
    }
  }
  if (typeof error.response.data.data.error !== "undefined") {
    let errorHtml = ""
    let hasError = false
    let errorObject = error.response.data.data.error
    if (errorObject instanceof Object) {
      errorHtml = "<ul>";
      Object.keys(errorObject).forEach(function (k) {
        if (Array.isArray(errorObject[k])) {
          hasError = true;
          errorObject[k].forEach(function (subObject) {
            if (typeof subObject === "string") {
              errorHtml += '<li>' + `${subObject}` + '</li>'
            } else if (typeof subObject === "object") {
              Object.values(subObject).forEach(function (subErrors) {
                if (Array.isArray(subErrors)) {
                  subErrors.forEach(function (strError) {
                    errorHtml += '<li>' + `${strError}` + '</li>'
                  });
                }
              });
            }
          });
        } else {
          hasError = true;
          errorHtml += '<li>' + `${errorObject[k]}` + '</li>'
        }
      })
      errorHtml += "</ul>";       
    }
    return errorHtml;
  }

}