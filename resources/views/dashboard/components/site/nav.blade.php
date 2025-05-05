<!-- Navbar Desktop -->
@include('dashboard.components.site.button-letral')
<nav class="bg-white fixed z-20 top-0 start-0 border-b border-gray-200 hidden w-full md:flex">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-center mx-auto p-4">
    <div class="items-center justify-center hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
      <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-white md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">

        <!-- Accueil -->
        <li>
          <a href="{{ route('index') }}"
             class="block py-2 px-3 rounded-full transition 
             {{ request()->routeIs('index') ? 'bg-black text-white' : 'text-black hover:bg-black hover:text-white' }}">
            Accueil
          </a>
        </li>

        <!-- Contact -->
        <li>
          <a href="{{ route('devenir-revendeur.store') }}"
             class="block py-2 px-3 rounded-full transition
             {{ request()->routeIs('devenir-revendeur.store') ? 'bg-black text-white' : 'text-black hover:bg-black hover:text-white' }}">
            Contact
          </a>
        </li>

        <!-- Logo -->
        <a href="{{ route('index') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
          <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745420211/braun.tn/logo/vfqv40by0uco5dvofusj.png" class="h-8" alt="Logo">
        </a>

        <!-- Remboursement -->
        <li>
          <a href="{{ route('politique-de-remboursement') }}"
             class="block py-2 px-3 rounded-full transition
             {{ request()->routeIs('politique-de-remboursement') ? 'bg-black text-white' : 'text-black hover:bg-black hover:text-white' }}">
            Remboursement
          </a>
        </li>

        @include('dashboard.components.site.shopping-cart')
      </ul>
    </div>
  </div>
</nav>

<!-- Navbar Mobile -->
<nav class="bg-white fixed w-full z-20 top-0 start-0 border-b border-gray-200 md:hidden">
  <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">

    <!-- Logo -->
    <a href="{{ route('index') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="https://res.cloudinary.com/ddi29nbzl/image/upload/v1745420211/braun.tn/logo/vfqv40by0uco5dvofusj.png" class="h-8" alt="Logo" />
    </a>

    <!-- Zone icônes (panier + menu) -->
    <div class="flex items-center space-x-4">
      <!-- Panier -->
      <button id="mobileCartToggle" class="text-gray-700 hover:text-black">
        <ul class="flex flex-col p-4 font-medium border border-gray-100 rounded-lg bg-white">
          @include('dashboard.components.site.shopping-cart')
        </ul>
      </button>

      <!-- Menu hamburger -->
      <button id="mobile-menu-button" class="p-2 text-sm text-gray-500 rounded-lg hover:bg-gray-100">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>
  </div>

  <!-- Menu mobile caché par défaut -->
  <div id="mobile-menu" class="hidden px-4 pb-4">
    <ul class="flex flex-col space-y-2 font-medium">

      <li>
        <a href="{{ route('index') }}"
           class="block py-2 px-3 rounded-full transition
           {{ request()->routeIs('index') ? 'bg-black text-white' : 'text-black hover:bg-black hover:text-white' }}">
          Accueil
        </a>
      </li>

      <li>
        <a href="{{ route('politique-de-remboursement') }}"
           class="block py-2 px-3 rounded-full transition
           {{ request()->routeIs('politique-de-remboursement') ? 'bg-black text-white' : 'text-black hover:bg-black hover:text-white' }}">
          Remboursement
        </a>
      </li>

      <li>
        <a href="{{ route('devenir-revendeur.store') }}"
           class="block py-2 px-3 rounded-full transition
           {{ request()->routeIs('devenir-revendeur.store') ? 'bg-black text-white' : 'text-black hover:bg-black hover:text-white' }}">
          Contact
        </a>
      </li>

    </ul>
  </div>
</nav>

<!-- Script pour toggle menu mobile -->
<script>
  const menuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');

  menuButton.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
</script>
