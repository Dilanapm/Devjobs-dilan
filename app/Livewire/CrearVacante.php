<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Salario;
use App\Models\Categoria;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use App\Models\Vacante;
use Illuminate\Support\Facades\Auth;
class CrearVacante extends Component
{
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;


    use WithFileUploads;
    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia'=> 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|max:1024', // Máximo 1MB
     ];

    public function crearVacante(){
        //validar datos
        $datos =  $this->validate();

        //Almacenar la imagen
        $imagen = $this->imagen->store('vacantes');

        $nombreImagen = str_replace('vacantes/', '', $imagen);
        // dd($nombreImagen);
        // Crear la vacante
        Vacante::create([
            'titulo' => $datos['titulo'],
            'salario_id' => $datos['salario'],
            'categoria_id' => $datos['categoria'],
            'empresa' => $datos['empresa'],
            'ultimo_dia' => $datos['ultimo_dia'],
            'descripcion' => $datos['descripcion'],
            'imagen' => $nombreImagen,
            'user_id' => Auth::id(),
        ]);
        // Crear un mensaje de éxito
        session()->flash('mensaje', 'Vacante creada correctamente');
        // Redireccionar a la página de inicio
        return redirect()->route('vacantes.index');
    }
    public function render()
    {
        // Consultar la base de datos para obtener los salarios
        $salarios = Salario::all();
        $categorias = Categoria::all();
        return view('livewire.crear-vacante',[
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }

}
