# Importamos las librerias
import sys
import pyqrcode
import png
from pyqrcode import QRCode

# CODIGOS QR ID
# Variables
con = '2023-07-14-15.30.35'

# Generamos los QR
# while con <= 1234:

# id = str('j') +  str(con)
roster = con
id = '65' + str(con)
# Creamos los QR
qr = pyqrcode.create(65 and id, error='L')
# Guardamos
qr.png(str(roster) + '.png', scale=7)
# Aumentamos con
# con = con + 1

# url = pyqrcode.create(url, error = 'L')
# url.png('URL' + '.png', scale = 6)
