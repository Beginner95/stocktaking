document.addEventListener('DOMContentLoaded', function () {
    let modal_form_manufacturer = getQS('.modal-form-category');
    let add_manufacturer = getQS('.add-category');
    let close_modal_form = getQS('.btn-close');

    add_manufacturer.onclick = function () {
        getQS('.modal-title').innerHTML = 'Добавление производителя';
        modal_form_manufacturer.style.display = 'block';
        showCover();
        return false;
    };

    close_modal_form.onclick = function() {
        getId('manufacturer_form').reset();
        modal_form_manufacturer.style.display = 'none';
        hideCover();
    };

    let btn_delete = getQSA('.delete');
    for (let i = 0; i < btn_delete.length; i++) {
        btn_delete[i].onclick = function() {
            let manufacturer = btn_delete[i].parentNode.parentNode;
            let params = '?id='+manufacturer.getAttribute('id');
            ajax('GET', '/admin/manufacturer/delete/'+params, '', function (data) {
                if (data === '') {
                    manufacturer.remove();
                    showPrompt('Категория ' + manufacturer.childNodes[3].innerText + ' была успешно удалена!', '', '');
                }
            })
        }
    }

    let save = getId('save');
    save.onclick = function () {
        let id = getQS('input[name="id"]').value;
        let title = getQS('input[name="title"]').value;
        let description = getQS('input[name="description"]').value;

        if (title === '') {
            showPrompt('Заполните обязательные поля!', false, '');
        } else {
            if (id !== '') {
                let params = 'id=' + id + '&title=' + title + '&description=' + description;
                ajax('POST', '/admin/manufacturer/save/?id='+id, params, function (data) {
                    if (data === '') {
                        hideCover();
                        showPrompt('Производитель ' + title + ' успешно обнавлена!', true, '/admin/manufacturer');
                        getId('manufacturer_form').reset();
                    } else {
                        hideCover();
                        showPrompt('При обнавлении производителя возникла ошибка!', false, '');
                    }
                });
            } else {
                let params = 'title=' + title + '&description=' + description;
                ajax('POST', '/admin/manufacturer/save', params, function (data) {
                    if (data === '') {
                        hideCover();
                        showPrompt('Производитель ' + title + ' успешно добавлен!', true, '/admin/manufacturer');
                        getId('manufacturer_form').reset();
                    } else {
                        hideCover();
                        showPrompt('При добавлении производителя возникла ошибка!', false, '');
                    }
                });
            }
            modal_form_manufacturer.style.display = 'none';
        }
        return false;
    };

    let btn_edit = getQSA('.edit');
    for (let i = 0; i < btn_edit.length; i++) {
        btn_edit[i].onclick = function () {
            getQS('.modal-title').innerHTML = 'Редактирование производителя';
            let manufacturer = btn_edit[i].parentNode.parentNode;
            let params = '?id=' + manufacturer.getAttribute('id') +'&ajax=true';
            ajax('GET', '/admin/manufacturer/edit/' + params, '', function (data) {
                let inputs = modal_form_manufacturer.getElementsByTagName('input');
                let manufacturer = JSON.parse(data);
                for(let i = 0; i < inputs.length; i++) {
                    switch (inputs[i].name) {
                        case 'id':
                            inputs[i].value = manufacturer.id;
                            break;
                        case 'title':
                            inputs[i].value = manufacturer.title;
                            break;
                        case 'description':
                            inputs[i].value = manufacturer.description;
                            break;
                        default:
                            showPrompt('Неизвестное поле', false, '');
                    }
                }
                modal_form_manufacturer.style.display = 'block';
                showCover();
                return false;
            })
        }
    }
});