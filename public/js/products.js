document.addEventListener('DOMContentLoaded', function(){
    let add_product = getId('add_product');
    let save = getId('save');
    let modal_form_product = getQS('.modal-form-product');
    let close_modal_form = getQS('.btn-close');
    let inputs = modal_form_product.getElementsByTagName('input');

    close_modal_form.onclick = function() {
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].value = '';
        }
        modal_form_product.style.display = 'none';
        hideCover();
    };

    add_product.onclick = function () {
        getQS('.modal-title').innerHTML = 'Добавление товара';
        ajax('GET', '/index/edit/?id=&ajax=true', '', function (data) {
            c(data);
            let product = JSON.parse(data);
            let select = getQS('.select');
            for (let j = 0; j < product.categories.length; j++) {
                let el = cE('option');
                el.value = product.categories[j].id;
                el.textContent = product.categories[j].title;
                select.appendChild(el);
            }
        });
        modal_form_product.style.display = 'block';
        showCover();
        return false;
    };

    let purchase_price = getQS('input[name="purchase-price"]');
    let markup = getQS('input[name="markup"]');
    let price = getQS('input[name="price"]');
    let quantity = getQS('input[name="quantity"]')

    purchase_price.oninput = function(){
        purchase_price.value = purchase_price.value.replace(/[^0-9.]+/g, '');
        price.value = +purchase_price.value + +markup.value;
    };

    markup.oninput = function(){
        markup.value = markup.value.replace(/[^0-9.]+/g, '');
        price.value = +purchase_price.value + +markup.value;
    };

    quantity.onkeypress = function(e){
        e = e || event;

        if (e.ctrlKey || e.altKey || e.metaKey) return;

        let chr = getChar(e);

        if (chr == null) return;

        if (chr < '0' || chr > '9') {
            return false;
        }
    };

    save.onclick = function () {
        let id = getQS('input[name="id"]').value;
        let code = getQS('input[name="code"]').value;
        let name = getQS('input[name="name"]').value;
        let category_id = getQS('select[name="category-id"]').value;
        let manufacturer_id = getQS('input[name="manufacturer-id"]').value;
        let purchase_price = getQS('input[name="purchase-price"]').value;
        let markup = getQS('input[name="markup"]').value;
        let price = getQS('input[name="price"]').value;
        let quantity = getQS('input[name="quantity"]').value;

        if (name === '' || purchase_price === '' || markup === '' || quantity === '') {
            showPrompt('Заполните обязательные поля!', false, '');
        } else {
            if (id !== '') {
                let params = 'id=' + id + '&code=' + code + '&name=' + name + '&category-id=' + category_id + '&manufacturer-id=' + manufacturer_id + '&purchase-price=' + purchase_price + '&markup=' + markup + '&price=' + price + '&quantity=' + quantity;
                ajax('POST', '/index/save/?id='+id, params, function (data) {
                    if (data === '') {
                        hideCover();
                        showPrompt('Товар ' + name + ' успешно обнавлен!', true, '/index');
                        for (let i = 0; i < inputs.length; i++) {
                            inputs[i].value = '';
                        }
                    } else {
                        hideCover();
                        showPrompt('При добавлении товара возникла ошибка!', false, '');
                    }
                });
            } else {
                let params = 'code=' + code + '&name=' + name + '&category-id=' + category_id + '&manufacturer-id=' + manufacturer_id + '&purchase-price=' + purchase_price + '&markup=' + markup + '&price=' + price + '&quantity=' + quantity;
                ajax('POST', '/index/save', params, function (data) {
                    if (data === '') {
                        hideCover();
                        showPrompt('Товар ' + name + ' успешно добавлен!', true, '/index');
                        for (let i = 0; i < inputs.length; i++) {
                            inputs[i].value = '';
                        }
                    } else {
                        hideCover();
                        showPrompt('При добавлении товара возникла ошибка!', false, '');
                    }
                });
            }
            modal_form_product.style.display = 'none';
        }

        return false;
    };

    let btn_delete = getQSA('.delete');
    for (let i = 0; i < btn_delete.length; i++) {
        btn_delete[i].onclick = function() {
            let product = btn_delete[i].parentNode.parentNode;
            let params = '?id='+product.getAttribute('id');
            ajax('GET', '/index/delete/'+params, '', function (data) {
                if (data === '') {
                    product.remove();
                    showPrompt('Товар ' + product.childNodes[5].innerText + ' был успешно удален!', '', '');
                }
            })
        }
    }

    let btn_edit = getQSA('.edit');
    for (let i = 0; i < btn_edit.length; i++) {
        btn_edit[i].onclick = function () {
            getQS('.modal-title').innerHTML = 'Редактирование товара';
            let product = btn_edit[i].parentNode.parentNode;
            let params = '?id=' + product.getAttribute('id') +'&ajax=true';
            ajax('GET', '/index/edit/' + params, '', function (data) {
                let inputs = modal_form_product.getElementsByTagName('input');
                let product = JSON.parse(data);
                let select = getQS('.select');
                for (let j = 0; j < product.categories.length; j++) {
                    let el = cE('option');
                    if (product.categories[j].id === product.category_id) {
                        el.selected = true;
                    }
                    el.value = product.categories[j].id;
                    el.textContent = product.categories[j].title;
                    select.appendChild(el);
                }
                for(let i = 0; i < inputs.length; i++) {
                    switch (inputs[i].name) {
                        case 'id':
                            inputs[i].value = product.id;
                            break;
                        case 'code':
                            inputs[i].value = product.code;
                            break;
                        case 'name':
                            inputs[i].value = product.name;
                            break;
                        case 'manufacturer-id':
                            inputs[i].value = product.manufacturer_id;
                            break;
                        case 'purchase-price':
                            inputs[i].value = product.purchase_price;
                            break;
                        case 'markup':
                            inputs[i].value = product.markup;
                            break;
                        case 'price':
                            inputs[i].value = product.price;
                            break;
                        case 'quantity':
                            inputs[i].value = product.quantity;
                            break;
                        default:
                            showPrompt('Неизвестное поле', false, '');
                    }
                }
                modal_form_product.style.display = 'block';
                showCover();
                return false;
            })
        }
    }
});