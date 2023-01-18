(
    function(){
        'use strict';
        const app = angular.module("ng-app",[]);
        app.controller("mainpage",mainpage)

        mainpage.$injecct = ["$http"]
        function mainpage($http){
            const mp = this;
            mp.email = "";
            mp.password = "";
            mp.name = "";

            mp.submit = function(){
                mp.email && mp.password && mp.name && add2DB($http)
            }
            function add2DB(http){
                http({
                    method:'POST',
                    url:'http://localhost/Php_login_signup_app/server/',
                    headers:{
                        "Content-Type":"application/json"
                    },
                    data: {
                        email : mp.email,
                        password : mp.password,
                        name : mp.name,
                    },
                    transformResponse: [
                        function (data) { 
                            return data; 
                        }
                    ]
                }).then(function (res) {
                    console.log(res)
                    console.log(JSON.parse(res.data)["id"])
                    res["status"] == 200 && (window.location.href ="/web/login.html")
                }).catch(err=>console.log(err))
            }
        }
    }
)()