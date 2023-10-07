/**
 * @created 07-Oct-2023
 * @author Hardeep Singh
 */

/** ------------------------ BASIC EXTEND ----------------------- */
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

/** ------------------ ADVANCE EXTEND --------------------------- */

jQuery.fn.extend({
    clearForm : function()
    {
        return this.each(function ()
        {
            if ($(this).tagName() != "form")
            {
                console.error("clearForm can be only on form tag");
                return false;
            }

            $(this).find(':input').not(':button, :submit, :reset, :hidden').val('');
            $(this).prop('checked', false);
            $(this).prop('selected', false);
        });
    },
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

$.sr = {

};

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
    },

};