function Compl() {
    if(document.Form.pasw1.value==document.Form.pasw2.value)
    {
        document.getElementById('control').innerHTML="<img src=\"img/click.jpg\" width=\"20\"/>";
    }else document.getElementById('control').innerHTML="";
}