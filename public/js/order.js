document.addEventListener('DOMContentLoaded', function () {
	let btn_delete = getQSA('.delete');
	let btn_return = getQSA('.return');

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
	}
});