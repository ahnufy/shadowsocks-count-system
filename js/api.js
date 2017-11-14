if (window.location.host == 'localhost') {
  var url = 'http://localhost';
} else {
  var url = 'https://.yousite';
}

var api = {
  'url': url,
  'emailCode': url + '/admin/data-api/User.email_code.php',
  'userReg': url + '/admin/data-api/User.reg.php',

}
