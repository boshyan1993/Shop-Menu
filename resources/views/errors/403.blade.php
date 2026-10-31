<!DOCTYPE html>
<html lang="hy">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Մուտքն արգելված է</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div style="
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f5f5f5;
        font-family: Arial, sans-serif;
    ">

        <div style="
            background: white;
            padding: 50px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            max-width: 500px;
        ">

            <div style="
                font-size: 70px;
                font-weight: bold;
                margin-bottom: 10px;
            ">
                403
            </div>

            <h1>Մուտքն արգելված է</h1>

            <p style="
                color: #666;
                font-size: 17px;
                line-height: 1.6;
            ">
                Դուք չունեք այս բաժին մուտք գործելու
                անհրաժեշտ թույլտվություն։
            </p>

            <a href="{{ url('/') }}" style="
                display: inline-block;
                margin-top: 20px;
                padding: 12px 24px;
                background: #111;
                color: white;
                text-decoration: none;
                border-radius: 8px;
            ">
                Վերադառնալ գլխավոր էջ
            </a>

        </div>

    </div>

</body>
</html>