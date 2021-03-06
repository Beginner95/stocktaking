document.addEventListener('DOMContentLoaded', function(){
    let add_product = getId('add_product');
    let save = getId('save');
    let modal_form_product = getQS('.modal-form-product');
    let close_modal_form = getQS('.btn-close');
    let select_category = getQS('.select-category');
    let select_manufacturer = getQS('.select-manufacturer');

    close_modal_form.onclick = function() {
        getId('product_form').reset();
        select_category.innerHTML = '';
        select_manufacturer.innerHTML = '';
        modal_form_product.style.display = 'none';
        hideCover();
    };

    add_product.onclick = function () {
        getQS('.modal-title').innerHTML = 'Добавление товара';
        ajax('GET', '/admin/index/edit/?id=&ajax=true', '', function (data) {
            let product = JSON.parse(data);

            for (let j = 0; j < product.categories.length; j++) {
                let el = cE('option');
                el.value = product.categories[j].id;
                el.textContent = product.categories[j].title;
                select_category.appendChild(el);
            }

            for (let j = 0; j < product.manufacturers.length; j++) {
                let el = cE('option');
                el.value = product.manufacturers[j].id;
                el.textContent = product.manufacturers[j].title;
                select_manufacturer.appendChild(el);
            }
        });

        let product_code = getId('code');
        product_code.onblur = function () {
            ajax('POST', '/admin/index/exists', 'code=' + product_code.value, function (data) {
                if (data !== '0') {
                    data = JSON.parse(data);
                    showPrompt('Код ' + product_code.value + ' имеется в базе данных, записан для товара ' + data[0].name, '', '');
                    product_code.value = '';
                }
            });
        };

        let product_name = getId('name');
        product_name.onblur = function () {
            ajax('POST', '/admin/index/exists', 'name=' + product_name.value, function (data) {
                if (data !== '0') {
                    data = JSON.parse(data);
                    showPrompt('Товар ' + product_name.value + ' имеется в базе данных, с кодом ' + data[0].code, '', '');
                    product_name.value = '';
                }
            });
        };

        modal_form_product.style.display = 'block';
        showCover();
        return false;
    };

    let purchase_price = getQS('input[name="purchase-price"]');
    let markup = getQS('input[name="markup"]');
    let price = getQS('input[name="price"]');
    let quantity = getQS('input[name="quantity"]');

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
        let manufacturer_id = getQS('select[name="manufacturer-id"]').value;
        let purchase_price = getQS('input[name="purchase-price"]').value;
        let markup = getQS('input[name="markup"]').value;
        let price = getQS('input[name="price"]').value;
        let quantity = getQS('input[name="quantity"]').value;

        if (name === '' || purchase_price === '' || markup === '' || quantity === '') {
            showPrompt('Заполните обязательные поля!', false, '');
        } else {
            if (id !== '') {
                let params = 'id=' + id + '&code=' + code + '&name=' + name + '&category-id=' + category_id + '&manufacturer-id=' + manufacturer_id + '&purchase-price=' + purchase_price + '&markup=' + markup + '&price=' + price + '&quantity=' + quantity;
                ajax('POST', '/admin/index/save/?id='+id, params, function (data) {
                    if (data === '') {
                        hideCover();
                        showPrompt('Товар ' + name + ' успешно обнавлен!', true, '/admin/index');
                        getId('product_form').reset();
                    } else {
                        hideCover();
                        showPrompt('При добавлении товара возникла ошибка!', false, '');
                    }
                });
            } else {
                let params = 'code=' + code + '&name=' + name + '&category-id=' + category_id + '&manufacturer-id=' + manufacturer_id + '&purchase-price=' + purchase_price + '&markup=' + markup + '&price=' + price + '&quantity=' + quantity;
                ajax('POST', '/admin/index/save', params, function (data) {
                    if (data === '') {
                        hideCover();
                        showPrompt('Товар ' + name + ' успешно добавлен!', true, '/admin/index');
                        getId('product_form').reset();
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
            ajax('GET', '/admin/index/delete/'+params, '', function (data) {
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
            ajax('GET', '/admin/index/edit/' + params, '', function (data) {
                let inputs = modal_form_product.getElementsByTagName('input');
                let product = JSON.parse(data);
                for (let j = 0; j < product.categories.length; j++) {
                    let el = cE('option');
                    if (product.categories[j].id === product.category_id) {
                        el.selected = true;
                    }
                    el.value = product.categories[j].id;
                    el.textContent = product.categories[j].title;
                    select_category.appendChild(el);
                }

                for (let j = 0; j < product.manufacturers.length; j++) {
                    let el = cE('option');
                    el.value = product.manufacturers[j].id;
                    el.textContent = product.manufacturers[j].title;
                    select_manufacturer.appendChild(el);
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

    let prod_purchase_price = getQSA('input[name="prod-purchase-price"]');
    let prod_markup = getQSA('input[name="prod-markup"]');
    let prod_price = getQSA('.prod-price');
    let prod_quantity = getQSA('input[name="prod-quantity"]');

    for(let i = 0; i < prod_purchase_price.length; i++) {
        prod_purchase_price[i].oninput = function () {
            prod_purchase_price[i].value = moneyFormat(prod_purchase_price[i].value.replace(/[^0-9.]+/g, ''));
            prod_price[i].innerHTML = moneyFormat(+prod_purchase_price[i].value.replace(/ /g,'') + +prod_markup[i].value.replace(/ /g,''));
        };

        prod_markup[i].oninput = function () {
            prod_markup[i].value = moneyFormat(prod_markup[i].value.replace(/[^0-9.]+/g, ''));
            prod_price[i].innerHTML = moneyFormat(+prod_purchase_price[i].value.replace(/ /g,'') + +prod_markup[i].value.replace(/ /g,''));
        };

        prod_quantity[i].onkeypress = function (e) {
            e = e || event;

            if (e.ctrlKey || e.altKey || e.metaKey) return;

            let chr = getChar(e);

            if (chr == null) return;

            if (chr < '0' || chr > '9') {
                return false;
            }
        };

        prod_purchase_price[i].onchange = function () {
            let product_id = prod_purchase_price[i].parentNode.parentNode.getAttribute('id');
            edit(product_id);
            saveAjax(product_id, prod_purchase_price[i].value, prod_markup[i].value, prod_price[i].innerText, prod_quantity[i].value);
            calc();
        };

        prod_markup[i].onchange = function () {
            let product_id = prod_purchase_price[i].parentNode.parentNode.getAttribute('id');
            edit(product_id);
            saveAjax(product_id, prod_purchase_price[i].value, prod_markup[i].value, prod_price[i].innerText, prod_quantity[i].value);
            calc();
        };

        prod_quantity[i].onchange = function () {
            let product_id = prod_purchase_price[i].parentNode.parentNode.getAttribute('id');
            edit(product_id);
            saveAjax(product_id, prod_purchase_price[i].value, prod_markup[i].value, prod_price[i].innerText, prod_quantity[i].value);
            calc();
        }
    }

    

    function edit(id) {
        ajax('GET', '/admin/index/edit/?id='+id+'&ajax=true', '', function (data) {});
    }

    function saveAjax(id, purchase_price, markup, price, quantity) {
        let params = 'id=' + id + '&ajax=true&purchase-price=' + purchase_price.replace(/ /g, '') + '&markup=' + markup.replace(/ /g, '') + '&price=' + price.replace(/ /g, '') + '&quantity=' + quantity;
        ajax('POST', '/admin/index/save/?id='+id, params, function (data) {});
    }

    function calc(){
        let sum = 0;
        let profit = 0;
        let quantity = 0;
        for(let i = 0; i < prod_price.length; i++) {
            sum += +prod_price[i].innerHTML.replace(/ /g, '') * +prod_quantity[i].value;
            quantity += +prod_quantity[i].value;
            profit += +prod_markup[i].value.replace(/ /g, '') * +prod_quantity[i].value;
        }

        getQS('.total-sum').innerHTML = moneyFormat(sum);
        getQS('.quantity').innerHTML = quantity;
        getQS('.total-sum-profit').innerHTML = moneyFormat(profit);
    }
    calc();
});