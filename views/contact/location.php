<?php

//function gmp_map() {
//    global $title;
//    echo "<article id='map'>";
//    echo "<gmp-map center='43.48868942260742,5.377853870391846' zoom='14' map-id='DEMO_MAP_ID'>";
//    echo "<gmp-advanced-marker position='43.48868942260742,5.377853870391846' title='$title'></gmp-advanced-marker>";
//    echo "</gmp-map>";
//    echo "</article>";
//}

function iframe_map(){
    echo "<div id='map'>";
    echo "<iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2903.0000000000005!2d5.377853870391846!3d43.48868942260742!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12c9c7f1b1b1b1b1%3A0x12c9c7f1b1b1b1b1!2sMarseille%20Provence%20Airport!5e0!3m2!1sen!2sfr!4v1623686820001!5m2!1sen!2sfr' 
            width='100%' height='100%' style='border-radius: 3px;' frameborder='0' style='border:0' allowfullscreen='' loading='lazy'></iframe>";
    echo "</div>";
}
function adresse(){
    global $adresse_info;
    echo "<aside>";
    echo "<p>";
    echo "<strong>".$adresse_info['name']."</strong><br>";
    echo $adresse_info['street']."<br>";
    echo $adresse_info['zip']." ".$adresse_info['city']."<br>";
    echo $adresse_info['country']."<br>";
    echo "<br>";
    echo "Telephone: ". "<a href='tel:".$adresse_info['telephone']."'>".$adresse_info['telephone']."</a><br>";
    echo "Email: ". "<a href='mailto:".$adresse_info['email']."'>".$adresse_info['email']."</a><br>";
    echo "Opening hours: ".$adresse_info['opening_hours']."<br>";
    echo "</p>";
    echo "</aside>";

}


function displayLocation() {
    echo "<section class='location'>";
    iframe_map();
    adresse();
    echo "</section>";
}



displayLocation();





