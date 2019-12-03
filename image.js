function photo() {
    var streaming = false;
    var video = document.querySelector("#video");
    // var cover = document.querySelector('#cover');
    var canvas = document.querySelector("#canvas");
    var startbutton = document.querySelector("#startbutton");
    var width = 500;
    var height = 0;

    navigator.getUserMedia =
        navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia;

    if (navigator.getUserMedia) {
        navigator.getUserMedia(
            { video: true, audio: false },
            function(stream) {
                video.srcObject = stream;
                video.play();
            },
            function(err) {
                console.log("ERROR :" + err.name);
            }
        );
    } else {
        console.log("error : getUserMedia");
    }

    video.addEventListener(
        "canplay",
        function(ev) {
            if (!streaming) {
                height = video.videoHeight / (video.videoWidth / width);
                video.setAttribute("width", width);
                video.setAttribute("height", height);
                canvas.setAttribute("width", width);
                canvas.setAttribute("height", height);
                streaming = true;
            }
        },
        false
    );

    function takepicture() {
        canvas.width = width;
        canvas.height = height;
        canvas.getContext("2d").drawImage(video, 0, 0, width, height);
        // var_dump(data);
        // photo.setAttribute('src', data);
    }

    startbutton.addEventListener(
        "click",
        function(ev) {
            takepicture();
            ev.preventDefault();
        },
        false
    );
}
