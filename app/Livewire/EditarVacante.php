<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Salario;
use App\Models\Categoria;
use App\Models\Vacante;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Carbon;

class EditarVacante extends Component
{
    public $vacante_id;
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    public $imagen_nueva; // Para manejar la nueva imagen si se sube


    use WithFileUploads;

    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia'=> 'required',
        'descripcion' => 'required',
        'imagen_nueva'  => 'nullable|image|max:1024', // Máximo 1MB
     ]; 
    public function mount(Vacante $vacante)
    {
        // este metodo se ejecuta una vez antes de que el componente se renderice    
        // Puedes usarlo para inicializar propiedades o cargar datos necesarios.
        // Por ejemplo, podrías cargar una vacante específica si es necesario.
        $this->vacante_id = $vacante->id;
        $this->titulo = $vacante->titulo;
        $this->salario = $vacante->salario_id;
        $this->categoria = $vacante->categoria_id;
        $this->empresa = $vacante->empresa;
        // El siguiente es una fecha de tipo Carbon, por lo que no es necesario formatearla
        $this->ultimo_dia = Carbon::parse($vacante->ultimo_dia)->format('Y-m-d');
        $this->descripcion = $vacante->descripcion;
        $this->imagen = $vacante->imagen;
    }
    
    public function editarVacante()
    {
        // Validar los datos
        $datos = $this->validate();

        // Si hay una nueva imagen, almacenarla
        if($this->imagen_nueva){
            $imagen = $this->imagen_nueva->store('vacantes');
            $datos['imagen'] = str_replace('vacantes/', '', $imagen);
        }

        // Encontrar la vacante a actualizar
        $vacante = Vacante::find($this->vacante_id);

        // Asignar los nuevos valores a la vacante
        $vacante->titulo = $datos['titulo'];
        $vacante->salario_id = $datos['salario'];
        $vacante->categoria_id = $datos['categoria'];
        $vacante->empresa = $datos['empresa'];
        $vacante->ultimo_dia = $datos['ultimo_dia'];
        $vacante->descripcion = $datos['descripcion'];
        $vacante->imagen = $datos['imagen'] ?? $vacante->imagen; 
        
        // Actualizar la imagen solo si se subió una nueva
        if(isset($datos['imagen'])) {
            $vacante->imagen = $datos['imagen'];
        }
        
        // guardar los cambios en la base de datos
        $vacante->save();

        // redireccionar a la página de inicio con un mensaje de éxito
        session()->flash('mensaje', 'Vacante actualizada correctamente');
        return redirect()->route('vacantes.index');
    }
    public function render()
    {
        $salarios = Salario::all();
        $categorias = Categoria::all();
        return view('livewire.editar-vacante', [
            'salarios' => $salarios,
            'categorias' => $categorias
        ]);
    }
}
