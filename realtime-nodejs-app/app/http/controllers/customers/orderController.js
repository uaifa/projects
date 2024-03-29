const Order = require('../../../models/order')
const moment = require('moment')
const e = require('express')

function orderController() {
    return {
        async index(req, res) {
            const orders = await Order.find({ customRef: req.user._id }, null, { sort: { 'createdAt': -1 } })
            res.render('customers/orders', { orders: orders, moment: moment })
            console.log('orders')
        },
        store(req, res) {
            //  validate request 
            const { phone, address } = req.body
            if (!phone || !address) {
                req.flash('error', 'All fields are required')
                return res.redirect('/cart')
            }

            const order = new Order({
                customerId: req.user._id,
                items: req.session.cart.items,
                phone: phone,
                address: address,
            })
            order.save().then(result => {
                Order.populate(result, { path: 'customerId' }, (err, placeOrder) => {
                    req.flash('success', 'Order placed successfully ')
                    delete req.session.cart
                        // Emit 
                    const eventEmitter = req.app.get('eventEmitter')
                    eventEmitter.emit('orderPlaced', placeOrder)
                    return res.redirect('/customer/orders')

                })

            }).catch(err => {
                req.flash('error', 'Something went wrong')
                return res.redirect('/cart')
            })
            console.log(req.body)
        },
        async show(req, res) {
            const order = await Order.findById(req.params._id)
            console.log("asdfasdfasdfasdfasdfasd ", order);
            // authorize user
            if (order && req.user._id.toString() === order.customerId.toString()) {
                return res.render('customers/singleOrder', { order: order })
            }

            return res.redirect('/')

        }
    }
}

module.exports = orderController