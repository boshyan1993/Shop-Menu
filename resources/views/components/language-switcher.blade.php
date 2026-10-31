<div
    style="
        position: fixed;
        top: 15px;
        right: 20px;
        z-index: 9999;
        display: flex;
        gap: 6px;
        background: rgba(255,255,255,0.95);
        padding: 5px;
        border-radius: 10px;
        box-shadow: 0 3px 12px rgba(0,0,0,0.15);
    "
>
    <a
        href="{{ route('language.switch', 'hy') }}"
        style="
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 34px;
            border-radius: 7px;
            text-decoration: none;
            font-size: 20px;
        "
        title="Հայերեն"
    >
        🇦🇲
    </a>

<a
    href="{{ route('language.switch', 'ru') }}"
    style="
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 34px;
        border-radius: 7px;
        text-decoration: none;
        font-size: 20px;
    "
    title="Русский"
>
    🇷🇺
</a>

<a
    href="{{ route('language.switch', 'en') }}"
    style="
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 34px;
        border-radius: 7px;
        text-decoration: none;
        font-size: 20px;
    "
    title="English"
>
    🇬🇧
</a>

</div>