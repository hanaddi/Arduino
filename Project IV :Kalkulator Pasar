#include <Keypad.h>
#define pinDisplay 8
#define pinEnable 2
/*--- variabel display ---*/
int seg[pinDisplay]={13,12,11,10,9,8,7,6};
int enable[pinEnable]={A5, A4};
//kode tampilan
int kali[4]   ={B110011, B100111, B111110, B111000};  //mul
int bagi[4]   ={B1011110, B110, B1100100, B1010010};  //div
int kurang[4] ={B1101101, B111110, B1111100, B0}; //sub
int tambah[4] ={B1011111, B1011110, B1011110 , 0};  //add
int error[4]  ={B1111001, B0110001, B0110001, 0};  //Err
int angka[10]={B0111111, B0000110, B1011011, B1001111, B1100110, B1101101, B1111101, B0000111, B1111111, B1101111};
int i, j, b[4];
/*--- variabel kalkulator ---*/
// state kalkulator
// state=0 , input bilangan pertama
// state=1 , input operator
// state=2 , input bilangan kedua
// state=3 , menampilkan hasil
int state;
float numA, numB;
char operasi;
/*--- setup keypad ---*/
const byte ROWS = 4;
const byte COLS = 4;
char hexaKeys[ROWS][COLS] = {
  {'1','2','3','A'},
  {'4','5','6','B'},
  {'7','8','9','C'},
  {'*','0','#','D'}
};
byte rowPins[ROWS] = {2, 3, 4, 5};
byte colPins[COLS] = {A3, A2, A1, A0};
Keypad customKeypad = Keypad( makeKeymap(hexaKeys), rowPins, colPins, ROWS, COLS); 
//mengubah angka ke code 7 segment
int  getCode(float a){
  if(a>9999 || a<-999)return error;
  i=3;
  if(a==0){
    b[0]=0;
    b[1]=0;
    b[2]=0;
    b[3]=angka[0]+128;
  }else if(a>=1){
    while(a<1000){
      a*=10;
      i--;
    }
    for(j=3;j>=0;j--){
      b[j]=angka[(int) a%10]+(j==i?128:0);
      a/=10;
    }
  }else if(a>0){
    a*=1000;
    for(j=3;j>=0;j--){
      b[j]=angka[(int) a%10]+(j==0?128:0);
      a/=10;
    }
  }else{
    while(a>-100){
      a*=10;
      i--;
    }
    for(j=3;j>0;j--){
      b[j]=angka[(int) -a%10]+(j==i?128:0);
      a/=10;
    }
    b[0]=B1000000;
  }
  return b;
}
//menampilkan kode tampilan ke 7 segment
void tampil(int kar[4]){
  for(i=0;i<1<<pinEnable;i++){
    for(j=0;j<pinEnable;j++){
      digitalWrite(enable[j], (i>>j)&1);
    }
    for(j=0;j<pinDisplay;j++){
      digitalWrite(seg[j], (kar[i]>>j)&1);
    }
    
    delay(5);
  }
}
//eksekusi operasi
float eksekusi(float n1, float n2, char op){
  if(op=='A')return n1 + n2;
  if(op=='B')return n1 - n2;
  if(op=='C')return n1 * n2;
  if(op=='D')return n1 / n2;
  return 0;
}
void setup() {
  for(i=0;i<pinDisplay;i++){
    pinMode(seg[i], OUTPUT);
  }
  for(i=0;i<pinEnable;i++){
    pinMode(enable[i], OUTPUT);
  }
  state=0;
  numA=0;
  numB=0;
  operasi='A';
}
void loop() {
  char customKey = customKeypad.getKey();
  if (customKey){
    if(customKey=='*'){
      numA=0;
      numB=0;
      state=0;
    }
    if(customKey=='#'){
        numA=eksekusi(numA, numB, operasi);
        numB=0;
        state=3;
    }
    char angkaChar[10]={'0','1','2','3','4','5','6','7','8','9'};
    for(i=0;i<10;i++){
      if(customKey==angkaChar[i]){
        if(state==0 && numA<1000) numA=numA*10+i;
        else if(state==1){
          numB=i;
          state=2;
        }
        else if(state==2 && numB<1000) numB=numB*10+i;
        else if(state==3){
          numA=i;
          state=0;
        }
      }
    }
    char operasiChar[4]={'A','B','C','D'};
    for(i=0;i<4;i++){
      if(customKey==operasiChar[i]){
        if(state==0)state=1;
        else if(state==2){
          numA=eksekusi(numA, numB, operasi);
          numB=0;
          state=3;
        }
        else if(state==3){
          state=1;
        }
        operasi=operasiChar[i];
      }
    }
  }
  if(state==0){
    tampil(getCode((float) numA));
  }
  else if(state==1){
    if(operasi=='D')tampil(bagi);
    if(operasi=='C')tampil(kali);
    if(operasi=='B')tampil(kurang);
    if(operasi=='A')tampil(tambah);
  }
  else if(state==2){
    tampil(getCode((float) numB));
  }
  else if(state==3){
    tampil(getCode((float) numA));
  }
}
