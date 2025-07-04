<form class="sm:w-3/4 md:w1/2 lg:w-full space-y-5" wire:submit.prevent="crearVacante">
    <div>
        <x-input-label for="titulo" :value="__('Título Vacante')" />
        <x-text-input id="titulo" type="text" class="mt-1 block w-full" wire:model.live="titulo" :value="old('titulo')"
            placeholder="Título de la vacante" />

        @error('titulo')
            <div class="mt-2">
                <livewire:mostrar-alerta :message="$message" />
            </div>
        @enderror
    </div>

    <div>
        <x-input-label for="salario" :value="__('Salario mensual')" />
        <select id="salario" wire:model.live="salario"
            class="block font-medium text-sm text-gray-700 dark:text-gray-300 mt-2 dark:bg-gray-700 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
            <option value="">-- Seleccione un salario --</option>
            @foreach ($salarios as $salario)
                <option value="{{ $salario->id }}">{{ $salario->salario }}</option>
            @endforeach
        </select>
        @error('salario')
            <div class="mt-2">
                <livewire:mostrar-alerta :message="$message" />
            </div>
        @enderror
    </div>
    <div>
        <x-input-label for="categoria" :value="__('Categoría')" />
        <select id="categoria" wire:model.live="categoria"
            class="block font-medium text-sm text-gray-700 dark:text-gray-300 mt-2 dark:bg-gray-700 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
            <option value="">-- Seleccione una categoría --</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
            @endforeach
        </select>
        @error('categoria')
            <div class="mt-2">
                <livewire:mostrar-alerta :message="$message" />
            </div>
        @enderror
    </div>
    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        <x-text-input id="empresa" type="text" class="mt-1 block w-full" wire:model.live="empresa"
            :value="old('empresa')" placeholder="Ejemplo: Google, uber, shopify, etc." />
        @error('empresa')
            <div class="mt-2">
                <livewire:mostrar-alerta :message="$message" />
            </div>
        @enderror
    </div>
    <div>
        <x-input-label for="ultimo_dia" :value="__('Ultimo Día para postularse')" />
        <x-text-input id="ultimo_dia" type="date" class="mt-1 block w-full" wire:model.live="ultimo_dia"
            :value="old('ultimo_dia')" placeholder="Último día para postularse" />
        @error('ultimo_dia')
            <div class="mt-2">
                <livewire:mostrar-alerta :message="$message" />
            </div>
        @enderror
    </div>
    <div>
        <x-input-label for="descripcion" :value="__('Descripción de la vacante')" />
        <textarea id="descripcion" wire:model.live="descripcion" rows="5"
            class="block font-medium text-sm text-gray-700 dark:text-gray-300 mt-2 dark:bg-gray-700 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
            placeholder="Descripción de la vacante">
        </textarea>
        @error('descripcion')
            <div class="mt-2">
                <livewire:mostrar-alerta :message="$message" />
            </div>
        @enderror
    </div>
    <div>
        <x-input-label for="imagen" :value="__('Imagen de la vacante')" />
        <x-text-input id="imagen" type="file" class="mt-1 block w-full" wire:model.live="imagen"
            :value="old('imagen')" placeholder="Imagen de la vacante" accept="image/*" />
        <div class="mt-2">
            @if ($imagen)
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">Vista previa de la imagen:</p>
                <img src="{{ $imagen->temporaryUrl() }}" alt="Imagen de la vacante"
                    class="w-80 h-80 object-cover rounded-lg">
            @else
                <p class="text-sm text-gray-600 dark:text-gray-300">No hay imagen aún</p>
            @endif
            
        </div>
        @error('imagen')
            <div class="mt-2">
                <livewire:mostrar-alerta :message="$message" />
            </div>
        @enderror
    </div>

    <x-primary-button class="w-full" type="submit"> {{ __('Crear Vacante') }}</x-primary-button>
</form>
