document.addEventListener('DOMContentLoaded', function() {
	let add_user = getQS('.add-user');
	let modal_form_user = getQS('.modal-form-user');
	let close_modal_form = getQS('.btn-close');
    let array_role = ['Manager', 'Administrator'];
    let select_role = getQS('select[name="role"]');

    add_user.onclick = function () {
        getQS('.modal-title').innerHTML = 'Добавление пользователя';
        select_role.innerHTML = '';
        for (let i = 0; i < array_role.length; i++) {
            let el = cE('option');
            el.value = array_role[i];
            el.textContent = array_role[i];
            select_role.appendChild(el);
        }

        modal_form_user.style.display = 'block';
        showCover();
        return false;
    };

    close_modal_form.onclick = function() {
        getId('user_form').reset();
        modal_form_user.style.display = 'none';
        hideCover();
    };

    let btn_delete = getQSA('.delete');
    for (let i = 0; i < btn_delete.length; i++) {
        btn_delete[i].onclick = function() {
            let user = btn_delete[i].parentNode.parentNode;
            let params = '?id='+user.getAttribute('id');
            ajax('GET', '/user/delete/'+params, '', function (data) {
                if (data === '') {
                    user.remove();
                    showPrompt('Пользователь ' + user.childNodes[3].innerText + ' был успешно удален!', '', '');
                }
            })
        }
    }

    let save = getId('save');
    save.onclick = function () {
        let id = getQS('input[name="id"]').value;
        let login = getQS('input[name="login"]').value;
        let password = getQS('input[name="password"]').value;
        let first_name = getQS('input[name="first-name"]').value;
        let last_name = getQS('input[name="last-name"]').value;
        let second_name = getQS('input[name="second-name"]').value;
        let role = getQS('select[name="role"]').value;

        if (login === '' || password === '' || first_name === '' || last_name === '') {
            showPrompt('Заполните обязательные поля!', false, '');
        } else {
            if (id !== '') {
                let params = 'id=' + id + '&login=' + login + '&password=' + password + '&first-name=' + first_name + '&last-name=' + last_name + '&second-name=' + second_name + '&role=' + role;
                ajax('POST', '/user/save/?id='+id, params, function (data) {
                    if (data === '') {
                        hideCover();
                        showPrompt('Пользователь ' + login + ' успешно обнавлен!', true, '/user');
                        getId('user_form').reset();
                    } else {
                        hideCover();
                        showPrompt('При обнавлении пользователя возникла ошибка!', false, '');
                    }
                });
            } else {
                let params = 'login=' + login + '&password=' + password + '&first-name=' + first_name + '&last-name=' + last_name + '&second-name=' + second_name + '&role=' + role;
                ajax('POST', '/user/save', params, function (data) {
                    if (data === '') {
                        hideCover();
                        showPrompt('Пользователь ' + login + ' успешно добавлен!', true, '/user');
                        getId('user_form').reset();
                    } else {
                        hideCover();
                        showPrompt('При добавлении пользователя возникла ошибка!', false, '');
                    }
                });
            }
            modal_form_user.style.display = 'none';
        }
        return false;
    };

    let btn_edit = getQSA('.edit');
    for (let i = 0; i < btn_edit.length; i++) {
        btn_edit[i].onclick = function () {
            getQS('.modal-title').innerHTML = 'Редактирование пользователя';
            let user = btn_edit[i].parentNode.parentNode;
            let params = '?id=' + user.getAttribute('id') +'&ajax=true';
            ajax('GET', '/user/edit/' + params, '', function (data) {
                let inputs = modal_form_user.getElementsByTagName('input');
                let user = JSON.parse(data);
                select_role.innerHTML = '';
                for (let i = 0; i < array_role.length; i++) {
                    let el = cE('option');
                    if (user.role === array_role[i]) {
                        el.selected = true;
                    }
                    el.value = array_role[i];
                    el.textContent = array_role[i];
                    select_role.appendChild(el);
                }

                for(let i = 0; i < inputs.length; i++) {
                    switch (inputs[i].name) {
                        case 'id':
                            inputs[i].value = user.id;
                            break;
                        case 'login':
                            inputs[i].value = user.login;
                            break;
                        case 'password':
                            inputs[i].value = user.password;
                            break;
                        case 'first-name':
                            inputs[i].value = user.first_name;
                            break;
                        case 'last-name':
                            inputs[i].value = user.last_name;
                            break;
                        case 'second-name':
                            inputs[i].value = user.second_name;
                            break;
                        default:
                            showPrompt('Неизвестное поле', false, '');
                    }
                }
                modal_form_user.style.display = 'block';
                showCover();
                return false;
            })
        }
    }
});