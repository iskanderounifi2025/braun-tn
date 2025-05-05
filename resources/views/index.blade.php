<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Découvrez les meilleurs produits Braun en Tunisie - Épilateurs, soins du visage et appareils de beauté à des prix exceptionnels">
  <meta name="keywords" content="Braun Tunisie, épilateur Braun, Silk-épil, Face Spa, soin visage, beauté, épilation">
  <meta name="robots" content="index, follow">
  <meta property="og:title" content="Braun Tunisie - Produits de beauté et épilation">
  <meta property="og:description" content="Découvrez la gamme complète des produits Braun en Tunisie">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://www.braun.tn">
  <meta property="og:image" content="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745834716/SE9_1_fmisxu.png">
  <link rel="shortcut icon" href="assets/img/logo/favicon.png" type="image/x-icon">

  <title>Braun Tunisie | Produits d'épilation et soins du visage</title>
  <link rel="canonical" href="https://www.braun.tn" />
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    .product-card {
      height: 100%;
      display: flex;
      flex-direction: column;
    }
    .card-content {
      flex-grow: 1;
    }
  </style>
</head>
 
<body class="bg-black flex items-center justify-center min-h-screen">
  @include('dashboard.components.site.nav')

  <div class="flex flex-col items-center w-full max-w-6xl py-20">
    @include('dashboard.components.site.counter')
    <!-- Première ligne avec 3 cartes -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full mb-6">
      <!-- Carte 1 - Face Spa -->
      <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden relative">
        <a href="categorie/51" class="block h-full">
          <div class="card-content p-6 pb-20">
            <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-4">
              <span class="absolute text-white font-bold flex items-center justify-center rounded-full 
                w-12 h-12 text-sm sm:w-12 sm:h-12 sm:text-base md:w-14 md:h-14 md:text-lg
                mx-28 my-16" style="background-color:#c19a55">
                -18%
              </span>

              <div class="md:w-1/2">
                <h2 class="text-xl font-bold text-gray-800">Face Spa</h2>
                <p class="text-gray-600 mb-4">À partir de : </p>
                <span class="px-5 line-through mr-2">345 DT</span><br>
                <span class="px-5 text-2xl font-bold text-black">280 DT</span>
              </div>
              
              <div class="md:w-1/2 flex justify-center md:justify-end mb-4 md:mb-0">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745834691/facespaho_ut0sie.png" 
                     alt="Braun Face Spa - Appareil de soin du visage" 
                     class="w-40 h-40 object-contain" 
                     loading="lazy" />
              </div>
            </div>

            <ul class="space-y-3 mb-6">
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745834893/40micro-grip-1_s779bt.png" 
                     alt="Icone pincettes" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">10 Pincettes d'épilation</span>
              </li>
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745835170/une-addition_1_wdznli.png" 
                     alt="Icone accessoire" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">Accessoire brosse exfoliante</span>
              </li>
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745835800/1_1_ymliue.svg" 
                     alt="Icone nettoyage" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">Nettoyage 6x plus efficace</span>
              </li>
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745835800/3-1_yjekat.svg" 
                     alt="Icone performance" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">200 mouvements par seconde</span>
              </li>
            </ul>

            <button class="absolute bottom-0 right-0 hover:text-white font-bold py-3 px-6 rounded-tl-lg transition duration-200 text-white" style="background: linear-gradient(50deg, #a28147, #c19b56);">
              Découvrir
            </button>
          </div>
        </a>
      </div>
      
      <!-- Carte 2 - Silk·épil 3 -->
      <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden relative">
        <a href="categorie/50" class="block h-full">
          <div class="card-content p-6 pb-20">
            <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-4">
              <span class="absolute text-white font-bold flex items-center justify-center rounded-full 
                w-12 h-12 text-sm sm:w-12 sm:h-12 sm:text-base md:w-14 md:h-14 md:text-lg
                mx-28 my-16" style="background-color:#c19a55">
                -23%
              </span>

              <div class="md:w-1/2">
                <h2 class="text-xl font-bold text-gray-800">Silk·épil 3</h2>
                <p class="text-gray-600 mb-4">À partir de : </p>
                <span class="px-5 line-through mr-2">209 DT</span><br>
                <span class="px-5 text-2xl font-bold text-black">160 DT</span>
              </div>
              
              <div class="md:w-1/2 flex justify-center md:justify-end mb-4 md:mb-0">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745834720/SE3_1_u7fkwo.png" 
                     alt="Braun Silk-épil 3 - Épilateur électrique" 
                     class="w-40 h-40 object-contain" 
                     loading="lazy" />
              </div>
            </div>

            <ul class="space-y-3 mb-6">
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745835274/40micro-grip-1_slbn6r.svg" 
                     alt="Icone pincettes" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">20 Pincettes d'épilation</span>
              </li>
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745835273/Smart-Light_qxtyfz.svg" 
                     alt="Icone lumière" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">Lumière intégrée</span>
              </li>
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745834887/trace_fa6pw2.png" 
                     alt="Icone utilisation" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">Utilisation surprise</span>
              </li>
            </ul>

            <button class="absolute bottom-0 right-0 hover:text-white font-bold py-3 px-6 rounded-tl-lg transition duration-200 text-white" style="background: linear-gradient(50deg, #a28147, #c19b56);">
              Découvrir
            </button>
          </div>
        </a>
      </div>
      
      <!-- Carte 3 - Silk·épil 5 -->
      <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden relative">
        <a href="categorie/52" class="block h-full">
          <div class="card-content p-6 pb-20">
            <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-4">
              <span class="absolute text-white font-bold flex items-center justify-center rounded-full 
                w-12 h-12 text-sm sm:w-12 sm:h-12 sm:text-base md:w-14 md:h-14 md:text-lg
                mx-28 my-16" style="background-color:#c19a55">
                -24%
              </span>

              <div class="md:w-1/2">
                <h2 class="text-xl font-bold text-gray-800">Silk·épil 5</h2>
                <p class="text-gray-600 mb-4">À partir de : </p>
                <span class="px-5 line-through mr-2">395 DT</span><br>
                <span class="px-5 text-2xl font-bold text-black">300 DT</span>
              </div>
              
              <div class="md:w-1/2 flex justify-center md:justify-end mb-4 md:mb-0">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745834721/SP5_1_btgeww.png" 
                     alt="Braun Silk-épil 5 - Épilateur électrique perfectionné" 
                     class="w-40 h-40 object-contain" 
                     loading="lazy" />
              </div>
            </div>

            <ul class="space-y-3 mb-6">
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745834893/40micro-grip-1_s779bt.png" 
                     alt="Icone pincettes" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">28 Pincettes d'épilation</span>
              </li>
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745834889/Smart-Light-1_hhhzqs.png" 
                     alt="Icone lumière" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">Lumière intégrée</span>
              </li>
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745835171/svgviewer-png-output_zolmwi.png" 
                     alt="Icone capteur" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">Capteur de pression</span>
              </li>
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745834893/wetdry_h6ica9.png" 
                     alt="Icone eau" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">Fonctionne sous l'eau</span>
              </li>
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745834895/batterie_lvjpxb.png" 
                     alt="Icone batterie" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">30 min d'autonomie</span>
              </li>
            </ul>

            <button class="absolute bottom-0 right-0 hover:text-white font-bold py-3 px-6 rounded-tl-lg transition duration-200 text-white" style="background: linear-gradient(50deg, #a28147, #c19b56);">
              Découvrir
            </button>
          </div>
        </a>
      </div>
    </div>

    <!-- Deuxième ligne avec 2 cartes centrées -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full md:w-2/3">
      <!-- Carte 4 - Silk·épil 9 -->
      <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden relative">
        <a href="categorie/53" class="block h-full">
          <div class="card-content p-6 pb-20">
            <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-4">
              <span class="absolute text-white font-bold flex items-center justify-center rounded-full 
                w-12 h-12 text-sm sm:w-12 sm:h-12 sm:text-base md:w-14 md:h-14 md:text-lg
                mx-28 my-16" style="background-color:#c19a55">
                -23%
              </span>

              <div class="md:w-1/2">
                <h2 class="text-xl font-bold text-gray-800">Silk·épil 9</h2>
                <p class="text-gray-600 mb-4">À partir de : </p>
                <span class="px-5 line-through mr-2">783 DT</span><br>
                <span class="px-5 text-2xl font-bold text-black">600 DT</span>
              </div>
              
              <div class="md:w-1/2 flex justify-center md:justify-end mb-4 md:mb-0">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745834717/SE9F_1_x1rzec.png" 
                     alt="Braun Silk-épil 9 - Épilateur haut de gamme" 
                     class="w-40 h-40 object-contain" 
                     loading="lazy" />
              </div>
            </div>

            <ul class="space-y-3 mb-6">
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745834893/40micro-grip-1_s779bt.png" 
                     alt="Icone pincettes" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">40 Pincettes d'épilation</span>
              </li>
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745834894/Smart-Light_iabb8q.png" 
                     alt="Icone lumière" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">Lumière intégrée</span>
              </li>
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745835171/svgviewer-png-output_zolmwi.png" 
                     alt="Icone capteur" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">Capteur de pression</span>
              </li>
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745834893/wetdry_h6ica9.png" 
                     alt="Icone eau" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">Fonctionne sous l'eau</span>
              </li>
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745834895/batterie_lvjpxb.png" 
                     alt="Icone batterie" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">50 min d'autonomie</span>
              </li>
            </ul>

            <button class="absolute bottom-0 right-0 hover:text-white font-bold py-3 px-6 rounded-tl-lg transition duration-200 text-white" style="background: linear-gradient(50deg, #a28147, #c19b56);">
              Découvrir
            </button>
          </div>
        </a>
      </div>
      
      <!-- Carte 5 - Silk·épil 9 Flex -->
      <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden relative">
        <a href="categorie/54" class="block h-full">
          <div class="card-content p-6 pb-20">
            <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-4">
              <span class="absolute text-white font-bold flex items-center justify-center rounded-full 
                w-12 h-12 text-sm sm:w-12 sm:h-12 sm:text-base md:w-14 md:h-14 md:text-lg
                mx-24 my-16" style="background-color:#c19a55">
                -24%
              </span>

              <div class="md:w-1/2">
                <h2 class="text-xl font-bold text-gray-800">Silk·épil 9 Flex</h2>
                <p class="text-gray-600 mb-4">À partir de : </p>
                <span class="px-5 line-through mr-2">1251 DT</span><br>
                <span class="px-5 text-xl font-bold text-black">950 DT</span>
              </div>
              
              <div class="md:w-1/2 flex justify-center md:justify-end mb-4 md:mb-0">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745834716/SE9_1_fmisxu.png" 
                     alt="Braun Silk-épil 9 Flex - Épilateur flexible" 
                     class="w-40 h-40 object-contain" 
                     loading="lazy" />
              </div>
            </div>

            <ul class="space-y-3 mb-6">
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745835276/flexible-1_us66tq.svg" 
                     alt="Icone flexible" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">Tête entièrement flexible</span>
              </li>
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745835274/40micro-grip-1_slbn6r.svg" 
                     alt="Icone pincettes" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">40 Pincettes d'épilation</span>
              </li>
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745835282/Smart-Light-1_r2x5vn.svg" 
                     alt="Icone lumière" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">Lumière intégrée</span>
              </li>
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745835171/svgviewer-png-output_zolmwi.png" 
                     alt="Icone capteur" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">Capteur de pression</span>
              </li>
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745834893/wetdry_h6ica9.png" 
                     alt="Icone eau" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">Fonctionne sous l'eau</span>
              </li>
              <li class="flex items-center">
                <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745834895/batterie_lvjpxb.png" 
                     alt="Icone batterie" class="w-5 h-5 mr-3" loading="lazy" />
                <span class="text-gray-700">50 min d'autonomie</span>
              </li>
            </ul>

            <button class="absolute bottom-0 right-0 hover:text-white font-bold py-3 px-6 rounded-tl-lg transition duration-200 text-white" style="background: linear-gradient(50deg, #a28147, #c19b56);">
              Découvrir
            </button>
          </div>
        </a>
      </div>
    </div>
  </div>
  
  <!-- Schema.org markup for Google -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "Braun Tunisie",
    "url": "https://www.braun.tn",
    "potentialAction": {
      "@type": "SearchAction",
      "target": "https://www.braun.tn/search?q={search_term_string}",
      "query-input": "required name=search_term_string"
    }
  }
  </script>
</body>
</html>