<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Megrim&display=swap" rel="stylesheet">
    <link href="//db.onlinewebfonts.com/c/f4d1593471d222ddebd973210265762a?family=Pokemon" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <title>Pokédex</title>
</head>
<body>
<header>
    <h1>Pokédex</h1>
</header>

<div class="superContainer" id="superContainer">
    <div class="main-container" id="main-container">
        <div class="main-screen" id="main-screen">
            <div class="front-sprite" id="front-sprite">
                <img id="poke-sprite" src="" alt="woops">
                <p id="poke-name"></p>
                <p id="poke-id"></p>
            </div>
            <div class="weight" id="weight"></div>
            <div class="height" id="height"></div>
        </div>
        <div class="type-screen" id="type-screen">
            <div class="type1-s" id="type1-s"></div>
            <div class="type2-s" id="type2-s"></div>
        </div>
        <div class="buttons" id="buttons">
            <div class="btn-up" id="btn-up" onclick="nextEvolution()"></div>
            <div class="btn-r" id="btn-r" onclick="nextPokemon()"></div>
            <div class="btn-down" id="btn-down" onclick="previousEvolution()"></div>
            <div class="btn-l" id="btn-l" onclick="previousPokemon()"></div>
        </div>
    </div>
    <div class="right-container" id="right-container">
        <div class="move-screen" id="move-screen">
            <div class="move1" id="move1"><p class="moves">1</p></div>
            <div class="move2" id="move2"><p class="moves">2</p></div>
            <div class="move3" id="move3"><p class="moves">3</p></div>
            <div class="move4" id="move4"><p class="moves">4</p></div>
        </div>
        <div class="evolutions" id="evolutions">
            <img src="" alt="" id="img-1">
            <img src="" alt="" id="img-2">
            <img src="" alt="" id="img-3">
        </div>
        <div class="input-field" id="input-field">
            <input type="text" id="text-num" name="text-num" placeholder="    Pokémon name or id">
        </div>
    </div>
</div>

<script src="pokedex.js"></script>
</body>
</html>