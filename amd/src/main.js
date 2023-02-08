define(['local_miguelplugin/alert'], function(customalert){
    return{
        init: function(params){
            console.log('username es: ' + params.username);
            console.log(params);
            customalert.showalert();
        },
        last: 'ultimo'
    }
});