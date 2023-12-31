import cv2 as open_cv
import numpy as np
import logging
from drawing_utils import draw_contours
from colors import COLOR_GREEN, COLOR_BLUE, COLOR_WHITE
import requests

#clase para el detector del estado del espacio(libre, ocupado)dibujando los rectangulos haciendo
#el uso del archivo generado llamado coordiantes_1.yml
class MotionDetector:
    LAPLACIAN = 1.4
    DETECT_DELAY = 1

    def __init__(self, video, coordinates, start_frame):
        self.video = video
        self.coordinates_data = coordinates
        self.start_frame = start_frame
        self.contours = []
        self.bounds = []
        self.mask = []
        self.prev_status = []

    def detect_motion(self):
        capture = open_cv.VideoCapture(self.video)
        capture.set(open_cv.CAP_PROP_POS_FRAMES, self.start_frame)

        coordinates_data = self.coordinates_data
        logging.debug("coordinates data: %s", coordinates_data)

        for p in coordinates_data:
            coordinates = self._coordinates(p)
            logging.debug("coordinates: %s", coordinates)

            rect = open_cv.boundingRect(coordinates)
            logging.debug("rect: %s", rect)

            new_coordinates = coordinates.copy()
            new_coordinates[:, 0] = coordinates[:, 0] - rect[0]
            new_coordinates[:, 1] = coordinates[:, 1] - rect[1]
            logging.debug("new_coordinates: %s", new_coordinates)

            self.contours.append(coordinates)
            self.bounds.append(rect)

            mask = open_cv.drawContours(
                np.zeros((rect[3], rect[2]), dtype=np.uint8),
                [new_coordinates],
                contourIdx=-1,
                color=255,
                thickness=-1,
                lineType=open_cv.LINE_8)

            mask = mask == 255
            # print("Mask shape:", mask.shape)
            self.mask.append(mask)
            logging.debug("mask: %s", self.mask)

        self.prev_status = [True] * len(coordinates_data)
        statuses = self.prev_status
        times = [None] * len(coordinates_data)

         # Realizar solicitud GET
        # response = requests.get('http://tu-solicitud-get-aqui')
        # if response.status_code == 200:
        #     # La solicitud fue exitosa
        #     print("Solicitud exitosa")
        #     print("Respuesta:", response.json())
        # else:
        #     # Hubo un error en la solicitud
        #     print("Error en la solicitud. Código de estado:", response.status_code)

        while capture.isOpened():
            result, frame = capture.read()
            if frame is None:
                break

            if not result:
                raise CaptureReadError("Error reading video capture on frame %s" % str(frame))

            blurred = open_cv.GaussianBlur(frame.copy(), (5, 5), 3)
            grayed = open_cv.cvtColor(blurred, open_cv.COLOR_BGR2GRAY)
            new_frame = frame.copy()
            logging.debug("new_frame: %s", new_frame)

            position_in_seconds = capture.get(open_cv.CAP_PROP_POS_MSEC) / 1000.0

            for index, c in enumerate(coordinates_data):
                status = self.__apply(grayed, index, c)

                if times[index] is not None and self.same_status(statuses, index, status):
                    times[index] = None
                    continue

                if times[index] is not None and self.status_changed(statuses, index, status):
                    if position_in_seconds - times[index] >= MotionDetector.DETECT_DELAY:
                        statuses[index] = status
                        times[index] = None
                    continue

                if times[index] is None and self.status_changed(statuses, index, status):
                    times[index] = position_in_seconds

            for index, c in enumerate(coordinates_data):
                status = self.__apply(grayed, index, c)

                #Imprime el resultado
                if self.status_changed(self.prev_status, index, status):
                    if self.prev_status[index] and not status:
                        if index + 1 != 1:
                            response = requests.post('http://127.0.0.1:8000/api/espacioIncorrecto')
                            # Verificar el código de estado de la respuesta
                            if response.status_code == 200:
                                # La solicitud fue exitosa
                                print("Solicitud exitosa")
                                print("Respuesta:", response.json())
                            else:
                                # Hubo un error en la solicitud
                                print("Error en la solicitud. Código de estado:", response.status_code)
                    elif not self.prev_status[index] and status:
                        response = requests.post('http://127.0.0.1:8000/api/espacioLibre')
                        # Verificar el código de estado de la respuesta
                        if response.status_code == 200:
                            # La solicitud fue exitosa
                            print("Solicitud exitosa")
                            print("Respuesta:", response.json())
                        else:
                            # Hubo un error en la solicitud
                            print("Error en la solicitud. Código de estado:", response.status_code)
                    self.prev_status[index] = status

                coordinates = self._coordinates(c)
                color = COLOR_GREEN if status else COLOR_BLUE
                draw_contours(new_frame, coordinates, str(c["id"] + 1), COLOR_WHITE, color)

            open_cv.imshow(str(self.video), new_frame)
            k = open_cv.waitKey(1)
            if k == ord("q"):
                break
        capture.release()
        open_cv.destroyAllWindows()

    def __apply(self, grayed, index, p):
        coordinates = self._coordinates(p)
        logging.debug("points: %s", coordinates)

        rect = self.bounds[index]
        logging.debug("rect: %s", rect)

        roi_gray = grayed[rect[1]:(rect[1] + rect[3]), rect[0]:(rect[0] + rect[2])]
        laplacian = open_cv.Laplacian(roi_gray, open_cv.CV_64F)
        logging.debug("laplacian: %s", laplacian)

        coordinates[:, 0] = coordinates[:, 0] - rect[0]
        coordinates[:, 1] = coordinates[:, 1] - rect[1]

        status = np.mean(np.abs(laplacian * self.mask[index])) < MotionDetector.LAPLACIAN
        logging.debug("status: %s", status)

        return status

    @staticmethod
    def _coordinates(p):
        return np.array(p["coordinates"])
    
    @staticmethod
    def same_status(coordinates_status, index, status):
        return status == coordinates_status[index]

    @staticmethod
    def status_changed(coordinates_status, index, status):
        return status != coordinates_status[index]

class CaptureReadError(Exception):
    pass
