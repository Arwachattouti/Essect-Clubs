import {j as e, D as t, L as r, E as n, F as a, C as o, G as i, u as s, i as l} from "./index-BXJBXD8C.js";
const c = r => e.jsxs("div", {
    className: "max-w-[75rem] px-10 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto",
    children: [e.jsxs("div", {
        className: "max-w-2xl mx-auto text-center mb-14 lg:mb-32 mt-4 lg:mt-12",
        children: [e.jsx(t, {
            className: "absolute top-0 left-0 w-full -z-10",
            children: e.jsx("div", {})
        }), e.jsx("h2", {
            className: " font-bold md:leading-tight dark:text-white text-3xl md:text-6xl text-center",
            children: "Our Main Events"
        }), e.jsx("p", {
            className: "mt-1 text-gray-600 dark:text-gray-400",
            children: "Discover Our Signature Annual Events: Celebrating Innovation and Tradition with IEEE INSAT Student Branch"
        })]
    }), e.jsxs("div", {
        className: "grid lg:grid-cols-2 gap-12",
        children: [" ", r.children, " "]
    })]
});
var u, E, p, L, d = {}, S = {};
function h() {
    return p || (p = 1,
    function(e) {
        var t, r, n, a = E ? u : (E = 1,
        u = e => {
            if ("[object Object]" !== Object.prototype.toString.call(e))
                return !1;
            const t = Object.getPrototypeOf(e);
            return null === t || t === Object.prototype
        }
        );
        e.BLOCKS = void 0,
        (t = e.BLOCKS || (e.BLOCKS = {})).DOCUMENT = "document",
        t.PARAGRAPH = "paragraph",
        t.HEADING_1 = "heading-1",
        t.HEADING_2 = "heading-2",
        t.HEADING_3 = "heading-3",
        t.HEADING_4 = "heading-4",
        t.HEADING_5 = "heading-5",
        t.HEADING_6 = "heading-6",
        t.OL_LIST = "ordered-list",
        t.UL_LIST = "unordered-list",
        t.LIST_ITEM = "list-item",
        t.HR = "hr",
        t.QUOTE = "blockquote",
        t.EMBEDDED_ENTRY = "embedded-entry-block",
        t.EMBEDDED_ASSET = "embedded-asset-block",
        t.EMBEDDED_RESOURCE = "embedded-resource-block",
        t.TABLE = "table",
        t.TABLE_ROW = "table-row",
        t.TABLE_CELL = "table-cell",
        t.TABLE_HEADER_CELL = "table-header-cell",
        e.INLINES = void 0,
        (r = e.INLINES || (e.INLINES = {})).ASSET_HYPERLINK = "asset-hyperlink",
        r.EMBEDDED_ENTRY = "embedded-entry-inline",
        r.EMBEDDED_RESOURCE = "embedded-resource-inline",
        r.ENTRY_HYPERLINK = "entry-hyperlink",
        r.HYPERLINK = "hyperlink",
        r.RESOURCE_HYPERLINK = "resource-hyperlink",
        e.MARKS = void 0,
        (n = e.MARKS || (e.MARKS = {})).BOLD = "bold",
        n.ITALIC = "italic",
        n.UNDERLINE = "underline",
        n.CODE = "code",
        n.SUPERSCRIPT = "superscript",
        n.SUBSCRIPT = "subscript",
        n.STRIKETHROUGH = "strikethrough";
        var o, i = function(e, t) {
            return (i = Object.setPrototypeOf || {
                __proto__: []
            }instanceof Array && function(e, t) {
                e.__proto__ = t
            }
            || function(e, t) {
                for (var r in t)
                    Object.prototype.hasOwnProperty.call(t, r) && (e[r] = t[r])
            }
            )(e, t)
        };
        function s(e, t) {
            if ("function" != typeof t && null !== t)
                throw new TypeError("Class extends value " + String(t) + " is not a constructor or null");
            function r() {
                this.constructor = e
            }
            i(e, t),
            e.prototype = null === t ? Object.create(t) : (r.prototype = t.prototype,
            new r)
        }
        function l(e, t, r) {
            if (r || 2 === arguments.length)
                for (var n, a = 0, o = t.length; a < o; a++)
                    !n && a in t || (n || (n = Array.prototype.slice.call(t, 0, a)),
                    n[a] = t[a]);
            return e.concat(n || Array.prototype.slice.call(t))
        }
        "function" == typeof SuppressedError && SuppressedError;
        var c = [e.BLOCKS.PARAGRAPH, e.BLOCKS.HEADING_1, e.BLOCKS.HEADING_2, e.BLOCKS.HEADING_3, e.BLOCKS.HEADING_4, e.BLOCKS.HEADING_5, e.BLOCKS.HEADING_6, e.BLOCKS.OL_LIST, e.BLOCKS.UL_LIST, e.BLOCKS.HR, e.BLOCKS.QUOTE, e.BLOCKS.EMBEDDED_ENTRY, e.BLOCKS.EMBEDDED_ASSET, e.BLOCKS.EMBEDDED_RESOURCE, e.BLOCKS.TABLE]
          , p = [e.BLOCKS.PARAGRAPH, e.BLOCKS.HEADING_1, e.BLOCKS.HEADING_2, e.BLOCKS.HEADING_3, e.BLOCKS.HEADING_4, e.BLOCKS.HEADING_5, e.BLOCKS.HEADING_6, e.BLOCKS.OL_LIST, e.BLOCKS.UL_LIST, e.BLOCKS.HR, e.BLOCKS.QUOTE, e.BLOCKS.EMBEDDED_ENTRY, e.BLOCKS.EMBEDDED_ASSET, e.BLOCKS.EMBEDDED_RESOURCE]
          , L = [e.BLOCKS.TABLE, e.BLOCKS.TABLE_ROW, e.BLOCKS.TABLE_CELL, e.BLOCKS.TABLE_HEADER_CELL]
          , d = [e.BLOCKS.HR, e.BLOCKS.EMBEDDED_ENTRY, e.BLOCKS.EMBEDDED_ASSET, e.BLOCKS.EMBEDDED_RESOURCE]
          , S = ((o = {})[e.BLOCKS.OL_LIST] = [e.BLOCKS.LIST_ITEM],
        o[e.BLOCKS.UL_LIST] = [e.BLOCKS.LIST_ITEM],
        o[e.BLOCKS.LIST_ITEM] = p,
        o[e.BLOCKS.QUOTE] = [e.BLOCKS.PARAGRAPH],
        o[e.BLOCKS.TABLE] = [e.BLOCKS.TABLE_ROW],
        o[e.BLOCKS.TABLE_ROW] = [e.BLOCKS.TABLE_CELL, e.BLOCKS.TABLE_HEADER_CELL],
        o[e.BLOCKS.TABLE_CELL] = [e.BLOCKS.PARAGRAPH, e.BLOCKS.UL_LIST, e.BLOCKS.OL_LIST],
        o[e.BLOCKS.TABLE_HEADER_CELL] = [e.BLOCKS.PARAGRAPH],
        o)
          , h = [e.BLOCKS.HEADING_1, e.BLOCKS.HEADING_2, e.BLOCKS.HEADING_3, e.BLOCKS.HEADING_4, e.BLOCKS.HEADING_5, e.BLOCKS.HEADING_6]
          , f = l([e.BLOCKS.PARAGRAPH], h, !0)
          , O = [e.BLOCKS.DOCUMENT, e.BLOCKS.PARAGRAPH, e.BLOCKS.HEADING_1, e.BLOCKS.HEADING_2, e.BLOCKS.HEADING_3, e.BLOCKS.HEADING_4, e.BLOCKS.HEADING_5, e.BLOCKS.HEADING_6, e.BLOCKS.OL_LIST, e.BLOCKS.UL_LIST, e.BLOCKS.LIST_ITEM, e.BLOCKS.HR, e.BLOCKS.QUOTE, e.BLOCKS.EMBEDDED_ENTRY, e.BLOCKS.EMBEDDED_ASSET, e.INLINES.HYPERLINK, e.INLINES.ENTRY_HYPERLINK, e.INLINES.ASSET_HYPERLINK, e.INLINES.EMBEDDED_ENTRY, "text"]
          , B = [e.MARKS.BOLD, e.MARKS.CODE, e.MARKS.ITALIC, e.MARKS.UNDERLINE]
          , C = {
            nodeType: e.BLOCKS.DOCUMENT,
            data: {},
            content: [{
                nodeType: e.BLOCKS.PARAGRAPH,
                data: {},
                content: [{
                    nodeType: "text",
                    value: "",
                    marks: [],
                    data: {}
                }]
            }]
        };
        function y(e, t) {
            for (var r = 0, n = Object.keys(e); r < n.length; r++) {
                if (t === e[n[r]])
                    return !0
            }
            return !1
        }
        var A, N = Object.freeze({
            __proto__: null,
            isBlock: function(t) {
                return y(e.BLOCKS, t.nodeType)
            },
            isInline: function(t) {
                return y(e.INLINES, t.nodeType)
            },
            isText: function(e) {
                return "text" === e.nodeType
            }
        }), m = function(e) {
            var t = e.path
              , r = e.property
              , n = e.typeName
              , a = e.value;
            return {
                details: 'The type of "'.concat(r, '" is incorrect, expected type: ').concat(n),
                name: "type",
                path: t.toArray(),
                type: n,
                value: a
            }
        }, _ = function() {
            function e(e, t) {
                var r = this;
                this.obj = e,
                this.path = t,
                this._errors = [],
                this.catch = function() {
                    for (var e, t = [], n = 0; n < arguments.length; n++)
                        t[n] = arguments[n];
                    (e = r._errors).push.apply(e, t)
                }
                ,
                this.exists = function(e) {
                    return e in r.obj || (r.catch(function(e) {
                        var t = e.property
                          , r = e.path;
                        return {
                            details: 'The property "'.concat(t, '" is required here'),
                            name: "required",
                            path: r.toArray()
                        }
                    }({
                        property: e,
                        path: r.path.of(e)
                    })),
                    !1)
                }
                ,
                this.object = function(e) {
                    var t, n = e ? r.obj[e] : r.obj;
                    if (e && !r.exists(e))
                        return !1;
                    if (a(n))
                        return !0;
                    var o = e ? r.path.of(e) : r.path
                      , i = null !== (t = null != e ? e : r.path.last()) && void 0 !== t ? t : "value";
                    return r.catch(m({
                        typeName: "Object",
                        property: i,
                        path: o,
                        value: n
                    })),
                    !1
                }
                ,
                this.string = function(e) {
                    var t = r.obj[e];
                    return !(e && !r.exists(e)) && ("string" == typeof t || (r.catch(m({
                        typeName: "String",
                        property: e,
                        path: r.path.of(e),
                        value: t
                    })),
                    !1))
                }
                ,
                this.number = function(e, t) {
                    var n = r.obj[e];
                    return !(!t || e in r.obj) || !!r.exists(e) && ("number" == typeof n && !Number.isNaN(n) || (r.catch(m({
                        typeName: "Number",
                        property: e,
                        path: r.path.of(e),
                        value: n
                    })),
                    !1))
                }
                ,
                this.array = function(e) {
                    var t = r.obj[e];
                    return !(e && !r.exists(e)) && (!!Array.isArray(t) || (r.catch(m({
                        typeName: "Array",
                        property: e,
                        path: r.path.of(e),
                        value: t
                    })),
                    !1))
                }
                ,
                this.enum = function(e, t) {
                    var n = r.obj[e];
                    return !("string" != typeof n || !t.includes(n)) || (r.catch(function(e) {
                        var t = e.expected
                          , r = e.value
                          , n = e.path;
                        return {
                            details: "Value must be one of expected values",
                            name: "in",
                            expected: l([], t, !0).sort(),
                            path: n.toArray(),
                            value: r
                        }
                    }({
                        expected: t,
                        value: n,
                        path: r.path.of(e)
                    })),
                    !1)
                }
                ,
                this.empty = function(e) {
                    if (!r.array(e))
                        return !1;
                    var t = r.obj[e];
                    return 0 === t.length || (r.catch(function(e) {
                        var t = e.max
                          , r = e.value;
                        return {
                            name: "size",
                            max: t,
                            path: e.path.toArray(),
                            details: "Size must be at most ".concat(t),
                            value: r
                        }
                    }({
                        max: 0,
                        value: t,
                        path: r.path.of(e)
                    })),
                    !1)
                }
                ,
                this.minLength = function(e, t) {
                    if (!r.array(e))
                        return !1;
                    var n = r.obj[e];
                    return n.length >= t || (r.catch(function(e) {
                        var t = e.min
                          , r = e.value;
                        return {
                            name: "size",
                            min: t,
                            path: e.path.toArray(),
                            details: "Size must be at least ".concat(t),
                            value: r
                        }
                    }({
                        min: t,
                        value: n,
                        path: r.path.of(e)
                    })),
                    !1)
                }
                ,
                this.noAdditionalProperties = function(e) {
                    var t = Object.keys(r.obj).sort().filter((function(t) {
                        return !e.includes(t)
                    }
                    ));
                    return t.forEach((function(e) {
                        return r.catch(function(e) {
                            var t = e.property
                              , r = e.path;
                            return {
                                details: 'The property "'.concat(t, '" is not expected'),
                                name: "unexpected",
                                path: r.toArray()
                            }
                        }({
                            property: e,
                            path: r.path.of(e)
                        }))
                    }
                    )),
                    0 === t.length
                }
                ,
                this.each = function(e, t) {
                    if (r.array(e)) {
                        var n = r.obj[e]
                          , a = !1;
                        n.forEach((function(n, o) {
                            if (!a) {
                                var i = t(n, r.path.of(e).of(o));
                                i.length > 0 && (a = !0),
                                r.catch.apply(r, i)
                            }
                        }
                        ))
                    }
                }
            }
            return Object.defineProperty(e.prototype, "errors", {
                get: function() {
                    var e = this
                      , t = function(e) {
                        return JSON.stringify({
                            details: e.details,
                            path: e.path
                        })
                    };
                    return this._errors.filter((function(r, n) {
                        return e._errors.findIndex((function(e) {
                            return t(r) === t(e)
                        }
                        )) === n
                    }
                    ))
                },
                enumerable: !1,
                configurable: !0
            }),
            e
        }(), T = [], x = function() {
            function e(e, t) {
                this.contentRule = e,
                this.validateData = t
            }
            return e.prototype.assert = function(e, t) {
                var r, n, a = new _(e,t);
                if (!a.object())
                    return a.errors;
                a.noAdditionalProperties(["nodeType", "data", "content"]);
                var o = Array.isArray(this.contentRule) ? {
                    nodeTypes: this.contentRule
                } : this.contentRule(e, t)
                  , i = o.nodeTypes
                  , s = o.min
                  , l = void 0 === s ? 0 : s;
                if (0 === i.length && l > 0)
                    throw new Error("Invalid content rule. Cannot have enforce a 'min' of ".concat(l, " with no nodeTypes"));
                if (a.minLength("content", l),
                0 === i.length ? a.empty("content") : a.each("content", (function(e, t) {
                    var r = new _(e,t);
                    return r.object() ? (r.enum("nodeType", i),
                    r.errors) : r.errors
                }
                )),
                a.object("data")) {
                    var c = null !== (n = null === (r = this.validateData) || void 0 === r ? void 0 : r.call(this, e.data, t.of("data"))) && void 0 !== n ? n : [];
                    a.catch.apply(a, c)
                }
                return a.errors
            }
            ,
            e
        }(), v = function(e) {
            function t(t, r) {
                var n = e.call(this, r, (function(e, t) {
                    return n.assertLink(e, t)
                }
                )) || this;
                return n.linkType = t,
                n.assertLink = function(e, t) {
                    var r = new _(e,t);
                    if (r.object("target")) {
                        var a = new _(e.target.sys,t.of("target").of("sys"));
                        a.object() && (a.enum("type", [n.type]),
                        a.enum("linkType", [n.linkType]),
                        "Link" === n.type ? (a.string("id"),
                        a.noAdditionalProperties(["type", "linkType", "id"])) : "ResourceLink" === n.type && (a.string("urn"),
                        a.noAdditionalProperties(["type", "linkType", "urn"]))),
                        r.catch.apply(r, a.errors)
                    }
                    return r.noAdditionalProperties(["target"]),
                    r.errors
                }
                ,
                n.type = n.linkType.startsWith("Contentful:") ? "ResourceLink" : "Link",
                n
            }
            return s(t, e),
            t
        }(x), K = function(e) {
            function t() {
                var t = e.call(this, ["text"], (function(e, r) {
                    return t.assertLink(e, r)
                }
                )) || this;
                return t.assertLink = function(e, t) {
                    var r = new _(e,t);
                    return r.string("uri"),
                    r.noAdditionalProperties(["uri"]),
                    r.errors
                }
                ,
                t
            }
            return s(t, e),
            t
        }(x), I = function(e, t) {
            return new x(e,t)
        }, D = function(e, t) {
            return new v(e,t)
        }, g = function() {
            return function e(t) {
                void 0 === t && (t = []);
                var r = this;
                this.path = t,
                this.of = function(t) {
                    return new e(l(l([], r.path, !0), [t], !1))
                }
                ,
                this.isRoot = function() {
                    return 0 === r.path.length
                }
                ,
                this.last = function() {
                    return r.path[r.path.length - 1]
                }
                ,
                this.toArray = function() {
                    return r.path
                }
            }
        }();
        var R = I(l(l([], Object.values(e.INLINES), !0), ["text"], !1).sort())
          , b = I([e.BLOCKS.LIST_ITEM])
          , j = D("Entry", T)
          , H = I((function() {
            return {
                nodeTypes: [e.BLOCKS.PARAGRAPH],
                min: 1
            }
        }
        ), (function(e, t) {
            var r = new _(e,t);
            return r.noAdditionalProperties(["colspan", "rowspan"]),
            r.number("colspan", !0),
            r.number("rowspan", !0),
            r.errors
        }
        ))
          , P = ((A = {})[e.BLOCKS.DOCUMENT] = I(c),
        A[e.BLOCKS.PARAGRAPH] = R,
        A[e.BLOCKS.HEADING_1] = R,
        A[e.BLOCKS.HEADING_2] = R,
        A[e.BLOCKS.HEADING_3] = R,
        A[e.BLOCKS.HEADING_4] = R,
        A[e.BLOCKS.HEADING_5] = R,
        A[e.BLOCKS.HEADING_6] = R,
        A[e.BLOCKS.QUOTE] = I(S[e.BLOCKS.QUOTE]),
        A[e.BLOCKS.EMBEDDED_ENTRY] = j,
        A[e.BLOCKS.EMBEDDED_ASSET] = D("Asset", T),
        A[e.BLOCKS.EMBEDDED_RESOURCE] = D("Contentful:Entry", T),
        A[e.BLOCKS.HR] = I(T),
        A[e.BLOCKS.OL_LIST] = b,
        A[e.BLOCKS.UL_LIST] = b,
        A[e.BLOCKS.LIST_ITEM] = I(l([], p, !0).sort()),
        A[e.BLOCKS.TABLE] = I((function() {
            return {
                nodeTypes: [e.BLOCKS.TABLE_ROW],
                min: 1
            }
        }
        )),
        A[e.BLOCKS.TABLE_ROW] = I((function() {
            return {
                nodeTypes: [e.BLOCKS.TABLE_CELL, e.BLOCKS.TABLE_HEADER_CELL],
                min: 1
            }
        }
        )),
        A[e.BLOCKS.TABLE_CELL] = H,
        A[e.BLOCKS.TABLE_HEADER_CELL] = H,
        A[e.INLINES.HYPERLINK] = new K,
        A[e.INLINES.EMBEDDED_ENTRY] = j,
        A[e.INLINES.EMBEDDED_RESOURCE] = D("Contentful:Entry", T),
        A[e.INLINES.ENTRY_HYPERLINK] = D("Entry", ["text"]),
        A[e.INLINES.ASSET_HYPERLINK] = D("Asset", ["text"]),
        A[e.INLINES.RESOURCE_HYPERLINK] = D("Contentful:Entry", ["text"]),
        A);
        function w(e, t) {
            if ("text" === e.nodeType)
                return function(e, t) {
                    var r = new _(e,t);
                    return r.object() ? (r.noAdditionalProperties(["nodeType", "data", "value", "marks"]),
                    r.object("data"),
                    r.each("marks", (function(e, t) {
                        var r = new _(e,t);
                        return r.object() ? (r.string("type"),
                        r.errors) : r.errors
                    }
                    )),
                    r.string("value"),
                    r.errors) : r.errors
                }(e, t);
            var r = P[e.nodeType].assert(e, t);
            if (r.length > 0)
                return r;
            var n = new _(e,t);
            return n.each("content", (function(e, t) {
                return w(e, t)
            }
            )),
            n.errors
        }
        e.CONTAINERS = S,
        e.EMPTY_DOCUMENT = C,
        e.HEADINGS = h,
        e.LIST_ITEM_BLOCKS = p,
        e.TABLE_BLOCKS = L,
        e.TEXT_CONTAINERS = f,
        e.TOP_LEVEL_BLOCKS = c,
        e.V1_MARKS = B,
        e.V1_NODE_TYPES = O,
        e.VOID_BLOCKS = d,
        e.helpers = N,
        e.validateRichTextDocument = function(t) {
            var r = new g
              , n = new _(t,r);
            return n.object() && n.enum("nodeType", [e.BLOCKS.DOCUMENT]),
            n.errors.length > 0 ? n.errors : w(t, r)
        }
    }(S)),
    S
}
var f = function() {
    if (L)
        return d;
    L = 1;
    var e = h();
    return d.documentToPlainTextString = function t(r, n) {
        return void 0 === n && (n = " "),
        r && r.content && Array.isArray(r.content) ? r.content.reduce((function(a, o, i) {
            var s;
            if (e.helpers.isText(o))
                s = o.value;
            else if ((e.helpers.isBlock(o) || e.helpers.isInline(o)) && !(s = t(o, n)).length)
                return a;
            var l = r.content[i + 1];
            return a + s + (l && e.helpers.isBlock(l) ? n : "")
        }
        ), "") : ""
    }
    ,
    d
}();
const O = t => {
    var a;
    return e.jsxs(r, {
        className: "group w-full flex items-center rounded-xl dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 bg-slate-100 dark:bg-slate-800 shadow-xl transition-all",
        to: t.id,
        children: [e.jsx("style", {
            children: "\n            .group:hover .eventCover{\n                transform: perspective(1000px) rotateY(10deg) rotateX(10deg) scale(1.1);\n            }\n        "
        }), e.jsx("div", {
            className: "eventCover flex-shrink-0 relative rounded-xl overflow-hidden  drop-shadow-xl h-[200px] sm:h-[300px] aspect-[1/1.4] scale-105 group-hover:scale-110 transition-transform duration-500",
            children: e.jsx("img", {
                src: n(null == (a = t.event.coverImage.fields.file) ? void 0 : a.url, "webp", 400, 400),
                alt: t.event.coverImage.fields.title,
                className: "size-full absolute top-0 start-0 object-cover"
            })
        }), e.jsx("div", {
            className: "max-w-full",
            children: e.jsxs("div", {
                className: "p-4 flex flex-col h-full sm:p-6 w-full",
                children: [e.jsx("div", {
                    className: "mb-3 hidden sm:flex gap-2 w-full flex-wrap",
                    children: t.event.tags.slice(0, 5).map((t => e.jsx("p", {
                        className: "inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-medium bg-white text-gray-800 dark:bg-gray-800 dark:text-gray-200",
                        children: t
                    }, t)))
                }), e.jsx("h3", {
                    className: "text-md sm:text-2xl font-semibold dark:text-white opacity-75 group-hover:opacity-100 transition-all line-clamp-3",
                    children: t.event.title
                }), e.jsx("p", {
                    className: "text-xs sm:text-base font-extralight text-gray-600 dark:text-gray-400 line-clamp-1",
                    children: t.event.subtitle
                }), e.jsx("p", {
                    className: "mt-2 text-xs sm:text-base text-gray-600 dark:text-gray-400 line-clamp-3 sm:line-clamp-4 text-ellipsis",
                    children: f.documentToPlainTextString(t.event.body)
                })]
            })
        })]
    })
}
  , B = () => e.jsxs("div", {
    className: "group flex items-center rounded-xl bg-slate-800 shadow-xl",
    children: [e.jsx("div", {
        className: "flex-shrink-0 relative rounded-xl overflow-hidden animate-pulse drop-shadow-xl h-[200px] sm:h-[300px] aspect-[1/1.4] scale-105 bg-slate-700"
    }), e.jsx("div", {
        className: "grow",
        children: e.jsxs("div", {
            className: "p-4 flex flex-col h-full sm:p-6",
            children: [e.jsx("div", {
                className: "mb-3 flex gap-2",
                children: [1, 2].map((t => e.jsx("p", {
                    className: " rounded-md text-xs font-medium bg-gray-800"
                }, t)))
            }), e.jsxs("ul", {
                className: "mt-5 space-y-3 animate-pulse",
                children: [e.jsx("li", {
                    className: "w-full h-4 bg-gray-200 rounded-full dark:bg-gray-700"
                }), e.jsx("li", {
                    className: "w-full h-4 bg-gray-200 rounded-full dark:bg-gray-700"
                }), e.jsx("li", {
                    className: "w-full h-4 bg-gray-200 rounded-full dark:bg-gray-700"
                }), e.jsx("li", {
                    className: "w-full h-4 bg-gray-200 rounded-full dark:bg-gray-700"
                })]
            })]
        })
    })]
})
  , C = async () => a.getEntries({
    content_type: "events"
})
  , y = () => {
    const {error: t, isLoading: r, data: n} = o({
        queryKey: ["events"],
        queryFn: C
    })
      , a = i("events")
      , s = (r || a) && !t
      , l = n && !t && !s;
    return e.jsxs(c, {
        children: [s && [1, 2, 3, 4].map((t => e.jsx(B, {}, t))), t && e.jsxs("div", {
            className: "bg-red-500 text-sm text-white rounded-lg p-4 col-span-2",
            role: "alert",
            children: [e.jsx("span", {
                className: "font-bold",
                children: "Error"
            }), " We're sorry, an internal error has occured"]
        }), l && n.items.map((t => e.jsx(O, {
            event: t.fields,
            id: t.sys.id
        }, t.sys.id)))]
    })
}
;
const A = Object.freeze(Object.defineProperty({
    __proto__: null,
    Component: y,
    ErrorBoundary: function() {
        const t = s();
        return l(t) ? e.jsxs("h1", {
            children: [t.status, " ", t.statusText]
        }) : e.jsx("h1", {
            children: JSON.stringify(t)
        })
    },
    EventsPage: y,
    fetchEvents: C
}, Symbol.toStringTag, {
    value: "Module"
}));
export {C as f, A as p, h as r};
