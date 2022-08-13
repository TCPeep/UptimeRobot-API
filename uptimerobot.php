<?php
class UptimeRobot 
{
    private static $uptimeApi = "https://api.uptimerobot.com/v2/";
    private static $uptimeApiKey = "";

    public static function Post($url, $values)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $values);
        $data = json_decode(curl_exec($ch), true);
        curl_close($ch);

        return $data;
    }

    public static function GetAccountDetails()
    {
        $postResponse = UptimeRobot::Post(self::$uptimeApi."getAccountDetails?format=json", array("api_key" => self::$uptimeApiKey));

        if($postResponse["stat"] == "ok")
            return json_encode(array("error" => false, "details" => $postResponse["account"]), JSON_PRETTY_PRINT);
        else
            return json_encode(array("error" => true, "message" => $postResponse["error"]['message']), JSON_PRETTY_PRINT);
    }

    public static function GetMonitors()
    {
        $postResponse = UptimeRobot::Post(self::$uptimeApi."getMonitors?format=json", array("api_key" => self::$uptimeApiKey));

        if($postResponse["stat"] == "ok")
            return json_encode(array("error" => false, "monitors" => $postResponse["monitors"]), JSON_PRETTY_PRINT);
        else
            return json_encode(array("error" => true, "message" => $postResponse["error"]['message']), JSON_PRETTY_PRINT);
    }

    public static function NewMonitor($name, $url, $type) 
    {
        $postResponse = UptimeRobot::Post(self::$uptimeApi."newMonitor?format=json", array("api_key" => self::$uptimeApiKey, "friendly_name" => $name, "url" => $url, "type" => $type));

        if($postResponse["stat"] == "ok")
            return json_encode(array("error" => false, "monitor" => $postResponse["monitor"]), JSON_PRETTY_PRINT);
        else
            return json_encode(array("error" => true, "message" => $postResponse["error"]['message']), JSON_PRETTY_PRINT);
    }

    public static function DeleteMonitor($id) 
    {
        $postResponse = UptimeRobot::Post(self::$uptimeApi."deleteMonitor?format=json", array("api_key" => self::$uptimeApiKey, "id" => $id));

        if($postResponse["stat"] == "ok")
            return json_encode(array("error" => false, "monitor" => $postResponse["monitor"]), JSON_PRETTY_PRINT);
        else
            return json_encode(array("error" => true, "message" => $postResponse["error"]['message']), JSON_PRETTY_PRINT);
    }

    public static function ResetMonitor($id) 
    {
        $postResponse = UptimeRobot::Post(self::$uptimeApi."resetMonitor?format=json", array("api_key" => self::$uptimeApiKey, "id" => $id));

        if($postResponse["stat"] == "ok")
            return json_encode(array("error" => false, "monitor" => $postResponse["monitor"]), JSON_PRETTY_PRINT);
        else
            return json_encode(array("error" => true, "message" => $postResponse["error"]['message']), JSON_PRETTY_PRINT);
    }
}
?>