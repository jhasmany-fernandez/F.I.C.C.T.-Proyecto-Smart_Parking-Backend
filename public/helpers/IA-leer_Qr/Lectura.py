# Importamos librerias para lecturas
import cv2
import pyqrcode
import png
from pyqrcode import QRCode
from pyzbar.pyzbar import decode
import numpy as np
import requests
# Creamos la videocaptura
cap = cv2.VideoCapture(0)
antCodigo=''
# Empezamos
while True:
    # Leemos los frames
    ret, frame = cap.read()

    
    # Leemos los codigos QR
    for codes in decode(frame):
        # Extraemos info
        #info = codes.data

        # Decodidficamos
        info = codes.data.decode('utf-8')

        # Extraemos coordenadas
        pts = np.array([codes.polygon], np.int32)
        xi, yi = codes.rect.left, codes.rect.top

        # Redimensionamos
        pts = pts.reshape((-1,1,2))

            # Dibujamos
        cv2.polylines(frame, [pts], True, (0, 255, 255), 5)
        cv2.putText(frame, 'A0' + str(info), (xi - 15, yi - 15), cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 255, 255), 2)
        codigo=str(info)
        if len(codigo) == 6 and codigo != antCodigo:
            print('valido ' + codigo)
            antCodigo=codigo
            payload = {
                "qr": codigo,
            }
            response = requests.post('http://127.0.0.1:8000/api/validateQr/', data=payload)
            # Verificar el código de estado de la respuesta
            if response.status_code == 200:
                # La solicitud fue exitosa
                antCodigo=''
                print("Solicitud exitosa")
                print("Respuesta:", response.json())
            else:
                # Hubo un error en la solicitud
                print("Error en la solicitud. Código de estado:", response.status_code)
        else:
            print ('no valido ' + str(info))

    # Mostramos FPS
    cv2.imshow(" LECTOR DE QR", frame)
    # Leemos teclado
    t = cv2.waitKey(5)
    if t == 27:
        break

cv2.destroyAllWindows()
cap.release()