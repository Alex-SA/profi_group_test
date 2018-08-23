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
