<?php

/**
 * Error.php Doc Comment
 * 
 * PHP version 7.4.8
 * 
 * @category File
 * @package  Food_O_Cycle
 * @author   Ryan Giddings <gid3877@calu.edu>
 * @license  https://www.gnu.org/licenses/gpl-3.0.en.html GNU Public License v3.0
 * @link     https://github.com/DMFTWteam/food_o_cycle
 */
    require 'inc/header.php';
    $msg = filter_input(INPUT_GET, 'msg');
    $error = "<h1 style='color: red; text-align: center;'>".$msg."</h1>";
    echo $error; 
?>
<p style='text-align: center;'>You will be redirected to home page in <span id='counter'>5</span> second(s).</p>
<script type='text/javascript'>
function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML) <= 0) {
        location.href = 'index.php';
    }
    if (parseInt(i.innerHTML) != 0) {
        i.innerHTML = parseInt(i.innerHTML) - 1;
    }
}
setInterval(function() {
    countdown();
}, 1000);
</script>

<?php
    require 'inc/js_to_include.php';
    require 'inc/footer.php';
    
?>
