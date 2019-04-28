document.addEventListener('DOMContentLoaded', function () {
    let modal_form_category = getQS('.modal-form-category');
    let add_category = getQS('.add-category');
    let close_modal_form = getQS('.btn-close');
    let inputs = modal_form_category.getElementsByTagName('input');

    add_category.onclick = function () {
        getQS('.modal-title').innerHTML = 'Добавление категории';
        modal_form_category.style.display = 'block';
        showCover();
        return false;
    };

    close_modal_form.onclick = function() {
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].value = '';
        }
        modal_form_category.style.display = 'none';
        hideCover();
    };

    let btn_delete = getQSA('.delete');
    for (let i = 0; i < btn_delete.length; i++) {
        btn_delete[i].onclick = function() {
            let category = btn_delete[i].parentNode.parentNode;
            let params = '?id='+category.getAttribute('id');
            ajax('GET', '/category/delete/'+params, '', function (data) {
                if (data === '') {
                    category.remove();
                    showPrompt('Категория ' + category.childNodes[3].innerText + ' была успешно удалена!', '', '');
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
                ajax('POST', '/category/save/?id='+id, params, function (data) {
                    if (data === '') {
                        hideCover();
                        showPrompt('Категория ' + title + ' успешно обнавлена!', true, '/category');
                        for (let i = 0; i < inputs.length; i++) {
                            inputs[i].value = '';
                        }
                    } else {
                        hideCover();
                        showPrompt('При обнавлении категории возникла ошибка!', false, '');
                    }
                });
            } else {
                let params = 'title=' + title + '&description=' + description;
                ajax('POST', '/category/save', params, function (data) {
                    if (data === '') {
                        hideCover();
                        showPrompt('Категория ' + title + ' успешно добавлена!', true, '/category');
                        for (let i = 0; i < inputs.length; i++) {
                            inputs[i].value = '';
                        }
                    } else {
                        hideCover();
                        showPrompt('При добавлении категории возникла ошибка!', false, '');
                    }
                });
            }
            modal_form_category.style.display = 'none';
        }
        return false;
    };

    let btn_edit = getQSA('.edit');
    for (let i = 0; i < btn_edit.length; i++) {
        btn_edit[i].onclick = function () {
            getQS('.modal-title').innerHTML = 'Редактирование категории';
            let category = btn_edit[i].parentNode.parentNode;
            let params = '?id=' + category.getAttribute('id') +'&ajax=true';
            ajax('GET', '/category/edit/' + params, '', function (data) {
                let inputs = modal_form_category.getElementsByTagName('input');
                let category = JSON.parse(data);
                for(let i = 0; i < inputs.length; i++) {
                    switch (inputs[i].name) {
                        case 'id':
                            inputs[i].value = category.id;
                            break;
                        case 'title':
                            inputs[i].value = category.title;
                            break;
                        case 'description':
                            inputs[i].value = category.description;
                            break;
                        default:
                            showPrompt('Неизвестное поле', false, '');
                    }
                }
                modal_form_category.style.display = 'block';
                showCover();
                return false;
            })
        }
    }

});