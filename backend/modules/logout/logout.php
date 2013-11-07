<?php

log_write("LOGOUT");
$_SESSION['auth'] = false;
config_set('auth',false);

url_redirect('/login/');

exit();
