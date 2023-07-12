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

        /* Changing to CSS */
        .w-full {
            width: 100%;
        }

        .bg-white {
            background-color: #ffffff;
        }

        .rounded-xl {
            border-radius: 0.75rem;
        }

        .p-4 {
            padding: 1rem;
        }

        .shadow-xl {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 5px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .flex {
            display: flex;
        }

        .flex-col {
            flex-direction: column;
        }

        .justify-center {
            justify-content: center;
        }

        .items-center {
            align-items: center;
        }

        .w-auto {
            width: auto;
        }

        .h-40 {
            height: 10rem;
        }

        .rounded-lg {
            border-radius: 0.5rem;
        }

        .font-semibold {
            font-weight: 600;
        }

        .text-xl {
            font-size: 1.25rem;
        }

        .mt-1 {
            margin-top: 0.25rem;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .text-gray-400 {
            color: #cbd5e0;
        }

        .text-center {
            text-align: center;
        }

        .hidden {
            display: none;
        }

        .form-control-file {
            width: 100%;
            height: calc(1.5em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        #file-btn {
            cursor: pointer;
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .rounded {
            border-radius: 0.25rem;
        }

        .text-primary {
            color: #007aff;
        }

        .hover:bg-primary:hover {
            background-color: #007aff;
        }

        .transition-all {
            transition-property: all;
            transition-duration: 0.3s;
            transition-timing-function: ease;
        }

        .outline-none {
            outline: none;
        }

        .bg-black {
            background-color: #000000;
        }

        .border-black {
            border-color: #000000;
        }

        .text-white {
            color: #ffffff;
        }

        .hover:text-black:hover {
            color: #000000;
        }

        .hover:bg-white:hover {
            background-color: #ffffff;
        }

        .font-bold {
            font-weight: 700;
        }

        .error {
            color: red;
        }

        .bg-gray-500 {
            background-color: #6b7280;
        }

        .hover:text-black:hover {
            color: #000000;
        }

        .hover:bg-gray-300:hover {
            background-color: #d1d5db;
        }

        [disabled] {
            pointer-events: none;
            opacity: 0.5;
        }
    </style>

    <div class="container">
        <button class="boton-animated" wire:click="readQR()">Leer QR</button>
        <button class="boton-animated" wire:click="generateQR()">Generar QR</button>
        <button class="boton-animated" wire:click="updateColor()">Reconocimiento de Colores</button>
        <button class="boton-animated" wire:click="">Verificación de espacios</button>

    </div>



    <div class="w-full bg-white rounded-xl p-4 shadow-xl mt-4">
        <div class="flex flex-col justify-center items-center">
            <img src="https://cdn3d.iconscout.com/3d/premium/thumb/upload-social-media-post-4291893-3569926.png"
                class="w-auto h-40 rounded-lg" />
            {{-- <p class="font-semibold text-xl mt-1">Subir Fotos</p> --}}
            <p class="font-semibold text-sm text-gray-400 text-center">Sube las fotos del
                evento
                aquí</p>

            {{-- <form method="POST" action="{{ url('upload-photo') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="file" name="image" class="form-control-file hidden"
                        id="file-btn" />

                    <a for="file-btn" class="mt-4">
                        <label for="file-btn"
                            class="px-4 py-2 rounded text-primary hover:bg-primary  transition-all outline-none bg-black border-black text-white hover:text-black hover:bg-white font-bold">
                            Cargar Foto
                        </label>
                    </a>


                    <button
                        class="mx-5 px-4 py-2 rounded text-primary hover:bg-primary  transition-all outline-none bg-black border-black text-white hover:text-black hover:bg-white font-bold"
                        type="submit">Subir Foto</button>
                </form> --}}
            <form wire:submit.prevent="submit">
                <input type="file" wire:model="image" class="form-control-file hidden" id="file-btn" />

                <a for="file-btn" class="mt-4">
                    <label for="file-btn"
                        class="px-4 py-2 rounded text-primary hover:bg-primary  transition-all outline-none bg-black border-black text-white hover:text-black hover:bg-white font-bold">
                        Cargar Foto
                    </label>
                </a>

                {{-- @error('image')
                    <span class="error">{{ $message }}</span>
                @enderror --}}


                {{-- @if ($image_preview)
                    <button
                        class="mx-5 px-4 py-2 rounded text-primary hover:bg-primary  transition-all outline-none bg-black border-black text-white hover:text-black hover:bg-white font-bold"
                        type="submit">Subir Foto</button>
                @else
                    <button disabled="true"
                        class="mx-5 px-4 py-2 rounded text-primary  transition-all outline-none bg-gray-500 border-black text-white hover:text-black hover:bg-gray-300 font-bold"
                        type="submit">Subir Foto</button>
                @endif --}}

            </form>

            {{-- <div class="m-1 p-2 rounded-xl">

                @if ($image_preview)
                    <img src="{{ $image_preview }}" id="main" alt="IMAGE"
                        style="object-fit: contain; width:300px; height:300px; border-radius: 0.75rem; ">
                @else
                    <img id="main" alt="IMAGE"
                        src="https://img.freepik.com/premium-vector/cute-photographer-cartoon-illustration-people-profession-icon-concept_138676-1899.jpg"
                        style="object-fit: contain; width:300px; height:300px; border-radius: 0.75rem; " />
                @endif

            </div> --}}
        </div>
    </div>


</div>
