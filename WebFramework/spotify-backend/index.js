const express = require("express");
const randomstring = require("randomstring");
const querystring = require("node:querystring");
const app = express();
const request = require("request");

const redirect_uri = 'http://localhost:5000/callback';
const client_id = "e6367f36d485480994f94090e941ad9f";
const client_secret = "4977d96e6a2a4028a1625665c15c22cd";

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
        const authOptions = {
            url: 'https://accounts.spotify.com/api/token',
            form: {
                code: code,
                redirect_uri: redirect_uri,
                grant_type: 'authorization_code'
            },
            headers: {
                'Authorization': 'Basic ' + (new Buffer(client_id + ':' + client_secret).toString('base64'))
            },
            json: true
        };
        request.post(authOptions, function(error, response, body) {
            if (!error && response.statusCode === 200) {
                const access_token = body.access_token;
                res.redirect("http://localhost:3000/?token=" + access_token);
            }
        });
    }
})

app.listen(5000, () => {
    console.log("App is runnign on port 5000")
})