<?php

function popup_message($msg, $type){
    switch($type){
        case "ERROR":
            $bg_color = "red";
            $color = "#FFF";
            break;
        case "SUCCESS":
            $bg_color = "green";
            $color = "#FFF";
            break;
        case "WARNING":
            $bg_color = "orange";
            $color = "#000";
            break;
    }

    echo "
        <div class='popup_con'>
            <div class='popup_msg' style='
                background-color:".$bg_color.";
                color:".$color.";
            '>
                <p>".$msg."</p>
            </div>
        </div>
    ";
}

