#ifdef ESP32
  #include <WiFi.h>
  #include <HTTPClient.h>
#else
  #include <ESP8266WiFi.h>
  #include <ESP8266HTTPClient.h>
  #include <WiFiClient.h>
#endif

#include <PubSubClient.h>
#include "ultraknuckle.h"


// WiFi
const char* ssid = "PelindoTPK";
const char* password = "secure123tpk";

unsigned long previousMillis = 0;
const long interval = 30000; // use const instead of unsigned long

// mqtt broker
const char* mqttServer = "10.132.245.99";
const int mqttPort = 1883;

void callback(char* topic, byte* payload, unsigned int length) {
  Serial.print("Message arrived in topic: ");
  Serial.println(topic);
  
  Serial.print("Message:");
    Serial.println();
  
  String message = "";
  for (int i = 0; i < length; i++) {
    Serial.print((char)payload[i]);
    message+=(char)payload[i];
  }
  Serial.println("-----------------------");
  
    
}
WiFiClient espClient;
PubSubClient client(mqttServer, mqttPort, callback, espClient);

void setup() {
  Serial.begin(115200);

  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  Serial.print("Connecting to WiFi ..");
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print('.');
    delay(1000);
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());
  // moved RSSI print to setup()
  Serial.print("RSSI: ");
  Serial.println(WiFi.RSSI());

  client.setServer(mqttServer, mqttPort);
  client.setCallback(callback);
    while (!client.connected()) {
      String client_id = "esp32testClient-";
      client_id += String(WiFi.macAddress());
      Serial.printf("The client %s connects to the public mqtt broker\n", client_id.c_str());
      if (client.connect(client_id.c_str())) {
          Serial.println("Public emqx mqtt broker connected");
        } else {
            Serial.print("failed with state ");
            Serial.print(client.state());
            delay(2000);
            } 
  
  }
}
void loop() {
  client.loop();
  
  unsigned long currentMillis = millis();
  // if WiFi is down, try reconnecting every interval seconds
  if ((WiFi.status() != WL_CONNECTED) && (currentMillis - previousMillis >= interval)) {
    previousMillis = currentMillis;
    Serial.print(millis()); // removed extra bracket
    Serial.println(" Reconnecting to WiFi..."); // added space
    WiFi.disconnect(true); // added true to disconnect all previous connections
    WiFi.reconnect();
  }
  knuckle();

    unsigned int uS = sonar.ping();
     float distance = sonar.convert_cm(uS);
     if(!isnan(distance)){
      Serial.println("distance: " +String(distance) + " cm");
      String toSend = String(distance) + "cm";
      client.publish("esp32one/jarak1",toSend.c_str());
    }   
  }
