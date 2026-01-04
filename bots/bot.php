<?php

# A bot template.
# HINT: You can send an event to a messaging service as well by using a bot, that runs in a cron.
# This is just an example of how you could integrate it, not a functioning script.

# sendMessage('telegram', 'YOUR_CHAT_ID', 'Hello!');
# sendMessage('whatsapp', 'YOUR_PHONE_NUMBER', 'Hello!');
# sendMessage('slack', 'YOUR_WEBHOOK_URL', 'Hello!');

function sendMessage($platform, $to, $message) {
    switch($platform) {
        case 'telegram':
            $token = 'YOUR_BOT_TOKEN';
            file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$to&text=".urlencode($message));
            break;
        case 'whatsapp':
            $token = 'YOUR_WHATSAPP_TOKEN';
            $phone_id = 'YOUR_PHONE_NUMBER_ID';
            $ch = curl_init("https://graph.facebook.com/v17.0/$phone_id/messages");
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: Bearer $token",
                "Content-Type: application/json"
            ]);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
                "messaging_product" => "whatsapp",
                "to" => $to,
                "text" => ["body" => $message]
            ]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            curl_close($ch);
            break;
        case 'slack':
            $webhook = $to;
            $ch = curl_init($webhook);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['text' => $message]));
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            curl_close($ch);
            break;
    }
}
