<?php

# A bot template.
# HINT: You can send an event to a messaging service as well by using a bot, that runs in a cron.
# This is just an example of how you could integrate it, not a functioning script.
# Drawback: API's might change overtime: years/decades, you loose events and signals. Not very reliable, but still useful and fun.

# ==========================================================
# USAGE:
# ==========================================================
$config = [
    'telegram_token' => 'YOUR_TELEGRAM_BOT_TOKEN',
    'whatsapp_token' => 'YOUR_WHATSAPP_TOKEN',
    'whatsapp_phone_id' => 'YOUR_PHONE_ID',
    'twilio_sid' => 'YOUR_TWILIO_SID',
    'twilio_token' => 'YOUR_TWILIO_AUTH_TOKEN',
    'twilio_from' => '+1234567890'
];

$messenger = new UniversalMessenger($config);

// Telegram
$messenger->send('telegram', 'YOUR_CHAT_ID', 'Hello Telegram!');

// WhatsApp
$messenger->send('whatsapp', 'RECIPIENT_NUMBER', 'Hello WhatsApp!');

// Slack
$messenger->send('slack', 'YOUR_WEBHOOK_URL', 'Hello Slack!');

// Twilio SMS
$messenger->send('twilio_sms', '+123456789', 'Hello SMS!');

// Discord
$messenger->send('discord', 'YOUR_WEBHOOK_URL', 'Hello Discord!');


# ==========================================================
# BOT:
# ==========================================================


class UniversalMessenger {

    private $config = [];

    public function __construct($config = []) {
        $this->config = $config;
    }

    public function send($platform, $to, $message) {
        switch(strtolower($platform)) {
            case 'telegram':
                return $this->sendTelegram($to, $message);
            case 'whatsapp':
                return $this->sendWhatsApp($to, $message);
            case 'slack':
                return $this->sendSlack($to, $message);
            case 'twilio_sms':
                return $this->sendTwilioSMS($to, $message);
            case 'discord':
                return $this->sendDiscord($to, $message);
            // add more platforms here
            default:
                throw new Exception("Unsupported platform: $platform");
        }
    }

    private function sendTelegram($chat_id, $message) {
        $token = $this->config['telegram_token'] ?? '';
        if (!$token) throw new Exception("Telegram token not set");

        $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=".urlencode($message);
        return file_get_contents($url);
    }

    private function sendWhatsApp($phone, $message) {
        $token = $this->config['whatsapp_token'] ?? '';
        $phone_id = $this->config['whatsapp_phone_id'] ?? '';
        if (!$token || !$phone_id) throw new Exception("WhatsApp config missing");

        $ch = curl_init("https://graph.facebook.com/v17.0/$phone_id/messages");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $token",
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "messaging_product" => "whatsapp",
            "to" => $phone,
            "text" => ["body" => $message]
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    private function sendSlack($webhook_url, $message) {
        $ch = curl_init($webhook_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['text' => $message]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    private function sendTwilioSMS($to, $message) {
        $sid = $this->config['twilio_sid'] ?? '';
        $token = $this->config['twilio_token'] ?? '';
        $from = $this->config['twilio_from'] ?? '';
        if (!$sid || !$token || !$from) throw new Exception("Twilio config missing");

        $url = "https://api.twilio.com/2010-04-01/Accounts/$sid/Messages.json";
        $data = http_build_query([
            'To' => $to,
            'From' => $from,
            'Body' => $message
        ]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_USERPWD, "$sid:$token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    private function sendDiscord($webhook_url, $message) {
        $ch = curl_init($webhook_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['content' => $message]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    // You can add more methods here for Signal, Messenger, etc.
}

