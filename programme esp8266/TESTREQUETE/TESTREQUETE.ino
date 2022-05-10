#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include "Hash.h"
#define WLAN_SSID       "Bbox-A3E72FC8"             // Your SSID
#define WLAN_PASS       "fjnzJ6ANXdFJC7194b"        // Your password
const char* serverNameget = "http://87.91.26.207:80/api.php?get=id&where=connexion";
const char* serverName = "http://87.91.26.207:80/api.php?add_login=*&ssid=1&mdp_wifi=2&login=3&mdp_user=4";
WiFiClient client;

void setup() {

  Serial.print("Connecting to ");
  Serial.println(WLAN_SSID);

  WiFi.begin(WLAN_SSID, WLAN_PASS);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println();
  Serial.println("WiFi connected");
  Serial.println("IP address: "); 
  Serial.println(WiFi.localIP());
  httpGETRequest(serverNameget);
  
}

void loop() {
  // put your main code here, to run repeatedly:

}

String httpGETRequest(const char* serverName) {
  WiFiClient client;
  HTTPClient http;
    
  // Your IP address with path or Domain name with URL path 
  http.begin(client, serverName);
  
  // Send HTTP POST request
  int httpResponseCode = http.GET();
  
  String payload = "{}"; 
  
  if (httpResponseCode>0) {
    Serial.print("HTTP Response code: ");
    Serial.println(httpResponseCode);
    payload = http.getString();
    Serial.println(payload);
  }
  else {
    Serial.print("Error code: ");
    Serial.println(httpResponseCode);
  }
  // Free resources
  http.end();

  return payload;
}
