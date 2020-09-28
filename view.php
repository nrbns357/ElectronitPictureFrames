<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'imageLoad.php' ?>
    <style>
        body{
            background-color: white;
        }
        img{
            max-width: 97vw;
            max-height: 97vh;
            display:block;
            margin:auto;
        }
    </style>
    <script>
        const timeToShowImage = 1000 * 6;
        var imageNames = new Array();

        async function showImage(){
            while(true){
                if(imageNames.length === 0){
                    getImageList();
                    break;
                }

                const imageCount = imageNames.length;
                let targetIndex = Math.floor(Math.random() * imageCount);

                let imageElement = document.getElementById('img');
                imageElement.src = './getImage.php?imageName=' + imageNames[targetIndex];

                imageNames.splice(targetIndex, 1);
                await new Promise(resolve => setTimeout(resolve, timeToShowImage));
            }
        }

        var isFull = false
        function onAndOffFullscreen(){
            if(isFull){
                closeFullscreen();
            }else{
                openFullscreen();
            }
            isFull = !isFull;
        }

        function openFullscreen() {
            let elem = document.documentElement;
            if (elem.mozRequestFullScreen) { /* Firefox */
                elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) { /* IE/Edge */
                elem.msRequestFullscreen();
            }
        }
        
        
        function closeFullscreen() {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) { /* Firefox */
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) { /* IE/Edge */
                document.msExitFullscreen();
            }
        }
        
        async function getImageList(){
            var xhr = new XMLHttpRequest();
            xhr.open("GET", './getImageList.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = () => { imageNames = JSON.parse(xhr.response); showImage();}
            xhr.send();
        }
    </script>
</head>
<body onclick="onAndOffFullscreen()" onload="showImage()">
    <img id='img'/>
</body>
</html>