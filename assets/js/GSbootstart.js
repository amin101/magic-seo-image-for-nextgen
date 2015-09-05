
var j = jQuery.noConflict();

//j.each("web youtube recipe products news images books".split(" "), function(i, v){
//    var div = j("<div>").appendTo(".custom-alt-input")
//        , input = j("<input>").appendTo(div)
//        , span = j("<label>").text(v).appendTo(div);
//    input.googleSuggest({ service: v });
//});

  j(".custom-alt-input input").googleSuggest({ service: 'web' });

