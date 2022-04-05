<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <META NAME="robots" CONTENT="noindex">
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-content: center;
            justify-content: center;
            background-color: #ccc;
            height: 100vh;
        }
        .battle-logs {
            overflow-y: auto;
        }
        .battle-log {
            font-weight: bold;
        }
        .color-0 {
            color: red;
        }
        .color-1 {
            color: blue;
        }
    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body style="margin: 0">
    <div class="container">
        <form method="POST" action="/battle-simulator/submit" style="align-self: center">
            @csrf
            <label>Character</label><br />
            <label for="name">Name</label>
            <input id="name" name="name" type="text"><br />
            <label for="hp">HP</label>
            <input id="hp" name="hp" type="text"><br />
            <label for="dex">Dex</label>
            <input id="dex" name="dex" type="text"><br />
            <label for="str">STR</label>
            <input id="str" name="str" type="text"><br />
            <label for="luck">Luck</label>
            <input id="luck" name="luck" type="text"><br />
            <label for="int">INT</label>
            <input id="int" name="int" type="text"><br />
            <br /><br />

            <label for="charRing1">Ring 1</label>
            <select id="charRing1" name="charRing1">
                @foreach ($items as $id => $item)
                <option value="{{$id}}">{{$item}}</option>
                @endforeach
            </select><br />

            <label for="charRing2">Ring 2</label>
            <select id="charRing2" name="charRing2">
                @foreach ($items as $id => $item)
                <option value="{{$id}}">{{$item}}</option>
                @endforeach
            </select><br />

            <label for="charArmor">Armor</label>
            <select id="charArmor" name="charArmor">
                @foreach ($items as $id => $item)
                <option value="{{$id}}">{{$item}}</option>
                @endforeach
            </select><br />

            <label for="charWeapon">Weapon</label>
            <select id="charWeapon" name="charWeapon">
                @foreach ($items as $id => $item)
                <option value="{{$id}}">{{$item}}</option>
                @endforeach
            </select><br />
            <br /><br />

            <label>Enemy</label><br />
            <label for="type">Type</label>
            <input id="type" name="type" type="text"><br />
            <label for="enemyhp">HP</label>
            <input id="enemyhp" name="enemyhp" type="text"><br />
            <label for="enemydex">Dex</label>
            <input id="enemydex" name="enemydex" type="text"><br />
            <label for="enemystr">STR</label>
            <input id="enemystr" name="enemystr" type="text"><br />
            <label for="enemyluck">Luck</label>
            <input id="enemyluck" name="enemyluck" type="text"><br />
            <label for="enemyint">INT</label>
            <input id="enemyint" name="enemyint" type="text"><br />
            <br /><br />

            <input type="Submit" id="submit" value="inzenden oeleh">
        </form>
        <br/>
        <div class="battle-logs" style="align-self: center">
            @foreach ($logs as $index => $log)
            <span class="battle-log color-{{$index%2}}">{{ $log }}</span>
            <br/>
            @endforeach
        </div>
    </div>
</body>

</html>