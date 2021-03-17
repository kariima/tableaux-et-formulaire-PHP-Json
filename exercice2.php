<?php

$typesJson = file_get_contents("types.json");
$tableauTypes = json_decode($typesJson, true);
//var_dump($tableauTypes);

$pokedexJson = file_get_contents("pokedex.json");
$tableauPokedex = json_decode($pokedexJson, true);
//var_dump($tableauPokedex);

if (isset($_POST['typeSelect']))
    $selection = $_POST['typeSelect'];

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Liste des pokémons grâce à un formulaire</title>
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap-reboot.min.css" integrity="sha512-YmRhY1UctqTkuyEizDjgJcnn0Knu5tdpv09KUI003L5tjfn2YGxhujqXEFE7fqFgRlqU/jeTI+K7fFurBnRAhg==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap-grid.min.css" integrity="sha512-QTQigm89ZvHzwoJ/NgJPghQPegLIwnXuOXWEdAjjOvpE9uaBGeI05+auj0RjYVr86gtMaBJRKi8hWZVsrVe/Ug==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Liste des pokémons grâce à un formulaire</h2>
                <form method="POST" action="">

                    <div class="m-5">

                        <select name="typeSelect" class="form-select form-control" aria-label="Default select example">
                            <?php

                            foreach ($tableauTypes as $key => $value) {

                                // echo '<option name="allTypes" value="' . $value['french'] . '">' . $value['french'] . '</option>';
                                echo "<option value=\"" . $value['french'] . "\"";
                                if (!isset($selection))
                                    echo '<option name="allTypes" value="' . $value['french'] . '">' . $value['french'] . '</option>';
                                if ($selection == $value['french']) {
                                    echo "selected";
                                } //ça c'est pour garder la selection lors du réaffichage
                                echo ">" . $value['french'] . "</option>\n";
                            }

                            ?>
                        </select>

                    </div>

                    <div>

                        <input class="btn-outline-success btn btn-lg" type="submit" name="validate" value="Valider">

                    </div>

                </form>

            </div>
        </div>

        <?php

        if (isset($_POST['validate'])) {

            echo '<div class="row mt-3">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Image</td>
                                    <td>Nom</td>
                                    <td>Types</td>
                                </tr>
                            </thead>
                            <tbody>';

            for ($i = 0; $i < count($tableauPokedex); $i++) {

                if (in_array($_POST['typeSelect'], $tableauPokedex[$i]['type'])) {

                    echo '<tr>';
                    echo '<td>' . $tableauPokedex[$i]['id'] . '</td>';

                    $image = sprintf("%'.03d\n", $i);
                    echo '<td><img width="50" src="./thumbnails/' . $image . '.png"></td>';


                    echo '<td>' . $tableauPokedex[$i]['name']['french'] . '</td>';

                    echo '<td>';
                    if (!isset($tableauPokedex[$i]['type'][1])) {
                        echo '<span class="badge badge-secondary mr-2">' . $tableauPokedex[$i]['type'][0] . '</span>';
                    } else {
                        echo '<span class="badge badge-secondary mr-2">' . $tableauPokedex[$i]['type'][0] . '</span>
                                                <span class="badge badge-secondary mr-2">' . $tableauPokedex[$i]['type'][1] . '</span>';
                    }
                    echo '</td>';

                    echo '</tr>';
                }
            }
            echo '</tbody>
                            </table>
                        </div>
                    </div>';
        }
        ?>
    </div>
</body>

</html>