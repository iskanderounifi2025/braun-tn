<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listes de clients</title>
    <link rel="shortcut icon" href="assets/img/logo/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/img/logo/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/choices.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/apexcharts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/quill.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/rangeslider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- css links -->
 
</head>
<body>

    <!--  -->
    <div class="tp-main-wrapper bg-slate-100 h-screen" x-data="{ sideMenu: false }">
        @include('dashboard.components.sideleft')

        <div class="fixed top-0 left-0 w-full h-full z-40 bg-black/70 transition-all duration-300" :class="sideMenu ? 'visible opacity-1' : '  invisible opacity-0 '" x-on:click="sideMenu = ! sideMenu"> </div>

        <div class="tp-main-content lg:ml-[250px] xl:ml-[300px] w-[calc(100% - 300px)]" x-data="{ searchOverlay: false }">
            @include('dashboard.components.header')
        
            <div class="body-content px-8 py-8 bg-slate-100">
                <div class="flex justify-between mb-10">
                    <div class="page-title">
                        <h3 class="mb-0 text-[28px]">Clients</h3>
                        <ul class="text-tiny font-medium flex items-center space-x-3 text-text3">
                            <li class="breadcrumb-item text-muted">
                                <a href=" " class="text-hover-primary">Accueil</a>
                            </li>
                            <li class="breadcrumb-item flex items-center">
                                <span class="inline-block bg-text3/60 w-[4px] h-[4px] rounded-full"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">Liste des clients</li>
                        </ul>
                    </div>
                </div>
        
                <!-- table -->
                <div class="bg-white rounded-t-md rounded-b-md shadow-xs py-4">
                    <div class="tp-search-box flex items-center justify-between px-8 py-8">
                        <div class="search-input relative">
                            <form method="GET" action="{{ route('dashboard.clients.index') }}">
                                <div class="search-input relative">
                                    <input
                                        name="search"
                                        class="input h-[44px] w-full pl-14"
                                        type="text"
                                        placeholder="Rechercher par nom de client"
                                        value="{{ request('search') }}"
                                    >
                                    <button type="submit" class="absolute top-1/2 left-5 translate-y-[-50%] hover:text-theme">
                                        <!-- icône de recherche -->
                                    </button>
                                </div>
                            </form>
                            
                        </div>
                        <div class="flex justify-end space-x-6">
                           
                            <div class="product-add-btn flex ">
                               
                            </div>
                        </div>
                    </div>
                    <div class="relative overflow-x-auto mx-8">
                        <table class="w-full text-base text-left text-gray-500">
                            <thead class="bg-white">
                                <tr class="border-b border-gray6 text-tiny">
                                     
                                    <th scope="col" class="pr-8 py-3 text-tiny text-text2 uppercase font-semibold">
                                        Client
                                    </th>
                                    <th scope="col" class="px-3 py-3 text-tiny text-text2 uppercase font-semibold text-end">
                                        Email
                                    </th>
                                    <th scope="col" class="px-3 py-3 text-tiny text-text2 uppercase font-semibold text-end">
                                        Téléphone
                                    </th>
                                    <th scope="col" class="px-3 py-3 text-tiny text-text2 uppercase font-semibold w-[200px] text-end">
                                        Commandes
                                    </th>
                                    <th scope="col" class="px-3 py-3 text-tiny text-text2 uppercase font-semibold w-[250px] text-end">
                                        Dernière commande
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                <tr class="bg-white border-b border-gray6 last:border-0 text-start mx-9">
                                    <td class="pr-8 py-5 whitespace-nowrap">
                                        <div class="flex items-center space-x-5 text-heading">
                                            <div class="w-[40px] h-[40px] rounded-full bg-gray-100 flex items-center justify-center">
                                                <span class="text-lg font-medium">{{ substr($client->prenom, 0, 1) }}{{ substr($client->nom, 0, 1) }}</span>
                                            </div>
                                            <span class="font-medium">{{ $client->prenom }} {{ $client->nom }}</span>
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 text-end">
                                        <a href="{{ route('dashboard.clients.commandes', ['email' => $client->email]) }}" class="text-blue-600 hover:underline">
                                            {{ $client->email }}
                                        </a>
                                    </td>
                                    <td class="px-3 py-3 text-end">
                                        {{ $client->telephone }}
                                    </td>
                                    <td class="px-3 py-3 text-end">
                                        <span class="text-[11px] text-info px-3 py-1 rounded-md leading-none bg-info/10 font-medium">
                                            {{ $client->nombre_commandes }} commande(s)
                                        </span>
                                    </td>
                                    <td class="px-3 py-3 font-normal text-[#55585B] text-end">
                                        {{ \Carbon\Carbon::parse($client->derniere_commande)->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-9 py-3 text-end">
                                        <div class="flex items-center justify-end space-x-2">
                                            <!-- Bouton Voir Commandes -->
                                            <div class="relative" x-data="{ editTooltip: false }">
                                                <a href="{{ route('dashboard.clients.commandes', ['email' => $client->email]) }}" 
                                                   class="w-10 h-10 leading-10 text-tiny bg-success text-white rounded-md hover:bg-green-600"
                                                   x-on:mouseenter="editTooltip = true" x-on:mouseleave="editTooltip = false">
                                                    <svg class="-translate-y-px" height="12" viewBox="0 0 512 512" width="12" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill="currentColor" d="..."/>
                                                    </svg>
                                                </a>
                                                <div x-show="editTooltip" class="flex flex-col items-center z-50 absolute left-1/2 -translate-x-1/2 bottom-full mb-1">
                                                    <span class="relative z-10 p-2 text-tiny leading-none font-medium text-white whitespace-no-wrap w-max bg-slate-800 rounded py-1 px-2 inline-block">Voir commandes</span>
                                                    <div class="w-3 h-3 -mt-2 rotate-45 bg-black"></div>
                                                </div>
                                            </div>
                            
                                            <!-- Bouton Supprimer -->
 
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                    <div class="flex justify-between items-center flex-wrap mx-8">
                        <div class="pagination py-3 flex justify-end items-center mx-8">
                            {{ $clients->links() }}
                        </div>
                        
                        </p>
                        <div class="pagination py-3 flex justify-end items-center mx-8">
                            <!-- Pagination links would go here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    @include('dashboard.components.js')

    
</body>

</html>