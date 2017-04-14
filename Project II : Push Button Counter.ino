int masuk=2;       //pin input pushbutton
int state1;        //state tombol sekarang
int state0=1;      //state tombol sebelumnya
//Pin-pin digital untuk 7 segment
int a=13;    //  
int b=12;    //   ______
int c=11;    //  |\__a_/|
int d=10;    //  | |  | |
int e=9;     //  |f|__|b|
int f=7;     //  |< g_ >|
int g=6;     //  | |  | |
             //  |e|__|c|
             //  |/__d_\|
int count=0;  //jumlah hitungan
void setup(){
  pinMode(masuk,INPUT);
  pinMode(a,OUTPUT);
  pinMode(b,OUTPUT);
  pinMode(c,OUTPUT);
  pinMode(d,OUTPUT);
  pinMode(e,OUTPUT);
  pinMode(f,OUTPUT);
  pinMode(g,OUTPUT);
}
void loop(){
  state1=digitalRead(masuk);
  if(state1==HIGH && state0==LOW){
    count=(count+1)%10;
  }
  
  //menulis angka
  digitalWrite(a,!(count!=1 && count!=4));
  digitalWrite(b,!(count!=5 && count!=6));
  digitalWrite(c,!(count!=2));
  digitalWrite(d,!(count!=1 && count!=4 && count!=7));
  digitalWrite(e,!(count==0 || count==2 || count==6 || count==8));
  digitalWrite(f,!(count!=1 && count!=2 && count!=3 && count!=7));
  digitalWrite(g,!(count!=0 && count!=1 && count!=7));
  
  state0=state1;
  delay(5);
}
