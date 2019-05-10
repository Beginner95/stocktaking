document.addEventListener('DOMContentLoaded', function () {
    let search = getId('search');
    let item = getQS('.item');
    getId('reset').onclick = function() {
        hideCover();
        search.value = '';
        search.oninput();
    };

    search.onfocus = function () {
        if (search.value === '') {
            showCover();
        }
    };

    search.onblur = function () {
        if (search.value === '') {
            hideCover();
        }
    };

    search.oninput = function () {
        let params = 'q=' + this.value;
        ajax('POST', '/index/search', params, function (data) {
            let list = getId('list');
            if (data !== '') {
                data = JSON.parse(data);
                let query = params.split('q=')[1];
                let arr = [];
                if (query.length > 0) {
                    for (let i = 0; i < data.length; i++) {
                        arr[i] = '<tr id="' + data[i].id + '" class="add"><td>' + data[i].code + '</td><td>' + data[i].name + '</td><td>' + moneyFormat(data[i].price) + '</td><td>' + data[i].quantity + '</td></tr>';
                    }
                    list.innerHTML = '<table class="table-cart"><tr><th>Артикул</th><th>Наименование</th><th>Цена</th><th>Количество</th></tr>' + arr + '</table>';
                    list.style.visibility = "visible";
                }
                let add = getQSA('.add');
                for (let i = 0; i < add.length; i++) {
                    add[i].onclick = function () {
                        if (search.value === '') return false;
                        if (add[i].childNodes[3].innerHTML === '0') {
                            showPrompt('Нет товара', '', '');
                        } else {
                            let td_delete = cE('td');
                            let td_sum = cE('td');
                            add[i].childNodes[3].innerHTML = '<input type="text" name="quantity" value="1" autocomplete="off">';
                            add[i].insertBefore(td_sum, null);
                            add[i].childNodes[4].innerHTML = add[i].childNodes[2].innerHTML;
                            add[i].insertBefore(td_delete, null);
                            add[i].childNodes[5].innerHTML = '<a href="#" class="delete"><img src="/public/images/icon_delete.svg" title="Удалить"></a>';
                            item.appendChild(add[i]);
                            calc();
                        }
                    };
                }
            } else {
                list.innerHTML = '';
                list.style.visibility = "hidden";
            }
        })
    };

    item.onclick = function (event) {
        let target = event.target;
        if (target.tagName === 'IMG') {
            target.parentNode.parentNode.parentNode.remove();
            calc();
        }

        if (target.tagName === 'INPUT') {
            let sum = +target.parentNode.parentNode.childNodes[2].innerHTML.replace(/ /g, '');
            let id = target.parentNode.parentNode.getAttribute('id');
            target.oninput = function () {
                ajax('GET', '/index/product/?id=' + id, '', function (data) {
                    data = JSON.parse(data);
                    if (parseInt(target.value) > parseInt(data.quantity)) {
                        showPrompt('Нет такого количества, осталось только ' + data.quantity + ' шт.', '', '');
                        target.value = data.quantity;
                    } else {
                        target.parentNode.parentNode.childNodes[4].innerHTML = moneyFormat(sum * target.value);
                        calc();
                    }
                });
            };
        }
    };

    function calc() {
        let inputs = item.getElementsByTagName('input');
        let tr = item.getElementsByTagName('tr');
        let quantity = 0;
        let total_sum = 0;

        for (let i = 0; i < inputs.length; i++) {
            quantity += +inputs[i].value;
            total_sum += +tr[i].childNodes[4].innerHTML.replace(/ /g, '');
        }

        getQS('.quantity').innerHTML = quantity;
        getQS('.total-sum').innerHTML = moneyFormat(total_sum);
    }

    let checkout = getId('checkout');
    checkout.onclick = function () {
        let products = item.getElementsByTagName('tr');
        let cart = {};
        for (let i = 0; i < products.length; i++) {
            cart[i] = {
                "id": products[i].getAttribute('id'),
                "code": products[i].childNodes[0].innerHTML,
                "name": products[i].childNodes[1].innerHTML,
                "price": products[i].childNodes[2].innerHTML.replace(/ /g, ''),
                "quantity": products[i].childNodes[3].childNodes[0].value
            };
        }
        let params = 'products=' + JSON.stringify(cart) + '&quantity=' + getQS('.quantity').innerHTML + '&total-sum=' + getQS('.total-sum').innerHTML.replace(/ /g, '');
        ajax('POST', '/index/checkout', params, function (data) {
            if (data === '0') {
                showPrompt('Нет выбранных товаров для оформления заказа!', '', '');
            } else if (data === '1') {
                showPrompt('Заказ успешно оформлен!', '', '');
                item.innerHTML = '';
            }
        });
    };
});