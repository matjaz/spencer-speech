<?php

date_default_timezone_set('UTC');

$content = file_get_contents('php://input');
if (empty($content)) {
    http_response_code(400);
    die('{"error":"Invalid request"}');
}

$HELLO = [
    'text' => 'Zdravo',
    'intents' => [[
        'name' => 'funpack_hello',
        'confidence'=> 0.99,
    ]]
];

$NAME = [
    'text' => 'Kako ti je ime?',
    'intents' => [[
        'name' => 'funpack_name',
        'confidence'=> 0.99,
    ]]
];

$HELP = [
    'text' => 'Na pomoč!',
    'intents' => [[
        'name' => 'funpack_help',
        'confidence'=> 0.99,
    ]]
];

$TIME = [
    'text' => 'What is the time?',
    'intents' => [[
        'name' => 'Time',
        'confidence'=> 0.99,
    ]]
];

$DATE = [
    'text' => 'What date is it?',
    'intents' => [[
        'name' => 'Date',
        'confidence'=> 0.99,
    ]]
];

$WEATHER = [
    'text' => 'Weather',
    'intents' => [[
        'name' => 'Weather',
        'confidence' => 0.99,
    ]]
];

$VOLUME = [
    'text' => 'Glasnost',
    'intents' => [[
        'name' => 'Volume',
        'confidence' => 0.99,
    ]]
];

$BRIGHTNESS = [
    'text' => 'Svetlost',
    'intents' => [[
        'name' => 'Brightness',
        'confidence' => 0.99,
    ]]
];

$JOKE = [
    'text' => 'Povej mi šalo',
    'intents' => [[
        'name' => 'Joke',
        'confidence'=> 0.99,
    ]]
];

$STOPWATCH = [
    'text' => 'Stopwatch',
    'intents' => [[
        'name' => 'Stopwatch',
        'confidence'=> 0.99,
    ]]
];

$SETTINGS = [
    'text' => 'Nastavitve',
    'intents' => [[
        'name' => 'Settings',
        'confidence'=> 0.99,
    ]]
];

$res = doSTTRequest($content);
$content = null;

$ttsResult = json_decode($res, true);
$res = null;

$INTENT = $TIME;

if ($ttsResult['RecognitionStatus'] == 'Success') {
    $lower = strtolower($ttsResult['DisplayText']);
    $entities = [];
    if (strpos($lower, 'visoko') !== false) {
        $entities['level'][] = [
            'name' => 'level',
            'body' => 'high'
        ];
    }
    if (strpos($lower, 'nizko') !== false || strpos($lower, 'malo') !== false) {
        $entities['level'][] = [
            'name' => 'level',
            'body' => 'low'
        ];
    }
    if (strpos($lower, 'srednje') !== false) {
        $entities['level'][] = [
            'name' => 'level',
            'body' => 'medium'
        ];
    }
    if (strpos($lower, 'povečaj') !== false) {
        $entities['level'][] = [
            'name' => 'level',
            'body' => 'up'
        ];
    }
    if (strpos($lower, 'zmanjšaj') !== false) {
        $entities['level'][] = [
            'name' => 'level',
            'body' => 'down'
        ];
    }
    if (strpos($lower, 'danes') !== false) {
        $entities['time'][] = [
            'name' => 'time',
            'body' => 'today'
        ];
    }
    if (strpos($lower, 'jutri') !== false) {
        $entities['time'][] = [
            'name' => 'time',
            'body' => 'tomorrow'
        ];
    }
    if (strpos($lower, 'teden') !== false) {
        $entities['time'][] = [
            'name' => 'time',
            'body' => 'week'
        ];
    }
    if (strpos($lower, 'zdravo') !== false || strpos($lower, 'hej') !== false) {
        $INTENT = $HELLO;
    } else if (strpos($lower, 'ura') !== false) {
        $INTENT = $TIME;
    } else if (strpos($lower, 'datum') !== false || strpos($lower, ' dan') !== false) {
        $INTENT = $DATE;
    } else if (strpos($lower, 'ime') !== false) {
        $INTENT = $NAME;
    } else if (strpos($lower, 'vreme') !== false) {
        $INTENT = $WEATHER;
    } else if (strpos($lower, 'pomoč') !== false) {
        $INTENT = $HELP;
    } else if (strpos($lower, 'šala') !== false || (strpos($lower, 'povej') !== false && (strpos($lower, 'šolo') !== false || strpos($lower, 'šalo') !== false))) {
        $INTENT = $JOKE;
    } else if (strpos($lower, 'štopa') !== false) {
        $INTENT = $STOPWATCH;
    } else if (strpos($lower, 'glasnost') !== false) {
        $INTENT = $VOLUME;
    } else if (strpos($lower, 'svetlost') !== false) {
        $INTENT = $BRIGHTNESS;
    } else if (strpos($lower, 'nastavitve') !== false) {
        $INTENT = $SETTINGS;
    }
    if (count($entities)) {
        $INTENT['entities'] = $entities;
    }
    $INTENT['text'] = $ttsResult['DisplayText'];
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($INTENT);



function doSTTRequest(&$content) {
    $url = 'https://westeurope.stt.speech.microsoft.com/speech/recognition/conversation/cognitiveservices/v1?language=sl-SI';
    $headers = [
        'Accept: application/json',
        'Content-Type: audio/wav; codecs=audio/pcm; samplerate=16000',
        'Ocp-Apim-Subscription-Key: <API-KEY-HERE>',
    ];

    $context = stream_context_create([
        'http' => [
            'method'  => 'POST',
            'header'  => $headers,
            'content' => $content
        ]
    ]);
    return @file_get_contents($url, false, $context);
}
