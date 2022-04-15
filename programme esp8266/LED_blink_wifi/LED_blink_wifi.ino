#define LED_Wifi 13
#define LED_EAU 2
void setup() {
  // initialize digital pin LED_BUILTIN as an output.
  pinMode(LED_Wifi, OUTPUT);
  pinMode(LED_EAU, OUTPUT);
}

// the loop function runs over and over again forever
void loop() {
  digitalWrite(LED_Wifi, HIGH);   
  digitalWrite(LED_EAU, HIGH);  
  delay(300);                     
  digitalWrite(LED_Wifi, LOW);    
  digitalWrite(LED_EAU, LOW);
  delay(300);                      
}
