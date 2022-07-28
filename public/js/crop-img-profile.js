//===================== CORTE DE IMAGEM FORM NOVO VISITANTE
$(document).ready(function() {
    $image = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
            width: 300,
            height: 300,
            type: 'square' //circle
        },
        boundary: {
            width: 400,
            height: 400
        }
    });

    $('#upload_image').on('change', function() {
        var reader = new FileReader();
        reader.onload = function(event) {
            $image.croppie('bind', {
                url: event.target.result
            }).then(function() {
                console.log('jQuery bind complete');
            });
        }
        reader.readAsDataURL(this.files[0]);
        $('#register').modal('hide');
        $('#uploadimage').modal('show');
        $('.fab').removeClass('show');
    });

    $('.crop_image').click(function(event) {
        $image.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (response) {
            $('#uploadimage').modal('hide');
            document.getElementById("img_profile").src = response;
            document.getElementById('image_profile').value = response;
            $('#register').modal('show');
        })
    });

});

//======================== EDITAR FOTO
$(document).ready(function () {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });
    $image_crop = $('#image_prev').croppie({
        enableExif: true,
        viewport: {
            width: 300,
            height: 300,
            type: 'square' //circle
        },
        boundary: {
            width: 400,
            height: 400
        }
    });

    $('#upload_new_image').on('change', function() {
        var reader = new FileReader();
        reader.onload = function(event) {
            $image_crop.croppie('bind', {
                url: event.target.result
            }).then(function() {
                console.log('jQuery bind complete');
            });
        }
        reader.readAsDataURL(this.files[0]);
        $('#visitor_profile').modal('hide');
        $('#uploanewdimage').modal('show');
        $('.fab').removeClass('.show');
    });

    $('.crop_new_image').click(function(event) {
        $image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (response) {
            $('#uploanewdimage').modal('hide');
            document.getElementById("edit_img").src = response;
            var data = {
                id: $('#id').val(),
                photo: response,
            };
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: '/edit_img_profile',
                type: 'POST',
                data: data,
                dataType: 'text',
                success: function (data) {
                        Toast.fire({
                            icon: 'success',
                            title: '&nbsp&nbsp Imagem atualizada..'
                        });
                    $('#visitor_profile').modal('show');
                    $("#table").DataTable().clear().draw(6);
                },

                error: function (data) {
                        Toast.fire({
                            icon: 'error',
                            title: '&nbsp&nbsp Erro ao atualizar.'
                        });
                }
            });
        })
    });

});


//BOTAO
function toggleFAB(fab){
	if(document.querySelector(fab).classList.contains('show')){
  	document.querySelector(fab).classList.remove('show');
  }else{
  	document.querySelector(fab).classList.add('show');
  }
}

document.querySelector('.fab .main').addEventListener('click', function(){
	toggleFAB('.fab');
});

document.querySelectorAll('.fab ul li button').forEach((item)=>{
	item.addEventListener('click', function(){
		toggleFAB('.fab');
	});
});




// CAMERA
-
$('#webcam').on('hidden.bs.modal' ,function () {
 var videoEl = document.getElementById('webCamera');
// now get the steam
stream = videoEl.srcObject;
// now get all tracks
tracks = stream.getTracks();
// now close each track by having forEach loop
tracks.forEach(function(track) {
   // stopping every track
   track.stop();
});
// assign null to srcObject of video
videoEl.srcObject = null;
});


function loadCamera(){
	//Captura elemento de vídeo
	var video = document.querySelector("#webCamera");
		//As opções abaixo são necessárias para o funcionamento correto no iOS
		video.setAttribute('autoplay', '');
	    video.setAttribute('muted', '');
	    video.setAttribute('playsinline', '');
	    //--

	//Verifica se o navegador pode capturar mídia
	if (navigator.mediaDevices.getUserMedia) {
		navigator.mediaDevices.getUserMedia({audio: false, video: {facingMode: 'user'}})
		.then( function(stream) {
			//Definir o elemento víde a carregar o capturado pela webcam
			video.srcObject = stream;
		})
		.catch(function(error) {
			alert("Você não possui webcam.");
		});
	}
}

function takeSnapShot(){
	//Captura elemento de vídeo
	var video = document.querySelector("#webCamera");

	//Criando um canvas que vai guardar a imagem temporariamente
	var canvas = document.createElement('canvas');
	canvas.width = video.videoWidth;
	canvas.height = video.videoHeight;
	var ctx = canvas.getContext('2d');

	//Desnehando e convertendo as minensões
	ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

	//Criando o JPG
	var dataURI = canvas.toDataURL('image/jpeg'); //O resultado é um BASE64 de uma imagem.

 $image = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
            width: 300,
            height: 300,
            type: 'square' //circle
        },
        boundary: {
            width: 400,
            height: 400
        }
    });

    dataURI.on('change', function() {
        var reader = new FileReader();
        reader.onload = function(event) {
            $image.croppie('bind', {
                url: event.target.result
            }).then(function() {
                console.log('jQuery bind complete');
            });
        }
        reader.readAsDataURL(this.files[0]);
        $('#register').modal('hide');
        $('#uploadimage').modal('show');
        $('.fab').removeClass('show');
    });



}

// FIM CAMERA
