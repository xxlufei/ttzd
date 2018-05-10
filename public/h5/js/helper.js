var getParam = function(paramName) {
    var sURL = window.document.URL.toString().replace(/#/, '&');
    if(sURL.indexOf("?") > 0) {
        var arrParams = sURL.split("?");
        var arrURLParams = arrParams[1].split("&");
        var arrParamNames = new Array(arrURLParams.length);
        var arrParamValues = new Array(arrURLParams.length);
        for (var i=0;i<arrURLParams.length;i++) {
            var sParam =  arrURLParams[i].split("=");
            arrParamNames[i] = sParam[0];
            if (sParam[1] != "") {
                arrParamValues[i] = unescape(sParam[1]);
            } else {
                arrParamValues[i] = "";
            }
        }
        for (i=0;i<arrURLParams.length;i++) {
            if(arrParamNames[i] == paramName) {
                return arrParamValues[i] == 'undefined' ? '' : arrParamValues[i] ;
            }
        }
        return '';
    }
    return '';
}
var jsonEncode = function (obj) {
    return JSON.stringify(obj)
};
var jsonDecode = function (obj) {
    return JSON.parse(obj)
};