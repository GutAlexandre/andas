
/************************* Library *********************************/

#include <ESP8266WiFi.h>
#include <ESPAsyncTCP.h>
#include <ESPAsyncWebServer.h>
#include "FS.h"
#include <LittleFS.h>
#include <ESP8266HTTPClient.h>
#include <ArduinoJson.h>

#include <Wire.h>
#include <Adafruit_Sensor.h>
#include <Adafruit_BME280.h>
#include "Hash.h"
/************************* Define variables *********************************/

int i=0;
String result,fichiername, ssid ,password ,login ,pwd ,Nxt,IpAdresse,header,response;
String statut = "0";
long duration;
float distanceCm;
const char* pass = NULL;
const char* PARAM_1 = "SSID";
const char* PARAM_2 = "WPA";
const char* PARAM_3 = "name";
const char* PARAM_4 = "InputPWD";
const char* serverName;
const String inputParam1 = "SSID";
const String inputParam2 = "WPA";
const String inputParam3 = "name";
const String inputParam4 = "InputPWD";
const int trigPin = 12;
const int echoPin = 14;
AsyncWebServer server(80);
WiFiClient client;
HTTPClient http;
#define SEALEVELPRESSURE_HPA (1013.25)
Adafruit_BME280 bme; // I2C
#define SOUND_VELOCITY 0.034
#define CM_TO_INCH 0.393701
#define LED_Wifi 13
#define LED_EAU 2
/************************* Setup *********************************/

//Setup
void setup() {
  Serial.begin(115200);
  Serial.println();
  pinMode(LED_Wifi, OUTPUT);
  pinMode(LED_EAU, OUTPUT);
  digitalWrite(LED_Wifi, HIGH);   
  digitalWrite(LED_EAU, HIGH);   
/************************* Check spiffs *********************************/

  if (!SPIFFS.begin())
  {
    Serial.println("Erreur SPIFFS...");
    return;
  }
/************************* Check BME280 *********************************/
  Serial.println(F("BME280 test"));
  bool status;
  status = bme.begin(0x76);  
  if (!status) {
    Serial.println("BME280 non detecté!");
    
  }
  Serial.println(F("BME280 test"));

/************************* Setup niveau eau *********************************/
  pinMode(trigPin, OUTPUT); // Sets the trigPin as an Output
  pinMode(echoPin, INPUT); // Sets the echoPin as an Input
/************************* Check connexion *********************************/

  Serial.println("Demarrage file System");
  Serial.println("Lecture des fichiers");
  Serial.println(lecture("/ssid.txt"));
  Serial.println(lecture("/wep.txt"));
  Serial.println(lecture("/name.txt"));
  Serial.println(lecture("/mdp.txt"));
  statut = connectToWiFi();
  if (statut != "0" ){
    accespoint();
  }else{
    VerifID();
  }
}
  /************************* Not use for moment *********************************/

void loop() {
 
}

/************************* Spiffs use *********************************/

void ecriture(String fichiername,String value) {
   File dataFile =  SPIFFS.open(fichiername, "w");
   dataFile.print(value);
   dataFile.close();
}

String lecture(String fichiername) {
  result = "";
  File dataFile = SPIFFS.open(fichiername, "r"); 
  for (int i = 0; i < dataFile.size() ; i++){
    result = result + (char)dataFile.read();
   }
  dataFile.close();


  return(result);
}

/************************* Wifi Setup *********************************/

String VerifID(){
   serverName= "http://87.91.26.207:80/api.php?get=id&where=connexion";
   response = httpGETRequest(serverName);
   login = lecture("/name.txt");
   result = "";
   pwd = lecture("/mdp.txt");
   result = "";
   ssid = lecture("/ssid.txt");
   result = "";
   password = lecture("/wep.txt");
   result = "";
   Serial.println(login);
   Serial.println(pwd);
   Serial.println(response);
   String res =login + pwd;
   String hasha = sha1(res);
   Serial.println();
   Serial.println(hasha);
   
   if(response.indexOf(hasha) > 0){
      Serial.println("existe");
      String url = "http://87.91.26.207:80/api.php?update=";
      url += hasha;
      url += "&where=connexion&what=ssid&value=";
      url += ssid;
      Serial.print(url);
      char charBuf[300];
      url.toCharArray(charBuf, 300);
      response = httpGETRequest(charBuf);
      url = "";
      url = "http://87.91.26.207:80/api.php?update=";
      url += hasha;
      url += "&where=connexion&what=mdp_wifi&value=";
      url += password;
      Serial.print(url);
      char charBuf2[300];
      url.toCharArray(charBuf2, 300);
      response = httpGETRequest(charBuf2);//update le user
    
   }else
   {
      String url = "http://87.91.26.207:80/api.php?add_login=";
      url += hasha;
      url += "&ssid=";
      url += ssid;
      url += "&mdp_wifi=";
      url += password;
      url += "&login=";
      url += login;
      url += "&mdp_user=";
      url += pwd;
      Serial.print(url);
      char charBuf[300];
      url.toCharArray(charBuf, 300);
      response = httpGETRequest(charBuf);//Crée un user 
   }

   return(hasha);
}

String connectToWiFi() {
    result = "";
    ssid = lecture("/ssid.txt");
    result = "";
    password = lecture("/wep.txt");
    result = "";
    Serial.println();
    Serial.println();
    Serial.print("Connecting to WiFi");
    Serial.println("...");
    WiFi.begin(ssid, password);
    
    int retries = 0;
    while ((WiFi.status() != WL_CONNECTED) && (retries < 45)) {
       retries++;
       delay(250);
       digitalWrite(LED_Wifi, HIGH);   
       Serial.print(".");
       delay(250);
       digitalWrite(LED_Wifi, LOW);   
    }
    if (retries > 44) {
        Serial.println(F("WiFi connection FAILED"));
        statut = "FAILED";
    }
    if (WiFi.status() == WL_CONNECTED) {
        Serial.println(F("WiFi connected!"));
        digitalWrite(LED_Wifi, HIGH);   
        Serial.println("IP address: ");
        Serial.println(WiFi.localIP());
    }
    Serial.println(F("Setup ready"));
    
    return(statut);
}

void accespoint(){
    ssid = "Andas-Hardware";
    WiFi.mode(WIFI_AP);
    WiFi.softAP(ssid, pass);
    Serial.print("[+] AP Created with IP Gateway : ");
    Serial.println(WiFi.softAPIP());
    digitalWrite(LED_Wifi, LOW); 
    IpAdresse = WiFi.softAPIP().toString();
/************************* Load web *********************************/
    server.on("/", HTTP_GET, [](AsyncWebServerRequest  *request){request->send(SPIFFS, "/index.html", "text/html");Serial.println("index");});
    server.on("/Logo.svg", HTTP_GET, [](AsyncWebServerRequest *request){request->send(SPIFFS, "/Logo.svg", "text/svg+xml");Serial.println("logo");});
    server.on("/main.css", HTTP_GET, [](AsyncWebServerRequest  *request){request->send(SPIFFS, "/main.css", "text/css");Serial.println("main");});
    server.on("/bootstrap.min.css", HTTP_GET, [](AsyncWebServerRequest *request){AsyncWebServerResponse *response = request->beginResponse(SPIFFS,"/bootstrap.min.css.gz", "text/css");response->addHeader("Content-Encoding","gzip");request->send(response);Serial.println("bootstrap");});
    server.on("/jquery-3.6.0.min.js", HTTP_GET, [](AsyncWebServerRequest *request){AsyncWebServerResponse *response = request->beginResponse(SPIFFS, "/jquery-3.6.0.min.js.gz", "text/javascript");response->addHeader("Content-Encoding","gzip");request->send(response);Serial.println("jquery");});

/************************* Gestion des requetes *********************************/
   
   server.on("/set", HTTP_GET, [](AsyncWebServerRequest *request){
      String  inputMessage1 ;
      String  inputMessage2 ;
      String  inputMessage3 ;
      String  inputMessage4 ;
      if (request->getParam(PARAM_1)->value() != "") {
        inputMessage1 = request->getParam(PARAM_1)->value();
      } else {
        inputMessage1 = "none";
      }
      
      if (request->getParam(PARAM_2)->value() != "") {
        inputMessage2 = request->getParam(PARAM_2)->value();
      } else {
        inputMessage2 = "none";
      }

      if (request->getParam(PARAM_3)->value() != "") {
        inputMessage3 = request->getParam(PARAM_3)->value();
      } else {
        inputMessage3 = "none";
      }

      if (request->getParam(PARAM_4)->value() != "") {
        inputMessage4 = request->getParam(PARAM_4)->value();
      } else {
        inputMessage4 = "none";
      }
      
      Serial.println(inputMessage1);
      Serial.println(inputMessage2);
      Serial.println(inputMessage3);
      Serial.println(inputMessage4);
      ecriture("/ssid.txt",inputMessage1);
      ecriture("/wep.txt",inputMessage2);
      ecriture("/name.txt",inputMessage3);
      ecriture("/mdp.txt",inputMessage4);
      Serial.begin(115200);

     
      String res =inputMessage3 + inputMessage4;
      String result = sha1(res);
      ecriture("/hash.txt",result);
      Serial.println();
      Serial.println(result);
      
      ESP.restart();
      Serial.println("Redemarrage de l'esp ...");
      Serial.println();
   });
   server.begin();

}

String httpGETRequest(const char* serverName) {
  WiFiClient client;
  HTTPClient http;
  http.begin(client, serverName);
  int httpResponseCode = http.GET();
  String payload = "{}"; 
  if (httpResponseCode>0) {
    Serial.print("HTTP Response code: ");
    Serial.println(httpResponseCode);
    payload = http.getString();
  }
  else {
    Serial.print("Error code: ");
    Serial.println(httpResponseCode);
  }
  http.end();

  return payload;
}


/************************* Sensor *********************************/

float Temp() {
  Serial.print("Temperature = ");
  float temperature = bme.readTemperature();
  Serial.print(bme.readTemperature());
  Serial.println(" *C");
  return(temperature);
}

float Hum(){
  Serial.print("Humidity = ");
  float humidity = bme.readHumidity();
  Serial.print(bme.readHumidity());
  return(humidity);
}

float niv_eau(){
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  duration = pulseIn(echoPin, HIGH);
  distanceCm = duration * SOUND_VELOCITY/2;
  Serial.print("Distance (cm): ");
  Serial.println(distanceCm);
  return(distanceCm);
}
