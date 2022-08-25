//===================== CORTE DE IMAGEM FORM


$(document).ready(function () {
       var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
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

    $image_edit = $('#image_prev').croppie({
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

    // NOVO VISITANTE
    $('#upload_image').on('change', function() {
        var reader = new FileReader();
        reader.onload = function(event) {
            $image.croppie('bind', {
                url: event.target.result
            }).then(function() {
                console.log('Foto novo visitante carregada');
            });
        }
        reader.readAsDataURL(this.files[0]);
        $('#register').modal('hide');
        $('#uploadimage').modal('show');
        $('.fab').removeClass('show');
    });

    $('#crop_image').click(function(event) {
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

    // EDITAR FOTO DE perfil

    $('#upload_new_image').on('change', function () {
        var reader = new FileReader();
        reader.onload = function(event) {
            $image_edit.croppie('bind', {
                url: event.target.result
            }).then(function() {
                console.log('Nova foto do visitante carregada');
            });
        }
        reader.readAsDataURL(this.files[0]);
        $('#visitor_profile').modal('hide');
        $('#uploadnewimage').modal('show');
        $('.fabE').removeClass('show');


    });

    $('#crop_new_image').click(function(event) {
          $image_edit.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (response) {
            $('#uploadnewimage').modal('hide');
            document.getElementById("edit_img").src = response;
            var data = {
                id: $('#v_id').val(),
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

    // CAPITURA FOTO VISITANTE
    function takeSnapShot() {
        //Captura elemento de vídeo
        var video = document.querySelector("#webCamera");

        //Criando um canvas que vai guardar a imagem temporariamente
        var canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        var ctx = canvas.getContext('2d');

        //Desnehando e convertendo as minensões
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

        $image.croppie('bind', {
            url: canvas.toDataURL('image/jpeg')
        }).then(function() {
            console.log('Foto capturada')
        });

        $('#register').modal('hide');
        $('#webcam').modal('hide');
        $('#uploadimage').modal('show');
        $('.fab').removeClass('show');
    };

    // CAPITURA FOTO PARA EDITAR
    function takeSnapShotEdit() {
        //Captura elemento de vídeo
        var video = document.querySelector("#webCamera");

        //Criando um canvas que vai guardar a imagem temporariamente
        var canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        var ctx = canvas.getContext('2d');

        //Desnehando e convertendo as minensões
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

        $image_edit.croppie('bind', {
            url: canvas.toDataURL('image/jpeg')
        }).then(function() {
            console.log('Foto capturada')
        });

        $('#visitor_profile').modal('hide');
        $('#webcam').modal('hide');
        $('#uploadnewimage').modal('show');
        $('.fabE').removeClass('show');

    }


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


function toggleFAB(fabE){
	if(document.querySelector(fabE).classList.contains('show')){
  	document.querySelector(fabE).classList.remove('show');
  }else{
  	document.querySelector(fabE).classList.add('show');
  }
}

document.querySelector('.fabE .main').addEventListener('click', function(){
	toggleFAB('.fabE');
});

document.querySelectorAll('.fabE ul li button').forEach((item)=>{
	item.addEventListener('click', function(){
		toggleFAB('.fabE');
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


function loadCamera(value){
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
            if (value == 'e') {
                $('#take').html('<button type="button" class="btn btn-success" onclick="return takeSnapShotEdit()">Tira foto</button>')
            } else {
                $('#take').html('<button type="button" class="btn btn-success" onclick="return takeSnapShot()">Tira foto</button>')
            }

		})
		.catch(function(error) {
			alert("Você não possui webcam.");
		});
	}
}



// FIM CAMERA
