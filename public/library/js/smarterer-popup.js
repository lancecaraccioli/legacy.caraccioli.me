// the function is already defined
(function($){
    if (!window.smrt_widget_loader) {
        window.smrt_widget_loader = function() {
    //IE compaitibility ClassName selector w/out jquery
            if (document.getElementsByClassName === undefined) {
                document.getElementsByClassName = function(className)
                {
                    var hasClassName = new RegExp("(?:^|\\s)" + className + "(?:$|\\s)");
                    var allElements = document.getElementsByTagName("*");
                    var results = [];
                    var element;
                    for (var i = 0, j = allElements.length; i<j; i++) {
                        var element = allElements[i];
                        var elementClass = element.className;
                        if (elementClass && elementClass.indexOf(className) != -1 && hasClassName.test(elementClass)) {
                            results.push(element);
                        }
                    }
                    return results;
                };
            }
    // cross browser event binding w/out jquery
            var bindEvent = function(elem, evt, cb) {
                if ( elem.addEventListener ) {
                    elem.addEventListener(evt, cb, false);
                } else if ( elem.attachEvent ) {
                    elem.attachEvent('on' + evt, function(event){
                        cb.call(elem, event);
                    });
                }
            };
    //init
    // Setup styles for the lightbox
            (function () {
                var head = document.getElementsByTagName('head')[0];
                var st = document.createElement('style');
                st.type="text/css";
                var lb_width = "800px";
                var lb_height = "90%";
                rules = document.createTextNode(
                    ".smarterer_test_lightbox { position: fixed; top: 0; left: 0; height: 100%; width: 100%; z-index: 100000;}" +
                        ".smarterer_test_block { position: fixed; top: 0; left: 0; height: 100%; width: 100%; background: #000; opacity: 0.5; filter: alpha(opacity = 50);}" +
                        ".smarterer_test_containerbox { position: absolute; z-index: 10000; width:" + lb_width + "; height:" + lb_height + "; left: 50%; top: 5%; margin-left: -400px }" +
                        ".smarterer_test_lightbox iframe { -webkit-box-shadow: 7px 7px 5px rgba(50, 50, 50, 0.5); -moz-box-shadow: 7px 7px 5px rgba(50, 50, 50, 0.5); box-shadow: 7px 7px 5px rgba(50, 50, 50, 0.5); }" +
                        "#smarterer_test_lightbox_close { cursor:pointer; position: absolute; z-index: 110000; top: 5%; left:50%; margin-left: 355px; background: #000; opacity:0; filter:Alpha(Opacity=0); height: 40px; width: 40px}"
                );
                if(st.styleSheet)
                    st.styleSheet.cssText = rules.nodeValue;
                else
                    st.appendChild(rules);
                head.appendChild(st);
            })();

            function create_popup(url, link_obj) {

                var url_parts = url.split("/");
                var home_base = url_parts.slice(0, 3).join("/");
                var param_parts = url.split("?");
                var beforeParams = param_parts.slice(0, 1);
                var params = url.split("?").slice(1);
                var arrParams = params.join("?").split("&");

                var quiz_url_slug = "";
                if(url_parts.slice(3, 4) == "test") {
                    quiz_url_slug = url_parts.slice(4,5).join().split("?").slice(0, 1);
                }

                // Better way to add embed querystring into all places?
                // Begin hack
                var found = false;
                for (i = 0; i < arrParams.length; i++) {
                    var param = arrParams[i];
                    if (param.indexOf("embed") === 0) {
                        found = true;
                    } else if(param.indexOf("next") != -1) {
                        if(param.indexOf("embed") == -1) {
                            if(param.indexOf("?") == -1) {
                                param = param + encodeURIComponent("&embed=true");
                            } else {
                                param = param + encodeURIComponent("?embed=true");
                            }
                            arrParams[i] = param;
                            url = beforeParams + "?" + arrParams.join("&");
                        }
                    }
                }
                if(!found) {
                    if(params.length >= 1) {
                        url = url + "&embed=true";
                    } else {
                        url = url + "?embed=true";
                    }
                }
                // End hack

                var body = document.getElementsByTagName('body')[0];

                var lb = document.createElement('div');
                lb.className="smarterer_test_lightbox";

                var tb = document.createElement('div');
                tb.className="smarterer_test_containerbox";

                var close_box = document.createElement('div');
                close_box.id = "smarterer_test_lightbox_close";

                var bb = document.createElement('div');
                bb.className="smarterer_test_block";

                var m = document.createElement("div");

                // m.id = "active_smarterer_test";
                // m.scrolling = "no";
                m.frameBorder = "0";
                m.allowTransparency = "true";
                m.backgroundColor = "transparent";
                m.height = "100%";
                m.width = "100%";
                //m.src="//smarterer.com/widgets/test?embed_url="+encodeURIComponent(url);
                $.ajax({
                    url:"//smarterer.com/widgets/test",
                    data:{embed_url:encodeURIComponent(url)},
                    crossDomain:true,
                    dataType:'jsonp text',
                    fail:function(){
                        console.debug('error',arguments);
                    },
                    dataFilter:function(){
                        console.debug('dataFilter', arguments);
                        return 'foo';
                    },
                    done:function(data, textStatus, jqXHR){
                        console.debug('success', arguments);
                        //$(m).html(data);
                    }
                });

                lb.appendChild(bb);
                lb.appendChild(tb);
                tb.appendChild(m);
                lb.appendChild(close_box);
                body.appendChild(lb);

                // bind an event to remove the lightbox
                bindEvent(close_box, "click", function(e) {
                    // take the close_box handle and destroy the lightbox
                    this.parentNode.parentNode.removeChild(this.parentNode);

                    // call the close callback function
                    var event;
                    var event_name = "widget_close";
                    if (document.createEvent) {
                        event = document.createEvent("HTMLEvents");
                        event.initEvent(event_name, false, true);
                    } else {
                        event = document.createEventObject();
                        event.eventType = event_name;
                    }

                    event.eventName = event_name;
                    event.memo = {};

                    if (document.createEvent) {
                        document.body.dispatchEvent(event);
                        if(link_obj) {
                            link_obj.dispatchEvent(event);
                        }
                    } else {
                        document.body.fireEvent("on" + event.eventType, event);
                        if(link_obj) {
                            link_obj.fireEvent("on" + event.eventType, event);
                        }
                    }
                });
            }

            window.SmartererWidget.bindEvent = bindEvent;
            window.SmartererWidget.createPopup = create_popup;

            (function() {
                var targets = document.getElementsByClassName('smarterer_test_link');
                for (var i=0, j=targets.length; i<j; i++) {
                    bindEvent(targets[i], 'click', function(e) {
                        // e.preventDefault doesn't work in IE
                        e.cancelBubble = true;
                        if (e.preventDefault) { e.preventDefault(); } else { e.returnValue = false; }
                        if (e.stopPropagation) { e.stopPropagation(); }
                        var url = this.getAttribute('data-href') || this.getAttribute('href') || this.href;
                        if(url) {
                            create_popup(url, this);
                        }
                    } );
                }
            })();

            if(window.SmartererWidget["loaded"] && typeof(window.SmartererWidget["loaded"]) == 'function') {
                window.SmartererWidget["loaded"]();
            }
        };

        window.SmartererWidget = {};
    }
})(jQuery);
//DOMReady w/out jquery (not really, more like onload hackery)
function smrt_r(f){/in/.test(document.readyState)?setTimeout('smrt_r('+f+')',9):f()}
smrt_r(window.smrt_widget_loader);

