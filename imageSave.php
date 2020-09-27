<?php
    $image = $_FILES['image']['tmp_name'];
    $imageName = $_FILES['image']['name'];
    move_uploaded_file($image, "./images/".$imageName)
?>
<script>
    location.href = "./index.php"
</script>