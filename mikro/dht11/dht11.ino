// import library dht
#include <DHT.h>
#include <ESP8266WiFi.h>

// declare dht pin and type
#define DHTPIN1 D5
#define DHTPIN2 D6
#define DHTPIN3 D7
#define DHTTYPE DHT11

// create dht objects
DHT dht1(DHTPIN1, DHTTYPE);
DHT dht2(DHTPIN2, DHTTYPE);
DHT dht3(DHTPIN3, DHTTYPE);

// declare variables
const int relay = 5;

// WiFi config
const char *ssid = "kobatech";
const char *password = "kobatech2021";

// ip server
const char *host = "192.168.1.52";

void setup() {
  Serial.begin(115200);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  Serial.println("");

  Serial.print("Connecting");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
  pinMode(relay, OUTPUT);
  Serial.println(F("Reading DHT Sensors.."));
  dht1.begin();
  dht2.begin();
  dht3.begin();
}

void loop() {
  // Wait a few seconds between measurements.
  delay(300000); //delay 5 minutes

  //  DATA SENSOR 1
  // Reading temperature or humidity takes about 250 milliseconds!
  // Sensor readings may also be up to 2 seconds 'old' (its a very slow sensor)
  float humid_1 = dht1.readHumidity();
  // Read temperature as Celsius (the default)
  float temp_1 = dht1.readTemperature();
  // Read temperature as Fahrenheit (isFahrenheit = true)
  float f1 = dht1.readTemperature(true);
  // Check if any reads failed and exit early (to try again).
  if (isnan(humid_1) || isnan(temp_1) || isnan(f1)) {
    Serial.println(F("Failed to read from DHT sensor!"));
    return;
  }
  // Compute heat index in Fahrenheit (the default)
  float hif1 = dht1.computeHeatIndex(f1, humid_1);
  // Compute heat index in Celsius (isFahreheit = false)
  float hic1 = dht1.computeHeatIndex(temp_1, humid_1, false);

  Serial.print(F("Humidity Sensor 1: "));
  Serial.print(humid_1);
  Serial.print(F("%  Temperature Sensor 1: "));
  Serial.print(temp_1);
  Serial.print(F("°C "));
  Serial.print(f1);
  Serial.print(F("°F  Heat index Sensor 1: "));
  Serial.print(hic1);
  Serial.print(F("°C "));
  Serial.print(hif1);
  Serial.println(F("°F"));

  //  DATA SENSOR 2
  // Reading temperature or humidity takes about 250 milliseconds!
  // Sensor readings may also be up to 2 seconds 'old' (its a very slow sensor)
  float humid_2 = dht2.readHumidity();
  // Read temperature as Celsius (the default)
  float temp_2 = dht2.readTemperature();
  // Read temperature as Fahrenheit (isFahrenheit = true)
  float f2 = dht2.readTemperature(true);
  // Check if any reads failed and exit early (to try again).
  if (isnan(humid_2) || isnan(temp_2) || isnan(f2)) {
    Serial.println(F("Failed to read from DHT sensor!"));
    return;
  }
  // Compute heat index in Fahrenheit (the default)
  float hif2 = dht2.computeHeatIndex(f2, humid_2);
  // Compute heat index in Celsius (isFahreheit = false)
  float hic2 = dht2.computeHeatIndex(temp_2, humid_2, false);

  Serial.print(F("Humidity Sensor 2: "));
  Serial.print(humid_2);
  Serial.print(F("%  Temperature Sensor 2: "));
  Serial.print(temp_2);
  Serial.print(F("°C "));
  Serial.print(f2);
  Serial.print(F("°F  Heat index Sensor 2: "));
  Serial.print(hic2);
  Serial.print(F("°C "));
  Serial.print(hif2);
  Serial.println(F("°F"));

  //  DATA SENSOR 3
  // Reading temperature or humidity takes about 250 milliseconds!
  // Sensor readings may also be up to 2 seconds 'old' (its a very slow sensor)
  float humid_3 = dht3.readHumidity();
  // Read temperature as Celsius (the default)
  float temp_3 = dht3.readTemperature();
  // Read temperature as Fahrenheit (isFahrenheit = true)
  float f3 = dht3.readTemperature(true);
  // Check if any reads failed and exit early (to try again).
  if (isnan(humid_3) || isnan(temp_3) || isnan(f3)) {
    Serial.println(F("Failed to read from DHT sensor!"));
    return;
  }
  // Compute heat index in Fahrenheit (the default)
  float hif3 = dht3.computeHeatIndex(f3, humid_3);
  // Compute heat index in Celsius (isFahreheit = false)
  float hic3 = dht3.computeHeatIndex(temp_3, humid_3, false);

  Serial.print(F("Humidity Sensor 3: "));
  Serial.print(humid_3);
  Serial.print(F("%  Temperature Sensor 3: "));
  Serial.print(temp_3);
  Serial.print(F("°C "));
  Serial.print(f3);
  Serial.print(F("°F  Heat index Sensor 3: "));
  Serial.print(hic3);
  Serial.print(F("°C "));
  Serial.print(hif3);
  Serial.println(F("°F"));

  float temp_avg = (temp_1 + temp_2 + temp_3) / 3;
  float humid_avg = (humid_1 + humid_2 + humid_3) / 3;

  int min_temp = 23;
  int max_temp = 28;

  int min_humid = 40;
  int max_humid = 60;

  String keterangan = "";
  int pwm_kipas = 0;
  int pwm_pompa = 0;

  int slow = 255/2;
  int fast = 255/1;

  //  fuzzy logic
  if(temp_avg >= max_temp && humid_avg <= min_humid){
    keterangan = "Suhu%20Panas%20Kelembaban%20Rendah";
    pwm_kipas = fast;
    pwm_pompa = fast;
  }
  else if(temp_avg >= max_temp && humid_avg >= min_humid && humid_avg <= max_humid){
    keterangan = "Suhu%20Panas%20Kelembaban%20Ideal";
    pwm_kipas = fast;
    pwm_pompa = 0;
  }
  else if(temp_avg >= max_temp && humid_avg >= max_humid){
    keterangan = "Suhu%20Panas%20Kelembaban%20Tinggi";
    pwm_kipas = fast;
    pwm_pompa = 0;
  }
  else if(temp_avg >= min_temp && temp_avg <= max_temp && humid_avg <= min_humid){
    keterangan = "Suhu%20Ideal%20Kelembaban%20Rendah";
    pwm_kipas = 0;
    pwm_pompa = fast;
  }
  else if(temp_avg >= min_temp && temp_avg <= max_temp && humid_avg >= min_humid && humid_avg <= max_humid){
    keterangan = "Suhu%20Ideal%20Kelembaban%20Ideal";
    pwm_kipas = 0;
    pwm_pompa = 0;
  }
  else if(temp_avg >= min_temp && temp_avg <= max_temp && humid_avg >= max_humid){
    keterangan = "Suhu%20Ideal%20Kelembaban%20Tinggi";
    pwm_kipas = 0;
    pwm_pompa = 0;
  }
  else if(temp_avg <= min_temp && humid_avg <= min_humid){
    keterangan = "Suhu%20Dingin%20Kelembaban%20Rendah";
    pwm_kipas = 0;
    pwm_pompa = fast;
  }
  else if(temp_avg <= min_temp && humid_avg >= min_humid && humid_avg <= max_humid){
    keterangan = "Suhu%20Dingin%20Kelembaban%20Ideal";
    pwm_kipas = 0;
    pwm_pompa = 0;
  }
  else if(temp_avg <= min_temp && humid_avg >= max_humid){
    keterangan = "Suhu%20Dingin%20Kelembaban%20Tinggi";
    pwm_kipas = 0;
    pwm_pompa = 0;
  }

  // sending data to server
  Serial.print("connecting to ");
  Serial.println(host);

  WiFiClient client;
  const int httpPort = 3000; //80
  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
    return;
  }

  String url = "/api/store";
  url += "?temp_1=";
  url += temp_1;
  url += "&humid_1=";
  url += humid_1;
  url += "&temp_2=";
  url += temp_1;
  url += "&humid_2=";
  url += humid_1;
  url += "&temp_3=";
  url += temp_1;
  url += "&humid_3=";
  url += humid_1;
  url += "&temp_avg=";
  url += temp_1;
  url += "&humid_avg=";
  url += humid_1;
  url += "&keterangan=";
  url += keterangan;
  url += "&pwm_kipas=";
  url += pwm_kipas;
  url += "&pwm_pompa=";
  url += pwm_pompa;

  Serial.print("Requesting URL: ");
  Serial.println(url);

  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "Connection: close\r\n\r\n");
  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 1000) {
      Serial.println(">>> Client Timeout !");
      client.stop();
      return;
    }
  }

  // Read all the lines of the reply from server and print them to Serial
  while (client.available()) {
    String line = client.readStringUntil('\r');
    Serial.print(line);
  }

  Serial.println();
  Serial.println("closing connection");
}
