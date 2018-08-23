    <script>
// get data from form
        function getData(formId) {
            formId += "";
            let data = {};

            let elements =  document.querySelectorAll(`[id^="${formId + '_'}"]`)
            for (let el of Array.from(elements)) {
                if (el.type === "checkbox" && !el.checked) continue;
                data[el.id.substr(formId.length + 1)] = el.value;
            }
            return data;
        }

        function authAction(id) {
            let data = getData(id);
            let url = data["url"];
//            add google captcha response to data
            data["g-recaptcha-response"] = $("#" + "g-recaptcha-response").val();
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
            grecaptcha.reset();
        }
    </script>
