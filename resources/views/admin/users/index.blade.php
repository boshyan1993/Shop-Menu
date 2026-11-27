<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ __('users.title') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
        }

        .users-page {
            max-width: 1200px;
            margin: 50px auto;
            padding: 30px;
        }

        .users-header {
            background: #1f2937;
            color: white;
            padding: 25px 30px;
            border-radius: 14px 14px 0 0;
        }

        .users-header h1 {
            margin: 0 0 8px;
            font-size: 30px;
        }

        .users-header p {
            margin: 0;
            opacity: 0.8;
        }

        .users-content {
            background: white;
            padding: 25px;
            border-radius: 0 0 14px 14px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f3f4f6;
            text-align: left;
            padding: 15px;
            color: #374151;
        }

        td {
            padding: 15px;
            border-top: 1px solid #e5e7eb;
        }

        tr:hover {
            background: #f9fafb;
        }

        .role-admin {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            background: #fee2e2;
            color: #b91c1c;
            font-weight: bold;
        }

        .role-user {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            background: #dbeafe;
            color: #1d4ed8;
            font-weight: bold;
        }

        .role-manager {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            background: #dcfce7;
            color: #15803d;
            font-weight: bold;
        }

        .role-select {
            padding: 9px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            margin-right: 5px;
        }

        .save-button {
            padding: 9px 14px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 7px;
            cursor: pointer;
        }

        .save-button:hover {
            background: #1d4ed8;
        }

        .success-message {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error-message {
            color: #dc2626;
            margin-bottom: 15px;
        }

        .back-button {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 18px;
            background: #1f2937;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }

        .back-button:hover {
            background: #111827;
        }
    </style>
</head>

<body>

    <x-language-switcher />

    <div class="users-page">

        <div class="users-header">

            <h1>{{ __('users.title') }}</h1>

            <p>{{ __('users.description') }}</p>

        </div>

        <div class="users-content">

            {{-- Հաջողության հաղորդագրություն --}}
            @if (session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Սխալների ցուցադրում --}}
            @if ($errors->any())
                <div class="error-message">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <table>

                <thead>
                    <tr>
                        <th>{{ __('users.id') }}</th>
                        <th>{{ __('users.name') }}</th>
                        <th>{{ __('users.email') }}</th>
                        <th>{{ __('users.role') }}</th>
                        <th>{{ __('users.registered_at') }}</th>
                        <th>Գործողություններ</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($users as $user)

                        @php
                            $currentRole = $user->roles->first();
                        @endphp

                        <tr>

                            <td>{{ $user->id }}</td>

                            <td>
                                <strong>{{ $user->name }}</strong>
                            </td>

                            <td>{{ $user->email }}</td>

                            {{-- Ընթացիկ դեր --}}
                            <td>

                                @if ($currentRole)

                                    <span class="{{ 
                                        $currentRole->slug === 'admin' ? 'role-admin' :
                                        ($currentRole->slug === 'manager' ? 'role-manager' : 'role-user')
                                    }}">
                                        {{ $currentRole->name }}
                                    </span>

                                @else

                                    <span>Դեր նշանակված չէ</span>

                                @endif

                            </td>

                            <td>
                                {{ $user->created_at->format('d.m.Y H:i') }}
                            </td>

                            {{-- Դերի փոփոխություն --}}
                            <td>

                                <form
                                    action="{{ route('admin.users.updateRole', $user->id) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('PUT')

                                    <select name="role_id" class="role-select" required>

                                        @foreach ($roles as $role)

                                            <option
                                                value="{{ $role->id }}"
                                                {{ $currentRole && $currentRole->id == $role->id ? 'selected' : '' }}
                                            >
                                                {{ $role->name }}
                                            </option>

                                        @endforeach

                                    </select>

                                    <button type="submit" class="save-button">
                                        Պահպանել
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6">
                                {{ __('users.empty') }}
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

            <a href="{{ route('admin.index') }}" class="back-button">
                {{ __('users.back') }}
            </a>

        </div>

    </div>

</body>
</html>