function createXMLHttp() {    if (typeof XMLHttpRequest != "undefined") { // для браузеров аля Mozilla        return new XMLHttpRequest();    } else if (window.ActiveXObject) { // для Internet Explorer (all versions)         var aVersions = [        "MSXML2.XMLHttp.5.0",        "MSXML2.XMLHttp.4.0",        "MSXML2.XMLHttp.3.0",        "MSXML2.XMLHttp",        "Microsoft.XMLHttp"        ];        for (var i = 0; i < aVersions.length; i++) {            try {                var oXmlHttp = new ActiveXObject(aVersions[i]);                return oXmlHttp;            } catch (oError) {}        }        throw new Error("Невозможно создать объект XMLHttp.");    }}function getAjax(url, callback) { // функция Ajax GET    // создаем Объект    var oXmlHttp = createXMLHttp();    // подготовка, объявление заголовков    oXmlHttp.open("GET", url, true);    oXmlHttp.setRequestHeader("Content-Type", "text/html; charset=utf-8");    // описание функции, которая будет вызвана, когда придет ответ от сервера    oXmlHttp.onreadystatechange = function() {      if (oXmlHttp.readyState == 4) {       if (oXmlHttp.status == 200) {        if (callback) callback(oXmlHttp.responseText);    } else {        if (callback) callback(oXmlHttp.statusText);    }}}	// отправка запроса    oXmlHttp.send(null);}var letterArr = ['а','б','в','г','д','е','ж','з','и','к','л','м','н','о','п','р','с','т','у','ф','ц','ч','ш','щ','э','ю','я'];        // масив букв    function showLetterArr(){ //формируем вывод алфовита        $.each(letterArr, function(field, value) {            $('#letterArry').append('<li><a href=# class=letterIn id = ' + value + '>' + value + '</a><br></li>');         });    }    function showResult(d) { //обробатываем ответ по авторам        data = JSON.parse(d);        msg_info = data.msg_info;        status = data.status;        if (status == 'Success') {            $.each(msg_info, function(key, object) {                var autorName = null;                var autorKey = null;                var triger = false;                $.each(object, function(field, value) {                    if (field == 'autor_id'){                        autorKey = value;                        triger = false;                    } else {                        autorName = value;                        triger = true;                    }                    if (triger == true){                        $('#listAutor').append('<li><a href=# class=autorLink id = ' + autorKey + '>' + autorName + '</a><br></li>');                     }                });            });        } else {            alert(status);            $('#listAutor').append('Fail');        }    }    function showResultAutor(d) { //обробатывает ответ по книгам        data = JSON.parse(d);        msg_info = data.msg_info;        status = data.status;        if (status == 'Success') {            $.each(msg_info, function(key, object) {                var autorName = null;                var autorKey = null;                var triger = false;                $.each(object, function(field, value) {                    if (field == 'book_id'){                        autorKey = value;                        triger = false;                    } else {                        autorName = value;                        triger = true;                    }                    if (triger == true){                        $('#listBook').append('<li><a href=# class=bookLink id = ' + autorKey + '>' + autorName + '</a><br></li>');                     }                });            });        } else {            alert(status);            $('#listBook').append('Fail');        }    }