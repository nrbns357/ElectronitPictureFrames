<?php
 for($i = 0; $i < count($_FILES['image']['name']); $i++)
 {
     $imageName = $_FILES['image']['name'][$i];
     $image = $_FILES['image']['tmp_name'][$i];
     move_uploaded_file($image, "./images/".$imageName);
 }


?>
<script>
    location.href = "./index.php"
</script>