int masuk=2;        //pin input
int hasil=13;       //pin output
int baca;           //state tombol sekarang
int sebelumnya=0;   //state tombol sebelumnya
int listrik=0;      //state lampu
void setup(){
  pinMode(masuk,INPUT);
  pinMode(hasil,OUTPUT);
}
void loop(){
  baca=digitalRead(masuk);
  if(baca==HIGH && sebelumnya==LOW){
    listrik=1-listrik;
    digitalWrite(hasil,listrik);
  }
  sebelumnya=baca;
  delay(5);
}
