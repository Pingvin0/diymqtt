<?php
if(null == acquireSqlCon()) {
echo("Csatorna funkciók rossz használata");
}

function channelApiKeyExists($key) {
    $result = simpleSTMT("SELECT id FROM channels WHERE API_KEY = ? AND active = 1", "s", [$key]);
    if($result->num_rows > 0)
    return true;

    return false;
}

function generateApiKey() {
    $key = bin2hex(random_bytes(8));

    while(channelApiKeyExists($key)) {
        $key = bin2hex(random_bytes(8));
    }
    return $key;
}

function createChannel($owner, $name) {
simpleSTMT("INSERT INTO channels (name,owner,API_KEY) VALUES(?,?,?)", "sis", [$name,$owner,generateApiKey()]);
return true;
}

function channelNameActive($channel_name, $username) {
    $user = new User($username);
    $result = simpleSTMT("SELECT id FROM channels WHERE owner = ? AND name = ? AND active = 1", "is", [$user->getId(), $channel_name]);
    if($result->num_rows > 0) return true;
    return false;
}

function getLastMessages($apikey, $messagecount=1) {

}

function addMessage($apikey, $message) {
if(!channelApiKeyExists($apikey)) return false;
}

?>