/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};

;// CONCATENATED MODULE: ./assets/js/shortcodes/globals.js


/* global globalThis, jQuery, yith_wcan_shortcodes, accounting */
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var $ = jQuery,
  // we can do this as WebPack will compact all together inside a closure.
  $body = $('body'),
  globals_block = function block($el) {
    var _yith_wcan_shortcodes;
    if (typeof $.fn.block === 'undefined') {
      return;
    }
    var background = '#fff center center no-repeat';
    if ('undefined' !== typeof yith_wcan_shortcodes && (_yith_wcan_shortcodes = yith_wcan_shortcodes) !== null && _yith_wcan_shortcodes !== void 0 && _yith_wcan_shortcodes.loader) {
      background = "url('".concat(yith_wcan_shortcodes.loader, "') ").concat(background);
    }
    $el.block({
      message: null,
      overlayCSS: {
        background: background,
        opacity: 0.7
      }
    });
  },
  globals_unblock = function unblock($el) {
    if (typeof $.fn.unblock === 'undefined') {
      return;
    }
    $el.unblock();
  },
  serialize = function serialize($el, _ref) {
    var formatName = _ref.formatName,
      filterItems = _ref.filterItems;
    var result = {},
      inputs = $el.find(':input').not('[disabled]');
    if (typeof filterItems === 'function') {
      inputs = inputs.filter(filterItems);
    }
    inputs.each(function () {
      var t = $(this),
        name = t.attr('name'),
        value;
      if (!name) {
        return;
      }

      // removes ending brackets, since are not needed
      name = name.replace(/^(.*)\[]$/, '$1');

      // offers additional name formatting from invoker
      if (typeof formatName === 'function') {
        name = formatName(name);
      }

      // retrieve value, depending on input type
      if (t.is('[type="radio"]') && !t.is(':checked')) {
        return;
      }
      value = t.val();

      // if name is composite, try to recreate missing structure
      if (-1 !== name.indexOf('[')) {
        var components = name.split('[').map(function (c) {
            return c.replace(/[\[, \]]/g, '');
          }),
          firstComponent = components.shift(),
          newItem = components.reverse().reduce(function (res, key) {
            return _defineProperty({}, key, res);
          }, value);
        if (typeof result[firstComponent] === 'undefined') {
          result[firstComponent] = newItem;
        } else {
          result[firstComponent] = $.extend(true, result[firstComponent], newItem);
        }
      }
      // else simply append value to result object
      else {
        result[name] = value;
      }
    });
    return result;
  },
  removeHierarchyFromString = function removeHierarchyFromString(value) {
    return value.replace(/^(.*>)([^>]+)$/, '$2').replace('&amp;', '&').trim();
  };

;// CONCATENATED MODULE: ./assets/js/shortcodes/modules/yith-wcan-filter.js


/* global globalThis, jQuery, yith_wcan_shortcodes, accounting */
function yith_wcan_filter_typeof(o) { "@babel/helpers - typeof"; return yith_wcan_filter_typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, yith_wcan_filter_typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, yith_wcan_filter_toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function yith_wcan_filter_defineProperty(e, r, t) { return (r = yith_wcan_filter_toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function yith_wcan_filter_toPropertyKey(t) { var i = yith_wcan_filter_toPrimitive(t, "string"); return "symbol" == yith_wcan_filter_typeof(i) ? i : i + ""; }
function yith_wcan_filter_toPrimitive(t, r) { if ("object" != yith_wcan_filter_typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != yith_wcan_filter_typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }

var YITH_WCAN_Filter = /*#__PURE__*/function () {
  // init object
  function YITH_WCAN_Filter() {
    _classCallCheck(this, YITH_WCAN_Filter);
    // currently executing xhr
    yith_wcan_filter_defineProperty(this, "xhr", null);
    // flag set during ajax call handling
    yith_wcan_filter_defineProperty(this, "doingAjax", false);
    // register original url search param
    yith_wcan_filter_defineProperty(this, "originalSearch", location.search);
    // flag set once init has executed
    yith_wcan_filter_defineProperty(this, "initialized", false);
    // flag set when page has at least one active filter.
    yith_wcan_filter_defineProperty(this, "filtered", false);
    this.initPopState();
    this.initialized = true;
  }

  // init page reload when popstate event alter filters
  return _createClass(YITH_WCAN_Filter, [{
    key: "initPopState",
    value: function initPopState() {
      if (!yith_wcan_shortcodes.reload_on_back) {
        return;
      }
      this.pushUrlToHistory(window.location, document.title, null, true);
      $(window).on('popstate', function () {
        var _window$history$state;
        if (!((_window$history$state = window.history.state) !== null && _window$history$state !== void 0 && _window$history$state._yithWcan)) {
          return;
        }
        window.location.reload(true);
      });
    }

    // execute call to filter products in current view
  }, {
    key: "doFilter",
    value: function doFilter(filters, target, preset) {
      var _this = this;
      var targetUrl,
        $target = target ? $(target) : $('body'),
        customFilters;

      // filter properties
      customFilters = $(document).triggerHandler('yith_wcan_filters_parameters', [filters]);
      if (!!customFilters) {
        filters = customFilters;
      }

      // block elements before filtering
      $target && this.block($target);

      // calculate target url
      targetUrl = this.buildUrl(filters);

      // if no ajax, simply change page url
      if (!yith_wcan_shortcodes.ajax_filters) {
        this.pushUrlToHistory(targetUrl, document.title, filters);
        window.location = targetUrl;
        return;
      }

      // start doing ajax
      this.doingAjax = true;
      return this._doAjax(targetUrl).done(function (response) {
        targetUrl = _this.searchAlternativeUrl(response, targetUrl);
        _this._beforeFilter(response, filters);
        _this.refreshFragments(target, preset, response);
        _this.pushUrlToHistory(targetUrl, response.pageTitle, filters);
        _this.originalSearch = location.search;
        $target && _this.unblock($target);
        _this._afterFilter(response, filters);
        _this.doingAjax = false;
      });
    }

    // actions performed before filter
  }, {
    key: "_beforeFilter",
    value: function _beforeFilter(response, filters) {
      $(document).trigger('yith-wcan-ajax-loading', [response, filters]);
      yith_wcan_shortcodes.query_vars = filters;
    }

    // actions performed after filter
  }, {
    key: "_afterFilter",
    value: function _afterFilter(response, filters) {
      $('.woocommerce-ordering').on('change', 'select.orderby', function () {
        $(this).closest('form').submit();
      });
      this.filtered = filters && !!Object.keys(filters).length;
      this.filtered ? $body.addClass('filtered') : $body.removeClass('filtered');
      $(window).trigger('scroll');
      $(document).trigger('yith-wcan-ajax-filtered', [response, filters]).trigger('yith_wcwl_reload_after_ajax');
    }

    // build url to show
  }, {
    key: "buildUrl",
    value: function buildUrl(filters) {
      var _this2 = this;
      var queryParam = yith_wcan_shortcodes.query_param,
        params = {},
        location = window.location,
        url = !!yith_wcan_shortcodes.base_url ? yith_wcan_shortcodes.base_url : (location === null || location === void 0 ? void 0 : location.origin) + (location === null || location === void 0 ? void 0 : location.pathname),
        search = '',
        self = this;
      var haveFilters = yith_wcan_filter_typeof(filters) === 'object' && Object.keys(filters).length;

      // remove filter session from current url, if any
      if (!!yith_wcan_shortcodes.session_param) {
        url = url.replace(new RegExp('/' + yith_wcan_shortcodes.session_param + '/[^/]*/'), '');
      }
      if (haveFilters) {
        params[queryParam] = 1;
      }
      if (!!this.originalSearch) {
        var searchParams = this.originalSearch.replace('?', '').split('&').reduce(function (a, v) {
          var items = v.split('=');
          if (items.length === 2) {
            if (_this2.isFilterParam(items[0])) {
              return a;
            }
            a[items[0]] = items[1];
          }
          return a;
        }, {});
        params = $.extend(params, searchParams);
      }
      if (haveFilters) {
        params = $.extend(params, filters);
      }
      search = Object.keys(params).reduce(function (a, i) {
        var v = params[i];
        if (!v || !i) {
          return a;
        }
        a += self._cleanParam(i) + '=' + self._cleanParam(v) + '&';
        return a;
      }, '?').replace(/&$/g, '').replace(/%2B/g, '+').replace(/%2C/g, ',');
      if (search.length > 1) {
        url += search;
      }
      return url;
    }

    // retrieves alternative sharing url in response body
  }, {
    key: "searchAlternativeUrl",
    value: function searchAlternativeUrl(response) {
      var defaultUrl = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
      var url = defaultUrl,
        matches;
      if (-1 === response.indexOf('yith_wcan:sharing_url')) {
        return url;
      }
      matches = response.match(/<meta name="yith_wcan:sharing_url" content="([^"]*)">/);
      url = matches && 1 in matches ? matches[1] : url;
      return url;
    }

    // push url to browser history
  }, {
    key: "pushUrlToHistory",
    value: function pushUrlToHistory(url, title, filters, current) {
      if (!yith_wcan_shortcodes.change_browser_url || navigator.userAgent.match(/msie/i)) {
        return;
      }
      var method = 'pushState';
      if (!!current) {
        method = 'replaceState';
      }
      window.history[method]({
        _yithWcan: true,
        pageTitle: title,
        filters: filters
      }, '', url);
    }

    // replaces elements in the page with refreshed ones
  }, {
    key: "refreshFragments",
    value: function refreshFragments(target, preset, response) {
      var responseDom = document.createElement('html'),
        $response = $(responseDom);
      responseDom.innerHTML = response;
      if (target) {
        var $preset = $(preset),
          $target = $(target),
          $destination;
        if ($preset.length) {
          $destination = $response.find(preset);
          if ($destination.length) {
            $preset.replaceWith($destination.first());
          }
        }
        if ($target.length) {
          $destination = $response.find(target);
          if ($destination.length) {
            $target.replaceWith($destination.first());
          }
        }
      } else {
        var content = $(yith_wcan_shortcodes.content);
        if (content.length) {
          content.replaceWith($response.find(yith_wcan_shortcodes.content));
        } else {
          $('body').replaceWith($response.find('body'));
        }
      }
      $(document).trigger('yith_wcan_init_shortcodes');
    }

    // clean url parameters
  }, {
    key: "_cleanParam",
    value: function _cleanParam(param) {
      var _yith_wcan_shortcodes, _yith_wcan_shortcodes2;
      if (!((_yith_wcan_shortcodes = yith_wcan_shortcodes) !== null && _yith_wcan_shortcodes !== void 0 && _yith_wcan_shortcodes.process_sanitize) || (_yith_wcan_shortcodes2 = yith_wcan_shortcodes) !== null && _yith_wcan_shortcodes2 !== void 0 && _yith_wcan_shortcodes2.skip_sanitize) {
        return param;
      }
      return encodeURIComponent(param);
    }

    // executes Ajax calls
  }, {
    key: "_doAjax",
    value: function _doAjax(url, params) {
      if (this.xhr) {
        this.xhr.abort();
      }
      params = $.extend({
        url: url,
        headers: {
          'X-YITH-WCAN': 1
        }
      }, params);
      this.xhr = $.ajax(params);
      return this.xhr;
    }

    // block dom elements
  }, {
    key: "block",
    value: function block($el) {
      return globals_block($el);
    }

    // unblock dom elements
  }, {
    key: "unblock",
    value: function unblock($el) {
      return globals_unblock($el);
    }

    // checks if param is one used by layared nav to filter products.
  }, {
    key: "isFilterParam",
    value: function isFilterParam(param) {
      var supportedParams = ['rating_filter', 'min_price', 'max_price', 'price_ranges', 'onsale_filter', 'instock_filter', 'featured_filter', 'orderby', 'product-page', yith_wcan_shortcodes.query_param],
        customParams;

      // filter properties
      customParams = $(document).triggerHandler('yith_wcan_supported_filters_parameters', [supportedParams]);
      if (!!customParams) {
        supportedParams = customParams;
      }
      supportedParams = supportedParams.concat(yith_wcan_shortcodes.supported_taxonomies.map(function (i) {
        return i.replace('pa_', 'filter_');
      }));
      if (-1 !== supportedParams.indexOf(param)) {
        return true;
      }
      if (-1 !== param.indexOf('filter_')) {
        return true;
      }
      if (-1 !== param.indexOf('query_type_')) {
        return true;
      }
      return false;
    }
  }]);
}();

;// CONCATENATED MODULE: ./assets/js/shortcodes/modules/yith-wcan-reset-button.js


/* global globalThis, jQuery, yith_wcan_shortcodes, accounting */
function yith_wcan_reset_button_typeof(o) { "@babel/helpers - typeof"; return yith_wcan_reset_button_typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, yith_wcan_reset_button_typeof(o); }
function yith_wcan_reset_button_defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, yith_wcan_reset_button_toPropertyKey(o.key), o); } }
function yith_wcan_reset_button_createClass(e, r, t) { return r && yith_wcan_reset_button_defineProperties(e.prototype, r), t && yith_wcan_reset_button_defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function yith_wcan_reset_button_classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function yith_wcan_reset_button_defineProperty(e, r, t) { return (r = yith_wcan_reset_button_toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function yith_wcan_reset_button_toPropertyKey(t) { var i = yith_wcan_reset_button_toPrimitive(t, "string"); return "symbol" == yith_wcan_reset_button_typeof(i) ? i : i + ""; }
function yith_wcan_reset_button_toPrimitive(t, r) { if ("object" != yith_wcan_reset_button_typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != yith_wcan_reset_button_typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }

var YITH_WCAN_Reset_Button = /*#__PURE__*/yith_wcan_reset_button_createClass(
// init object
function YITH_WCAN_Reset_Button(el) {
  yith_wcan_reset_button_classCallCheck(this, YITH_WCAN_Reset_Button);
  // current button
  yith_wcan_reset_button_defineProperty(this, "$reset", null);
  // current button
  this.$reset = el;
  this.$reset.on('click', function (ev) {
    ev.preventDefault();
    $('.yith-wcan-filters').each(function () {
      var preset = $(this).data('preset');
      preset.deactivateAllFilters(true);
      preset.closeModal();
    });
  });
  this.$reset.data('reset', this).addClass('enhanced');
});

;// CONCATENATED MODULE: ./assets/js/shortcodes/modules/yith-wcan-dropdown.js


/* global globalThis, jQuery, yith_wcan_shortcodes, accounting */
function yith_wcan_dropdown_typeof(o) { "@babel/helpers - typeof"; return yith_wcan_dropdown_typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, yith_wcan_dropdown_typeof(o); }
function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return e; }; var t, e = {}, r = Object.prototype, n = r.hasOwnProperty, o = Object.defineProperty || function (t, e, r) { t[e] = r.value; }, i = "function" == typeof Symbol ? Symbol : {}, a = i.iterator || "@@iterator", c = i.asyncIterator || "@@asyncIterator", u = i.toStringTag || "@@toStringTag"; function define(t, e, r) { return Object.defineProperty(t, e, { value: r, enumerable: !0, configurable: !0, writable: !0 }), t[e]; } try { define({}, ""); } catch (t) { define = function define(t, e, r) { return t[e] = r; }; } function wrap(t, e, r, n) { var i = e && e.prototype instanceof Generator ? e : Generator, a = Object.create(i.prototype), c = new Context(n || []); return o(a, "_invoke", { value: makeInvokeMethod(t, r, c) }), a; } function tryCatch(t, e, r) { try { return { type: "normal", arg: t.call(e, r) }; } catch (t) { return { type: "throw", arg: t }; } } e.wrap = wrap; var h = "suspendedStart", l = "suspendedYield", f = "executing", s = "completed", y = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var p = {}; define(p, a, function () { return this; }); var d = Object.getPrototypeOf, v = d && d(d(values([]))); v && v !== r && n.call(v, a) && (p = v); var g = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(p); function defineIteratorMethods(t) { ["next", "throw", "return"].forEach(function (e) { define(t, e, function (t) { return this._invoke(e, t); }); }); } function AsyncIterator(t, e) { function invoke(r, o, i, a) { var c = tryCatch(t[r], t, o); if ("throw" !== c.type) { var u = c.arg, h = u.value; return h && "object" == yith_wcan_dropdown_typeof(h) && n.call(h, "__await") ? e.resolve(h.__await).then(function (t) { invoke("next", t, i, a); }, function (t) { invoke("throw", t, i, a); }) : e.resolve(h).then(function (t) { u.value = t, i(u); }, function (t) { return invoke("throw", t, i, a); }); } a(c.arg); } var r; o(this, "_invoke", { value: function value(t, n) { function callInvokeWithMethodAndArg() { return new e(function (e, r) { invoke(t, n, e, r); }); } return r = r ? r.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(e, r, n) { var o = h; return function (i, a) { if (o === f) throw Error("Generator is already running"); if (o === s) { if ("throw" === i) throw a; return { value: t, done: !0 }; } for (n.method = i, n.arg = a;;) { var c = n.delegate; if (c) { var u = maybeInvokeDelegate(c, n); if (u) { if (u === y) continue; return u; } } if ("next" === n.method) n.sent = n._sent = n.arg;else if ("throw" === n.method) { if (o === h) throw o = s, n.arg; n.dispatchException(n.arg); } else "return" === n.method && n.abrupt("return", n.arg); o = f; var p = tryCatch(e, r, n); if ("normal" === p.type) { if (o = n.done ? s : l, p.arg === y) continue; return { value: p.arg, done: n.done }; } "throw" === p.type && (o = s, n.method = "throw", n.arg = p.arg); } }; } function maybeInvokeDelegate(e, r) { var n = r.method, o = e.iterator[n]; if (o === t) return r.delegate = null, "throw" === n && e.iterator["return"] && (r.method = "return", r.arg = t, maybeInvokeDelegate(e, r), "throw" === r.method) || "return" !== n && (r.method = "throw", r.arg = new TypeError("The iterator does not provide a '" + n + "' method")), y; var i = tryCatch(o, e.iterator, r.arg); if ("throw" === i.type) return r.method = "throw", r.arg = i.arg, r.delegate = null, y; var a = i.arg; return a ? a.done ? (r[e.resultName] = a.value, r.next = e.nextLoc, "return" !== r.method && (r.method = "next", r.arg = t), r.delegate = null, y) : a : (r.method = "throw", r.arg = new TypeError("iterator result is not an object"), r.delegate = null, y); } function pushTryEntry(t) { var e = { tryLoc: t[0] }; 1 in t && (e.catchLoc = t[1]), 2 in t && (e.finallyLoc = t[2], e.afterLoc = t[3]), this.tryEntries.push(e); } function resetTryEntry(t) { var e = t.completion || {}; e.type = "normal", delete e.arg, t.completion = e; } function Context(t) { this.tryEntries = [{ tryLoc: "root" }], t.forEach(pushTryEntry, this), this.reset(!0); } function values(e) { if (e || "" === e) { var r = e[a]; if (r) return r.call(e); if ("function" == typeof e.next) return e; if (!isNaN(e.length)) { var o = -1, i = function next() { for (; ++o < e.length;) if (n.call(e, o)) return next.value = e[o], next.done = !1, next; return next.value = t, next.done = !0, next; }; return i.next = i; } } throw new TypeError(yith_wcan_dropdown_typeof(e) + " is not iterable"); } return GeneratorFunction.prototype = GeneratorFunctionPrototype, o(g, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), o(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, u, "GeneratorFunction"), e.isGeneratorFunction = function (t) { var e = "function" == typeof t && t.constructor; return !!e && (e === GeneratorFunction || "GeneratorFunction" === (e.displayName || e.name)); }, e.mark = function (t) { return Object.setPrototypeOf ? Object.setPrototypeOf(t, GeneratorFunctionPrototype) : (t.__proto__ = GeneratorFunctionPrototype, define(t, u, "GeneratorFunction")), t.prototype = Object.create(g), t; }, e.awrap = function (t) { return { __await: t }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, c, function () { return this; }), e.AsyncIterator = AsyncIterator, e.async = function (t, r, n, o, i) { void 0 === i && (i = Promise); var a = new AsyncIterator(wrap(t, r, n, o), i); return e.isGeneratorFunction(r) ? a : a.next().then(function (t) { return t.done ? t.value : a.next(); }); }, defineIteratorMethods(g), define(g, u, "Generator"), define(g, a, function () { return this; }), define(g, "toString", function () { return "[object Generator]"; }), e.keys = function (t) { var e = Object(t), r = []; for (var n in e) r.push(n); return r.reverse(), function next() { for (; r.length;) { var t = r.pop(); if (t in e) return next.value = t, next.done = !1, next; } return next.done = !0, next; }; }, e.values = values, Context.prototype = { constructor: Context, reset: function reset(e) { if (this.prev = 0, this.next = 0, this.sent = this._sent = t, this.done = !1, this.delegate = null, this.method = "next", this.arg = t, this.tryEntries.forEach(resetTryEntry), !e) for (var r in this) "t" === r.charAt(0) && n.call(this, r) && !isNaN(+r.slice(1)) && (this[r] = t); }, stop: function stop() { this.done = !0; var t = this.tryEntries[0].completion; if ("throw" === t.type) throw t.arg; return this.rval; }, dispatchException: function dispatchException(e) { if (this.done) throw e; var r = this; function handle(n, o) { return a.type = "throw", a.arg = e, r.next = n, o && (r.method = "next", r.arg = t), !!o; } for (var o = this.tryEntries.length - 1; o >= 0; --o) { var i = this.tryEntries[o], a = i.completion; if ("root" === i.tryLoc) return handle("end"); if (i.tryLoc <= this.prev) { var c = n.call(i, "catchLoc"), u = n.call(i, "finallyLoc"); if (c && u) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } else if (c) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); } else { if (!u) throw Error("try statement without catch or finally"); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } } } }, abrupt: function abrupt(t, e) { for (var r = this.tryEntries.length - 1; r >= 0; --r) { var o = this.tryEntries[r]; if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) { var i = o; break; } } i && ("break" === t || "continue" === t) && i.tryLoc <= e && e <= i.finallyLoc && (i = null); var a = i ? i.completion : {}; return a.type = t, a.arg = e, i ? (this.method = "next", this.next = i.finallyLoc, y) : this.complete(a); }, complete: function complete(t, e) { if ("throw" === t.type) throw t.arg; return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && e && (this.next = e), y; }, finish: function finish(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.finallyLoc === t) return this.complete(r.completion, r.afterLoc), resetTryEntry(r), y; } }, "catch": function _catch(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.tryLoc === t) { var n = r.completion; if ("throw" === n.type) { var o = n.arg; resetTryEntry(r); } return o; } } throw Error("illegal catch attempt"); }, delegateYield: function delegateYield(e, r, n) { return this.delegate = { iterator: values(e), resultName: r, nextLoc: n }, "next" === this.method && (this.arg = t), y; } }, e; }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
function yith_wcan_dropdown_classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function yith_wcan_dropdown_defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, yith_wcan_dropdown_toPropertyKey(o.key), o); } }
function yith_wcan_dropdown_createClass(e, r, t) { return r && yith_wcan_dropdown_defineProperties(e.prototype, r), t && yith_wcan_dropdown_defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function yith_wcan_dropdown_defineProperty(e, r, t) { return (r = yith_wcan_dropdown_toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function yith_wcan_dropdown_toPropertyKey(t) { var i = yith_wcan_dropdown_toPrimitive(t, "string"); return "symbol" == yith_wcan_dropdown_typeof(i) ? i : i + ""; }
function yith_wcan_dropdown_toPrimitive(t, r) { if ("object" != yith_wcan_dropdown_typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != yith_wcan_dropdown_typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }

var YITH_WCAN_Dropdown = /*#__PURE__*/function () {
  // init object
  function YITH_WCAN_Dropdown(el, opts) {
    var _yith_wcan_shortcodes, _yith_wcan_shortcodes2, _yith_wcan_shortcodes3, _yith_wcan_shortcodes4;
    yith_wcan_dropdown_classCallCheck(this, YITH_WCAN_Dropdown);
    // current button
    yith_wcan_dropdown_defineProperty(this, "$originalSelect", null);
    // list of current items.
    yith_wcan_dropdown_defineProperty(this, "_items", []);
    // main element
    yith_wcan_dropdown_defineProperty(this, "$_main", null);
    // label element
    yith_wcan_dropdown_defineProperty(this, "$_label", null);
    // dropdown
    yith_wcan_dropdown_defineProperty(this, "$_dropdown", null);
    // search input
    yith_wcan_dropdown_defineProperty(this, "$_search", null);
    // show more link
    yith_wcan_dropdown_defineProperty(this, "$_showMore", null);
    // items list
    yith_wcan_dropdown_defineProperty(this, "$_items", null);
    // whether select should paginate.
    yith_wcan_dropdown_defineProperty(this, "paginate", false);
    // whether select has more items than those shown.
    yith_wcan_dropdown_defineProperty(this, "hasMore", false);
    // whether items list needs update.
    yith_wcan_dropdown_defineProperty(this, "needsRefresh", true);
    // whether select is multiple
    yith_wcan_dropdown_defineProperty(this, "multiple", false);
    // current page
    yith_wcan_dropdown_defineProperty(this, "currentPage", 1);
    // options
    yith_wcan_dropdown_defineProperty(this, "options", {});
    this.$originalSelect = el;
    if (!this.$originalSelect.is('select')) {
      return;
    }
    var defaultPerPage = this.$originalSelect.data('per_page'),
      defaultOrder = this.$originalSelect.data('order'),
      defaultAll = this.$originalSelect.data('all-label'),
      defaults = {
        showSearch: this.$originalSelect.data('show_search'),
        paginate: this.$originalSelect.data('paginate'),
        perPage: defaultPerPage ? defaultPerPage : 10,
        hasMore: false,
        order: defaultOrder ? defaultOrder : 'ASC',
        getElements: null,
        labels: {
          emptyLabel: defaultAll ? defaultAll : (_yith_wcan_shortcodes = yith_wcan_shortcodes.labels) === null || _yith_wcan_shortcodes === void 0 ? void 0 : _yith_wcan_shortcodes.empty_option,
          searchPlaceholder: (_yith_wcan_shortcodes2 = yith_wcan_shortcodes.labels) === null || _yith_wcan_shortcodes2 === void 0 ? void 0 : _yith_wcan_shortcodes2.search_placeholder,
          noItemsFound: (_yith_wcan_shortcodes3 = yith_wcan_shortcodes.labels) === null || _yith_wcan_shortcodes3 === void 0 ? void 0 : _yith_wcan_shortcodes3.no_items,
          showMore: (_yith_wcan_shortcodes4 = yith_wcan_shortcodes.labels) === null || _yith_wcan_shortcodes4 === void 0 ? void 0 : _yith_wcan_shortcodes4.show_more
        }
      };
    this.multiple = this.$originalSelect.prop('multiple');
    this.options = $.extend(defaults, opts);
    this.paginate = this.options.paginate || false;
    this.hasMore = this.options.hasMore || false;
    this._hideSelect();
    this._initTemplate();
    this._initActions();
    this.$originalSelect.data('dropdown', this).addClass('enhanced');
  }

  // hide select
  return yith_wcan_dropdown_createClass(YITH_WCAN_Dropdown, [{
    key: "_hideSelect",
    value: function _hideSelect() {
      this.$originalSelect.hide();
    }

    // create dropdown
  }, {
    key: "_initTemplate",
    value: function _initTemplate() {
      var $mainSpan = $('<div/>', {
          "class": 'yith-wcan-dropdown closed'
        }),
        $labelSpan = $('<div/>', {
          "class": 'dropdown-label',
          html: this.getLabel()
        }),
        $dropdownSpan = $('<div>', {
          "class": 'dropdown-wrapper'
        }),
        $matchingItemsList = $('<ul/>', {
          "class": 'matching-items filter-items'
        });
      $dropdownSpan.append($matchingItemsList);
      $mainSpan.append($labelSpan).append($dropdownSpan);
      if (this.options.showSearch) {
        this._initSearchTemplate($dropdownSpan);
      }
      if (this.options.paginate) {
        this._initShowMoreTemplate($dropdownSpan);
      }
      this.$originalSelect.after($mainSpan);
      this.$_main = $mainSpan;
      this.$_label = $labelSpan;
      this.$_dropdown = $dropdownSpan;
      this.$_items = $matchingItemsList;
    }

    // create search field
  }, {
    key: "_initSearchTemplate",
    value: function _initSearchTemplate($dropdwonSpan) {
      var $container = $('<div/>', {
          "class": 'search-field-container'
        }),
        $search = $('<input/>', {
          name: 's',
          "class": 'search-field',
          type: 'search',
          placeholder: this.options.labels.searchPlaceholder
        }).attr('autocomplete', 'off');
      $container.append($search).prependTo($dropdwonSpan);
      this.$_search = $search;
    }

    // create showMore field
  }, {
    key: "_initShowMoreTemplate",
    value: function _initShowMoreTemplate($dropdwonSpan) {
      var _this$options$labels$;
      var $showMore = $('<a/>', {
        "class": 'show-more',
        text: (_this$options$labels$ = this.options.labels.showMore) === null || _this$options$labels$ === void 0 ? void 0 : _this$options$labels$.replace('%d', this.options.perPage)
      });
      $showMore.on('click', this.loadNextPage.bind(this)).hide();
      $dropdwonSpan.append($showMore);
      this.$_showMore = $showMore;
    }

    // init actions performed over dropdown elements
  }, {
    key: "_initActions",
    value: function _initActions() {
      var _this$$_main,
        _this$$_search,
        _this = this;
      var self = this;

      // main open event
      (_this$$_main = this.$_main) === null || _this$$_main === void 0 || _this$$_main.on('click', function (ev) {
        ev.stopPropagation();
        self.toggleDropdown();
      });
      this.$_dropdown.on('click', function (ev) {
        ev.stopPropagation();
      });

      // search event
      (_this$$_search = this.$_search) === null || _this$$_search === void 0 || _this$$_search.on('keyup search change', function () {
        _this.paginate = false;
        _this._populateItems().then(function () {
          _this.needsRefresh = true;
        });
        return false;
      });

      // select event
      this.$_items.on('change', ':input', function () {
        var $li = $(this).closest('li'),
          value = $li.data('value'),
          isActive = false;
        if ($li.hasClass('disabled') && !self.isValueSelected(value)) {
          return false;
        }
        $li.toggleClass('active');
        isActive = $li.hasClass('active');
        self._changeItemStatus(value, isActive);
      });
      this.$_items.on('click', 'li:not(.checkbox) a', function (ev) {
        var $li = $(this).closest('li'),
          value = $li.data('value'),
          isActive = false;
        ev.preventDefault();
        if ($li.hasClass('disabled') && !self.isValueSelected(value)) {
          return false;
        }
        $li.toggleClass('active');
        isActive = $li.hasClass('active');
        if (isActive) {
          $li.siblings().removeClass('active');
        }
        self._changeItemStatus(value, isActive);
      });
      this.$_items.on('click', 'label > a', function (ev) {
        var input = $(this).parent().find(':input');
        ev.preventDefault();
        if (input.is('[type="radio"]') || input.is('[type="checkbox"]')) {
          input.prop('checked', !input.prop('checked'));
        }
        input.change();
      });

      // select change
      this.$originalSelect.on('change', function (ev, selfOriginated) {
        if (selfOriginated) {
          return;
        }
        self.updateLabel();
      });

      // close dropdown on external click; do this handler only once for any dropdown in the page
      if (!(globalThis !== null && globalThis !== void 0 && globalThis.yith_wcan_dropdown_init)) {
        $(document).on('click', this._closeAllDropdowns);
        globalThis.yith_wcan_dropdown_init = true;
      }
    }

    // open dropdown
  }, {
    key: "openDropdown",
    value: function openDropdown() {
      var _this$$_main2;
      (_this$$_main2 = this.$_main) === null || _this$$_main2 === void 0 || _this$$_main2.addClass('open').removeClass('closed');
      this._afterDropdownOpen();
    }

    // close dropdown
  }, {
    key: "closeDropdown",
    value: function closeDropdown() {
      var _this$$_main3;
      (_this$$_main3 = this.$_main) === null || _this$$_main3 === void 0 || _this$$_main3.removeClass('open').addClass('closed');
    }

    // close all dropdowns
  }, {
    key: "_closeAllDropdowns",
    value: function _closeAllDropdowns() {
      var dropdowns = $(document).find('select.enhanced').filter(function (i, select) {
        var $el = $(select);
        return !!$el.data('dropdown');
      });
      dropdowns.each(function () {
        $(this).data('dropdown').closeDropdown();
      });
    }

    // close other dropdowns
  }, {
    key: "_closeOtherDropdowns",
    value: function _closeOtherDropdowns() {
      var self = this,
        dropdowns = $(document).find('select.enhanced').filter(function (i, select) {
          var $el = $(select);
          return !!$el.data('dropdown') && !$el.is(self.$originalSelect);
        });
      dropdowns.each(function () {
        $(this).data('dropdown').closeDropdown();
      });
    }

    // toggle dropdown
  }, {
    key: "toggleDropdown",
    value: function toggleDropdown() {
      var _this$$_main4, _this$$_main5;
      (_this$$_main4 = this.$_main) === null || _this$$_main4 === void 0 || _this$$_main4.toggleClass('open').toggleClass('closed');
      if ((_this$$_main5 = this.$_main) !== null && _this$$_main5 !== void 0 && _this$$_main5.hasClass('open')) {
        this._afterDropdownOpen();
      }
    }

    // perform operations after dropdown is open
  }, {
    key: "_afterDropdownOpen",
    value: function _afterDropdownOpen() {
      var _this$$_search2;
      this._closeOtherDropdowns();
      if ((_this$$_search2 = this.$_search) !== null && _this$$_search2 !== void 0 && _this$$_search2.length) {
        this.$_search.val('');
      }
      this._maybePopulateItems();
    }
  }, {
    key: "getItems",
    value: function () {
      var _getItems = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee(search) {
        var _this2 = this;
        var $options, items, perPage;
        return _regeneratorRuntime().wrap(function _callee$(_context) {
          while (1) switch (_context.prev = _context.next) {
            case 0:
              if (!this._items.length) {
                $options = this.getOptions();
                $options.each(function (i, el) {
                  var t = $(el),
                    value = t.val(),
                    label = t.html();
                  _this2._items.push({
                    value: value,
                    label: label
                  });
                });
              }
              _context.next = 3;
              return this.getMatchingElements(search);
            case 3:
              items = _context.sent;
              perPage = this.paginate ? this.options.perPage : 0;
              if (perPage && items.length > perPage) {
                this.hasMore = true;
                items = items.slice(0, perPage);
              }
              return _context.abrupt("return", items);
            case 7:
            case "end":
              return _context.stop();
          }
        }, _callee, this);
      }));
      function getItems(_x) {
        return _getItems.apply(this, arguments);
      }
      return getItems;
    }() // get elements
  }, {
    key: "getMatchingElements",
    value: function getMatchingElements(search) {
      var _this3 = this;
      var matchingElements = this._items,
        promise;
      promise = new Promise(function (resolve) {
        matchingElements = search ? matchingElements.filter(function (_ref) {
          var label = _ref.label,
            value = _ref.value;
          var regex = new RegExp('.*' + search + '.*', 'i');
          return regex.test(value) || regex.test(label);
        }) : matchingElements;

        // then retrieve additional items
        if (_this3.options.getElements) {
          // we're expecting key => value pairs
          _this3.options.getElements.call(_this3, search).then(function (retrievedElements) {
            if (retrievedElements) {
              // reformat retrieved array
              retrievedElements = Object.keys(retrievedElements).reduce(function (a, i) {
                if (!!retrievedElements[i].label) {
                  a.push(retrievedElements[i]);
                  return a;
                }
                a.push({
                  label: retrievedElements[i],
                  value: i
                });
                return a;
              }, []);

              // merge found results with options
              matchingElements = [].concat(_toConsumableArray(matchingElements), _toConsumableArray(retrievedElements));
            }
            resolve(_this3._formatItems(matchingElements));
          });
        } else {
          resolve(_this3._formatItems(matchingElements));
        }
      });
      return promise;
    }

    // format items as key/value pairs for further processing
  }, {
    key: "_formatItems",
    value: function _formatItems(items) {
      var _this4 = this;
      var indexes = [];

      // remove duplicates and sort array of results
      return items.filter(function (_ref2) {
        var value = _ref2.value,
          label = _ref2.label;
        if (-1 === indexes.indexOf(value)) {
          indexes.push(value);

          // checks if select has a related option.
          if (!_this4.getOptionByValue(value).length) {
            _this4.$originalSelect.append("<option class=\"filter-item\" value=\"".concat(value, "\">").concat(label, "</option>"));
          }

          // add item to final array of elements.
          return true;
        }

        // item should not be included in the final set.
        return false;
      });
    }

    // generate item to append to items list
  }, {
    key: "_generateItem",
    value: function _generateItem(value, label) {
      var active = this.isValueSelected(value),
        option = this.getOptionByValue(value),
        $item = $('<li/>', {
          'data-value': value,
          "class": option.length ? option.attr('class') : ''
        }),
        $anchor;
      if (option.length) {
        var template = option.data('template'),
          count = option.data('count');
        label = template ? template : label;
        if (!!count) {
          label += count;
        }
      }
      $anchor = $('<a/>', {
        href: option.length ? option.data('filter_url') : '#',
        html: label,
        rel: 'nofollow',
        'data-title': option.length ? option.data('title') : ''
      });
      if (this.multiple) {
        var $checkbox = $('<input/>', {
            type: 'checkbox',
            value: value
          }),
          $label = $('<label>');
        $checkbox.prop('checked', active);
        $label.prepend($checkbox).append($anchor);
        $item.append($label).addClass('checkbox');
      } else {
        $item.append($anchor);
      }
      active ? $item.addClass('active') : $item.removeClass('active');
      return $item;
    }
  }, {
    key: "_maybePopulateItems",
    value: function _maybePopulateItems() {
      if (!this.needsRefresh) {
        return;
      }
      this._populateItems();
    }
  }, {
    key: "_populateItems",
    value: function _populateItems() {
      var _this$$_search3,
        _this5 = this;
      var search = (_this$$_search3 = this.$_search) !== null && _this$$_search3 !== void 0 && _this$$_search3.length ? this.$_search.val() : false;
      return this.getItems(search).then(function (items) {
        _this5._emptyItems();
        _this5._hideLoadMore();
        _this5.$_items.append(items.map(function (_ref3) {
          var label = _ref3.label,
            value = _ref3.value;
          return _this5._generateItem(value, label);
        }));
        _this5.$originalSelect.trigger('yith_wcan_dropdown_updated');
        _this5.needsRefresh = false;
        if (_this5.paginate && _this5.hasMore) {
          _this5._showLoadMore();
        }
      });
    }

    // load next page of items
  }, {
    key: "loadNextPage",
    value: function () {
      var _loadNextPage = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee2() {
        var _this6 = this;
        return _regeneratorRuntime().wrap(function _callee2$(_context2) {
          while (1) switch (_context2.prev = _context2.next) {
            case 0:
              this.paginate = false;
              this._populateItems().then(function () {
                _this6.hasMore = false;
              });
            case 2:
            case "end":
              return _context2.stop();
          }
        }, _callee2, this);
      }));
      function loadNextPage() {
        return _loadNextPage.apply(this, arguments);
      }
      return loadNextPage;
    }() // set an item as active
  }, {
    key: "_selectItem",
    value: function _selectItem(value) {
      return this._changeItemStatus(value, true);
    }

    // disable an item
  }, {
    key: "_deselectItem",
    value: function _deselectItem(value) {
      return this._changeItemStatus(value, false);
    }

    // change item status
  }, {
    key: "_changeItemStatus",
    value: function _changeItemStatus(value, status) {
      var $option = this.$originalSelect.find("option[value=\"".concat(value, "\"]"));
      if ($option.length) {
        $option.prop('selected', status);
        !yith_wcan_shortcodes.instant_filters && this.multiple || this.closeDropdown();
        this.updateLabel();
        this.$originalSelect.trigger('change', [true]);
        return true;
      }
      return false;
    }

    // empty items list
  }, {
    key: "_emptyItems",
    value: function _emptyItems() {
      this.$_items.html('');
    }

    // show "Load more" link
  }, {
    key: "_showLoadMore",
    value: function _showLoadMore() {
      this.$_showMore.show();
    }

    // hide "Load more" link
  }, {
    key: "_hideLoadMore",
    value: function _hideLoadMore() {
      this.$_showMore.hide();
    }

    // returns select label
  }, {
    key: "getLabel",
    value: function getLabel() {
      return this.hasSelectedValues() ? this.getSelectedLabels().join(', ') : this.options.labels.emptyLabel;
    }

    // update label to match new selection
  }, {
    key: "updateLabel",
    value: function updateLabel() {
      var _this$$_label;
      var label = this.getLabel();
      (_this$$_label = this.$_label) === null || _this$$_label === void 0 || _this$$_label.html(label);
    }

    // returns select options
  }, {
    key: "getOptions",
    value: function getOptions() {
      return this.$originalSelect.find('option');
    }

    // checks whether select has selected values
  }, {
    key: "hasSelectedValues",
    value: function hasSelectedValues() {
      return this.getSelectedOptions().length;
    }

    // checks whether a value is selected
  }, {
    key: "isValueSelected",
    value: function isValueSelected(value) {
      var found = this.getSelectedValues().indexOf(value.toString());
      return -1 !== found;
    }

    // retrieve selected options
  }, {
    key: "getSelectedOptions",
    value: function getSelectedOptions() {
      return this.$originalSelect.find('option').filter(':selected');
    }

    // retrieves an option node by value
  }, {
    key: "getOptionByValue",
    value: function getOptionByValue(value) {
      return this.$originalSelect.find("option[value=\"".concat(value, "\"]"));
    }

    // retrieve labels for selected options
  }, {
    key: "getSelectedLabels",
    value: function getSelectedLabels() {
      var labels = [];
      this.getSelectedOptions().each(function () {
        var $option = $(this),
          template = $option.data('template');
        template = template ? template : $option.html().replace(/\([0-9]*\)/, '');
        labels.push(template);
      });
      return labels;
    }

    // retrieve values for selected options
  }, {
    key: "getSelectedValues",
    value: function getSelectedValues() {
      var values = [];
      this.getSelectedOptions().each(function () {
        values.push($(this).val());
      });
      return values;
    }
  }, {
    key: "destroy",
    value: function destroy() {
      // TBD
    }
  }]);
}();

;// CONCATENATED MODULE: ./assets/js/shortcodes/modules/yith-wcan-preset.js


/* global globalThis, jQuery, yith_wcan_shortcodes, accounting */
function _createForOfIteratorHelper(r, e) { var t = "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (!t) { if (Array.isArray(r) || (t = yith_wcan_preset_unsupportedIterableToArray(r)) || e && r && "number" == typeof r.length) { t && (r = t); var _n = 0, F = function F() {}; return { s: F, n: function n() { return _n >= r.length ? { done: !0 } : { done: !1, value: r[_n++] }; }, e: function e(r) { throw r; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var o, a = !0, u = !1; return { s: function s() { t = t.call(r); }, n: function n() { var r = t.next(); return a = r.done, r; }, e: function e(r) { u = !0, o = r; }, f: function f() { try { a || null == t["return"] || t["return"](); } finally { if (u) throw o; } } }; }
function yith_wcan_preset_unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return yith_wcan_preset_arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? yith_wcan_preset_arrayLikeToArray(r, a) : void 0; } }
function yith_wcan_preset_arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function yith_wcan_preset_typeof(o) { "@babel/helpers - typeof"; return yith_wcan_preset_typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, yith_wcan_preset_typeof(o); }
function yith_wcan_preset_regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ yith_wcan_preset_regeneratorRuntime = function _regeneratorRuntime() { return e; }; var t, e = {}, r = Object.prototype, n = r.hasOwnProperty, o = Object.defineProperty || function (t, e, r) { t[e] = r.value; }, i = "function" == typeof Symbol ? Symbol : {}, a = i.iterator || "@@iterator", c = i.asyncIterator || "@@asyncIterator", u = i.toStringTag || "@@toStringTag"; function define(t, e, r) { return Object.defineProperty(t, e, { value: r, enumerable: !0, configurable: !0, writable: !0 }), t[e]; } try { define({}, ""); } catch (t) { define = function define(t, e, r) { return t[e] = r; }; } function wrap(t, e, r, n) { var i = e && e.prototype instanceof Generator ? e : Generator, a = Object.create(i.prototype), c = new Context(n || []); return o(a, "_invoke", { value: makeInvokeMethod(t, r, c) }), a; } function tryCatch(t, e, r) { try { return { type: "normal", arg: t.call(e, r) }; } catch (t) { return { type: "throw", arg: t }; } } e.wrap = wrap; var h = "suspendedStart", l = "suspendedYield", f = "executing", s = "completed", y = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var p = {}; define(p, a, function () { return this; }); var d = Object.getPrototypeOf, v = d && d(d(values([]))); v && v !== r && n.call(v, a) && (p = v); var g = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(p); function defineIteratorMethods(t) { ["next", "throw", "return"].forEach(function (e) { define(t, e, function (t) { return this._invoke(e, t); }); }); } function AsyncIterator(t, e) { function invoke(r, o, i, a) { var c = tryCatch(t[r], t, o); if ("throw" !== c.type) { var u = c.arg, h = u.value; return h && "object" == yith_wcan_preset_typeof(h) && n.call(h, "__await") ? e.resolve(h.__await).then(function (t) { invoke("next", t, i, a); }, function (t) { invoke("throw", t, i, a); }) : e.resolve(h).then(function (t) { u.value = t, i(u); }, function (t) { return invoke("throw", t, i, a); }); } a(c.arg); } var r; o(this, "_invoke", { value: function value(t, n) { function callInvokeWithMethodAndArg() { return new e(function (e, r) { invoke(t, n, e, r); }); } return r = r ? r.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(e, r, n) { var o = h; return function (i, a) { if (o === f) throw Error("Generator is already running"); if (o === s) { if ("throw" === i) throw a; return { value: t, done: !0 }; } for (n.method = i, n.arg = a;;) { var c = n.delegate; if (c) { var u = maybeInvokeDelegate(c, n); if (u) { if (u === y) continue; return u; } } if ("next" === n.method) n.sent = n._sent = n.arg;else if ("throw" === n.method) { if (o === h) throw o = s, n.arg; n.dispatchException(n.arg); } else "return" === n.method && n.abrupt("return", n.arg); o = f; var p = tryCatch(e, r, n); if ("normal" === p.type) { if (o = n.done ? s : l, p.arg === y) continue; return { value: p.arg, done: n.done }; } "throw" === p.type && (o = s, n.method = "throw", n.arg = p.arg); } }; } function maybeInvokeDelegate(e, r) { var n = r.method, o = e.iterator[n]; if (o === t) return r.delegate = null, "throw" === n && e.iterator["return"] && (r.method = "return", r.arg = t, maybeInvokeDelegate(e, r), "throw" === r.method) || "return" !== n && (r.method = "throw", r.arg = new TypeError("The iterator does not provide a '" + n + "' method")), y; var i = tryCatch(o, e.iterator, r.arg); if ("throw" === i.type) return r.method = "throw", r.arg = i.arg, r.delegate = null, y; var a = i.arg; return a ? a.done ? (r[e.resultName] = a.value, r.next = e.nextLoc, "return" !== r.method && (r.method = "next", r.arg = t), r.delegate = null, y) : a : (r.method = "throw", r.arg = new TypeError("iterator result is not an object"), r.delegate = null, y); } function pushTryEntry(t) { var e = { tryLoc: t[0] }; 1 in t && (e.catchLoc = t[1]), 2 in t && (e.finallyLoc = t[2], e.afterLoc = t[3]), this.tryEntries.push(e); } function resetTryEntry(t) { var e = t.completion || {}; e.type = "normal", delete e.arg, t.completion = e; } function Context(t) { this.tryEntries = [{ tryLoc: "root" }], t.forEach(pushTryEntry, this), this.reset(!0); } function values(e) { if (e || "" === e) { var r = e[a]; if (r) return r.call(e); if ("function" == typeof e.next) return e; if (!isNaN(e.length)) { var o = -1, i = function next() { for (; ++o < e.length;) if (n.call(e, o)) return next.value = e[o], next.done = !1, next; return next.value = t, next.done = !0, next; }; return i.next = i; } } throw new TypeError(yith_wcan_preset_typeof(e) + " is not iterable"); } return GeneratorFunction.prototype = GeneratorFunctionPrototype, o(g, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), o(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, u, "GeneratorFunction"), e.isGeneratorFunction = function (t) { var e = "function" == typeof t && t.constructor; return !!e && (e === GeneratorFunction || "GeneratorFunction" === (e.displayName || e.name)); }, e.mark = function (t) { return Object.setPrototypeOf ? Object.setPrototypeOf(t, GeneratorFunctionPrototype) : (t.__proto__ = GeneratorFunctionPrototype, define(t, u, "GeneratorFunction")), t.prototype = Object.create(g), t; }, e.awrap = function (t) { return { __await: t }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, c, function () { return this; }), e.AsyncIterator = AsyncIterator, e.async = function (t, r, n, o, i) { void 0 === i && (i = Promise); var a = new AsyncIterator(wrap(t, r, n, o), i); return e.isGeneratorFunction(r) ? a : a.next().then(function (t) { return t.done ? t.value : a.next(); }); }, defineIteratorMethods(g), define(g, u, "Generator"), define(g, a, function () { return this; }), define(g, "toString", function () { return "[object Generator]"; }), e.keys = function (t) { var e = Object(t), r = []; for (var n in e) r.push(n); return r.reverse(), function next() { for (; r.length;) { var t = r.pop(); if (t in e) return next.value = t, next.done = !1, next; } return next.done = !0, next; }; }, e.values = values, Context.prototype = { constructor: Context, reset: function reset(e) { if (this.prev = 0, this.next = 0, this.sent = this._sent = t, this.done = !1, this.delegate = null, this.method = "next", this.arg = t, this.tryEntries.forEach(resetTryEntry), !e) for (var r in this) "t" === r.charAt(0) && n.call(this, r) && !isNaN(+r.slice(1)) && (this[r] = t); }, stop: function stop() { this.done = !0; var t = this.tryEntries[0].completion; if ("throw" === t.type) throw t.arg; return this.rval; }, dispatchException: function dispatchException(e) { if (this.done) throw e; var r = this; function handle(n, o) { return a.type = "throw", a.arg = e, r.next = n, o && (r.method = "next", r.arg = t), !!o; } for (var o = this.tryEntries.length - 1; o >= 0; --o) { var i = this.tryEntries[o], a = i.completion; if ("root" === i.tryLoc) return handle("end"); if (i.tryLoc <= this.prev) { var c = n.call(i, "catchLoc"), u = n.call(i, "finallyLoc"); if (c && u) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } else if (c) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); } else { if (!u) throw Error("try statement without catch or finally"); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } } } }, abrupt: function abrupt(t, e) { for (var r = this.tryEntries.length - 1; r >= 0; --r) { var o = this.tryEntries[r]; if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) { var i = o; break; } } i && ("break" === t || "continue" === t) && i.tryLoc <= e && e <= i.finallyLoc && (i = null); var a = i ? i.completion : {}; return a.type = t, a.arg = e, i ? (this.method = "next", this.next = i.finallyLoc, y) : this.complete(a); }, complete: function complete(t, e) { if ("throw" === t.type) throw t.arg; return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && e && (this.next = e), y; }, finish: function finish(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.finallyLoc === t) return this.complete(r.completion, r.afterLoc), resetTryEntry(r), y; } }, "catch": function _catch(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.tryLoc === t) { var n = r.completion; if ("throw" === n.type) { var o = n.arg; resetTryEntry(r); } return o; } } throw Error("illegal catch attempt"); }, delegateYield: function delegateYield(e, r, n) { return this.delegate = { iterator: values(e), resultName: r, nextLoc: n }, "next" === this.method && (this.arg = t), y; } }, e; }
function yith_wcan_preset_asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function yith_wcan_preset_asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { yith_wcan_preset_asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { yith_wcan_preset_asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { yith_wcan_preset_defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function yith_wcan_preset_classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function yith_wcan_preset_defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, yith_wcan_preset_toPropertyKey(o.key), o); } }
function yith_wcan_preset_createClass(e, r, t) { return r && yith_wcan_preset_defineProperties(e.prototype, r), t && yith_wcan_preset_defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function yith_wcan_preset_defineProperty(e, r, t) { return (r = yith_wcan_preset_toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function yith_wcan_preset_toPropertyKey(t) { var i = yith_wcan_preset_toPrimitive(t, "string"); return "symbol" == yith_wcan_preset_typeof(i) ? i : i + ""; }
function yith_wcan_preset_toPrimitive(t, r) { if ("object" != yith_wcan_preset_typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != yith_wcan_preset_typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }


var YITH_WCAN_Preset = /*#__PURE__*/function () {
  // init object
  function YITH_WCAN_Preset(el) {
    yith_wcan_preset_classCallCheck(this, YITH_WCAN_Preset);
    // main preset node
    yith_wcan_preset_defineProperty(this, "preset", false);
    yith_wcan_preset_defineProperty(this, "$preset", false);
    // target of the filter, if any
    yith_wcan_preset_defineProperty(this, "target", false);
    yith_wcan_preset_defineProperty(this, "$target", false);
    // filters node
    yith_wcan_preset_defineProperty(this, "$filters", false);
    // filter button
    yith_wcan_preset_defineProperty(this, "$filterButtons", false);
    // nodes created just for modal layout
    yith_wcan_preset_defineProperty(this, "modalElements", {});
    // retains current status of filters
    yith_wcan_preset_defineProperty(this, "activeFilters", false);
    // mobile flag
    yith_wcan_preset_defineProperty(this, "isMobile", false);
    // slider timeout
    yith_wcan_preset_defineProperty(this, "sliderTimeout", false);
    // registers when status has changed
    yith_wcan_preset_defineProperty(this, "originalFilters", null);
    yith_wcan_preset_defineProperty(this, "dirty", false);
    // promise resolved when all async loading is complete.
    yith_wcan_preset_defineProperty(this, "loaded", void 0);
    // flag to disable filtering
    yith_wcan_preset_defineProperty(this, "inhibitFilters", false);
    // main preset node
    this.preset = '#' + el.attr('id');
    this.$preset = el;

    // target of the filter, if any
    this.target = this.$preset.data('target');
    this.$target = this.target ? $(this.target) : false;
    this._regiterStatus();
    this._initFilterButton();
    this._initFilters();
    this._initResponsive();
    this._initActions();
    this.$preset.data('preset', this).addClass('enhanced').trigger('yith_wcan_preset_initialized', [this]);
  }

  // init filters
  return yith_wcan_preset_createClass(YITH_WCAN_Preset, [{
    key: "_initFilters",
    value: function _initFilters() {
      var _this = this;
      var filters = this.getFilters().get().map(function (filter) {
        return _this._initFilter($(filter));
      });
      this.loaded = Promise.all(filters);
      this.maybeShowClearAllFilters();
    }

    // init filter button
  }, {
    key: "_initFilterButton",
    value: function _initFilterButton() {
      var _this2 = this;
      this.$filterButtons = this.$preset.find('.apply-filters');
      if (!this.$filterButtons.length) {
        return;
      }

      // manage filter button
      this.$filterButtons.on('click', function (ev) {
        ev.preventDefault();
        _this2.filter();
      }).hide();
    }

    // init generic actions
  }, {
    key: "_initActions",
    value: function _initActions() {
      this.$preset.find('form').on('submit', function (ev) {
        ev.preventDefault();
      });
    }

    // init responsive
  }, {
    key: "_initResponsive",
    value: function _initResponsive() {
      var _this3 = this;
      if (!yith_wcan_shortcodes.modal_on_mobile) {
        return;
      }
      var media = window.matchMedia("(max-width: ".concat(yith_wcan_shortcodes.mobile_media_query, "px)"));
      $(window).on('resize', function () {
        var isMobile = !!media.matches;
        if (isMobile !== _this3.isMobile) {
          _this3.isMobile = isMobile;
          _this3._afterLayoutChange();
        }
      }).resize();
    }

    // init filter
  }, {
    key: "_initFilter",
    value: function _initFilter($filter) {
      var _this4 = this;
      var self = this,
        handleChange = function handleChange(ev) {
          var t = $(this),
            $currentFilter = t.closest('.yith-wcan-filter'),
            multiple = $currentFilter.length ? 'yes' === $currentFilter.data('multiple') : false,
            $item = t.closest('.filter-item'),
            $items = $item.length ? $currentFilter.find('.filter-item').not($item) : [];
          if ($currentFilter.is('.filter-price-slider')) {
            return false;
          }
          if ($item.is('.disabled') && !$item.is('.active')) {
            return false;
          }
          ev.preventDefault();
          $items.length && !multiple && $items.removeClass('active').children('label').find(':input').prop('checked', false).parent('.checked').removeClass('checked');
          $item.length && $item.toggleClass('active');

          // reset active filters.
          self.activeFilters = false;
          self.maybeFilter($filter);
          self.maybeToggleClearAllFilters();
          self.maybeToggleClearFilter($currentFilter);
        };

      // load filter when needed and then init it.
      // eslint-disable-next-line no-shadow
      return this._maybeLoadFilter($filter).then(function ($filter) {
        // handle filter activation/deactivation by click on label (no input involved)
        $filter.on('click', 'a', function (ev) {
          var t = $(this),
            $item = t.closest('.filter-item');
          if (!$item.length || $item.is('.checkbox') || $item.is('.radio')) {
            return;
          }
          handleChange.call(this, ev);
        });

        // handle filter activation/deactivation from input change
        $filter.on('change', ':input', function (ev) {
          var t = $(this),
            $item = t.closest('.filter-item');
          if ($item.is('.disabled') && !$item.is('.active')) {
            t.prop('checked', false);
            return false;
          }
          handleChange.call(this, ev);
        });

        // handle filter activation/deactivation by click on label (there is an input whose state can be switched)
        $filter.on('click', 'label > a', function (ev) {
          var t = $(this),
            $item = t.closest('.filter-item');
          ev.preventDefault();
          if ($item.is('.disabled') && !$item.is('.active')) {
            return false;
          }
          var $input = t.parent().find(':input');
          if ($input.is('[type="radio"]') || $input.is('[type="checkbox"]')) {
            $input.prop('checked', !$input.prop('checked'));
          }
          $input.change();
        });

        // init children items, such as tooltip, dropdowns, etc.
        _this4._initFilterChildren($filter);

        // init clear anchors
        _this4.maybeShowClearFilter($filter);
        return $filter;
      });
    }

    // performs additional operations after filter init, such as adding tooltip, collapsable handles, custom dropdowns, etc.
  }, {
    key: "_initFilterChildren",
    value: function _initFilterChildren($filter) {
      var _this$$preset,
        _this5 = this;
      // init tooltip
      this._initTooltip($filter);

      // init price slider
      this._initPriceSlider($filter);

      // init dropdown
      this._initDropdown($filter);

      // init collapsable
      this._initCollapsable($filter);

      // init show more link
      this._initShowMore($filter);

      // init custom inputs
      if ((_this$$preset = this.$preset) !== null && _this$$preset !== void 0 && _this$$preset.hasClass('custom-style')) {
        this._initCustomInput($filter);
        $filter.on('yith_wcan_dropdown_updated', function (ev) {
          var $dropdown = $(ev.target),
            $current = $dropdown.closest('.yith-wcan-filter');
          _this5._initCustomInput($current);
        });
      }
    }

    // load filter via AJAX
  }, {
    key: "_maybeLoadFilter",
    value: function _maybeLoadFilter($filter) {
      var _this6 = this;
      // if filter doesn't require loading, return it as Promise resolve value.
      if (!$filter.hasClass('filter-placeholder')) {
        return Promise.resolve($filter);
      }

      // otherwise load filter via AJAX.
      return new Promise(function (resolve) {
        var _yith_wcan_shortcodes;
        $.ajax({
          method: 'GET',
          url: yith_wcan_shortcodes.base_url,
          data: _objectSpread({
            'wc-ajax': 'yith_wcan_render_filter',
            _preset_id: _this6.getId(),
            _filter_id: $filter.data('filter-id'),
            security: (_yith_wcan_shortcodes = yith_wcan_shortcodes.nonces) === null || _yith_wcan_shortcodes === void 0 ? void 0 : _yith_wcan_shortcodes.render_filter
          }, _this6.originalFilters)
        }).then(function (data) {
          var _data$data;
          return resolve(_this6._loadFilter($filter, data.success ? data === null || data === void 0 || (_data$data = data.data) === null || _data$data === void 0 ? void 0 : _data$data.html : ''));
        });
      });
    }

    // replace placeholder with actual filter template.
  }, {
    key: "_loadFilter",
    value: function _loadFilter($filter, filterHTML) {
      if (!filterHTML) {
        return $filter.remove();
      }
      var $newFilter = $(filterHTML);
      $filter.replaceWith($newFilter);

      // old filters are outdated, clear them until next .getFilters()
      this.$filters = false;
      return $newFilter;
    }

    // init tooltip
  }, {
    key: "_initTooltip",
    value: function _initTooltip($filter, position) {
      $filter.find('[data-title]').each(function () {
        var t = $(this);
        if (t.hasClass('tooltip-added') || !t.data('title')) {
          return;
        }
        t.on('mouseenter', function () {
          var th = $(this),
            tooltip = null,
            wrapperWidth = th.outerWidth(),
            left = 0,
            width = 0;
          if (!position || 'top' !== position && 'right' !== position) {
            var container = th.closest('.filter-item');
            position = container.hasClass('color') || container.hasClass('label') ? 'top' : 'right';
          }
          tooltip = $('<span>', {
            "class": 'yith-wcan-tooltip',
            html: th.data('title')
          });
          th.append(tooltip);
          width = tooltip.outerWidth() + 6;
          tooltip.outerWidth(width);
          if ('top' === position) {
            left = (wrapperWidth - width) / 2;
          } else {
            left = wrapperWidth + 15;
          }
          tooltip.css({
            left: left.toFixed(0) + 'px'
          }).fadeIn(200);
          th.addClass('with-tooltip');
        }).on('mouseleave', function () {
          var th = $(this);
          th.find('.yith-wcan-tooltip').fadeOut(200, function () {
            th.removeClass('with-tooltip').find('.yith-wcan-tooltip').remove();
          });
        });
        t.addClass('tooltip-added');
      });
    }

    // init dropdown
  }, {
    key: "_initDropdown",
    value: function _initDropdown($filter) {
      var $dropdown = $filter.find('select.filter-dropdown');
      if (!$dropdown.length || $dropdown.hasClass('enhanced')) {
        return;
      }
      if ($dropdown.hasClass('select2-hidden-accessible') && 'undefined' !== typeof $.fn.selectWoo) {
        $dropdown.selectWoo('destroy');
      }
      var self = this,
        hasMore = $dropdown.data('has-more');
      this._initDropdownObject($dropdown, _objectSpread({
        paginate: true,
        hasMore: hasMore,
        perPage: parseInt(yith_wcan_shortcodes.terms_per_page)
      }, hasMore ? {
        getElements: function getElements(search) {
          var _this7 = this;
          return yith_wcan_preset_asyncToGenerator( /*#__PURE__*/yith_wcan_preset_regeneratorRuntime().mark(function _callee() {
            return yith_wcan_preset_regeneratorRuntime().wrap(function _callee$(_context) {
              while (1) switch (_context.prev = _context.next) {
                case 0:
                  if (!((_this7.paginate || !_this7.hasMore) && !search)) {
                    _context.next = 2;
                    break;
                  }
                  return _context.abrupt("return", _this7._items);
                case 2:
                  return _context.abrupt("return", self._getTerms($filter, search));
                case 3:
                case "end":
                  return _context.stop();
              }
            }, _callee);
          }))();
        }
      } : {}));
    }

    // init dropdown object
  }, {
    key: "_initDropdownObject",
    value: function _initDropdownObject($dropdown, opts) {
      return new YITH_WCAN_Dropdown($dropdown, opts);
    }

    // init price slider
  }, {
    key: "_initPriceSlider",
    value: function _initPriceSlider($filter) {
      var _this8 = this;
      if (!$filter.hasClass('filter-price-slider')) {
        return;
      }
      var self = this,
        $container = $filter.find('.price-slider'),
        $minInput = $container.find('.price-slider-min'),
        $maxInput = $container.find('.price-slider-max'),
        min = parseFloat($container.data('min')),
        max = parseFloat($container.data('max')),
        currentMin = parseFloat($minInput.val()),
        currentMax = parseFloat($maxInput.val()),
        step = parseFloat($container.data('step')),
        handleSliderChange = function handleSliderChange() {
          if (self.sliderTimeout) {
            clearTimeout(self.sliderTimeout);
          }
          self.sliderTimeout = setTimeout(function () {
            self.maybeFilter($filter);
          }, 300);
        };
      $filter.find('.price-slider-ui').off('change').ionRangeSlider({
        skin: 'round',
        type: 'double',
        min: min,
        max: max,
        step: step,
        from: currentMin,
        to: currentMax,
        min_interval: step,
        values_separator: ' - ',
        prettify: function prettify(v) {
          return _this8.formatPrice(v);
        },
        onChange: function onChange(data) {
          $minInput.val(data.from);
          $maxInput.val(data.to);
        },
        onFinish: handleSliderChange
      });
      $minInput.add($maxInput).off('change').on('change', handleSliderChange).on('keyup', function (ev) {
        if (!ev.key.match(/[0-9,.]/)) {
          ev.preventDefault();
          return false;
        }
        if (!$minInput.val() || !$maxInput.val()) {
          return;
        }
        handleSliderChange();
      });
    }

    // init collapsable
  }, {
    key: "_initCollapsable",
    value: function _initCollapsable($filter) {
      this._initTitleCollapsable($filter);
      this._initHierarchyCollapsable($filter);
    }

    // init show more filters on click.
  }, {
    key: "_initShowMore",
    value: function _initShowMore($filter) {
      var _this9 = this;
      var $showMore = $filter.find('.filter-content').children('.show-more');
      if (!$showMore.length || $showMore.hasClass('initialized')) {
        return;
      }
      $showMore.addClass('initialized').on('click', function () {
        return _this9._loadItems($filter).then(function () {
          return $showMore.remove();
        });
      });
    }
  }, {
    key: "_getTerms",
    value: function _getTerms($filter, search) {
      var _this10 = this;
      return new Promise(function (resolve) {
        $.ajax({
          method: 'GET',
          beforeSend: function beforeSend() {
            return globals_block($filter);
          },
          complete: function complete() {
            return globals_unblock($filter);
          },
          url: yith_wcan_shortcodes.base_url,
          data: _objectSpread({
            'wc-ajax': 'yith_wcan_get_filter_terms',
            _preset_id: _this10.getId(),
            _filter_id: $filter.data('filter-id'),
            security: yith_wcan_shortcodes.nonces.get_filter_terms,
            search: search
          }, _this10.originalFilters)
        }).then(function (data) {
          var _data$data2;
          var $items = data.success ? data === null || data === void 0 || (_data$data2 = data.data) === null || _data$data2 === void 0 ? void 0 : _data$data2.items : {};
          resolve($items);
        });
      });
    }

    // load new page of terms via AJAX
  }, {
    key: "_loadItems",
    value: function _loadItems($filter) {
      var _this11 = this;
      return new Promise(function (resolve) {
        $.ajax({
          method: 'GET',
          beforeSend: function beforeSend() {
            return globals_block($filter);
          },
          complete: function complete() {
            return globals_unblock($filter);
          },
          url: yith_wcan_shortcodes.base_url,
          data: _objectSpread({
            'wc-ajax': 'yith_wcan_render_remaining_terms',
            _preset_id: _this11.getId(),
            _filter_id: $filter.data('filter-id'),
            security: yith_wcan_shortcodes.nonces.render_remaining_terms
          }, _this11.originalFilters)
        }).then(function (data) {
          var _data$data3;
          var $items = $filter.find('.filter-content').children('.filter-items');

          // append new items to filter existing ones.
          $items.append(data.success ? data === null || data === void 0 || (_data$data3 = data.data) === null || _data$data3 === void 0 ? void 0 : _data$data3.html : '');

          // perform additional initalization of the new items in the filter.
          _this11._initFilterChildren($filter);

          // resolve promise returning jQuery set of the new elements.
          resolve($items);
        });
      });
    }

    // init toggle on click of the title
  }, {
    key: "_initTitleCollapsable",
    value: function _initTitleCollapsable($filter) {
      var $title = $filter.find('.collapsable');
      if (!$title.length || $title.hasClass('toggle-initialized')) {
        return;
      }
      this._initToggle($title, $title, $filter.find('.filter-content'));
    }

    // init toggle on click of the parent li
  }, {
    key: "_initHierarchyCollapsable",
    value: function _initHierarchyCollapsable($filter) {
      var $items = $filter.find('.hierarchy-collapsable');
      if (!$items.length) {
        return;
      }

      // set parents of currently active term as open
      var self = this,
        active = $filter.find('.active');
      if (active.length) {
        active.parents('.hierarchy-collapsable').removeClass('closed').addClass('opened');
        if (active.hasClass('hierarchy-collapsable') && yith_wcan_shortcodes.show_current_children) {
          active.removeClass('closed').addClass('opened');
        }
      }
      $items.each(function () {
        var $t = $(this);
        if ($t.hasClass('toggle-initialized')) {
          return;
        }
        var $toggle = $('<span/>', {
          "class": 'toggle-handle'
        });
        $toggle.appendTo($t);
        self._initToggle($toggle, $t, $t.children('ul.filter-items'));
      });
    }

    // init toggle to generic toggle/target pair
  }, {
    key: "_initToggle",
    value: function _initToggle($toggle, $container, $target) {
      var _this12 = this;
      if ($container.hasClass('toggle-initialized')) {
        return;
      }
      if ($container.hasClass('closed')) {
        $target.hide();
      }
      $toggle.off('click').on('click', function (ev) {
        ev.stopPropagation();
        ev.preventDefault();
        _this12.toggle($target, $container);
        $target.trigger('yith_wcan_after_toggle_element', [$container]);
      });
      $container.addClass('toggle-initialized');
    }

    // init custom input
  }, {
    key: "_initCustomInput",
    value: function _initCustomInput($filter) {
      $filter.find(':input').each(function () {
        var input = $(this),
          type = input.attr('type'),
          containerClass = "".concat(type, "button"),
          container;
        if ('checkbox' !== type && 'radio' !== type) {
          return;
        }
        if (input.closest(".".concat(containerClass)).length) {
          return;
        }
        if (input.is(':checked')) {
          containerClass += ' checked';
        }
        container = $('<span/>', {
          "class": containerClass
        });
        input.wrap(container).on('change', function () {
          var t = $(this);
          t.prop('checked') ? t.parent().addClass('checked') : t.parent().removeClass('checked');
        });
      });
    }

    // register initial status
  }, {
    key: "_regiterStatus",
    value: function _regiterStatus() {
      this.originalFilters = this.mergeProperties(yith_wcan_shortcodes.query_vars, this.getFiltersProperties());
    }

    // trigger handling after layout change
  }, {
    key: "_afterLayoutChange",
    value: function _afterLayoutChange() {
      var _this13 = this;
      if (this.isMobile) {
        var _this$$filterButtons;
        this.$preset.addClass('filters-modal').attr('role', 'dialog').attr('tabindex', '-1').hide();
        this._addCloseModalButton();
        this._addApplyFiltersModalButton();
        this.loaded.then(function () {
          return _this13._switchToCollapsables();
        });
        (_this$$filterButtons = this.$filterButtons) === null || _this$$filterButtons === void 0 || _this$$filterButtons.hide();
      } else {
        var _this$$filterButtons2;
        this.$preset.removeClass('filters-modal').removeClass('open').removeAttr('role').removeAttr('tabindex').show();
        $('body').css('overflow', 'auto').removeClass('yith-wcan-preset-modal-open');
        this._removeCloseModalButton();
        this._removeApplyFiltersModalButton();
        this.loaded.then(function () {
          return _this13._switchBackCollapsables();
        });
        (_this$$filterButtons2 = this.$filterButtons) === null || _this$$filterButtons2 === void 0 || _this$$filterButtons2.show();
      }
    }

    // add modal close button
  }, {
    key: "_addCloseModalButton",
    value: function _addCloseModalButton() {
      var $closeButton = $('<a/>', {
        "class": 'close-button',
        html: '&times;',
        'data-dismiss': 'modal',
        'aria-label': yith_wcan_shortcodes.labels.close
      });
      $closeButton.prependTo(this.$preset).on('click', this.closeModal.bind(this));
      this.modalElements.closeButton = $closeButton;
    }

    // remove modal close button
  }, {
    key: "_removeCloseModalButton",
    value: function _removeCloseModalButton() {
      var _this$modalElements;
      (_this$modalElements = this.modalElements) === null || _this$modalElements === void 0 || (_this$modalElements = _this$modalElements.closeButton) === null || _this$modalElements === void 0 || _this$modalElements.remove();
    }

    // show main filter button for the modal
  }, {
    key: "_addApplyFiltersModalButton",
    value: function _addApplyFiltersModalButton() {
      var _this14 = this;
      var $filterButton = $('<button/>', {
        "class": 'apply-filters main-modal-button',
        html: yith_wcan_shortcodes.labels.show_results,
        'data-dismiss': 'modal'
      });
      $filterButton.appendTo(this.$preset).on('click', function () {
        _this14.filter();
        _this14.closeModal();
      });
      this.modalElements.applyFiltersButton = $filterButton;
    }

    // hide main filter button for the modal
  }, {
    key: "_removeApplyFiltersModalButton",
    value: function _removeApplyFiltersModalButton() {
      var _this$modalElements2;
      (_this$modalElements2 = this.modalElements) === null || _this$modalElements2 === void 0 || (_this$modalElements2 = _this$modalElements2.applyFiltersButton) === null || _this$modalElements2 === void 0 || _this$modalElements2.remove();
    }

    // convert all filters to collapsable
  }, {
    key: "_switchToCollapsables",
    value: function _switchToCollapsables() {
      var self = this;
      this.getFilters().each(function () {
        var $filter = $(this),
          $title = $filter.find('.filter-title');
        if (!$title.length || $title.hasClass('collapsable')) {
          return;
        }
        $title.addClass('collapsable').data('disable-collapse', true);
        self._initTitleCollapsable($filter);
      });
    }

    // switch back filters to their previous collapsable state
  }, {
    key: "_switchBackCollapsables",
    value: function _switchBackCollapsables() {
      this.getFilters().each(function () {
        var $filter = $(this),
          $title = $filter.find('.filter-title');
        if (!$title.length || !$title.hasClass('collapsable') || !$title.data('disable-collapse')) {
          return;
        }
        $title.removeClass('collapsable').removeData('disable-collapse', true).off('click');
        $filter.find('.filter-content').show();
      });
    }

    // close all collpasable before showing modal
  }, {
    key: "_openAllCollapsables",
    value: function _openAllCollapsables() {
      var _this15 = this;
      this.getFilters().not('.no-title').not(function (i, v) {
        return _this15.isFilterActive($(v));
      }).find('.filter-content').show().end().find('.filter-title').removeClass('closed').addClass('opened');
    }

    // close all collpasable before showing modal
  }, {
    key: "_closeAllCollapsables",
    value: function _closeAllCollapsables() {
      var _this16 = this;
      this.getFilters().not('.no-title').not(function (i, v) {
        return _this16.isFilterActive($(v));
      }).find('.filter-content').hide().end().find('.filter-title').addClass('closed').removeClass('opened');
    }

    // update status change flag, if filters have changed
  }, {
    key: "maybeRegisterStatusChange",
    value: function maybeRegisterStatusChange() {
      var currentFilters = this.getFiltersProperties(),
        currentStr = JSON.stringify(currentFilters),
        originalStr = JSON.stringify(this.originalFilters);
      this.dirty = currentStr !== originalStr;
    }

    // apply filters when possible
  }, {
    key: "maybeFilter",
    value: function maybeFilter($initiator) {
      // register status change
      this.maybeRegisterStatusChange();

      // skip if filters are inhibited.
      if (this.inhibitFilters) {
        return;
      }

      // filter, or show filter button.
      if (yith_wcan_shortcodes.instant_filters && !this.isMobile) {
        this.filter();
      } else if (!yith_wcan_shortcodes.instant_filters && !this.isMobile) {
        var _this$$filterButtons3, _this$$filterButtons4;
        this.dirty ? (_this$$filterButtons3 = this.$filterButtons) === null || _this$$filterButtons3 === void 0 ? void 0 : _this$$filterButtons3.show() : (_this$$filterButtons4 = this.$filterButtons) === null || _this$$filterButtons4 === void 0 ? void 0 : _this$$filterButtons4.hide();
      } else if (this.isMobile && this.dirty) {
        var _this$modalElements$a;
        this.$preset.addClass('with-filter-button');
        (_this$modalElements$a = this.modalElements.applyFiltersButton) === null || _this$modalElements$a === void 0 || _this$modalElements$a.show();
      }
    }

    // main filtering method
  }, {
    key: "filter",
    value: function filter() {
      var _window,
        _filter$doFilter,
        _this17 = this;
      var filter = (_window = window) === null || _window === void 0 ? void 0 : _window.product_filter;
      filter === null || filter === void 0 || (_filter$doFilter = filter.doFilter(this.getFiltersProperties(), this.target, this.preset)) === null || _filter$doFilter === void 0 || _filter$doFilter.done(function () {
        var newPreset = $(_this17.preset);
        if (newPreset.length && yith_wcan_shortcodes.scroll_top) {
          // by default, scroll till top of first preset in the page.
          var targetOffset = newPreset.offset().top;
          if (!!yith_wcan_shortcodes.scroll_target) {
            // when we have a specific target, use that for the offset.
            var $scrollTarget = $(yith_wcan_shortcodes.scroll_target);
            targetOffset = $scrollTarget.length ? $scrollTarget.offset().top : targetOffset;
          } else if (_this17.isMobile) {
            // otherwise, if we're on mobile, scroll to the top of the page
            // (preset could be in an unexpected location).
            targetOffset = 100;
          }
          $('body, html').animate({
            scrollTop: targetOffset - 100
          });
        }

        // register new filters, clear status flag
        _this17._regiterStatus();
        _this17.dirty = false;
      });
      if (this.isMobile) {
        var _this$modalElements$a2;
        this.$preset.removeClass('with-filter-button');
        (_this$modalElements$a2 = this.modalElements.applyFiltersButton) === null || _this$modalElements$a2 === void 0 || _this$modalElements$a2.hide();
        this.closeModal();
      }
    }

    // returns preset id
  }, {
    key: "getId",
    value: function getId() {
      return this.$preset.data('preset-id');
    }

    // get all filter nodes
  }, {
    key: "getFilters",
    value: function getFilters() {
      if (false === this.$filters) {
        this.$filters = this.$preset.find('.yith-wcan-filter');
      }
      return this.$filters;
    }

    // retrieves all filters that we want to apply
  }, {
    key: "getActiveFilters",
    value: function getActiveFilters() {
      if (false === this.activeFilters) {
        this.activeFilters = this.getFiltersProperties();
      }
      return this.activeFilters;
    }

    // check whether there is any filter active
  }, {
    key: "isAnyFilterActive",
    value: function isAnyFilterActive() {
      return !!Object.keys(this.getActiveFilters()).length;
    }

    // checks whether current filter is active
  }, {
    key: "isFilterActive",
    value: function isFilterActive($filter) {
      var filterType = $filter.data('filter-type'),
        active,
        filteredActive;
      switch (filterType) {
        case 'tax':
        case 'review':
        case 'price_range':
          var $dropdown = $filter.find('.filter-dropdown');
          if ($dropdown.length) {
            var val = $dropdown.val();
            active = 'object' === yith_wcan_preset_typeof(val) ? !!(val !== null && val !== void 0 && val.length) : !!val;
            break;
          }

        // if we use type other than dropdown, fallthrough
        case 'stock_sale':
          active = $filter.find('.filter-item').filter('.active').length;
          break;
        case 'price_slider':
          var step = parseFloat($filter.find('.price-slider').data('step')),
            min = parseFloat($filter.find('.price-slider').data('min')),
            max = parseFloat($filter.find('.price-slider').data('max')),
            currentMin = parseFloat($filter.find('.price-slider-min').val()),
            currentMax = parseFloat($filter.find('.price-slider-max').val());
          active = Math.abs(currentMin - min) >= step || Math.abs(currentMax - max) >= step;
          break;
        case 'orderby':
          active = 'menu_order' !== $filter.find('.filter-order-by').val();
          break;
        default:
          active = false;
          break;
      }
      filteredActive = $filter.triggerHandler('yith_wcan_is_filter_active', [active, this]);
      active = typeof filteredActive !== 'undefined' ? filteredActive : active;
      return active;
    }

    // count the number of active items per filter
  }, {
    key: "countActiveItems",
    value: function countActiveItems($filter) {
      var filterType = $filter.data('filter-type'),
        count;
      switch (filterType) {
        case 'tax':
        case 'review':
        case 'price_range':
          var $dropdown = $filter.find('.filter-dropdown');
          if ($dropdown.length) {
            var val = $dropdown.val();
            count = 'object' === yith_wcan_preset_typeof(val) ? val === null || val === void 0 ? void 0 : val.length : +!!val;
            break;
          }

        // if we use type other than dropdown, fallthrough
        case 'stock_sale':
          count = $filter.find('.filter-items').find('.active').length;
          break;
        case 'orderby':
          if (this.isFilterActive($filter)) {
            count = 1;
          }
          break;
        case 'price_slider':
        default:
          count = 0;
          break;
      }
      return count;
    }

    // retrieves filter properties for the filter
  }, {
    key: "getFilterProperties",
    value: function getFilterProperties($filter) {
      var filterType = $filter.data('filter-type'),
        multiple = 'yes' === $filter.data('multiple'),
        $dropdown = $filter.find('.filter-dropdown'),
        properties = {},
        filteredProperties,
        $active;
      switch (filterType) {
        case 'tax':
          var activeTerms = [],
            taxonomy = $filter.data('taxonomy'),
            isAttr = 0 === taxonomy.indexOf('filter'),
            relation = $filter.data('relation');
          if ($dropdown.length) {
            if (multiple) {
              activeTerms = $dropdown.val();
            } else {
              activeTerms.push($dropdown.val());
            }
          } else {
            $active = $filter.find('.filter-item').filter('.active').children('a, label');
            activeTerms = $active.get().reduce(function (a, v) {
              var val;
              v = $(v);
              val = v.is('label') ? v.find(':input').val() : v.data('term-slug');
              if (!val) {
                return a;
              }
              a.push(val);
              return a;
            }, activeTerms);
          }
          if (!multiple) {
            properties[taxonomy] = activeTerms.pop();
          } else {
            var glue = !isAttr && 'and' === relation ? '+' : ',';
            properties[taxonomy] = activeTerms.join(glue);
          }
          if (isAttr) {
            properties[taxonomy.replace('filter_', 'query_type_')] = relation;
          }
          break;
        case 'review':
          if ($dropdown.length) {
            properties.rating_filter = $dropdown.val();
          } else {
            $active = $filter.find('.filter-item').filter('.active').children('a, label');
            if (!multiple) {
              $active = $active.first();
              properties.rating_filter = $active.is('label') ? $active.find(':input').val() : $active.data('rating');
            } else {
              properties.rating_filter = $active.get().reduce(function (a, v) {
                var val;
                v = $(v);
                val = v.is('label') ? v.find(':input').val() : v.data('rating');
                if (!val) {
                  return a;
                }
                a.push(val);
                return a;
              }, []).join(',');
            }
          }
          break;
        case 'price_range':
          if ($dropdown.length) {
            if (multiple) {
              properties.price_ranges = $dropdown.val().join(',');
            } else {
              properties.min_price = $dropdown.val().split('-')[0];
              properties.max_price = $dropdown.val().split('-')[1];
            }
          } else {
            $active = $filter.find('.filter-item').filter('.active').children('a, label');
            if (multiple) {
              properties.price_ranges = $active.get().reduce(function (a, v) {
                var min = $(v).data('range-min'),
                  max = $(v).data('range-max');
                a += (max ? "".concat(min, "-").concat(max) : min) + ',';
                return a;
              }, '').replace(/^(.*),$/, '$1');
            } else {
              properties.min_price = parseFloat($active.first().data('range-min'));
              properties.max_price = parseFloat($active.first().data('range-max'));
            }
          }
          break;
        case 'price_slider':
          properties.min_price = parseFloat($filter.find('.price-slider-min').val());
          properties.max_price = parseFloat($filter.find('.price-slider-max').val());
          break;
        case 'stock_sale':
          if ($filter.find('.filter-on-sale').is('.active')) {
            properties.onsale_filter = 1;
          }
          if ($filter.find('.filter-in-stock').is('.active')) {
            properties.instock_filter = 1;
          }
          if ($filter.find('.filter-featured').is('.active')) {
            properties.featured_filter = 1;
          }
          break;
        case 'orderby':
          properties.orderby = $filter.find('.filter-order-by').val();
          break;
        default:
          break;
      }
      filteredProperties = $filter.triggerHandler('yith_wcan_filter_properties', [properties, self]);
      properties = typeof filteredProperties !== 'undefined' ? filteredProperties : properties;
      return properties;
    }

    // retrieves properties for all filters of the preset
  }, {
    key: "getFiltersProperties",
    value: function getFiltersProperties() {
      var properties = {};
      var self = this;
      this.getFilters().each(function () {
        var $filter = $(this);
        if (self.isFilterActive($filter)) {
          var filterProperties = self.getFilterProperties($filter);
          properties = self.mergeProperties(properties, filterProperties, $filter);
        }
      });
      return properties;
    }

    // retrieve filters matching any of the properties passed
  }, {
    key: "getFiltersByProperties",
    value: function getFiltersByProperties(properties) {
      var self = this;
      return this.getFilters().filter(function () {
        var $filter = $(this);
        if (self.isFilterActive($filter)) {
          var filterProperties = self.getFilterProperties($filter),
            hasProp = false;
          var _iterator = _createForOfIteratorHelper(properties),
            _step;
          try {
            for (_iterator.s(); !(_step = _iterator.n()).done;) {
              var prop = _step.value;
              if (['min_price', 'max_price', 'price_ranges'].includes(prop) && (filterProperties.min_price || filterProperties.price_ranges)) {
                hasProp = true;
                break;
              } else if (filterProperties[prop]) {
                hasProp = true;
                break;
              }
            }
          } catch (err) {
            _iterator.e(err);
          } finally {
            _iterator.f();
          }
          return hasProp;
        }
        return false;
      });
    }

    // show clear selection anchor
  }, {
    key: "maybeToggleClearFilter",
    value: function maybeToggleClearFilter($filter) {
      if (!this.isFilterActive($filter)) {
        this.maybeHideClearFilter($filter);
      } else {
        this.maybeShowClearFilter($filter);
      }
    }

    // show clear all selections anchor
  }, {
    key: "maybeToggleClearAllFilters",
    value: function maybeToggleClearAllFilters() {
      if (!this.isAnyFilterActive()) {
        this.maybeHideClearAllFilters();
      } else {
        this.maybeShowClearAllFilters();
      }
    }

    // show clear selection anchor
  }, {
    key: "maybeShowClearFilter",
    value: function maybeShowClearFilter($filter) {
      var _this18 = this;
      if (!this.isFilterActive($filter) || !yith_wcan_shortcodes.show_clear_filter) {
        return;
      }

      // remove clear selection link if already added.
      $filter.find('.clear-selection').remove();

      // add new clear selection link.
      $('<a/>', {
        "class": 'clear-selection',
        text: yith_wcan_shortcodes.labels.clear_selection,
        role: 'button'
      }).prependTo($filter.find('.filter-content')).on('click', function (ev) {
        ev.preventDefault();
        _this18.deactivateFilter($filter, false, yith_wcan_shortcodes.instant_filters);
        _this18.maybeHideClearFilter($filter);
        if (yith_wcan_shortcodes.instant_filters) {
          _this18.closeModal();
        }
      });
    }

    // show clearAll anchor, when on mobile layout
  }, {
    key: "maybeShowClearAllFilters",
    value: function maybeShowClearAllFilters() {
      var _this19 = this;
      if (!this.isAnyFilterActive() || !this.isMobile) {
        return;
      }

      // remove clear selection link if already added.
      this.$preset.find('.clear-selection').remove();

      // add new clear selection link.
      $('<a/>', {
        "class": 'clear-selection',
        text: yith_wcan_shortcodes.labels.clear_all_selections,
        role: 'button'
      }).prependTo(this.$preset.find('.filters-container')).on('click', function (ev) {
        ev.preventDefault();
        _this19.deactivateAllFilters(yith_wcan_shortcodes.instant_filters);
        _this19.maybeHideClearAllFilters();
        if (yith_wcan_shortcodes.instant_filters) {
          _this19.closeModal();
        }
      });
    }

    // hide clear selection anchor
  }, {
    key: "maybeHideClearFilter",
    value: function maybeHideClearFilter($filter) {
      if (this.isFilterActive($filter) || !yith_wcan_shortcodes.show_clear_filter) {
        return;
      }

      // remove clear selection link.
      $filter.find('.clear-selection').remove();
    }

    // show clearAll anchor, when on mobile layout
  }, {
    key: "maybeHideClearAllFilters",
    value: function maybeHideClearAllFilters() {
      if (this.isAnyFilterActive()) {
        return;
      }

      // remove clear selection link.
      this.$preset.find('.filters-container').children('.clear-selection').remove();
    }

    // deactivate filter
  }, {
    key: "deactivateFilter",
    value: function deactivateFilter($filter, properties, doFilter) {
      var filterType = $filter.data('filter-type'),
        $items = $filter.find('.filter-item'),
        $activeItems = $items.filter('.active'),
        $dropdown = $filter.find('.filter-dropdown');
      this.inhibitFilters = true;
      switch (filterType) {
        case 'tax':
          var taxonomy = $filter.data('taxonomy');
          if ($dropdown.length) {
            if (!properties) {
              $dropdown.find('option').prop('selected', false);
            } else {
              $dropdown.find('option').each(function () {
                var $option = $(this);
                if ($option.val().toString() === properties[taxonomy].toString()) {
                  $option.prop('selected', false);
                }
              });
            }
            $dropdown.change();
          } else if (!properties) {
            $activeItems.children('label').children('a').click();
            $activeItems.removeClass('active');
          } else {
            $activeItems.each(function () {
              var $item = $(this),
                $label = $item.children('label'),
                $anchor = $item.children('a'),
                value;
              value = $label.length ? $label.find(':input').val() : $anchor.data('term-slug');
              if (value.toString() === properties[taxonomy].toString()) {
                $item.children('label').children('a').click();
                $item.removeClass('active');
              }
            });
          }
          break;
        case 'review':
          if ($dropdown.length) {
            if (!properties) {
              $dropdown.find('option').prop('selected', false);
            } else {
              $dropdown.find('option').each(function () {
                var $option = $(this);
                if ($option.val() === properties.rating_filter) {
                  $option.prop('selected', false);
                }
              });
            }
            $dropdown.change();
          } else if (!properties) {
            $activeItems.children('label').children('a').click();
            $activeItems.removeClass('active');
          } else {
            $activeItems.each(function () {
              var $item = $(this),
                $label = $item.children('label'),
                $anchor = $item.children('a'),
                value;
              value = $label.length ? $label.find(':input').val() : $anchor.data('rating');
              if (value === properties.rating_filter) {
                $item.children('label').children('a').click();
                $item.removeClass('active');
              }
            });
          }
          break;
        case 'price_range':
          if ($dropdown.length) {
            if (!properties) {
              $dropdown.find('option').prop('selected', false);
            } else {
              $dropdown.find('option').each(function () {
                var $option = $(this),
                  formattedRange = properties.min_price + (properties.max_price ? "-".concat(properties.max_price) : '');
                if ($option.val() === formattedRange) {
                  $option.prop('selected', false);
                }
              });
            }
            $dropdown.change();
          } else if (!properties) {
            $activeItems.children('label').children('a').click();
            $activeItems.removeClass('active');
          } else {
            $activeItems.each(function () {
              var $item = $(this),
                $label = $item.children('label'),
                $anchor = $item.children('a'),
                formattedRange,
                value;
              value = $label.length ? $label.find(':input').val() : $anchor.data('min_price') + ($anchor.data('max_price') ? '-' + $anchor.data('max_price') : '');
              if (properties.min_price) {
                formattedRange = properties.min_price + (properties.max_price ? '-' + properties.max_price : '');
              } else if (properties.price_ranges) {
                formattedRange = properties.price_ranges;
              }
              if (value === formattedRange) {
                $item.children('label').children('a').click();
                $item.removeClass('active');
              }
            });
          }
          break;
        case 'price_slider':
          var $priceSlider = $filter.find('.price-slider');
          $filter.find('.price-slider-min').val($priceSlider.data('min'));
          $filter.find('.price-slider-max').val($priceSlider.data('max')).change();
          break;
        case 'orderby':
          $filter.find('select').val('menu_order');
          break;
        case 'stock_sale':
          if (!properties) {
            $filter.find('.filter-in-stock').find(':input').prop('checked', false).change();
            $filter.find('.filter-on-sale').find(':input').prop('checked', false).change();
            $filter.find('.filter-featured').find(':input').prop('checked', false).change();
            $items.removeClass('active');
          } else {
            if (properties !== null && properties !== void 0 && properties.instock_filter) {
              $filter.find('.filter-in-stock').find(':input').prop('checked', false).change().closest('.filter-item').removeClass('active');
            }
            if (properties !== null && properties !== void 0 && properties.onsale_filter) {
              $filter.find('.filter-on-sale').find(':input').prop('checked', false).change().closest('.filter-item').removeClass('active');
            }
            if (properties !== null && properties !== void 0 && properties.featured_filter) {
              $filter.find('.filter-featured').find(':input').prop('checked', false).change().closest('.filter-item').removeClass('active');
            }
          }
          break;
        default:
          $items.removeClass('active');
          break;
      }
      this.inhibitFilters = false;
      this.activeFilters = false;
      if (doFilter) {
        this.filter();
      }
    }

    // deactivate all filters
  }, {
    key: "deactivateAllFilters",
    value: function deactivateAllFilters(doFilter) {
      var self = this,
        $filters = this.getFilters();
      $filters.each(function () {
        var $filter = $(this);
        self.deactivateFilter($filter);
      });
      this.activeFilters = false;
      if (doFilter) {
        this.filter();
      }
      return true;
    }

    // deactivate filters that matches a specific set of properties
  }, {
    key: "deactivateFilterByProperties",
    value: function deactivateFilterByProperties(properties, doFilter) {
      var self = this,
        $filters = this.getFiltersByProperties(Object.keys(properties));
      if (!$filters.length) {
        return false;
      }
      $filters.each(function () {
        var $filter = $(this);
        self.deactivateFilter($filter, properties, doFilter);
      });
      return true;
    }

    // open toggle
  }, {
    key: "toggle",
    value: function toggle($target, $container, status) {
      if ('undefined' === typeof status) {
        status = $container.hasClass('closed');
      }
      var method = status ? 'slideDown' : 'slideUp',
        classToAdd = status ? 'opened' : 'closed',
        classToRemove = status ? 'closed' : 'opened';
      $target[method](400, function () {
        $container.addClass(classToAdd).removeClass(classToRemove);
        $target.trigger('yith_wcan_toggle_element', [$container, status]);
      });
    }

    // open filter if title is collapsable
  }, {
    key: "openFilter",
    value: function openFilter($filter) {
      var $title = $filter.find('.collapsable');
      if (!$title.length) {
        return;
      }
      this.toggle($filter.find('.filter-content'), $title, true);
    }

    // open all filters in a preset
  }, {
    key: "openAllFilters",
    value: function openAllFilters($filter) {
      var self = this,
        $filters = this.getFilters();
      $filters.each(function () {
        self.openFilter($(this));
      });
    }

    // close filter if title is collapsable
  }, {
    key: "closeFilter",
    value: function closeFilter($filter) {
      var $title = $filter.find('.collapsable');
      if (!$title.length) {
        return;
      }
      this.toggle($filter.find('.filter-content'), $title, false);
    }

    // close all filters in a preset; if a specific filter is pased as parameter, system will keep it open
  }, {
    key: "closeAllFilters",
    value: function closeAllFilters($filter) {
      var self = this,
        $filters = this.getFilters();
      $filters.each(function () {
        self.closeFilter($(this));
      });
      if ('undefined' !== typeof $filter) {
        this.openFilter($filter);
      }
    }

    // open filters as a modal, when in mobile layout
  }, {
    key: "openModal",
    value: function openModal() {
      var _this20 = this;
      if (!this.isMobile) {
        return;
      }
      if (yith_wcan_shortcodes.toggles_open_on_modal) {
        this._openAllCollapsables();
      } else {
        this._closeAllCollapsables();
      }
      $('body').css('overflow', 'hidden').addClass('yith-wcan-preset-modal-open');
      this.$preset.show();
      setTimeout(function () {
        _this20.$preset.addClass('open');
      }, 100);
    }

    // close filters modal, when in mobile layout
  }, {
    key: "closeModal",
    value: function closeModal() {
      var _this21 = this;
      if (!this.isMobile) {
        return;
      }
      this.$preset.removeClass('open');
      setTimeout(function () {
        _this21.$preset.hide();
        $('body').css('overflow', 'auto').removeClass('yith-wcan-preset-modal-open');
      }, 300);
    }

    // utility that formats the price according to store configuration.
  }, {
    key: "formatPrice",
    value: function formatPrice(price) {
      if ('undefined' !== typeof accounting) {
        var _yith_wcan_shortcodes2, _yith_wcan_shortcodes3, _yith_wcan_shortcodes4, _yith_wcan_shortcodes5;
        price = accounting.formatMoney(price, {
          symbol: (_yith_wcan_shortcodes2 = yith_wcan_shortcodes.currency_format) === null || _yith_wcan_shortcodes2 === void 0 ? void 0 : _yith_wcan_shortcodes2.symbol,
          decimal: (_yith_wcan_shortcodes3 = yith_wcan_shortcodes.currency_format) === null || _yith_wcan_shortcodes3 === void 0 ? void 0 : _yith_wcan_shortcodes3.decimal,
          thousand: (_yith_wcan_shortcodes4 = yith_wcan_shortcodes.currency_format) === null || _yith_wcan_shortcodes4 === void 0 ? void 0 : _yith_wcan_shortcodes4.thousand,
          precision: 0,
          format: (_yith_wcan_shortcodes5 = yith_wcan_shortcodes.currency_format) === null || _yith_wcan_shortcodes5 === void 0 ? void 0 : _yith_wcan_shortcodes5.format
        });
      }
      return price;
    }

    // utility that merges together sets of filter properties
  }, {
    key: "mergeProperties",
    value: function mergeProperties(set1, set2, $filter) {
      // search for common properties
      for (var prop in set2) {
        if (!set2.hasOwnProperty(prop)) {
          continue;
        }
        if (!!set1[prop]) {
          switch (prop) {
            case 'rating_filter':
            case 'min_price':
            case 'max_price':
            case 'onsale_filter':
            case 'instock_filter':
            case 'orderby':
              // just override default value
              set1[prop] = set2[prop];
              break;
            default:
              if (0 === prop.indexOf('query_type_')) {
                // query_type param
                set1[prop] = set2[prop];
              } else {
                // we're dealing with taxonomy
                var relation = ($filter === null || $filter === void 0 ? void 0 : $filter.data('relation')) || 'and',
                  isAttr = 0 === prop.indexOf('filter_'),
                  glue = !isAttr && 'and' === relation ? '+' : ',';
                var newValue = set1[prop].replace(',', glue) + glue + set2[prop].replace(',', glue);
                newValue = newValue.split(glue).filter(function (value, index, arr) {
                  return arr.indexOf(value) === index;
                }).join(glue);
                set1[prop] = newValue;
                if (isAttr) {
                  var queryTypeParam = prop.replace('filter_', 'query_type_');
                  set1[queryTypeParam] = 'and';
                  set2[queryTypeParam] = 'and';
                }
              }
          }
          delete set2[prop];
        }
      }
      $.extend(set1, set2);
      return set1;
    }
  }]);
}();

;// CONCATENATED MODULE: ./assets/js/shortcodes/index.js


/* global globalThis, jQuery, yith_wcan_shortcodes, accounting */



jQuery(function ($) {
  $(document).on('yith_wcan_init_shortcodes yith_plugin_fw_gutenberg_success_do_shortcode', function () {
    $('.yith-wcan-filters').not('.enhanced').each(function () {
      new YITH_WCAN_Preset($(this));
    });
    $('.yith-wcan-reset-filters').not('.enhanced').each(function () {
      new YITH_WCAN_Reset_Button($(this));
    });
  }).trigger('yith_wcan_init_shortcodes');
  globalThis.product_filter = new YITH_WCAN_Filter();
});
/******/ })()
;
//# sourceMappingURL=yith-wcan-shortcodes.js.map