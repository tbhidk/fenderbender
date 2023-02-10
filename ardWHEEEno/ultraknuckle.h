#include <NewPing.h>
#define TRIGGER_PIN_A  16  // Arduino pin tied to trigger pin on the ultrasonic sensor.
#define ECHO_PIN_A     17  // Arduino pin tied to echo pin on the ultrasonic sensor.
#define TRIGGER_PIN_B  18  // Arduino pin tied to trigger pin on the ultrasonic sensor.
#define ECHO_PIN_B     19  // Arduino pin tied to echo pin on the ultrasonic sensor.
#define MAX_DISTANCE  200  // Maximum distance we want to ping for (in centimeters). Maximum sensor distance is rated at 400-500cm.
#define SONAR_NUM       2  // Number of sensors

Newping NewPing(TRIGGER_PIN_A, ECHO_PIN_A, MAX_DISTANCE); // NewPing setup of pins and maximum distance.  

//NewPing sonar[SONAR_NUM] = {
//  NewPing(TRIGGER_PIN_A, ECHO_PIN_A, MAX_DISTANCE), // NewPing setup of pins and maximum distance.  
//  NewPing(TRIGGER_PIN_B, ECHO_PIN_B, MAX_DISTANCE) // NewPing setup of pins and maximum distance.  
//};

void knuckle() {
  delay(50);                      // Wait 50ms between pings (about 20 pings/sec). 29ms should be the shortest delay between pings.

//  use this by uncommenting these lines below, then comment the single sonar code
//  these are for multiple ultrasonic sensors (warning : still have bugs)

//  for (int i=0; i=SONAR_NUM; i++){
//    unsigned int uS = sonar[i].ping(); // Send ping, get ping time in microseconds (uS).
//    Serial.print("Ping: ");
//    Serial.print(sonar[i].convert_cm(uS)); // Convert ping time to distance and print result (0 = outside set distance range, no ping echo)
//    Serial.println("cm");
//  }

//  use this for single sonar
  unsigned int uS = sonar.ping(); // Send ping, get ping time in microseconds (uS).
  Serial.print("Ping: ");
  Serial.print(sonar.convert_cm(uS)); // Convert ping time to distance and print result (0 = outside set distance range, no ping echo)
  Serial.println("cm");
}
