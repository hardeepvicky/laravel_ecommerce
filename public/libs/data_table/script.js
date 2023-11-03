/***
 * Author : Hardee Singh
 * Email : hardeepvicky1@gmail.com
 * Depends : constants, jquery, jquery-extend, fontawesome
 */

jQuery.fn.extend({
    dataTable: function ()
    {
        const feature = "data-table";
        const css_classes = {
            search_opener : 'search-icon',
            search_clear : 'search-clear-icon',
            search_block : 'search-block',
            search_input : 'search-input',
            search_all_clear : 'search-all-clear-icon',
            will_hide : "will-hide"
        };

        function log(msg)
        {
            msg = "data-table : " + msg;

            console.log(msg);
        }

        return this.each(function ()
        {
            var _table = $(this);

            if (_table.applyOnce(feature))
            {
                _table.find("> thead > tr > th").each(function (index, value)
                {
                    var _th = $(this);
                    var will_all_clear = _th.getBoolFromData("all-clear", false);
                    var will_search = _th.getBoolFromData("search", false);
                    var will_info = _th.getBoolFromData("info", false);
                    var sort_type = _th.getBoolFromData("sort", "");

                    var old_html = _th.html();

                    var new_html = old_html;

                    /*
                    if (sort_type)
                    {
                        var icon = constants.fontawsome.icon.sort;
                        html += `<span class="data-table-sort">
                                    <i class="${icon}"></i>
                                </span>`;

                        if (sort_type == "numeric")
                        {
                            if (will_info)
                            {
                                var icon = constants.fontawsome.icon.info;
                                html += `<a href="#" class="info-tooltip" data-placement="bottom" title="">
                                            <i class="${icon}"></i>
                                        </a>`;
                            }
                        }
                        html_change = true;
                    }
                    */

                    if (will_search)
                    {
                        var icon = constants.fontawsome.icon.search;
                        var icon2 = constants.fontawsome.icon.cross;
                        new_html +=
                            `
                            <div class="${css_classes.search_block}">
                                <input class="${css_classes.search_input}" type="text" data-col-index="${index}"/>                            
                                <div class="search-right-icons">
                                    <span class="${css_classes.search_opener}" data-col-index="${index}">
                                        <i class="${icon}"></i>
                                    </span>
                                    <span class="${css_classes.search_clear}" data-col-index="${index}">
                                        <i class="${icon2}"></i>
                                    </span>
                                </div>
                            </div>
                        `;
                    }                    

                    if (old_html.length != new_html.length)
                    {
                        //means apply new html and attch events on new html
                        _th.html(new_html);

                        if (will_search)
                        {
                            function search_apply(col_index)
                            {
                                log(`Col Index : ${col_index}`);

                                var _th = _table.find(`> thead > tr > th:eq(${col_index})`);

                                var search_text = _th.find(`.${css_classes.search_input}`).val();

                                search_text = search_text.trim().toLowerCase();

                                log(`Search Text : ${search_text}`);

                                _table.find("> tbody > tr").each(function ()
                                {
                                    var _td = $(this).find(`> td:eq(${col_index})`);
                                    if (search_text)
                                    {
                                        var _td_text = _td.text().toLowerCase();

                                        if (_td_text.indexOf(search_text) < 0)
                                        {
                                            _td.addClass(css_classes.will_hide);                                            
                                        }
                                        else
                                        {
                                            _td.removeClass(css_classes.will_hide);
                                        }
                                    }
                                    else
                                    {
                                        _td.removeClass(css_classes.will_hide);
                                    }
                                });

                                _table.find('> tbody > tr').removeClass("hidden");
                                _table.find('> tbody > tr').has(`td.${css_classes.will_hide}`).addClass("hidden");
                            }

                            _th.find(`.${css_classes.search_opener}`).click(function ()
                            {
                                var selector = _th.find(`.${css_classes.search_block}`);

                                selector.toggleClass("hidden");
                            });

                            _th.find(`.${css_classes.search_input}`).keyup(function (event)
                            {
                                var keycode = (event.keyCode ? event.keyCode : event.which);

                                var col_index = $(this).data("col-index");

                                if (keycode == 13)
                                {
                                    search_apply(col_index);
                                }

                                if (keycode == 27)
                                {
                                    $(this).val("");
                                    
                                    search_apply(col_index);

                                    var search_block = $(this).parent();

                                    search_block.addClass("hidden");
                                }
                            });

                            _th.find(`.${css_classes.search_clear}`).click(function ()
                            {
                                var search_input = $(this).closest("th").find(`.${css_classes.search_input}`);
                                search_input.val("");

                                var col_index = $(this).data("col-index");
                                search_apply(col_index);

                                var search_block = $(this).closest("th").find(`.${css_classes.search_block}`); 
                                search_block.addClass("hidden");
                            });
                        }                        
                    }

                    /*
                    if (sort_type == "numeric")
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

                    
                        /*
                        _th.find(`.${css_classes.search_opener}`).click(function ()
                        {
                            var _th = $(this).closest("th");
                            var index = _th.index();

                            var search_input = _th.find(`.${css_classes.search_input}`);

                            var search_text = search_input.val().trim().toLowerCase();

                            console.log("search_text : " + search_text);

                            var hide_counter = 0;
                            _table.find("> tbody > tr").each(function ()
                            {
                                var _td = $(this).find(">td:eq(" + index + ")");
                                if (search_text)
                                {
                                    var v = _td.text().toLowerCase();

                                    if (v.indexOf(search_text) < 0)
                                    {
                                        _td.addClass(css_classes.will_hide);
                                        hide_counter++;
                                    }
                                    else
                                    {
                                        _td.removeClass(css_classes.will_hide);
                                    }
                                }
                                else
                                {
                                    _td.removeClass(css_classes.will_hide);
                                }
                            });


                            if (hide_counter > 0)
                            {
                                _th.find(`.${css_classes.search_opener}`).addClass("active");
                            }
                            else
                            {
                                _th.find(`.${css_classes.search_opener}`).removeClass("active");
                            }

                            _table.find(">tbody > tr").each(function(t, tr)
                            {
                                if ( $(tr).find(`.${css_classes.will_hide}`).length > 0)
                                {
                                    $(tr).hide();
                                }
                                else
                                {
                                    $(tr).show();
                                }
                            });
                        });

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

                    if (sort_type)
                    {
                        _th.find(".data-table-sort").click(function ()
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
                    */
                });
            }
        });
    },
});