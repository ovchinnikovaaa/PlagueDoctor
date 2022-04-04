function validate_form1 ( )
{
    valid = true;
    if ((document.enter_form.Id.value == "") && (document.enter_form.Pwd.value == ""))
    {
        alert ("Такой учетной записи не существует!\nПожалуйста, зарегистрируйтесь!");
        valid = false;
    }
    return valid;
}

