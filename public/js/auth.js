document.addEventListener('DOMContentLoaded', function () {
    let sign_in = getId('sign_in');

    onkeydown = function(e) {
        if (e.key === 'Enter') {
            sign_in.onclick();
        }
    };

    sign_in.onclick = function () {
        let login = getQS('input[name="login"]').value;
        let password = getQS('input[name="password"]').value;
        let params = 'login=' + login + '&password=' + password;

        ajax('POST', '/auth/login', params, function (data) {
            if (data === '0') {
                showPrompt('Пользователь ' + login + ' не найден!', '', '');
            } else if(data === '1') {
                showPrompt('Неверный пароль!', '', '');
            } else {
                window.location = data;
            }
        });
    }
});