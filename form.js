function required(elementClass) {

    // Checking required condition for element
    element = document.getElementsByName(elementClass);
    var atleastonechecked = false;

    for(i=0; i<element.length; i++){
        if (element[i].checked === true) {
            atleastonechecked = true;
            break;
        }
    }

    if (atleastonechecked === true){
        for (i=0; i<element.length; i++){
            element[i].required = false;
        }
    }
}
