/* 
 * Util Class
 */
var Util = {};

Util.unload = function () {
    $('#innterContent').find('a.main-click').unbind();
    $('#innterContent').html('');
};

Util.init = function ($ob) {
    $ob.find('a.main-click').click(function (e) {
        e.preventDefault();
        var href = $(this).attr("href");
        Util.load(href);
    });
    $ob.find("abbr.timeago").timeago();
};

/* Downloads and renders the passed url dand passes any params if required
 */
Util.load = function (url, params) {
    if (params === null || params === undefined) {
        params = {};
    }
    
    if ($.isEmptyObject(params)) {
        $.get(url, params, function (data) {
            var jsonOb = Util.process(data);

            if (jsonOb.redirect !== undefined) {
                Util.load(jsonOb.redirect);
            } else {
                Util.unload();
                $('#innterContent').html(jsonOb.data);
                Util.init($('#innterContent'));
                History.pushState(null, null, url);
                $(this).scrollTop(0);
            }
        }, 'text');
    } else {
        /**
         * @todo Implement CSRF
         */
        $.post(url, params, function (data) {
            var jsonOb = Util.process(data);

            if (jsonOb.redirect !== undefined) {
                Util.load(jsonOb.redirect);
            } else {
                Util.unload();
                $('#innterContent').html(jsonOb.data);
                Util.init($('#innterContent'));
                History.pushState(null, null, url);
                $(this).scrollTop(0);
            }
        }, 'text');
    }
};

/* Parses data passed as JSON and returns a object while handling any errors that occor */
Util.process = function (data) {
    var json = {};
    try {
        json = jQuery.parseJSON(data);
        if (json.notifications !== undefined) {
            $.each(json.notifications, function (ix, ob) {
                //Util.notify(ob.type, ob.title, ob.message);
            });
            return json.notifications[0].data;
        }
    } catch (e) {
        json = { data: data+'' };
    }

    return json;
};
