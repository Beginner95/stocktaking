document.addEventListener('DOMContentLoaded', function () {
	let btn_delete = getQSA('.delete');

	for (let i = 0; i < btn_delete.length; i++) {
		btn_delete[i].onclick = function () {
			let order = btn_delete[i].parentNode.parentNode;
			let order_id = order.getAttribute('id');
			ajax('GET', '/order/delete/?id=' + order_id, '', function (data) {
				if (data === '') {
					order.remove();
                    showPrompt(order.childNodes[3].innerText + ' был успешно удален!', '', '');
				}
            })
		}
	}
	
});