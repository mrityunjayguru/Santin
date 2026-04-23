<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Gallery Login</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="{{asset('build/assets/main.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <main class="flex justify-center items-center min-h-screen w-full bg-[#DDE1E8]  p-4 md:p-10">
        <div class="flex flex-col md:flex-row items-stretch w-full max-w-[1300px] gap-4 md:gap-6">

            <div
                class=" flex flex-col justify-center items-center w-full md:w-[60%] min-h-[250px] md:min-h-[400px] p-8 md:p-12 bg-[#1E1E1E] rounded-[30px] overflow-hidden shadow-xl">
                <div class="w-full flex justify-center items-center">
                    <img src="{{asset('build/assets/images/banner.svg')}}" alt="">
                </div>
            </div>
            <div
                class="flex flex-col justify-center items-center w-full md:w-[40%] bg-white dark:bg-[#1A1C1E]! p-8 md:p-12 rounded-[32px] shadow-xl">
                <div class="flex flex-col gap-6 w-full">
                    <div class="flex flex-col gap-1 mb-1">
                        <div class="flex items-center gap-3 text-2xl font-bold text-[#1A1C1E] dark:text-white">
                            <span
                                class="bg-[#1A1C1E] dark:bg-[#2B2B2B]! text-white rounded-full p-2 flex items-center justify-center ">
                                <img src="{{asset('build/assets/images/icons/login.svg')}}" alt="" class="h-4 w-4" />
                            </span>
                            <span class="font-normal dark:text-white">
                                Login
                            </span>
                        </div>
                        <div class="text-[#1A1D1F] dark:text-white text-sm font-normal dark:text-white">
                            Enter your details to sign in to your account
                        </div>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="flex flex-col gap-2">
                            <div class="flex flex-col gap-2">
                                <label for="email"
                                    class="text-[#1A1D1F] dark:text-white text-sm font-normal dark:text-white">Email</label>
                                <input type="email" id="email" placeholder="Email ID" name="email"
                                    class="text-[#1A1D1F] dark:text-white px-2 py-2 rounded-[4px] border border-[#E5E7EB] dark:border-[#2B2B2B]! outline-none">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="flex flex-col gap-2 relative">
                                <label for="password"
                                    class="text-[#1A1D1F] dark:text-white text-sm font-normal dark:text-white">Password</label>
                                <input type="password" id="password" placeholder="Password"  name="password"
                                    class="text-[#1A1D1F] dark:text-white px-2 py-2 pr-10 rounded-[4px] border border-[#E5E7EB] dark:border-[#2B2B2B]! outline-none w-full">
                                <img src="{{asset('build/assets/images/icons/eye.svg')}}" alt="" onclick="togglePasswordVisibility()"
                                    class="absolute right-2 top-[38px] cursor-pointer w-5 h-5 dark:text-white!"> 
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <button type="submit"
                                class="bg-[#2B2B2B] dark:bg-gray-300! dark:text-black! text-white px-4 py-2 mt-2 rounded-[4px]! outline-none">
                                Sign In
                            </button>
                        </div>
                        <span class="text-[#A6A6A6] dark:text-white text-sm font-normal  mt-4!">
                            Reset Password
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>