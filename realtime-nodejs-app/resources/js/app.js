import axios from 'axios'
import { json } from 'body-parser'
import Noty from 'noty'

import { initAdmin } from './admin'
import moment from 'moment'

let addToCart = document.querySelectorAll('.add-to-cart')
let cartCounter = document.querySelector('#cart_counter')

function updateCart(pizza) {
    // add ajax call 
    axios.post('/update-cart', pizza).then(res => {
        cartCounter.innerText = res.data.totalQty

        new Noty({
            type: 'success',
            timeout: 1000,
            text: 'Notification text',
            progressBar: false,
            // layout: 'bottomLeft'
        }).show();
    }).catch(err => {
        console.log('err')
        new Noty({
            type: 'error',
            timeout: 1000,
            text: 'Something went wrong ',
            progressBar: false,
            // layout: 'bottomLeft'
        }).show();
    })

}

addToCart.forEach((btn) => {
    btn.addEventListener('click', (e) => {
        let pizza = JSON.parse(btn.dataset.pizza)

        updateCart(pizza)
    })
})

// Remove alert message after X second 
const alertMsg = document.querySelector('#success-alert')
if (alertMsg) {
    setTimeout(() => {
        alertMsg.remove()
    }, 2000)
}




// Change order status
let statuses = document.querySelectorAll('.status_line')
let hiddenInput = document.querySelector('#hiddenInput')
let order = hiddenInput ? hiddenInput.value : null
order = JSON.parse(order)
let time = document.createElement('small')



function updateStatus(order) {
    statuses.forEach((status) => {
        status.classList.remove('step-completed')
        status.classList.remove('current')
    })
    let stepCompleted = true;
    statuses.forEach((status) => {
        let dataProp = status.dataset.status
        if (stepCompleted) {
            status.classList.add('step-completed')
        }
        if (dataProp === order.status) {
            stepCompleted = false
            time.innerText = moment(order.updatedAt).format('hh:mm A')
            status.appendChild(time)
            console.log('items values are ', time);
            if (status.nextElementSibling) {
                status.nextElementSibling.classList.add('current')
            }
        }
    })

}

updateStatus(order);

// Socket
let socket = io()

initAdmin(socket)
    // Join
if (order) {
    socket.emit('join', `order_${order._id}`)
}
//
let adminAreaPath = window.location.pathname
if (adminAreaPath.includes('admin')) {
    socket.emit('join', 'adminRoom')
}
console.log(adminAreaPath)

socket.on('orderUpdated', (data) => {
    const updatedOrder = {...order }
    updatedOrder.updatedAt = moment().format()
    updatedOrder.status = data.status
    updateStatus(updatedOrder)

    new Noty({
        type: 'success',
        timeout: 1000,
        text: 'Order Updated ',
        progressBar: false,
    }).show();
})