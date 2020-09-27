<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'imageLoad.php' ?>
    <style>
        body{
            width: 80%;
            margin: 0px auto;
        }
        text{
            margin: auto;
        }
        img{
            width: 100%;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    현재 사진의 개수 : <?= count($images) ?>
    <br/>
    <br/>
    <form method='post' action='imageSave.php' enctype='multipart/form-data'>
        사진 추가 <input type="file" name="image"/>
        <input type="submit"/>
    </form>
    <button onclick="location.href = './view.php'">
        사진들 보러가기
    </button>
    <div id='imagesDiv'>
    </div>
</body>

<script>
        let imageNames = <?= json_encode($images); ?>

        let imagesDiv = document.getElementById("imagesDiv")
        for(let index = 0; index < <?= count($images) ?> && index < 0; index++){
            let imageName = imageNames[index]
            imagesDiv.innerHTML += "<img src='./getImage.php?imageName=" + imageName + "'/><br/>"
        }
    </script>
</html>
