
 for vue version 2 = vue-loader:^15.9.8

mix.js('resources/js/app.js', 'public/js').vue({version:2})
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

*
for jwt auth
in composer.json @          "tymon/jwt-auth": "dev-develop"


