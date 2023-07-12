<div>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .boton-animated {

            display: inline-block;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            background-color: #ff4081;
            color: #fff;
            border-radius: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-left: 50px;

        }

        .boton-animated:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .boton-animated:active {
            transform: scale(0.9);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
    </style>
    <div class="container">
        <button class="boton-animated" wire:click="readQR()">Leer QR</button>
        <button class="boton-animated" wire:click="generateQR()">Generar QR</button>
        <button class="boton-animated" wire:click="updateColor()">Reconocimiento de Colores</button>
        <button class="boton-animated" wire:click="">Reconocimiento de Placas</button>
    </div>
</div>
