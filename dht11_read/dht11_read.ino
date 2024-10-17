#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <Adafruit_Sensor.h>
#include <DHT.h>
#include <DHT_U.h>

// Tentukan pin DHT
#define DHTPIN 14 // Pin data DHT11 terhubung ke GPIO14 (D5 pada ESP8266)

// Tentukan jenis sensor
#define DHTTYPE DHT11

// Inisialisasi sensor DHT
DHT dht(DHTPIN, DHTTYPE);

// Konfigurasi WiFi
const char* ssid = "TP-Link_2AC4";       // Ganti dengan SSID WiFi Anda
const char* password = "73459668";   // Ganti dengan password WiFi Anda

const char* serverName = "http://192.168.0.100:8080/playcodeam_iot_01/api/save_data.php"; // Ganti dengan alamat IP lokal Anda

// Penjadwalan millis
unsigned long previousMillis = 0;
const unsigned long interval = 60000; // 2 menit dalam milidetik

void setup() {
  Serial.begin(115200);  // Mulai komunikasi serial
  dht.begin();           // Mulai sensor DHT11

  // Menghubungkan ke WiFi
  WiFi.begin(ssid, password);
  Serial.println("Connecting to WiFi");

  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.print(".");
  }

  Serial.println("\nConnected to WiFi");
}

void loop() {
  // Mendapatkan waktu sekarang dalam millis
  unsigned long currentMillis = millis();

  // Mengecek apakah sudah waktunya mengirim data (setiap 5 menit)
  if (currentMillis - previousMillis >= interval) {
    // Menyimpan waktu terakhir pengiriman data
    previousMillis = currentMillis;

    // Baca suhu dan kelembaban dari DHT11
    float h = dht.readHumidity();
    float t = dht.readTemperature();

    // Periksa jika ada kesalahan dalam pembacaan
    if (isnan(h) || isnan(t)) {
      Serial.println("Gagal membaca dari sensor DHT11!");
      return;
    }
    
    // Tampilkan hasil di serial monitor
    Serial.print("Kelembaban: ");
    Serial.print(h);
    Serial.print(" %\t");
    Serial.print("Suhu: ");
    Serial.print(t);
    Serial.println(" *C");

    // Gunakan WiFiClient untuk membuat koneksi
    WiFiClient client;  
    HTTPClient http; 

    // Jika koneksi WiFi tersambung, mengirimkan data ke server
    if (WiFi.status() == WL_CONNECTED) {
      Serial.print("Connecting to ");
      Serial.println(serverName);
      
      // Inisialisasi request ke server dengan WiFiClient
      http.begin(client, serverName);

      // Mengatur tipe request (POST)
      http.addHeader("Content-Type", "application/x-www-form-urlencoded");

      // Membuat payload dengan data suhu dan kelembapan
      String httpRequestData = "temperature=" + String(t) + "&humidity=" + String(h);

      // Mengirimkan request
      int httpResponseCode = http.POST(httpRequestData);
      Serial.println(httpResponseCode);

      // Mengecek respon server
      if (httpResponseCode > 0) {
        String response = http.getString();
        Serial.println("Server response: " + response);
      } else {
        Serial.println("Error in sending POST request");
         Serial.println(http.errorToString(httpResponseCode).c_str());
      }
      
      // Mengakhiri koneksi HTTP
      http.end();

    } else {
      Serial.println("WiFi Disconnected");
    }
    
    Serial.println("Closing connection");
    client.stop();
  }
}