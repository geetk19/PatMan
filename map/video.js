
function playVid() {
    var play= document.getElementById("pla");
    var pause = document.getElementById("paus");
    var fs = document.getElementById("fullscreen");
    var vid =document.getElementById('vid');
    vid.play();
    play.style.display='none';
    pause.style.display='block';
}

function pauseVid() {
    var play= document.getElementById("pla");
    var pause = document.getElementById("paus");
    var fs = document.getElementById("fullscreen");
    var vid =document.getElementById('vid');
    vid.pause();
    pause.style.display='none';
    play.style.display='block';
}
function fullscreen(){
    var vid =document.getElementById('vid');
    if(vid.requestFullScreen){
		vid.requestFullScreen();
	} else if(vid.webkitRequestFullScreen){
		vid.webkitRequestFullScreen();
	} else if(vid.mozRequestFullScreen){
		vid.mozRequestFullScreen();
    }
}