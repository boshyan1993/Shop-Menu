<!DOCTYPE html>
<html lang="hy">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Մուտք</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<div class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow">

        <h1 class="text-2xl font-bold text-center mb-6">
            Մուտք
        </h1>

        <form method="POST" action="{{ route('login') }}">

            @csrf

            <!-- Email -->
            <div class="mb-4">

                <label for="email" class="block mb-1">
                    Email
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full border rounded px-3 py-2"
                >

                @error('email')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            <!-- Password -->
            <div class="mb-6">

                <label for="password" class="block mb-1">
                    Գաղտնաբառ
                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    class="w-full border rounded px-3 py-2"
                >

                @error('password')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            <!-- Login button -->
            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700"
            >
                Մուտք գործել
            </button>

        </form>


        <!-- Registration -->

        <div class="text-center mt-4">

            <a
                href="{{ route('register') }}"
                class="text-blue-600 hover:underline"
            >
                Դեռ գրանցված չե՞ք։ Գրանցվել
            </a>

        </div>

    </div>

</div>

</body>
</html>