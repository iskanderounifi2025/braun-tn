<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des produits - Braun</title>
    <link rel="stylesheet" href="{{ asset('assets/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/choices.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/apexcharts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/quill.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/rangeslider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body>

    <div class="tp-main-wrapper bg-slate-100 h-screen" x-data="{ sideMenu: false }">
        
        @include('dashboard.components.sideleft')

        <div class="tp-main-content lg:ml-[250px] xl:ml-[300px] w-[calc(100% - 300px)]" x-data="{ searchOverlay: false }">
            @include('dashboard.components.header')
            
            <div class="body-content px-8 py-8 bg-slate-100">
                <div class="flex justify-between mb-10">
                    <div class="page-title">
                        <h3 class="mb-0 text-[28px]">Produits</h3>
                        <ul class="text-tiny font-medium flex items-center space-x-3 text-text3">
                            <li class="breadcrumb-item text-muted">
                                <a href="product-list.html" class="text-hover-primary"> Home</a>
                            </li>
                            <li class="breadcrumb-item flex items-center">
                                <span class="inline-block bg-text3/60 w-[4px] h-[4px] rounded-full"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">Liste de produits</li>                       
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
    
                  <form method="GET" action="{{ route('dashboard.produits.index') }}">
                    <div class="tp-search-box flex items-center justify-between px-8 py-8">
                        <div class="search-input relative">
                            <input name="search" class="input h-[44px] w-full pl-14" type="text" placeholder="Recherche  un produit par nom" value="{{ request('search') }}">
                            <button type="submit" class="absolute top-1/2 left-5 translate-y-[-50%] hover:text-theme">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M18.9999 19L14.6499 14.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="flex justify-end space-x-6">
                            <div class="search-select mr-3 flex items-center space-x-3 ">
                                <span class="text-tiny inline-block leading-none -translate-y-[2px]">Status : </span>
                                <select name="stock_filter" onchange="this.form.submit()">
                                    <option value="">Tous les produits</option>
                                    <option value="low_stock" {{ request('stock_filter') == 'low_stock' ? 'selected' : '' }}>Low Stock</option>
                                    <option value="out_of_stock" {{ request('stock_filter') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                                </select>
                            </div>
                            <div class="product-add-btn flex ">
                                <a href="{{ route('dashboard.ajouter-produits') }}" class="tp-btn">Ajouter Produit</a>
                            </div>
                        </div>
                    </div>
                </form>
                    <div class="relative overflow-x-auto mx-8">
                        <table class="w-full text-base text-left text-gray-500">
                            <thead class="bg-white">
                                <tr class="border-b border-gray6 text-tiny">
                                    <th class="py-3 w-[3%]">
                                        <div class="tp-checkbox -translate-y-[3px]">
                                            <input id="selectAllProduct" type="checkbox">
                                            <label for="selectAllProduct"></label>
                                        </div>
                                    </th>
                                    <th class="pr-8 py-3">Produit</th>
                                    <th class="px-3 py-3 w-[170px] text-end">Catégorie</th>
                                    <th class="px-3 py-3 w-[170px] text-end">SKU</th>
                                    <th class="px-3 py-3 w-[170px] text-end">Prix</th>
                                    <th class="px-3 py-3 w-[170px] text-end">Statut</th>
                                    <th class="px-3 py-3 w-[170px] text-end">Modifier</th>
                                    <th class="px-3 py-3 w-[170px] text-end">Supprimer</th>
                                    <th class="px-9 py-3 w-[12%] text-end">Détail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                @php
                                    $links = $product->additional_links ? json_decode($product->additional_links, true) : [];
                                    $firstLink = count($links) > 0 ? $links[0]['url'] : '#';
                                    $currency = session('currency', 'DT');
                                @endphp
                                <tr class="bg-white border-b border-gray6 last:border-0" 
                                    x-data="{ 
                                        showEditModal: false, 
                                        showDeleteModal: false,
                                        productData: {
                                            id: {{ $product->id }},
                                            name: '{{ addslashes($product->name) }}',
                                            sku: '{{ addslashes($product->SKU) }}',
                                            regular_price: '{{ $product->regular_price }}',
                                            sale_price: '{{ $product->sale_price }}',
                                            quantity: '{{ $product->quantity }}',
                                            description: `{{ addslashes($product->description) }}`,
                                            specifications: @json($product->specifications ?? [])
                                        },
                                        addSpecification() {
                                            this.productData.specifications.push({name: '', icon: ''});
                                        },
                                        removeSpecification(index) {
                                            this.productData.specifications.splice(index, 1);
                                        }
                                    }">
                                    <td class="pr-3">
                                        <div class="tp-checkbox">
                                            <input id="product-{{ $product->id }}" type="checkbox">
                                            <label for="product-{{ $product->id }}"></label>
                                        </div>
                                    </td>
                                    <td class="pr-8 py-5">
                                        <div class="flex items-center gap-4">
                                            <img src="{{ $firstLink }}" class="w-14 h-14 object-cover rounded-md" alt="{{ $product->name }}">
                                            <a href="{{ url('/produit/'.$product->id) }}" target="_blank"><span>{{ $product->name }}</span></a>
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 text-end">{{ $product->category->name ?? 'N/A' }}</td>
                                    <td class="px-3 py-3 text-end">{{ $product->SKU ?? 'N/A' }}</td>
                                    <td class="px-3 py-3 text-end">
                                        {{ $product->regular_price }} DT
                                        @if($product->sale_price)
                                            <span class="ml-2 line-through text-red-500">{{ $product->sale_price }} DT</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-3 text-end">
                                        <span class="text-[11px] text-success px-3 py-1 rounded-md bg-success/10 font-medium">{{ $product->status }}</span>
                                    </td>
                                   
                                    <td class="px-9 py-3 text-end">
                                        <button @click="showEditModal = true"
                                                class="w-10 h-10 text-tiny bg-success text-white rounded-md hover:bg-green-600">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </td>
                                    <td class="px-9 py-3 text-end">
                                        <button @click="showDeleteModal = true"
                                                class="w-10 h-10 text-tiny bg-white border border-gray text-slate-600 rounded-md hover:bg-danger hover:border-danger hover:text-white">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                    <td class="px-9 py-3 text-end">
                                        <a href="{{ url('/produit/'.$product->id) }}" target="_blank">
                                            <button class="w-10 h-10 text-tiny bg-white border border-gray text-slate-600 rounded-md hover:bg-info hover:border-info hover:text-white">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </a>
                                    </td>

                                    <!-- Modale de modification -->
                                    <div x-cloak x-show="showEditModal" class="fixed inset-0 z-50 overflow-y-auto">
                                        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                            <div class="fixed inset-0 transition-opacity" @click="showEditModal = false">
                                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                            </div>
                                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full" @click.stop>
                                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Modifier Produit</h3>
                                                    <form method="POST" action="{{ route('dashboard.produits.update', $product->id) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        
                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                            <!-- Informations de base -->
                                                            <div class="space-y-4">
                                                                <div>
                                                                    <label class="block text-sm font-medium text-gray-700">SKU</label>
                                                                    <input x-model="productData.sku" name="SKU" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                                                </div>
                                                                
                                                                <div>
                                                                    <label class="block text-sm font-medium text-gray-700">Nom du produit</label>
                                                                    <input x-model="productData.name" name="name" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                                                </div>
                                                                
                                                                <div>
                                                                    <label class="block text-sm font-medium text-gray-700">Description</label>
                                                                    <textarea x-model="productData.description" name="description" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- Prix et stock -->
                                                            <div class="space-y-4">
                                                                <div>
                                                                    <label class="block text-sm font-medium text-gray-700">Prix régulier (DT)</label>
                                                                    <input x-model="productData.regular_price" name="regular_price" type="number" step="0.01" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                                                </div>
                                                                
                                                                <div>
                                                                    <label class="block text-sm font-medium text-gray-700">Prix soldé (DT)</label>
                                                                    <input x-model="productData.sale_price" name="sale_price" type="number" step="0.01" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                                                </div>
                                                                
                                                                <div>
                                                                    <label class="block text-sm font-medium text-gray-700">Quantité en stock</label>
                                                                    <input x-model="productData.quantity" name="quantity" type="number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Spécifications -->
                                                        <div class="mt-6">
                                                            <h4 class="text-md font-medium text-gray-700 mb-2">Spécifications</h4>
                                                            <template x-for="(spec, index) in productData.specifications" :key="index">
                                                                <div class="flex items-end space-x-2 mb-2">
                                                                    <div class="flex-1">
                                                                        <label class="block text-sm font-medium text-gray-700">Nom</label>
                                                                        <input x-model="spec.name" :name="`specifications[${index}][name]`" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                                                    </div>
                                                                    <div>
                                                                        <label class="block text-sm font-medium text-gray-700">Icône</label>
                                                                        <input type="file" :name="`specifications[${index}][icon]`" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                                                        <template x-if="spec.icon">
                                                                            <img :src="`/storage/${spec.icon}`" class="h-10 w-10 object-cover mt-1">
                                                                        </template>
                                                                    </div>
                                                                    <button type="button" @click="removeSpecification(index)" class="mb-1 px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </template>
                                                            <button type="button" @click="addSpecification()" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                                                Ajouter une spécification
                                                            </button>
                                                        </div>
                                                        
                                                        <div class="mt-6 flex justify-end space-x-3">
                                                            <button type="button" @click="showEditModal = false" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                                                                Annuler
                                                            </button>
                                                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                                                Enregistrer
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modale de suppression -->
                                    <div x-cloak x-show="showDeleteModal" class="fixed inset-0 z-50 overflow-y-auto">
                                        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                            <div class="fixed inset-0 transition-opacity" @click="showDeleteModal = false">
                                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                            </div>
                                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" @click.stop>
                                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Supprimer le produit</h3>
                                                    <div class="mt-2">
                                                        <p class="text-sm text-gray-500">Êtes-vous sûr de vouloir supprimer ce produit? Cette action est irréversible.</p>
                                                    </div>
                                                </div>
                                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                    <form method="POST" action="{{ route('dashboard.produits.destroy', $product->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                            Supprimer
                                                        </button>
                                                    </form>
                                                    <button type="button" @click="showDeleteModal = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                        Annuler
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-8 py-4">
                            {{ $products->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.components.js')
 
</body>
</html>