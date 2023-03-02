#include <WiFi.h>
#include <HTTPClient.h>
#include <Wire.h>

#define TRIGGER_PIN 12
#define ECHO_PIN 14
#define BOAT_DETECTED_DISTANCE 100
#define BOAT_DETECTED_DELAY 2000
#define WIFI_SSID "PelindoTPK"
#define WIFI_PASSWORD "secure123tpk"
#define SERVER_IP "10.132.246.78"
#define SERVER_PORT 80
//#define URL "/store_detection.php"

long duration, distance;
unsigned long boatDetectedTime = 0;
bool boatDetected = false;


// REPLACE with your Domain name and URL path or IP address with path
const char* serverName = "http://testfender.000webhostapp.com/testHandler.php/";

// Keep this API Key value to be compatible with the PHP code provided in the project page. 
// If you change the apiKeyValue value, the PHP file /post-esp-data.php also needs to have the same key 
String apiKeyValue = "TKuwrbo20wOYX";

String sensorName = "HC-SR04";
String sensorLocation = "Office";



void setup() {
  Serial.begin(115200);
  pinMode(TRIGGER_PIN, OUTPUT);
  pinMode(ECHO_PIN, INPUT);

  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");

}

void loop() {
  digitalWrite(TRIGGER_PIN, LOW);
  delayMicroseconds(2);
  digitalWrite(TRIGGER_PIN, HIGH);
  delayMicroseconds(10);
  digitalWrite(TRIGGER_PIN, LOW);
  duration = pulseIn(ECHO_PIN, HIGH);
  distance = (duration / 2) / 29.1;
  Serial.print("Distance: ");
  Serial.print(distance);
  Serial.println(" cm");
  if (distance < BOAT_DETECTED_DISTANCE) {
    if (!boatDetected) {
      boatDetectedTime = millis();
      boatDetected = true;
    } else if (millis() - boatDetectedTime >= BOAT_DETECTED_DELAY) {
      Serial.println("There's a boat");
     // sendDetectionData("yes");
      boatDetected = false;
    }
  } else {
    boatDetected = false;
  }
  delay(1000);
}
