<a href="{{ route('index') }}">
<div class="">
  <div class="flex flex-row items-center justify-center gap-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Colonne 1 : Vidéo (cachée en mobile) -->
    <div class="hidden md:flex justify-center text-white">
      <!-- Contenu de la vidéo -->
    </div>

    <!-- Colonne 2 : Contenu principal -->
    <div class="flex flex-col items-center text-center p-1 md:p-6 rounded-lg">
      <h2 id="promo-title" class="text-base md:text-4xl font-semibold text-white mb-1"></h2>
      <h4 id="promo-dates" class="text-base md:text-3xl font-regular text-white mb-1"></h4>
    
      <div id="countdown" class="flex flex-row justify-center gap-2 text-xl md:text-3xl font-bold transition duration-500 ease-in-out">
        <div class="flex flex-col items-center text-white rounded-full px-4 py-2" style="background-color:#c19b56">
          <span class="text-base md:text-2xl"><span id="days">00</span>J</span>
        </div>
        <div class="flex flex-col items-center text-white rounded-full px-4 py-2" style="background-color:#c19b56">
          <span class="text-base md:text-2xl"><span id="hours">00</span>H</span>
        </div>
        <div class="flex flex-col items-center text-white rounded-full px-4 py-2" style="background-color:#c19b56">
          <span class="text-base md:text-2xl"><span id="minutes">00</span>M</span>
        </div>
        <div class="flex flex-col items-center text-white rounded-full px-4 py-2" style="background-color:#c19b56">
          <span class="text-base md:text-2xl"><span id="seconds">00</span>S</span>
        </div>
      </div>
    </div>
    
    <!-- Colonne 3 : Image -->
    <div class="flex justify-center">
      <img id="promo-image"
           class="w-20 md:w-40 min-w-[80px] h-auto z-10"
           alt="Macaron">
    </div>

  </div>
</div></a>

 
<!-- Script -->
<script>
  // Variables dynamiques
  const promoTitle = "Satisfaite ou Remboursée";
  const promoStartDate = "2025-05-15"; // format YYYY-MM-DD
  const promoEndDate = "2025-08-15";   // format YYYY-MM-DD
  const promoImageUrl = "https://res.cloudinary.com/ddi29nbzl/image/upload/v1745573739/Macaron-final-2022-noir-rose_2_dzhdsv.png";

  // Remplir les éléments HTML
  document.getElementById('promo-title').innerText = promoTitle;
  document.getElementById('promo-dates').innerText = 
    `Du ${formatDate(promoStartDate)} au ${formatDate(promoEndDate)}`;
  document.getElementById('promo-image').src = promoImageUrl;

  function formatDate(dateStr) {
    const date = new Date(dateStr);
    const options = { day: '2-digit', month: 'short', year: 'numeric' };
    return date.toLocaleDateString('fr-FR', options);
  }

  // Compte à rebours
  const endDate = new Date(promoEndDate + "T23:59:59").getTime();

  const countdown = setInterval(function() {
    const now = new Date().getTime();
    const distance = endDate - now;

    if (distance < 0) {
      clearInterval(countdown);
      document.getElementById("countdown").innerHTML = "<span class='text-white'>Terminé</span>";
      return;
    }

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("days").innerText = String(days).padStart(2, '0');
    document.getElementById("hours").innerText = String(hours).padStart(2, '0');
    document.getElementById("minutes").innerText = String(minutes).padStart(2, '0');
    document.getElementById("seconds").innerText = String(seconds).padStart(2, '0');
  }, 1000);
</script>
