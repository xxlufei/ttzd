(function(zd) {
    zd.store = {};//localStorage
    zd.cookie = {};//localStorage
    zd.sessStore = {};//sessionStorage
    var prefixLo = 'loc_'; 
    var prefixSe = 'sloc_'; 
    window.local_ok = true;
    if (!window.localStorage || !window.sessionStorage ) {
        window.local_ok = false;
    }else{
        try {
            localStorage.setItem('localStorageTest', '1');
            localStorage.removeItem('localStorageTest');
        } catch (e) {
            window.local_ok = false;
        }
    }
    zd.cookie.set = function (name,value,time) { 
        var Days = 30; 
        var exp = new Date(); 
        var expTime = !time ? Days*24*60*60*1000 : time*1000; 
        exp.setTime(exp.getTime() + expTime); 
        document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString(); 
    } 

    zd.cookie.get = function (name) { 
        var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");

        if(arr=document.cookie.match(reg))

            return unescape(arr[2]); 
        else 
            return null; 
    } 

    zd.cookie.del = function delCookie(name) { 
        var exp = new Date(); 
        exp.setTime(exp.getTime() - 1); 
        var cval=zd.cookie.get(name); 
        if(cval!=null) 
            document.cookie= name + "="+cval+";expires="+exp.toGMTString(); 
    } 

    local_Storage = {
        'setItem':function(key,val) {
            if (window.local_ok) {
                localStorage.setItem(key,val);
            } else {
                zd.cookie.set(prefixLo + key,val);
            }
        },
        'getItem':function(key){
            if (window.local_ok) {
                return localStorage.getItem(key);
            } else {
                return zd.cookie.get(prefixLo + key);
            }
        },
        'removeItem':function(key){
            if (window.local_ok) {
                localStorage.removeItem(key);
            } else {
                zd.cookie.del(prefixLo + key);
            }
        },
        'clear':function(){
            if (window.local_ok) {
                localStorage.clear();
            } else {
                var aCookie = document.cookie.split(";");  
                var re = '';  
                for (var i = 0; i < aCookie.length; i++) {  
                    var aCrumb = aCookie[i].split("=");
                    if ($.trim(aCrumb[0]).indexOf(prefixLo) === 0) {
                        zd.cookie.del($.trim(aCrumb[0]));
                    }
                }
            }
        }
    }

    session_Storage = {
        'setItem':function(key,val) {
            if (window.local_ok) {
                sessionStorage.setItem(key,val);
            } else {
                zd.cookie.set(prefixSe + key,val);
            }
        },
        'getItem':function(key){
            if (window.local_ok) {
                return sessionStorage.getItem(key);
            } else {
                return zd.cookie.get(prefixSe + key);
            }
        },
        'removeItem':function(key){
            if (window.local_ok) {
                sessionStorage.removeItem(key);
            } else {
                delCookie(prefixSe + key);
            }
        },
        'clear':function(){
            if (window.local_ok) {
                sessionStorage.clear();
            } else {
                var aCookie = document.cookie.split(";");  
                var re = '';  
                for (var i = 0; i < aCookie.length; i++) {  
                    var aCrumb = aCookie[i].split("=");
                    if ($.trim(aCrumb[0]).indexOf(prefixSe) === 0) {
                        zd.cookie.del($.trim(aCrumb[0]));
                    }
                }
            }
        }
    }

    if (window.applicationCache) {
        zd.store.cache = window.applicationCache;
    }

    zd.store.set = function(key, val, noversion,cacheTime) {
        if (!noversion) key = JSVERSION+key;
        if (cacheTime) {
            var cacheTime_old = parseInt(local_Storage.getItem(key + '_ct'));
            if (!isNaN(cacheTime_old) && cacheTime_old > 0 && cacheTime_old < Date.parse(new Date())/1000) {
                local_Storage.setItem(key + '_ct', Date.parse(new Date())/1000 + parseInt(cacheTime)  );
            } 
        } 
        if(typeof(val) == 'object') {
            local_Storage.setItem(key, JSON.stringify(val));
        } else {
            local_Storage.setItem(key, val);
        }
    }

    zd.store.clear = function() {  local_Storage.clear(); }

    zd.store.get = function(key, noversion) {
        if (!noversion) key = JSVERSION+key;
        var cacheTime = parseInt(local_Storage.getItem(key + '_ct'));
        if (!isNaN(cacheTime) && cacheTime > 0 && cacheTime < Date.parse(new Date())/1000) {
            local_Storage.removeItem(key);
            local_Storage.removeItem(key + '_ct');
            return false;
        } 
        var val = local_Storage.getItem(key);
        if(!val) return false;
        if(val.indexOf('{') == 0 || val.indexOf('[') == 0) val = JSON.parse(val);
        return(val);
    }

    zd.sessStore.clear = function() {  session_Storage.clear(); }
    zd.sessStore.set = function(key,val) {
        if(typeof(val) == 'object') {
            session_Storage.setItem(key, JSON.stringify(val));
        } else {
            session_Storage.setItem(key, val);
        }
    }
    zd.sessStore.get = function(key) {
        var val = session_Storage.getItem(key);
        if(!val) return false;
        if(val.indexOf('{') == 0 || val.indexOf('[') == 0) val = JSON.parse(val);
        return(val);
    }
})(ttzd);
