const LocalStrategy = require('passport-local').Strategy
const User = require('../models/user')
const bcrypt = require('bcrypt')

function init(passport) {

    console.log("passport values are ", passport)

    passport.use(new LocalStrategy({ usernameField: 'email' }, async(email, password, done) => {
        // login 
        // check if email exist
        const user = await User.findOne({ email: email })
        console.log("user values are ========== ", user)
        if (!user) {
            return done(null, false, { message: 'No user with this email ' })
        }

        bcrypt.compare(password, user.password).then(match => {
            if (match) {
                return done(null, user, { message: 'logined in successfully ' })
            } else {
                return done(null, false, { message: 'Wrong user or password ' })
            }
        }).catch(err => {
            return done(null, false, { message: 'Something went wrong ' })
        })

    }))

    passport.serializeUser((user, done) => {
        done(null, user._id)
    })

    passport.deserializeUser((id, done) => {
        User.findById(id, (err, user) => {
            done(err, user)
        })
    })

    // req.user
}

module.exports = init