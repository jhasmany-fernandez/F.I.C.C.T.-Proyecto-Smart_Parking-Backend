#include <ESP8266WiFi.h>
#include <PubSubClient.h>
#include <Servo.h>
/////////// SERVO MOTOR ////////////////
Servo servo;
int servoPin = 2; //D4

//////////////////VARIABLES TEMPORIZADOR WIFI//////////////////
int periodo = 200;  // tiempo que esta el LED en alto y bajo
unsigned long tiempoAnterior = 0;  //guarda tiempo de referencia para comparar mqttclient

//////////////////VARIABLES TEMPORIZADOR PARA EL PROCEDIMIERNTO RECCONECT/////////////////////////////
int periodo_reconnect = 5000;  // tiempo que esta el LED en alto y bajo
unsigned long tiempoAnterior_rec = 0;  //guarda tiempo de referencia para comparar

//################# VARIABLES DE CONEXION WIFI ############################
const char* ssid = "KATIME GUTIERREZ";
const char* password = "kgb20211";
// Clientes WiFi y MQTT
WiFiClient wificlient;

//################# VARIABLES DE CONEXION MQTT ############################
// MQTT: Servidor

const char* MQTT_SERVER =  "node02.myqtthub.com";
uint16_t MQTT_PORT = 1883;
const char* MQTT_ID = "esp8266";
const char* MQTT_usuario = "yordice77";
const char* MQTT_contrasena = "iNFyYh4v-pXPhJ3Di";
PubSubClient mqttclient(wificlient);

///////////////SUBSCRIPCION TOPICOS/////////////
const char* servo_motor_suscribe ="servo_motor/comands";


//verifica el estado de la conexión WiFi antes del intento de conexión al broker MQTT.
void setup_wifi(){
  
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);

  Serial.println("Conectando");
  while (WiFi.status() != WL_CONNECTED) //Cuenta hasta  si no se puede conectar lo cancela
  {
    /* Comprobamos si debemos lanzar el evento */
    if (millis()> tiempoAnterior + periodo) {
      /* Han pasado los 10 segundos => lanzamos el evento */
      Serial.print(".");
      /* Se actualiza el temporizador para los siguientes 10 segundos */
      tiempoAnterior=millis();  //guarda el tiempo actual como referencia 
    }
    Serial.print("");
  }
   if (WiFi.status() == WL_CONNECTED) {  //Si se conectó      
      Serial.println("********************************************");
      Serial.print("Conectado a la red WiFi: ");
      Serial.println(WiFi.SSID());
      Serial.print("IP: ");
      Serial.println(WiFi.localIP());
      Serial.print("macAdress: ");
      Serial.println(WiFi.macAddress());
      Serial.println("*********************************************");
  }
  else { //No se conectó
      Serial.println("------------------------------------");
      Serial.println("Error de conexion");
      Serial.println("------------------------------------");
  }
}

void conectarMQTT(){
 if (!mqttclient.connected()) {
  reconnect();
 }
 mqttclient.loop();
}

void callback(char* topic, byte* payload, unsigned int length) {
  String content = "";
  String topico = "";
  int n = strlen(topic);
  
  Serial.print("Message arrived [");
  Serial.print(topic);
  Serial.print("] ");
  for (int i = 0; i < length || i < n; i++) {
    if(i<length){
      content+=(char)payload[i];
    }
    if(i<n){
      topico+=(char)topic[i];
    }
  }
  content.trim();
  topico.trim();
  Serial.println(content);
  //si recibimos estado para encender/apagar led-rojo
  if(topico == "servo_motor/comands"){
    Serial.println("pasa aca");
    abrir(content);
  }

} 

void abrir(String content){
  if(content == "on"){
    servo.write(0);
    delay(2000);
  }
  if (content == "off"){
    servo.write(180);
    delay(2000);
  }
}

void reconnect() {
  // Loop until we're reconnected
  while (!mqttclient.connected()) {
    Serial.print("Attempting MQTT connection...");
    // Create a random client ID
    String clientId = "esp8266_1234";
    clientId += String(random(0xffff), HEX);
    // Attempt to connect
    if (mqttclient.connect(MQTT_ID,MQTT_usuario,MQTT_contrasena)) {
      Serial.println("connected");
      // Once connected, publish an announcement...
      //mqttclient.publish("outTopic", "hello world");
      // ... and resubscribe
      mqttclient.subscribe("inTopic");
      mqttclient.subscribe(servo_motor_suscribe);
    } else {
      Serial.print("failed, rc=");
      Serial.print(mqttclient.state());
      Serial.println(" try again in 5 seconds");
      // Wait 5 seconds before retrying
      if (millis()> tiempoAnterior_rec + periodo_reconnect) {
        tiempoAnterior_rec = millis();
      }
    }
  }
}

void setup() {
  Serial.begin(115200);
  servo.attach(servoPin);
  servo.write(180);
  pinMode(servoPin, OUTPUT);
  // put your setup code here, to run once:
  setup_wifi();
  mqttclient.setServer(MQTT_SERVER, MQTT_PORT);
  mqttclient.setCallback(callback);


}

void loop() {
  // put your main code here, to run repeatedly:
  conectarMQTT();
}
