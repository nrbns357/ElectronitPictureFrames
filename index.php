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
        let windowWidth = window.outerWidth;
        let windiwHeight = window.outerHeight;
        let imageNames = <?= json_encode($images); ?>;
        let imagesDiv = document.getElementById("imagesDiv")

        let cunnretImageCount = 0;

        let lastAddImageName = '';
        async function addImage(loadImageCount){
            loadImageCount += cunnretImageCount;
            for(let index = cunnretImageCount; index < <?= count($images) ?> && index < loadImageCount; index++){
                await new Promise(resolve => setTimeout(resolve, 1000));
                let imageName = imageNames[index];
                //debounce
                if(imageName === lastAddImageName){
                    continue;
                }else{
                    lastAddImageName = imageName;
                }
                cunnretImageCount++;
                imagesDiv.innerHTML += "<img src='./getImage.php?imageName=" + imageName + "'/>"
                
            }
            return;
        }

        async function load(){
            while(true){
                if(windiwHeight + window.scrollY <= document.body.offsetHeight){
                    break;
                }
                await addImage(1);
            }
        }
        
        window.addEventListener('scroll', () => {load();});
        load();

    </script>
    <style>
        img{
            max-width: 300px;
            max-height: 200px;
            width: auto;
            height: auto;
            margin: 20px;
        }
    </style>
</html>
