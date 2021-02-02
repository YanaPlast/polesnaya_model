"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Review = /*#__PURE__*/function () {
    _createClass(Review, [{
        key: "html_template",
        value: function html_template(item) {
            return " <div class=\"item\">\n                    <a class=\"fancybox-gallery\" data-fancybox=\"otzyvy\" href=\"".concat(item.src, "\">\n                        <picture>\n                            <img class=\"\" src=\"").concat(item.src, "\" alt=\"\"/>\n                        </picture>                    \n                    </a>          \n                    <p class=\"info\"><span class=\"name\">\"").concat(item.name, "\"</span>, <span class=\"sphere\">").concat(item.sfera, "</span></p>\n                </div>");
        }
    }]);

    function Review(el) {
        var _this = this;

        _classCallCheck(this, Review);

        if (el.length) {
            this.el = el;
            this.grid = el.find('*[data-role="grid"]');
            this.count_default = 12;
            this.count_upload = 4;
            this.items = [];
            this.count = 0;
            this.load();
            $('body').on('click', '*[data-role="btn_more"]', function (e) {
                _this.add(_this.count_upload);

                if (_this.items.length === _this.count) {
                    $(e.currentTarget).addClass('hidden');
                }
            });
        }
    }

    _createClass(Review, [{
        key: "add",
        value: function add(count_add) {
            var total = 0;

            for (var i = this.count; i <= this.items.length; i++) {
                var item = this.items[i];
                if (total === count_add) return;
                var html = this.html_template(item);
                this.grid.append(html);
                this.count++;
                total++;
            }
        }
    }, {
        key: "load",
        value: function load() {
            var _this2 = this;

            $.ajax({
                url: this.el.attr('data-url'),
                success: function success(data) {
                    _this2.grid.html('');

                    _this2.items = data;

                    _this2.add(_this2.count_default);
                }
            });
        }
    }]);

    return Review;
}();

var _Review;

_Review = new Review($('*[data-role="Review"]'));