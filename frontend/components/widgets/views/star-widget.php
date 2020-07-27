<?php
for($i=1;$i<=5;$i++) {
    if($rating >= 1) {
        echo "<span></span>";
        $rating--;
        continue;
    }
    echo "<span class=\"star-disabled\"></span>";
}
