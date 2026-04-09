<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('clientes.index') }}" class="p-1.5 hover:bg-gray-100 dark:hover:bg-[#3E3E3A] rounded-lg transition-colors text-gray-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <span>Registrar Nuevo Cliente</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-6">
        <x-card>
            <x-slot name="header">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg text-indigo-600 dark:text-indigo-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Información del Cliente</h3>
                        <p class="text-xs text-gray-500 dark:text-[#A1A09A]">Complete todos los campos para registrar al cliente en el sistema.</p>
                    </div>
                </div>
            </x-slot>

            <form action="{{ route('clientes.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <!-- Nombre y Apellido -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="nombre" class="text-sm font-bold text-gray-700 dark:text-[#EDEDEC]">Nombre</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required
                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-[#1C1C1B] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all outline-none dark:text-white">
                        @error('nombre') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="apellido" class="text-sm font-bold text-gray-700 dark:text-[#EDEDEC]">Apellido</label>
                        <input type="text" name="apellido" id="apellido" value="{{ old('apellido') }}" required
                            class="w-full px-4 py-2.5 bg-gray-50 dark:bg-[#1C1C1B] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all outline-none dark:text-white">
                        @error('apellido') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
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
                        <label for="municipio" class="text-sm font-bold text-gray-700 dark:text-[#EDEDEC]">Municipio (2024)</label>
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

                <!-- Tipo de Asentamiento -->
                <div class="space-y-2 max-w-md">
                    <label for="tipo_asentamiento" class="text-sm font-bold text-gray-700 dark:text-[#EDEDEC]">Tipo de Asentamiento</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative flex items-center p-3 rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] cursor-pointer hover:bg-gray-50 dark:hover:bg-[#1C1C1B] transition-all">
                            <input type="radio" name="tipo_asentamiento" value="canton" class="w-4 h-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                            <span class="ml-3 text-sm font-medium text-gray-700 dark:text-[#EDEDEC]">Cantón</span>
                        </label>
                        <label class="relative flex items-center p-3 rounded-xl border border-[#e3e3e0] dark:border-[#3E3E3A] cursor-pointer hover:bg-gray-50 dark:hover:bg-[#1C1C1B] transition-all">
                            <input type="radio" name="tipo_asentamiento" value="colonia" class="w-4 h-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                            <span class="ml-3 text-sm font-medium text-gray-700 dark:text-[#EDEDEC]">Colonia</span>
                        </label>
                    </div>
                    @error('tipo_asentamiento') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="pt-6">
                    <button type="submit"
                        class="w-full md:w-auto px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all hover:-translate-y-0.5 active:translate-y-0">
                        Guardar Registro de Cliente
                    </button>
                </div>
            </form>
        </x-card>
    </div>

    <script>
        // Nueva División Política Administrativa El Salvador 2024
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

        // Inicializar Departamentos
        Object.keys(lugaresES).forEach(depto => {
            depSelect.add(new Option(depto, depto));
        });

        function cargarMunicipios() {
            munSelect.length = 1;
            distSelect.length = 1;
            const depto = depSelect.value;
            if (depto) {
                Object.keys(lugaresES[depto]).forEach(muni => {
                    munSelect.add(new Option(muni, muni));
                });
            }
        }

        function cargarDistritos() {
            distSelect.length = 1;
            const depto = depSelect.value;
            const muni = munSelect.value;
            if (depto && muni) {
                lugaresES[depto][muni].forEach(dist => {
                    distSelect.add(new Option(dist, dist));
                });
            }
        }
    </script>
</x-app-layout>
