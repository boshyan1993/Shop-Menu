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
            max-width: 1100px;
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

            <h1>
                {{ __('users.title') }}
            </h1>

            <p>
                {{ __('users.description') }}
            </p>

        </div>


        <div class="users-content">

            <table>

                <thead>
                    <tr>
                        <th>{{ __('users.id') }}</th>
                        <th>{{ __('users.name') }}</th>
                        <th>{{ __('users.email') }}</th>
                        <th>{{ __('users.role') }}</th>
                        <th>{{ __('users.registered_at') }}</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($users as $user)

                        <tr>

                            <td>
                                {{ $user->id }}
                            </td>

                            <td>
                                <strong>
                                    {{ $user->name }}
                                </strong>
                            </td>

                            <td>
                                {{ $user->email }}
                            </td>

                            <td>

                                @if ($user->role === 'admin')

                                    <span class="role-admin">
                                        {{ __('users.admin') }}
                                    </span>

                                @else

                                    <span class="role-user">
                                        {{ __('users.user') }}
                                    </span>

                                @endif

                            </td>

                            <td>
                                {{ $user->created_at->format('d.m.Y H:i') }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5">
                                {{ __('users.empty') }}
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>


            <a
                href="{{ route('admin.index') }}"
                class="back-button"
            >
                {{ __('users.back') }}
            </a>

        </div>

    </div>

</body>

</html>