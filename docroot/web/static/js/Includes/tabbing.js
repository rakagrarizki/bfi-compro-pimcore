var idnext = 1;
var idprev = 0;
var idclick = 'perkembangan-perusahaan';
function scrollPosition(id){
    $("#outer-choice").scrollLeft($("#div"+id).position().left+document.getElementById('outer-choice').scrollLeft)
}

function setPreviewId(prev,next){
    idnext = next;
    idprev = prev;
    if(next){
        $('#nextButton').show();
    }else{
        $('#nextButton').hide();
    }
    if(prev !== ''){
        $('#prevButton').show();
    }else{
        $('#prevButton').hide();
    }
    console.log('setpriview');
}

function next(){
    scrollPosition(idnext);
    $('#href'+idnext).click();
}

function prev(){
    scrollPosition(idprev);
    $('#href'+idprev).click();
}