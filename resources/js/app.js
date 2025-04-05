import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

if(document.querySelector('#dropzone') !== null){
    const dropzone = new Dropzone('#dropzone',{
        dictDefaultMessage : "sube tu imagen ",
        acceptedFiles : ".png, .jpeg, .jpg, .gift",
        addRemoveLinks : true,
        dictRemoveFile : 'Borrar Archivo',
        maxFiles : 1,
        uploadMultiple: false,
        init: function(){
            if(document.querySelector('[name="image"]').value.trim()){
                const imagenPublicada = {};
                imagenPublicada.size = 1234;
                imagenPublicada.name = document.querySelector('[name="image"]').value;
                this.options.addedfile.call(this, imagenPublicada);
                this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);
                imagenPublicada.previewElement.classList.add('dz-success');
                imagenPublicada.previewElement.classList.add('dz-complete');
            }
        }
    });

    dropzone.on('success',function(file, response){
        document.querySelector('[name="image"]').value = response.imagen;
    });
    
    dropzone.on('error',function(file, message){
        console.log(message);
    });
    
    dropzone.on('removedfile',function(){
        document.querySelector('[name="image"]').value = '';
    });
    
}


