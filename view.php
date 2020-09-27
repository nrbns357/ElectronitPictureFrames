<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'imageLoad.php' ?>
    <?php
        $imageIndex = rand(0, count($images) - 1);
    ?>
    <style>
        body{
            background-color: white;
        }
        img{
            width: 100%;
        }
    </style>
    <script>
        setTimeout(() => {location.reload();}, 6000)
    </script>
</head>
<body>
    <img src="./getImage.php?imageName=<?= $images[$imageIndex] ?>"/>
</body>
</html>