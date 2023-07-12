<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;


class ShowIA extends Component
{


    public function readQR()
    {
        //$pythonScript = "helpers/IA-generar_Qr/GenQR.py";
        $pythonScript = "helpers/IA-leer_Qr/Lectura.py";
        // $pythonScript = "helpers/Lectura.py";
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

        //dd('Leer QR');
    }

    public function generateQR()
    {
        // $pythonScript = "helpers/recognizing-colors-ia.py";
        $pythonScript = "helpers/IA-generar_Qr/GenQR.py";
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
        // dd('enter');
        // dd('1234');

        //dd('Generar QR');
    }



    public function updateColor()
    {
        /*$pythonScript = "helpers/recognizing-colors-ia.py";
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

        dd($result);*/
        // dd("Hola Mundo");
        dd(true);
    }




    public function render()
    {
        return view('livewire.show-i-a');
    }
}
