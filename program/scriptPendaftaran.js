function checkButton(){
    if(document.getElementById('rd2').checked){
        document.getElementById('noBPJS').disabled = true;
    }else if(document.getElementById('rd1').checked){
        document.getElementById('noBPJS').disabled = false;
    }
}