<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('clientes.index') }}" class="p-1.5 hover:bg-gray-100 dark:hover:bg-[#3E3E3A] rounded-lg transition-colors text-gray-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <span>Editar Cliente: {{ $cliente->nombre }} {{ $cliente->apellido }}</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-6">
        <x-card>
            <x-slot name="header">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg text-blue-600 dark:text-blue-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Actualizar Información</h3>
                        <p class="text-xs text-gray-500 dark:text-[#A1A09A]">Modifique los campos necesarios para actualizar el registro del cliente.</p>
                    </div>
                </div>
            </x-slot>

            <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Nombre y Apellido -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="nombre" class="text-sm font-bold text-gray-700 dark:text-[#EDEDEC]">Nombre</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $cliente->nombre) }}" required
                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-[#1C1C1B] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all outline-none dark:text-white">
                        @error('nombre') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="apellido" class="text-sm font-bold text-gray-700 dark:text-[#EDEDEC]">Apellido</label>
                        <input type="text" name="apellido" id="apellido" value="{{ old('apellido', $cliente->apellido) }}" required
                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-[#1C1C1B] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all outline-none dark:text-white">
                        @error('apellido') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="h-px bg-[#e3e3e0] dark:bg-[#3E3E3A] my-2"></div>

                <!-- Detalles de Contacto y Documento -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="dui" class="text-sm font-bold text-gray-700 dark:text-[#EDEDEC]">DUI</label>
                        <input type="text" name="dui" id="dui" value="{{ old('dui', $cliente->dui) }}" required placeholder="00000000-0"
                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-[#1C1C1B] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all outline-none dark:text-white">
                        @error('dui') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="nrc" class="text-sm font-bold text-gray-700 dark:text-[#EDEDEC]">NRC</label>
                        <input type="text" name="nrc" id="nrc" value="{{ old('nrc', $cliente->nrc) }}" placeholder="000000-0"
                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-[#1C1C1B] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all outline-none dark:text-white">
                        @error('nrc') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="telefono" class="text-sm font-bold text-gray-700 dark:text-[#EDEDEC]">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $cliente->telefono) }}" required placeholder="XXXX-XXXX"
                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-[#1C1C1B] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all outline-none dark:text-white">
                        @error('telefono') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label for="correo_electronico" class="text-sm font-bold text-gray-700 dark:text-[#EDEDEC]">Correo Electrónico</label>
                        <input type="email" name="correo_electronico" id="correo_electronico" value="{{ old('correo_electronico', $cliente->correo_electronico) }}" placeholder="ejemplo@correo.com"
                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-[#1C1C1B] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all outline-none dark:text-white">
                        @error('correo_electronico') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="h-px bg-[#e3e3e0] dark:bg-[#3E3E3A] my-2"></div>

                <!-- Ubicación Geográfica -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Departamento -->
                    <div class="space-y-2">
                        <label for="departamento" class="text-sm font-bold text-gray-700 dark:text-[#EDEDEC]">Departamento</label>
                        <select name="departamento" id="departamento" required onchange="cargarMunicipios()"
                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-[#1C1C1B] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none dark:text-white">
                            <option value="">Seleccione Departamento</option>
                        </select>
                        @error('departamento') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Municipio -->
                    <div class="space-y-2">
                        <label for="municipio" class="text-sm font-bold text-gray-700 dark:text-[#EDEDEC]">Municipio</label>
                        <select name="municipio" id="municipio" required onchange="cargarDistritos()"
                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-[#1C1C1B] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none dark:text-white">
                            <option value="">Seleccione Municipio</option>
                        </select>
                        @error('municipio') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Distrito -->
                    <div class="space-y-2">
                        <label for="distrito" class="text-sm font-bold text-gray-700 dark:text-[#EDEDEC]">Distrito</label>
                        <select name="distrito" id="distrito" required
                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-[#1C1C1B] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none dark:text-white">
                            <option value="">Seleccione Distrito</option>
                        </select>
                        @error('distrito') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Dirección Completa -->
                <div class="space-y-2">
                    <label for="direccion_completa" class="text-sm font-bold text-gray-700 dark:text-[#EDEDEC]">Dirección Completa (Colonia, Avenida, Casa)</label>
                    <textarea name="direccion_completa" id="direccion_completa" rows="2" required
                        class="w-full px-4 py-2.5 bg-gray-50 dark:bg-[#1C1C1B] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all outline-none dark:text-white resize-none">{{ old('direccion_completa', $cliente->direccion_completa) }}</textarea>
                    @error('direccion_completa') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>


                <div class="pt-6 flex gap-4">
                    <button type="submit"
                        class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all hover:-translate-y-0.5 active:translate-y-0 text-sm uppercase tracking-wider">
                        Actualizar Cliente
                    </button>
                    <a href="{{ route('clientes.index') }}"
                        class="px-8 py-3 bg-gray-100 dark:bg-[#3E3E3A] text-gray-700 dark:text-[#EDEDEC] font-bold rounded-xl transition-all hover:bg-gray-200 dark:hover:bg-[#4E4E4A] text-sm uppercase tracking-wider">
                        Cancelar
                    </a>
                </div>
            </form>
        </x-card>
    </div>

    <script>
        // Nueva División Política Administrativa El Salvador 2024 (Mismo objeto que create.blade.php)
        const lugaresES = {
            "Ahuachapán": {
                "Ahuachapán Norte": ["Atiquizaya", "El Refugio", "San Lorenzo", "Turín"],
                "Ahuachapán Centro": ["Ahuachapán", "Apaneca", "Concepción de Ataco", "Tacuba"],
                "Ahuachapán Sur": ["Guaymango", "Jujutla", "San Francisco Menéndez", "San Pedro Puxtla"]
            },
            "Santa Ana": {
                "Santa Ana Norte": ["Masahuat", "Metapán", "Santa Rosa Guachipilín"],
                "Santa Ana Centro": ["Santa Ana"],
                "Santa Ana Este": ["Coatepeque", "El Congo"],
                "Santa Ana Oeste": ["Candelaria de la Frontera", "Chalchuapa", "El Porvenir", "San Antonio Pajonal", "San Sebastián Salitrillo", "Santiago de la Frontera"]
            },
            "Sonsonate": {
                "Sonsonate Norte": ["Juayúa", "Nahuizalco", "Salcoatitán", "Santa Catarina Masahuat"],
                "Sonsonate Centro": ["Sonsonate", "Santo Domingo de Guzmán", "Sonzacate"],
                "Sonsonate Este": ["Armenia", "Caluco", "Cuisnahuat", "Izalco", "San Julián", "Santa Isabel Ishuatán"],
                "Sonsonate Oeste": ["Acajutla"]
            },
            "Chalatenango": {
                "Chalatenango Norte": ["La Palma", "Citalá", "San Ignacio"],
                "Chalatenango Centro": ["Nueva Concepción", "Tejutla", "Arcatao", "Azacualpa", "Comalapa", "Concepción Quezaltepeque", "El Carrizal", "La Laguna", "Las Vueltas", "Nombre de Jesús", "Nueva Trinidad", "Ojos de Agua", "Potonico", "San Antonio de la Cruz", "San Antonio Los Ranchos", "San Francisco Lempa", "San Isidro Labrador", "San José Cancasque", "San Miguel de Mercedes", "San José las Flores", "San Luis del Carmen"],
                "Chalatenango Sur": ["Chalatenango", "Agua Caliente", "Dulce Nombre de María", "El Paraíso", "La Reina", "San Fernando", "San Rafael", "Santa Rita"]
            },
            "La Libertad": {
                "La Libertad Norte": ["Quezaltepeque", "San Matías", "San Pablo Tacachico"],
                "La Libertad Centro": ["Santa Tecla", "San José Villanueva"],
                "La Libertad Oeste": ["Colón", "Jayaque", "Sacacoyo", "Tepecoyo", "Talnique"],
                "La Libertad Este": ["Antiguo Cuscatlán", "Huizúcar", "Nuevo Cuscatlán", "San José Villanueva", "Zaragoza"],
                "La Libertad Costa": ["Chiltiupán", "Jicalapa", "La Libertad", "Tamanique", "Teotepeque"],
                "La Libertad Sur": ["Comasagua", "Santa Tecla"]
            },
            "San Salvador": {
                "San Salvador Norte": ["Aguilares", "El Paisnal", "Guazapa"],
                "San Salvador Oeste": ["Apopa", "Nejapa"],
                "San Salvador Este": ["Ilopango", "San Martín", "Soyapango", "Tonacatepeque"],
                "San Salvador Centro": ["Ayutuxtepeque", "Ciudad Delgado", "Cuscatancingo", "Mejicanos", "San Salvador"],
                "San Salvador Sur": ["Panchimalco", "Rosario de Mora", "San Marcos", "Santo Tomás", "Santiago Texacuangos"]
            },
            "Cuscatlán": {
                "Cuscatlán Norte": ["Suchitoto", "San José Guayabal", "Oratorio de Concepción", "San Bartolomé Perulapía", "San Pedro Perulapán"],
                "Cuscatlán Sur": ["Cojutepeque", "San Rafael Cedros", "Candelaria", "Monte San Juan", "El Carmen", "San Cristóbal", "Santa Cruz Michapa", "San Ramón", "El Rosario", "Santa Cruz Analquito", "Tenancingo"]
            },
            "La Paz": {
                "La Paz Norte": ["Cuyultitán", "Olocuilta", "San Francisco Chinameca", "San Juan Talpa", "San Luis Talpa", "San Pedro Masahuat", "Tapalhuaca", "San Emigdio"],
                "La Paz Centro": ["Zacatecoluca", "San Juan Nonualco", "San Rafael Obrajuelo"],
                "La Paz Este": ["San Miguel Tepezontes", "San Pedro Nonualco", "Santa María Ostuma", "Santiago Nonualco"]
            },
            "Cabañas": {
                "Cabañas Este": ["Ilobasco", "Tejutepeque"],
                "Cabañas Oeste": ["Sensuntepeque", "Cinquera", "Dolores", "Guacotecti", "Jutiapa", "San Isidro", "Villa Victoria"]
            },
            "San Vicente": {
                "San Vicente Norte": ["Apastepeque", "Santa Clara", "San Ildefonso", "San Esteban Catarina", "San Lorenzo", "Santo Domingo"],
                "San Vicente Sur": ["San Vicente", "Guadalupe", "San Cayetano Istepeque", "Tecoluca", "Tepetitán", "Verapaz"]
            },
            "Usulután": {
                "Usulután Norte": ["Santiago de María", "Alegría", "Berlín", "Mercedes Umaña", "Tepechontes", "Estanzuelas", "Nueva Granada", "San Buenaventura"],
                "Usulután Este": ["Usulután", "Jucuapa", "Santa Elena", "San Dionisio", "Concepción Batres", "Ozatlán", "Tecapán", "El Triunfo"],
                "Usulután Sur": ["Jiquilisco", "Puerto El Triunfo", "San Agustín", "San Francisco Javier"]
            },
            "San Miguel": {
                "San Miguel Norte": ["Ciudad Barrios", "Sesori", "Carolina", "San Gerardo", "San Luis de la Reina", "San Antonio del Mosco", "Chapeltique"],
                "San Miguel Centro": ["San Miguel", "Comacarán", "Uluazapa", "Moncagua", "Quelepa", "Chirilagua"],
                "San Miguel Oeste": ["Nueva Guadalupe", "Lolotique", "San Jorge", "Chinameca", "El Tránsito"]
            },
            "Morazán": {
                "Morazán Norte": ["Jocoaitique", "San Fernando", "Meanguera", "El Rosario", "Gualococti", "Joateca", "Corinto", "Delicias de Concepción", "Perquín", "Arambala", "Torola", "San Isidro"],
                "Morazán Sur": ["San Francisco Gotera", "Sociedad", "Cacaopera", "Chilanga", "El Divisadero", "San Carlos", "San Simón", "Sensembra", "Yamabal", "Yoloaiquín"]
            },
            "La Unión": {
                "La Unión Norte": ["Anamorós", "Bolívar", "Concepción de Oriente", "El Sauce", "Lislique", "Nueva Esparta", "Pasaquina", "Polorós", "San José La Fuente", "Santa Rosa de Lima"],
                "La Unión Sur": ["La Unión", "Conchagua", "El Carmen", "Intipucá", "Meanguera del Golfo", "San Alejo", "Yayantique", "Yucuaiquín"]
            }
        };

        const depSelect = document.getElementById('departamento');
        const munSelect = document.getElementById('municipio');
        const distSelect = document.getElementById('distrito');

        // Valores iniciales (datos del cliente)
        const initialDepto = "{{ old('departamento', $cliente->departamento) }}";
        const initialMuni = "{{ old('municipio', $cliente->municipio) }}";
        const initialDist = "{{ old('distrito', $cliente->distrito) }}";

        // Inicializar Departamentos
        Object.keys(lugaresES).forEach(depto => {
            const option = new Option(depto, depto);
            if (depto === initialDepto) option.selected = true;
            depSelect.add(option);
        });

        // Cargar Municipios inicialmente si hay un departamento seleccionado
        if (initialDepto) {
            cargarMunicipios(initialMuni);
        }

        // Cargar Distritos inicialmente si hay un municipio seleccionado
        if (initialMuni) {
            cargarDistritos(initialDist);
        }

        function cargarMunicipios(selectedMuni = null) {
            munSelect.length = 1;
            distSelect.length = 1;
            const depto = depSelect.value;
            if (depto) {
                Object.keys(lugaresES[depto]).forEach(muni => {
                    const option = new Option(muni, muni);
                    if (muni === selectedMuni) option.selected = true;
                    munSelect.add(option);
                });
            }
        }

        function cargarDistritos(selectedDist = null) {
            distSelect.length = 1;
            const depto = depSelect.value;
            const muni = munSelect.value;
            if (depto && muni) {
                lugaresES[depto][muni].forEach(dist => {
                    const option = new Option(dist, dist);
                    if (dist === selectedDist) option.selected = true;
                    distSelect.add(option);
                });
            }
        }
    </script>
</x-app-layout>
