<x-app-layout>
    <x-slot name="header">
        <span class="text-gray-900 dark:text-white font-bold">Editar Cliente</span>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white dark:bg-[#161615] p-6 rounded-xl shadow">

        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nombre y Apellido -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-sm font-bold text-gray-700 dark:text-white">Nombre</label>
                    <input type="text" name="nombre" value="{{ $cliente->nombre }}"
                        class="w-full px-4 py-2 bg-gray-50 dark:bg-[#1C1C1B] 
                        border border-gray-300 dark:border-[#3E3E3A] 
                        rounded-xl text-gray-900 dark:text-white outline-none">
                </div>

                <div>
                    <label class="text-sm font-bold text-gray-700 dark:text-white">Apellido</label>
                    <input type="text" name="apellido" value="{{ $cliente->apellido }}"
                        class="w-full px-4 py-2 bg-gray-50 dark:bg-[#1C1C1B] 
                        border border-gray-300 dark:border-[#3E3E3A] 
                        rounded-xl text-gray-900 dark:text-white outline-none">
                </div>
            </div>

            <!-- Línea -->
            <div class="h-px bg-gray-200 dark:bg-[#3E3E3A]"></div>

            <!-- Ubicación -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="text-sm font-bold text-gray-700 dark:text-white">Departamento</label>
                    <select name="departamento" id="departamento" onchange="cargarMunicipios()"
                        class="w-full px-4 py-2 bg-gray-50 dark:bg-[#1C1C1B] 
                        border border-gray-300 dark:border-[#3E3E3A] 
                        rounded-xl text-gray-900 dark:text-white">
                        <option value="">Seleccione</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm font-bold text-gray-700 dark:text-white">Municipio</label>
                    <select name="municipio" id="municipio" onchange="cargarDistritos()"
                        class="w-full px-4 py-2 bg-gray-50 dark:bg-[#1C1C1B] 
                        border border-gray-300 dark:border-[#3E3E3A] 
                        rounded-xl text-gray-900 dark:text-white">
                        <option value="">Seleccione</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm font-bold text-gray-700 dark:text-white">Distrito</label>
                    <select name="distrito" id="distrito"
                        class="w-full px-4 py-2 bg-gray-50 dark:bg-[#1C1C1B] 
                        border border-gray-300 dark:border-[#3E3E3A] 
                        rounded-xl text-gray-900 dark:text-white">
                        <option value="">Seleccione</option>
                    </select>
                </div>
            </div>

            <!-- Tipo -->
            <div>
                <label class="text-sm font-bold text-gray-700 dark:text-white">Tipo de Asentamiento</label>
                <select name="tipo_asentamiento"
                    class="w-full px-4 py-2 bg-gray-50 dark:bg-[#1C1C1B] 
                    border border-gray-300 dark:border-[#3E3E3A] 
                    rounded-xl text-gray-900 dark:text-white">
                    <option value="canton" {{ $cliente->tipo_asentamiento == 'canton' ? 'selected' : '' }}>Cantón</option>
                    <option value="colonia" {{ $cliente->tipo_asentamiento == 'colonia' ? 'selected' : '' }}>Colonia</option>
                </select>
            </div>

            <!-- Botón -->
            <div class="pt-4">
                <button class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl shadow">
                    Actualizar Cliente
                </button>
            </div>

        </form>
    </div>

    <script>
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
        const clienteDepto = "{{ $cliente->departamento }}";
        const clienteMuni = "{{ $cliente->municipio }}";
        const clienteDist = "{{ $cliente->distrito }}";

        const depSelect = document.getElementById('departamento');
        const munSelect = document.getElementById('municipio');
        const distSelect = document.getElementById('distrito');

        // Cargar departamentos
        Object.keys(lugaresES).forEach(depto => {
            let selected = depto === clienteDepto ? 'selected' : '';
            depSelect.innerHTML += `<option value="${depto}" ${selected}>${depto}</option>`;
        });

        function cargarMunicipios() {
            munSelect.innerHTML = '<option value="">Seleccione</option>';
            distSelect.innerHTML = '<option value="">Seleccione</option>';

            const depto = depSelect.value;

            if (depto && lugaresES[depto]) {
                Object.keys(lugaresES[depto]).forEach(muni => {
                    let selected = muni === clienteMuni ? 'selected' : '';
                    munSelect.innerHTML += `<option value="${muni}" ${selected}>${muni}</option>`;
                });
            }
        }

        function cargarDistritos() {
            distSelect.innerHTML = '<option value="">Seleccione</option>';

            const depto = depSelect.value;
            const muni = munSelect.value;

            if (depto && muni && lugaresES[depto][muni]) {
                lugaresES[depto][muni].forEach(dist => {
                    let selected = dist === clienteDist ? 'selected' : '';
                    distSelect.innerHTML += `<option value="${dist}" ${selected}>${dist}</option>`;
                });
            }
        }

        // AUTO CARGA
        window.onload = () => {
            cargarMunicipios();
            setTimeout(() => {
                cargarDistritos();
            }, 100);
        };
    </script>
</x-app-layout>