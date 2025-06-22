// cart.js - Funciones para manejar el carrito con AJAX

function addToCart(producto) {
    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(producto)
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            location.reload();
        }
    });
}

function updateCartItem(id, cantidad) {
    fetch('/cart/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({id, cantidad})
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            location.reload();
        }
    });
}

function removeCartItem(id) {
    fetch('/cart/remove', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({id})
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            location.reload();
        }
    });
}

function clearCart() {
    fetch('/cart/clear', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            location.reload();
        }
    });
}
