# Bad USB attack with Digispark board

Demo of Bad USB attack based on simple code compiled into [Digispark board](http://digistump.com/products/1).


## Connecting board
Program made with [Arduino IDE](https://www.arduino.cc/en/main/software), connecting manual can be found on [http://uczymy.edu.pl/wp/blog/2015/12/27/digispark/](http://uczymy.edu.pl/wp/blog/2015/12/27/digispark/).

## How it works?
Board plugged into USB acts as HID and executes WinKey+R, cmd, calc.exe.
MS Windows Calculator running is proof of successful arbitrary code execution attack.