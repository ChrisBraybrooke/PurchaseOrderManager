webpackJsonp([0],{

/***/ 41:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(46)
}
var normalizeComponent = __webpack_require__(44)
/* script */
var __vue_script__ = __webpack_require__(48)
/* template */
var __vue_template__ = __webpack_require__(54)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/ProductAddComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-198bddf8", Component.options)
  } else {
    hotAPI.reload("data-v-198bddf8", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 43:
/***/ (function(module, exports, __webpack_require__) {

/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
  Modified by Evan You @yyx990803
*/

var hasDocument = typeof document !== 'undefined'

if (typeof DEBUG !== 'undefined' && DEBUG) {
  if (!hasDocument) {
    throw new Error(
    'vue-style-loader cannot be used in a non-browser environment. ' +
    "Use { target: 'node' } in your Webpack config to indicate a server-rendering environment."
  ) }
}

var listToStyles = __webpack_require__(45)

/*
type StyleObject = {
  id: number;
  parts: Array<StyleObjectPart>
}

type StyleObjectPart = {
  css: string;
  media: string;
  sourceMap: ?string
}
*/

var stylesInDom = {/*
  [id: number]: {
    id: number,
    refs: number,
    parts: Array<(obj?: StyleObjectPart) => void>
  }
*/}

var head = hasDocument && (document.head || document.getElementsByTagName('head')[0])
var singletonElement = null
var singletonCounter = 0
var isProduction = false
var noop = function () {}
var options = null
var ssrIdKey = 'data-vue-ssr-id'

// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
// tags it will allow on a page
var isOldIE = typeof navigator !== 'undefined' && /msie [6-9]\b/.test(navigator.userAgent.toLowerCase())

module.exports = function (parentId, list, _isProduction, _options) {
  isProduction = _isProduction

  options = _options || {}

  var styles = listToStyles(parentId, list)
  addStylesToDom(styles)

  return function update (newList) {
    var mayRemove = []
    for (var i = 0; i < styles.length; i++) {
      var item = styles[i]
      var domStyle = stylesInDom[item.id]
      domStyle.refs--
      mayRemove.push(domStyle)
    }
    if (newList) {
      styles = listToStyles(parentId, newList)
      addStylesToDom(styles)
    } else {
      styles = []
    }
    for (var i = 0; i < mayRemove.length; i++) {
      var domStyle = mayRemove[i]
      if (domStyle.refs === 0) {
        for (var j = 0; j < domStyle.parts.length; j++) {
          domStyle.parts[j]()
        }
        delete stylesInDom[domStyle.id]
      }
    }
  }
}

function addStylesToDom (styles /* Array<StyleObject> */) {
  for (var i = 0; i < styles.length; i++) {
    var item = styles[i]
    var domStyle = stylesInDom[item.id]
    if (domStyle) {
      domStyle.refs++
      for (var j = 0; j < domStyle.parts.length; j++) {
        domStyle.parts[j](item.parts[j])
      }
      for (; j < item.parts.length; j++) {
        domStyle.parts.push(addStyle(item.parts[j]))
      }
      if (domStyle.parts.length > item.parts.length) {
        domStyle.parts.length = item.parts.length
      }
    } else {
      var parts = []
      for (var j = 0; j < item.parts.length; j++) {
        parts.push(addStyle(item.parts[j]))
      }
      stylesInDom[item.id] = { id: item.id, refs: 1, parts: parts }
    }
  }
}

function createStyleElement () {
  var styleElement = document.createElement('style')
  styleElement.type = 'text/css'
  head.appendChild(styleElement)
  return styleElement
}

function addStyle (obj /* StyleObjectPart */) {
  var update, remove
  var styleElement = document.querySelector('style[' + ssrIdKey + '~="' + obj.id + '"]')

  if (styleElement) {
    if (isProduction) {
      // has SSR styles and in production mode.
      // simply do nothing.
      return noop
    } else {
      // has SSR styles but in dev mode.
      // for some reason Chrome can't handle source map in server-rendered
      // style tags - source maps in <style> only works if the style tag is
      // created and inserted dynamically. So we remove the server rendered
      // styles and inject new ones.
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  if (isOldIE) {
    // use singleton mode for IE9.
    var styleIndex = singletonCounter++
    styleElement = singletonElement || (singletonElement = createStyleElement())
    update = applyToSingletonTag.bind(null, styleElement, styleIndex, false)
    remove = applyToSingletonTag.bind(null, styleElement, styleIndex, true)
  } else {
    // use multi-style-tag mode in all other cases
    styleElement = createStyleElement()
    update = applyToTag.bind(null, styleElement)
    remove = function () {
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  update(obj)

  return function updateStyle (newObj /* StyleObjectPart */) {
    if (newObj) {
      if (newObj.css === obj.css &&
          newObj.media === obj.media &&
          newObj.sourceMap === obj.sourceMap) {
        return
      }
      update(obj = newObj)
    } else {
      remove()
    }
  }
}

var replaceText = (function () {
  var textStore = []

  return function (index, replacement) {
    textStore[index] = replacement
    return textStore.filter(Boolean).join('\n')
  }
})()

function applyToSingletonTag (styleElement, index, remove, obj) {
  var css = remove ? '' : obj.css

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = replaceText(index, css)
  } else {
    var cssNode = document.createTextNode(css)
    var childNodes = styleElement.childNodes
    if (childNodes[index]) styleElement.removeChild(childNodes[index])
    if (childNodes.length) {
      styleElement.insertBefore(cssNode, childNodes[index])
    } else {
      styleElement.appendChild(cssNode)
    }
  }
}

function applyToTag (styleElement, obj) {
  var css = obj.css
  var media = obj.media
  var sourceMap = obj.sourceMap

  if (media) {
    styleElement.setAttribute('media', media)
  }
  if (options.ssrId) {
    styleElement.setAttribute(ssrIdKey, obj.id)
  }

  if (sourceMap) {
    // https://developer.chrome.com/devtools/docs/javascript-debugging
    // this makes source maps inside style tags work properly in Chrome
    css += '\n/*# sourceURL=' + sourceMap.sources[0] + ' */'
    // http://stackoverflow.com/a/26603875
    css += '\n/*# sourceMappingURL=data:application/json;base64,' + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + ' */'
  }

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = css
  } else {
    while (styleElement.firstChild) {
      styleElement.removeChild(styleElement.firstChild)
    }
    styleElement.appendChild(document.createTextNode(css))
  }
}


/***/ }),

/***/ 44:
/***/ (function(module, exports) {

/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file.
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = injectStyles
  }

  if (hook) {
    var functional = options.functional
    var existing = functional
      ? options.render
      : options.beforeCreate

    if (!functional) {
      // inject component registration as beforeCreate hook
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    } else {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return existing(h, context)
      }
    }
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ 45:
/***/ (function(module, exports) {

/**
 * Translates the list format produced by css-loader into something
 * easier to manipulate.
 */
module.exports = function listToStyles (parentId, list) {
  var styles = []
  var newStyles = {}
  for (var i = 0; i < list.length; i++) {
    var item = list[i]
    var id = item[0]
    var css = item[1]
    var media = item[2]
    var sourceMap = item[3]
    var part = {
      id: parentId + ':' + i,
      css: css,
      media: media,
      sourceMap: sourceMap
    }
    if (!newStyles[id]) {
      styles.push(newStyles[id] = { id: id, parts: [part] })
    } else {
      newStyles[id].parts.push(part)
    }
  }
  return styles
}


/***/ }),

/***/ 46:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(47);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(43)("0018f24a", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-198bddf8\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ProductAddComponent.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-198bddf8\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ProductAddComponent.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 47:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(40)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 48:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

var productModel = {
    code: "",
    description: "",
    quantity: 1,
    unit_price: 0,
    total: 0
};
/* harmony default export */ __webpack_exports__["default"] = ({

    name: 'ProductAddComponent',

    components: {
        ProductRow: function ProductRow() {
            return __webpack_require__.e/* import() */(2).then(__webpack_require__.bind(null, 49));
        }
    },

    props: {
        existingProducts: {
            required: false,
            type: Array,
            default: function _default() {
                return [_.clone(productModel, true)];
            }
        },
        existingShipping: {
            required: false,
            type: Number,
            default: function _default() {
                return 0;
            }
        },
        edit: {
            required: false,
            type: Boolean,
            default: function _default() {
                return true;
            }
        }
    },

    data: function data() {
        return {
            products: [],
            shipping_cost: 0
        };
    },


    computed: {
        formattedShipping: function formattedShipping() {
            return parseFloat(this.shipping_cost ? this.shipping_cost : 0);
        },

        productsSubTotal: function productsSubTotal() {
            var total = 0;
            _.forEach(this.products, function (product) {
                total = total + product.total;
            });
            return parseFloat(total);
        },
        productsTotalVAT: function productsTotalVAT() {
            return (parseFloat(this.productsSubTotal) + this.formattedShipping) * 0.2;
        },
        productsTotal: function productsTotal() {
            return this.productsSubTotal + this.productsTotalVAT + this.formattedShipping;
        }
    },

    watch: {},

    mounted: function mounted() {
        console.log('ProductAddComponent mounted');
        this.products = _.clone(this.existingProducts, true);
        this.shipping_cost = _.clone(parseFloat(this.existingShipping), true);
    },


    methods: {
        addRow: function addRow() {
            this.products.push(_.clone(productModel, true));
        }
    }

});

/***/ }),

/***/ 54:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", {}, [
    _c("table", { staticClass: "table table-hover bg-white mb-0" }, [
      _c("thead", [
        _c("tr", [
          _c("th", { attrs: { scope: "col" } }, [_vm._v("Product Code")]),
          _vm._v(" "),
          _c("th", { attrs: { scope: "col" } }, [_vm._v("Description")]),
          _vm._v(" "),
          _c("th", { attrs: { scope: "col" } }, [_vm._v("Quantity")]),
          _vm._v(" "),
          _c("th", { attrs: { scope: "col" } }, [_vm._v("Unit Price")]),
          _vm._v(" "),
          _c("th", { attrs: { scope: "col" } }, [_vm._v("Total")]),
          _vm._v(" "),
          _vm.edit ? _c("th", { attrs: { scope: "col" } }) : _vm._e()
        ])
      ]),
      _vm._v(" "),
      _c(
        "tbody",
        _vm._l(_vm.products, function(product, key) {
          return _c("product-row", {
            key: key,
            attrs: {
              edit: _vm.edit,
              id: key,
              product: product,
              products: _vm.products
            }
          })
        })
      )
    ]),
    _vm._v(" "),
    _c("table", { staticClass: "table bg-white mt-0" }, [
      _c("tbody", [
        _c("tr", [
          _c("th", { attrs: { scope: "col" } }),
          _vm._v(" "),
          _c("th", { attrs: { scope: "col" } }),
          _vm._v(" "),
          _c("th", { attrs: { scope: "col" } }),
          _vm._v(" "),
          _c("th", { attrs: { scope: "col" } }),
          _vm._v(" "),
          _c("th", { attrs: { scope: "col" } }, [_vm._v("Sub-Total")]),
          _vm._v(" "),
          _c("td", { attrs: { scope: "col" } }, [
            _vm._v(
              _vm._s(_vm.siteCurrency) +
                _vm._s(_vm.formatPrice(_vm.productsSubTotal))
            )
          ])
        ]),
        _vm._v(" "),
        _c("tr", [
          _c("th", { attrs: { scope: "col" } }),
          _vm._v(" "),
          _c("th", { attrs: { scope: "col" } }),
          _vm._v(" "),
          _c("th", { attrs: { scope: "col" } }),
          _vm._v(" "),
          _c("th", { attrs: { scope: "col" } }),
          _vm._v(" "),
          _c("th", { attrs: { scope: "col" } }, [_vm._v("Shipping")]),
          _vm._v(" "),
          _c("td", { attrs: { scope: "col" } }, [
            _vm.edit
              ? _c("div", { staticClass: "input-group input-group-sm" }, [
                  _c("div", { staticClass: "input-group-prepend" }, [
                    _c("span", { staticClass: "input-group-text" }, [
                      _vm._v(_vm._s(_vm.siteCurrency))
                    ])
                  ]),
                  _vm._v(" "),
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.shipping_cost,
                        expression: "shipping_cost"
                      }
                    ],
                    staticClass: "form-control form-control-sm",
                    staticStyle: { "max-width": "80px" },
                    attrs: {
                      type: "number",
                      name: "shipping_cost",
                      id: "shipping_cost"
                    },
                    domProps: { value: _vm.shipping_cost },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.shipping_cost = $event.target.value
                      }
                    }
                  })
                ])
              : _c("span", [
                  _vm._v(
                    _vm._s(_vm.siteCurrency) +
                      _vm._s(
                        _vm.formatPrice(
                          _vm.shipping_cost ? _vm.shipping_cost : 0
                        )
                      )
                  )
                ])
          ])
        ]),
        _vm._v(" "),
        _c("tr", [
          _c("th", { attrs: { scope: "col" } }),
          _vm._v(" "),
          _c("th", { attrs: { scope: "col" } }),
          _vm._v(" "),
          _c("th", { attrs: { scope: "col" } }),
          _vm._v(" "),
          _c("th", { attrs: { scope: "col" } }),
          _vm._v(" "),
          _c("th", { attrs: { scope: "col" } }, [_vm._v("VAT")]),
          _vm._v(" "),
          _c("td", { attrs: { scope: "col" } }, [
            _vm._v(
              _vm._s(_vm.siteCurrency) +
                _vm._s(_vm.formatPrice(_vm.productsTotalVAT))
            )
          ])
        ]),
        _vm._v(" "),
        _c("tr", [
          _c("th", { attrs: { scope: "col" } }),
          _vm._v(" "),
          _c("th", { attrs: { scope: "col" } }),
          _vm._v(" "),
          _c("th", { attrs: { scope: "col" } }),
          _vm._v(" "),
          _c("th", { attrs: { scope: "col" } }),
          _vm._v(" "),
          _c("th", { attrs: { scope: "col" } }, [_vm._v("Total")]),
          _vm._v(" "),
          _c("td", { attrs: { scope: "col" } }, [
            _vm._v(
              _vm._s(_vm.siteCurrency) +
                _vm._s(_vm.formatPrice(_vm.productsTotal))
            )
          ])
        ])
      ])
    ]),
    _vm._v(" "),
    _vm.edit
      ? _c(
          "button",
          {
            staticClass: "btn btn-sm btn-outline-primary",
            attrs: { type: "button", name: "add_row" },
            on: { click: _vm.addRow }
          },
          [_vm._v("Add Row")]
        )
      : _vm._e()
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-198bddf8", module.exports)
  }
}

/***/ })

});