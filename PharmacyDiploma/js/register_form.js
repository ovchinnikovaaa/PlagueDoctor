function validate_form ( )
{
    valid = true;
    valid1 = true;

    if ( (document.register_form.Id.value == "") || (document.register_form.email.value == "") || (document.register_form.Pwd.value == "") || (document.register_form.Pwd1.value == ""))
    {
        alert ( "Пожалуйста, заполните все поля!" );
        valid = false;
    }
    if ( (document.register_form.Id.value != "") && (document.register_form.email.value != "") && (document.register_form.Pwd.value != "") && (document.register_form.Pwd1.value != "")) {
        checkLogin();
        checkEmail();
        checkPassword();
        if (valid == true) {
            if ((document.register_form.Pwd.value != document.register_form.Pwd1.value) && (temp_pass == true)) {
                alert("Пароли не совпадают! \n Попробуйте еще раз."); valid = false;
            }
        }
    }
    return valid;
}

function emailValidation(value) {
    let txt = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return txt.test(value);
}

function phoneValidation(value) {

    return /^\+\d{1,2}\(\d{3}\)\d{3}-\d{2}-\d{2}$/.test(value);

}

function checkLogin(){

    my_login = document.register_form.Id.value;
    temp_login = true;
    if(my_login.length < 4 || my_login.length > 20)
    { alert('В логине должен быть от 4 до 20 символов'); temp_login = false;}

}

function checkPassword() {
     temp_pass = false;
    var password = document.register_form.Pwd.value; // Получаем пароль из формы
    var s_letters = "qwertyuiopasdfghjklzxcvbnm"; // Буквы в нижнем регистре
    var b_letters = "QWERTYUIOPLKJHGFDSAZXCVBNM"; // Буквы в верхнем регистре
    var digits = "0123456789"; // Цифры
    //var specials = "!@#$%^&*()_-+=\|/.,:;[]{}"; // Спецсимволы
    var is_s = false; // Есть ли в пароле буквы в нижнем регистре
    var is_b = false; // Есть ли в пароле буквы в верхнем регистре
    var is_d = false; // Есть ли в пароле цифры
    for (var i = 0; i < password.length; i++) {
        /* Проверяем каждый символ пароля на принадлежность к тому или иному типу */
        if (!is_s && s_letters.indexOf(password[i]) != -1) is_s = true;
        else if (!is_b && b_letters.indexOf(password[i]) != -1) is_b = true;
        else if (!is_d && digits.indexOf(password[i]) != -1) is_d = true;
    }
    var rating = 0;
    //var text = "";
    if (is_s) rating++; // Если в пароле есть символы в нижнем регистре, то увеличиваем рейтинг сложности
    if (is_b) rating++; // Если в пароле есть символы в верхнем регистре, то увеличиваем рейтинг сложности
    if (is_d) rating++; // Если в пароле есть цифры, то увеличиваем рейтинг сложности
    if ((is_s == false) || (is_b == false) || (is_d == false)) {
        temp_pass = false;
    } else {
        temp_pass = true;
    }
    if ((password.length < 4) || (password.length > 20)) {
        alert('В пароле должны быть от 4 до 20 символов!');
    }
    if ((document.register_form.Pwd.value != document.register_form.Pwd1.value)) {
        alert("Пароли не совпадают! \n Попробуйте еще раз.");
    }
}


function checkEmail() {
    temp = true;
    let email = document.register_form.email.value;
    if (emailValidation(email)) {
        temp = true;
    } else {
        temp = false;
    }
}