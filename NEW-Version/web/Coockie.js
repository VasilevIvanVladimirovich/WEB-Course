function writeCookie(name, value, days) {
    // По умолчанию куки являются временными, не имея срока хранения

    var expires = "";

    // Указав число дней, сделаем куки постоянными
    if(days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }

    // Присвоим куки имя, значение и срок хранения
    document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
    // Найдем конкретный куки и вернем его значение

    var searchName = name + "=";
    var cookies = document.cookie.split(';');
    for(var i = 0; i < cookies.length; i++) {
        var c = cookies[i];
        while (c.charAt(0) == ' ')
            c = c.substring(1, c.length);
        if(c.indexOf(searchName) == 0)
            return c.substring(searchName.length, c.length);
    }
    return null;
}

function readCookiePlace() {
    let log=readCookie('Login');
    let ref=document.createElement('a');
    if(log!=null) {
        document.getElementById('logout').innerHTML = "<ul>" + "<li>" + "Вы вошли как " + log + "</li>" + "<li>" + '<a onclick="CookiesDelete(); window.location.reload();">' + "Выйти" + "</a>" + "</li>";
    }else{
        document.getElementById('logout').innerHTML = "<ul>" + "<li>" +'<a onclick="showModalWin();">' + 'Регистрация' + "</a>"+ "</li>" + "<li>" + '<a onclick="showModalWin2();">' +"Логин"+ "</a>" + "</li>";

    }
}
//Функция "удаляет" куки из браузера посредством установки срока хранения
// на одну секунду раньше текущего значения времени.
function CookiesDelete() {
    var cookies = document.cookie.split(";");
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;";
        document.cookie = name + '=; path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }
}




/*function delete_cookie( cookie_name )
{
    let cookie_date = new Date ( );  // Текущая дата и время
    cookie_date.setTime ( cookie_date.getTime() - 1 );
    document.cookie = cookie_name += "=; expires=" + cookie_date.toGMTString();
}*/
