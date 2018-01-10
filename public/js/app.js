/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 9);
/******/ })
/************************************************************************/
/******/ ({

/***/ 10:
/***/ (function(module, exports, __webpack_require__) {


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

__webpack_require__(46);

/***/ }),

/***/ 42:
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 46:
/***/ (function(module, exports) {


// Forms

[].forEach.call(document.querySelectorAll(".form-group input.form-field"), function (el) {
    el.addEventListener("focus", function () {
        el.parentNode.classList.add("focus");
    });
    el.addEventListener("blur", function () {
        el.parentNode.classList.remove("focus");
    });
});

[].forEach.call(document.querySelectorAll(".form-file-field input"), function (el) {
    el.addEventListener("change", function () {
        var filesCount = el.files.length;
        if (filesCount === 1) {
            el.parentNode.querySelectorAll(".file-msg")[0].textContent = el.value.split("\\").pop();
        } else {
            var textSelected = "files selected";
            if (el.parentNode.querySelectorAll(".file-msg")[0].dataset.selected) {
                textSelected = el.parentNode.querySelectorAll(".file-msg")[0].dataset.selected;
            }
            el.parentNode.querySelectorAll(".file-msg")[0].textContent = filesCount + " " + textSelected;
        }
        el.parentNode.classList.add("active");
    });
});

[].forEach.call(document.querySelectorAll(".password .icon-view"), function (el) {
    el.addEventListener("click", function () {
        var input = el.parentNode.getElementsByTagName("input")[0];
        if (!el.classList.contains("active")) {
            input.type = "text";
        } else {
            input.type = "password";
        }
        input.focus();
        el.classList.toggle("active");
    });
});

[].forEach.call(document.querySelectorAll("textarea.autoexpand"), function (el) {
    el.addEventListener("keydown", function () {
        var el = this;
        setTimeout(function () {
            el.style.cssText = "min-height: " + el.scrollHeight + "px";
        }, 0);
    });
});

// Selects

[].forEach.call(document.querySelectorAll("select.form-select"), function (el) {

    var classes = el.classList.value,
        id = el.id,
        name = el.name,
        value = el.options[el.selectedIndex].textContent,
        i;

    var wrapper = document.createElement("div");
    var template = "<span>" + value + "</span>";
    template += "<div>";
    for (i = 0; i < el.options.length; i++) {
        var active = "";
        if (value == el.options[i].innerHTML) {
            active = "active";
        }
        template += "<span class=\"" + el.options[i].classList.value + " " + active + "\" data-value=\"" + el.options[i].value + "\">" + el.options[i].innerHTML + "</span>";
    }
    template += "</div>";

    wrapper.className = classes;
    wrapper.innerHTML = template;

    el.style.display = "none";
    el.parentNode.insertBefore(wrapper, el);
});

[].forEach.call(document.querySelectorAll(".form-select:not(.disabled) > span"), function (el) {
    el.addEventListener("click", function (e) {
        document.addEventListener("click", function () {
            [].forEach.call(document.querySelectorAll(".form-select"), function (allFS) {
                allFS.classList.remove("open");
            });
        });
        el.parentNode.classList.toggle("open");
        e.stopPropagation();
    });
});

[].forEach.call(document.querySelectorAll(".form-select > div > span"), function (el) {
    el.addEventListener("click", function (e) {
        var div = el.parentNode.parentNode;
        var select = div.nextSibling;
        select.value = el.dataset.value;
        select.dispatchEvent(new Event("change"));
        var entries = el.parentNode.getElementsByTagName("span");
        for (i = 0; i < entries.length; i++) {
            entries[i].classList.remove("active");
        }
        setTimeout(function () {
            el.classList.add("active");
        }, 300);
        div.classList.remove("open");
        div.getElementsByTagName("span")[0].textContent = el.textContent;
    });
});

// classList Polyfill - Source: https://gist.github.com/k-gun/c2ea7c49edf7b757fe9561ba37cb19ca
;(function () {
    var regExp = function regExp(name) {
        return new RegExp("(^| )" + name + "( |$)");
    };
    var forEach = function forEach(list, fn, scope) {
        for (var i = 0; i < list.length; i++) {
            fn.call(scope, list[i]);
        }
    };
    function ClassList(element) {
        this.element = element;
    }
    ClassList.prototype = {
        add: function add() {
            forEach(arguments, function (name) {
                if (!this.contains(name)) {
                    this.element.className += " " + name;
                }
            }, this);
        },
        remove: function remove() {
            forEach(arguments, function (name) {
                this.element.className = this.element.className.replace(regExp(name), "");
            }, this);
        },
        toggle: function toggle(name) {
            return this.contains(name) ? (this.remove(name), false) : (this.add(name), true);
        },
        contains: function contains(name) {
            return regExp(name).test(this.element.className);
        },
        replace: function replace(oldName, newName) {
            this.remove(oldName), this.add(newName);
        }
    };
    if (!("classList" in Element.prototype)) {
        Object.defineProperty(Element.prototype, "classList", {
            get: function get() {
                return new ClassList(this);
            }
        });
    }
    if (window.DOMTokenList && DOMTokenList.prototype.replace == null) {
        DOMTokenList.prototype.replace = ClassList.prototype.replace;
    }
})();

/***/ }),

/***/ 9:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(10);
module.exports = __webpack_require__(42);


/***/ })

/******/ });