var d = document,
    itemBox = d.querySelectorAll('.item_box'), // блок каждого товара
    cartCont = d.getElementById('cart_content'); // блок вывода данных корзины

function getCartData() {
    return JSON.parse(localStorage.getItem('cart'));
}

function openCart() {
    let cartData = getCartData(), // вытаскиваем все данные корзины
        totalItems = '';
    let sum = 0;
    let count = 0;
    console.log(JSON.stringify(cartData));
    // если что-то в корзине уже есть, начинаем формировать данные для вывода
    if (cartData !== null) {
        totalItems = '<table class="shopping_list"><tr><th>Наименование</th><th>Цена</th><th>Кол-во</th></tr>';
        for (let items in cartData) {
            totalItems += '<tr>';
            for (let i = 0; i < cartData[items].length; i++) {
                totalItems += '<td>' + cartData[items][i] + '</td>';
            }
            sum += Number(cartData[items][1]) * Number(cartData[items][2]);
            count += Number(cartData[items][2]);
            totalItems += '</tr>';
        }
        totalItems +='<tr>'+ '<td>'+ 'Итог' +'</td>' + '<td>' + sum + '</td>' +'<td>' + count + '</td>'+'</tr>';
        totalItems += '<table>';
        document.getElementById('wrapper').innerHTML = totalItems;
    } else {
        // если в корзине пусто, то сигнализируем об этом
        document.getElementById('wrapper').innerHTML = 'В корзине пусто!';
    }
    return false;
}

function clear_basket() {
    localStorage.removeItem('cart');
    document.getElementById('wrapper').innerHTML = 'Корзина очищена'
}