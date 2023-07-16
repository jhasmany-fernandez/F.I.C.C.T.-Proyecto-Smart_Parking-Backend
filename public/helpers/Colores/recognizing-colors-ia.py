import numpy as np
import cv2
import time

i = 0
j = 0
estacionar = False

#Inicia la camara en tiempo real
cap = cv2.VideoCapture(2)

while(1):
    ret, frame = cap.read()
    if ret:

        hsv = cv2.cvtColor(frame, cv2.COLOR_BGR2HSV)

        #Limite superior e inferior para el color negro
        lower_black = np.array([0, 0, 0])  # Límite inferior de negro
        upper_black = np.array([179, 255, 30])  # Límite superior de negro

        #Limite superior e inferior para el color amarrillo
        lower_yellow = np.array([20, 100, 100])  # Límite inferior de amarillo
        upper_yellow = np.array([40, 255, 255])  # Límite superior de amarillo
        
        #Crea mascaras para que reconozca los colores negro y amarrillo
        mascara_black = cv2.inRange(hsv, lower_black, upper_black)
        mascara_yellow = cv2.inRange(hsv, lower_yellow, upper_yellow)

        #Lo que se tiene en las mascaras para el color negro se lo coloca en un porcentaje
        num_pixels_black = np.count_nonzero(mascara_black)
        total_pixels_black = mascara_black.shape[0] * mascara_black.shape[1]
        percentage_black = (num_pixels_black / total_pixels_black) * 100

        #Lo que se tiene en las mascaras para el color amarrillo se lo coloca en un porcentaje
        num_pixels_yellow = np.count_nonzero(mascara_yellow)
        total_pixels_yellow = mascara_yellow.shape[0] * mascara_yellow.shape[1]
        percentage_yellow = (num_pixels_yellow / total_pixels_yellow) * 100
        
        #Las mascaras obtenidas se les hace notar en pantallas
        cv2.imshow("Camara", frame) #Se puede comentar
        cv2.imshow("MascaraNegro", mascara_black)
        cv2.imshow("MascaraAmarrillo", mascara_yellow)

        print(f"Porcentaje de píxeles en el color negro: {percentage_black:.2f}%")
        print(f"Porcentaje de píxeles en el color Blanco: {percentage_yellow:.2f}%")

        #Cuando el auto ingresa al espacio
        if percentage_black < 80.00 and percentage_black > 40.00 and percentage_black != 0.00:
            time.sleep(3)
            if percentage_black < 60.00 and percentage_black != 0.00:
                if percentage_yellow < 20.00 and percentage_yellow != 0.00:
                    j = j + 1
                    # print(f"Porcentaje de píxeles en el color amarrillo: {percentage_yellow:.2f}%")
                    if(j == 3):
                        estacionar = False
                        i = 0
                        j = 0
                        print(estacionar)
                        cv2.destroyAllWindows()
                        break
                else:
                    i = i + 1
                    # print(f"Porcentaje de píxeles en el color rojo: {percentage_red:.2f}%")
                    if(i == 3):
                        estacionar = True
                        i = 0
                        j = 0
                        print(estacionar)
                        cv2.destroyAllWindows()
                        break

        k = cv2.waitKey(5)
        if k == 27:
            cv2.destroyAllWindows()
            break
cap.release()