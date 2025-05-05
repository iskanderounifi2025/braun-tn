<header class="relative z-10 bg-white border-b border-gray-200 py-4 px-6">
    <div class="flex justify-between items-center">
        <!-- Logo et menu mobile -->
        <div class="flex items-center space-x-4 lg:space-x-6">
            <button type="button" class="block lg:hidden text-gray-700" x-on:click="sideMenu = !sideMenu">
                <svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1H19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M1 6H19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M1 11H19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </button>
            <div class="hidden md:block">
                <!-- Espace pour le logo -->
             </div>
        </div>

        <!-- Actions utilisateur -->
        <div class="flex items-center space-x-4">
            <!-- Recherche mobile -->
            <div class="md:hidden">
                <button class="p-2 rounded-md text-gray-600 hover:bg-gray-100" x-on:click="searchOverlay = !searchOverlay">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M18.9999 19L14.6499 14.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>

            <!-- Notifications -->
            <div class="relative" x-data="{ notificationsOpen: false }">
                <button x-on:click="notificationsOpen = !notificationsOpen" class="p-2 rounded-md text-gray-600 hover:bg-gray-100 relative">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 10.5h.01m-4.01 0h.01M8 10.5h.01M5 5h14a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1h-6.6a1 1 0 0 0-.69.275l-2.866 2.723A.5.5 0 0 1 8 18.635V17a1 1 0 0 0-1-1H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z"/>
                      </svg>
                      
                    <span class="absolute top-0 right-0 w-5 h-5 bg-red-500 rounded-full text-xs text-white flex items-center justify-center">{{ $messagesCount }}</span>
                </button>
                
                <div x-show="notificationsOpen" x-on:click.outside="notificationsOpen = false" x-transition class="absolute right-0 mt-2 w-72 sm:w-80 bg-white rounded-md shadow-lg py-2 z-50">
                    <div class="px-4 py-3 border-b border-gray-100">
                        <h3 class="text-sm font-medium text-gray-900">Notifications</h3>
                    </div>
                    <div class="divide-y divide-gray-100">
                        <a href="{{ route('demandes.index') }}" class="flex items-center px-4 py-3 hover:bg-gray-50">
                            <div class="flex-shrink-0 bg-blue-100 rounded-md p-2">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 10.5h.01m-4.01 0h.01M8 10.5h.01M5 5h14a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1h-6.6a1 1 0 0 0-.69.275l-2.866 2.723A.5.5 0 0 1 8 18.635V17a1 1 0 0 0-1-1H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z"/>
                                  </svg>
                                  
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Nouveaux messages</p>
                                <p class="text-xs text-gray-500">{{ $messagesCount }} messages reçus en 24h</p>
                            </div>
                        </a>
                    </div>
                    <div class="px-4 py-2 text-center">
                        <a href="{{ route('demandes.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">Voir toutes</a>
                    </div>
                </div>
            </div>

            <!-- Commandes -->
            <div class="relative" x-data="{ ordersOpen: false }">
                <button x-on:click="ordersOpen = !ordersOpen" class="p-2 rounded-md text-gray-600 hover:bg-gray-100 relative">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    <span class="absolute top-0 right-0 w-5 h-5 bg-red-500 rounded-full text-xs text-white flex items-center justify-center">{{ $ordersGroupedByRedOrder->sum('count') }}</span>
                </button>
                
                <div x-show="ordersOpen" x-on:click.outside="ordersOpen = false" x-transition class="absolute right-0 mt-2 w-72 sm:w-80 bg-white rounded-md shadow-lg py-2 z-50">
                    <div class="px-4 py-3 border-b border-gray-100">
                        <h3 class="text-sm font-medium text-gray-900">Commandes</h3>
                    </div>
                    <div class="divide-y divide-gray-100 max-h-60 overflow-y-auto">
                        @foreach ($ordersGroupedByRedOrder as $orderGroup)
                        <a href="{{ route('groupedOrders') }}" class="flex items-center px-4 py-3 hover:bg-gray-50">
                            <div class="flex-shrink-0 bg-orange-100 rounded-md p-2">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Commande #{{ $orderGroup->red_order }}</p>
                                <p class="text-xs text-gray-500">{{ $orderGroup->products_count }} produits</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div class="px-4 py-2 text-center">
                        <a href="{{ route('groupedOrders') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">Voir toutes</a>
                    </div>
                </div>
            </div>

            <!-- Profil utilisateur -->
            <div class="relative" x-data="{ profileOpen: false }">
                <button x-on:click="profileOpen = !profileOpen" class="flex items-center space-x-2">
                    <div class="relative">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                          </svg>
                          
                        <span class="absolute bottom-0 right-0 w-2 h-2 bg-green-500 rounded-full border border-white"></span>
                    </div>
                    <span class="hidden md:inline text-sm font-medium text-gray-700">{{ Auth::user()->name ?? 'Utilisateur' }}</span>
                </button>
                
                <div x-show="profileOpen" x-on:click.outside="profileOpen = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                    <div class="px-4 py-2 border-b border-gray-100">
                        <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name ?? 'Utilisateur' }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email ?? 'email' }}</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                    <a href="{{ route('dashboard.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Paramètres</a>
                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Déconnexion</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Overlay de recherche mobile -->
    <div class="fixed top-0 left-0 w-full bg-white p-4 shadow-md z-50 transition-transform duration-300 md:hidden" 
         :class="searchOverlay ? 'translate-y-0' : '-translate-y-full'">
        <div class="relative">
            <input class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                   type="text" placeholder="Rechercher...">
            <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
        <div class="mt-2">
            <span class="text-xs text-gray-500 mr-2">Suggestions :</span>
            <a href="#" class="inline-block px-2 py-1 text-xs bg-gray-100 rounded-md hover:bg-gray-200">Clients</a>
            <a href="#" class="inline-block px-2 py-1 text-xs bg-gray-100 rounded-md hover:bg-gray-200">Produits</a>
            <a href="#" class="inline-block px-2 py-1 text-xs bg-gray-100 rounded-md hover:bg-gray-200">Commandes</a>
        </div>
    </div>
</header>