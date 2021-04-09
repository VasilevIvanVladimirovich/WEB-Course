function save_username_acc()
{
    let log = document.FormShadow.Login.value;
    let pas = document.FormShadow.Pass1.value;
    let mail = document.FormShadow.Email.value;
    let tel = document.FormShadow.tel.value;
    let age = document.FormShadow.age.value;

    localStorage.setItem('Login',JSON.stringify(log));
    localStorage.setItem('Password',JSON.stringify(pas));
    localStorage.setItem('Email',JSON.stringify(mail));
    localStorage.setItem('Telephone',JSON.stringify(tel));
    localStorage.setItem('Age',JSON.stringify(age));
}

function Check_login()
{
    let log = localStorage.getItem('Login');
    let pass = localStorage.getItem('Password');
    log = JSON.parse(log);
    pass = JSON.parse(pass)
    if(document.FormShadow2.Login.value === log && document.FormShadow2.Pas.value === pass)
    {
        writeCookie('Login', document.FormShadow2.Login.value,1);
        writeCookie('PWD', document.FormShadow2.Pas.value,1);
        window.location.reload();
        return 1;
    }else {
        alert("Такого пользователя не существует");
        return 0;
    }
}

