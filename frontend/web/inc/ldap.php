
<?php
function LoginLDAP($username, $password){
    $host = "192.168.1.18";
    $port = 389;

    $ldap = ldap_connect($host, $port);

    $ldap_login = 'KUNINGAN'. '\\' . $username;

    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    $bind = @ldap_bind($ldap, $ldap_login, $password);

    if($bind){
        $filter = "(&(objectClass=user)(sAMAccountName=$username))";
        $result = ldap_search($ldap, "DC=Kuningan,DC=local", $filter);
    
        $info = ldap_get_entries($ldap, $result);
    }
  
    
    return $bind;
}
    

?>
        
