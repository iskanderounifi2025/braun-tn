<!DOCTYPE html>
<html lang="fr">
<head>
  @php
  $links = $product->additional_links ? json_decode($product->additional_links, true) : [];
  $firstLink = count($links) > 0 ? $links[0]['url'] : '#';
  $secondLink = count($links) > 1 ? $links[1]['url'] : $firstLink;
  $currency = session('currency', 'DT');
@endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
    <title>{{ $product->name }} - Acheter {{ $product->category->name ?? 'Produit' }} en Tunisie | NomDeTonSite</title>
    <meta name="description" content="{{ Str::limit(strip_tags($product->desciption), 160) }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/produit/'.$product->id) }}">
  
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="product">
    <meta property="og:title" content="{{ $product->name }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($product->desciption), 160) }}">
    <meta property="og:image" content="{{ $firstLink }}">
    <meta property="og:url" content="{{ url('/produit/'.$product->id) }}">
    <meta property="og:site_name" content="Braun Tunisie">
  
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $product->name }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($product->desciption), 160) }}">
    <meta name="twitter:image" content="{{ $firstLink }}">
    <link rel="shortcut icon" href="https://res.cloudinary.com/dlhonl1wo/image/upload/v1747046500/favicon_tvqtpu.png" type="image/x-icon">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	 <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
      <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>


 
<body class="py-20 md:py-16 bg-black flex flex-col min-h-screen">

  @include('dashboard.components.site.nav')
  <div class="">
    @include('dashboard.components.site.counter')
</div>
  
    <div class="container mx-auto px-4 py-10 max-w-6xl bg-white rounded-lg">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Colonne gauche - Images -->
 
           <!-- Swiper container -->
<div class="w-full md:w-1/2 bg-white rounded-lg relative">
  @php
  $links = $product->additional_links ? json_decode($product->additional_links, true) : [];
  $firstLink = count($links) > 0 ? $links[0]['url'] : '#';
  $currency = session('currency', 'DT'); // ici tu peux changer dynamiquement avec la session
@endphp

    <!-- Badge promo -->
    @if ($product->sale_price > 0 && $product->regular_price > 0)
    @php
        $discount = round(100 - ($product->sale_price / $product->regular_price * 100));
    @endphp
    <span class="absolute top-2 right-2 text-white text-xs px-1 py-3 rounded-full z-10 h-[40px] w-[40px]" style="background: linear-gradient(50deg, #a28147, #c19b56);">
        -{{ $discount }}%
    </span>
@endif  
    @if ($product->additional_links)
    @php
        $images = json_decode($product->additional_links, true);
    @endphp

    <div class="swiper mySwiper rounded-lg overflow-hidden">
        <div class="swiper-wrapper">
            @foreach ($images as $img)
                <div class="swiper-slide">
                    <img src="{{ $img['url'] }}" alt="Vue Produit" class="w-full h-auto rounded-lg">
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination mt-4 text-black"></div>
    </div>
@endif

  </div>
  
            
            <!-- Colonne droite - Détails produit -->
            <div class="w-full md:w-1/2">
                <div class="bg-white p-0">
                    <!-- Titre et promo -->
                    <h1 class="text-3xl font-bold text-black mb-2"> {{ $product->category->name ?? 'N/A' }}</h1>
                    <a href="{{ url('/produit/'.$product->id) }}"><h2 class="text-3xl font-bold text-black mb-2">{{ $product->name }}</h2>
                    </a>
                    
                    <!-- Prix -->
                    <div class="flex items-center mb-4">
                        <span class="text-2xl font-bold text-black"> {{ number_format($product->sale_price > 0 ? $product->sale_price : $product->regular_price) }} DT</span>
                        @if($product->sale_price > 0)
                        <span class="text-lg text-gray-500 line-through ml-2"> {{ number_format($product->regular_price) }} DT</span>
                        @endif

                      </div>
                    
                    <!-- Description -->
                    <p class="text-black mb-6">
                      {{ $product->desciption
                      }} 
                    </p>
                    
                    <!-- Catégories -->
                    <div class="space-y-2 mb-6"> 
                      @if ($product->specifications)
                          @php
                              $specs = json_decode($product->specifications, true);
                          @endphp
                  
                          @foreach ($specs as $spec)
                              <div class="flex items-center">
                                  <img src="{{ asset('storage/' . ($spec['icon'] ?? 'default-icon.png')) }}" alt="{{ $spec['name'] }}" class="w-5 h-5 mr-2">
                                  <span class="text-sm text-black">{{ $spec['name'] }}</span>
                              </div>
                          @endforeach
                      @else
                          <div class="text-sm text-gray-500">Aucune spécification disponible.</div>
                      @endif
                  </div>
                  
                    
                    <!-- Sélecteur de quantité -->
                    <div class="flex items-center gap-4 mb-6">
  
                        <!-- Sélecteur de quantité -->
                        <div class="flex border border-gray-300 rounded-full bg-white">
                          <button class="px-3 py-1 bg-white hover:bg-gray-200 text-gray-600 rounded-full" onclick="updateQty(-1)">
                            <i class="fas fa-minus"></i>
                          </button>
                          <input type="text" value="1" class="w-12 text-center border-x border-gray-300" id="quantity">
                          <button class="px-3 py-1 bg-white hover:bg-gray-200 text-gray-600 rounded-full" onclick="updateQty(1)">
                            <i class="fas fa-plus"></i>
                          </button>
                        </div>
                        
                        <!-- Bouton d'action avec intégration du panier -->
                        <button 
                          class="text-white py-2 px-5 rounded-full font-medium transition duration-200 flex items-center justify-center"
                          onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->sale_price ?? $product->regular_price }}, '{{ $firstLink }}', parseInt(document.getElementById('quantity').value))"
                          style="background: linear-gradient(50deg, #a28147, #c19b56);">
                          <i class="fas fa-shopping-cart mr-2"></i>
                          Ajouter au panier
                        </button>
                        
                        <script>
                          function updateQty(amount) {
                            const qtyInput = document.getElementById('quantity');
                            let current = parseInt(qtyInput.value) || 1;
                            current = Math.max(1, current + amount);
                            qtyInput.value = current;
                          }
                        
                          function addToCart(id, name, price, image = '/placeholder.jpg', quantity = 1) {
                            const cart = Cart.getCart();
                            const existing = cart.find(p => p.id === id);
                            if (existing) {
                              existing.quantity += quantity;
                            } else {
                              cart.push({ id, name, price, quantity, image });
                            }
                            Cart.saveCart(cart);
                            Cart.updateUI();
                            toggleCart();
                          }
                        </script>
                        

                        
                      </div>
                      
                </div>
            </div>

            <script>
              const swiper = new Swiper('.mySwiper', {
                loop: true,
                pagination: {
                  el: '.swiper-pagination',
                  clickable: true,
                },
              });
            </script>
            
        </div>
    </div>
<!--
<div class="container mx-auto p-8 max-w-6xl bg-white rounded-lg">
  <div class="relative w-full h-0" style="padding-bottom: 56.25%;">
    <iframe
      class="absolute top-0 left-0 w-full h-full rounded-lg"
      src="https://www.youtube.com/embed/WW5-e5BRA30?autoplay=1&mute=1"
      title="YouTube video player"
      frameborder="0"
      allow="autoplay; encrypted-media"
      allowfullscreen
    ></iframe>
  </div>
</div>
-->
<br><br>
@include('dashboard.components.site.footer')

    
</body>
</html>