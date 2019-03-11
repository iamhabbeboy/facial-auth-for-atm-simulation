@extends('layouts.app')
@section('content')
<video id="video" width="500" height="500" style="border: 2px solid #000;margin: auto;"></video>
	<button>Take Picture</button>
	<canvas id="canvas" style="display:none;" width="500" height="500"></canvas>
	<img id="resim" src="">

<script src="/plugin/app.js"></script>
<script>

//   window.URL = window.URL || window.webkitURL;
//   let video = document.getElementById('v');
//   navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || msGetUsermedia;
// if (navigator.getUserMedia) {
// 	navigator.getUserMedia({audio:false,video:true}, (stream) => {
// 		document.getElementById('v').src = window.URL.createObjectURL(stream)
// 		document.getElementById('v').play();
// 		console.log(stream);
// 		document.querySelector('button').addEventListener('click', () => {
// 			document.getElementById('canvas').getContext('2d').drawImage(document.getElementById('v'), 0, 0, 500, 500);
// 			document.getElementById('resim').src = document.getElementById('canvas').toDataURL('image/png');
// 			// let resize = document.getElementById('resim').src;
// 		});
// 	}, (error) => { alert(error)})
// }
</script>
@stop