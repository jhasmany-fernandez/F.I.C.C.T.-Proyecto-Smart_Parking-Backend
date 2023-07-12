<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

use Livewire\WithFileUploads;



class ShowIA extends Component
{

    use WithFileUploads;


    public $image_preview, $image;

    // public function save(Request $request)
    // {
    //     $path = "Sin datos";
    //     // $image = $request->file('file');
    //     //  $url = Storage::put('public/imgs/testing_images', $request->file('file'));
    //     // $image = Storage::put('\public\imgs\testing_images', $request->file('file'));
    //     // return view('my_views.testing_images.save_image', compact('image'));
    //     // $this->file = Input::file('fasdfas');
    //     // $file->move(public_path().'/images/',$user->id.'.jpg');
    //     // Storage::put('public/imgs/testing_images/' . $request->filePath, $this->filePath);
    //     if ($request->hasFile('file')) {
    //         $destination_path = 'public/imgs/testing_images';
    //         $image = $request->file('file');
    //         $image_name = $image->getClientOriginalName();
    //         $path = $request->file('file')->storeAs($destination_path, $image_name);
    //     }
    //     return $path;
    // }

    public function updatedImage()
    {
        $this->image_preview = $this->image->temporaryUrl(); // guardamos la url temporal de la imagen


    }

    public function readQR()
    {
        // //$pythonScript = "helpers/IA-generar_Qr/GenQR.py";
        // $pythonScript = "helpers/IA-leer_Qr/Lectura.py";
        // // $pythonScript = "helpers/Lectura.py";
        // //$user = auth()->id();

        // $process = new Process(['python', $pythonScript]);
        // $process->run();
        // if (!$process->isSuccessful()) {
        //     throw new ProcessFailedException($process);
        // }

        // $output = $process->getIncrementalOutput();
        // while (!$process->isTerminated()) {
        //     $output .= $process->getIncrementalOutput();
        // }
        // $result = $output;

        // dd($result);

        if ($this->image->hasFile('file')) {
            $destination_path = 'public/imgs';
            $image = $this->image->file('file');
            $image_name = $image->getClientOriginalName();
            $path = $$this->image->file('file')->storeAs($destination_path, $image_name);
        }

        //dd('Leer QR');
    }

    public function generateQR()
    {
        // $pythonScript = "helpers/recognizing-colors-ia.py";
        $pythonScript = "helpers/IA-generar_Qr/GenQR.py";
        $pythonScriptImage = "images/image4.png";
        $process = new Process(['python', $pythonScript, '--image']);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }


        $output = $process->getIncrementalOutput();
        while (!$process->isTerminated()) {
            $output .= $process->getIncrementalOutput();
        }
        $result = $output;
        // dd('enter');
        // dd('1234');

        //dd('Generar QR');
    }



    public function updateColor()
    {
        $pythonScript = "helpers/recognizing-colors-ia.py";
        $process = new Process(['python', $pythonScript]);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output = $process->getIncrementalOutput();
        while (!$process->isTerminated()) {
            $output .= $process->getIncrementalOutput();
        }
        $result = $output;

        dd($result);
        // dd("Hola Mundo");
        dd(true);
    }




    public function render()
    {
        return view('livewire.show-i-a');
    }
}
