 /* 
  * @author     Hardeep
  */
 jQuery.fn.extend({
     sentance: function() {
         return this.each(function() {
             if ($(this).tagName() == "input") {
                 var v = $(this).val();

                 if (v.length > 0) {
                     $(this).val(v.charAt(0).toUpperCase() + v.slice(1));
                 }
             } else {
                 var v = $(this).html();

                 if (v.length > 0) {
                     $(this).html(v.charAt(0).toUpperCase() + v.slice(1));
                 }
             }
         });
     },
     tagName: function() {
         return this.prop("tagName").toLowerCase();
     },
     chkSelectAll: function() {
         return this.each(function() {
             if ($(this).hasClass("chkSelectAll-applied")) {
                 return true;
             }

             $(this).addClass("chkSelectAll-applied");

             var _this = $(this);
             var target = $(this).attr("data-href");

             $(this).change(function() {
                 $(target).prop("checked", this.checked);

                 if ($(target).hasClass("chkSelectAll-applied")) {
                     $(target).trigger("change");
                 }
             });

             $(target).change(function() {
                 var t_c = $(target).length;
                 var c_c = $(target).filter(":checked").length;
                 var checked = t_c == c_c;
                 _this.prop("checked", checked);


             });

             var checked = $(target).length == $(target).filter(":checked").length;
             _this.prop("checked", checked);
         });
     },
     cssToggler: function() {
         return this.each(function() {
             if ($(this).hasClass("cssToggler-applied")) {
                 return true;
             }

             $(this).addClass("cssToggler-applied");

             $(this).click(function() {
                 var obj = $($(this).data("toggler-target"));
                 var css = $(this).data("toggler-class");
                 obj.toggleClass(css);
             });
         });
     },
     checkboxCssToggler: function() {
         return this.each(function() {
             if ($(this).hasClass("checkboxCssToggler-applied")) {
                 return true;
             }

             $(this).addClass("checkboxCssToggler-applied");

             $(this).change(function() {
                 var obj = $($(this).data("toggler-target"));
                 var css = $(this).data("toggler-class");
                 if (this.checked) {
                     obj.addClass(css);
                 } else {
                     obj.removeClass(css);
                 }
             });

             $(this).trigger("change");
         });
     },
     copyText: function() {
         return this.each(function() {
             if ($(this).hasClass("copy-applied")) {
                 return true;
             }

             $(this).addClass("copy-applied");

             $(this).click(function() {
                 var obj = $($(this).data("copy-target"));
                 var $temp = $("<input>");
                 $("body").append($temp);
                 $temp.val($(obj).text().trim()).select();
                 document.execCommand("copy");
                 $temp.remove();
             });
         });
     },
     copyValue: function() {
         return this.each(function() {
             if ($(this).hasClass("copy-applied")) {
                 return true;
             }

             $(this).addClass("copy-applied");

             $(this).click(function() {
                 var obj = $($(this).data("copy-target"));
                 $(obj).select();
                 document.execCommand("copy");
             });
         });
     },
     ajaxLoader: function() {
         return this.each(function() {
             if ($(this).hasClass("ajaxLoader-applied")) {
                 return true;
             }

             $(this).addClass("ajaxLoader-applied");

             $(this).click(function() {
                 var obj = $($(this).data("loader-target"));

                 if ($(obj).hasClass("ajaxLoader-load")) {
                     return;
                 }

                 var href = $(this).data("loader-href");

                 if (!href) {
                     console.error("href or data-href not found");
                     return;
                 }

                 $(obj).load(href, function() {
                     $(obj).addClass("ajaxLoader-load");
                     $(obj).find("script").each(function() {
                         //eval($(this).html());
                     });
                 });

             });

             var autoload = $(this).data("loader-autoload");

             if (autoload == "1") {
                 $(this).trigger("click", { trigger: 1 });
             }
         });
     },
     ajaxifyLink: function(callback) {
         return this.each(function() {
             if ($(this).hasClass("ajaxifyLink-applied")) {
                 return true;
             }

             $(this).addClass("ajaxifyLink-applied");

             $(this).click(function(e) {
                 var href = $(this).attr("href");

                 $.get(href, function(response) {
                     try {
                         response = JSON.parse(response);
                     } catch (e) {
                         bootbox.alert(response);
                         return;
                     }

                     if (typeof callback == "function") {
                         callback(response);
                     } else {
                         bootbox.alert(response["msg"]);
                     }
                 });

                 return false;
             });
         });
     },
     moreText: function() {
         return this.each(function() {
             if ($(this).hasClass("moreText-applied")) {
                 return true;
             }

             $(this).addClass("moreText-applied");

             var charlen = $(this).data("more-text-char-len");

             var content = $(this).text().trim();

             if (content.length > charlen) {
                 var c = content.substr(0, charlen);

                 var html = '<span class="less-text-block">' + c + '<br/><a class="more-text-opener">...More</a></span>';
                 html += "<span class='more-text-block hidden'>" + content + "<br/><a class='less-text-opener'>..Less</a></span>";

                 $(this).html(html);

                 $(this).find(".more-text-opener").click(function() {
                     $(this).parent().parent().find(".more-text-block").removeClass("hidden");
                     $(this).parent().addClass("hidden");
                 });

                 $(this).find(".less-text-opener").click(function() {
                     $(this).parent().parent().find(".less-text-block").removeClass("hidden");
                     $(this).parent().addClass("hidden");
                 });
             }
         });
     },
     tableTemplate: function(opt) {
         if (typeof opt == "undefined") {
             opt = {};
         }

         if (typeof opt.brace_type == "undefined") {
             opt.brace_type = "{{";
         }

         return this.each(function() {
             var _table = $(this);

             var minimum_row = _table.data("template-min-row");
             if (jQuery.type(minimum_row) == "undefined") {
                 minimum_row = 0;
             }

             $(this).bind("refresh", function() {
                 _table.find("tbody tr .row-deleter").show();
                 _table.find("tbody tr").each(function(a, tr) {
                     if (a < minimum_row + 1) {
                         $(tr).find(".row-deleter").hide();
                     }
                 });
             });

             $(this).on("click", ".row-adder:first", function(e, e_opt) {
                 var $tr = _table.find("> tbody > tr:last");
                 var last_id = $tr.attr("data-row-id");
                 if (typeof last_id == "undefined") {
                     last_id = 0;
                 } else {
                     last_id = parseInt(last_id);
                 }
                 last_id += 1;

                 var last_i = $tr.attr("data-row-i");
                 if (typeof last_i == "undefined") {
                     last_i = 0;
                 } else {
                     last_i = parseInt(last_i);
                 }
                 last_i += 1;

                 if (typeof opt != "undefined" && typeof opt.beforeRowAdd == "function") {
                     var result = opt.beforeRowAdd({
                         event_opt: e_opt,
                         table: _table,
                         id: last_id,
                         i: last_i
                     });

                     if (result == false) {
                         return result;
                     }
                 }

                 var template_row = _table.find("tr.template-row:first").html();

                 var id_holder = "{{id}}",
                     i_holder = "{{i}}";
                 if (opt.brace_type == "{") {
                     id_holder = "{id}";
                     i_holder = "{i}";
                 } else if (opt.brace_type == "[") {
                     id_holder = "[id]";
                     i_holder = "[i]";
                 } else if (opt.brace_type == "[[") {
                     id_holder = "[[id]]";
                     i_holder = "[[i]]";
                 } else if (opt.brace_type == "[{") {
                     id_holder = "[{id}]";
                     i_holder = "[{i}]";
                 } else if (opt.brace_type == "{[") {
                     id_holder = "{[id]}";
                     i_holder = "{[i]}";
                 }
                 var tr_html = String.replaceAll(id_holder, last_id, template_row);
                 tr_html = String.replaceAll(i_holder, last_i, tr_html);

                 var html = "<tr data-row-id=" + last_id + " data-row-i=" + last_i + ">";
                 html += tr_html;
                 html += "</tr>";

                 _table.append(html);

                 _table.trigger("refresh");

                 var last_tr = _table.find(" > tbody > tr:last");
                 if (typeof opt != "undefined" && typeof opt.onRowAdd == "function" && last_tr.length > 0 && !last_tr.hasClass(".template-row")) {
                     opt.onRowAdd(last_tr, {
                         event_opt: e_opt,
                         table: _table,
                         id: last_id,
                         i: last_i
                     });
                 }
             });

             $(this).on("click", "> tbody > tr > td .row-deleter", function(e, e_opt) {
                 var tr = $(this).closest("tr");

                 var last_id = tr.attr("data-row-id");
                 if (typeof last_id == "undefined") {
                     last_id = 0;
                 } else {
                     last_id = parseInt(last_id);
                 }
                 last_id += 1;

                 var last_i = tr.attr("data-row-i");
                 if (typeof last_i == "undefined") {
                     last_i = 0;
                 } else {
                     last_i = parseInt(last_i);
                 }
                 last_i += 1;

                 var result = true;
                 if (typeof opt != "undefined" && typeof opt.beforeRowDel == "function") {
                     result = opt.beforeRowDel(tr, {
                         event_opt: e_opt,
                         table: _table,
                         id: last_id,
                         i: last_i
                     });
                 }

                 if (result != false) {
                     tr.remove();

                     if (typeof opt != "undefined" && typeof opt.onRowDel == "function") {
                         opt.onRowDel({
                             table: _table,
                             id: last_id,
                             i: last_i
                         });
                     }
                 }
             });

             $(this).on("click", ".row-up", function(e, e_opt) {
                 var _tr = $(this).closest("tr");
                 var index = _tr.index();
                 if (index > 0) {
                     index--;
                     _tr.insertBefore(_table.find("> tbody > tr:eq(" + index + ")"));
                 }
             });

             $(this).on("click", ".row-down", function(e, e_opt) {
                 var _tr = $(this).closest("tr");
                 var index = _tr.index();
                 if (index < _table.find("> tbody > tr").length - 1) {
                     index++;
                     _tr.insertAfter(_table.find("> tbody > tr:eq(" + index + ")"));
                 }
             });

             var tr_count = _table.find("tbody tr").length - 1;

             if (tr_count < minimum_row) {
                 for (var i = tr_count; i < minimum_row; i++) {
                     _table.find(".row-adder:first").trigger("click", { trigger: 1 });
                 }
             } else {
                 _table.trigger("refresh");
             }
         });
     },
     valueCal: function() {
         return this.each(function() {
             var _this = $(this);
             var exp = $(this).data("expression");

             //console.log(exp);
             if (jQuery.type(exp) == "string") {
                 var oprands = String.containsBetween(exp, "[", "]");

                 for (var i in oprands) {
                     if ($(oprands[i]).length > 0) {
                         var tag = $(oprands[i]).tagName();
                         var has_cls = $(oprands[i]).hasClass("valueCal-event-applied");
                         if (!has_cls) {
                             $(oprands[i]).addClass("valueCal-event-applied");
                             if (tag == "input") {
                                 $(oprands[i]).blur(function() {
                                     _this.valueCal();
                                 });
                             }

                             if (tag == "select") {
                                 $(oprands[i]).change(function() {
                                     _this.valueCal();
                                 });
                             }
                         }

                         var v = $(oprands[i]).val();
                         if (!$.isNumeric(v)) {
                             v = 0;
                         }

                         var v = parseInt(v);
                         exp = exp.replace("[" + oprands[i] + "]", v);
                     } else {
                         exp = exp.replace("[" + oprands[i] + "]", 0);
                     }
                 }
             }

             //console.log(exp);
             //console.log(eval(exp));

             if ($(this).tagName() == "input") {
                 $(this).val(eval(exp));
             } else {
                 $(this).html(eval(exp));
             }
         });
     },
     jsExportCsv: function() {
         return this.each(function() {
             if ($(this).hasClass("jsExportCsv-applied")) {
                 return true;
             }

             $(this).addClass("jsExportCsv-applied");

             $(this).click(function() {
                 var table = $(this).attr("data-js-export-csv-table");

                 if (typeof table == "undefined") {
                     console.error("jsExportCsv : table attr not found");
                     return false;
                 }

                 if ($(table).length == 0) {
                     console.error("jsExportCsv : " + table + " not found");
                     return false;
                 }

                 var filename = $(this).attr("data-js-export-csv-filename");

                 if (typeof filename == "undefined") {
                     console.error("jsExportCsv : filename attr not found");
                     return false;
                 }

                 table_to_csv($(table), filename);
             });

         });
     },
     readCSV: function(callback) {
         return this.each(function() {
             if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
                 console.error('The File APIs are not fully supported in this browser.');
                 return;
             }

             if ($(this).hasClass("readCSVtoJSON-applied")) {
                 return true;
             }

             $(this).addClass("readCSVtoJSON-applied");

             $(this).change(function() {

                 var filename = $(this).val();
                 var ext = filename.split(".");
                 ext = ext[1].trim().toLowerCase();

                 if (ext != "csv") {
                     if (typeof callback == "function") {
                         callback(false, { msg: "Please select csv file" });
                     }
                     return;
                 }

                 var fileReader = new FileReader();

                 fileReader.onload = function() {
                     var data = fileReader.result;
                     callback(true, { data: csv2array(data) });
                 };

                 var files = $(this).prop("files");
                 fileReader.readAsText(files[0]);
             });
         });
     },
     invalidURLChar: function() {
         var invalid_char = ["`", "~", "!", "@", "#", "$", "%", "^", "&", "*", "+", "=", "{", "}", "[", "]", ":", ";", '"', "'", "<", ">", ",", ".", "?", "/", "\\", "|"];

         return this.each(function() {
             if ($(this).hasClass("invalidURLChar-applied")) {
                 return true;
             }

             $(this).addClass("invalidURLChar-applied");

             $(this).keydown(function(event) {
                 var $span = $(this).parent().find(".invalidURLChar-error-message");

                 if ($span.length == 0) {
                     $(this).parent().append('<span class="invalidURLChar-error-message error-message">&#9679 Invalid Character</span>');
                     $span = $(this).parent().find(".invalidURLChar-error-message");
                 }

                 if (invalid_char.indexOf(event.key) >= 0) {
                     $span.show();
                     return false;
                 } else {
                     $span.hide();
                 }

                 return true;
             });
         });
     },
     invalidSqlChar: function() {
         var invalid_char = ["`", "~", "!", "#", "$", "%", "&", "=", ":", ";", '"', "'", "\\", "|"];

         return this.each(function() {
             if ($(this).hasClass("invalidSqlChar-applied")) {
                 return true;
             }

             $(this).addClass("invalidSqlChar-applied");

             $(this).keydown(function(event) {
                 var $span = $(this).parent().find(".invalidSqlChar-error-message");

                 if ($span.length == 0) {
                     $(this).parent().append('<span class="invalidSqlChar-error-message error-message">&#9679 Invalid Character</span>');
                     $span = $(this).parent().find(".invalidSqlChar-error-message");
                 }

                 if (invalid_char.indexOf(event.key) >= 0) {
                     $span.show();
                     return false;
                 } else {
                     $span.hide();
                 }

                 return true;
             });
         });
     },
     charLimitRequired: function() {
         return this.each(function() {
             if ($(this).hasClass("charLimitRequired-applied")) {
                 return true;
             }

             if (!$(this).data("char-required")) {
                 console.error("charLimitRequired char required not set");
                 return;
             }

             if (!$(this).data("char-limit")) {
                 console.error("charLimitRequired char limit not set");
                 return;
             }

             $(this).addClass("charLimitRequired-applied");

             var require = parseInt($(this).attr("data-char-required"));
             var limit = parseInt($(this).attr("data-char-limit"));

             $(this).parent().append('<span class="charLimitRequired-info help-block"></span>');
             var span_info = $(this).parent().find(".charLimitRequired-info");

             $(this).parent().append('<span class="charLimitRequired-error-message error-message"></span>');
             var span_error = $(this).parent().find(".charLimitRequired-error-message");

             $(this).keydown(function(event) {
                 var len = $(this).val().length;
                 if (len > limit) {
                     span_error.html("Max Limit is " + limit);
                     span_error.show();
                     return false;
                 } else {
                     console.log(len);
                     span_info.html("Min. : " + require + ", Max. : " + limit + ", Characters : " + len);
                     span_error.hide();
                 }

                 return true;
             });

             $(this).blur(function(event) {
                 if ($(this).val().length < require) {
                     span_error.html("Minimum character should be " + require);
                     span_error.show();
                     return false;
                 } else {
                     span_error.hide();
                 }
             });
         });
     },
     toggleTinyField: function() {
         return this.each(function() {
             if ($(this).hasClass("toggleTinyField-applied")) {
                 return true;
             }

             $(this).addClass("toggleTinyField-applied");

             $(this).click(function() {
                 var _this = $(this);
                 var href = $(this).attr("href");
                 var field = $(this).attr("data-field");
                 var value = $(this).attr("data-value");

                 if (!href) {
                     console.error("href not found");
                     return;
                 }

                 if (!field) {
                     console.error("data-field not found");
                     return;
                 }

                 if (!value) {
                     console.error("data-value not found");
                     return;
                 }

                 var request = {};
                 request[field] = value;

                 $.post(href, request, function(data) {
                     try {
                         data = JSON.parse(data);
                     } catch (e) {
                         bootbox.alert(data);
                         return;
                     }

                     if (data["status"] == "1") {
                         _this.attr("data-value", data[field]);
                         if (data[field] == "1") {
                             _this.html('<i class="fa fa-check-circle-o font-green-meadow icon"></i>');
                         } else {
                             _this.html('<i class="fa fa-times-circle-o font-red-sunglo icon"></i>')
                         }
                     } else {
                         var msg = typeof data["msg"] != "undefined" ? data["msg"] : "Could not change status";
                         bootbox.alert(msg);
                     }
                 });

                 return false;
             });
         });
     },
     ajaxFileUpload: function(opt) {
         return this.each(function() {
             if (typeof opt.progressSection == "undefined") {
                 console.error("progressSection is set in options");
                 return;
             }

             if (typeof opt.url == "undefined") {
                 console.error("url is set in options");
                 return;
             }

             if (typeof opt.callback != "function") {
                 console.error("callback function is not defined in options");
                 return;
             }

             if (typeof opt.display == "undefined") {
                 opt.display = "table";
             }

             var _section = $(opt.progressSection);

             var xhr = [];

             function attachEvents(ajax, i, callback) {
                 ajax.upload.addEventListener("progress", function(e) {
                     var percent = Math.round((e.loaded / e.total) * 100);
                     _section.find(".file-block-" + i).find(".progress-bar").css("width", percent + "%");
                     _section.find(".file-block-" + i).find(".progress-bar .sr-only").html(percent + "%");
                     _section.find(".file-block-" + i).find(".progress-status").html("Sent : " + niceBytes(e.loaded));

                 }, false);

                 ajax.upload.addEventListener("error", function(e) {
                     console.error("Upload Failed");
                     console.error(e);
                 }, false);

                 ajax.upload.addEventListener("abort", function(e) {
                     console.log("Upload Aborted");
                 }, false);

                 ajax.onreadystatechange = function() {
                     if (ajax.readyState === 4) {
                         if (_section.find(".file-block-" + i).length == 0) {
                             return;
                         }

                         var $status = _section.find(".file-block-" + i).find(".server-status");

                         try {
                             var response = JSON.parse(ajax.responseText);
                         } catch (e) {
                             bootbox.alert(ajax.responseText);
                             $status.html("Error");
                             return;
                         }

                         if (response["status"] == "1") {
                             _section.find(".file-block-" + i).find(".abort").hide();
                             $status.addClass("alert alert-success");
                             $status.html("Success");
                             callback(i, response["data"]);
                         } else {
                             $status.addClass("alert alert-danger");
                             $status.html(response["msg"]);
                         }
                     }
                 }
             }

             $(this).bind("change", function() {
                 var files = $(this).prop("files");

                 var html = '';

                 if (opt.display == "table") {
                     html += '<table class="progress-bar-block table table-striped table-bordered order-column">';
                     html += '<thead>';
                     html += '<tr>';
                     html += '<th>#</th>';
                     html += '<th>File</th>';
                     html += '<th>Total Size</th>';
                     html += '<th>Status</th>';
                     html += '</tr>';
                     html += '</thead>';

                     html += '<tbody>';
                     for (var i = 0; i < files.length; i++) {
                         var file = files[i];

                         var filename = file.name.length > 60 ? file.name.substr(0, 50) + "..." : file.name;

                         html += '<tr class="file-block file-block-' + i + '">';
                         html += '<td>';
                         html += (i + 1) + ' <span class="abort" data-xhr-index="' + i + '"><i class="fa fa-times-circle"></i></span>';
                         html += '</td>';
                         html += '<td>' + filename;
                         html += '<div class="progress">';
                         html += '<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:0%">';
                         html += '<span class="sr-only">0% Complete</span>'
                         html += '</div>';
                         html += '</div>';
                         html += '<div class="progress-status"></div>';
                         html += '</td>';
                         html += '<td>' + niceBytes(file.size) + '</td>';
                         html += '</td>';
                         html += '<td class="server-status"></td>';
                         html += '</tr>';
                     }

                     html += '</tbody>';
                     html += "</table>";
                 } else if (opt.display == "column") {
                     for (var i = 0; i < files.length; i++) {
                         var file = files[i];

                         var filename = file.name.length > 60 ? file.name.substr(0, 50) + "..." : file.name;

                         html += '<div class="progress-group file-block file-block-' + i + '">';
                         html += '<div>';
                         html += '<span class="progress-text">' + filename + '</span>';
                         html += '<span class="progress-number"><b>Total : ' + niceBytes(file.size) + '</b><span class="abort" data-xhr-index="' + i + '"><i class="fa fa-times-circle"></i></span></span>';
                         html += '</div>';
                         html += '<span class="progress-status"></span>';
                         html += '<div class="progress">';
                         html += '<div class="progress-bar  progress-bar-info" style="width: 0%"></div>';
                         html += '</div>';
                         html += '</div>';
                     }
                 }

                 _section.html(html);

                 _section.find(".abort").click(function() {
                     var i = $(this).attr("data-xhr-index");
                     $(this).closest(".file-block").remove();
                     xhr[i].abort();
                 });

                 for (var i = 0; i < files.length; i++) {
                     var file = files[i];

                     var ajax = new XMLHttpRequest();
                     attachEvents(ajax, i, opt.callback);
                     ajax.open("POST", opt.url);
                     xhr.push(ajax);

                     var formdata = new FormData();
                     formdata.append("file", file);
                     ajax.send(formdata);
                 }
             });

         });
     },
 });