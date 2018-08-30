// simple check online for tests
let isToken = localStorage.getItem('token');
if (isToken) {
    document.getElementById("is_valid_token").style.display = 'inline';
}

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
//            add token to request
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
        },
    });
    $.get(
        url,
        function(data) {
//                    show success results
            console.log(data);
            showResults(data, '');
        })
        .fail(function(data, textStatus, xhr) {
//                    show errors
            console.log("error", data.status);
            console.log("STATUS: "+xhr);
            console.log(data.responseJSON);
            showResults('', data.responseJSON.error);
        });

    if (formID == 'logout') {
//            delete user token from LocalStorage
        localStorage.removeItem('token');
        document.getElementById("is_valid_token").style.display = 'none';
    }
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
//            add token to request
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
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
                document.getElementById("is_valid_token").style.display = 'inline';
                showPostResult('Authorization was successful.', '')
            } else {
                showPostResult('A new record was added.', '')
            }
        })
        .fail(function(data, textStatus, xhr) {
//                    show errors
            console.log("error", data.status);
            console.log("STATUS: "+xhr);
            console.log(data.responseJSON);
            showPostResult('', data.responseJSON)
        });
//            refresh google captcha
    if (captcha) {
        grecaptcha.reset();
    }
}

function getAPITokenForSocialClient(url, tokenFromSocial){
    console.log('---------- From backend -----------');
    $.ajaxSetup({
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
    });
    $.post(
        url,
        JSON.stringify({token: tokenFromSocial}),
        function(data) {
            console.log(data);
            if (data.hasOwnProperty("token")) {
//            save user token to LocalStorage (token from backend)
                localStorage.setItem('token', data.token);
            }
        })
        .fail(function(data, textStatus, xhr) {
            console.log("error", data.status);
            console.log("STATUS: "+xhr);
            console.log(data.responseJSON);
        });
}

// show bets and tournaments
function showResults(response, error) {
    if (error !== '') {
        // show errors
        document.getElementById('show_results').innerHTML = '<h4 style="color: red">ERROR: ' + error +'</h4>';
        return;
    }
    if (typeof response.data === 'undefined'  || response.data.length < 1){
        document.getElementById('show_results').innerHTML = '';
        return;
    }
    let cols = [];
    let resTable = '<h3>Results:</h3><table class="table table-bordered"><thead><tr>';
    let item = response.data[0];
    for (let k of Object.keys(item)) {
        // show table header
        if (typeof(item[k]) !== "object"){
            resTable += '<th scope="col">' + k + '</th>';
            cols.push(k);
        }
    }
    resTable += '</tr></thead><tbody>';
    for (let item of response.data) {
        // show table content
        resTable += '<tr>';
        for (let c of cols) {
            let relationName = '';
            let relation = c.replace(/_id$/, "");
            // related tables: add name
            if (relation !== c){
                if (typeof relation.name !== 'undefined'){
                    relationName = ' (' + relation.name + ')';
                } else if (typeof item[relation] !== 'undefined'){
                    relationName = ' (' + item[relation].name + ')';
                }
            }
            resTable += '<td>' + item[c] + relationName + '</td>'
        }
        resTable += '</tr>';
    }
    resTable += '</tbody></table>';
    document.getElementById('show_results').innerHTML = resTable;
}

function showPostResult(response, errors) {
    if (typeof errors === 'object' && errors !== null) {
        // show errors
        let errorMessage = '';
        for (let k of Object.keys(errors)) {
            errorMessage += '<li>' + errors[k] + '</li>';
        }
        document.getElementById('post_result').innerHTML = '<h4 style="color: red">ERRORS:<br>' + errorMessage +'</h4>';
        return;
    }
    if (response !== '') {
        document.getElementById('post_result').innerHTML = '<h4 style="color: green">' + response +'</h4>';
        return;
    }
}
