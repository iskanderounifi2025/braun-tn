<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Braun - profile</title>
    <link rel="shortcut icon" href="assets/img/logo/favicon.png" type="image/x-icon">

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
                        <h3 class="mb-0 text-[28px]"> <div class="">
                            <h5 class="text-xl mb-0">{{ $user->name }}</h5>
                            <p class="text-tiny mb-0">{{ $user->email }}</p>
                        </div></h3>
                    </div>
                </div>

                <div class="bg-white rounded-md overflow-hidden mb-10">
                  <!-- <div class="relative h-[200px] w-full">
                        <div data-bg="assets/img/bg/profile-header.jpg" class="data-bg absolute top-0 left-0 w-full h-full bg-no-repeat bg-cover"></div>
                        <input type="file" id="coverPhoto">
                        <label for="coverPhoto" class="bg-white px-4 py-1 rounded-md text-center absolute right-5 top-5 sm:top-auto sm:bottom-5 z-10 text-tiny font-medium shadow-lg transition-all duration-200 border-0 hover:cursor-pointer hover:bg-theme hover:text-white">
                            Upload Cover Photo
                        </label>
                    </div>-->

                   <!-- <div class="px-8 pb-8 relative">
                        <div class="-mt-[75px] mb-3 relative inline-block">
                           
                            <img class="w-[150px] h-[150px] rounded-[14px] border-4 border-white bg-white" src="{{ asset('storage/' . $user->profile_image) }}" alt="">
                            <input type="file" id="profilePhoto" class="hidden">
                            <label for="profilePhoto" class="inline-block w-8 h-8 rounded-full shadow-lg text-white bg-theme border-[2px] border-white text-center absolute top-[6px] right-[6px] translate-x-1/2 -translate-y-1/2 hover:cursor-pointer">
                                <svg class="-translate-y-[2px]" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16" height="16" viewBox="0 0 36.174 36.174">
                                    <path fill="currentColor" d="M23.921,20.528c0,3.217-2.617,5.834-5.834,5.834s-5.833-2.617-5.833-5.834s2.616-5.834,5.833-5.834 S23.921,17.312,23.921,20.528z M36.174,12.244v16.57c0,2.209-1.791,4-4,4H4c-2.209,0-4-1.791-4-4v-16.57c0-2.209,1.791-4,4-4h4.92 V6.86c0-1.933,1.566-3.5,3.5-3.5h11.334c1.934,0,3.5,1.567,3.5,3.5v1.383h4.92C34.383,8.244,36.174,10.035,36.174,12.244z M26.921,20.528c0-4.871-3.963-8.834-8.834-8.834c-4.87,0-8.833,3.963-8.833,8.834s3.963,8.834,8.833,8.834 C22.958,29.362,26.921,25.399,26.921,20.528z"/>
                                </svg>
                            </label>
                        </div>
                       
                    </div>-->
                </div>

                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 2xl:col-span-12">
                        <div class="py-10 px-10 bg-white rounded-md">
                            <h5 class="text-xl mb-6">Basic Information</h5>

                            <div class="">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <div class="mb-5">
                                        <p class="mb-0 text-base text-black">Name </p>
                                        <input class="input w-full h-[49px] rounded-md border border-gray6 px-6 text-base text-black" type="text" value="{{ $user->name }}" disabled>
                                    </div>
                                    <div class="mb-5">
                                        <p class="mb-0 text-base text-black">Email </p>
                                        <input class="input w-full h-[49px] rounded-md border border-gray6 px-6 text-base text-black" type="email" value="{{ $user->email }}" disabled>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <p class="mb-0 text-base text-black">User Type </p>
                                    <input class="input w-full h-[49px] rounded-md border border-gray6 px-6 text-base text-black" type="text" value="{{ $user->utype }}" disabled>
                                </div>
                                <div class="text-end mt-5">
                                    <button class="tp-btn px-10 py-2">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 2xl:col-span-4">
                        <!-- Ajouter des sections pour notifications ou sécurité ici si nécessaire -->
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('dashboard.components.js')

</body>

</html>
