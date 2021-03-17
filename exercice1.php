<?php

$fichierJson = file_get_contents("pokedex.json");

$tableau = json_decode($fichierJson, true);
// var_dump($tableau);

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Liste des pokémons</title>
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
                <h2>Liste des pokémons</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Image</td>
                            <td>Nom</td>
                            <td>Types</td>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $num = 1;
                        for ($i = 0; $i < count($tableau); $i++) {
                            echo '<tr>';
                            echo '<td>' . $tableau[$i]['id'] . '</td>';

                            $image = sprintf("%'.03d\n", $num);
                            echo '<td><img width="50" src="./thumbnails/' . $image . '.png"></td>';
                            $num++;

                            echo '<td>' . $tableau[$i]['name']['french'] . '</td>';
                            echo '<td>';

                            if (!isset($tableau[$i]['type'][1])) {
                                echo '<span class="badge badge-secondary mr-2">' . $tableau[$i]['type'][0] . '</span>';
                            } else {
                                echo '<span class="badge badge-secondary mr-2">' . $tableau[$i]['type'][0] . '</span>
                                        <span class="badge badge-secondary mr-2">' . $tableau[$i]['type'][1] . '</span>';
                            }


                            echo    '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>