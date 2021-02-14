<?php
const BASE_API_LINK = "https://pokeapi.co/api/v2/pokemon/";
const TOTAL_POKEMON = 898;

function displayMoves(array $p_moves) {
    if (count($p_moves) >= 4)
        for ($i = 1; $i <= 4; $i++) {
            echo "<div class='move$i' id='move$i'><p class='moves'>{$p_moves[($i-1)]['move']['name']}</p></div>";

        } elseif (count($p_moves) == 1) {

        echo "<div class='move1' id='move1'><p class='moves'>{$p_moves[0]['move']['name']}</p></div>";
        echo "<div class='move2' id='move2'><p class='moves'> - </p></div>";
        echo "<div class='move3' id='move3'><p class='moves'> - </p></div>";
        echo "<div class='move4' id='move4'><p class='moves'> - </p></div>";

    } elseif (count($p_moves) == 0) {

        echo "<div class='move1' id='move1'><p class='moves'> - </p></div>";
        echo "<div class='move2' id='move2'><p class='moves'> - </p></div>";
        echo "<div class='move3' id='move3'><p class='moves'> - </p></div>";
        echo "<div class='move4' id='move4'><p class='moves'> - </p></div>";
    }
}
function displayEvolutions(array $e_json){
    if (count($e_json['chain']['evolves_to']) == 0) {
        $evo_one = json_decode(file_get_contents(str_replace("-species", "", $e_json['chain']['species']['url'])), true);
        echo "<img src='{$evo_one['sprites']['front_default']}' alt='' id='img-1'>";

    } elseif (count($e_json['chain']['evolves_to']) == 1 && count($e_json['chain']['evolves_to'][0]['evolves_to']) == 1) {

        $evo_one = json_decode(file_get_contents(str_replace("-species", "", $e_json['chain']['species']['url'])), true);
        $evo_two = json_decode(file_get_contents(str_replace("-species", "", $e_json['chain']['evolves_to'][0]['species']['url'])), true);
        $evo_three = json_decode(file_get_contents(str_replace("-species", "", $e_json['chain']['evolves_to'][0]['evolves_to'][0]['species']['url'])), true);
        echo "<img src='{$evo_one['sprites']['front_default']}' alt='' id='img-1'>";
        echo "<img src='{$evo_two['sprites']['front_default']}' alt='' id='img-2'>";
        echo "<img src='{$evo_three['sprites']['front_default']}' alt='' id='img-3'>";

    } elseif (count($e_json['chain']['evolves_to']) == 1) {

        $evo_one = json_decode(file_get_contents(str_replace("-species", "", $e_json['chain']['species']['url'])), true);
        $evo_two = json_decode(file_get_contents(str_replace("-species", "", $e_json['chain']['evolves_to'][0]['species']['url'])), true);
        echo "<img src='{$evo_one['sprites']['front_default']}' alt='' id='img-1'>";
        echo "<img src='{$evo_two['sprites']['front_default']}' alt='' id='img-2'>";
    }

}
function displayTypes(array $p_types){
    if (count($p_types) == 2) {
        echo "<div class='type1-s' id='type1-s'><p>{$p_types[0]['type']['name']}</p></div>";
        echo "<div class='type2-s' id='type2-s'><p>{$p_types[1]['type']['name']}</p></div>";
    } else {
        echo "<div class='type1-s' id='type1-s'><p>{$p_types[0]['type']['name']}</p></div>";
        echo "<div class='type2-s' id='type2-s'><p> - </p></div>";
    }
}
if (empty($_GET['text-num'])) {
    $api_link = BASE_API_LINK . "1/";
} else {
    $api_link = BASE_API_LINK . $_GET['text-num'];
}

$p_json = file_get_contents($api_link);
$p_json_d = json_decode($p_json, true); // --> true makes everything even deeper inside the api into an array

$front_image = $p_json_d['sprites']['front_default'];
$p_name = $p_json_d['name'];
$p_id = $p_json_d['id'];

if($p_id +1 > TOTAL_POKEMON){
    $next_id = 1;
}else{
    $next_id = $p_id +1;
}
if($p_id -1 == 0){
    $previous_id = TOTAL_POKEMON;
}else $previous_id = $p_id -1;

$p_height = $p_json_d['height'];
$p_moves = $p_json_d['moves'];// 78 voor bulbasaur bv
$p_types = $p_json_d['types'];
$s_json = json_decode(file_get_contents($p_json_d['species']['url']), true);
//^pokemon-species^-api
$e_json = json_decode(file_get_contents($s_json['evolution_chain']['url']), true);
// ^evolution chain^-api
$next_evo = '#';
$previous_evo = '#';

if($e_json['chain']['evolves_to'] == !null){
    if ($p_name == $e_json['chain']['species']['name']){
        $next_evo = $e_json['chain']['evolves_to'][0]['species']['name'];
        if($e_json['chain']['evolves_to'][0]['evolves_to'] == !null ){
            $previous_evo = $e_json['chain']['evolves_to'][0]['evolves_to'][0]['species']['name'];
        }
    }elseif ($p_name == $e_json['chain']['evolves_to'][0]['species']['name']){
        $previous_evo = $e_json['chain']['species']['name'];
            $next_evo = $e_json['chain']['evolves_to'][0]['evolves_to'][0]['species']['name'];
    }elseif ($p_name == $e_json['chain']['evolves_to'][0]['evolves_to'][0]['species']['name']){
        $previous_evo = $e_json['chain']['evolves_to'][0]['species']['name'];
        $next_evo = $e_json['chain']['species']['name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Megrim&display=swap" rel="stylesheet">
    <link href="//db.onlinewebfonts.com/c/f4d1593471d222ddebd973210265762a?family=Pokemon" rel="stylesheet"
          type="text/css"/>
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
                <img id='poke-sprite' src='<?php echo $front_image ?>' alt='woops'>
                <p id="poke-name"><?php echo $p_name ?></p>
                <p id="poke-id"><?php echo $p_json_d['id'] ?></p>
            </div>
            <div class="weight" id="weight"><p><?php echo $p_json_d['weight'] . ' Poké-Units' ?></p></div>
            <div class="height" id="height"><p><?php echo $p_json_d['height'] . ' Poké-Units' ?></p></div>
        </div>
        <div class="type-screen" id="type-screen">
            <?php
            displayTypes($p_types);
            ?>
        </div>
        <div class="buttons" id="buttons">

            <a href="http://pokedex.local/?text-num=<?php echo $next_evo ?>" class="btn-up" id="btn-up" ></a>

            <a href="http://pokedex.local/?text-num=<?php echo $previous_evo ?>" class="btn-down" id="btn-down" ></a>

            <a href="http://pokedex.local/?text-num=<?php echo $next_id ?>" class="btn-r" id="btn-r" ></a>
            <a href="http://pokedex.local/?text-num=<?php echo $previous_id ?>" class="btn-l" id="btn-l" ></a>
        </div>
    </div>
    <div class="right-container" id="right-container">
        <div class="move-screen" id="move-screen">
            <?php
            displayMoves($p_moves);
            ?>
        </div>
        <div class="evolutions" id="evolutions">
            <?php
            displayEvolutions($e_json);
            ?>
        </div>
        <div class="input-field" id="input-field">
            <form action="">
                <input type="text" id="text-num" name="text-num" placeholder="   Pokémon name or id">
            </form>
        </div>
    </div>
</div>


</body>
</html>