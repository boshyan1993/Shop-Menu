<!DOCTYPE html>
<html lang="hy">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Գրանցում</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<div class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow">

        <h1 class="text-2xl font-bold text-center mb-6">
            Գրանցում
        </h1>

        <form method="POST" action="{{ route('register') }}">

            @csrf

            <!-- Անուն -->
            <div class="mb-4">
                <label for="name" class="block mb-1">
                    Անուն
                </label>

                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    class="w-full border rounded px-3 py-2"
                >

                @error('name')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

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
                    class="w-full border rounded px-3 py-2"
                >

                @error('email')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
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

            <!-- Confirm Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block mb-1">
                    Կրկնել գաղտնաբառը
                </label>

                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    class="w-full border rounded px-3 py-2"
                >
            </div>

            <!-- Register button -->
            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700"
            >
                Գրանցվել
            </button>

        </form>

    </div>

</div>

</body>
</html>