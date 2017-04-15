//Pin-pin digital untuk 7 segment
#define GR 13    // Ground/Vcc untuk 7 segment 1
#define GL 5     // Ground/Vcc untuk 7 segment 2
#define led_A 9
#define led_B 10
#define led_C 7
#define led_D 6
#define led_E 8
#define led_F 11
#define led_G 12
//PIN UNTUK UV SENSOR
#define ech 2
#define tri 3
int count=0;  //hasil pembacaan pada sensor
void tulis_angka(int angka){
  //menulis hasil ke 7 segment
  tulis(GL,angka,1);
  tulis(GR,angka/10, 0);
  
}
void tulis(int G,int count, int tipe){
  //menulis 1 digit ke 7 segment
  //tipe = 1, common cathode
  //tipe = 0, common anodhe
  count=count%10;
  digitalWrite(G,1-tipe);
  if(!tipe){
    digitalWrite(led_A,!(count!=1 && count!=4));
    digitalWrite(led_B,!(count!=5 && count!=6));
    digitalWrite(led_C,!(count!=2));
    digitalWrite(led_D,!(count!=1 && count!=4 && count!=7));
    digitalWrite(led_E,!(count==0 || count==2 || count==6 || count==8));
    digitalWrite(led_F,!(count!=1 && count!=2 && count!=3 && count!=7));
    digitalWrite(led_G,!(count!=0 && count!=1 && count!=7));
  }else{
    digitalWrite(led_A,(count!=1 && count!=4));
    digitalWrite(led_B,(count!=5 && count!=6));
    digitalWrite(led_C,(count!=2));
    digitalWrite(led_D,(count!=1 && count!=4 && count!=7));
    digitalWrite(led_E,(count==0 || count==2 || count==6 || count==8));
    digitalWrite(led_F,(count!=1 && count!=2 && count!=3 && count!=7));
    digitalWrite(led_G,(count!=0 && count!=1 && count!=7));
  }
  delay(5);
  digitalWrite(G,tipe);
}
int baca(){
  //membaca jarak dari sensor
  digitalWrite(tri,1);
  delayMicroseconds(1000);
  digitalWrite(tri,0);
  int duration=pulseIn(ech,1);
  return duration/59.2;
}
void setup(){
  pinMode(tri,OUTPUT);
  pinMode(ech,INPUT);
  
  pinMode(GL,OUTPUT);
  pinMode(GR,OUTPUT);
  pinMode(led_A,OUTPUT);
  pinMode(led_B,OUTPUT);
  pinMode(led_C,OUTPUT);
  pinMode(led_D,OUTPUT);
  pinMode(led_E,OUTPUT);
  pinMode(led_F,OUTPUT);
  pinMode(led_G,OUTPUT);
}
void loop(){
  count=(int) baca();
  count=count<0?0:count;
  count=count>99?99:count;
  
  //menulis angka
  for(int i=0;i<20;i++){
    tulis_angka(count);
  }  
}
