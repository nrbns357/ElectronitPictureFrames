<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include 'imageLoad.php' ?>

        <!-- 화면을 보여주는 style정의 -->
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
            사진 추가 <input type="file" name="image" multiple/>
            <input type="submit"/>
        </form>
        <button onclick="location.href = './view.php'">
            사진들 보러가기
        </button>
        <div id='imagesDiv'>
        </div>
    </body>

    <script>
        let windiwHeight = window.outerHeight;
        let imageNames = <?= json_encode($images); ?>;
        let imagesDiv = document.getElementById("imagesDiv")

        let cunnretImageCount = 0;

        let lastAddImageName = '';
        //사진 추가 함수, loadImageCount에 들어온 수 만큼 사진을 더 불러온다.
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
                imagesDiv.innerHTML += `<img src='./getImage.php?imageName=${imageName}' id='${imageName}' 
                onmouseover='mouseOverOnImage("${imageName}")' 
                ontouchstart='imageTouchStart("${imageName}")' 
                onmouseleave='mouseLeaveOnImage("${imageName}")' 
                ontouchend='mouseLeaveOnImage("${imageName}")'
                onclick='mouseClickImage("${imageName}")' />`
                
            }
            return;
        }

        // 스마트폰에서 길레 눌렀을때 다른 팝업이 뜨는것을 끄는 코드
        window.oncontextmenu = function(event) {
            event.preventDefault();
            event.stopPropagation();
            return false;
        };

        //화면에 처음 들어왔을대 실행되는 코드
        async function load(){
            while(true){
                //35px is for mobile - Todo: why is mobile different from windows?
                if(windiwHeight + window.scrollY + 35 <= document.body.offsetHeight){
                    break;
                }
                await addImage(1);
            }
        }
        
        window.addEventListener('scroll', () => {load();});
        load();

        let isTouching = false
        //이미지를 누르기 시작 했을때 시작되는 함수
        async function imageTouchStart(imageName){
            isTouching = true;
            const image = document.getElementById(imageName);
            image.classList.add('deleteWatingImage');

            //0.7 sec
            for(let i = 0; i < 10; i++){
                if(isTouching === false){
                    return
                }
                await new Promise(resolve => setTimeout(resolve, 100));
            }
            alert(imageName);
            image.classList.remove('deleteWatingImage');
        }

        //이미지에서 손을 땠을때 시작되는 함수
        function imageTouchEnd(imageName){
            isTouching = false
            const image = document.getElementById(imageName);
            image.classList.remove('deleteWatingImage');
        }

        //Todo: how to disbale long touch?
        function mouseOverOnImage(imageName){
            const image = document.getElementById(imageName);
            image.classList.add('deleteWatingImage');
        }

        function mouseLeaveOnImage(imageName){
            const image = document.getElementById(imageName);
            image.classList.remove('deleteWatingImage');
        }

        function mouseClickImage(imageName){
            const image = document.getElementById(imageName);
            alert(imageName);
        }
        
        window.open('','_parent',''); 
        window.close();
        //카카오 웹으로 들어온다면 크롬으로 키기
        if(navigator.userAgent.includes('KAKAO')){
            //location.href='http://intent://www.iubns.net/ElectronPictureFrames#Intent;scheme=http;package=com.android.chrome;end';
        }
            
    </script>
    <style>
        img{
            max-width: 300px;
            max-height: 200px;
            width: auto;
            height: auto;
            margin: 20px;
        }

        .deleteWatingImage{
            animation: removeImage 3s;
            animation-fill-mode: forwards;
        }

        @keyframes removeImage{
            0% {filter: blur(0px);}   
            100% {filter: blur(20px);}   
        }
    </style>
</html>
