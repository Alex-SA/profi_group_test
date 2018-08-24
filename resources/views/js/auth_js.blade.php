    <script>
// get data from form
        function getData(formId) {
            formId += "";
            let data = {};

            let elements =  document.querySelectorAll(`[id^="${formId + '_'}"]`);
            for (let el of Array.from(elements)) {
                if (el.type === "checkbox" && !el.checked) continue;
                data[el.id.substr(formId.length + 1)] = el.value;
            }
            return data;
        }

        function getAction(formID, userID = ''){
            let data = getData(formID);
            let url = data["url"];
            if (userID) {
                url = url + '/' + data["user_id"];
            }
//            add token to request
            url = url + '/?token=' + localStorage.getItem('token');
            $.ajaxSetup({
                headers: {
                    'Accept': 'application/json',
                },
            });
            $.get(
                url,
                function(data) {
//                    show success results
                    console.log(data);
                    if (data.hasOwnProperty("logout")) {
//            delete user token from LocalStorage
                        localStorage.removeItem('token');
                    }
                })
                .fail(function(data, textStatus, xhr) {
//                    show errors
                    console.log("error", data.status);
                    console.log("STATUS: "+xhr);
                    console.log(data.responseJSON);
                });
        }

        function postAction(formID, captcha) {
            let data = getData(formID);
            let url = data["url"];
//            add token to request
            url = url + '/?token=' + localStorage.getItem('token');
//            add google captcha response to data
            if (captcha) {
                data["g-recaptcha-response"] = $("#" + "g-recaptcha-response").val();
            }
//            send api query
            $.ajaxSetup({
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
            });
            $.post(
                url,
                JSON.stringify(data),
                function(data) {
//                    show success results
                    console.log(data);
                    if (data.hasOwnProperty("token")) {
//            save user token to LocalStorage
                        localStorage.setItem('token', data.token);
                    }
                })
                .fail(function(data, textStatus, xhr) {
//                    show errors
                    console.log("error", data.status);
                    console.log("STATUS: "+xhr);
                    console.log(data.responseJSON);
                });
//            refresh google captcha
            if (captcha) {
                grecaptcha.reset();
            }
        }
    </script>
