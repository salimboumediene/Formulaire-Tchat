(function () {

    var messagesList = window.document.getElementById("messages");
    var textarea = window.document.getElementById("textarea").getElementsByTagName("textarea")[0];
    var post = function (message) {
//        var xhr = new XMLHttpRequest;
//        xhr.open("GET", "http://localhost/formation-php/web/api/channel?id=24");
//        xhr.onload = xhr.onabort = xhr.onerror = function () {
//            console.log("?");
//            console.log(this.response);    
//        }
//        xhr.setRequestHeader("Accept", "application/json");
//        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//        xhr.send("message=barrr");
    }

    textarea.onkeypress = function (e) {
      if (13 === e.keyCode) {
          post(this.value);
      }
    };
    
    
}());