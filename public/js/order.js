document.addEventListener('DOMContentLoaded', function () {
	let btn_delete = getQSA('.delete');
	let btn_return = getQSA('.return');
	let btn_show = getQSA('.show');
	let btn_print = getQSA('.print');
	let modal_form_order_products = getQS('.modal-form-order-products');
	let table_products = getQS('.table-cart');
    let close_modal_form = getQS('.btn-close');

    close_modal_form.onclick = function() {
        modal_form_order_products.style.display = 'none';
        hideCover();
    };

	for (let i = 0; i < btn_delete.length; i++) {
        let order = btn_delete[i].parentNode.parentNode;
        let order_id = order.getAttribute('id');
		btn_delete[i].onclick = function () {
			ajax('GET', '/order/delete/?id=' + order_id, '', function (data) {
				if (data === '') {
					order.remove();
                    showPrompt(order.childNodes[3].innerText + ' был успешно удален!', '', '');
				}
            })
		};

		btn_return[i].onclick = function () {
			ajax('GET', '/order/return/?id=' + order_id, '', function (data) {
				if (data === '') {
                    order.remove();
                    showPrompt(order.childNodes[3].innerText + ' был успешно отменен!', '', '');
				}
            })
        };

		btn_show[i].onclick = function () {
		    showCover();
            modal_form_order_products.style.display = 'block';
            getQS('.modal-title').innerHTML = 'Заказ №' + order_id;
			ajax('GET', '/order/products/?order_id=' + order_id, '', function (data) {
				data = JSON.parse(data);
                let arr = [];
                let num = 1;
                for (let i = 0; i < data.length; i++) {
                    arr[i] = '<tr id="' + data[i].id + '"><td>' + num++ + '</td><td>' + data[i].code + '</td><td>' + data[i].name + '</td><td>' + moneyFormat(data[i].price) + '</td><td>' + data[i].quantity + '</td><td>' + moneyFormat(data[i].price * data[i].quantity) + '</td></tr>';

                }
                table_products.childNodes[3].innerHTML = arr.join('');
                table_products.childNodes[5].innerHTML = '<tr><td colspan="5">Итого:</td><td>' + order.childNodes[9].innerHTML + '</td></tr>';
            })
        };

        btn_print[i].onclick = function () {
            let table = cE('table');
            table.id = 'print';
            table.innerHTML += '<thead><tr><th colspan="6"><h2>Заказ №' + order_id + ' от ' + order.childNodes[11].innerHTML + '</h2></th></tr><tr><th>№</th><th>Артикул</th><th>Наименование</th><th>Цена</th><th>Количество</th><th>Сумма</th></tr></thead>';
            ajax('GET', '/order/products/?order_id=' + order_id, '', function (data) {
                data = JSON.parse(data);
                let arr = [];
                let num = 1;
                for (let i = 0; i < data.length; i++) {
                    arr[i] = '<tr id="' + data[i].id + '"><td>' + num++ + '</td><td>' + data[i].code + '</td><td>' + data[i].name + '</td><td>' + moneyFormat(data[i].price) + '</td><td>' + data[i].quantity + '</td><td>' + moneyFormat(data[i].price * data[i].quantity) + '</td></tr>';

                }
                table.innerHTML += arr.join('');
                table.innerHTML += '<tfoot><tr><td colspan="5">Итого:</td><td>' + order.childNodes[9].innerHTML + '</td></tr></tfoot>';

                getQS('body').insertBefore(table, null);

                PrintElem(table);

            });
            return false;
        };

	}
});