/*Dropdown Menu*/
$('.dropdownList').click(function () {
    $(this).attr('tabindex', 1).focus();
    $(this).toggleClass('active');
    $(this).find('.dropdown-menuList').slideToggle(300);
});
$('.dropdownList').focusout(function () {
    $(this).removeClass('active');
    $(this).find('.dropdown-menuList').slideUp(300);
});
$('.dropdownList .dropdown-menuList li').click(function () {
    $(this).parents('.dropdownList').find('span').text($(this).text());
    $(this).parents('.dropdownList').find('input').attr('value', $(this).attr('id'));
});
/*End Dropdown Menu*/


$('.dropdown-menuList li').click(function () {
    var input = '<strong>' + $(this).parents('.dropdownList').find('input').val() + '</strong>',
        msg = '<span class="msg">Hidden input value: ';
    $('.msg').html(msg + input + '</span>');
});