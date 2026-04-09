@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Registrar Nuevo Cliente</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clientes.store') ?? '#' }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">Nombre</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" name="nombre" type="text" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="apellido">Apellido</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="apellido" name="apellido" type="text" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="departamento">Departamento</label>
            <select class="shadow border rounded w-full py-2 px-3 text-gray-700" id="departamento" name="departamento" required onchange="cargarMunicipios()">
                <option value="">Seleccione Departamento</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="municipio">Municipio</label>
            <select class="shadow border rounded w-full py-2 px-3 text-gray-700" id="municipio" name="municipio" required onchange="cargarDistritos()">
                <option value="">Seleccione Municipio</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="distrito">Distrito</label>
            <select class="shadow border rounded w-full py-2 px-3 text-gray-700" id="distrito" name="distrito" required>
                <option value="">Seleccione Distrito</option>
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="tipo_asentamiento">Tipo de Asentamiento</label>
            <select class="shadow border rounded w-full py-2 px-3 text-gray-700" id="tipo_asentamiento" name="tipo_asentamiento" required>
                <option value="">Seleccione</option>
                <option value="canton">Cantón</option>
                <option value="colonia">Colonia</option>
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Guardar Cliente
            </button>
        </div>
    </form>
</div>

<script>
    // Estructura simplificada de El Salvador (La nueva división política 2024: 14 Dep, 44 Mun, 262 Dist)
    // Se agregan ejemplos; puedes rellenar todos en este objeto o usar una API
    const lugaresES = {
        "San Salvador": {
            "San Salvador Centro": ["Ayutuxtepeque", "Mejicanos", "San Salvador", "Cuscatancingo", "Ciudad Delgado"],
            "San Salvador Este": ["Ilopango", "San Martín", "Soyapango", "Tonacatepeque"],
            "San Salvador Oeste": ["Apopa", "Nejapa"],
            "San Salvador Sur": ["Panchimalco", "Rosario de Mora", "San Marcos", "Santo Tomás", "Santiago Texacuangos"]
        },
        "La Libertad": {
            "La Libertad Centro": ["San Juan Opico", "Ciudad Arce"],
            "La Libertad Costa": ["Chiltiupán", "Jicalapa", "La Libertad", "Tamanique", "Teotepeque"],
            "La Libertad Este": ["Antiguo Cuscatlán", "Huizúcar", "Nuevo Cuscatlán", "San José Villanueva", "Zaragoza"],
            "La Libertad Norte": ["Quezaltepeque", "San Matías", "San Pablo Tacachico"],
            "La Libertad Oeste": ["Colón", "Jayaque", "Sacacoyo", "Tepecoyo", "Talnique"],
            "La Libertad Sur": ["Santa Tecla", "Comasagua"]
        },
       
    };

    const depSelect = document.getElementById('departamento');
    const munSelect = document.getElementById('municipio');
    const distSelect = document.getElementById('distrito');

    // Cargar Departamentos al iniciar
    window.onload = function() {
        for (let depto in lugaresES) {
            depSelect.options[depSelect.options.length] = new Option(depto, depto);
        }
    }

    function cargarMunicipios() {
        munSelect.length = 1; 
        distSelect.length = 1; 
        if(depSelect.value !== '') {
            for (let muni in lugaresES[depSelect.value]) {
                munSelect.options[munSelect.options.length] = new Option(muni, muni);
            }
        }
    }

    function cargarDistritos() {
        distSelect.length = 1; 
        if(munSelect.value !== '') {
            let distritos = lugaresES[depSelect.value][munSelect.value];
            distritos.forEach(distrito => {
                distSelect.options[distSelect.options.length] = new Option(distrito, distrito);
            });
        }
    }
</script>
@endsection
