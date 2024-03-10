<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\prueba;
class EinarPrueba extends Component
{
    public function render()
    {
        $prueba=prueba::where('id',1) ->get();
        dd($prueba);
        return view('livewire.einar-prueba');
    }
}
