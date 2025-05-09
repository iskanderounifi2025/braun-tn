<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Braun - profile</title>
    <link rel="shortcut icon" href="../assets/img/logo/favicon.png" type="image/x-icon">

    <!-- css links -->
    @include('dashboard.components.style')
</head>

<body>

 
     <div class="tp-main-wrapper bg-slate-100 h-screen" x-data="{ sideMenu: false }">
        @include('dashboard.components.sideleft')
    
        <div class="fixed top-0 left-0 w-full h-full z-40 bg-black/70 transition-all duration-300" :class="sideMenu ? 'visible opacity-1' : 'invisible opacity-0 '" x-on:click="sideMenu = ! sideMenu"> </div>
    
        <div class="tp-main-content lg:ml-[250px] xl:ml-[300px] w-[calc(100% - 300px)]" x-data="{ searchOverlay: false }">
            @include('dashboard.components.header')
    
            <div class="body-content px-8 py-8 bg-slate-100">
                <div class="flex justify-between mb-10">
                    <div class="page-title">
                        <h3 class="mb-0 text-[28px]">
                            <div class="">
                                <h5 class="text-xl mb-0">{{ $user->name }}</h5>
                                <p class="text-tiny mb-0">{{ $user->email }}</p>
                            </div>
                        </h3>
                    </div>
                </div>
    
                <div class="grid grid-cols-12 gap-6">
                    <!-- Informations de base -->
                    <div class="col-span-12 xl:col-span-8">
                        <div class="py-10 px-10 bg-white rounded-md">
                            <h5 class="text-xl mb-6">Informations de base</h5>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div class="mb-5">
                                    <p class="mb-0 text-base text-black">Nom</p>
                                    <input class="input w-full h-[49px] rounded-md border border-gray6 px-6 text-base text-black" type="text" value="{{ $user->name }}" disabled>
                                </div>
                                <div class="mb-5">
                                    <p class="mb-0 text-base text-black">Email</p>
                                    <input class="input w-full h-[49px] rounded-md border border-gray6 px-6 text-base text-black" type="email" value="{{ $user->email }}" disabled>
                                </div>
                            </div>
                           <!-- <div class="mb-5">
                                <p class="mb-0 text-base text-black">Type d'utilisateur</p>
                                <input class="input w-full h-[49px] rounded-md border border-gray6 px-6 text-base text-black" type="text" value="{{ $user->utype }}" disabled>
                            </div>-->
                        </div>
                    </div>
    
                    <!-- Formulaire changement de mot de passe -->
                    <div class="col-span-12 xl:col-span-4">
                        <div class="py-10 px-10 bg-white rounded-md">
                            <h5 class="text-xl mb-6">Changer le mot de passe</h5>
                            
                            @if (session('success'))
                                <div class="mb-4 text-green-600">
                                    {{ session('success') }}
                                </div>
                            @endif
    
                            @if ($errors->any())
                                <div class="mb-4 text-red-600">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
    
                            <form action="{{ route('dashboard.profile.password') }}" method="POST">
                                @csrf
                                <div class="mb-5">
                                    <label class="block mb-1 text-base text-black" for="current_password">Mot de passe actuel</label>
                                    <input id="current_password" name="current_password" type="password" class="input w-full h-[49px] rounded-md border border-gray6 px-6 text-base text-black" required>
                                </div>
                                <div class="mb-5">
                                    <label class="block mb-1 text-base text-black" for="new_password">Nouveau mot de passe</label>
                                    <input id="new_password" name="new_password" type="password" class="input w-full h-[49px] rounded-md border border-gray6 px-6 text-base text-black" required>
                                </div>
                                <div class="mb-5">
                                    <label class="block mb-1 text-base text-black" for="new_password_confirmation">Confirmer le nouveau mot de passe</label>
                                    <input id="new_password_confirmation" name="new_password_confirmation" type="password" class="input w-full h-[49px] rounded-md border border-gray6 px-6 text-base text-black" required>
                                </div>
                                <div class="text-end mt-5">
                                    <button type="submit" class="bg-black px-10 py-2 rounded-full text-white">Mettre à jour</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('dashboard.components.js')
     
</body>

</html>
