let cart = JSON.parse(localStorage.getItem('cart'));

const prodCont = document.querySelector('.the_cart tbody');
const totalPrice = document.querySelector('.fees');
const productNum = document.querySelector('.items');

displayData()


function displayData() {
    let elements = '' ;
cart.forEach((prod) => {
    elements += `
    <tr class="cart-product"  data-id="${prod.id}">
<td>
<div class="d-flex gap-3 align-items-center">
<img class="cart-product-image" src=${prod.thumbnail}>
<h5>${prod.title}</h5>
</div>
</td>

<td>
<div class="cart-product-amount">
    <span class="change-amount change-amount-icr">+</span>
    <span class="qua">${prod.quantity}</span>
    <span class="change-amount change-amount-dec">-</span>
</div>
</td>

<td>
    <div class="mb-2 d-flex text-end justify-content-end align-items-end">
<span class="cart-product-price">${prod.price} EGP</span>
<span class="remover"> Remove </span>
    </div>
</td>
    </tr>
    
    
    `
});

prodCont.innerHTML = elements ;
calcTotal();
addEventsToBtns() ;
}

function addEventsToBtns() {
const increaseBtns = document.querySelectorAll('.change-amount-icr');
const decreaseBtns = document.querySelectorAll('.change-amount-dec');
const removeBtns = document.querySelectorAll('.remover');
const removeAll = document.querySelector('.all-remove');


increaseBtns.forEach(btn => {
    btn.addEventListener('click', ()=> {
        const parent = btn.closest('.cart-product');
        const id = parent.dataset.id;

        const prodObj = cart.find(prod => prod.id == id);
        prodObj.quantity++;


        const quantityObj = parent.querySelector('.qua')
        quantityObj.textContent = prodObj.quantity;
        localStorage.setItem('cart', JSON.stringify(cart));
        calcTotal();
    })
})


decreaseBtns.forEach(btn => {
    btn.addEventListener('click', ()=> {
        const parent = btn.closest('.cart-product');
        const id = parent.dataset.id;

        const prodObj = cart.find(prod => prod.id == id);
        if(prodObj.quantity == 1) return ;

        prodObj.quantity--;


        const quantityObj = parent.querySelector('.qua')
        quantityObj.textContent = prodObj.quantity;
        localStorage.setItem('cart', JSON.stringify(cart))
        calcTotal();
    })
})

removeBtns.forEach(btn => {
    btn.addEventListener('click', ()=> {
        const parent = btn.closest('.cart-product');
        const id = parent.dataset.id;

    cart = cart.filter(prod => prod.id != id)
     parent.remove() ;

    localStorage.setItem('cart', JSON.stringify(cart))
    calcTotal();
    })
})


removeAll.addEventListener('click', () => {
    cart = [];
    prodCont.innerHTML = '<h1 class="text-center fw-bolder">No products yet!</h1>' ;
    localStorage.setItem('cart', JSON.stringify(cart))
    calcTotal();
})

}

function calcTotal() {
let total = cart.reduce((acc, prod) => {
    return acc + (+prod.price * prod.quantity);
} , 0)

totalPrice.textContent = total + 'EGP';
productNum.textContent = cart.length ;

}

let popupCheck = document.getElementById('popupCheckout');
function openPopupCheck() {
    popupCheck.classList.add("open-popup");
}
function closePopupCheck() {
    popupCheck.classList.remove("open-popup");
}
function backToShopping() {
    window.location.href = "/shop.html";
  }