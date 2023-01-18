(
    function(){
        'use strict';
        const app = angular.module("ng-app",[]);
        app.controller("mainpage",mainpage)


        function mainpage(){
            const mp = this;
            mp.email = "";
            mp.password = "";
            mp.name = "";

            mp.submit = function(){
                mp.email && mp.password && mp.name && function(){
                    console.log(mp.email,mp.password,mp.name)
                }()
            }
            
            
        }

















    }
)()