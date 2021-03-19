<?php

    $url_key = '';
    $data = file_get_contents('data.json');
    $json = json_decode($data, true);
    if (isset($_POST['url']) && !empty($_POST['url'])) {

        function generate_key() {
            $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $random_key = '';
            for ($i = 0; $i < 4; $i++) {
                $random_key .= $chars[rand(0, 61)];
            }
            return $random_key;
        }

        if (!in_array($_POST['url'], array_values($json))) {
            $url_key = generate_key();
            while (in_array($random, array_keys($json))) {
                $url_key = generate_key();
            }

            $json[$url_key] = $_POST['url'];
            file_put_contents('data.json', json_encode($json, true));
        } else {
          $url_key = array_search($_POST['url'], $json);
        }
    }?>
    <center>
        <h1>Enter Url Here</h1>
        <form method="POST">
            <p><input style="width:500px" type="url" name="url" required /></p>
            <p><input type="submit" /></p>
        </form>
        <?php
            if (!empty($url_key)) {
                echo "<h1>Short URL : http://myshorturl.com/".$url_key."</h1>";
            }
        ?>
    </center>