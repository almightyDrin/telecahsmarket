const GeneralScriptLevel = function () {

    const registration7bet = () => {
        $('#telesales7betReg').submit(function(e) {
            e.preventDefault();
            let form = $(this);
            let objForm = form.serialize();
            // console.log(objForm);
            $.post('./telesales/register/7bet', objForm, (obj, xhrStatus) => {
                console.log(obj);
                if ( ! obj.success ) {
                    // console.log(obj.errors);
                    for (const key in obj.errors) {
                        if (obj.errors.hasOwnProperty(key)) {
                            const err = obj.errors[key];
                            let el = document.querySelector('.'+key+'-control');
                            if ( err !== "" ) el.classList.add('invalid');
                        }
                    }
                    if ( obj.errors.telesales !== "" ){
                        alert('Please Contact a Telesale Regarding your Registration, Thank you!');
                    }
                }else{
                    $(form).slideUp();
                    $('.form-title').text('Registration Successfull!');
                    popupToggle('show');
                    registerInLC(obj.success);
                }
            }, "json");
        });
    },
    registrationLigajudi = () => {
        $('#telesalesLigajudiReg').submit(function(e) {
            e.preventDefault();
            let form = $(this);
            let objForm = form.serialize();
            // console.log(objForm);
            $.post('./telesales/register/ligajudi', objForm, (obj, xhrStatus) => {
                console.log(obj);
                if ( ! obj.success ) {
                    // console.log(obj.errors);
                    for (const key in obj.errors) {
                        if (obj.errors.hasOwnProperty(key)) {
                            const err = obj.errors[key];
                            let el = document.querySelector('.'+key+'-control');
                            if ( err !== "" ) el.classList.add('invalid');
                        }
                    }
                    if ( obj.errors.telesales !== "" ){
                        alert('Please Contact a Telesale Regarding your Registration, Thank you!');
                    }
                }else{
                    $(form).slideUp();
                    $('.form-title').text('Registration Successfull!');
                    popupToggle('show');
                    registerInLC(obj.success);
                }
            }, "json");
        });
    },
    registerInLC = (obj) => {
        // LC_API.set_visitor_name(obj.full_name);
        // LC_API.set_visitor_email(obj.email);

        msg = "[Register] \r\n";
        msg += "- Nama Lengkap: " + obj.full_name + "\r\n";
        msg += "- Tanggal Lahir: " + obj.date_of_birth + "\r\n";
        msg += "- Email: " + obj.email + "\r\n";
        msg += "- No HP: " + obj.contact_num + "\r\n";

        // LC_API.start_chat(msg);
        console.log(msg);
    },
    getTelesalesCode = () => {

        /* Demo Users */
        let users_7bet = ['telesales_user', 'telesales_user5', '7bet_telesale_aldrin'];
        let users_ligajudi = ['telesales_user2', 'telesales_user3', 'telesales_user4', 'ligajudi_telesale_aldrin'];
        let curr_url = window.location.href.split('/');
        let curr_user;
        if ( curr_url[curr_url.length-1] === "7bet" ){
            curr_user = users_7bet[Math.floor(Math.random() * users_7bet.length)];
        }else{
            curr_user = users_ligajudi[Math.floor(Math.random() * users_ligajudi.length)];
        }
        /* End Demo */

        // let curr_user = users[Math.floor(Math.random() * users.length)];//window.location.href.split('/')[2];
        $.get('./code', (obj, xhrStatus) => {
            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'user_code';
            input.setAttribute( 'class', 'telesales-control' );
            for (const data of obj) {
                // console.table(data);
                if ( data.username === curr_user ) {
                    if ( data.user_code !== "" ) {
                        input.value = data.username;
                        input.setAttribute( 'data-usercode', data.user_code );
                    }
                }
            }
            document.forms[0].appendChild(input);
        }, "json");
    },
    adminRegister = () => {
        $('#adminRegister').submit(function(e) {
            e.preventDefault();
            let form = $(this);
            let objForm = form.serialize();
            // console.log(objForm);
            $('.show-message-group').empty();
            $.post('./cms_admin/store_user', objForm, (data, xhrStatus) => {
                if ( ! data.success ) {
                    for (const key in data.errors) {
                        if (data.errors.hasOwnProperty(key)) {
                            const err = data.errors[key];
                            if ( err !== "" ) {
                                $('.show-message-group').append('<li class="list-group-item list-group-item-danger">'+err+"</li>");
                            }
                        }
                    }
                }else {
                    $('.show-message-group').append('<li class="list-group-item list-group-item-success">'+data.success+"</li>");
                    $(form).slideUp();
                    $('#register-heading').text('Great!, You can Login to your account now.')
                }
            }, "json");
        });
    },
    adminLogin = () => {
        $('#adminLogin').submit(function(e) {
            e.preventDefault();
            let form = $(this);
            let objForm = form.serialize();
            $('.show-message').empty();
            $.post('./auth', objForm, (data, xhrStatus) => {
                console.log(data);
                if ( ! data.success ) {
                    $('.show-message').append('<span class="text-danger"><small><i>Login Credentials is Incorrect.</i></small></span><br />');
                }else {
                    console.log(data.success);
                    window.location.replace("./cms_admin/admin");
                }
            }, "json");
        });
    },
    modalRemote = () => {
        $('body').on('click', '[data-toggle="modal"]', (e) => {
            e.preventDefault();
            // console.log(e.target.dataset);
            $(e.target.dataset.target+ ' .modal-body').load(e.target.href);
        });
    },
    popupToggle = function (hideOrshow) {
        if (hideOrshow == "hide") {
            document.getElementById('popup_content_wrap').style.display = "none";
        }else{
            document.getElementById('popup_content_wrap').removeAttribute('style');
            document.getElementsByTagName('body')[0].style.overflow = "hidden";
        }
    }

    return {
        init: function () {
            registration7bet(),
            registrationLigajudi(),
            getTelesalesCode(),
            modalRemote(),
            adminRegister(),
            adminLogin()
        }
    }

}();



jQuery(function($){
    GeneralScriptLevel.init();
});