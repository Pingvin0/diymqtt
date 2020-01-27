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

function getChannelFromApiKey($key) {
    $r = simpleSTMT("SELECT id FROM channels WHERE API_KEY = ?", "s", [$key]);
    while($arr = $r->fetch_assoc()) {
        return $arr["id"];
    }
    return false;
}

function channelNameActive($channel_name, $username) {
    $user = new User($username);
    $result = simpleSTMT("SELECT id FROM channels WHERE owner = ? AND name = ? AND active = 1", "is", [$user->getId(), $channel_name]);
    if($result->num_rows > 0) return true;
    return false;
}

function getLastMessages($apikey, $messagecount=1) {
    if($messagecount < 1) return "{}";
    if(!channelApiKeyExists($apikey)) return "{}";
    $messages = [];
    $r = simpleSTMT("SELECT * FROM channelmsg WHERE channel_id = ? ORDER BY time DESC LIMIT 0,?", "ii", [getChannelFromApiKey($apikey), $messagecount]);
    while($arr = $r->fetch_assoc()) {
        $messageconstruct = [$arr["msg"], $arr["time"]];
        array_push($messages, $messageconstruct);
    }
    return json_encode($messages, JSON_FORCE_OBJECT);
}

function addMessage($apikey, $message) {

    if(!channelApiKeyExists($apikey)) return false;

    $r = simpleSTMT("INSERT INTO channelmsg (channel_id, msg) VALUES(?,?)", "is", [getChannelFromApiKey($apikey), $message]);
    return true;

}

function channelBelongsToUser($channel_id, $user_id) {
    $r = simpleSTMT("SELECT id FROM channels WHERE id = ? AND active = 1 AND owner = ?", "ii", [$channel_id, $user_id]);
    if($r->num_rows > 0) {
        return true;
    }
    return false;
}

function channelActive($channel_id) {
    $r = simpleSTMT("SELECT id FROM channels WHERE id = ? AND active = 1", "i", [$channel_id]);
    if($r->num_rows > 0) {
        return true;
    }
    return false;
}

?>