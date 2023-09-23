/**
 * Bootbox.js — alert, confirm, prompt, and flexible dialogs for the Bootstrap framework 
 * @version: 6.0.0
 * @project: https://github.com/makeusabrew/bootbox
 * @license: MIT http://bootboxjs.com/license.txt
 */
!function(t,e){'use strict';'function'==typeof define&&define.amd?define(['jquery'],e):'object'==typeof exports?module.exports=e(require('jquery')):t.bootbox=e(t.jQuery)}(this,function e(s,c){'use strict';let r={};r.VERSION='6.0.0';let l={en:{OK:'OK',CANCEL:'Cancel',CONFIRM:'OK'}},u={dialog:'<div class="bootbox modal" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"><div class="bootbox-body"></div></div></div></div></div>',header:'<div class="modal-header"><h5 class="modal-title"></h5></div>',footer:'<div class="modal-footer"></div>',closeButton:'<button type="button" class="bootbox-close-button close btn-close" aria-hidden="true" aria-label="Close"></button>',form:'<form class="bootbox-form"></form>',button:'<button type="button" class="btn"></button>',option:'<option value=""></option>',promptMessage:'<div class="bootbox-prompt-message"></div>',inputs:{text:'<input class="bootbox-input bootbox-input-text form-control" autocomplete="off" type="text" />',textarea:'<textarea class="bootbox-input bootbox-input-textarea form-control"></textarea>',email:'<input class="bootbox-input bootbox-input-email form-control" autocomplete="off" type="email" />',select:'<select class="bootbox-input bootbox-input-select form-select"></select>',checkbox:'<div class="form-check checkbox"><label class="form-check-label"><input class="form-check-input bootbox-input bootbox-input-checkbox" type="checkbox" /></label></div>',radio:'<div class="form-check radio"><label class="form-check-label"><input class="form-check-input bootbox-input bootbox-input-radio" type="radio" name="bootbox-radio" /></label></div>',date:'<input class="bootbox-input bootbox-input-date form-control" autocomplete="off" type="date" />',time:'<input class="bootbox-input bootbox-input-time form-control" autocomplete="off" type="time" />',number:'<input class="bootbox-input bootbox-input-number form-control" autocomplete="off" type="number" />',password:'<input class="bootbox-input bootbox-input-password form-control" autocomplete="off" type="password" />',range:'<input class="bootbox-input bootbox-input-range form-control-range" autocomplete="off" type="range" />'}},p={locale:'en',backdrop:'static',animate:!0,className:null,closeButton:!0,show:!0,container:'body',value:'',inputType:'text',errorMessage:null,swapButtonOrder:!1,centerVertical:!1,multiple:!1,scrollable:!1,reusable:!1,relatedTarget:null,size:null,id:null};function i(t,e,o){return s.extend(!0,{},t,function(t,e){var o=t.length;let a={};if(o<1||2<o)throw new Error('Invalid argument length');return 2===o||'string'==typeof t[0]?(a[e[0]]=t[0],a[e[1]]=t[1]):a=t[0],a}(e,o))}function d(t,e,a,r){let o;r&&r[0]&&(o=r[0].locale||p.locale,(r[0].swapButtonOrder||p.swapButtonOrder)&&(e=e.reverse()));t={className:'bootbox-'+t,buttons:function(o,a){let r={};for(let e=0,t=o.length;e<t;e++){let t=o[e];var n=t.toLowerCase(),i=t.toUpperCase();r[n]={label:function(t,e){e=l[e];return(e||l.en)[t]}(i,a)}}return r}(e,o)};{t=i(t,r,a);var n=e;let o={};return f(n,function(t,e){o[e]=!0}),f(t.buttons,function(t){if(o[t]===c)throw new Error('button key "'+t+'" is not allowed (options are '+n.join(' ')+')')}),t}}function b(t){return Object.keys(t).length}function f(t,o){let a=0;s.each(t,function(t,e){o(t,e,a++)})}function m(t){t.data.dialog.find('.bootbox-accept').first().trigger('focus')}function h(t){t.target===t.data.dialog[0]&&t.data.dialog.remove()}function w(t){t.target===t.data.dialog[0]&&(t.data.dialog.off('escape.close.bb'),t.data.dialog.off('click'))}function g(t,e,o){t.stopPropagation(),t.preventDefault(),s.isFunction(o)&&!1===o.call(e,t)||e.modal('hide')}function x(t){return/([01][0-9]|2[0-3]):[0-5][0-9]?:[0-5][0-9]/.test(t)}function v(t){return/(\d{4})-(\d{2})-(\d{2})/.test(t)}return r.locales=function(t){return t?l[t]:l},r.addLocale=function(t,o){return s.each(['OK','CANCEL','CONFIRM'],function(t,e){if(!o[e])throw new Error('Please supply a translation for "'+e+'"')}),l[t]={OK:o.OK,CANCEL:o.CANCEL,CONFIRM:o.CONFIRM},r},r.removeLocale=function(t){if('en'===t)throw new Error('"en" is used as the default and fallback locale and cannot be removed.');return delete l[t],r},r.setLocale=function(t){return r.setDefaults('locale',t)},r.setDefaults=function(){let t={};return 2===arguments.length?t[arguments[0]]=arguments[1]:t=arguments[0],s.extend(p,t),r},r.hideAll=function(){return s('.bootbox').modal('hide'),r},r.init=function(t){return e(t||s)},r.dialog=function(e){if(s.fn.modal===c)throw new Error('"$.fn.modal" is not defined; please double check you have included the Bootstrap JavaScript library. See https://getbootstrap.com/docs/5.1/getting-started/introduction/ for more details.');e=function(a){let r,n;if('object'!=typeof a)throw new Error('Please supply an object of options');if(!a.message)throw new Error('"message" option must not be null or an empty string.');(a=s.extend({},p,a)).backdrop?a.backdrop='string'!=typeof a.backdrop||'static'!==a.backdrop.toLowerCase()||'static':a.backdrop=!1!==a.backdrop&&0!==a.backdrop&&'static';a.buttons||(a.buttons={});return r=a.buttons,n=b(r),f(r,function(t,e,o){if(s.isFunction(e)&&(e=r[t]={callback:e}),'object'!==s.type(e))throw new Error('button with key "'+t+'" must be an object');if(e.label||(e.label=t),!e.className){let t=!1;t=a.swapButtonOrder?0===o:o===n-1,n<=2&&t?e.className='btn-primary':e.className='btn-secondary btn-default'}}),a}(e),s.fn.modal.Constructor.VERSION?(e.fullBootstrapVersion=s.fn.modal.Constructor.VERSION,i=e.fullBootstrapVersion.indexOf('.'),e.bootstrap=e.fullBootstrapVersion.substring(0,i)):(e.bootstrap='2',e.fullBootstrapVersion='2.3.2',console.warn('Bootbox will *mostly* work with Bootstrap 2, but we do not officially support it. Please upgrade, if possible.'));let o=s(u.dialog),t=o.find('.modal-dialog'),a=o.find('.modal-body'),r=s(u.header),n=s(u.footer);var i=e.buttons;let l={onEscape:e.onEscape};if(a.find('.bootbox-body').html(e.message),0<b(e.buttons)&&(f(i,function(t,e){let o=s(u.button);switch(o.data('bb-handler',t),o.addClass(e.className),t){case'ok':case'confirm':o.addClass('bootbox-accept');break;case'cancel':o.addClass('bootbox-cancel')}o.html(e.label),e.id&&o.attr({id:e.id}),!0===e.disabled&&o.prop({disabled:!0}),n.append(o),l[t]=e.callback}),a.after(n)),!0===e.animate&&o.addClass('fade'),e.className&&o.addClass(e.className),e.id&&o.attr({id:e.id}),e.size)switch(e.fullBootstrapVersion.substring(0,3)<'3.1'&&console.warn('"size" requires Bootstrap 3.1.0 or higher. You appear to be using '+e.fullBootstrapVersion+'. Please upgrade to use this option.'),e.size){case'small':case'sm':t.addClass('modal-sm');break;case'large':case'lg':t.addClass('modal-lg');break;case'extra-large':case'xl':t.addClass('modal-xl'),e.fullBootstrapVersion.substring(0,3)<'4.2'&&console.warn('Using size "xl"/"extra-large" requires Bootstrap 4.2.0 or higher. You appear to be using '+e.fullBootstrapVersion+'. Please upgrade to use this option.')}if(e.scrollable&&(t.addClass('modal-dialog-scrollable'),e.fullBootstrapVersion.substring(0,3)<'4.3'&&console.warn('Using "scrollable" requires Bootstrap 4.3.0 or higher. You appear to be using '+e.fullBootstrapVersion+'. Please upgrade to use this option.')),e.title||e.closeButton){if(e.title?r.find('.modal-title').html(e.title):r.addClass('border-0'),e.closeButton){let t=s(u.closeButton);e.bootstrap<5&&t.html('&times;'),e.bootstrap<4?r.prepend(t):r.append(t)}a.before(r)}if(e.centerVertical&&(t.addClass('modal-dialog-centered'),e.fullBootstrapVersion<'4.0.0'&&console.warn('"centerVertical" requires Bootstrap 4.0.0-beta.3 or higher. You appear to be using '+e.fullBootstrapVersion+'. Please upgrade to use this option.')),e.reusable||(o.one('hide.bs.modal',{dialog:o},w),o.one('hidden.bs.modal',{dialog:o},h)),e.onHide){if(!s.isFunction(e.onHide))throw new Error('Argument supplied to "onHide" must be a function');o.on('hide.bs.modal',e.onHide)}if(e.onHidden){if(!s.isFunction(e.onHidden))throw new Error('Argument supplied to "onHidden" must be a function');o.on('hidden.bs.modal',e.onHidden)}if(e.onShow){if(!s.isFunction(e.onShow))throw new Error('Argument supplied to "onShow" must be a function');o.on('show.bs.modal',e.onShow)}if(o.one('shown.bs.modal',{dialog:o},m),e.onShown){if(!s.isFunction(e.onShown))throw new Error('Argument supplied to "onShown" must be a function');o.on('shown.bs.modal',e.onShown)}if(!0===e.backdrop){let e=!1;o.on('mousedown','.modal-content',function(t){t.stopPropagation(),e=!0}),o.on('click.dismiss.bs.modal',function(t){e||t.target!==t.currentTarget||o.trigger('escape.close.bb')})}return o.on('escape.close.bb',function(t){l.onEscape&&g(t,o,l.onEscape)}),o.on('click','.modal-footer button:not(.disabled)',function(t){var e=s(this).data('bb-handler');e!==c&&g(t,o,l[e])}),o.on('click','.bootbox-close-button',function(t){g(t,o,l.onEscape)}),o.on('keyup',function(t){27===t.which&&o.trigger('escape.close.bb')}),s(e.container).append(o),o.modal({backdrop:e.backdrop,keyboard:!1,show:!1}),e.show&&o.modal('show',e.relatedTarget),o},r.alert=function(){let t;if((t=d('alert',['ok'],['message','callback'],arguments)).callback&&!s.isFunction(t.callback))throw new Error('alert requires the "callback" property to be a function when provided');return t.buttons.ok.callback=t.onEscape=function(){return!s.isFunction(t.callback)||t.callback.call(this)},r.dialog(t)},r.confirm=function(){let t;if(t=d('confirm',['cancel','confirm'],['message','callback'],arguments),s.isFunction(t.callback))return t.buttons.cancel.callback=t.onEscape=function(){return t.callback.call(this,!1)},t.buttons.confirm.callback=function(){return t.callback.call(this,!0)},r.dialog(t);throw new Error('confirm requires a callback')},r.prompt=function(){let n,e,t,i;var o,a;let l;if(t=s(u.form),(n=d('prompt',['cancel','confirm'],['title','callback'],arguments)).value||(n.value=p.value),n.inputType||(n.inputType=p.inputType),o=(n.show===c?p:n).show,n.show=!1,n.buttons.cancel.callback=n.onEscape=function(){return n.callback.call(this,null)},n.buttons.confirm.callback=function(){let e;if('checkbox'===n.inputType)e=i.find('input:checked').map(function(){return s(this).val()}).get();else if('radio'===n.inputType)e=i.find('input:checked').val();else{let t=i[0];if(n.errorMessage&&t.setCustomValidity(''),t.checkValidity&&!t.checkValidity())return n.errorMessage&&t.setCustomValidity(n.errorMessage),t.reportValidity&&t.reportValidity(),!1;e='select'===n.inputType&&!0===n.multiple?i.find('option:selected').map(function(){return s(this).val()}).get():i.val()}return n.callback.call(this,e)},!n.title)throw new Error('prompt requires a title');if(!s.isFunction(n.callback))throw new Error('prompt requires a callback');if(!u.inputs[n.inputType])throw new Error('Invalid prompt type');switch(i=s(u.inputs[n.inputType]),n.inputType){case'text':case'textarea':case'email':case'password':i.val(n.value),n.placeholder&&i.attr('placeholder',n.placeholder),n.pattern&&i.attr('pattern',n.pattern),n.maxlength&&i.attr('maxlength',n.maxlength),n.required&&i.prop({required:!0}),n.rows&&!isNaN(parseInt(n.rows))&&'textarea'===n.inputType&&i.attr({rows:n.rows});break;case'date':case'time':case'number':case'range':if(i.val(n.value),n.placeholder&&i.attr('placeholder',n.placeholder),n.pattern?i.attr('pattern',n.pattern):'date'===n.inputType?i.attr('pattern','d{4}-d{2}-d{2}'):'time'===n.inputType&&i.attr('pattern','d{2}:d{2}'),n.required&&i.prop({required:!0}),'date'!==n.inputType&&n.step){if(!('any'===n.step||!isNaN(n.step)&&0<parseFloat(n.step)))throw new Error('"step" must be a valid positive number or the value "any". See https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-step for more information.');i.attr('step',n.step)}!function(t,e,o){let a=!1,r=!0,n=!0;if('date'===t)e===c||(r=v(e))?o===c||(n=v(o))||console.warn('Browsers which natively support the "date" input type expect date values to be of the form "YYYY-MM-DD" (see ISO-8601 https://www.iso.org/iso-8601-date-and-time-format.html). Bootbox does not enforce this rule, but your max value may not be enforced by this browser.'):console.warn('Browsers which natively support the "date" input type expect date values to be of the form "YYYY-MM-DD" (see ISO-8601 https://www.iso.org/iso-8601-date-and-time-format.html). Bootbox does not enforce this rule, but your min value may not be enforced by this browser.');else if('time'===t){if(e!==c&&!(r=x(e)))throw new Error('"min" is not a valid time. See https://www.w3.org/TR/2012/WD-html-markup-20120315/datatypes.html#form.data.time for more information.');if(o!==c&&!(n=x(o)))throw new Error('"max" is not a valid time. See https://www.w3.org/TR/2012/WD-html-markup-20120315/datatypes.html#form.data.time for more information.')}else{if(e!==c&&isNaN(e))throw r=!1,new Error('"min" must be a valid number. See https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-min for more information.');if(o!==c&&isNaN(o))throw n=!1,new Error('"max" must be a valid number. See https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-max for more information.')}if(r&&n){if(o<=e)throw new Error('"max" must be greater than "min". See https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-max for more information.');a=!0}return a}(n.inputType,n.min,n.max)||(n.min!==c&&i.attr('min',n.min),n.max!==c&&i.attr('max',n.max));break;case'select':let r={};if(l=n.inputOptions||[],!s.isArray(l))throw new Error('Please pass an array of input options');if(!l.length)throw new Error('prompt with "inputType" set to "select" requires at least one option');n.required&&i.prop({required:!0}),n.multiple&&i.prop({multiple:!0}),f(l,function(t,e){let o=i;if(e.value===c||e.text===c)throw new Error('each option needs a "value" property and a "text" property');e.group&&(r[e.group]||(r[e.group]=s('<optgroup />').attr('label',e.group)),o=r[e.group]);let a=s(u.option);a.attr('value',e.value).text(e.text),o.append(a)}),f(r,function(t,e){i.append(e)}),i.val(n.value),n.bootstrap<5&&i.removeClass('form-select').addClass('form-control');break;case'checkbox':let e=s.isArray(n.value)?n.value:[n.value];if(!(l=n.inputOptions||[]).length)throw new Error('prompt with "inputType" set to "checkbox" requires at least one option');i=s('<div class="bootbox-checkbox-list"></div>'),f(l,function(t,o){if(o.value===c||o.text===c)throw new Error('each option needs a "value" property and a "text" property');let a=s(u.inputs[n.inputType]);a.find('input').attr('value',o.value),a.find('label').append('\n'+o.text),f(e,function(t,e){e===o.value&&a.find('input').prop('checked',!0)}),i.append(a)});break;case'radio':if(n.value!==c&&s.isArray(n.value))throw new Error('prompt with "inputType" set to "radio" requires a single, non-array value for "value"');if(!(l=n.inputOptions||[]).length)throw new Error('prompt with "inputType" set to "radio" requires at least one option');i=s('<div class="bootbox-radiobutton-list"></div>');let a=!0;f(l,function(t,e){if(e.value===c||e.text===c)throw new Error('each option needs a "value" property and a "text" property');let o=s(u.inputs[n.inputType]);o.find('input').attr('value',e.value),o.find('label').append('\n'+e.text),n.value!==c&&e.value===n.value&&(o.find('input').prop('checked',!0),a=!1),i.append(o)}),a&&i.find('input[type="radio"]').first().prop('checked',!0)}return t.append(i),t.on('submit',function(t){t.preventDefault(),t.stopPropagation(),e.find('.bootbox-accept').trigger('click')}),''!==s.trim(n.message)&&(a=s(u.promptMessage).html(n.message),t.prepend(a)),n.message=t,(e=r.dialog(n)).off('shown.bs.modal',m),e.on('shown.bs.modal',function(){i.focus()}),!0===o&&e.modal('show'),e},r});
String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};

String.prototype.containsBetween = function(str, start_cap, end_cap)
{
    var arr = [];

    while (str.length > 0)
    {
        var s_ind = str.indexOf(start_cap);
        var e_ind = str.indexOf(end_cap);
        if (s_ind >= 0 && e_ind >= 0)
        {
            var sub = str.substr(s_ind, (e_ind - s_ind + 1));
            arr.push(sub.replace(start_cap, "").replace(end_cap, ""));
            str = str.replace(sub, "");
        }
        else
        {
            return arr;
        }
    }

    return arr;
};


$.sr = {
    
};

$.sr.error = {
    msg : function(msg)
    {
        $.toast({
            text: msg,
            icon: 'error',
            hideAfter: 5000,
            position: 'mid-center',
        });
    },
    detail : function (title, msg)
    {
        $.toast({
            heading: title,
            text: msg,
            icon: 'error',
            hideAfter: 5000,
            position: 'mid-center',
        });
    }
}

$.sr.niceBytes = function(bytes, i)
{
    var list = ["B", "KB", "MB", "GB", "TB"];

    if (typeof i == "undefined")
    {
        i = 0;
    }

    var temp  = bytes / 1024;

    if (temp > 1024)
    {
        return $.sr.niceBytes(temp, i + 1);
    }

    if (temp < 1)
    {
        return bytes.toFixed(1) + " " + list[i];
    }
    else
    {
        return temp.toFixed(1) + " " + list[i + 1];
    }
};

$.sr.wait = function (time, callback, onStopCallback)
{
    var inverval_wait = setInterval(function()
    {
        callback(time);
        time -= 1;

        if (time < 0)
        {
            clearInterval(inverval_wait);
            onStopCallback();
        }
    }, 1000);

    callback(time);
}

$.sr.image = 
{
    toDataUrl : function (src, outputFormat, callback)
    {
        var img = new Image();
        img.crossOrigin = 'Anonymous';
        img.onload = function() {
            var canvas = document.createElement('CANVAS');
            canvas.height = this.height;
            canvas.width = this.width;

            var ctx = canvas.getContext('2d');
            ctx.webkitImageSmoothingEnabled = true;
            ctx.mozImageSmoothingEnabled = true;
            ctx.imageSmoothingEnabled = true;
            ctx.imageSmoothingQuality = "high";

            ctx.drawImage(this, 0, 0);
            var dataURL = canvas.toDataURL(outputFormat, 1.0);
            callback(src, dataURL);
            
            canvas.remove();
        };
        img.src = src;
        if (img.complete || img.complete === undefined) {
            img.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
            img.src = src;
        }
    }
}

jQuery.fn.extend({
    tagName: function ()
    {
        return this.prop("tagName").toLowerCase();
    },
    applyOnce: function (feature)
    {
        if ($(this).hasClass(feature + "-applied"))
        {
            return false;
        }

        $(this).addClass(feature + "-applied");
        return true;
    },
    hasEvent : function(find_e)
    {
        var events = $._data( $(this)[0], "events");        
        for(var e in events)
        {
            if (find_e == e)
            {
                return true;
            }
        }
        
        return false;
    },    
    getBoolFromData : function(name, default_value)
    {
        var _is = $(this).data(name);
            
        if (typeof _is != "undefined")
        {
            if (typeof _is != "string")
            {
                _is = _is.toString();
            }
            
            _is = _is.toLowerCase().trim();

            if (_is == "true" || _is == "1")
            {
                _is = true;
            }
            else
            {
                _is = false;
            }
        }
        else
        {
            _is = default_value;
        }
        
        return _is;
    },
});
jQuery.fn.extend({
    sentance: function ()
    {
        return this.each(function ()
        {
            if ($(this).tagName() == "input")
            {
                var v = $(this).val();

                if (v.length > 0)
                {
                    $(this).val(v.charAt(0).toUpperCase() + v.slice(1));
                }
            }
            else
            {
                var v = $(this).html();

                if (v.length > 0)
                {
                    $(this).html(v.charAt(0).toUpperCase() + v.slice(1));
                }
            }
        });
    },
    chkSelectAll: function ()
    {
        var feature = "sr-chkselect";

        var events = {
            childCheck: feature + ".childcheck",
            parentCheck: feature + ".parentcheck",
        };

        return this.each(function ()
        {
            var _this = $(this);

            var target = $(this).data(feature + "-children");

            if (!target)
            {
                console.error("data-" + feature + "-children is not defined in html");
                return;
            }

            if (_this.applyOnce(feature))
            {
                _this.on(events.childCheck, function ()
                {
                    $(target).prop("checked", _this.prop("checked"));

                    $(target).each(function ()
                    {
                        if ($(this).hasEvent(events.childCheck))
                        {
                            $(this).trigger(events.childCheck);
                        }
                    });
                });

                $(target).on(events.parentCheck, function ()
                {
                    var t_c = $(target).length;
                    var c_c = $(target).filter(":checked").length;
                    var checked = t_c == c_c;
                    _this.prop("checked", checked);

                    if (_this.hasEvent(events.parentCheck))
                    {
                        _this.trigger(events.parentCheck);
                    }
                });

                _this.change(function ()
                {
                    $(this).trigger(events.childCheck);
                });

                $(target).change(function ()
                {
                    $(this).trigger(events.parentCheck);
                });
            }

            $(target).first().trigger(events.parentCheck);
        });
    },
    cssClassToggle: function ()
    {
        var feature = "sr-css-class-toggle";

        var events = {
            toggleClass: feature + ".toggle",
        };

        return this.each(function ()
        {
            var target = $(this).data(feature + "-target");
            if (!target)
            {
                console.error("data-" + feature + "-target is not defined in html");
                return;
            }

            var tag = $(this).tagName();

            if (tag == "select")
            {
                $(this).on(events.toggleClass, function ()
                {
                    var prev_class_name = $(this).data(feature + "-prev-class");

                    if (prev_class_name)
                    {
                        $(target).removeClass(prev_class_name);
                    }

                    var class_name = $(this).val();

                    if (class_name)
                    {
                        $(target).addClass(class_name);
                        $(this).data(feature + "-prev-class", class_name);
                    }
                });

                $(this).change(function ()
                {
                    $(this).trigger(events.toggleClass);
                });
            } 
            else
            {
                var class_name = $(this).data(feature + "-class");

                if (!class_name)
                {
                    console.error("data-" + feature + "-class is not defined in html");
                    return;
                }

                if ($(this).applyOnce(feature))
                {
                    if (tag == "input")
                    {
                        if ($(this).is(":checkbox"))
                        {
                            $(this).on(events.toggleClass, function ()
                            {
                                if ($(this).prop("checked"))
                                {
                                    $(target).addClass(class_name);
                                } else
                                {
                                    $(target).removeClass(class_name);
                                }
                            });

                            $(this).change(function ()
                            {
                                $(this).trigger(events.toggleClass);
                            });
                        }
                    } else
                    {
                        $(this).on(events.toggleClass, function ()
                        {
                            if (!$(target).hasClass(class_name))
                            {
                                $(target).addClass(class_name);
                            } else
                            {
                                $(target).removeClass(class_name);
                            }
                        });

                        $(this).click(function ()
                        {
                            $(this).trigger(events.toggleClass);
                        });
                    }
                }
            }
        });
    },
    copyText: function ()
    {
        var feature = "sr-copy-text";

        var events = {
            copy: feature + ".copy",
        };

        return this.each(function ()
        {
            var src = $(this).data(feature + "-src");

            if (!src)
            {
                console.error("data-" + feature + "-src is not defined in html");
                return;
            }

            if ($(this).applyOnce(feature))
            {
                $(this).on(events.copy, function ()
                {
                    var tag = $(src).tagName();
                    var will_remove = false;
                    if (tag == "input" && $(src).attr("type") == "text")
                    {
                        var obj = $(src);
                    } else
                    {
                        var obj = $("<input>");
                        $("body").append(obj);
                        obj.val($(src).text().trim());
                        will_remove = true;
                    }

                    obj.select();
                    document.execCommand("copy");

                    $.toast({
                        text: 'Coppied',
                        position: 'bottom-center',
                        stack: false
                    })

                    if (will_remove)
                    {
                        obj.remove();
                    }
                });

                $(this).click(function ()
                {
                    $(this).trigger(events.copy);
                });
            }
        });
    },
    ajaxLoad: function (callback)
    {
        var feature = "sr-ajax-load";

        var events = {
            get: feature + ".get",
        };

        return this.each(function ()
        {
            var _this = $(this);

            var url = $(this).data(feature + "-url");

            if (!url)
            {
                console.error("data-" + feature + "-url is not defined in html");
                return;
            }

            var target = $(this).data(feature + "-target");

            if (!target)
            {
                console.error("data-" + feature + "-target is not defined in html");
                return;
            }

            var auto_load = $(this).getBoolFromData(feature + "-auto-load", false);

            var auto_load_js = $(this).getBoolFromData(feature + "-auto-load-js", true);

            var load_once = $(this).getBoolFromData(feature + "-load-once", true);

            if ($(this).applyOnce(feature))
            {
                $(this).on(events.get, function ()
                {
                    if (load_once)
                    {
                        var is_load = $(target).getBoolFromData(feature + "-is_load", false);
                        if (is_load)
                        {
                            return;
                        }
                    }

                    $(target).load(url, function ()
                    {
                        $(target).data(feature + "-is_load", 1);

                        if (auto_load_js)
                        {
                            $(target).find("script").each(function ()
                            {
                                eval($(this).html());
                            });
                        }

                        if (typeof callback == "function")
                        {
                            callback(_this, target, url);
                        }
                    });

                });

                if (auto_load)
                {
                    $(this).trigger(events.get);
                }
            }
        });
    },
    ajaxJSON: function (opt)
    {
        var feature = "sr-ajax-json";

        var events = {
            get: feature + ".get",
        };
        
        var setting = $.extend({
            onSuccess : function(obj, url, data)
            {
                
            },
            onError : function (title, msg)
            {
                $.sr.error.detail(title, msg);
            }
        }, opt);

        return this.each(function ()
        {
            var _this = $(this);

            var url = $(this).data(feature + "-url");

            if (!url)
            {
                console.error("data-" + feature + "-url is not defined in html");
                return;
            }

            if ($(this).applyOnce(feature))
            {
                $(this).on(events.get, function ()
                {
                    $.get(url, function (response)
                    {
                        try
                        {
                            response = JSON.parse(response);
                        } 
                        catch (e)
                        {
                            setting.onError(e.message, response);
                            return;
                        }

                        if (typeof callback == "function")
                        {
                            setting.onSuccess(_this, url, response);
                        } 
                        else
                        {
                            setting.onError("Error", response["msg"]);
                        }
                    });

                    return false;
                });

                $(this).click(function ()
                {
                    $(this).trigger(events.get);
                });

            }
        });
    },
    srParagraph: function ()
    {
        var feature = "sr-paragraph";

        var events = {
            moreText: feature + ".moreText",
            lessText: feature + ".lessText",
        };

        return this.each(function ()
        {
            var _this = $(this);

            var max = $(this).data(feature + "-max");

            if (!max)
            {
                console.error("data-" + feature + "-max is not defined in html");
                return;
            }

            if ($(this).applyOnce(feature))
            {
                max = parseInt(max);

                var content = _this.html();

                if (content.length > max)
                {
                    var less_content = content.substr(0, max);

                    var html = '<span class="' + feature + '-less-text-block">' + less_content + '<br/><a class="' + feature + '-more-text-opener">...More</a></span>';
                    html += '<span class="' + feature + '-more-text-block hidden">' + content + '<br/><a class="' + feature + '-less-text-opener">...Less</a></span>';

                    $(this).html(html);

                    var _this = $(this);

                    _this.on(events.lessText, function ()
                    {
                        _this.find("." + feature + "-more-text-block").addClass("hidden");
                        _this.find("." + feature + "-less-text-block").removeClass("hidden");
                    });

                    _this.on(events.moreText, function ()
                    {
                        _this.find("." + feature + "-less-text-block").addClass("hidden");
                        _this.find("." + feature + "-more-text-block").removeClass("hidden");
                    });

                    _this.find("." + feature + "-more-text-opener").click(function ()
                    {
                        $(this).trigger(events.moreText);
                    });

                    _this.find("." + feature + "-less-text-opener").click(function ()
                    {
                        $(this).trigger(events.lessText);
                    });
                }
            }
        });
    },
    invalidChar: function (invalid_chars)
    {
        var feature = "sr-invalid-char";

        var events = {
            validate: feature + ".validate",
        };

        if (typeof invalid_chars != "array")
        {
            console.error(feature + " invalid_chars list should be pass in args");
            return;
        }

        return this.each(function ()
        {
            var error_span = $(this).parent().append('<span class="' + feature + '-error-message error-message hidden">&#9679 Invalid Character</span>');

            $(this).on(events.validate, function ()
            {
                error_span.addClass("hidden");

                var v = $(this).val();

                var result = true;

                invalid_chars.each(function (i, invalid_char)
                {
                    if (v.indexOf(invalid_char) >= 0)
                    {
                        error_span.removeClass("hidden");
                        result = false;
                    }
                });

                return result;
            });

            $(this).keyup(function (event)
            {
                return $(this).trigger(events.validate);
            });
        });
    },
    invalidURLChar: function ()
    {
        var invalid_chars = ["`", "~", "!", "@", "#", "$", "%", "^", "&", "*", "+", "=", "{", "}", "[", "]", ":", ";", '"', "'", "<", ">", ",", ".", "?", "/", "\\", "|"];
        $(this).invalidChar(invalid_chars);
    },
    invalidSqlChar: function ()
    {
        var invalid_chars = ["`", "~", "!", "#", "$", "%", "&", "=", ":", ";", '"', "'", "<", ">", "\\", "|", ","];
        $(this).invalidChar(invalid_chars);
    },
    srTextarea: function ()
    {
        var feature = "sr-text-area";

        return this.each(function ()
        {
            var min = $(this).data(feature + "-min");

            if (!min)
            {
                console.error("data-" + feature + "-min is not defined in html");
                return;
            }

            min = parseInt(min);

            var limit = $(this).data(feature + "-limit");

            if (!limit)
            {
                console.error("data-" + feature + "-limit is not defined in html");
                return;
            }

            limit = parseInt(limit);

            var tag = $(this).tagName();

            if (tag != "textarea" && !(tag == "input" && $(this).attr('type') == "text"))
            {
                console.error(feature + " will only implement on textarea or text input");
                return;
            }

            if ($(this).applyOnce(feature))
            {
                $(this).parent().append('<span class="' + feature + '-info help-block"></span>');
                var span_info = $(this).parent().find("." + feature + "-info");

                $(this).parent().append('<span class="' + feature + '-error-message error-message"></span>');
                var span_error = $(this).parent().find("." + feature + "-error-message");

                $(this).keydown(function (e)
                {
                    var keyCode = e.which;

                    var len = $(this).val().length;
                    if (len > limit)
                    {
                        span_error.html("Max Limit is " + limit);
                        span_error.show();

                        console.log(keyCode);
                        if (
                                //function keys
                                keyCode < 112 && keyCode > 123
                                && $.inArray(keyCode, [8, 9, 16, 27, 37, 38, 39, 40, 46, ]) === -1
                                )
                        {
                            return false;
                        }
                    } else
                    {
                        span_info.html("Min. : " + min + ", Max. : " + limit + ", Characters : " + len);
                        span_error.hide();
                    }

                    return true;
                });

                $(this).blur(function ()
                {
                    if ($(this).val().length < min)
                    {
                        span_error.html("Minimum character should be " + min);
                        span_error.show();
                    } 
                    else
                    {
                        span_error.hide();
                    }
                });
            }
        });
    },
    srTableTemplate: function (opt)
    {
        var feature = "sr-table-template";

        var events = {
            addRow: feature + ".addRow",
            delRow: feature + ".delRow",
            upRow: feature + ".upRow",
            downRow: feature + ".downRow",
            refresh: feature + ".refresh",
            getPlaceholder: feature + ".getPlaceholder",
        };

        var methods = {

        };

        var selector = {
            row: "> tbody > tr",
            templateRow: "." + feature + "-row",
            add: "." + feature + "-add",
            delete: "." + feature + "-delete",
            moveUp: "." + feature + "-move-up",
            moveDown: "." + feature + "-move-down",
        };

        var dataKeys = {
            rowId: feature + "-row-id"
        };

        var placeholder = {
            id: "sr-counter",
            counter: "sr-counter",
        };

        var settings = $.extend({
            brace_type: "{{",
            beforeRowAdd: function () {
                return true
            },
            beforeRowDel: function () {
                return true
            },
            afterRowAdd: function () {
                return true
            },
            afterRowDel: function () {
                return true
            },
        }, opt);


        this.each(function ()
        {
            var _table = $(this);

            var minimum_row = _table.data(feature + "-min-row");
            if (jQuery.type(minimum_row) == "undefined")
            {
                minimum_row = 0;
            }

            _table.bind(events.refresh, function ()
            {
                _table.find(selector.delete).show();

                _table.find(selector.row).not(selector.templateRow).each(function (a, tr)
                {
                    if (a <= minimum_row)
                    {
                        //find in first level only
                        $(tr).children(selector.delete).hide();
                    }
                });
            });

            methods.getPlaceholder = function (key)
            {
                var holder = "{{" + key + "}}";

                if (settings.brace_type == "{")
                {
                    holder = "{" + key + "}";
                } else if (settings.brace_type == "[")
                {
                    holder = "[" + key + "]";
                } else if (settings.brace_type == "[[")
                {
                    holder = "[[" + key + "]]";
                } else if (settings.brace_type == "[{")
                {
                    holder = "[{" + key + "}]";
                } else if (settings.brace_type == "{[")
                {
                    holder = "{[" + key + "]}";
                }
                return holder;
            };

            _table.on(events.addRow, function ()
            {
                var last_id = _table.find(selector.row).last().data(dataKeys.rowId);

                if (typeof last_id == "undefined")
                {
                    last_id = 0;
                } else
                {
                    last_id = parseInt(last_id);
                }
                last_id += 1;

                var result = settings.beforeRowAdd(_table, last_id);

                if (!result)
                {
                    return false;
                }

                var template_row = _table.children("tbody").children("tr" + selector.templateRow).html();

                var id_holder = methods.getPlaceholder(placeholder.id);
                var counter_holder = methods.getPlaceholder(placeholder.counter);

                var len = _table.find(selector.row).length - 1;

                var tr_html = template_row.replaceAll(id_holder, last_id);
                tr_html = tr_html.replaceAll(counter_holder, len);
                tr_html = "<tr>" + tr_html + "</tr>";
                _table.append(tr_html);

                var _tr = _table.find(selector.row).last();
                _tr.data(dataKeys.rowId, last_id);

                settings.afterRowAdd(_table, last_id, _tr);
            });

            _table.on(events.delRow, function (e, opt)
            {
                var _tr = opt.tr;
                var last_id = _tr.data(dataKeys.rowId);

                var result = settings.beforeRowDel(_table, last_id, _tr);

                if (!result)
                {
                    return false;
                }

                _tr.remove();

                settings.afterRowDel(_table, last_id);
            });

            _table.on(events.upRow, function (e, opt)
            {
                var _tr = opt.tr;
                var index = _tr.index();
                if (index > 0)
                {
                    index--;
                    _tr.insertBefore(_table.find("> tbody > tr:eq(" + index + ")"));
                }
            });

            _table.on(events.downRow, function (e, opt)
            {
                var _tr = opt.tr;
                var index = _tr.index();
                if (index < _table.find("> tbody > tr").length - 1)
                {
                    index++;
                    _tr.insertAfter(_table.find("> tbody > tr:eq(" + index + ")"));
                }
            });

            _table.on("click", selector.add, function ()
            {
                _table.trigger(events.addRow);
            });

            _table.on("click", selector.delete, function ()
            {
                var _tr = $(this).closest("tr");
                _table.trigger(events.delRow, {tr: _tr});
            });

            _table.on("click", selector.moveUp, function ()
            {
                var _tr = $(this).closest("tr");
                _table.trigger(events.upRow, {tr: _tr});
            });

            _table.on("click", selector.moveDown, function ()
            {
                var _tr = $(this).closest("tr");
                _table.trigger(events.downRow, {tr: _tr});
            });

            var tr_count = _table.find(selector.row).length - 1;

            if (tr_count < minimum_row)
            {
                for (var i = tr_count; i < minimum_row; i++)
                {
                    _table.trigger(events.addRow);
                }
            }

            _table.trigger(events.refresh);
        });
    },
    cascade: function (opt)
    {
        var feature = "sr-cascade";

        var events = {
            change: feature + ".change",
            fill: feature + ".fill",
            setValue: feature + ".setValue",
        };

        var settings = $.extend({
            placeholder: "{v}",
            onError : function(title, msg)
            {
                $.sr.error.detail(title, msg);
            },
            beforeGet: function (src, url)
            {
                return url;
            },
            afterGet: function (src, dest, response)
            {
                return response;
            },
            beforeValueSet: function (src, dest, val)
            {
                return val
            },
            afterValueSet: function (src, dest, val)
            {}
        }, opt);

        return this.each(function ()
        {
            var _this = $(this);

            var tag = _this.tagName();

            if (tag != "select")
            {
                console.log(feature + " is only implement on cascade");
                console.groupEnd();
                return;
            }

            var target = _this.data(feature + "-target");

            if (!target)
            {
                console.error(feature + "-target is not set in html");
                console.groupEnd();
                return;
            }

            if ($(target).length == 0)
            {
                console.error(feature + "-target : " + target + " not found");
                console.groupEnd();
                return;
            }

            var url = _this.data(feature + "-url");

            if (!url)
            {
                console.error(feature + "-url is not set in html");
                console.groupEnd();
                return;
            }

            if (_this.applyOnce(feature))
            {
                $(target).on(events.fill, function (e, args)
                {
                    if (typeof args[$.sr.cascade.fill.types.list] != "undefined")
                    {
                        $.sr.cascade.fill.fromList($(this), args[$.sr.cascade.fill.types.list]);
                    } 
                    else if (typeof args[$.sr.cascade.fill.types.groupList] != "undefined")
                    {
                        $.sr.cascade.fill.fromGroupList($(this), args[$.sr.cascade.fill.types.groupList]);
                    } 
                    else if (typeof args[$.sr.cascade.fill.types.keyPairList] != "undefined")
                    {
                        var key = typeof args["key"] ? args["key"] : null;
                        var value = typeof args["value"] ? args["value"] : null;
                        $.sr.cascade.fill.fromKeyPairList($(this), args[$.sr.cascade.fill.types.keyPairList], key, value);
                    } 
                    else if (typeof args[$.sr.cascade.fill.types.groupKeyPairlist] != "undefined")
                    {
                        var key = typeof args["key"] ? args["key"] : null;
                        var value = typeof args["value"] ? args["value"] : null;
                        $.sr.cascade.fill.fromGroupKeyPairList($(this), args[$.sr.cascade.fill.types.groupKeyPairlist], key, value);
                    }
                });

                $(target).on(events.setValue, function (e, args)
                {
                    var v = settings.beforeValueSet(_this, $(this), args.value);
                    if (v)
                    {
                        $(target).val(v);
                        settings.afterValueSet(_this, $(this), v);
                    }
                });

                _this.on(events.change, function (e, event_opt)
                {
                    var v = $(this).val();

                    if (v)
                    {
                        var new_url = settings.beforeGet(_this, url);

                        if (new_url === false)
                        {
                            return false;
                        }

                        new_url = new_url.replaceAll(settings.placeholder, v);

                        console.log(feature + " : get : " + new_url);
                        $.get(new_url, function (response)
                        {
                            try
                            {
                                response = JSON.parse(response);
                            }
                            catch (e)
                            {
                                settings.onError(feature + " Error on get " + new_url, response);
                                return;
                            }

                            var new_response = settings.afterGet(_this, $(target), response);

                            if (new_response["status"] != "1")
                            {
                                settings.onError(feature + " Error on get " + new_url, new_response["msg"]);
                                return;
                            }

                            if (typeof new_response["data"] == "undefined")
                            {
                                settings.onError(feature + " Error on get " + new_url, "data not found in response");
                            }

                            $(target).trigger(events.fill, [new_response["data"]]);

                            $(target).each(function ()
                            {
                                if (typeof event_opt != "undefined" && typeof event_opt.pageLoad != "undefined" && event_opt.pageLoad)
                                {
                                    var value = $(this).data(feature + "-value");

                                    if (value)
                                    {
                                        $(this).trigger(events.setValue, [{value: value}]);
                                    }
                                }

                                $(this).trigger(events.change, event_opt);
                            });
                        })
                        .fail(function (jqXHR, status, msg)
                        {
                            settings.onError(feature + " Error on get " + new_url, msg);
                        });
                    } 
                    else
                    {
                        $(target).trigger(events.fill, [
                            {list: []}
                        ]);

                        $(target).each(function ()
                        {
                            if ($(this).hasEvent(events.change))
                            {
                                $(this).trigger(events.change, event_opt);
                            }
                        });
                    }
                });

                _this.on("change", function (e, event_opt)
                {
                    console.group(feature);
                    _this.trigger(events.change, event_opt);
                    console.groupEnd();
                });
            }
        });
    },
    srLoader: function ()
    {
        var feature = "sr-loader";

        var events = {
            show: feature + ".show",
            hide: feature + ".hide",
            onShown: feature + ".onShown",
            onHidden: feature + ".onHidden",
        };

        return this.each(function ()
        {
            var tag = $(this).tagName();

            var cls = tag == "body" ? "sr-loader-container-fixed" : "sr-loader-container";

            if ($(this).applyOnce(feature))
            {
                var html = "<div class='" + cls + " hidden'>";
                html += '<i class="sr-loader-icon fas fa-circle-notch fa-spin fa-fw"></i>';
                html += "</div>";

                $(this).append(html);

                $(this).on(events.show, function ()
                {
                    $(this).children("." + cls).removeClass("hidden");
                    $(this).trigger(events.onShown);
                });

                $(this).on(events.hide, function ()
                {
                    $(this).children(".sr-loader-container, .sr-loader-container-fixed").addClass("hidden");
                    $(this).trigger(events.onHidden);
                });
            }
        });
    },
    srTableCSV: function (filename)
    {
        var feature = "sr-table-csv";
        var tag = $(this).tagName();

        if (tag != "table")
        {
            console.error(feature + " only implement on table");
            return;
        }

        var dataKeys = {
            column: feature + "-col",
            row: feature + "-row",
        };

        var ths = $(this).children("thead").children("tr").first().children("th");

        var cols = {};
        ths.each(function (col_i, th)
        {
            var will_col = $(th).getBoolFromData(dataKeys.column, true);

            if (will_col)
            {
                cols[col_i] = $(th).text().trim();
            }
        });

        var trs = $(this).children("tbody").children("tr");

        var rows = {};
        trs.each(function (t_i, tr)
        {
            var will_row = $(tr).getBoolFromData(dataKeys.row, true);

            if (will_row)
            {
                rows[t_i] = [];
                $(tr).children("td").each(function (col_i, td)
                {
                    if (typeof cols[col_i] != "undefined")
                    {
                        rows[t_i].push($(td).text().trim());
                    }
                });
            }
        });

        var csv = [
            Object.values(cols).join(",")
        ];

        for (var i in rows)
        {
            csv.push(rows[i]);
        }

        csv = csv.join("\n");

        $.download.csv(filename, csv);
    },
    srTableCSVExport: function ()
    {
        var feature = "sr-table-csv-export";

        this.each(function ()
        {
            var target = $(this).data(feature + "-target");

            if (!target)
            {
                console.error(feature + "-target should be set in html");
                return;
            }

            if ($(target).length == 0)
            {
                console.error(feature + "-target not found");
                return;
            }

            var filename = $(this).data(feature + "-filename");

            if (!filename)
            {
                console.error(feature + " filename should be set in html");
                return;
            }

            if ($(this).applyOnce(feature))
            {
                $(this).on("click", function ()
                {
                    $(target).srTableCSV(filename);
                });
            }
        });
    },
    srReadCSV: function (opt)
    {
        var feature = "sr-read-csv";

        var events = {
            read: feature + ".read"
        };

        var setting = $.extend({
            onRead: function (data)
            {

            },
            onError : function (msg)
            {
                $.sr.error.msg(msg);
            }
        }, opt)

        return this.each(function ()
        {
            if (!window.File || !window.FileReader || !window.FileList || !window.Blob)
            {
                console.error('The File APIs are not fully supported in this browser.');
                return;
            }

            var tag = $(this).tagName();

            if (tag != "input" && $(this).attr("file"))
            {
                console.error(feature + " can be implement only in file input");
                return;
            }

            if ($(this).applyOnce(feature))
            {
                $(this).on(events.read, function ()
                {
                    var filename = $(this).val();
                    var ext = filename.split(".");
                    ext = ext[1].trim().toLowerCase();

                    if (ext != "csv")
                    {
                        setting.onError("Please select csv file");
                        return;
                    }

                    var fileReader = new FileReader();

                    fileReader.onload = function () {
                        setting.onRead($.sr.csv.toArray(fileReader.result))
                    };

                    var files = $(this).prop("files");
                    fileReader.readAsText(files[0]);
                });
                
                $(this).change(function()
                {
                    $(this).trigger(events.read);
                });
            }
        });
    },
});

$.sr.cascade = {

};

$.sr.cascade.fill = {
    defaultKey: "id",
    defaultValue: "name",
    types: {
        list: "list",
        groupList: "group_list",
        keyPairList: "key_pair_list",
        groupKeyPairlist: "group_key_pair_list",
    },
    initialCheck: function (obj)
    {
        var tag = obj.tagName();

        if (tag != "select")
        {
            console.error("casecade fill : obj is not a select element");
            return false;
        }

        var html = "";
        if (obj.attr("multiple") != "multiple")
        {
            html += '<option value="">Please Select</option>';
        }

        return html;
    },

    fromList: function (obj, list)
    {
        var html = this.initialCheck(obj);

        html += this.getHtmlList(list);

        $(obj).html(html);
    },
    getHtmlList: function (list)
    {
        var html = "";
        for (var i in list)
        {
            html += '<option value="' + i + '">' + list[i] + '</option>';
        }
        return html;
    },
    fromGroupList: function (obj, group_list)
    {
        var html = this.initialCheck(obj);
        for (var g in group_list)
        {
            html += '<optgroup label="' + g + '">';
            html += this.getHtmlList(group_list[g]);
            html += '</optgroup>';
        }

        $(obj).html(html);
    },

    fromKeyPairList: function (obj, list, key, value)
    {
        var html = this.initialCheck(obj);

        html += this.getHtmlKeyPairList(list, key, value);

        $(obj).html(html);
    },
    getHtmlKeyPairList: function (list, key, value)
    {
        if (!key)
        {
            key = this.defaultKey;
        }

        if (!value)
        {
            value = this.defaultValue;
        }

        var html = "";
        for (var i in list)
        {
            var k = list[i][key];
            var v = list[i][value];
            html += '<option value="' + k + '">' + v + '</option>';
        }
        return html;
    },
    fromGroupKeyPairList: function (obj, group_list, key, value)
    {
        var html = this.initialCheck(obj);
        for (var g in group_list)
        {
            html += '<optgroup label="' + g + '">';
            html += this.getHtmlKeyPairList(group_list[g], key, value);
            html += '</optgroup>';
        }

        $(obj).html(html);
    },
};

$.sr.download = {
    start: function (filename, content, content_type)
    {
        var _blob = new Blob([content], {type: content_type});

        var a = document.createElement("a");

        a.download = filename + ".csv";
        a.href = window.URL.createObjectURL(_blob);
        a.style.display = "none";
        document.body.appendChild(a);
        a.click();
        a.remove();
    },
    csv: function (filename, content)
    {
        this.start(filename, content, "text/csv");
    }
};

$.sr.csv = {
    toArray: function (str, delimeter)
    {
        delimeter = (delimeter || ",");
        var objPattern = new RegExp((
                // Delimiters.
                "(\\" + delimeter + "|\\r?\\n|\\r|^)" +
                // Quoted fields.
                "(?:\"([^\"]*(?:\"\"[^\"]*)*)\"|" +
                // Standard fields.
                "([^\"\\" + delimeter + "\\r\\n]*))"), "gi");
        
        // a default empty first row.
        var arrData = [[]];
        
        var arrMatches = null;
        
        while (arrMatches = objPattern.exec(str)) 
        {
            var strMatchedDelimiter = arrMatches[1];
            
            if (strMatchedDelimiter.length && (strMatchedDelimiter != delimeter)) 
            {
                arrData.push([]);
            }
            
            if (arrMatches[2]) 
            {
                var strMatchedValue = arrMatches[2].replace(new RegExp("\"\"", "g"), "\"");
            } 
            else 
            {
                var strMatchedValue = arrMatches[3];
            }
            
            arrData[arrData.length - 1].push(strMatchedValue);
        }
        
        return (arrData);
    },
    combineHeaderToRow : function(array_data, header_keys)
    {
        var data = [], headers = [];
        
        for(var i in array_data)
        {
            var row = array_data[i];
            
            if ( i == 0 )
            {
                headers = row;
                
                for (var h in header_keys)
                {
                    if ( $.inArray(h, headers) === -1)
                    {
                        throw h + " is not found in headers";
                        return null;
                    }
                }
            }
            else
            {
                var record = {};
                
                for (var c in headers)
                {
                    var v = "";
                    if (typeof row[c] != "undefined")
                    {
                        v = row[c];
                    }
                    
                    if (typeof header_keys[headers[c]] != "undefined")
                    {
                        record[header_keys[headers[c]]] = v;
                    }
                }
                
                data.push(record);
            }
        }
        
        return data;
    }
};
jQuery.fn.extend({
    ajaxFileUpload: function (opt)
    {
        var feature = "sr-ajax-file-upload";
        
        if (typeof opt["validator"] == "undefined")
        {
            console.error(feature + " : validator should be pass in options");
            return;
        }
        
        var validator = opt["validator"];
        
        if (!validator instanceof $.sr.file.validator)
        {
            console.error(feature + " : validator should be instance of $.sr.file.validator");
            return;
        }
        
        if (typeof opt["onSuccess"] != "function")
        {
            console.error(feature + " : onSuccess function should be pass in options");
            return;
        }
        
        var settings = $.extend({
            onError : function (msg)
            {
                $.sr.error.msg(msg);
            },
            progress : function(sr_file_block, e)
            {
                var percent = Math.round((e.loaded / e.total) * 100);
                sr_file_block.find(".progress-bar").css("width", percent + "%");
                sr_file_block.find(".progress-bar .sr-only").html(percent + "%");
                sr_file_block.find(".progress-status").html("Sent : " + niceBytes(e.loaded));
            },
            beforeUpload : function(fileObj, xhr, progress_block)
            {
                return true;
            },
        }, opt);
        
        var events = {
            onFileSelect : feature + ".onFileSelect"
        }
        
        function attachEvents(ajax, _section)
        {
            ajax.upload.addEventListener("progress", function(e)
            {
                var percent = Math.round((e.loaded / e.total) * 100);
                _section.find(".progress-bar").css("width", percent + "%");
                _section.find(".progress-bar .sr-only").html(percent + "%");
                _section.find(".progress-status").html("Sent : " + $.sr.niceBytes(e.loaded));

            }, false);

            ajax.upload.addEventListener("error", function(e)
            {
                var status = _section.find(".status");
                status.html("Upload Failed");
                console.error(e);
            }, false);

            ajax.upload.addEventListener("abort", function(e)
            {
                console.log("Upload Aborted");
            }, false);

            ajax.onreadystatechange = function() 
            {
                if (ajax.readyState === 4) 
                {
                    if (_section.length == 0 || ajax.responseText.trim().length == 0)
                    {
                        return;
                    }

                    var status = _section.find(".status");

                    try
                    {
                        var response = JSON.parse(ajax.responseText);
                    }
                    catch(e)
                    {
                        $.sr.error.detail("Error in uploading" , ajax.responseText);
                        status.html("Error");
                        return;
                    }

                    if (response["status"] == "1")
                    {
                        _section.find(".abort").hide();
                        status.addClass("alert alert-success");
                        status.html("Success");

                        settings.onSuccess(response["data"]);
                    }
                    else
                    {
                        status.addClass("alert alert-danger");
                        status.html(response["msg"]);
                    }
                }
            }
        }
        
        this.each(function () 
        {
            var output_target = $(this).data(feature + "-output-target");
            
            if (!output_target)
            {
                var parent = $(this).parent();
                
                if ( parent.children("." + feature + "-output-target").length == 0 )
                {
                    parent.append('<div class="' + feature + '-output-target"></div>');
                }
                
                output_target = parent.children("." + feature + "-output-target").first();
            }
            
            if ($(output_target).length == 0)
            {
                console.error(feature + ": output target not found");
                return;
            }
            
            var display = $(this).data(feature + "-display");
            
            if (display != "table" && display != "div")
            {
                display = "table";
            }
            
            $(this).on(events.onFileSelect, function()
            {
                var xhrs = [];
                
                var files = $(this).prop("files");
                
                for (var i = 0; i < files.length; i++)
                {
                    len++;

                    var file = files[i]; 

                    var filename = file.name.length > 60 ? file.name.substr(0, 50) + "..." : file.name;

                    var x = xhrs.length;
                    x = x ? x - 1 : 0;
                    
                    if (display == "table")
                    {
                        if ($(output_target).find("table." + feature).length == 0)
                        {
                            var html = '<table class="' + feature + '">';
                                html += '<thead>';
                                    html += '<tr>';
                                        html += '<th>#</th>';
                                        html += '<th>File</th>';
                                        html += '<th>Total Size</th>';
                                        html += '<th>Status</th>';
                                    html += '</tr>';
                                html += '</thead>';
                                html += '<tbody>';
                            html += '</table>';

                            $(output_target).html(html);
                        }

                        var len = $(output_target).find("table." + feature).children("tbody").children("tr").length + 1;
                        
                        var html = '<tr class="sr-ajax-file-upload-block">';
                            html += '<td>';
                                html += len + ' <span class="abort" data-xhr-index="' + x + '"><i class="fa fa-times-circle"></i></span>';
                            html += '</td>';
                            html += '<td>';
                                html += '<div class="filename">' + filename + '</div>';
                                html += '<div class="progress">';
                                    html += '<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:0%">';
                                        html += '<span class="sr-only">0% Complete</span>'
                                    html += '</div>';                                
                                html += '</div>';
                                html += '<div class="progress-status"></div>';
                            html += '</td>';
                            html += '<td><span class="total-size">' + $.sr.niceBytes(file.size) + '</span></td>';
                            html += '</td>';
                            html += '<td class="status"></td>';
                        html += '</tr>';

                        $(output_target).find("tbody").append(html);
                    }
                    else
                    {
                        var html = '<div class="sr-ajax-file-upload-block">';
                            html += '<div class="sr-ajax-file-upload-file-info">';
                                html += '<span class="filename">' + filename + '</span>';
                                html += '<span class="total-size"><b>Total : ' + $.sr.niceBytes(file.size) +  '</b>';
                                html += '<span class="abort" data-xhr-index="' + x + '"><i class="fa fa-times-circle"></i></span></span>';
                            html += '</div>';                            
                            html += '<div class="progress">';
                                html += '<div class="progress-bar  progress-bar-info" style="width: 0%"></div>';
                            html += '</div>';
                            html += '<div class="progress-status"></div>';
                            html += '<div class="status"></div>';
                        html += '</div>';
                        
                        $(output_target).append(html);
                    }

                    var progress_block = $(output_target).find(".sr-ajax-file-upload-block").last();

                    var validate_error = "";

                    try
                    {
                        validator.validate(file);
                    }
                    catch(e)
                    {
                        validate_error = e;
                    }
                    
                    if (validate_error.length > 0)
                    {
                        var status = progress_block.find(".status");
                        status.html(validate_error).addClass("alert alert-danger");
                    }
                    else
                    {
                        var ajax = new XMLHttpRequest();
                        attachEvents(ajax, progress_block);
                        ajax.open("POST", opt.url);

                        xhrs.push(ajax);

                        if (settings.beforeUpload(file, ajax, progress_block))
                        {
                            var formdata = new FormData();
                            formdata.append("file", file);
                            ajax.send(formdata);
                        }
                    }
                }
                
                $(output_target).find(".abort").click(function()
                {
                    var i = $(this).data("xhr-index");                    
                    
                    if ( typeof xhrs[i] != "undefined" )
                    {
                        xhrs[i].abort();
                        xhrs.splice(i, 1);
                    }
                    
                    $(this).closest(".sr-ajax-file-upload-block").remove();
                });
            });
            
            $(this).change(function()
            {
                $(this).trigger(events.onFileSelect);
            });
        });
    }
});

$.sr.file = {
    validator : class
    {
        constructor(size, exts) 
        {
            this.size = size;
            this.exts = exts;
        }
        
        validate (file)
        {
            if ( file.size > this.size )
            {
                throw "File Size should be less than " + $.sr.niceBytes(this.size);
            }
            
            var arr = file.name.split(".");
            
            if (arr.length <= 1)
            {
                throw "File extension not found";
            }
            
            var ext = arr[1].trim();
            
            if (typeof this.exts != "undefined" && typeof this.exts != "array")
            {
                if ( $.inArray(ext, this.exts) === -1)
                {
                    throw "Invalid File type : " + ext;
                }
            }
            
            return true;
        }
    },
};

jQuery.fn.extend({
    srDatatable: function ()
    {
        var feature = "sr-data-table";

        return this.each(function ()
        {
            var _table = $(this);

            if (_table.applyOnce(feature))
            {
                _table.find("> thead > tr > th").each(function (index, value)
                {
                    var _th = $(this);
                    var will_clear = _th.getBoolFromData(feature + "-search-clear", false);
                    var will_search = _th.getBoolFromData(feature + "-search", false);
                    var will_info = _th.getBoolFromData(feature + "-info", false);
                    var sort_type = _th.data(feature + "-sort");
                    
                    var html = _th.html();
                    var html_change = false;
                    if (typeof sort_type != "undefined" && sort_type)
                    {
                        html += "<span class='sr-data-table-sort'><i class='fa fa-sort'></i></span>";

                        if (sort_type == "numeric")
                        {
                            if (will_info)
                            {
                                html += '<a href="#" class="info-tooltip" data-placement="bottom" title="Hooray!"><i class="fa fa-info-circle"></i></a>';
                            }
                        }
                        html_change = true;
                    }

                    if (will_search)
                    {
                        html += "<span class='search-icon'><i class='fa fa-search'></i></span><div class='search-block'><input type='text' data-col_index='" + index + "' /></div>";
                        html_change = true;
                    }
                    else if (will_clear)
                    {
                        html += "<span class='search-clear-icon'><i class='fa fa-remove'></i></span>";
                        html_change = true;
                    }

                    if (html_change)
                    {
                        _th.html(html);
                    }
                    
                    if (typeof sort_type != "undefined" && sort_type == "numeric")
                    {
                        _th.find(".info-tooltip").tooltip();
                        _th.find(".info-tooltip").on('show.bs.tooltip', function () {
                            var _th = $(this).closest("th");
                            var index = _th.index();

                            var sum, count;
                            sum = count = 0;
                            _table.find("> tbody > tr").not(".hidden").each(function ()
                            {
                                var _td = $(this).find(">td:eq(" + index + ")");

                                var v = parseFloat(_td.text());
                                if ($.isNumeric(v))
                                {
                                    sum += parseFloat(_td.text());
                                }
                                count++;
                            });

                            _th.find(".info-tooltip").attr("data-original-title", "Sum : " + sum.toFixed(3) + ", Count : " + count);
                        });
                    }

                    if (will_search)
                    {
                        _th.find(".search-icon").click(function ()
                        {
                            var _th = $(this).closest("th");
                            var index = _th.index();

                            var search = _th.find(".search-block input").val().trim().toLowerCase();
                            var hide_counter = 0;
                            _table.find("> tbody > tr").each(function ()
                            {
                                var _td = $(this).find(">td:eq(" + index + ")");
                                if (search)
                                {
                                    var v = _td.text().toLowerCase();

                                    if (v.indexOf(search) < 0)
                                    {
                                        _td.addClass("sr-hide");
                                        hide_counter++;
                                    } 
                                    else
                                    {
                                        _td.removeClass("sr-hide");
                                    }
                                }
                                else
                                {
                                    _td.removeClass("sr-hide");
                                }
                            });


                            if (hide_counter > 0)
                            {
                                _th.find(".search-icon").addClass("active");
                            } 
                            else
                            {
                                _th.find(".search-icon").removeClass("active");
                            }

                            _table.find(">tbody > tr").each(function(t, tr)
                            {
                                if ( $(tr).find("> td.sr-hide").length > 0)
                                {
                                    $(tr).addClass("hidden");
                                }
                                else
                                {
                                    $(tr).removeClass("hidden");
                                }
                            });                            
                        });

                        _th.find(".search-block input").keyup(function (e)
                        {
                            var old_val = $(this).data("old-val");
                            var searching = _th.getBoolFromData("searching", false);
                            
                            if (!searching && $(this).val() != old_val)
                            {
                                _th.data("searching", true);
                                $(this).data("old-val", $(this).val());
                                
                                setTimeout(function () 
                                {
                                    console.log("searching..");
                                    
                                    _th.find(".search-icon").trigger("click");
                                    _th.data("searching", false);
                                }, 300);
                            }
                        });
                    }

                    if (will_clear)
                    {
                        _th.find(".search-clear-icon").click(function ()
                        {
                            _table.children("thead").find(".search-block").find("input").val("");
                            _table.children("thead").find(".search-icon").removeClass("active");

                            _table.find(">tbody > tr > td").removeClass("sr-hide");
                            _table.find(">tbody > tr").removeClass("hidden");
                        });
                    }

                    if (typeof sort_type != "undefined" && sort_type)
                    {
                        _th.find(".sr-data-table-sort").click(function ()
                        {
                            var _th = $(this).closest("th");
                            var index = _th.index();

                            var sort_type = _th.attr("data-sort");
                            var sort_dir = "ASC";

                            if ($(this).find(".fa-sort-asc").length > 0)
                            {
                                sort_dir = "DESC";
                            }

                            var list = [];

                            _table.find("> tbody > tr").not(".hidden").each(function (row_index, tr)
                            {
                                var _td = $(tr).find(">td:eq(" + index + ")");
                                var text = _td.text().trim();
                                if (sort_type == "numeric")
                                {
                                    text = parseFloat(text);
                                }
                                list.push({row: row_index, text: text});
                            });

                            list.sort(function(a, b)
                            {
                                if (sort_dir == "ASC")
                                {
                                    if (a.text < b.text)
                                    {
                                        return -1;
                                    }
                                    if (a.text > b.text)
                                    {
                                        return 1;
                                    }
                                }
                                else
                                {
                                    if (a.text < b.text)
                                    {
                                        return 1;
                                    }
                                    if (a.text > b.text)
                                    {
                                        return -1;
                                    }
                                }

                                return 0;
                            });

                            var trs = _table.find(">tbody > tr");

                            _table.find(">tbody").html("");

                            console.log(list);

                            for(var i in list)
                            {
                                var obj = list[i];
                                _table.find(">tbody").append(trs[obj.row]);
                            }
                            
                            if (sort_dir == "ASC")
                            {
                                $(this).html('<i class="fa fa-sort-asc"></i>');
                            }
                            else
                            {
                                $(this).html('<i class="fa fa-sort-desc"></i>');
                            }
                        });
                    }
                });
            }
        });
    },
});