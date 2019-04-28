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
            let product = btn_delete[i].parentNode.parentNode;
            let params = '?id='+product.getAttribute('id');
            ajax('GET', '/category/delete/'+params, '', function (data) {
                if (data === '') {
                    product.remove();
                    showPrompt('Категория ' + product.childNodes[3].innerText + ' была успешно удалена!', '', '');
                }
            })
        }
    }

});