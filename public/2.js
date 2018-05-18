webpackJsonp([2],{

/***/ 49:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(50)
}
var normalizeComponent = __webpack_require__(44)
/* script */
var __vue_script__ = __webpack_require__(52)
/* template */
var __vue_template__ = __webpack_require__(53)
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
Component.options.__file = "resources/assets/js/components/ProductRow.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-25d8ba62", Component.options)
  } else {
    hotAPI.reload("data-v-25d8ba62", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 50:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(51);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(43)("02e6c275", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-25d8ba62\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ProductRow.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-25d8ba62\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ProductRow.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 51:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(40)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 52:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

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

/* harmony default export */ __webpack_exports__["default"] = ({

    name: 'ProductRow',

    components: {},

    props: {
        product: {
            required: true,
            type: Object
        },
        products: {
            required: true,
            type: Array
        },
        id: {
            required: true
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
        return {};
    },


    computed: {
        ranges: function ranges() {
            return [].concat(_toConsumableArray(Array(40).keys()));
        }
    },

    watch: {
        'product.unit_price': function productUnit_price(value) {
            this.product.total = value * this.product.quantity;
        },
        'product.quantity': function productQuantity(value) {
            this.product.total = value * this.product.unit_price;
        }
    },

    mounted: function mounted() {
        console.log('ProductRow mounted');
        if (this.product.unit_price && this.product.quantity) {
            this.product.total = this.product.unit_price * this.product.quantity;
        }
    },


    methods: {
        removeRow: function removeRow() {
            this.products.splice(this.products.indexOf(this.product), 1);
        },
        unitPriceChange: function unitPriceChange(val) {
            this.product.unit_price = this.formatPrice(this.product.unit_price);
        }
    }

});

/***/ }),

/***/ 53:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("tr", [
    _c("td", [
      _vm.edit
        ? _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.product.code,
                expression: "product.code"
              }
            ],
            staticClass: "form-control form-control-sm",
            attrs: {
              type: "text",
              name: "products[" + _vm.id + "][code]",
              id: "code",
              required: ""
            },
            domProps: { value: _vm.product.code },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.product, "code", $event.target.value)
              }
            }
          })
        : _c("span", [_vm._v(_vm._s(_vm.product.code))])
    ]),
    _vm._v(" "),
    _c("td", [
      _vm.edit
        ? _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.product.description,
                expression: "product.description"
              }
            ],
            staticClass: "form-control form-control-sm",
            attrs: {
              type: "text",
              name: "products[" + _vm.id + "][description]",
              id: "description",
              required: ""
            },
            domProps: { value: _vm.product.description },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.product, "description", $event.target.value)
              }
            }
          })
        : _c("span", [_vm._v(_vm._s(_vm.product.description))])
    ]),
    _vm._v(" "),
    _c("td", [
      _vm.edit
        ? _c(
            "select",
            {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.product.quantity,
                  expression: "product.quantity"
                }
              ],
              staticClass: "custom-select custom-select-sm",
              attrs: {
                name: "products[" + _vm.id + "][quantity]",
                id: "quantity",
                required: ""
              },
              on: {
                change: function($event) {
                  var $$selectedVal = Array.prototype.filter
                    .call($event.target.options, function(o) {
                      return o.selected
                    })
                    .map(function(o) {
                      var val = "_value" in o ? o._value : o.value
                      return val
                    })
                  _vm.$set(
                    _vm.product,
                    "quantity",
                    $event.target.multiple ? $$selectedVal : $$selectedVal[0]
                  )
                }
              }
            },
            _vm._l(_vm.ranges, function(range, key) {
              return _c(
                "option",
                { key: range, domProps: { value: range + 1 } },
                [_vm._v(_vm._s(range + 1))]
              )
            })
          )
        : _c("span", [_vm._v(_vm._s(_vm.product.quantity))])
    ]),
    _vm._v(" "),
    _c("td", [
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
                  value: _vm.product.unit_price,
                  expression: "product.unit_price"
                }
              ],
              staticClass: "form-control form-control-sm",
              attrs: {
                type: "text",
                name: "products[" + _vm.id + "][unit_price]",
                id: "unit_price",
                required: ""
              },
              domProps: { value: _vm.product.unit_price },
              on: {
                change: _vm.unitPriceChange,
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.product, "unit_price", $event.target.value)
                }
              }
            })
          ])
        : _c("span", [
            _vm._v(_vm._s(_vm.siteCurrency) + _vm._s(_vm.product.unit_price))
          ])
    ]),
    _vm._v(" "),
    _c("td", [
      _vm.edit
        ? _c("div", { staticClass: "input-group input-group-sm" }, [
            _c("div", { staticClass: "input-group-prepend" }, [
              _c("span", { staticClass: "input-group-text" }, [
                _vm._v(_vm._s(_vm.siteCurrency))
              ])
            ]),
            _vm._v(" "),
            _c("input", {
              staticClass: "form-control form-control-sm",
              attrs: { type: "text", disabled: "", required: "" },
              domProps: { value: _vm.formatPrice(_vm.product.total) }
            }),
            _vm._v(" "),
            _c("input", {
              staticClass: "form-control form-control-sm",
              attrs: {
                type: "text",
                name: "products[" + _vm.id + "][total]",
                id: "total",
                hidden: "",
                required: ""
              },
              domProps: { value: _vm.formatPrice(_vm.product.total) }
            })
          ])
        : _c("span", [
            _vm._v(
              _vm._s(_vm.siteCurrency) +
                _vm._s(_vm.formatPrice(_vm.product.total))
            )
          ])
    ]),
    _vm._v(" "),
    _vm.edit
      ? _c("td", [
          _c(
            "button",
            {
              staticClass: "btn btn-sm btn-outline-danger",
              attrs: { type: "button", name: "delete" },
              on: { click: _vm.removeRow }
            },
            [
              _c("i", {
                staticClass: "far fa-trash-alt",
                attrs: { "aria-hidden": "" }
              })
            ]
          )
        ])
      : _vm._e()
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-25d8ba62", module.exports)
  }
}

/***/ })

});