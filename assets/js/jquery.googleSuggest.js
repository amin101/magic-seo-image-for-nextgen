/**@license
This file uses Google Suggest for jQuery plugin (licensed under GPLv3) by Haochi Chen ( http://ihaochi.com )
 */

var jq = jQuery.noConflict();

jq.fn.googleSuggest = function(opts){
  extra_opts = {
    minLength: 2,
  }
  opts = jq.extend({service: 'web', secure: false}, opts,extra_opts);


  var services = {
    youtube: { client: 'youtube', ds: 'yt' },
    books: { client: 'books', ds: 'bo' },
    products: { client: 'products-cc', ds: 'sh' },
    news: { client: 'news-cc', ds: 'n' },
    images: { client: 'img', ds: 'i' },
    web: { client: 'psy', ds: '' },
    recipes: { client: 'psy', ds: 'r' }
  }, service = services[opts.service];

  opts.source = function(request, response){
    jq.ajax({
      url: 'http'+(opts.secure?'s':'')+'://clients1.google.com/complete/search',
      dataType: 'jsonp',
      data: {
        q: request.term,
        nolabels: 't',
        client: service.client,
        ds: service.ds
      },
      success: function(data) {
        response(jq.map(data[1], function(item){
          return { value: jq("<span>").html(item[0]).text() };
        }));
      }
    });
  };

  return this.each(function(){
    jq(this).autocomplete(opts);
  });
}
