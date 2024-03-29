require('dotenv').config()

const express = require('express')

const app = express()

const ejs = require('ejs')

const path = require('path')

const expressLayout = require('express-ejs-layouts')

const mongoose = require('mongoose')

const flash = require('express-flash')

const session = require('express-session');
const MongoDbStore = require('connect-mongo')

const passport = require('passport')

const Emitter = require('events')

// Database connection mongodb 
const url = 'mongodb://localhost/pizza'

mongoose.connect(url, { useNewUrlParser: true, useUnifiedTopology: true });
const connection = mongoose.connection;
connection.once('open', function() {
    console.log('MongoDB running');
}).on('error', function(err) {
    console.log(err);
});


// session store
let mongoStore = MongoDbStore.create({
    mongoUrl: url,
    dbName: 'pizza',
    collectionName: 'sessions',
});

// Event emitter 
const eventEmitter = new Emitter()
app.set('eventEmitter', eventEmitter)

// session config
app.use(session({
        secret: process.env.COOKIE_SECRET,
        resave: false,
        saveUninitialized: false,
        store: mongoStore,
        cookie: { maxAge: 1000 * 60 * 60 * 24 } // 24 hours
    }))
    // assets

// passport config
const passportInit = require('./app/config/passport')
passportInit(passport)
app.use(passport.initialize())
app.use(passport.session())


app.use(flash())
app.use(express.static('public'))
app.use(express.urlencoded({ extended: false }))
app.use(express.json())


// global middleware 
app.use((req, res, next) => {

        res.locals.session = req.session
        res.locals.user = req.user

        next()

    })
    // set template engine 
app.use(expressLayout)
app.set('views', path.join(__dirname, '/resources/views'))

app.set('view engine', 'ejs')



require('./routes/web')(app)

const PORT = process.env.PORT || 3000

const server = app.listen(PORT, () => {
    console.log(`listening on port ${PORT}`)
})

// socket io
const io = require('socket.io')(server)

io.on('connection', (socket) => {
    // Join 
    console.log('socket   ', socket.id)
    socket.on('join', (orderId) => {
        console.log("order is ", orderId);
        socket.join(orderId)
    })
})

eventEmitter.on('orderUpdated', (data) => {
    io.to(`order_${data.id}`).emit('orderUpdated', data)
})
eventEmitter.on('orderPlaced', (data) => {
    io.to('adminRoom').emit('orderPlaced', data)
})