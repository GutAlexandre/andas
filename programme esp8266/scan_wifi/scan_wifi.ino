#define Fan 0

void setup()
{
  Serial.begin(115200);
  Serial.print("Fan running");
  pinMode(Fan, OUTPUT);
  //pinMode (2, INPUT_PULLUP);
}

void loop()
{
  digitalWrite(Fan, HIGH);   // turn the LED on (HIGH is the voltage level)
  delay(1000);                       // wait for a second
  digitalWrite(Fan, LOW);    // turn the LED off by making the voltage LOW
  delay(1000);                    

}
