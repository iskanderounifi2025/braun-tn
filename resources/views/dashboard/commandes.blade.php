<!DOCTYPE html>
<html lang="en">

 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Braun - Commandes</title>
    <link rel="shortcut icon" href="assets/img/logo/favicon.png" type="image/x-icon">

    <!-- css links -->
    <link rel="stylesheet" href="{{ asset('assets/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/choices.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/apexcharts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/quill.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/rangeslider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>

    <div class="tp-main-wrapper bg-slate-100 h-screen" x-data="{ sideMenu: false }">
        @include('dashboard.components.sideleft')

        <div class="fixed top-0 left-0 w-full h-full z-40 bg-black/70 transition-all duration-300" :class="sideMenu ? 'visible opacity-1' : '  invisible opacity-0 '" x-on:click="sideMenu = ! sideMenu"> </div>

        <div class="tp-main-content lg:ml-[250px] xl:ml-[300px] w-[calc(100% - 300px)]"  x-data="{ searchOverlay: false }">
 
            @include('dashboard.components.header')

            <div class="body-content px-8 py-8 bg-slate-100">
                <div class="flex justify-between mb-10">
                    <div class="page-title">
                        <h3 class="mb-0 text-[28px]">Commandes</h3>
                        <ul class="text-tiny font-medium flex items-center space-x-3 text-text3">
                            <li class="breadcrumb-item text-muted">
                                <a href="product-list.html" class="text-hover-primary"> Accueil</a>
                            </li>
                            <li class="breadcrumb-item flex items-center">
                                <span class="inline-block bg-text3/60 w-[4px] h-[4px] rounded-full"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">Liste commandes</li>
                                           
                        </ul>
                    </div>
                </div>

                <!-- table -->
                <div class="bg-white rounded-t-md rounded-b-md shadow-xs py-4">
                    @if(session('success'))
                    <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                        <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Succès</span>
                        <div>
                            <span class="font-medium">Succès!</span>   {{ session('success') }} .
                        </div>
                    </div>
                    @endif
                
                    <div class="tp-search-box flex items-center justify-between px-8 py-8 flex-wrap">
                        <div class="search-input relative">
                            <form action="{{ route('groupedOrders') }}" method="GET">
                                <input class="input h-[44px] w-full pl-14" type="text" name="search" placeholder="Rechercher par identifiant de commande" value="{{ request('search') }}">
                                <button class="absolute top-1/2 left-5 translate-y-[-50%] hover:text-theme">
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M18.9999 19L14.6499 14.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <div class="flex justify-end gap-4 px-8 pb-4">
                            <button onclick="exportTableToCSV('commandes.csv')" class="px-4 py-2 bg-green-500 text-white rounded">Exporter CSV</button>
                            <button onclick="exportTableToPDF()" class="px-4 py-2 bg-red-500 text-white rounded">Exporter PDF</button>
                        </div>
                        
                    </div>
                
                    <div class="relative overflow-x-auto mx-8">
                        <table class="w-[1500px] 2xl:w-full text-base text-left text-gray-500">
                            <thead class="bg-white">
                                <tr class="border-b border-gray6 text-tiny">
                                    <th class="py-3 uppercase font-semibold">#REF</th>
                                    <th class="py-3 uppercase font-semibold">Date de commande</th>
                                    <th class="py-3 uppercase font-semibold">Client</th>
                                    <th class="py-3 uppercase font-semibold">Téléphone</th>
                                    <th class="py-3 uppercase font-semibold">E-mail</th>
                                    <th class="py-3 uppercase font-semibold">Gouvernorat</th>
                                    <th class="py-3 uppercase font-semibold">Adresse</th>
                                    <th class="py-3 uppercase font-semibold">Montant Total</th>
                                    <th class="py-3 uppercase font-semibold">Statut</th>
                                    <th class="py-3 uppercase font-semibold">Modifier</th>
                                    <th class="py-3 uppercase font-semibold">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($groupedOrders as $red_order => $ordersGroup)
                                    <tr class="bg-white border-b border-gray6 last:border-0 text-start">
                                        <td class="px-3 py-3">
                                            <a href="{{ route('commandes.show', $red_order) }}" class="text-blue-600 hover:underline">#{{ $red_order }}</a>
                                        </td>
                                        <td class="px-3 py-3">
                                            <a href="{{ route('commandes.show', $red_order) }}" class="text-blue-600 hover:underline">
                                                {{ \Carbon\Carbon::parse($ordersGroup[0]->date_order)->format('d, M, Y \à H\hi') }}
                                            </a>
                                        </td>
                                        <td class="px-3 py-3">
                                            {{ $ordersGroup[0]->nom }} {{ $ordersGroup[0]->prenom }}
                                        </td>
                                        <td class="px-3 py-3">{{ $ordersGroup[0]->telephone }}</td>
                                        <td class="px-3 py-3">{{ $ordersGroup[0]->email }}</td>
                                        <td class="px-3 py-3">
                                            <a href="{{ route('commandes.show', $red_order) }}" class="text-blue-600 hover:underline">
                                                {{ $ordersGroup[0]->gouvernorat }}
                                            </a>
                                        </td>
                                        <td class="px-3 py-3">{{ $ordersGroup[0]->adress }}</td>
                                        <td class="px-3 py-3">
                                            <a href="{{ route('commandes.show', $red_order) }}" class="text-blue-600 hover:underline">
                                                {{ $ordersGroup->sum('total') }} DT
                                            </a>
                                        </td>
                                        <td class="px-3 py-3">
                                            <a href="{{ route('commandes.show', $red_order) }}">
                                                @if($ordersGroup[0]->status === 'pending')
                                                    <span class="inline-block px-2 py-1 text-sm font-medium text-yellow-800 bg-yellow-100 rounded">En attente</span>
                                                @elseif($ordersGroup[0]->status === 'delivered')
                                                    <span class="inline-block px-2 py-1 text-sm font-medium text-green-800 bg-green-100 rounded">Envoyée</span>
                                                @elseif($ordersGroup[0]->status === 'canceled')
                                                    <span class="inline-block px-2 py-1 text-sm font-medium text-red-800 bg-red-100 rounded">Annulée</span>
                                                @else
                                                    <span class="inline-block px-2 py-1 text-sm font-medium text-gray-800 bg-gray-100 rounded">{{ $ordersGroup[0]->status }}</span>
                                                @endif
                                            </a>
                                        </td>
                                        <td class="px-3 py-3">
                                            <form action="{{ route('dashboard.updateStatusOrder', $ordersGroup[0]->red_order) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                                    <option value="encours" {{ $ordersGroup[0]->status == 'encours' ? 'selected' : '' }}>En attente</option>
                                                    <option value="traité" {{ $ordersGroup[0]->status == 'traité' ? 'selected' : '' }}>Envoyée</option>
                                                    <option value="annulé" {{ $ordersGroup[0]->status == 'annulé' ? 'selected' : '' }}>Annulée</option>
                                                </select>
                                                <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 text-sm">
                                                    Mettre à jour
                                                </button>
                                            </form>
                                        </td>
                                        <td class="px-9 py-3 text-end">
                                            <div class="flex justify-end space-x-2">
                                                <a href="{{ route('commandes.show', $red_order) }}" class="px-3 h-10 bg-success text-white rounded-md hover:bg-green-600" target="_blank">Voir</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                
                    <!-- Pagination -->
                    <div class="flex justify-end px-8 py-4">
                        {{ $orders->links() }}
                    </div>
                </div>
                
                   
                   
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
                
                <script>
                    function exportTableToCSV(filename) {
                        const rows = document.querySelectorAll("table tr");
                        let csv = [];
                
                        rows.forEach(row => {
                            let cols = Array.from(row.querySelectorAll("td, th"))
                                            .map(col => `"${col.innerText.replace(/"/g, '""')}"`);
                            csv.push(cols.join(","));
                        });
                
                        const blob = new Blob([csv.join("\n")], { type: "text/csv;charset=utf-8;" });
                        const link = document.createElement("a");
                
                        if (navigator.msSaveBlob) { // IE 10+
                            navigator.msSaveBlob(blob, filename);
                        } else {
                            link.href = URL.createObjectURL(blob);
                            link.setAttribute("download", filename);
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                        }
                    }
                
                    async function exportTableToPDF() {
                        const { jsPDF } = window.jspdf;
                        const doc = new jsPDF();
                
                        const table = document.querySelector("table");
                        const rows = [...table.querySelectorAll("tr")].map(row => {
                            return [...row.querySelectorAll("td, th")].map(cell => cell.innerText);
                        });
                
                        doc.autoTable({
                            head: [rows[0]],
                            body: rows.slice(1),
                            startY: 20,
                            styles: { fontSize: 8 },
                            headStyles: { fillColor: [41, 128, 185] }
                        });
                
                        doc.save("commandes.pdf");
                    }
                </script>
                
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.components.js')

    
</body>

 </html>