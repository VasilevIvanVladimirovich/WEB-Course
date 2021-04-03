function showModalWin() {
    let darkLayer = document.createElement('div'); // слой затемнения
    darkLayer.id = 'shadow'; // id чтобы подхватить стиль
    document.body.appendChild(darkLayer); // включаем затемнение
    let modalWin = document.getElementById('popupWin'); // находим наше "окно"
    modalWin.style.display = 'block'; // "включаем" его
    darkLayer.onclick = function () { // при клике на слой затемнения все исчезнет
        darkLayer.parentNode.removeChild(darkLayer); // удаляем затемнение
        modalWin.style.display = 'none'; // делаем окно невидимым
        return false;
    };
}

function Complete()
{
    if(document.FormShadow.Pass1.value!==document.FormShadow.Pass2.value )
    {
        document.FormShadow.Pass1.style.borderColor = "red";
        document.FormShadow.Pass2.style.borderColor = "red";
        alert("Ошибка ввода пароля");
    }
}
