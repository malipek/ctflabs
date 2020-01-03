#include "DigiKeyboard.h"
void setup()
{
  DigiKeyboard.delay(500);
  DigiKeyboard.sendKeyStroke(0);
  DigiKeyboard.sendKeyStroke(KEY_R, MOD_GUI_LEFT);
  DigiKeyboard.delay(100);
  DigiKeyboard.println("cmd");
  DigiKeyboard.sendKeyStroke(KEY_ENTER);
  DigiKeyboard.delay(100);
  DigiKeyboard.println("calc.exe");
  DigiKeyboard.sendKeyStroke(KEY_ENTER);
}
void loop() {}
