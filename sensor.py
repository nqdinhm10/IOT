import Adafruit_DHT
import RPi.GPIO as GPIO
import pymysql
import datetime
from urllib.request import urlopen
from gpiozero import InputDevice, CPUTemperature
from time import sleep

sensor = Adafruit_DHT.DHT22
BuzzerPin = 22
no_rain = InputDevice(24)

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)
GPIO.setup(4, GPIO.IN)
GPIO.setup(BuzzerPin, GPIO.OUT, initial=GPIO.LOW)

gpio = 17

#Sensor ID:
dht22id = "dht22a1011"
mq135id = "mq135a1011"
mhrdid = "mhrda1011"



while True:
    try:
        humidity, temperature = Adafruit_DHT.read_retry(sensor, gpio)

        if humidity is not None and temperature is not None:
            e = datetime.datetime.now()
            print(e)

            temp = '%.2f' % (temperature)
            hum = '%.2f' % (humidity)
            print('Temperature = '+temp+'*C \t''Humidity = '+hum+'%')
            urlopen("https://dth185247kl.000webhostapp.com/cambien/add_data_dht22.php?sensorid="+dht22id+"&temp="+temp+"&hum="+hum).read()

        else:
            print('Fail!!!')

        if GPIO.input(4):

            mq135qlty = "1"
            print("Good atmosphere")
            urlopen("https://dth185247kl.000webhostapp.com/cambien/add_data_mq135.php?sensorid="+mq135id+"&quality="+mq135qlty).read()

        else:

            mq135qlty = "2"
            print("Bad atmosphere")
            urlopen("https://dth185247kl.000webhostapp.com/cambien/add_data_mq135.php?sensorid="+mq135id+"&quality="+mq135qlty).read()

        if not no_rain.is_active:

            mhrdqlty = "2"
            print("Water leak")
            urlopen("https://dth185247kl.000webhostapp.com/cambien/add_data_mhrd.php?sensorid="+mhrdid+"&quality="+mhrdqlty).read()

        else:

            mhrdqlty = "1"
            print("No water leak")
            urlopen("https://dth185247kl.000webhostapp.com/cambien/add_data_mhrd.php?sensorid="+mhrdid+"&quality="+mhrdqlty).read()


        if(GPIO.input(4) and no_rain.is_active):
            GPIO.output(BuzzerPin, GPIO.LOW)
        else:
            GPIO.output(BuzzerPin, GPIO.HIGH)

        cpu = CPUTemperature()
        cputemp = cpu.temperature
        print('CPU Temperature = '+str(cputemp)+'*C')
        print('\n')
        sleep(300)
    except Exception as e:
        print("Errored out!!!", e)
        print("Retrying...")
