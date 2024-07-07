    <?php
    // Получение IP адреса клиента
    $ip = $_SERVER['REMOTE_ADDR'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    // Информация для отправки в Telegram
    $token = 'YOUR_TELEGRAM_BOT_TOKEN';
    $chatId = 'YOUR_CHAT_ID';
    $message = "IP address: $ip\nUser Agent: $userAgent";

    // Отправка данных в Telegram
    sendMessageToTelegram($token, $chatId, $message);

    // Заголовок для вывода изображения
    header('Content-Type: image/png');

    // Путь к вашему изображению
    $imagePath = 'public/image.png';
    readfile($imagePath);

    // Функция для отправки сообщения в Telegram
    function sendMessageToTelegram($token, $chatId, $message) {
        $url = 'https://api.telegram.org/bot' . $token . '/sendMessage';
        $data = [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'Markdown'
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ],
        ];

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return $result;
    }
    ?>
