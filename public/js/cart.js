document.addEventListener('DOMContentLoaded', function () {
    let search = getId('search');
    let item = getQS('.item');
    getId('reset').onclick = function() {
        hideCover();
        search.value = '';
        search.oninput();
    };

    search.onfocus = function () {
        showCover();
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

                            //add[i].classList.remove('add');
                            let td = cE('td');
                            add[i].childNodes[3].innerHTML = '<input type="text" name="quantity" value="1" autocomplete="off">';
                            add[i].insertBefore(td, add[i].children[4]);
                            add[i].childNodes[4].innerHTML = '<td><a href="#" class="delete"><img src="/public/images/icon_delete.svg" title="Удалить"></a></td>';
                            item.appendChild(add[i]);
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
        }
    };

});