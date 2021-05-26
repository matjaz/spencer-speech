# [Spencer][spencer-home] Slovenian Speech support

## 1. Pregenerated sentences
Most of the things Spencer say, are pre-generated files stored on Spencer storage. See [sentences.txt][spencer-sentences] and [sentences.sh][spencer-sentences-sh].

You need to upload this mp3s to Spencer storage using [SerialUploader][serial-uploader].

## 2. Speech to intent
For Spencer to understand other languages you need own speech to intent service. Default speech to intent service is for English.
This repository contains proof of concept [speech to intent service][sti-service] consumed by Spencer.
Service URL can be configured in [Spencer Firmware][spencer-firmware]. See [SpeechToIntent][STI-class] class for details.

## 3. Text to speech
Spencer comes with built-in [text to speech][TTS-class] synthesis service.

## Speech service support
For Slovenian I used Azure speech services since Google speech services (Spencer's default) does not support Slovenian language.
For languages supported by Google speech, you just need to change the language code and pregenerate sentences (step 1).

## Result

[![Spencer understanding and speaking Slovene][demo-img]][demo-video]

## License

MIT

   [sti-service]: sti.php
   [spencer-sentences]: https://github.com/CircuitMess/Spencer-Firmware/blob/master/sentences.txt
   [spencer-sentences-sh]: https://github.com/CircuitMess/Spencer-Firmware/blob/master/scripts/sentences.sh
   [spencer-home]: https://circuitmess.com/spencer/
   [spencer-firmware]: https://github.com/CircuitMess/Spencer-Firmware
   [serial-uploader]: https://github.com/CircuitMess/SerialUploader
   [STI-class]: https://github.com/CircuitMess/Spencer-Library/blob/master/src/Speech/SpeechToIntent.cpp
   [TTS-class]: https://github.com/CircuitMess/Spencer-Library/blob/master/src/Speech/TextToSpeech.cpp
   [demo-img]: https://i.imgur.com/EBZeMQ6.jpg
   [demo-video]: https://www.dropbox.com/s/1m6013uw7hd9905/spencer.mp4?dl=0
