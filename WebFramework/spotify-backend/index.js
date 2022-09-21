const express = require("express");
const randomstring = require("randomstring");
const querystring = require("node:querystring");
const app = express();
const request = require("request");
require("dotenv").config();

const redirect_uri = process.env.APP_HOST + '/callback';
const client_id = process.env.CLIENT_ID;
const client_secret = process.env.CLIENT_SECRET;

app.get('/login', function(req, res) {

    var state = randomstring.generate(16);
    var scope = 'user-read-private user-read-email';

    /// {param1:"val1",param2:"val2",param3:"val3" } ----> param1=val1&param2=val2...

    res.redirect('https://accounts.spotify.com/authorize?' +
        querystring.stringify({
            response_type: 'code',
            client_id: client_id,
            scope: scope,
            redirect_uri: redirect_uri,
            state: state
        }));
});

app.get("/callback", function(req, res) {
    const code = req.query.code || null;
    const state = req.query.state || null;

    if (state === null) {
        res.redirect('/#' +
            querystring.stringify({
                error: 'state_mismatch'
            }));
    } else {
        // Buffer.from(client_id + ':' + client_secret).toString('base64');
        const authOptions = {
            url: 'https://accounts.spotify.com/api/token',
            form: {
                code: code,
                redirect_uri: redirect_uri,
                grant_type: 'authorization_code'
            },
            headers: {
                'Authorization': 'Basic ' + (Buffer.from(client_id + ':' + client_secret).toString('base64'))
            },
            json: true
        };
        request.post(authOptions, function(error, response, body) {
            if (!error && response.statusCode === 200) {
                const access_token = body.access_token;
                res.redirect(process.env.APP_FRONT_HOST + "/?token=" + access_token);
            }
        });
    }
})

app.listen(5000, () => {
    console.log("App is runnign on port 5000")
})