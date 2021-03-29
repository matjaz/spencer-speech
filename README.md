# [Spencer][spencer-home] Slovenian Speech support

## 1. Pregenerated sentences
Spencer uses built-in pre-generated sentences to respond to queries. See [sentences.txt][spencer-sentences] and [sentences.sh][spencer-sentences-sh].

## 2. Speech to intent
This repository contains proof of concept speech to intent service consumed by Spencer.
Service URL can be configured in [Spencer Firmware][spencer-firmware]. See [SpeechToIntent][STI-class] class for details.

## 3. Text to speech
Spencer comes with built-in [text to speech][TTS-class] synthesis service.

## License

MIT

   [spencer-sentences]: https://github.com/CircuitMess/Spencer-Firmware/blob/master/sentences.txt
   [spencer-sentences-sh]: https://github.com/CircuitMess/Spencer-Firmware/blob/master/scripts/sentences.sh
   [spencer-home]: https://circuitmess.com/spencer/
   [spencer-firmware]: https://github.com/CircuitMess/Spencer-Firmware
   [STI-class]: https://github.com/CircuitMess/Spencer-Library/blob/master/src/Speech/SpeechToIntent.cpp
   [TTS-class]: https://github.com/CircuitMess/Spencer-Library/blob/master/src/Speech/TextToSpeech.cpp
