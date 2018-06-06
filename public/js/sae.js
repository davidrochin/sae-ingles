//Activa todos los elementos de la Form
function formEditMode(formName){

    //Activar los elementos de la Form
    var formElements = document.forms[formName].elements;
    for(var i = 0; i < formElements.length; i++){
        if(formElements[i].name != 'id' && formElements[i].name != ''){
            formElements[i].readOnly = false;
            formElements[i].disabled = false;
        }
    }

    //Aparecer el botón de enviar
    document.getElementById('submitFormButton').hidden = false;
}

//Elimina un elemento por su id
function deleteById(id){
    var element = document.getElementById(id);
    element.outerHTML = '';
    delete element;
}