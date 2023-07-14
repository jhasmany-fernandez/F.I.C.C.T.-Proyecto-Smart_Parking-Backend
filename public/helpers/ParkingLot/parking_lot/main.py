import argparse
import yaml
from coordinates_generator import CoordinatesGenerator
from motion_detector import MotionDetector
from colors import *
import logging

def main():
    logging.basicConfig(level=logging.INFO)

    args = parse_args()

    image_file = args.image_file
    data_file = args.data_file
    start_frame = args.start_frame
    use_camera = args.camera

    #Para guardar la ubicación de los puntos en un archivo llamado coordinates_1.yml
    if image_file is not None:
        with open(data_file, "w+") as points:
            generator = CoordinatesGenerator(image_file, points, COLOR_RED)
            generator.generate()

    #por el archivo creado se dibuja los rectangulos en la camara en tiempo real y 
    #cambia de color por el estado del espacio si ingresa un vehivulo y si lo deja
    with open(data_file, "r") as data:
        points = yaml.safe_load(data)

        if use_camera:
            video_source = 3  # Utilizar la cámara predeterminada 3 para irius
        else:
            video_source = args.video_file

        detector = MotionDetector(video_source, points, int(start_frame))
        detector.detect_motion()

#Parametros que se toma en cuenta al ejecutar la vision artificial
def parse_args():
    parser = argparse.ArgumentParser(description='Generates Coordinates File')

    parser.add_argument("--image",
                        dest="image_file",
                        required=False,
                        help="Image file to generate coordinates on")

    # parser.add_argument("--video",
    #                     dest="video_file",
    #                     required=True,
    #                     help="Video file to detect motion on") #  Descomentar con video

    parser.add_argument("--data",
                        dest="data_file",
                        required=True,
                        help="Data file to be used with OpenCV")

    parser.add_argument("--start-frame",
                        dest="start_frame",
                        required=False,
                        default=1,
                        help="Starting frame on the video")
    
    parser.add_argument("--camera",
                        dest="camera",
                        action="store_true",
                        help="Use camera for real-time video")

    return parser.parse_args()


if __name__ == '__main__':
    main()
