<?php
    require 'header.php';
    $msg = filter_input(INPUT_GET, 'msg');
    $error = "<h1 style='color: red; '>".$msg."</h1>";
    echo $error; 
?>
<p>You will be redirected to home page in <span id='counter'>5</span> second(s).</p>
    <script type='text/javascript'>
    function countdown() {
        var i = document.getElementById('counter');
        if (parseInt(i.innerHTML)<=0) {
            location.href = 'index.php';
        }
        if (parseInt(i.innerHTML)!=0) {
        i.innerHTML = parseInt(i.innerHTML)-1;
        }
    }
    setInterval(function(){ countdown(); },1000);
    </script>

<?php
    require 'inc/js_to_include.php';
    require 'inc/footer.php';
    
?>
