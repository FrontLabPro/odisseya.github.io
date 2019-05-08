! function(a, b) { "object" == typeof module && "object" == typeof module.exports ? module.exports = a.document ? b(a, !0) : function(a) { if (!a.document) throw new Error("jQuery requires a window with a document"); return b(a) } : b(a) }("undefined" != typeof window ? window : this, function(a, b) {
    var c = [],
        d = a.document,
        e = c.slice,
        f = c.concat,
        g = c.push,
        h = c.indexOf,
        i = {},
        j = i.toString,
        k = i.hasOwnProperty,
        l = {},
        m = "2.2.4",
        n = function(a, b) { return new n.fn.init(a, b) },
        o = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
        p = /^-ms-/,
        q = /-([\da-z])/gi,
        r = function(a, b) { return b.toUpperCase() };
    n.fn = n.prototype = { jquery: m, constructor: n, selector: "", length: 0, toArray: function() { return e.call(this) }, get: function(a) { return null != a ? 0 > a ? this[a + this.length] : this[a] : e.call(this) }, pushStack: function(a) { var b = n.merge(this.constructor(), a); return b.prevObject = this, b.context = this.context, b }, each: function(a) { return n.each(this, a) }, map: function(a) { return this.pushStack(n.map(this, function(b, c) { return a.call(b, c, b) })) }, slice: function() { return this.pushStack(e.apply(this, arguments)) }, first: function() { return this.eq(0) }, last: function() { return this.eq(-1) }, eq: function(a) { var b = this.length,
                c = +a + (0 > a ? b : 0); return this.pushStack(c >= 0 && b > c ? [this[c]] : []) }, end: function() { return this.prevObject || this.constructor() }, push: g, sort: c.sort, splice: c.splice }, n.extend = n.fn.extend = function() { var a, b, c, d, e, f, g = arguments[0] || {},
            h = 1,
            i = arguments.length,
            j = !1; for ("boolean" == typeof g && (j = g, g = arguments[h] || {}, h++), "object" == typeof g || n.isFunction(g) || (g = {}), h === i && (g = this, h--); i > h; h++)
            if (null != (a = arguments[h]))
                for (b in a) c = g[b], d = a[b], g !== d && (j && d && (n.isPlainObject(d) || (e = n.isArray(d))) ? (e ? (e = !1, f = c && n.isArray(c) ? c : []) : f = c && n.isPlainObject(c) ? c : {}, g[b] = n.extend(j, f, d)) : void 0 !== d && (g[b] = d)); return g }, n.extend({
        expando: "jQuery" + (m + Math.random()).replace(/\D/g, ""),
        isReady: !0,
        error: function(a) { throw new Error(a) },
        noop: function() {},
        isFunction: function(a) { return "function" === n.type(a) },
        isArray: Array.isArray,
        isWindow: function(a) { return null != a && a === a.window },
        isNumeric: function(a) { var b = a && a.toString(); return !n.isArray(a) && b - parseFloat(b) + 1 >= 0 },
        isPlainObject: function(a) { var b; if ("object" !== n.type(a) || a.nodeType || n.isWindow(a)) return !1; if (a.constructor && !k.call(a, "constructor") && !k.call(a.constructor.prototype || {}, "isPrototypeOf")) return !1; for (b in a); return void 0 === b || k.call(a, b) },
        isEmptyObject: function(a) { var b; for (b in a) return !1; return !0 },
        type: function(a) { return null == a ? a + "" : "object" == typeof a || "function" == typeof a ? i[j.call(a)] || "object" : typeof a },
        globalEval: function(a) { var b, c = eval;
            a = n.trim(a), a && (1 === a.indexOf("use strict") ? (b = d.createElement("script"), b.text = a, d.head.appendChild(b).parentNode.removeChild(b)) : c(a)) },
        camelCase: function(a) { return a.replace(p, "ms-").replace(q, r) },
        nodeName: function(a, b) { return a.nodeName && a.nodeName.toLowerCase() === b.toLowerCase() },
        each: function(a, b) {
            var c, d = 0;
            if (s(a)) { for (c = a.length; c > d; d++)
                    if (b.call(a[d], d, a[d]) === !1) break } else
                for (d in a)
                    if (b.call(a[d], d, a[d]) === !1) break;
            return a
        },
        trim: function(a) { return null == a ? "" : (a + "").replace(o, "") },
        makeArray: function(a, b) { var c = b || []; return null != a && (s(Object(a)) ? n.merge(c, "string" == typeof a ? [a] : a) : g.call(c, a)), c },
        inArray: function(a, b, c) { return null == b ? -1 : h.call(b, a, c) },
        merge: function(a, b) { for (var c = +b.length, d = 0, e = a.length; c > d; d++) a[e++] = b[d]; return a.length = e, a },
        grep: function(a, b, c) { for (var d, e = [], f = 0, g = a.length, h = !c; g > f; f++) d = !b(a[f], f), d !== h && e.push(a[f]); return e },
        map: function(a, b, c) {
            var d, e, g = 0,
                h = [];
            if (s(a))
                for (d = a.length; d > g; g++) e = b(a[g], g, c), null != e && h.push(e);
            else
                for (g in a) e = b(a[g], g, c), null != e && h.push(e);
            return f.apply([], h)
        },
        guid: 1,
        proxy: function(a, b) { var c, d, f; return "string" == typeof b && (c = a[b], b = a, a = c), n.isFunction(a) ? (d = e.call(arguments, 2), f = function() { return a.apply(b || this, d.concat(e.call(arguments))) }, f.guid = a.guid = a.guid || n.guid++, f) : void 0 },
        now: Date.now,
        support: l
    }), "function" == typeof Symbol && (n.fn[Symbol.iterator] = c[Symbol.iterator]), n.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), function(a, b) { i["[object " + b + "]"] = b.toLowerCase() });

    function s(a) { var b = !!a && "length" in a && a.length,
            c = n.type(a); return "function" === c || n.isWindow(a) ? !1 : "array" === c || 0 === b || "number" == typeof b && b > 0 && b - 1 in a }
    var t = function(a) {
        var b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u = "sizzle" + 1 * new Date,
            v = a.document,
            w = 0,
            x = 0,
            y = ga(),
            z = ga(),
            A = ga(),
            B = function(a, b) { return a === b && (l = !0), 0 },
            C = 1 << 31,
            D = {}.hasOwnProperty,
            E = [],
            F = E.pop,
            G = E.push,
            H = E.push,
            I = E.slice,
            J = function(a, b) { for (var c = 0, d = a.length; d > c; c++)
                    if (a[c] === b) return c; return -1 },
            K = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
            L = "[\\x20\\t\\r\\n\\f]",
            M = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",
            N = "\\[" + L + "*(" + M + ")(?:" + L + "*([*^$|!~]?=)" + L + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + M + "))|)" + L + "*\\]",
            O = ":(" + M + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + N + ")*)|.*)\\)|)",
            P = new RegExp(L + "+", "g"),
            Q = new RegExp("^" + L + "+|((?:^|[^\\\\])(?:\\\\.)*)" + L + "+$", "g"),
            R = new RegExp("^" + L + "*," + L + "*"),
            S = new RegExp("^" + L + "*([>+~]|" + L + ")" + L + "*"),
            T = new RegExp("=" + L + "*([^\\]'\"]*?)" + L + "*\\]", "g"),
            U = new RegExp(O),
            V = new RegExp("^" + M + "$"),
            W = { ID: new RegExp("^#(" + M + ")"), CLASS: new RegExp("^\\.(" + M + ")"), TAG: new RegExp("^(" + M + "|[*])"), ATTR: new RegExp("^" + N), PSEUDO: new RegExp("^" + O), CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + L + "*(even|odd|(([+-]|)(\\d*)n|)" + L + "*(?:([+-]|)" + L + "*(\\d+)|))" + L + "*\\)|)", "i"), bool: new RegExp("^(?:" + K + ")$", "i"), needsContext: new RegExp("^" + L + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + L + "*((?:-\\d)?\\d*)" + L + "*\\)|)(?=[^-]|$)", "i") },
            X = /^(?:input|select|textarea|button)$/i,
            Y = /^h\d$/i,
            Z = /^[^{]+\{\s*\[native \w/,
            $ = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
            _ = /[+~]/,
            aa = /'|\\/g,
            ba = new RegExp("\\\\([\\da-f]{1,6}" + L + "?|(" + L + ")|.)", "ig"),
            ca = function(a, b, c) { var d = "0x" + b - 65536; return d !== d || c ? b : 0 > d ? String.fromCharCode(d + 65536) : String.fromCharCode(d >> 10 | 55296, 1023 & d | 56320) },
            da = function() { m() };
        try { H.apply(E = I.call(v.childNodes), v.childNodes), E[v.childNodes.length].nodeType } catch (ea) { H = { apply: E.length ? function(a, b) { G.apply(a, I.call(b)) } : function(a, b) { var c = a.length,
                        d = 0; while (a[c++] = b[d++]);
                    a.length = c - 1 } } }

        function fa(a, b, d, e) { var f, h, j, k, l, o, r, s, w = b && b.ownerDocument,
                x = b ? b.nodeType : 9; if (d = d || [], "string" != typeof a || !a || 1 !== x && 9 !== x && 11 !== x) return d; if (!e && ((b ? b.ownerDocument || b : v) !== n && m(b), b = b || n, p)) { if (11 !== x && (o = $.exec(a)))
                    if (f = o[1]) { if (9 === x) { if (!(j = b.getElementById(f))) return d; if (j.id === f) return d.push(j), d } else if (w && (j = w.getElementById(f)) && t(b, j) && j.id === f) return d.push(j), d } else { if (o[2]) return H.apply(d, b.getElementsByTagName(a)), d; if ((f = o[3]) && c.getElementsByClassName && b.getElementsByClassName) return H.apply(d, b.getElementsByClassName(f)), d }
                if (c.qsa && !A[a + " "] && (!q || !q.test(a))) { if (1 !== x) w = b, s = a;
                    else if ("object" !== b.nodeName.toLowerCase()) {
                        (k = b.getAttribute("id")) ? k = k.replace(aa, "\\$&"): b.setAttribute("id", k = u), r = g(a), h = r.length, l = V.test(k) ? "#" + k : "[id='" + k + "']"; while (h--) r[h] = l + " " + qa(r[h]);
                        s = r.join(","), w = _.test(a) && oa(b.parentNode) || b } if (s) try { return H.apply(d, w.querySelectorAll(s)), d } catch (y) {} finally { k === u && b.removeAttribute("id") } } } return i(a.replace(Q, "$1"), b, d, e) }

        function ga() { var a = [];

            function b(c, e) { return a.push(c + " ") > d.cacheLength && delete b[a.shift()], b[c + " "] = e } return b }

        function ha(a) { return a[u] = !0, a }

        function ia(a) { var b = n.createElement("div"); try { return !!a(b) } catch (c) { return !1 } finally { b.parentNode && b.parentNode.removeChild(b), b = null } }

        function ja(a, b) { var c = a.split("|"),
                e = c.length; while (e--) d.attrHandle[c[e]] = b }

        function ka(a, b) { var c = b && a,
                d = c && 1 === a.nodeType && 1 === b.nodeType && (~b.sourceIndex || C) - (~a.sourceIndex || C); if (d) return d; if (c)
                while (c = c.nextSibling)
                    if (c === b) return -1; return a ? 1 : -1 }

        function la(a) { return function(b) { var c = b.nodeName.toLowerCase(); return "input" === c && b.type === a } }

        function ma(a) { return function(b) { var c = b.nodeName.toLowerCase(); return ("input" === c || "button" === c) && b.type === a } }

        function na(a) { return ha(function(b) { return b = +b, ha(function(c, d) { var e, f = a([], c.length, b),
                        g = f.length; while (g--) c[e = f[g]] && (c[e] = !(d[e] = c[e])) }) }) }

        function oa(a) { return a && "undefined" != typeof a.getElementsByTagName && a } c = fa.support = {}, f = fa.isXML = function(a) { var b = a && (a.ownerDocument || a).documentElement; return b ? "HTML" !== b.nodeName : !1 }, m = fa.setDocument = function(a) { var b, e, g = a ? a.ownerDocument || a : v; return g !== n && 9 === g.nodeType && g.documentElement ? (n = g, o = n.documentElement, p = !f(n), (e = n.defaultView) && e.top !== e && (e.addEventListener ? e.addEventListener("unload", da, !1) : e.attachEvent && e.attachEvent("onunload", da)), c.attributes = ia(function(a) { return a.className = "i", !a.getAttribute("className") }), c.getElementsByTagName = ia(function(a) { return a.appendChild(n.createComment("")), !a.getElementsByTagName("*").length }), c.getElementsByClassName = Z.test(n.getElementsByClassName), c.getById = ia(function(a) { return o.appendChild(a).id = u, !n.getElementsByName || !n.getElementsByName(u).length }), c.getById ? (d.find.ID = function(a, b) { if ("undefined" != typeof b.getElementById && p) { var c = b.getElementById(a); return c ? [c] : [] } }, d.filter.ID = function(a) { var b = a.replace(ba, ca); return function(a) { return a.getAttribute("id") === b } }) : (delete d.find.ID, d.filter.ID = function(a) { var b = a.replace(ba, ca); return function(a) { var c = "undefined" != typeof a.getAttributeNode && a.getAttributeNode("id"); return c && c.value === b } }), d.find.TAG = c.getElementsByTagName ? function(a, b) { return "undefined" != typeof b.getElementsByTagName ? b.getElementsByTagName(a) : c.qsa ? b.querySelectorAll(a) : void 0 } : function(a, b) { var c, d = [],
                    e = 0,
                    f = b.getElementsByTagName(a); if ("*" === a) { while (c = f[e++]) 1 === c.nodeType && d.push(c); return d } return f }, d.find.CLASS = c.getElementsByClassName && function(a, b) { return "undefined" != typeof b.getElementsByClassName && p ? b.getElementsByClassName(a) : void 0 }, r = [], q = [], (c.qsa = Z.test(n.querySelectorAll)) && (ia(function(a) { o.appendChild(a).innerHTML = "<a id='" + u + "'></a><select id='" + u + "-\r\\' msallowcapture=''><option selected=''></option></select>", a.querySelectorAll("[msallowcapture^='']").length && q.push("[*^$]=" + L + "*(?:''|\"\")"), a.querySelectorAll("[selected]").length || q.push("\\[" + L + "*(?:value|" + K + ")"), a.querySelectorAll("[id~=" + u + "-]").length || q.push("~="), a.querySelectorAll(":checked").length || q.push(":checked"), a.querySelectorAll("a#" + u + "+*").length || q.push(".#.+[+~]") }), ia(function(a) { var b = n.createElement("input");
                b.setAttribute("type", "hidden"), a.appendChild(b).setAttribute("name", "D"), a.querySelectorAll("[name=d]").length && q.push("name" + L + "*[*^$|!~]?="), a.querySelectorAll(":enabled").length || q.push(":enabled", ":disabled"), a.querySelectorAll("*,:x"), q.push(",.*:") })), (c.matchesSelector = Z.test(s = o.matches || o.webkitMatchesSelector || o.mozMatchesSelector || o.oMatchesSelector || o.msMatchesSelector)) && ia(function(a) { c.disconnectedMatch = s.call(a, "div"), s.call(a, "[s!='']:x"), r.push("!=", O) }), q = q.length && new RegExp(q.join("|")), r = r.length && new RegExp(r.join("|")), b = Z.test(o.compareDocumentPosition), t = b || Z.test(o.contains) ? function(a, b) { var c = 9 === a.nodeType ? a.documentElement : a,
                    d = b && b.parentNode; return a === d || !(!d || 1 !== d.nodeType || !(c.contains ? c.contains(d) : a.compareDocumentPosition && 16 & a.compareDocumentPosition(d))) } : function(a, b) { if (b)
                    while (b = b.parentNode)
                        if (b === a) return !0; return !1 }, B = b ? function(a, b) { if (a === b) return l = !0, 0; var d = !a.compareDocumentPosition - !b.compareDocumentPosition; return d ? d : (d = (a.ownerDocument || a) === (b.ownerDocument || b) ? a.compareDocumentPosition(b) : 1, 1 & d || !c.sortDetached && b.compareDocumentPosition(a) === d ? a === n || a.ownerDocument === v && t(v, a) ? -1 : b === n || b.ownerDocument === v && t(v, b) ? 1 : k ? J(k, a) - J(k, b) : 0 : 4 & d ? -1 : 1) } : function(a, b) { if (a === b) return l = !0, 0; var c, d = 0,
                    e = a.parentNode,
                    f = b.parentNode,
                    g = [a],
                    h = [b]; if (!e || !f) return a === n ? -1 : b === n ? 1 : e ? -1 : f ? 1 : k ? J(k, a) - J(k, b) : 0; if (e === f) return ka(a, b);
                c = a; while (c = c.parentNode) g.unshift(c);
                c = b; while (c = c.parentNode) h.unshift(c); while (g[d] === h[d]) d++; return d ? ka(g[d], h[d]) : g[d] === v ? -1 : h[d] === v ? 1 : 0 }, n) : n }, fa.matches = function(a, b) { return fa(a, null, null, b) }, fa.matchesSelector = function(a, b) { if ((a.ownerDocument || a) !== n && m(a), b = b.replace(T, "='$1']"), c.matchesSelector && p && !A[b + " "] && (!r || !r.test(b)) && (!q || !q.test(b))) try { var d = s.call(a, b); if (d || c.disconnectedMatch || a.document && 11 !== a.document.nodeType) return d } catch (e) {}
            return fa(b, n, null, [a]).length > 0 }, fa.contains = function(a, b) { return (a.ownerDocument || a) !== n && m(a), t(a, b) }, fa.attr = function(a, b) {
            (a.ownerDocument || a) !== n && m(a); var e = d.attrHandle[b.toLowerCase()],
                f = e && D.call(d.attrHandle, b.toLowerCase()) ? e(a, b, !p) : void 0; return void 0 !== f ? f : c.attributes || !p ? a.getAttribute(b) : (f = a.getAttributeNode(b)) && f.specified ? f.value : null }, fa.error = function(a) { throw new Error("Syntax error, unrecognized expression: " + a) }, fa.uniqueSort = function(a) { var b, d = [],
                e = 0,
                f = 0; if (l = !c.detectDuplicates, k = !c.sortStable && a.slice(0), a.sort(B), l) { while (b = a[f++]) b === a[f] && (e = d.push(f)); while (e--) a.splice(d[e], 1) } return k = null, a }, e = fa.getText = function(a) {
            var b, c = "",
                d = 0,
                f = a.nodeType;
            if (f) { if (1 === f || 9 === f || 11 === f) { if ("string" == typeof a.textContent) return a.textContent; for (a = a.firstChild; a; a = a.nextSibling) c += e(a) } else if (3 === f || 4 === f) return a.nodeValue } else
                while (b = a[d++]) c += e(b);
            return c
        }, d = fa.selectors = {
            cacheLength: 50,
            createPseudo: ha,
            match: W,
            attrHandle: {},
            find: {},
            relative: { ">": { dir: "parentNode", first: !0 }, " ": { dir: "parentNode" }, "+": { dir: "previousSibling", first: !0 }, "~": { dir: "previousSibling" } },
            preFilter: { ATTR: function(a) { return a[1] = a[1].replace(ba, ca), a[3] = (a[3] || a[4] || a[5] || "").replace(ba, ca), "~=" === a[2] && (a[3] = " " + a[3] + " "), a.slice(0, 4) }, CHILD: function(a) { return a[1] = a[1].toLowerCase(), "nth" === a[1].slice(0, 3) ? (a[3] || fa.error(a[0]), a[4] = +(a[4] ? a[5] + (a[6] || 1) : 2 * ("even" === a[3] || "odd" === a[3])), a[5] = +(a[7] + a[8] || "odd" === a[3])) : a[3] && fa.error(a[0]), a }, PSEUDO: function(a) { var b, c = !a[6] && a[2]; return W.CHILD.test(a[0]) ? null : (a[3] ? a[2] = a[4] || a[5] || "" : c && U.test(c) && (b = g(c, !0)) && (b = c.indexOf(")", c.length - b) - c.length) && (a[0] = a[0].slice(0, b), a[2] = c.slice(0, b)), a.slice(0, 3)) } },
            filter: { TAG: function(a) { var b = a.replace(ba, ca).toLowerCase(); return "*" === a ? function() { return !0 } : function(a) { return a.nodeName && a.nodeName.toLowerCase() === b } }, CLASS: function(a) { var b = y[a + " "]; return b || (b = new RegExp("(^|" + L + ")" + a + "(" + L + "|$)")) && y(a, function(a) { return b.test("string" == typeof a.className && a.className || "undefined" != typeof a.getAttribute && a.getAttribute("class") || "") }) }, ATTR: function(a, b, c) { return function(d) { var e = fa.attr(d, a); return null == e ? "!=" === b : b ? (e += "", "=" === b ? e === c : "!=" === b ? e !== c : "^=" === b ? c && 0 === e.indexOf(c) : "*=" === b ? c && e.indexOf(c) > -1 : "$=" === b ? c && e.slice(-c.length) === c : "~=" === b ? (" " + e.replace(P, " ") + " ").indexOf(c) > -1 : "|=" === b ? e === c || e.slice(0, c.length + 1) === c + "-" : !1) : !0 } }, CHILD: function(a, b, c, d, e) { var f = "nth" !== a.slice(0, 3),
                        g = "last" !== a.slice(-4),
                        h = "of-type" === b; return 1 === d && 0 === e ? function(a) { return !!a.parentNode } : function(b, c, i) { var j, k, l, m, n, o, p = f !== g ? "nextSibling" : "previousSibling",
                            q = b.parentNode,
                            r = h && b.nodeName.toLowerCase(),
                            s = !i && !h,
                            t = !1; if (q) { if (f) { while (p) { m = b; while (m = m[p])
                                        if (h ? m.nodeName.toLowerCase() === r : 1 === m.nodeType) return !1;
                                    o = p = "only" === a && !o && "nextSibling" } return !0 } if (o = [g ? q.firstChild : q.lastChild], g && s) { m = q, l = m[u] || (m[u] = {}), k = l[m.uniqueID] || (l[m.uniqueID] = {}), j = k[a] || [], n = j[0] === w && j[1], t = n && j[2], m = n && q.childNodes[n]; while (m = ++n && m && m[p] || (t = n = 0) || o.pop())
                                    if (1 === m.nodeType && ++t && m === b) { k[a] = [w, n, t]; break } } else if (s && (m = b, l = m[u] || (m[u] = {}), k = l[m.uniqueID] || (l[m.uniqueID] = {}), j = k[a] || [], n = j[0] === w && j[1], t = n), t === !1)
                                while (m = ++n && m && m[p] || (t = n = 0) || o.pop())
                                    if ((h ? m.nodeName.toLowerCase() === r : 1 === m.nodeType) && ++t && (s && (l = m[u] || (m[u] = {}), k = l[m.uniqueID] || (l[m.uniqueID] = {}), k[a] = [w, t]), m === b)) break; return t -= e, t === d || t % d === 0 && t / d >= 0 } } }, PSEUDO: function(a, b) { var c, e = d.pseudos[a] || d.setFilters[a.toLowerCase()] || fa.error("unsupported pseudo: " + a); return e[u] ? e(b) : e.length > 1 ? (c = [a, a, "", b], d.setFilters.hasOwnProperty(a.toLowerCase()) ? ha(function(a, c) { var d, f = e(a, b),
                            g = f.length; while (g--) d = J(a, f[g]), a[d] = !(c[d] = f[g]) }) : function(a) { return e(a, 0, c) }) : e } },
            pseudos: {
                not: ha(function(a) { var b = [],
                        c = [],
                        d = h(a.replace(Q, "$1")); return d[u] ? ha(function(a, b, c, e) { var f, g = d(a, null, e, []),
                            h = a.length; while (h--)(f = g[h]) && (a[h] = !(b[h] = f)) }) : function(a, e, f) { return b[0] = a, d(b, null, f, c), b[0] = null, !c.pop() } }),
                has: ha(function(a) { return function(b) { return fa(a, b).length > 0 } }),
                contains: ha(function(a) { return a = a.replace(ba, ca),
                        function(b) { return (b.textContent || b.innerText || e(b)).indexOf(a) > -1 } }),
                lang: ha(function(a) {
                    return V.test(a || "") || fa.error("unsupported lang: " + a), a = a.replace(ba, ca).toLowerCase(),
                        function(b) {
                            var c;
                            do
                                if (c = p ? b.lang : b.getAttribute("xml:lang") || b.getAttribute("lang")) return c = c.toLowerCase(), c === a || 0 === c.indexOf(a + "-"); while ((b = b.parentNode) && 1 === b.nodeType);
                            return !1
                        }
                }),
                target: function(b) { var c = a.location && a.location.hash; return c && c.slice(1) === b.id },
                root: function(a) { return a === o },
                focus: function(a) { return a === n.activeElement && (!n.hasFocus || n.hasFocus()) && !!(a.type || a.href || ~a.tabIndex) },
                enabled: function(a) { return a.disabled === !1 },
                disabled: function(a) { return a.disabled === !0 },
                checked: function(a) { var b = a.nodeName.toLowerCase(); return "input" === b && !!a.checked || "option" === b && !!a.selected },
                selected: function(a) { return a.parentNode && a.parentNode.selectedIndex, a.selected === !0 },
                empty: function(a) { for (a = a.firstChild; a; a = a.nextSibling)
                        if (a.nodeType < 6) return !1; return !0 },
                parent: function(a) { return !d.pseudos.empty(a) },
                header: function(a) { return Y.test(a.nodeName) },
                input: function(a) { return X.test(a.nodeName) },
                button: function(a) { var b = a.nodeName.toLowerCase(); return "input" === b && "button" === a.type || "button" === b },
                text: function(a) { var b; return "input" === a.nodeName.toLowerCase() && "text" === a.type && (null == (b = a.getAttribute("type")) || "text" === b.toLowerCase()) },
                first: na(function() { return [0] }),
                last: na(function(a, b) { return [b - 1] }),
                eq: na(function(a, b, c) { return [0 > c ? c + b : c] }),
                even: na(function(a, b) { for (var c = 0; b > c; c += 2) a.push(c); return a }),
                odd: na(function(a, b) { for (var c = 1; b > c; c += 2) a.push(c); return a }),
                lt: na(function(a, b, c) { for (var d = 0 > c ? c + b : c; --d >= 0;) a.push(d); return a }),
                gt: na(function(a, b, c) { for (var d = 0 > c ? c + b : c; ++d < b;) a.push(d); return a })
            }
        }, d.pseudos.nth = d.pseudos.eq;
        for (b in { radio: !0, checkbox: !0, file: !0, password: !0, image: !0 }) d.pseudos[b] = la(b);
        for (b in { submit: !0, reset: !0 }) d.pseudos[b] = ma(b);

        function pa() {} pa.prototype = d.filters = d.pseudos, d.setFilters = new pa, g = fa.tokenize = function(a, b) { var c, e, f, g, h, i, j, k = z[a + " "]; if (k) return b ? 0 : k.slice(0);
            h = a, i = [], j = d.preFilter; while (h) { c && !(e = R.exec(h)) || (e && (h = h.slice(e[0].length) || h), i.push(f = [])), c = !1, (e = S.exec(h)) && (c = e.shift(), f.push({ value: c, type: e[0].replace(Q, " ") }), h = h.slice(c.length)); for (g in d.filter) !(e = W[g].exec(h)) || j[g] && !(e = j[g](e)) || (c = e.shift(), f.push({ value: c, type: g, matches: e }), h = h.slice(c.length)); if (!c) break } return b ? h.length : h ? fa.error(a) : z(a, i).slice(0) };

        function qa(a) { for (var b = 0, c = a.length, d = ""; c > b; b++) d += a[b].value; return d }

        function ra(a, b, c) {
            var d = b.dir,
                e = c && "parentNode" === d,
                f = x++;
            return b.first ? function(b, c, f) { while (b = b[d])
                    if (1 === b.nodeType || e) return a(b, c, f) } : function(b, c, g) {
                var h, i, j, k = [w, f];
                if (g) { while (b = b[d])
                        if ((1 === b.nodeType || e) && a(b, c, g)) return !0 } else
                    while (b = b[d])
                        if (1 === b.nodeType || e) { if (j = b[u] || (b[u] = {}), i = j[b.uniqueID] || (j[b.uniqueID] = {}), (h = i[d]) && h[0] === w && h[1] === f) return k[2] = h[2]; if (i[d] = k, k[2] = a(b, c, g)) return !0 }
            }
        }

        function sa(a) { return a.length > 1 ? function(b, c, d) { var e = a.length; while (e--)
                    if (!a[e](b, c, d)) return !1; return !0 } : a[0] }

        function ta(a, b, c) { for (var d = 0, e = b.length; e > d; d++) fa(a, b[d], c); return c }

        function ua(a, b, c, d, e) { for (var f, g = [], h = 0, i = a.length, j = null != b; i > h; h++)(f = a[h]) && (c && !c(f, d, e) || (g.push(f), j && b.push(h))); return g }

        function va(a, b, c, d, e, f) { return d && !d[u] && (d = va(d)), e && !e[u] && (e = va(e, f)), ha(function(f, g, h, i) { var j, k, l, m = [],
                    n = [],
                    o = g.length,
                    p = f || ta(b || "*", h.nodeType ? [h] : h, []),
                    q = !a || !f && b ? p : ua(p, m, a, h, i),
                    r = c ? e || (f ? a : o || d) ? [] : g : q; if (c && c(q, r, h, i), d) { j = ua(r, n), d(j, [], h, i), k = j.length; while (k--)(l = j[k]) && (r[n[k]] = !(q[n[k]] = l)) } if (f) { if (e || a) { if (e) { j = [], k = r.length; while (k--)(l = r[k]) && j.push(q[k] = l);
                            e(null, r = [], j, i) } k = r.length; while (k--)(l = r[k]) && (j = e ? J(f, l) : m[k]) > -1 && (f[j] = !(g[j] = l)) } } else r = ua(r === g ? r.splice(o, r.length) : r), e ? e(null, g, r, i) : H.apply(g, r) }) }

        function wa(a) { for (var b, c, e, f = a.length, g = d.relative[a[0].type], h = g || d.relative[" "], i = g ? 1 : 0, k = ra(function(a) { return a === b }, h, !0), l = ra(function(a) { return J(b, a) > -1 }, h, !0), m = [function(a, c, d) { var e = !g && (d || c !== j) || ((b = c).nodeType ? k(a, c, d) : l(a, c, d)); return b = null, e }]; f > i; i++)
                if (c = d.relative[a[i].type]) m = [ra(sa(m), c)];
                else { if (c = d.filter[a[i].type].apply(null, a[i].matches), c[u]) { for (e = ++i; f > e; e++)
                            if (d.relative[a[e].type]) break; return va(i > 1 && sa(m), i > 1 && qa(a.slice(0, i - 1).concat({ value: " " === a[i - 2].type ? "*" : "" })).replace(Q, "$1"), c, e > i && wa(a.slice(i, e)), f > e && wa(a = a.slice(e)), f > e && qa(a)) } m.push(c) }
            return sa(m) }

        function xa(a, b) { var c = b.length > 0,
                e = a.length > 0,
                f = function(f, g, h, i, k) { var l, o, q, r = 0,
                        s = "0",
                        t = f && [],
                        u = [],
                        v = j,
                        x = f || e && d.find.TAG("*", k),
                        y = w += null == v ? 1 : Math.random() || .1,
                        z = x.length; for (k && (j = g === n || g || k); s !== z && null != (l = x[s]); s++) { if (e && l) { o = 0, g || l.ownerDocument === n || (m(l), h = !p); while (q = a[o++])
                                if (q(l, g || n, h)) { i.push(l); break }
                            k && (w = y) } c && ((l = !q && l) && r--, f && t.push(l)) } if (r += s, c && s !== r) { o = 0; while (q = b[o++]) q(t, u, g, h); if (f) { if (r > 0)
                                while (s--) t[s] || u[s] || (u[s] = F.call(i));
                            u = ua(u) } H.apply(i, u), k && !f && u.length > 0 && r + b.length > 1 && fa.uniqueSort(i) } return k && (w = y, j = v), t }; return c ? ha(f) : f }
        return h = fa.compile = function(a, b) { var c, d = [],
                e = [],
                f = A[a + " "]; if (!f) { b || (b = g(a)), c = b.length; while (c--) f = wa(b[c]), f[u] ? d.push(f) : e.push(f);
                f = A(a, xa(e, d)), f.selector = a } return f }, i = fa.select = function(a, b, e, f) { var i, j, k, l, m, n = "function" == typeof a && a,
                o = !f && g(a = n.selector || a); if (e = e || [], 1 === o.length) { if (j = o[0] = o[0].slice(0), j.length > 2 && "ID" === (k = j[0]).type && c.getById && 9 === b.nodeType && p && d.relative[j[1].type]) { if (b = (d.find.ID(k.matches[0].replace(ba, ca), b) || [])[0], !b) return e;
                    n && (b = b.parentNode), a = a.slice(j.shift().value.length) } i = W.needsContext.test(a) ? 0 : j.length; while (i--) { if (k = j[i], d.relative[l = k.type]) break; if ((m = d.find[l]) && (f = m(k.matches[0].replace(ba, ca), _.test(j[0].type) && oa(b.parentNode) || b))) { if (j.splice(i, 1), a = f.length && qa(j), !a) return H.apply(e, f), e; break } } } return (n || h(a, o))(f, b, !p, e, !b || _.test(a) && oa(b.parentNode) || b), e }, c.sortStable = u.split("").sort(B).join("") === u, c.detectDuplicates = !!l, m(), c.sortDetached = ia(function(a) { return 1 & a.compareDocumentPosition(n.createElement("div")) }), ia(function(a) { return a.innerHTML = "<a href='#'></a>", "#" === a.firstChild.getAttribute("href") }) || ja("type|href|height|width", function(a, b, c) { return c ? void 0 : a.getAttribute(b, "type" === b.toLowerCase() ? 1 : 2) }), c.attributes && ia(function(a) { return a.innerHTML = "<input/>", a.firstChild.setAttribute("value", ""), "" === a.firstChild.getAttribute("value") }) || ja("value", function(a, b, c) { return c || "input" !== a.nodeName.toLowerCase() ? void 0 : a.defaultValue }), ia(function(a) { return null == a.getAttribute("disabled") }) || ja(K, function(a, b, c) { var d; return c ? void 0 : a[b] === !0 ? b.toLowerCase() : (d = a.getAttributeNode(b)) && d.specified ? d.value : null }), fa
    }(a);
    n.find = t, n.expr = t.selectors, n.expr[":"] = n.expr.pseudos, n.uniqueSort = n.unique = t.uniqueSort, n.text = t.getText, n.isXMLDoc = t.isXML, n.contains = t.contains;
    var u = function(a, b, c) { var d = [],
                e = void 0 !== c; while ((a = a[b]) && 9 !== a.nodeType)
                if (1 === a.nodeType) { if (e && n(a).is(c)) break;
                    d.push(a) }
            return d },
        v = function(a, b) { for (var c = []; a; a = a.nextSibling) 1 === a.nodeType && a !== b && c.push(a); return c },
        w = n.expr.match.needsContext,
        x = /^<([\w-]+)\s*\/?>(?:<\/\1>|)$/,
        y = /^.[^:#\[\.,]*$/;

    function z(a, b, c) { if (n.isFunction(b)) return n.grep(a, function(a, d) { return !!b.call(a, d, a) !== c }); if (b.nodeType) return n.grep(a, function(a) { return a === b !== c }); if ("string" == typeof b) { if (y.test(b)) return n.filter(b, a, c);
            b = n.filter(b, a) } return n.grep(a, function(a) { return h.call(b, a) > -1 !== c }) } n.filter = function(a, b, c) { var d = b[0]; return c && (a = ":not(" + a + ")"), 1 === b.length && 1 === d.nodeType ? n.find.matchesSelector(d, a) ? [d] : [] : n.find.matches(a, n.grep(b, function(a) { return 1 === a.nodeType })) }, n.fn.extend({ find: function(a) { var b, c = this.length,
                d = [],
                e = this; if ("string" != typeof a) return this.pushStack(n(a).filter(function() { for (b = 0; c > b; b++)
                    if (n.contains(e[b], this)) return !0 })); for (b = 0; c > b; b++) n.find(a, e[b], d); return d = this.pushStack(c > 1 ? n.unique(d) : d), d.selector = this.selector ? this.selector + " " + a : a, d }, filter: function(a) { return this.pushStack(z(this, a || [], !1)) }, not: function(a) { return this.pushStack(z(this, a || [], !0)) }, is: function(a) { return !!z(this, "string" == typeof a && w.test(a) ? n(a) : a || [], !1).length } });
    var A, B = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/,
        C = n.fn.init = function(a, b, c) { var e, f; if (!a) return this; if (c = c || A, "string" == typeof a) { if (e = "<" === a[0] && ">" === a[a.length - 1] && a.length >= 3 ? [null, a, null] : B.exec(a), !e || !e[1] && b) return !b || b.jquery ? (b || c).find(a) : this.constructor(b).find(a); if (e[1]) { if (b = b instanceof n ? b[0] : b, n.merge(this, n.parseHTML(e[1], b && b.nodeType ? b.ownerDocument || b : d, !0)), x.test(e[1]) && n.isPlainObject(b))
                        for (e in b) n.isFunction(this[e]) ? this[e](b[e]) : this.attr(e, b[e]); return this } return f = d.getElementById(e[2]), f && f.parentNode && (this.length = 1, this[0] = f), this.context = d, this.selector = a, this } return a.nodeType ? (this.context = this[0] = a, this.length = 1, this) : n.isFunction(a) ? void 0 !== c.ready ? c.ready(a) : a(n) : (void 0 !== a.selector && (this.selector = a.selector, this.context = a.context), n.makeArray(a, this)) };
    C.prototype = n.fn, A = n(d);
    var D = /^(?:parents|prev(?:Until|All))/,
        E = { children: !0, contents: !0, next: !0, prev: !0 };
    n.fn.extend({ has: function(a) { var b = n(a, this),
                c = b.length; return this.filter(function() { for (var a = 0; c > a; a++)
                    if (n.contains(this, b[a])) return !0 }) }, closest: function(a, b) { for (var c, d = 0, e = this.length, f = [], g = w.test(a) || "string" != typeof a ? n(a, b || this.context) : 0; e > d; d++)
                for (c = this[d]; c && c !== b; c = c.parentNode)
                    if (c.nodeType < 11 && (g ? g.index(c) > -1 : 1 === c.nodeType && n.find.matchesSelector(c, a))) { f.push(c); break }
            return this.pushStack(f.length > 1 ? n.uniqueSort(f) : f) }, index: function(a) { return a ? "string" == typeof a ? h.call(n(a), this[0]) : h.call(this, a.jquery ? a[0] : a) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1 }, add: function(a, b) { return this.pushStack(n.uniqueSort(n.merge(this.get(), n(a, b)))) }, addBack: function(a) { return this.add(null == a ? this.prevObject : this.prevObject.filter(a)) } });

    function F(a, b) { while ((a = a[b]) && 1 !== a.nodeType); return a } n.each({ parent: function(a) { var b = a.parentNode; return b && 11 !== b.nodeType ? b : null }, parents: function(a) { return u(a, "parentNode") }, parentsUntil: function(a, b, c) { return u(a, "parentNode", c) }, next: function(a) { return F(a, "nextSibling") }, prev: function(a) { return F(a, "previousSibling") }, nextAll: function(a) { return u(a, "nextSibling") }, prevAll: function(a) { return u(a, "previousSibling") }, nextUntil: function(a, b, c) { return u(a, "nextSibling", c) }, prevUntil: function(a, b, c) { return u(a, "previousSibling", c) }, siblings: function(a) { return v((a.parentNode || {}).firstChild, a) }, children: function(a) { return v(a.firstChild) }, contents: function(a) { return a.contentDocument || n.merge([], a.childNodes) } }, function(a, b) { n.fn[a] = function(c, d) { var e = n.map(this, b, c); return "Until" !== a.slice(-5) && (d = c), d && "string" == typeof d && (e = n.filter(d, e)), this.length > 1 && (E[a] || n.uniqueSort(e), D.test(a) && e.reverse()), this.pushStack(e) } });
    var G = /\S+/g;

    function H(a) { var b = {}; return n.each(a.match(G) || [], function(a, c) { b[c] = !0 }), b } n.Callbacks = function(a) { a = "string" == typeof a ? H(a) : n.extend({}, a); var b, c, d, e, f = [],
            g = [],
            h = -1,
            i = function() { for (e = a.once, d = b = !0; g.length; h = -1) { c = g.shift(); while (++h < f.length) f[h].apply(c[0], c[1]) === !1 && a.stopOnFalse && (h = f.length, c = !1) } a.memory || (c = !1), b = !1, e && (f = c ? [] : "") },
            j = { add: function() { return f && (c && !b && (h = f.length - 1, g.push(c)), function d(b) { n.each(b, function(b, c) { n.isFunction(c) ? a.unique && j.has(c) || f.push(c) : c && c.length && "string" !== n.type(c) && d(c) }) }(arguments), c && !b && i()), this }, remove: function() { return n.each(arguments, function(a, b) { var c; while ((c = n.inArray(b, f, c)) > -1) f.splice(c, 1), h >= c && h-- }), this }, has: function(a) { return a ? n.inArray(a, f) > -1 : f.length > 0 }, empty: function() { return f && (f = []), this }, disable: function() { return e = g = [], f = c = "", this }, disabled: function() { return !f }, lock: function() { return e = g = [], c || (f = c = ""), this }, locked: function() { return !!e }, fireWith: function(a, c) { return e || (c = c || [], c = [a, c.slice ? c.slice() : c], g.push(c), b || i()), this }, fire: function() { return j.fireWith(this, arguments), this }, fired: function() { return !!d } }; return j }, n.extend({ Deferred: function(a) { var b = [
                    ["resolve", "done", n.Callbacks("once memory"), "resolved"],
                    ["reject", "fail", n.Callbacks("once memory"), "rejected"],
                    ["notify", "progress", n.Callbacks("memory")]
                ],
                c = "pending",
                d = { state: function() { return c }, always: function() { return e.done(arguments).fail(arguments), this }, then: function() { var a = arguments; return n.Deferred(function(c) { n.each(b, function(b, f) { var g = n.isFunction(a[b]) && a[b];
                                e[f[1]](function() { var a = g && g.apply(this, arguments);
                                    a && n.isFunction(a.promise) ? a.promise().progress(c.notify).done(c.resolve).fail(c.reject) : c[f[0] + "With"](this === d ? c.promise() : this, g ? [a] : arguments) }) }), a = null }).promise() }, promise: function(a) { return null != a ? n.extend(a, d) : d } },
                e = {}; return d.pipe = d.then, n.each(b, function(a, f) { var g = f[2],
                    h = f[3];
                d[f[1]] = g.add, h && g.add(function() { c = h }, b[1 ^ a][2].disable, b[2][2].lock), e[f[0]] = function() { return e[f[0] + "With"](this === e ? d : this, arguments), this }, e[f[0] + "With"] = g.fireWith }), d.promise(e), a && a.call(e, e), e }, when: function(a) { var b = 0,
                c = e.call(arguments),
                d = c.length,
                f = 1 !== d || a && n.isFunction(a.promise) ? d : 0,
                g = 1 === f ? a : n.Deferred(),
                h = function(a, b, c) { return function(d) { b[a] = this, c[a] = arguments.length > 1 ? e.call(arguments) : d, c === i ? g.notifyWith(b, c) : --f || g.resolveWith(b, c) } },
                i, j, k; if (d > 1)
                for (i = new Array(d), j = new Array(d), k = new Array(d); d > b; b++) c[b] && n.isFunction(c[b].promise) ? c[b].promise().progress(h(b, j, i)).done(h(b, k, c)).fail(g.reject) : --f; return f || g.resolveWith(k, c), g.promise() } });
    var I;
    n.fn.ready = function(a) { return n.ready.promise().done(a), this }, n.extend({ isReady: !1, readyWait: 1, holdReady: function(a) { a ? n.readyWait++ : n.ready(!0) }, ready: function(a) {
            (a === !0 ? --n.readyWait : n.isReady) || (n.isReady = !0, a !== !0 && --n.readyWait > 0 || (I.resolveWith(d, [n]), n.fn.triggerHandler && (n(d).triggerHandler("ready"), n(d).off("ready")))) } });

    function J() { d.removeEventListener("DOMContentLoaded", J), a.removeEventListener("load", J), n.ready() } n.ready.promise = function(b) { return I || (I = n.Deferred(), "complete" === d.readyState || "loading" !== d.readyState && !d.documentElement.doScroll ? a.setTimeout(n.ready) : (d.addEventListener("DOMContentLoaded", J), a.addEventListener("load", J))), I.promise(b) }, n.ready.promise();
    var K = function(a, b, c, d, e, f, g) { var h = 0,
                i = a.length,
                j = null == c; if ("object" === n.type(c)) { e = !0; for (h in c) K(a, b, h, c[h], !0, f, g) } else if (void 0 !== d && (e = !0, n.isFunction(d) || (g = !0), j && (g ? (b.call(a, d), b = null) : (j = b, b = function(a, b, c) { return j.call(n(a), c) })), b))
                for (; i > h; h++) b(a[h], c, g ? d : d.call(a[h], h, b(a[h], c))); return e ? a : j ? b.call(a) : i ? b(a[0], c) : f },
        L = function(a) { return 1 === a.nodeType || 9 === a.nodeType || !+a.nodeType };

    function M() { this.expando = n.expando + M.uid++ } M.uid = 1, M.prototype = {
        register: function(a, b) { var c = b || {}; return a.nodeType ? a[this.expando] = c : Object.defineProperty(a, this.expando, { value: c, writable: !0, configurable: !0 }), a[this.expando] },
        cache: function(a) { if (!L(a)) return {}; var b = a[this.expando]; return b || (b = {}, L(a) && (a.nodeType ? a[this.expando] = b : Object.defineProperty(a, this.expando, { value: b, configurable: !0 }))), b },
        set: function(a, b, c) {
            var d, e = this.cache(a);
            if ("string" == typeof b) e[b] = c;
            else
                for (d in b) e[d] = b[d];
            return e
        },
        get: function(a, b) { return void 0 === b ? this.cache(a) : a[this.expando] && a[this.expando][b] },
        access: function(a, b, c) { var d; return void 0 === b || b && "string" == typeof b && void 0 === c ? (d = this.get(a, b), void 0 !== d ? d : this.get(a, n.camelCase(b))) : (this.set(a, b, c), void 0 !== c ? c : b) },
        remove: function(a, b) { var c, d, e, f = a[this.expando]; if (void 0 !== f) { if (void 0 === b) this.register(a);
                else { n.isArray(b) ? d = b.concat(b.map(n.camelCase)) : (e = n.camelCase(b), b in f ? d = [b, e] : (d = e, d = d in f ? [d] : d.match(G) || [])), c = d.length; while (c--) delete f[d[c]] }(void 0 === b || n.isEmptyObject(f)) && (a.nodeType ? a[this.expando] = void 0 : delete a[this.expando]) } },
        hasData: function(a) { var b = a[this.expando]; return void 0 !== b && !n.isEmptyObject(b) }
    };
    var N = new M,
        O = new M,
        P = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
        Q = /[A-Z]/g;

    function R(a, b, c) { var d; if (void 0 === c && 1 === a.nodeType)
            if (d = "data-" + b.replace(Q, "-$&").toLowerCase(), c = a.getAttribute(d), "string" == typeof c) { try { c = "true" === c ? !0 : "false" === c ? !1 : "null" === c ? null : +c + "" === c ? +c : P.test(c) ? n.parseJSON(c) : c; } catch (e) {} O.set(a, b, c) } else c = void 0; return c } n.extend({ hasData: function(a) { return O.hasData(a) || N.hasData(a) }, data: function(a, b, c) { return O.access(a, b, c) }, removeData: function(a, b) { O.remove(a, b) }, _data: function(a, b, c) { return N.access(a, b, c) }, _removeData: function(a, b) { N.remove(a, b) } }), n.fn.extend({ data: function(a, b) { var c, d, e, f = this[0],
                g = f && f.attributes; if (void 0 === a) { if (this.length && (e = O.get(f), 1 === f.nodeType && !N.get(f, "hasDataAttrs"))) { c = g.length; while (c--) g[c] && (d = g[c].name, 0 === d.indexOf("data-") && (d = n.camelCase(d.slice(5)), R(f, d, e[d])));
                    N.set(f, "hasDataAttrs", !0) } return e } return "object" == typeof a ? this.each(function() { O.set(this, a) }) : K(this, function(b) { var c, d; if (f && void 0 === b) { if (c = O.get(f, a) || O.get(f, a.replace(Q, "-$&").toLowerCase()), void 0 !== c) return c; if (d = n.camelCase(a), c = O.get(f, d), void 0 !== c) return c; if (c = R(f, d, void 0), void 0 !== c) return c } else d = n.camelCase(a), this.each(function() { var c = O.get(this, d);
                    O.set(this, d, b), a.indexOf("-") > -1 && void 0 !== c && O.set(this, a, b) }) }, null, b, arguments.length > 1, null, !0) }, removeData: function(a) { return this.each(function() { O.remove(this, a) }) } }), n.extend({ queue: function(a, b, c) { var d; return a ? (b = (b || "fx") + "queue", d = N.get(a, b), c && (!d || n.isArray(c) ? d = N.access(a, b, n.makeArray(c)) : d.push(c)), d || []) : void 0 }, dequeue: function(a, b) { b = b || "fx"; var c = n.queue(a, b),
                d = c.length,
                e = c.shift(),
                f = n._queueHooks(a, b),
                g = function() { n.dequeue(a, b) }; "inprogress" === e && (e = c.shift(), d--), e && ("fx" === b && c.unshift("inprogress"), delete f.stop, e.call(a, g, f)), !d && f && f.empty.fire() }, _queueHooks: function(a, b) { var c = b + "queueHooks"; return N.get(a, c) || N.access(a, c, { empty: n.Callbacks("once memory").add(function() { N.remove(a, [b + "queue", c]) }) }) } }), n.fn.extend({ queue: function(a, b) { var c = 2; return "string" != typeof a && (b = a, a = "fx", c--), arguments.length < c ? n.queue(this[0], a) : void 0 === b ? this : this.each(function() { var c = n.queue(this, a, b);
                n._queueHooks(this, a), "fx" === a && "inprogress" !== c[0] && n.dequeue(this, a) }) }, dequeue: function(a) { return this.each(function() { n.dequeue(this, a) }) }, clearQueue: function(a) { return this.queue(a || "fx", []) }, promise: function(a, b) { var c, d = 1,
                e = n.Deferred(),
                f = this,
                g = this.length,
                h = function() {--d || e.resolveWith(f, [f]) }; "string" != typeof a && (b = a, a = void 0), a = a || "fx"; while (g--) c = N.get(f[g], a + "queueHooks"), c && c.empty && (d++, c.empty.add(h)); return h(), e.promise(b) } });
    var S = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
        T = new RegExp("^(?:([+-])=|)(" + S + ")([a-z%]*)$", "i"),
        U = ["Top", "Right", "Bottom", "Left"],
        V = function(a, b) { return a = b || a, "none" === n.css(a, "display") || !n.contains(a.ownerDocument, a) };

    function W(a, b, c, d) { var e, f = 1,
            g = 20,
            h = d ? function() { return d.cur() } : function() { return n.css(a, b, "") },
            i = h(),
            j = c && c[3] || (n.cssNumber[b] ? "" : "px"),
            k = (n.cssNumber[b] || "px" !== j && +i) && T.exec(n.css(a, b)); if (k && k[3] !== j) { j = j || k[3], c = c || [], k = +i || 1;
            do f = f || ".5", k /= f, n.style(a, b, k + j); while (f !== (f = h() / i) && 1 !== f && --g) } return c && (k = +k || +i || 0, e = c[1] ? k + (c[1] + 1) * c[2] : +c[2], d && (d.unit = j, d.start = k, d.end = e)), e }
    var X = /^(?:checkbox|radio)$/i,
        Y = /<([\w:-]+)/,
        Z = /^$|\/(?:java|ecma)script/i,
        $ = { option: [1, "<select multiple='multiple'>", "</select>"], thead: [1, "<table>", "</table>"], col: [2, "<table><colgroup>", "</colgroup></table>"], tr: [2, "<table><tbody>", "</tbody></table>"], td: [3, "<table><tbody><tr>", "</tr></tbody></table>"], _default: [0, "", ""] };
    $.optgroup = $.option, $.tbody = $.tfoot = $.colgroup = $.caption = $.thead, $.th = $.td;

    function _(a, b) { var c = "undefined" != typeof a.getElementsByTagName ? a.getElementsByTagName(b || "*") : "undefined" != typeof a.querySelectorAll ? a.querySelectorAll(b || "*") : []; return void 0 === b || b && n.nodeName(a, b) ? n.merge([a], c) : c }

    function aa(a, b) { for (var c = 0, d = a.length; d > c; c++) N.set(a[c], "globalEval", !b || N.get(b[c], "globalEval")) }
    var ba = /<|&#?\w+;/;

    function ca(a, b, c, d, e) { for (var f, g, h, i, j, k, l = b.createDocumentFragment(), m = [], o = 0, p = a.length; p > o; o++)
            if (f = a[o], f || 0 === f)
                if ("object" === n.type(f)) n.merge(m, f.nodeType ? [f] : f);
                else if (ba.test(f)) { g = g || l.appendChild(b.createElement("div")), h = (Y.exec(f) || ["", ""])[1].toLowerCase(), i = $[h] || $._default, g.innerHTML = i[1] + n.htmlPrefilter(f) + i[2], k = i[0]; while (k--) g = g.lastChild;
            n.merge(m, g.childNodes), g = l.firstChild, g.textContent = "" } else m.push(b.createTextNode(f));
        l.textContent = "", o = 0; while (f = m[o++])
            if (d && n.inArray(f, d) > -1) e && e.push(f);
            else if (j = n.contains(f.ownerDocument, f), g = _(l.appendChild(f), "script"), j && aa(g), c) { k = 0; while (f = g[k++]) Z.test(f.type || "") && c.push(f) } return l }! function() { var a = d.createDocumentFragment(),
            b = a.appendChild(d.createElement("div")),
            c = d.createElement("input");
        c.setAttribute("type", "radio"), c.setAttribute("checked", "checked"), c.setAttribute("name", "t"), b.appendChild(c), l.checkClone = b.cloneNode(!0).cloneNode(!0).lastChild.checked, b.innerHTML = "<textarea>x</textarea>", l.noCloneChecked = !!b.cloneNode(!0).lastChild.defaultValue }();
    var da = /^key/,
        ea = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
        fa = /^([^.]*)(?:\.(.+)|)/;

    function ga() { return !0 }

    function ha() { return !1 }

    function ia() { try { return d.activeElement } catch (a) {} }

    function ja(a, b, c, d, e, f) { var g, h; if ("object" == typeof b) { "string" != typeof c && (d = d || c, c = void 0); for (h in b) ja(a, h, c, d, b[h], f); return a } if (null == d && null == e ? (e = c, d = c = void 0) : null == e && ("string" == typeof c ? (e = d, d = void 0) : (e = d, d = c, c = void 0)), e === !1) e = ha;
        else if (!e) return a; return 1 === f && (g = e, e = function(a) { return n().off(a), g.apply(this, arguments) }, e.guid = g.guid || (g.guid = n.guid++)), a.each(function() { n.event.add(this, b, e, d, c) }) } n.event = {
        global: {},
        add: function(a, b, c, d, e) { var f, g, h, i, j, k, l, m, o, p, q, r = N.get(a); if (r) { c.handler && (f = c, c = f.handler, e = f.selector), c.guid || (c.guid = n.guid++), (i = r.events) || (i = r.events = {}), (g = r.handle) || (g = r.handle = function(b) { return "undefined" != typeof n && n.event.triggered !== b.type ? n.event.dispatch.apply(a, arguments) : void 0 }), b = (b || "").match(G) || [""], j = b.length; while (j--) h = fa.exec(b[j]) || [], o = q = h[1], p = (h[2] || "").split(".").sort(), o && (l = n.event.special[o] || {}, o = (e ? l.delegateType : l.bindType) || o, l = n.event.special[o] || {}, k = n.extend({ type: o, origType: q, data: d, handler: c, guid: c.guid, selector: e, needsContext: e && n.expr.match.needsContext.test(e), namespace: p.join(".") }, f), (m = i[o]) || (m = i[o] = [], m.delegateCount = 0, l.setup && l.setup.call(a, d, p, g) !== !1 || a.addEventListener && a.addEventListener(o, g)), l.add && (l.add.call(a, k), k.handler.guid || (k.handler.guid = c.guid)), e ? m.splice(m.delegateCount++, 0, k) : m.push(k), n.event.global[o] = !0) } },
        remove: function(a, b, c, d, e) {
            var f, g, h, i, j, k, l, m, o, p, q, r = N.hasData(a) && N.get(a);
            if (r && (i = r.events)) {
                b = (b || "").match(G) || [""], j = b.length;
                while (j--)
                    if (h = fa.exec(b[j]) || [], o = q = h[1], p = (h[2] || "").split(".").sort(), o) { l = n.event.special[o] || {}, o = (d ? l.delegateType : l.bindType) || o, m = i[o] || [], h = h[2] && new RegExp("(^|\\.)" + p.join("\\.(?:.*\\.|)") + "(\\.|$)"), g = f = m.length; while (f--) k = m[f], !e && q !== k.origType || c && c.guid !== k.guid || h && !h.test(k.namespace) || d && d !== k.selector && ("**" !== d || !k.selector) || (m.splice(f, 1), k.selector && m.delegateCount--, l.remove && l.remove.call(a, k));
                        g && !m.length && (l.teardown && l.teardown.call(a, p, r.handle) !== !1 || n.removeEvent(a, o, r.handle), delete i[o]) } else
                        for (o in i) n.event.remove(a, o + b[j], c, d, !0);
                n.isEmptyObject(i) && N.remove(a, "handle events")
            }
        },
        dispatch: function(a) { a = n.event.fix(a); var b, c, d, f, g, h = [],
                i = e.call(arguments),
                j = (N.get(this, "events") || {})[a.type] || [],
                k = n.event.special[a.type] || {}; if (i[0] = a, a.delegateTarget = this, !k.preDispatch || k.preDispatch.call(this, a) !== !1) { h = n.event.handlers.call(this, a, j), b = 0; while ((f = h[b++]) && !a.isPropagationStopped()) { a.currentTarget = f.elem, c = 0; while ((g = f.handlers[c++]) && !a.isImmediatePropagationStopped()) a.rnamespace && !a.rnamespace.test(g.namespace) || (a.handleObj = g, a.data = g.data, d = ((n.event.special[g.origType] || {}).handle || g.handler).apply(f.elem, i), void 0 !== d && (a.result = d) === !1 && (a.preventDefault(), a.stopPropagation())) } return k.postDispatch && k.postDispatch.call(this, a), a.result } },
        handlers: function(a, b) { var c, d, e, f, g = [],
                h = b.delegateCount,
                i = a.target; if (h && i.nodeType && ("click" !== a.type || isNaN(a.button) || a.button < 1))
                for (; i !== this; i = i.parentNode || this)
                    if (1 === i.nodeType && (i.disabled !== !0 || "click" !== a.type)) { for (d = [], c = 0; h > c; c++) f = b[c], e = f.selector + " ", void 0 === d[e] && (d[e] = f.needsContext ? n(e, this).index(i) > -1 : n.find(e, this, null, [i]).length), d[e] && d.push(f);
                        d.length && g.push({ elem: i, handlers: d }) }
            return h < b.length && g.push({ elem: this, handlers: b.slice(h) }), g },
        props: "altKey bubbles cancelable ctrlKey currentTarget detail eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
        fixHooks: {},
        keyHooks: { props: "char charCode key keyCode".split(" "), filter: function(a, b) { return null == a.which && (a.which = null != b.charCode ? b.charCode : b.keyCode), a } },
        mouseHooks: { props: "button buttons clientX clientY offsetX offsetY pageX pageY screenX screenY toElement".split(" "), filter: function(a, b) { var c, e, f, g = b.button; return null == a.pageX && null != b.clientX && (c = a.target.ownerDocument || d, e = c.documentElement, f = c.body, a.pageX = b.clientX + (e && e.scrollLeft || f && f.scrollLeft || 0) - (e && e.clientLeft || f && f.clientLeft || 0), a.pageY = b.clientY + (e && e.scrollTop || f && f.scrollTop || 0) - (e && e.clientTop || f && f.clientTop || 0)), a.which || void 0 === g || (a.which = 1 & g ? 1 : 2 & g ? 3 : 4 & g ? 2 : 0), a } },
        fix: function(a) { if (a[n.expando]) return a; var b, c, e, f = a.type,
                g = a,
                h = this.fixHooks[f];
            h || (this.fixHooks[f] = h = ea.test(f) ? this.mouseHooks : da.test(f) ? this.keyHooks : {}), e = h.props ? this.props.concat(h.props) : this.props, a = new n.Event(g), b = e.length; while (b--) c = e[b], a[c] = g[c]; return a.target || (a.target = d), 3 === a.target.nodeType && (a.target = a.target.parentNode), h.filter ? h.filter(a, g) : a },
        special: { load: { noBubble: !0 }, focus: { trigger: function() { return this !== ia() && this.focus ? (this.focus(), !1) : void 0 }, delegateType: "focusin" }, blur: { trigger: function() { return this === ia() && this.blur ? (this.blur(), !1) : void 0 }, delegateType: "focusout" }, click: { trigger: function() { return "checkbox" === this.type && this.click && n.nodeName(this, "input") ? (this.click(), !1) : void 0 }, _default: function(a) { return n.nodeName(a.target, "a") } }, beforeunload: { postDispatch: function(a) { void 0 !== a.result && a.originalEvent && (a.originalEvent.returnValue = a.result) } } }
    }, n.removeEvent = function(a, b, c) { a.removeEventListener && a.removeEventListener(b, c) }, n.Event = function(a, b) { return this instanceof n.Event ? (a && a.type ? (this.originalEvent = a, this.type = a.type, this.isDefaultPrevented = a.defaultPrevented || void 0 === a.defaultPrevented && a.returnValue === !1 ? ga : ha) : this.type = a, b && n.extend(this, b), this.timeStamp = a && a.timeStamp || n.now(), void(this[n.expando] = !0)) : new n.Event(a, b) }, n.Event.prototype = { constructor: n.Event, isDefaultPrevented: ha, isPropagationStopped: ha, isImmediatePropagationStopped: ha, isSimulated: !1, preventDefault: function() { var a = this.originalEvent;
            this.isDefaultPrevented = ga, a && !this.isSimulated && a.preventDefault() }, stopPropagation: function() { var a = this.originalEvent;
            this.isPropagationStopped = ga, a && !this.isSimulated && a.stopPropagation() }, stopImmediatePropagation: function() { var a = this.originalEvent;
            this.isImmediatePropagationStopped = ga, a && !this.isSimulated && a.stopImmediatePropagation(), this.stopPropagation() } }, n.each({ mouseenter: "mouseover", mouseleave: "mouseout", pointerenter: "pointerover", pointerleave: "pointerout" }, function(a, b) { n.event.special[a] = { delegateType: b, bindType: b, handle: function(a) { var c, d = this,
                    e = a.relatedTarget,
                    f = a.handleObj; return e && (e === d || n.contains(d, e)) || (a.type = f.origType, c = f.handler.apply(this, arguments), a.type = b), c } } }), n.fn.extend({ on: function(a, b, c, d) { return ja(this, a, b, c, d) }, one: function(a, b, c, d) { return ja(this, a, b, c, d, 1) }, off: function(a, b, c) { var d, e; if (a && a.preventDefault && a.handleObj) return d = a.handleObj, n(a.delegateTarget).off(d.namespace ? d.origType + "." + d.namespace : d.origType, d.selector, d.handler), this; if ("object" == typeof a) { for (e in a) this.off(e, b, a[e]); return this } return b !== !1 && "function" != typeof b || (c = b, b = void 0), c === !1 && (c = ha), this.each(function() { n.event.remove(this, a, c, b) }) } });
    var ka = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:-]+)[^>]*)\/>/gi,
        la = /<script|<style|<link/i,
        ma = /checked\s*(?:[^=]|=\s*.checked.)/i,
        na = /^true\/(.*)/,
        oa = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;

    function pa(a, b) { return n.nodeName(a, "table") && n.nodeName(11 !== b.nodeType ? b : b.firstChild, "tr") ? a.getElementsByTagName("tbody")[0] || a.appendChild(a.ownerDocument.createElement("tbody")) : a }

    function qa(a) { return a.type = (null !== a.getAttribute("type")) + "/" + a.type, a }

    function ra(a) { var b = na.exec(a.type); return b ? a.type = b[1] : a.removeAttribute("type"), a }

    function sa(a, b) { var c, d, e, f, g, h, i, j; if (1 === b.nodeType) { if (N.hasData(a) && (f = N.access(a), g = N.set(b, f), j = f.events)) { delete g.handle, g.events = {}; for (e in j)
                    for (c = 0, d = j[e].length; d > c; c++) n.event.add(b, e, j[e][c]) } O.hasData(a) && (h = O.access(a), i = n.extend({}, h), O.set(b, i)) } }

    function ta(a, b) { var c = b.nodeName.toLowerCase(); "input" === c && X.test(a.type) ? b.checked = a.checked : "input" !== c && "textarea" !== c || (b.defaultValue = a.defaultValue) }

    function ua(a, b, c, d) { b = f.apply([], b); var e, g, h, i, j, k, m = 0,
            o = a.length,
            p = o - 1,
            q = b[0],
            r = n.isFunction(q); if (r || o > 1 && "string" == typeof q && !l.checkClone && ma.test(q)) return a.each(function(e) { var f = a.eq(e);
            r && (b[0] = q.call(this, e, f.html())), ua(f, b, c, d) }); if (o && (e = ca(b, a[0].ownerDocument, !1, a, d), g = e.firstChild, 1 === e.childNodes.length && (e = g), g || d)) { for (h = n.map(_(e, "script"), qa), i = h.length; o > m; m++) j = e, m !== p && (j = n.clone(j, !0, !0), i && n.merge(h, _(j, "script"))), c.call(a[m], j, m); if (i)
                for (k = h[h.length - 1].ownerDocument, n.map(h, ra), m = 0; i > m; m++) j = h[m], Z.test(j.type || "") && !N.access(j, "globalEval") && n.contains(k, j) && (j.src ? n._evalUrl && n._evalUrl(j.src) : n.globalEval(j.textContent.replace(oa, ""))) } return a }

    function va(a, b, c) { for (var d, e = b ? n.filter(b, a) : a, f = 0; null != (d = e[f]); f++) c || 1 !== d.nodeType || n.cleanData(_(d)), d.parentNode && (c && n.contains(d.ownerDocument, d) && aa(_(d, "script")), d.parentNode.removeChild(d)); return a } n.extend({ htmlPrefilter: function(a) { return a.replace(ka, "<$1></$2>") }, clone: function(a, b, c) { var d, e, f, g, h = a.cloneNode(!0),
                i = n.contains(a.ownerDocument, a); if (!(l.noCloneChecked || 1 !== a.nodeType && 11 !== a.nodeType || n.isXMLDoc(a)))
                for (g = _(h), f = _(a), d = 0, e = f.length; e > d; d++) ta(f[d], g[d]); if (b)
                if (c)
                    for (f = f || _(a), g = g || _(h), d = 0, e = f.length; e > d; d++) sa(f[d], g[d]);
                else sa(a, h); return g = _(h, "script"), g.length > 0 && aa(g, !i && _(a, "script")), h }, cleanData: function(a) { for (var b, c, d, e = n.event.special, f = 0; void 0 !== (c = a[f]); f++)
                if (L(c)) { if (b = c[N.expando]) { if (b.events)
                            for (d in b.events) e[d] ? n.event.remove(c, d) : n.removeEvent(c, d, b.handle);
                        c[N.expando] = void 0 } c[O.expando] && (c[O.expando] = void 0) } } }), n.fn.extend({ domManip: ua, detach: function(a) { return va(this, a, !0) }, remove: function(a) { return va(this, a) }, text: function(a) { return K(this, function(a) { return void 0 === a ? n.text(this) : this.empty().each(function() { 1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || (this.textContent = a) }) }, null, a, arguments.length) }, append: function() { return ua(this, arguments, function(a) { if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) { var b = pa(this, a);
                    b.appendChild(a) } }) }, prepend: function() { return ua(this, arguments, function(a) { if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) { var b = pa(this, a);
                    b.insertBefore(a, b.firstChild) } }) }, before: function() { return ua(this, arguments, function(a) { this.parentNode && this.parentNode.insertBefore(a, this) }) }, after: function() { return ua(this, arguments, function(a) { this.parentNode && this.parentNode.insertBefore(a, this.nextSibling) }) }, empty: function() { for (var a, b = 0; null != (a = this[b]); b++) 1 === a.nodeType && (n.cleanData(_(a, !1)), a.textContent = ""); return this }, clone: function(a, b) { return a = null == a ? !1 : a, b = null == b ? a : b, this.map(function() { return n.clone(this, a, b) }) }, html: function(a) { return K(this, function(a) { var b = this[0] || {},
                    c = 0,
                    d = this.length; if (void 0 === a && 1 === b.nodeType) return b.innerHTML; if ("string" == typeof a && !la.test(a) && !$[(Y.exec(a) || ["", ""])[1].toLowerCase()]) { a = n.htmlPrefilter(a); try { for (; d > c; c++) b = this[c] || {}, 1 === b.nodeType && (n.cleanData(_(b, !1)), b.innerHTML = a);
                        b = 0 } catch (e) {} } b && this.empty().append(a) }, null, a, arguments.length) }, replaceWith: function() { var a = []; return ua(this, arguments, function(b) { var c = this.parentNode;
                n.inArray(this, a) < 0 && (n.cleanData(_(this)), c && c.replaceChild(b, this)) }, a) } }), n.each({ appendTo: "append", prependTo: "prepend", insertBefore: "before", insertAfter: "after", replaceAll: "replaceWith" }, function(a, b) { n.fn[a] = function(a) { for (var c, d = [], e = n(a), f = e.length - 1, h = 0; f >= h; h++) c = h === f ? this : this.clone(!0), n(e[h])[b](c), g.apply(d, c.get()); return this.pushStack(d) } });
    var wa, xa = { HTML: "block", BODY: "block" };

    function ya(a, b) { var c = n(b.createElement(a)).appendTo(b.body),
            d = n.css(c[0], "display"); return c.detach(), d }

    function za(a) { var b = d,
            c = xa[a]; return c || (c = ya(a, b), "none" !== c && c || (wa = (wa || n("<iframe frameborder='0' width='0' height='0'/>")).appendTo(b.documentElement), b = wa[0].contentDocument, b.write(), b.close(), c = ya(a, b), wa.detach()), xa[a] = c), c }
    var Aa = /^margin/,
        Ba = new RegExp("^(" + S + ")(?!px)[a-z%]+$", "i"),
        Ca = function(b) { var c = b.ownerDocument.defaultView; return c && c.opener || (c = a), c.getComputedStyle(b) },
        Da = function(a, b, c, d) { var e, f, g = {}; for (f in b) g[f] = a.style[f], a.style[f] = b[f];
            e = c.apply(a, d || []); for (f in b) a.style[f] = g[f]; return e },
        Ea = d.documentElement;
    ! function() { var b, c, e, f, g = d.createElement("div"),
            h = d.createElement("div"); if (h.style) { h.style.backgroundClip = "content-box", h.cloneNode(!0).style.backgroundClip = "", l.clearCloneStyle = "content-box" === h.style.backgroundClip, g.style.cssText = "border:0;width:8px;height:0;top:0;left:-9999px;padding:0;margin-top:1px;position:absolute", g.appendChild(h);

            function i() { h.style.cssText = "-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;position:relative;display:block;margin:auto;border:1px;padding:1px;top:1%;width:50%", h.innerHTML = "", Ea.appendChild(g); var d = a.getComputedStyle(h);
                b = "1%" !== d.top, f = "2px" === d.marginLeft, c = "4px" === d.width, h.style.marginRight = "50%", e = "4px" === d.marginRight, Ea.removeChild(g) } n.extend(l, { pixelPosition: function() { return i(), b }, boxSizingReliable: function() { return null == c && i(), c }, pixelMarginRight: function() { return null == c && i(), e }, reliableMarginLeft: function() { return null == c && i(), f }, reliableMarginRight: function() { var b, c = h.appendChild(d.createElement("div")); return c.style.cssText = h.style.cssText = "-webkit-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0", c.style.marginRight = c.style.width = "0", h.style.width = "1px", Ea.appendChild(g), b = !parseFloat(a.getComputedStyle(c).marginRight), Ea.removeChild(g), h.removeChild(c), b } }) } }();

    function Fa(a, b, c) { var d, e, f, g, h = a.style; return c = c || Ca(a), g = c ? c.getPropertyValue(b) || c[b] : void 0, "" !== g && void 0 !== g || n.contains(a.ownerDocument, a) || (g = n.style(a, b)), c && !l.pixelMarginRight() && Ba.test(g) && Aa.test(b) && (d = h.width, e = h.minWidth, f = h.maxWidth, h.minWidth = h.maxWidth = h.width = g, g = c.width, h.width = d, h.minWidth = e, h.maxWidth = f), void 0 !== g ? g + "" : g }

    function Ga(a, b) { return { get: function() { return a() ? void delete this.get : (this.get = b).apply(this, arguments) } } }
    var Ha = /^(none|table(?!-c[ea]).+)/,
        Ia = { position: "absolute", visibility: "hidden", display: "block" },
        Ja = { letterSpacing: "0", fontWeight: "400" },
        Ka = ["Webkit", "O", "Moz", "ms"],
        La = d.createElement("div").style;

    function Ma(a) { if (a in La) return a; var b = a[0].toUpperCase() + a.slice(1),
            c = Ka.length; while (c--)
            if (a = Ka[c] + b, a in La) return a }

    function Na(a, b, c) { var d = T.exec(b); return d ? Math.max(0, d[2] - (c || 0)) + (d[3] || "px") : b }

    function Oa(a, b, c, d, e) { for (var f = c === (d ? "border" : "content") ? 4 : "width" === b ? 1 : 0, g = 0; 4 > f; f += 2) "margin" === c && (g += n.css(a, c + U[f], !0, e)), d ? ("content" === c && (g -= n.css(a, "padding" + U[f], !0, e)), "margin" !== c && (g -= n.css(a, "border" + U[f] + "Width", !0, e))) : (g += n.css(a, "padding" + U[f], !0, e), "padding" !== c && (g += n.css(a, "border" + U[f] + "Width", !0, e))); return g }

    function Pa(a, b, c) { var d = !0,
            e = "width" === b ? a.offsetWidth : a.offsetHeight,
            f = Ca(a),
            g = "border-box" === n.css(a, "boxSizing", !1, f); if (0 >= e || null == e) { if (e = Fa(a, b, f), (0 > e || null == e) && (e = a.style[b]), Ba.test(e)) return e;
            d = g && (l.boxSizingReliable() || e === a.style[b]), e = parseFloat(e) || 0 } return e + Oa(a, b, c || (g ? "border" : "content"), d, f) + "px" }

    function Qa(a, b) { for (var c, d, e, f = [], g = 0, h = a.length; h > g; g++) d = a[g], d.style && (f[g] = N.get(d, "olddisplay"), c = d.style.display, b ? (f[g] || "none" !== c || (d.style.display = ""), "" === d.style.display && V(d) && (f[g] = N.access(d, "olddisplay", za(d.nodeName)))) : (e = V(d), "none" === c && e || N.set(d, "olddisplay", e ? c : n.css(d, "display")))); for (g = 0; h > g; g++) d = a[g], d.style && (b && "none" !== d.style.display && "" !== d.style.display || (d.style.display = b ? f[g] || "" : "none")); return a } n.extend({ cssHooks: { opacity: { get: function(a, b) { if (b) { var c = Fa(a, "opacity"); return "" === c ? "1" : c } } } }, cssNumber: { animationIterationCount: !0, columnCount: !0, fillOpacity: !0, flexGrow: !0, flexShrink: !0, fontWeight: !0, lineHeight: !0, opacity: !0, order: !0, orphans: !0, widows: !0, zIndex: !0, zoom: !0 }, cssProps: { "float": "cssFloat" }, style: function(a, b, c, d) { if (a && 3 !== a.nodeType && 8 !== a.nodeType && a.style) { var e, f, g, h = n.camelCase(b),
                    i = a.style; return b = n.cssProps[h] || (n.cssProps[h] = Ma(h) || h), g = n.cssHooks[b] || n.cssHooks[h], void 0 === c ? g && "get" in g && void 0 !== (e = g.get(a, !1, d)) ? e : i[b] : (f = typeof c, "string" === f && (e = T.exec(c)) && e[1] && (c = W(a, b, e), f = "number"), null != c && c === c && ("number" === f && (c += e && e[3] || (n.cssNumber[h] ? "" : "px")), l.clearCloneStyle || "" !== c || 0 !== b.indexOf("background") || (i[b] = "inherit"), g && "set" in g && void 0 === (c = g.set(a, c, d)) || (i[b] = c)), void 0) } }, css: function(a, b, c, d) { var e, f, g, h = n.camelCase(b); return b = n.cssProps[h] || (n.cssProps[h] = Ma(h) || h), g = n.cssHooks[b] || n.cssHooks[h], g && "get" in g && (e = g.get(a, !0, c)), void 0 === e && (e = Fa(a, b, d)), "normal" === e && b in Ja && (e = Ja[b]), "" === c || c ? (f = parseFloat(e), c === !0 || isFinite(f) ? f || 0 : e) : e } }), n.each(["height", "width"], function(a, b) { n.cssHooks[b] = { get: function(a, c, d) { return c ? Ha.test(n.css(a, "display")) && 0 === a.offsetWidth ? Da(a, Ia, function() { return Pa(a, b, d) }) : Pa(a, b, d) : void 0 }, set: function(a, c, d) { var e, f = d && Ca(a),
                    g = d && Oa(a, b, d, "border-box" === n.css(a, "boxSizing", !1, f), f); return g && (e = T.exec(c)) && "px" !== (e[3] || "px") && (a.style[b] = c, c = n.css(a, b)), Na(a, c, g) } } }), n.cssHooks.marginLeft = Ga(l.reliableMarginLeft, function(a, b) { return b ? (parseFloat(Fa(a, "marginLeft")) || a.getBoundingClientRect().left - Da(a, { marginLeft: 0 }, function() { return a.getBoundingClientRect().left })) + "px" : void 0 }), n.cssHooks.marginRight = Ga(l.reliableMarginRight, function(a, b) { return b ? Da(a, { display: "inline-block" }, Fa, [a, "marginRight"]) : void 0 }), n.each({ margin: "", padding: "", border: "Width" }, function(a, b) { n.cssHooks[a + b] = { expand: function(c) { for (var d = 0, e = {}, f = "string" == typeof c ? c.split(" ") : [c]; 4 > d; d++) e[a + U[d] + b] = f[d] || f[d - 2] || f[0]; return e } }, Aa.test(a) || (n.cssHooks[a + b].set = Na) }), n.fn.extend({ css: function(a, b) { return K(this, function(a, b, c) { var d, e, f = {},
                    g = 0; if (n.isArray(b)) { for (d = Ca(a), e = b.length; e > g; g++) f[b[g]] = n.css(a, b[g], !1, d); return f } return void 0 !== c ? n.style(a, b, c) : n.css(a, b) }, a, b, arguments.length > 1) }, show: function() { return Qa(this, !0) }, hide: function() { return Qa(this) }, toggle: function(a) { return "boolean" == typeof a ? a ? this.show() : this.hide() : this.each(function() { V(this) ? n(this).show() : n(this).hide() }) } });

    function Ra(a, b, c, d, e) { return new Ra.prototype.init(a, b, c, d, e) } n.Tween = Ra, Ra.prototype = { constructor: Ra, init: function(a, b, c, d, e, f) { this.elem = a, this.prop = c, this.easing = e || n.easing._default, this.options = b, this.start = this.now = this.cur(), this.end = d, this.unit = f || (n.cssNumber[c] ? "" : "px") }, cur: function() { var a = Ra.propHooks[this.prop]; return a && a.get ? a.get(this) : Ra.propHooks._default.get(this) }, run: function(a) { var b, c = Ra.propHooks[this.prop]; return this.options.duration ? this.pos = b = n.easing[this.easing](a, this.options.duration * a, 0, 1, this.options.duration) : this.pos = b = a, this.now = (this.end - this.start) * b + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), c && c.set ? c.set(this) : Ra.propHooks._default.set(this), this } }, Ra.prototype.init.prototype = Ra.prototype, Ra.propHooks = { _default: { get: function(a) { var b; return 1 !== a.elem.nodeType || null != a.elem[a.prop] && null == a.elem.style[a.prop] ? a.elem[a.prop] : (b = n.css(a.elem, a.prop, ""), b && "auto" !== b ? b : 0) }, set: function(a) { n.fx.step[a.prop] ? n.fx.step[a.prop](a) : 1 !== a.elem.nodeType || null == a.elem.style[n.cssProps[a.prop]] && !n.cssHooks[a.prop] ? a.elem[a.prop] = a.now : n.style(a.elem, a.prop, a.now + a.unit) } } }, Ra.propHooks.scrollTop = Ra.propHooks.scrollLeft = { set: function(a) { a.elem.nodeType && a.elem.parentNode && (a.elem[a.prop] = a.now) } }, n.easing = { linear: function(a) { return a }, swing: function(a) { return .5 - Math.cos(a * Math.PI) / 2 }, _default: "swing" }, n.fx = Ra.prototype.init, n.fx.step = {};
    var Sa, Ta, Ua = /^(?:toggle|show|hide)$/,
        Va = /queueHooks$/;

    function Wa() { return a.setTimeout(function() { Sa = void 0 }), Sa = n.now() }

    function Xa(a, b) { var c, d = 0,
            e = { height: a }; for (b = b ? 1 : 0; 4 > d; d += 2 - b) c = U[d], e["margin" + c] = e["padding" + c] = a; return b && (e.opacity = e.width = a), e }

    function Ya(a, b, c) { for (var d, e = (_a.tweeners[b] || []).concat(_a.tweeners["*"]), f = 0, g = e.length; g > f; f++)
            if (d = e[f].call(c, b, a)) return d }

    function Za(a, b, c) { var d, e, f, g, h, i, j, k, l = this,
            m = {},
            o = a.style,
            p = a.nodeType && V(a),
            q = N.get(a, "fxshow");
        c.queue || (h = n._queueHooks(a, "fx"), null == h.unqueued && (h.unqueued = 0, i = h.empty.fire, h.empty.fire = function() { h.unqueued || i() }), h.unqueued++, l.always(function() { l.always(function() { h.unqueued--, n.queue(a, "fx").length || h.empty.fire() }) })), 1 === a.nodeType && ("height" in b || "width" in b) && (c.overflow = [o.overflow, o.overflowX, o.overflowY], j = n.css(a, "display"), k = "none" === j ? N.get(a, "olddisplay") || za(a.nodeName) : j, "inline" === k && "none" === n.css(a, "float") && (o.display = "inline-block")), c.overflow && (o.overflow = "hidden", l.always(function() { o.overflow = c.overflow[0], o.overflowX = c.overflow[1], o.overflowY = c.overflow[2] })); for (d in b)
            if (e = b[d], Ua.exec(e)) { if (delete b[d], f = f || "toggle" === e, e === (p ? "hide" : "show")) { if ("show" !== e || !q || void 0 === q[d]) continue;
                    p = !0 } m[d] = q && q[d] || n.style(a, d) } else j = void 0; if (n.isEmptyObject(m)) "inline" === ("none" === j ? za(a.nodeName) : j) && (o.display = j);
        else { q ? "hidden" in q && (p = q.hidden) : q = N.access(a, "fxshow", {}), f && (q.hidden = !p), p ? n(a).show() : l.done(function() { n(a).hide() }), l.done(function() { var b;
                N.remove(a, "fxshow"); for (b in m) n.style(a, b, m[b]) }); for (d in m) g = Ya(p ? q[d] : 0, d, l), d in q || (q[d] = g.start, p && (g.end = g.start, g.start = "width" === d || "height" === d ? 1 : 0)) } }

    function $a(a, b) { var c, d, e, f, g; for (c in a)
            if (d = n.camelCase(c), e = b[d], f = a[c], n.isArray(f) && (e = f[1], f = a[c] = f[0]), c !== d && (a[d] = f, delete a[c]), g = n.cssHooks[d], g && "expand" in g) { f = g.expand(f), delete a[d]; for (c in f) c in a || (a[c] = f[c], b[c] = e) } else b[d] = e }

    function _a(a, b, c) { var d, e, f = 0,
            g = _a.prefilters.length,
            h = n.Deferred().always(function() { delete i.elem }),
            i = function() { if (e) return !1; for (var b = Sa || Wa(), c = Math.max(0, j.startTime + j.duration - b), d = c / j.duration || 0, f = 1 - d, g = 0, i = j.tweens.length; i > g; g++) j.tweens[g].run(f); return h.notifyWith(a, [j, f, c]), 1 > f && i ? c : (h.resolveWith(a, [j]), !1) },
            j = h.promise({ elem: a, props: n.extend({}, b), opts: n.extend(!0, { specialEasing: {}, easing: n.easing._default }, c), originalProperties: b, originalOptions: c, startTime: Sa || Wa(), duration: c.duration, tweens: [], createTween: function(b, c) { var d = n.Tween(a, j.opts, b, c, j.opts.specialEasing[b] || j.opts.easing); return j.tweens.push(d), d }, stop: function(b) { var c = 0,
                        d = b ? j.tweens.length : 0; if (e) return this; for (e = !0; d > c; c++) j.tweens[c].run(1); return b ? (h.notifyWith(a, [j, 1, 0]), h.resolveWith(a, [j, b])) : h.rejectWith(a, [j, b]), this } }),
            k = j.props; for ($a(k, j.opts.specialEasing); g > f; f++)
            if (d = _a.prefilters[f].call(j, a, k, j.opts)) return n.isFunction(d.stop) && (n._queueHooks(j.elem, j.opts.queue).stop = n.proxy(d.stop, d)), d; return n.map(k, Ya, j), n.isFunction(j.opts.start) && j.opts.start.call(a, j), n.fx.timer(n.extend(i, { elem: a, anim: j, queue: j.opts.queue })), j.progress(j.opts.progress).done(j.opts.done, j.opts.complete).fail(j.opts.fail).always(j.opts.always) } n.Animation = n.extend(_a, { tweeners: { "*": [function(a, b) { var c = this.createTween(a, b); return W(c.elem, a, T.exec(b), c), c }] }, tweener: function(a, b) { n.isFunction(a) ? (b = a, a = ["*"]) : a = a.match(G); for (var c, d = 0, e = a.length; e > d; d++) c = a[d], _a.tweeners[c] = _a.tweeners[c] || [], _a.tweeners[c].unshift(b) }, prefilters: [Za], prefilter: function(a, b) { b ? _a.prefilters.unshift(a) : _a.prefilters.push(a) } }), n.speed = function(a, b, c) { var d = a && "object" == typeof a ? n.extend({}, a) : { complete: c || !c && b || n.isFunction(a) && a, duration: a, easing: c && b || b && !n.isFunction(b) && b }; return d.duration = n.fx.off ? 0 : "number" == typeof d.duration ? d.duration : d.duration in n.fx.speeds ? n.fx.speeds[d.duration] : n.fx.speeds._default, null != d.queue && d.queue !== !0 || (d.queue = "fx"), d.old = d.complete, d.complete = function() { n.isFunction(d.old) && d.old.call(this), d.queue && n.dequeue(this, d.queue) }, d }, n.fn.extend({
            fadeTo: function(a, b, c, d) { return this.filter(V).css("opacity", 0).show().end().animate({ opacity: b }, a, c, d) },
            animate: function(a, b, c, d) { var e = n.isEmptyObject(a),
                    f = n.speed(b, c, d),
                    g = function() { var b = _a(this, n.extend({}, a), f);
                        (e || N.get(this, "finish")) && b.stop(!0) }; return g.finish = g, e || f.queue === !1 ? this.each(g) : this.queue(f.queue, g) },
            stop: function(a, b, c) {
                var d = function(a) { var b = a.stop;
                    delete a.stop, b(c) };
                return "string" != typeof a && (c = b, b = a, a = void 0), b && a !== !1 && this.queue(a || "fx", []), this.each(function() {
                    var b = !0,
                        e = null != a && a + "queueHooks",
                        f = n.timers,
                        g = N.get(this);
                    if (e) g[e] && g[e].stop && d(g[e]);
                    else
                        for (e in g) g[e] && g[e].stop && Va.test(e) && d(g[e]);
                    for (e = f.length; e--;) f[e].elem !== this || null != a && f[e].queue !== a || (f[e].anim.stop(c), b = !1, f.splice(e, 1));
                    !b && c || n.dequeue(this, a)
                })
            },
            finish: function(a) { return a !== !1 && (a = a || "fx"), this.each(function() { var b, c = N.get(this),
                        d = c[a + "queue"],
                        e = c[a + "queueHooks"],
                        f = n.timers,
                        g = d ? d.length : 0; for (c.finish = !0, n.queue(this, a, []), e && e.stop && e.stop.call(this, !0), b = f.length; b--;) f[b].elem === this && f[b].queue === a && (f[b].anim.stop(!0), f.splice(b, 1)); for (b = 0; g > b; b++) d[b] && d[b].finish && d[b].finish.call(this);
                    delete c.finish }) }
        }), n.each(["toggle", "show", "hide"], function(a, b) { var c = n.fn[b];
            n.fn[b] = function(a, d, e) { return null == a || "boolean" == typeof a ? c.apply(this, arguments) : this.animate(Xa(b, !0), a, d, e) } }), n.each({ slideDown: Xa("show"), slideUp: Xa("hide"), slideToggle: Xa("toggle"), fadeIn: { opacity: "show" }, fadeOut: { opacity: "hide" }, fadeToggle: { opacity: "toggle" } }, function(a, b) { n.fn[a] = function(a, c, d) { return this.animate(b, a, c, d) } }), n.timers = [], n.fx.tick = function() { var a, b = 0,
                c = n.timers; for (Sa = n.now(); b < c.length; b++) a = c[b], a() || c[b] !== a || c.splice(b--, 1);
            c.length || n.fx.stop(), Sa = void 0 }, n.fx.timer = function(a) { n.timers.push(a), a() ? n.fx.start() : n.timers.pop() }, n.fx.interval = 13, n.fx.start = function() { Ta || (Ta = a.setInterval(n.fx.tick, n.fx.interval)) }, n.fx.stop = function() { a.clearInterval(Ta), Ta = null }, n.fx.speeds = { slow: 600, fast: 200, _default: 400 }, n.fn.delay = function(b, c) { return b = n.fx ? n.fx.speeds[b] || b : b, c = c || "fx", this.queue(c, function(c, d) { var e = a.setTimeout(c, b);
                d.stop = function() { a.clearTimeout(e) } }) },
        function() { var a = d.createElement("input"),
                b = d.createElement("select"),
                c = b.appendChild(d.createElement("option"));
            a.type = "checkbox", l.checkOn = "" !== a.value, l.optSelected = c.selected, b.disabled = !0, l.optDisabled = !c.disabled, a = d.createElement("input"), a.value = "t", a.type = "radio", l.radioValue = "t" === a.value }();
    var ab, bb = n.expr.attrHandle;
    n.fn.extend({ attr: function(a, b) { return K(this, n.attr, a, b, arguments.length > 1) }, removeAttr: function(a) { return this.each(function() { n.removeAttr(this, a) }) } }), n.extend({ attr: function(a, b, c) { var d, e, f = a.nodeType; if (3 !== f && 8 !== f && 2 !== f) return "undefined" == typeof a.getAttribute ? n.prop(a, b, c) : (1 === f && n.isXMLDoc(a) || (b = b.toLowerCase(), e = n.attrHooks[b] || (n.expr.match.bool.test(b) ? ab : void 0)), void 0 !== c ? null === c ? void n.removeAttr(a, b) : e && "set" in e && void 0 !== (d = e.set(a, c, b)) ? d : (a.setAttribute(b, c + ""), c) : e && "get" in e && null !== (d = e.get(a, b)) ? d : (d = n.find.attr(a, b), null == d ? void 0 : d)) }, attrHooks: { type: { set: function(a, b) { if (!l.radioValue && "radio" === b && n.nodeName(a, "input")) { var c = a.value; return a.setAttribute("type", b), c && (a.value = c), b } } } }, removeAttr: function(a, b) { var c, d, e = 0,
                f = b && b.match(G); if (f && 1 === a.nodeType)
                while (c = f[e++]) d = n.propFix[c] || c, n.expr.match.bool.test(c) && (a[d] = !1), a.removeAttribute(c) } }), ab = { set: function(a, b, c) { return b === !1 ? n.removeAttr(a, c) : a.setAttribute(c, c), c } }, n.each(n.expr.match.bool.source.match(/\w+/g), function(a, b) { var c = bb[b] || n.find.attr;
        bb[b] = function(a, b, d) { var e, f; return d || (f = bb[b], bb[b] = e, e = null != c(a, b, d) ? b.toLowerCase() : null, bb[b] = f), e } });
    var cb = /^(?:input|select|textarea|button)$/i,
        db = /^(?:a|area)$/i;
    n.fn.extend({ prop: function(a, b) { return K(this, n.prop, a, b, arguments.length > 1) }, removeProp: function(a) { return this.each(function() { delete this[n.propFix[a] || a] }) } }), n.extend({ prop: function(a, b, c) { var d, e, f = a.nodeType; if (3 !== f && 8 !== f && 2 !== f) return 1 === f && n.isXMLDoc(a) || (b = n.propFix[b] || b, e = n.propHooks[b]), void 0 !== c ? e && "set" in e && void 0 !== (d = e.set(a, c, b)) ? d : a[b] = c : e && "get" in e && null !== (d = e.get(a, b)) ? d : a[b] }, propHooks: { tabIndex: { get: function(a) { var b = n.find.attr(a, "tabindex"); return b ? parseInt(b, 10) : cb.test(a.nodeName) || db.test(a.nodeName) && a.href ? 0 : -1 } } }, propFix: { "for": "htmlFor", "class": "className" } }), l.optSelected || (n.propHooks.selected = { get: function(a) { var b = a.parentNode; return b && b.parentNode && b.parentNode.selectedIndex, null }, set: function(a) { var b = a.parentNode;
            b && (b.selectedIndex, b.parentNode && b.parentNode.selectedIndex) } }), n.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function() { n.propFix[this.toLowerCase()] = this });
    var eb = /[\t\r\n\f]/g;

    function fb(a) { return a.getAttribute && a.getAttribute("class") || "" } n.fn.extend({ addClass: function(a) { var b, c, d, e, f, g, h, i = 0; if (n.isFunction(a)) return this.each(function(b) { n(this).addClass(a.call(this, b, fb(this))) }); if ("string" == typeof a && a) { b = a.match(G) || []; while (c = this[i++])
                    if (e = fb(c), d = 1 === c.nodeType && (" " + e + " ").replace(eb, " ")) { g = 0; while (f = b[g++]) d.indexOf(" " + f + " ") < 0 && (d += f + " ");
                        h = n.trim(d), e !== h && c.setAttribute("class", h) } } return this }, removeClass: function(a) { var b, c, d, e, f, g, h, i = 0; if (n.isFunction(a)) return this.each(function(b) { n(this).removeClass(a.call(this, b, fb(this))) }); if (!arguments.length) return this.attr("class", ""); if ("string" == typeof a && a) { b = a.match(G) || []; while (c = this[i++])
                    if (e = fb(c), d = 1 === c.nodeType && (" " + e + " ").replace(eb, " ")) { g = 0; while (f = b[g++])
                            while (d.indexOf(" " + f + " ") > -1) d = d.replace(" " + f + " ", " ");
                        h = n.trim(d), e !== h && c.setAttribute("class", h) } } return this }, toggleClass: function(a, b) { var c = typeof a; return "boolean" == typeof b && "string" === c ? b ? this.addClass(a) : this.removeClass(a) : n.isFunction(a) ? this.each(function(c) { n(this).toggleClass(a.call(this, c, fb(this), b), b) }) : this.each(function() { var b, d, e, f; if ("string" === c) { d = 0, e = n(this), f = a.match(G) || []; while (b = f[d++]) e.hasClass(b) ? e.removeClass(b) : e.addClass(b) } else void 0 !== a && "boolean" !== c || (b = fb(this), b && N.set(this, "__className__", b), this.setAttribute && this.setAttribute("class", b || a === !1 ? "" : N.get(this, "__className__") || "")) }) }, hasClass: function(a) { var b, c, d = 0;
            b = " " + a + " "; while (c = this[d++])
                if (1 === c.nodeType && (" " + fb(c) + " ").replace(eb, " ").indexOf(b) > -1) return !0; return !1 } });
    var gb = /\r/g,
        hb = /[\x20\t\r\n\f]+/g;
    n.fn.extend({ val: function(a) { var b, c, d, e = this[0]; { if (arguments.length) return d = n.isFunction(a), this.each(function(c) { var e;
                    1 === this.nodeType && (e = d ? a.call(this, c, n(this).val()) : a, null == e ? e = "" : "number" == typeof e ? e += "" : n.isArray(e) && (e = n.map(e, function(a) { return null == a ? "" : a + "" })), b = n.valHooks[this.type] || n.valHooks[this.nodeName.toLowerCase()], b && "set" in b && void 0 !== b.set(this, e, "value") || (this.value = e)) }); if (e) return b = n.valHooks[e.type] || n.valHooks[e.nodeName.toLowerCase()], b && "get" in b && void 0 !== (c = b.get(e, "value")) ? c : (c = e.value, "string" == typeof c ? c.replace(gb, "") : null == c ? "" : c) } } }), n.extend({ valHooks: { option: { get: function(a) { var b = n.find.attr(a, "value"); return null != b ? b : n.trim(n.text(a)).replace(hb, " ") } }, select: { get: function(a) { for (var b, c, d = a.options, e = a.selectedIndex, f = "select-one" === a.type || 0 > e, g = f ? null : [], h = f ? e + 1 : d.length, i = 0 > e ? h : f ? e : 0; h > i; i++)
                        if (c = d[i], (c.selected || i === e) && (l.optDisabled ? !c.disabled : null === c.getAttribute("disabled")) && (!c.parentNode.disabled || !n.nodeName(c.parentNode, "optgroup"))) { if (b = n(c).val(), f) return b;
                            g.push(b) }
                    return g }, set: function(a, b) { var c, d, e = a.options,
                        f = n.makeArray(b),
                        g = e.length; while (g--) d = e[g], (d.selected = n.inArray(n.valHooks.option.get(d), f) > -1) && (c = !0); return c || (a.selectedIndex = -1), f } } } }), n.each(["radio", "checkbox"], function() { n.valHooks[this] = { set: function(a, b) { return n.isArray(b) ? a.checked = n.inArray(n(a).val(), b) > -1 : void 0 } }, l.checkOn || (n.valHooks[this].get = function(a) { return null === a.getAttribute("value") ? "on" : a.value }) });
    var ib = /^(?:focusinfocus|focusoutblur)$/;
    n.extend(n.event, { trigger: function(b, c, e, f) { var g, h, i, j, l, m, o, p = [e || d],
                q = k.call(b, "type") ? b.type : b,
                r = k.call(b, "namespace") ? b.namespace.split(".") : []; if (h = i = e = e || d, 3 !== e.nodeType && 8 !== e.nodeType && !ib.test(q + n.event.triggered) && (q.indexOf(".") > -1 && (r = q.split("."), q = r.shift(), r.sort()), l = q.indexOf(":") < 0 && "on" + q, b = b[n.expando] ? b : new n.Event(q, "object" == typeof b && b), b.isTrigger = f ? 2 : 3, b.namespace = r.join("."), b.rnamespace = b.namespace ? new RegExp("(^|\\.)" + r.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, b.result = void 0, b.target || (b.target = e), c = null == c ? [b] : n.makeArray(c, [b]), o = n.event.special[q] || {}, f || !o.trigger || o.trigger.apply(e, c) !== !1)) { if (!f && !o.noBubble && !n.isWindow(e)) { for (j = o.delegateType || q, ib.test(j + q) || (h = h.parentNode); h; h = h.parentNode) p.push(h), i = h;
                    i === (e.ownerDocument || d) && p.push(i.defaultView || i.parentWindow || a) } g = 0; while ((h = p[g++]) && !b.isPropagationStopped()) b.type = g > 1 ? j : o.bindType || q, m = (N.get(h, "events") || {})[b.type] && N.get(h, "handle"), m && m.apply(h, c), m = l && h[l], m && m.apply && L(h) && (b.result = m.apply(h, c), b.result === !1 && b.preventDefault()); return b.type = q, f || b.isDefaultPrevented() || o._default && o._default.apply(p.pop(), c) !== !1 || !L(e) || l && n.isFunction(e[q]) && !n.isWindow(e) && (i = e[l], i && (e[l] = null), n.event.triggered = q, e[q](), n.event.triggered = void 0, i && (e[l] = i)), b.result } }, simulate: function(a, b, c) { var d = n.extend(new n.Event, c, { type: a, isSimulated: !0 });
            n.event.trigger(d, null, b) } }), n.fn.extend({ trigger: function(a, b) { return this.each(function() { n.event.trigger(a, b, this) }) }, triggerHandler: function(a, b) { var c = this[0]; return c ? n.event.trigger(a, b, c, !0) : void 0 } }), n.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function(a, b) { n.fn[b] = function(a, c) { return arguments.length > 0 ? this.on(b, null, a, c) : this.trigger(b) } }), n.fn.extend({ hover: function(a, b) { return this.mouseenter(a).mouseleave(b || a) } }), l.focusin = "onfocusin" in a, l.focusin || n.each({ focus: "focusin", blur: "focusout" }, function(a, b) { var c = function(a) { n.event.simulate(b, a.target, n.event.fix(a)) };
        n.event.special[b] = { setup: function() { var d = this.ownerDocument || this,
                    e = N.access(d, b);
                e || d.addEventListener(a, c, !0), N.access(d, b, (e || 0) + 1) }, teardown: function() { var d = this.ownerDocument || this,
                    e = N.access(d, b) - 1;
                e ? N.access(d, b, e) : (d.removeEventListener(a, c, !0), N.remove(d, b)) } } });
    var jb = a.location,
        kb = n.now(),
        lb = /\?/;
    n.parseJSON = function(a) { return JSON.parse(a + "") }, n.parseXML = function(b) { var c; if (!b || "string" != typeof b) return null; try { c = (new a.DOMParser).parseFromString(b, "text/xml") } catch (d) { c = void 0 } return c && !c.getElementsByTagName("parsererror").length || n.error("Invalid XML: " + b), c };
    var mb = /#.*$/,
        nb = /([?&])_=[^&]*/,
        ob = /^(.*?):[ \t]*([^\r\n]*)$/gm,
        pb = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
        qb = /^(?:GET|HEAD)$/,
        rb = /^\/\//,
        sb = {},
        tb = {},
        ub = "*/".concat("*"),
        vb = d.createElement("a");
    vb.href = jb.href;

    function wb(a) { return function(b, c) { "string" != typeof b && (c = b, b = "*"); var d, e = 0,
                f = b.toLowerCase().match(G) || []; if (n.isFunction(c))
                while (d = f[e++]) "+" === d[0] ? (d = d.slice(1) || "*", (a[d] = a[d] || []).unshift(c)) : (a[d] = a[d] || []).push(c) } }

    function xb(a, b, c, d) { var e = {},
            f = a === tb;

        function g(h) { var i; return e[h] = !0, n.each(a[h] || [], function(a, h) { var j = h(b, c, d); return "string" != typeof j || f || e[j] ? f ? !(i = j) : void 0 : (b.dataTypes.unshift(j), g(j), !1) }), i } return g(b.dataTypes[0]) || !e["*"] && g("*") }

    function yb(a, b) { var c, d, e = n.ajaxSettings.flatOptions || {}; for (c in b) void 0 !== b[c] && ((e[c] ? a : d || (d = {}))[c] = b[c]); return d && n.extend(!0, a, d), a }

    function zb(a, b, c) { var d, e, f, g, h = a.contents,
            i = a.dataTypes; while ("*" === i[0]) i.shift(), void 0 === d && (d = a.mimeType || b.getResponseHeader("Content-Type")); if (d)
            for (e in h)
                if (h[e] && h[e].test(d)) { i.unshift(e); break }
        if (i[0] in c) f = i[0];
        else { for (e in c) { if (!i[0] || a.converters[e + " " + i[0]]) { f = e; break } g || (g = e) } f = f || g } return f ? (f !== i[0] && i.unshift(f), c[f]) : void 0 }

    function Ab(a, b, c, d) { var e, f, g, h, i, j = {},
            k = a.dataTypes.slice(); if (k[1])
            for (g in a.converters) j[g.toLowerCase()] = a.converters[g];
        f = k.shift(); while (f)
            if (a.responseFields[f] && (c[a.responseFields[f]] = b), !i && d && a.dataFilter && (b = a.dataFilter(b, a.dataType)), i = f, f = k.shift())
                if ("*" === f) f = i;
                else if ("*" !== i && i !== f) { if (g = j[i + " " + f] || j["* " + f], !g)
                for (e in j)
                    if (h = e.split(" "), h[1] === f && (g = j[i + " " + h[0]] || j["* " + h[0]])) { g === !0 ? g = j[e] : j[e] !== !0 && (f = h[0], k.unshift(h[1])); break }
            if (g !== !0)
                if (g && a["throws"]) b = g(b);
                else try { b = g(b) } catch (l) { return { state: "parsererror", error: g ? l : "No conversion from " + i + " to " + f } } } return { state: "success", data: b } } n.extend({ active: 0, lastModified: {}, etag: {}, ajaxSettings: { url: jb.href, type: "GET", isLocal: pb.test(jb.protocol), global: !0, processData: !0, async: !0, contentType: "application/x-www-form-urlencoded; charset=UTF-8", accepts: { "*": ub, text: "text/plain", html: "text/html", xml: "application/xml, text/xml", json: "application/json, text/javascript" }, contents: { xml: /\bxml\b/, html: /\bhtml/, json: /\bjson\b/ }, responseFields: { xml: "responseXML", text: "responseText", json: "responseJSON" }, converters: { "* text": String, "text html": !0, "text json": n.parseJSON, "text xml": n.parseXML }, flatOptions: { url: !0, context: !0 } }, ajaxSetup: function(a, b) { return b ? yb(yb(a, n.ajaxSettings), b) : yb(n.ajaxSettings, a) }, ajaxPrefilter: wb(sb), ajaxTransport: wb(tb), ajax: function(b, c) { "object" == typeof b && (c = b, b = void 0), c = c || {}; var e, f, g, h, i, j, k, l, m = n.ajaxSetup({}, c),
                o = m.context || m,
                p = m.context && (o.nodeType || o.jquery) ? n(o) : n.event,
                q = n.Deferred(),
                r = n.Callbacks("once memory"),
                s = m.statusCode || {},
                t = {},
                u = {},
                v = 0,
                w = "canceled",
                x = { readyState: 0, getResponseHeader: function(a) { var b; if (2 === v) { if (!h) { h = {}; while (b = ob.exec(g)) h[b[1].toLowerCase()] = b[2] } b = h[a.toLowerCase()] } return null == b ? null : b }, getAllResponseHeaders: function() { return 2 === v ? g : null }, setRequestHeader: function(a, b) { var c = a.toLowerCase(); return v || (a = u[c] = u[c] || a, t[a] = b), this }, overrideMimeType: function(a) { return v || (m.mimeType = a), this }, statusCode: function(a) { var b; if (a)
                            if (2 > v)
                                for (b in a) s[b] = [s[b], a[b]];
                            else x.always(a[x.status]); return this }, abort: function(a) { var b = a || w; return e && e.abort(b), z(0, b), this } }; if (q.promise(x).complete = r.add, x.success = x.done, x.error = x.fail, m.url = ((b || m.url || jb.href) + "").replace(mb, "").replace(rb, jb.protocol + "//"), m.type = c.method || c.type || m.method || m.type, m.dataTypes = n.trim(m.dataType || "*").toLowerCase().match(G) || [""], null == m.crossDomain) { j = d.createElement("a"); try { j.href = m.url, j.href = j.href, m.crossDomain = vb.protocol + "//" + vb.host != j.protocol + "//" + j.host } catch (y) { m.crossDomain = !0 } } if (m.data && m.processData && "string" != typeof m.data && (m.data = n.param(m.data, m.traditional)), xb(sb, m, c, x), 2 === v) return x;
            k = n.event && m.global, k && 0 === n.active++ && n.event.trigger("ajaxStart"), m.type = m.type.toUpperCase(), m.hasContent = !qb.test(m.type), f = m.url, m.hasContent || (m.data && (f = m.url += (lb.test(f) ? "&" : "?") + m.data, delete m.data), m.cache === !1 && (m.url = nb.test(f) ? f.replace(nb, "$1_=" + kb++) : f + (lb.test(f) ? "&" : "?") + "_=" + kb++)), m.ifModified && (n.lastModified[f] && x.setRequestHeader("If-Modified-Since", n.lastModified[f]), n.etag[f] && x.setRequestHeader("If-None-Match", n.etag[f])), (m.data && m.hasContent && m.contentType !== !1 || c.contentType) && x.setRequestHeader("Content-Type", m.contentType), x.setRequestHeader("Accept", m.dataTypes[0] && m.accepts[m.dataTypes[0]] ? m.accepts[m.dataTypes[0]] + ("*" !== m.dataTypes[0] ? ", " + ub + "; q=0.01" : "") : m.accepts["*"]); for (l in m.headers) x.setRequestHeader(l, m.headers[l]); if (m.beforeSend && (m.beforeSend.call(o, x, m) === !1 || 2 === v)) return x.abort();
            w = "abort"; for (l in { success: 1, error: 1, complete: 1 }) x[l](m[l]); if (e = xb(tb, m, c, x)) { if (x.readyState = 1, k && p.trigger("ajaxSend", [x, m]), 2 === v) return x;
                m.async && m.timeout > 0 && (i = a.setTimeout(function() { x.abort("timeout") }, m.timeout)); try { v = 1, e.send(t, z) } catch (y) { if (!(2 > v)) throw y;
                    z(-1, y) } } else z(-1, "No Transport");

            function z(b, c, d, h) { var j, l, t, u, w, y = c;
                2 !== v && (v = 2, i && a.clearTimeout(i), e = void 0, g = h || "", x.readyState = b > 0 ? 4 : 0, j = b >= 200 && 300 > b || 304 === b, d && (u = zb(m, x, d)), u = Ab(m, u, x, j), j ? (m.ifModified && (w = x.getResponseHeader("Last-Modified"), w && (n.lastModified[f] = w), w = x.getResponseHeader("etag"), w && (n.etag[f] = w)), 204 === b || "HEAD" === m.type ? y = "nocontent" : 304 === b ? y = "notmodified" : (y = u.state, l = u.data, t = u.error, j = !t)) : (t = y, !b && y || (y = "error", 0 > b && (b = 0))), x.status = b, x.statusText = (c || y) + "", j ? q.resolveWith(o, [l, y, x]) : q.rejectWith(o, [x, y, t]), x.statusCode(s), s = void 0, k && p.trigger(j ? "ajaxSuccess" : "ajaxError", [x, m, j ? l : t]), r.fireWith(o, [x, y]), k && (p.trigger("ajaxComplete", [x, m]), --n.active || n.event.trigger("ajaxStop"))) } return x }, getJSON: function(a, b, c) { return n.get(a, b, c, "json") }, getScript: function(a, b) { return n.get(a, void 0, b, "script") } }), n.each(["get", "post"], function(a, b) { n[b] = function(a, c, d, e) { return n.isFunction(c) && (e = e || d, d = c, c = void 0), n.ajax(n.extend({ url: a, type: b, dataType: e, data: c, success: d }, n.isPlainObject(a) && a)) } }), n._evalUrl = function(a) { return n.ajax({ url: a, type: "GET", dataType: "script", async: !1, global: !1, "throws": !0 }) }, n.fn.extend({ wrapAll: function(a) { var b; return n.isFunction(a) ? this.each(function(b) { n(this).wrapAll(a.call(this, b)) }) : (this[0] && (b = n(a, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && b.insertBefore(this[0]), b.map(function() { var a = this; while (a.firstElementChild) a = a.firstElementChild; return a }).append(this)), this) }, wrapInner: function(a) { return n.isFunction(a) ? this.each(function(b) { n(this).wrapInner(a.call(this, b)) }) : this.each(function() { var b = n(this),
                    c = b.contents();
                c.length ? c.wrapAll(a) : b.append(a) }) }, wrap: function(a) { var b = n.isFunction(a); return this.each(function(c) { n(this).wrapAll(b ? a.call(this, c) : a) }) }, unwrap: function() { return this.parent().each(function() { n.nodeName(this, "body") || n(this).replaceWith(this.childNodes) }).end() } }), n.expr.filters.hidden = function(a) { return !n.expr.filters.visible(a) }, n.expr.filters.visible = function(a) { return a.offsetWidth > 0 || a.offsetHeight > 0 || a.getClientRects().length > 0 };
    var Bb = /%20/g,
        Cb = /\[\]$/,
        Db = /\r?\n/g,
        Eb = /^(?:submit|button|image|reset|file)$/i,
        Fb = /^(?:input|select|textarea|keygen)/i;

    function Gb(a, b, c, d) {
        var e;
        if (n.isArray(b)) n.each(b, function(b, e) { c || Cb.test(a) ? d(a, e) : Gb(a + "[" + ("object" == typeof e && null != e ? b : "") + "]", e, c, d) });
        else if (c || "object" !== n.type(b)) d(a, b);
        else
            for (e in b) Gb(a + "[" + e + "]", b[e], c, d)
    }
    n.param = function(a, b) {
        var c, d = [],
            e = function(a, b) { b = n.isFunction(b) ? b() : null == b ? "" : b, d[d.length] = encodeURIComponent(a) + "=" + encodeURIComponent(b) };
        if (void 0 === b && (b = n.ajaxSettings && n.ajaxSettings.traditional), n.isArray(a) || a.jquery && !n.isPlainObject(a)) n.each(a, function() { e(this.name, this.value) });
        else
            for (c in a) Gb(c, a[c], b, e);
        return d.join("&").replace(Bb, "+")
    }, n.fn.extend({ serialize: function() { return n.param(this.serializeArray()) }, serializeArray: function() { return this.map(function() { var a = n.prop(this, "elements"); return a ? n.makeArray(a) : this }).filter(function() { var a = this.type; return this.name && !n(this).is(":disabled") && Fb.test(this.nodeName) && !Eb.test(a) && (this.checked || !X.test(a)) }).map(function(a, b) { var c = n(this).val(); return null == c ? null : n.isArray(c) ? n.map(c, function(a) { return { name: b.name, value: a.replace(Db, "\r\n") } }) : { name: b.name, value: c.replace(Db, "\r\n") } }).get() } }), n.ajaxSettings.xhr = function() { try { return new a.XMLHttpRequest } catch (b) {} };
    var Hb = { 0: 200, 1223: 204 },
        Ib = n.ajaxSettings.xhr();
    l.cors = !!Ib && "withCredentials" in Ib, l.ajax = Ib = !!Ib, n.ajaxTransport(function(b) { var c, d; return l.cors || Ib && !b.crossDomain ? { send: function(e, f) { var g, h = b.xhr(); if (h.open(b.type, b.url, b.async, b.username, b.password), b.xhrFields)
                    for (g in b.xhrFields) h[g] = b.xhrFields[g];
                b.mimeType && h.overrideMimeType && h.overrideMimeType(b.mimeType), b.crossDomain || e["X-Requested-With"] || (e["X-Requested-With"] = "XMLHttpRequest"); for (g in e) h.setRequestHeader(g, e[g]);
                c = function(a) { return function() { c && (c = d = h.onload = h.onerror = h.onabort = h.onreadystatechange = null, "abort" === a ? h.abort() : "error" === a ? "number" != typeof h.status ? f(0, "error") : f(h.status, h.statusText) : f(Hb[h.status] || h.status, h.statusText, "text" !== (h.responseType || "text") || "string" != typeof h.responseText ? { binary: h.response } : { text: h.responseText }, h.getAllResponseHeaders())) } }, h.onload = c(), d = h.onerror = c("error"), void 0 !== h.onabort ? h.onabort = d : h.onreadystatechange = function() { 4 === h.readyState && a.setTimeout(function() { c && d() }) }, c = c("abort"); try { h.send(b.hasContent && b.data || null) } catch (i) { if (c) throw i } }, abort: function() { c && c() } } : void 0 }), n.ajaxSetup({ accepts: { script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript" }, contents: { script: /\b(?:java|ecma)script\b/ }, converters: { "text script": function(a) { return n.globalEval(a), a } } }), n.ajaxPrefilter("script", function(a) { void 0 === a.cache && (a.cache = !1), a.crossDomain && (a.type = "GET") }), n.ajaxTransport("script", function(a) { if (a.crossDomain) { var b, c; return { send: function(e, f) { b = n("<script>").prop({ charset: a.scriptCharset, src: a.url }).on("load error", c = function(a) { b.remove(), c = null, a && f("error" === a.type ? 404 : 200, a.type) }), d.head.appendChild(b[0]) }, abort: function() { c && c() } } } });
    var Jb = [],
        Kb = /(=)\?(?=&|$)|\?\?/;
    n.ajaxSetup({ jsonp: "callback", jsonpCallback: function() { var a = Jb.pop() || n.expando + "_" + kb++; return this[a] = !0, a } }), n.ajaxPrefilter("json jsonp", function(b, c, d) { var e, f, g, h = b.jsonp !== !1 && (Kb.test(b.url) ? "url" : "string" == typeof b.data && 0 === (b.contentType || "").indexOf("application/x-www-form-urlencoded") && Kb.test(b.data) && "data"); return h || "jsonp" === b.dataTypes[0] ? (e = b.jsonpCallback = n.isFunction(b.jsonpCallback) ? b.jsonpCallback() : b.jsonpCallback, h ? b[h] = b[h].replace(Kb, "$1" + e) : b.jsonp !== !1 && (b.url += (lb.test(b.url) ? "&" : "?") + b.jsonp + "=" + e), b.converters["script json"] = function() { return g || n.error(e + " was not called"), g[0] }, b.dataTypes[0] = "json", f = a[e], a[e] = function() { g = arguments }, d.always(function() { void 0 === f ? n(a).removeProp(e) : a[e] = f, b[e] && (b.jsonpCallback = c.jsonpCallback, Jb.push(e)), g && n.isFunction(f) && f(g[0]), g = f = void 0 }), "script") : void 0 }), n.parseHTML = function(a, b, c) { if (!a || "string" != typeof a) return null; "boolean" == typeof b && (c = b, b = !1), b = b || d; var e = x.exec(a),
            f = !c && []; return e ? [b.createElement(e[1])] : (e = ca([a], b, f), f && f.length && n(f).remove(), n.merge([], e.childNodes)) };
    var Lb = n.fn.load;
    n.fn.load = function(a, b, c) { if ("string" != typeof a && Lb) return Lb.apply(this, arguments); var d, e, f, g = this,
            h = a.indexOf(" "); return h > -1 && (d = n.trim(a.slice(h)), a = a.slice(0, h)), n.isFunction(b) ? (c = b, b = void 0) : b && "object" == typeof b && (e = "POST"), g.length > 0 && n.ajax({ url: a, type: e || "GET", dataType: "html", data: b }).done(function(a) { f = arguments, g.html(d ? n("<div>").append(n.parseHTML(a)).find(d) : a) }).always(c && function(a, b) { g.each(function() { c.apply(this, f || [a.responseText, b, a]) }) }), this }, n.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function(a, b) { n.fn[b] = function(a) { return this.on(b, a) } }), n.expr.filters.animated = function(a) { return n.grep(n.timers, function(b) { return a === b.elem }).length };

    function Mb(a) { return n.isWindow(a) ? a : 9 === a.nodeType && a.defaultView } n.offset = { setOffset: function(a, b, c) { var d, e, f, g, h, i, j, k = n.css(a, "position"),
                l = n(a),
                m = {}; "static" === k && (a.style.position = "relative"), h = l.offset(), f = n.css(a, "top"), i = n.css(a, "left"), j = ("absolute" === k || "fixed" === k) && (f + i).indexOf("auto") > -1, j ? (d = l.position(), g = d.top, e = d.left) : (g = parseFloat(f) || 0, e = parseFloat(i) || 0), n.isFunction(b) && (b = b.call(a, c, n.extend({}, h))), null != b.top && (m.top = b.top - h.top + g), null != b.left && (m.left = b.left - h.left + e), "using" in b ? b.using.call(a, m) : l.css(m) } }, n.fn.extend({ offset: function(a) { if (arguments.length) return void 0 === a ? this : this.each(function(b) { n.offset.setOffset(this, a, b) }); var b, c, d = this[0],
                e = { top: 0, left: 0 },
                f = d && d.ownerDocument; if (f) return b = f.documentElement, n.contains(b, d) ? (e = d.getBoundingClientRect(), c = Mb(f), { top: e.top + c.pageYOffset - b.clientTop, left: e.left + c.pageXOffset - b.clientLeft }) : e }, position: function() { if (this[0]) { var a, b, c = this[0],
                    d = { top: 0, left: 0 }; return "fixed" === n.css(c, "position") ? b = c.getBoundingClientRect() : (a = this.offsetParent(), b = this.offset(), n.nodeName(a[0], "html") || (d = a.offset()), d.top += n.css(a[0], "borderTopWidth", !0), d.left += n.css(a[0], "borderLeftWidth", !0)), { top: b.top - d.top - n.css(c, "marginTop", !0), left: b.left - d.left - n.css(c, "marginLeft", !0) } } }, offsetParent: function() { return this.map(function() { var a = this.offsetParent; while (a && "static" === n.css(a, "position")) a = a.offsetParent; return a || Ea }) } }), n.each({ scrollLeft: "pageXOffset", scrollTop: "pageYOffset" }, function(a, b) { var c = "pageYOffset" === b;
        n.fn[a] = function(d) { return K(this, function(a, d, e) { var f = Mb(a); return void 0 === e ? f ? f[b] : a[d] : void(f ? f.scrollTo(c ? f.pageXOffset : e, c ? e : f.pageYOffset) : a[d] = e) }, a, d, arguments.length) } }), n.each(["top", "left"], function(a, b) { n.cssHooks[b] = Ga(l.pixelPosition, function(a, c) { return c ? (c = Fa(a, b), Ba.test(c) ? n(a).position()[b] + "px" : c) : void 0 }) }), n.each({ Height: "height", Width: "width" }, function(a, b) { n.each({ padding: "inner" + a, content: b, "": "outer" + a }, function(c, d) { n.fn[d] = function(d, e) { var f = arguments.length && (c || "boolean" != typeof d),
                    g = c || (d === !0 || e === !0 ? "margin" : "border"); return K(this, function(b, c, d) { var e; return n.isWindow(b) ? b.document.documentElement["client" + a] : 9 === b.nodeType ? (e = b.documentElement, Math.max(b.body["scroll" + a], e["scroll" + a], b.body["offset" + a], e["offset" + a], e["client" + a])) : void 0 === d ? n.css(b, c, g) : n.style(b, c, d, g) }, b, f ? d : void 0, f, null) } }) }), n.fn.extend({ bind: function(a, b, c) { return this.on(a, null, b, c) }, unbind: function(a, b) { return this.off(a, null, b) }, delegate: function(a, b, c, d) { return this.on(b, a, c, d) }, undelegate: function(a, b, c) { return 1 === arguments.length ? this.off(a, "**") : this.off(b, a || "**", c) }, size: function() { return this.length } }), n.fn.andSelf = n.fn.addBack, "function" == typeof define && define.amd && define("jquery", [], function() { return n });
    var Nb = a.jQuery,
        Ob = a.$;
    return n.noConflict = function(b) { return a.$ === n && (a.$ = Ob), b && a.jQuery === n && (a.jQuery = Nb), n }, b || (a.jQuery = a.$ = n), n
});
$(document).ready(function() { $("nav .logo, nav ul").on("click", "a", function(event) { event.preventDefault(); var id = $(this).attr('href'),
            top = $(id).offset().top; var windowWidth = parseInt(window.innerWidth); if (windowWidth > 740) { top = top - 40; if (id == "#save") { top += 40 } } $('body,html').animate({ scrollTop: top }, 1500) }) });
$(document).ready(function() {
    var windowWidth = parseInt(window.innerWidth);
    var scrollTop = $(window).scrollTop();
    var logo = $('nav div.logo');
    var tel = $('nav div.tel');
    var menu_btn = $('nav div.menu_btn');
    if (windowWidth < 741) { tel.insertBefore(logo);
        menu_btn.insertAfter(tel) }
    if (windowWidth > 1130) { $("#contacts div.form").attr("data-wow-delay", "0.7s");
        $("#contacts div.map").attr("data-wow-delay", "1.4s") } else if (windowWidth > 643) { $("#contacts div.form").attr("data-wow-delay", "0.5s") }
    if (windowWidth > 784) { $(".certificates .photos .item:nth-of-type(2)").attr("data-wow-delay", "0.7s");
        $(".certificates .photos .item:nth-of-type(1)").attr("data-wow-delay", "1.4s") }
    if ($('.header .action').length == 0) { if (windowWidth > 460) { $(".header .content").addClass('without');
            $(".header .container").css('height', '100%') } $(window).resize(function() { windowWidth = parseInt(window.innerWidth); if (windowWidth < 461) { $(".header .content").removeClass('without') } else { $(".header .content").addClass('without');
                $(".header .container").css('height', '100%') } }) };
    var menu_fixed = !1;
    var header_height = parseInt($('.header').css('height'));
    if (scrollTop > header_height) {
        $("nav").css({ "position": "fixed", "top": "-100px" });
        $("nav").animate({ "top": "-1px" }, 300);
        $("nav a, nav p").css({ "color": "#262a2e" });
        $("nav a.logo img").attr('src', 'img/logo2.png')
        $("nav").css({ "background": "white", "box-shadow": "0 3px 10px rgba(0,0,0,0.1)", });
        if (windowWidth < 741) { $("nav").css({ "padding": "10px 0", }) };
        menu_fixed = !0
    }
    $(window).scroll(function() {
        scrollTop = $(window).scrollTop();
        header_height = parseInt($('.header').css('height'));
        if (scrollTop + 50 > header_height) {
            if (menu_fixed == !1) {
                $("nav").css({ "position": "fixed", "top": "-100px" });
                $("nav").animate({ "top": "-1px" }, 300);
                $("nav a, nav p").css({ "color": "#262a2e" });
                $("nav a.logo img").attr('src', 'img/logo2.png')
                $("nav").css({ "background": "white", "box-shadow": "0 3px 10px rgba(0,0,0,0.1)", });
                if (windowWidth < 741) { $("nav").css({ "padding": "10px 0", }) } menu_fixed = !0
            }
            if (windowWidth < 1076) { $("nav ul").slideUp();
                $("nav .menu_btn").removeClass("on");
                menu_btn_active = !1 }
            if (windowWidth < 741) { $("nav .logo").slideUp() } $('.header .container .content').css({ "margin-top": "" })
        } else { if (menu_fixed == !0) { $("nav").animate({ "top": "-100px" }, 100, function() { $("nav").css({ "display": "none", "position": "", "top": "", "background": "", "padding": "", "box-shadow": "", });
                    $("nav a.logo img").attr('src', 'img/logo.png');
                    $("nav").find("a, p").css({ "color": "" });
                    $("nav").fadeIn(50);
                    menu_fixed = !1 }) } }
    });
    $(window).resize(function() { windowWidth = parseInt(window.innerWidth); if (windowWidth > 1055) { $("nav ul").css('display', '');
            $("nav .menu_btn").removeClass("on");
            menu_btn_active = !1 }; if (windowWidth > 740) { $('.header .container .content').css({ "margin-top": "" });
            $("nav").css({ "padding": "", });
            logo.insertBefore(tel);
            logo.css('display', '').find('a').css('display', '');
            logo.css('margin-top', '') } else { if (scrollTop + 50 > header_height) { $("nav").css({ "padding": "10px 0", }) } tel.insertBefore(logo);
            menu_btn.insertAfter(tel) } });
    var menu_btn_active = !1;
    $("nav .menu_btn").click(function() { $(this).toggleClass("on"); var windowWidth = parseInt(window.innerWidth); if (menu_btn_active == !1) { $("nav ul").slideDown(); if (windowWidth < 741) { $("nav .logo").css('display', '').stop(!0);
                $("nav .logo").slideDown() } if (scrollTop < 6 && windowWidth < 741) { $('.header .container .content').animate({ "margin-top": "80px" }, 500) } menu_btn_active = !0 } else { $("nav ul").slideUp(); if (windowWidth < 741) { $("nav .logo").slideUp() } if (scrollTop < 6 && windowWidth < 741) { $('.header .container .content').animate({ "margin-top": "" }, 500) } menu_btn_active = !1 } });
    $('.promo .close').click(function() { $('.promo').animate({ "left": "-205px" }, 500, function() { $(this).hide() }) })
    if (get_cookie("ident_user") != null) {} else { show_promo() } $(".header nav div.tel").mouseenter(function() { $(this).find("img").stop(!0); for (var i = 0; i < 7; i++) { $(this).find("img").animate({ left: "0px", rotate: "15deg" }, 100).animate({ left: "6px", rotate: "-10deg" }, 100).animate({ left: "3px", rotate: "0deg" }, 100) } })
});

function show_promo() { var save_top = $("#save").offset().top; var scrollTop = $(window).scrollTop(); var show_promo = !1; var number = random(); var date = new Date(); var year = date.getFullYear(); var month_now = date.getMonth(); var day_now = date.getDate(); var days_month_count = new Date(year, month_now + 1, 0).getDate(); var new_date = new Date(year, month_now, days_month_count, "20", "59", "59");
    month_now += 1; if (month_now <= 9) { month_now = "0" + month_now } $(".promo span.date").text(days_month_count + "." + month_now + "." + year);
    $(window).scroll(function() { scrollTop = $(window).scrollTop(); if (scrollTop > save_top - 100 && show_promo == !1) { $('#promo_key').text(number);
            $('.promo').show(1, function() { $(this).animate({ "left": "0px" }, { queue: !1 }) });
            document.cookie = "ident_user=true; path=/; expires=" + new_date;
            document.cookie = "promo_kod=" + number + "; path=/; expires=" + new_date;
            show_promo = !0 } }) }

function get_cookie(cookie_name) { var results = document.cookie.match('(^|;) ?' + cookie_name + '=([^;]*)(;|$)'); if (results) return (unescape(results[2]));
    else return null }

function random() { var date = new Date(); var month_now = date.getMonth() + 1; var arr = []; if (month_now >= 10) { arr.push(month_now) } else { arr.push("0" + month_now) } for (var i = 0; i < 3; i++) { arr.push(Math.floor(Math.random() * (9 - 0 + 1)) + 0) } return arr.join('') } $(window).load(function() { ymaps.ready(init);

    function init() { var myMap = new ymaps.Map("map", { center: [55.74, 37.385], zoom: 10, controls: [] });
        myMap.behaviors.disable('scrollZoom');
        myMap.behaviors.disable('multiTouch'); if ($(window).width() < 768) { myMap.behaviors.disable('drag'); } myMap.controls.add(new ymaps.control.ZoomControl()); var route1, route2, route3, route4; var myPlacemark1, myPlacemark2, myPlacemark3, myPlacemark4; var ButtonLayoutMoskow = ymaps.templateLayoutFactory.createClass(['<div title="{{ data.title }}" class="button-from-Moscow button-from-Yellow ', '{% if state.size == "small" %}my-button_small{% endif %}', '{% if state.size == "medium" %}my-button_medium{% endif %}', '{% if state.size == "large" %}my-button_large{% endif %}', '{% if state.selected %} my-button-selected{% endif %}">', '<span class="my-button__text">{{ data.content }}</span>', '</div>'].join('')); var buttonFromMoskow = new ymaps.control.Button({ data: { content: "ИЗ МОСКВЫ", title: "ИЗ МОСКВЫ" }, options: { layout: ButtonLayoutMoskow } });
        buttonFromMoskow.events.add('click', function(e) { destroyMap();
            renderMoskow();
            setTimeout(function() { $('.button-from-Odintsovo').removeClass('button-from-Yellow');
                $('.button-from-Odintsovo').addClass('button-from-Blue');
                $('.button-from-Moscow').removeClass('button-from-Blue');
                $('.button-from-Moscow').addClass('button-from-Yellow') }, 100) });
        myMap.controls.add(buttonFromMoskow, { float: 'right' }); var ButtonLayoutOdintsovo = ymaps.templateLayoutFactory.createClass(['<div title="{{ data.title }}" class="button-from-Odintsovo button-from-Blue ', '{% if state.size == "small" %}my-button_small{% endif %}', '{% if state.size == "medium" %}my-button_medium{% endif %}', '{% if state.size == "large" %}my-button_large{% endif %}', '{% if state.selected %} my-button-selected{% endif %}">', '<span class="my-button__text">{{ data.content }}</span>', '</div>'].join('')); var buttonFromOdintsovo = new ymaps.control.Button({ data: { content: "ИЗ ОДИНЦОВО", title: "ИЗ ОДИНЦОВО" }, options: { layout: ButtonLayoutOdintsovo } });
        buttonFromOdintsovo.events.add('click', function(e) { destroyMap();
            renderOdintsovo();
            setTimeout(function() { $('.button-from-Moscow').removeClass('button-from-Yellow');
                $('.button-from-Moscow').addClass('button-from-Blue');
                $('.button-from-Odintsovo').removeClass('button-from-Blue');
                $('.button-from-Odintsovo').addClass('button-from-Yellow') }, 100) });
        myMap.controls.add(buttonFromOdintsovo, { float: 'right' });
        renderMoskow();

        function renderMoskow() { if ($(window).width() < 768) { myMap.setCenter([55.73883786622665, 37.323888549804595], 10); } else { myMap.setCenter([55.73883786622665, 37.383888549804595], 11); } var logoPlacemark = new ymaps.Placemark([55.6971, 37.2284], { hintContent: '' }, { iconLayout: 'default#image', iconImageHref: 'images/logo.png', iconImageSize: [103, 50], iconImageOffset: [-51.5, -25], draggable: !1 });
            myMap.geoObjects.add(logoPlacemark);
            ymaps.route([
                [55.7402, 37.3715],
                [55.697392, 37.228665]
            ]).then(function(route) { myMap.geoObjects.add(route1 = route);
                route.getPaths().options.set({ strokeColor: 'fced05', strokeWidth: 6, opacity: 1 }); var time = Math.floor(route.getPaths().get(0).getJamsTime() / 60);
                myPlacemark1 = new ymaps.Placemark([55.7402, 37.3715], { hintContent: 'По северному обходу Одинцова', iconContent: '<div style="color: #000; width: 100px; position: relative; top: 16px; left: 35px;"> 10 мин. </div>' }, { iconLayout: 'default#imageWithContent', iconImageHref: 'images/mapLabel2.png', iconImageSize: [320, 45], iconImageOffset: [-10, -25] });
                myMap.geoObjects.add(myPlacemark1); var points = route.getWayPoints();
                points.get(0).options.set('visible', !1);
                points.get(1).options.set('visible', !1);
                points.get(2).options.set('visible', !1) }, function(error) { console.log('Возникла ошибка: ' + error.message) });
            route2 = ymaps.route([
                [55.7678, 37.3693],
                [55.7343, 37.2238],
                [55.697392, 37.228665]
            ]).then(function(route) { route.getPaths().options.set({ strokeColor: '589cdd', strokeWidth: 3, opacity: 1 }); var points = route.getWayPoints();
                points.get(0).options.set('visible', !1);
                points.get(1).options.set('visible', !1);
                points.get(2).options.set('visible', !1); var time = Math.floor(route.getPaths().get(1).getJamsTime() / 60);
                myPlacemark2 = new ymaps.Placemark([55.7678, 37.3693], { hintContent: 'По Рублево-Успенскому шоссе', iconContent: '<div style="color: #fff; width: 100px; position: relative; top: 12px; left: 17px;"> 22 мин. </div>' }, { iconLayout: 'default#imageWithContent', iconImageHref: 'images/mapLabel1.png', iconImageSize: [280, 64], iconImageOffset: [-20, -55] });
                myMap.geoObjects.add(myPlacemark2);
                myMap.geoObjects.add(route2 = route) }, function(error) { console.log('Возникла ошибка: ' + error.message) });
            route3 = ymaps.route([
                [55.7204, 37.3816],
                [55.7058, 37.3571],
                [55.697392, 37.228665]
            ]).then(function(route) { route.getPaths().options.set({ strokeColor: '589cdd', strokeWidth: 3, opacity: 1 }); var points = route.getWayPoints();
                points.get(0).options.set('visible', !1);
                points.get(1).options.set('visible', !1);
                points.get(2).options.set('visible', !1); var time = Math.floor(route.getPaths().get(1).getJamsTime() / 60);
                myPlacemark3 = new ymaps.Placemark([55.7204, 37.3816], { hintContent: 'По Можайскому шоссе', iconContent: '<div style="color: #fff; width: 100px; position: relative; top: 37px; left: 17px;"> 21 мин. </div>' }, { iconLayout: 'default#imageWithContent', iconImageHref: 'images/mapLabel3.png', iconImageSize: [280, 64], iconImageOffset: [-20, 0] });
                myMap.geoObjects.add(myPlacemark3);
                myMap.geoObjects.add(route3 = route) }, function(error) { console.log('Возникла ошибка: ' + error.message) }) }

        function renderOdintsovo() { if ($(window).width() < 768) { myMap.setCenter([55.68515131812132, 37.25433517456051], 12); } else { myMap.setCenter([55.68515131812132, 37.25433517456051], 13); } ymaps.route([
                [55.674, 37.278],
                [55.697392, 37.228665]
            ]).then(function(route) { myMap.geoObjects.add(route4 = route);
                route.getPaths().options.set({ strokeColor: '589cdd', strokeWidth: 4, opacity: 1 }); var time = Math.floor(route.getPaths().get(0).getJamsTime() / 60);
                myPlacemark4 = new ymaps.Placemark([55.674, 37.278], { hintContent: 'Из одинцова', iconContent: '<div style="color: #fff; width: 100px; position: relative; top: 37px; left: 17px;"> 5 мин. </div>' }, { iconLayout: 'default#imageWithContent', iconImageHref: 'images/mapLabel4.png', iconImageSize: [218, 40], iconImageOffset: [-205, -20] });
                myMap.geoObjects.add(myPlacemark4); var points = route.getWayPoints();
                points.get(0).options.set('visible', !1);
                points.get(1).options.set('visible', !1);
                points.get(2).options.set('visible', !1) }, function(error) { console.log('Возникла ошибка: ' + error.message) }) }

        function destroyMap() { myMap.geoObjects.remove(route1);
            myMap.geoObjects.remove(route2);
            myMap.geoObjects.remove(route3);
            myMap.geoObjects.remove(route4);
            myMap.geoObjects.remove(myPlacemark1);
            myMap.geoObjects.remove(myPlacemark2);
            myMap.geoObjects.remove(myPlacemark3);
            myMap.geoObjects.remove(myPlacemark4) } } });
$(document).ready(function() {
    var timer;
    $("form").submit(function() { $.ajax({ type: "POST", url: "mail.php", data: $(this).serialize() }).done(function() { if ($('.popup_wrap .background').css("display") == "block") { $(".popup_wrap .form").animate({ "top": "+=100px", "opacity": '0' }, 500, function() { $(this).hide().css("top", '');
                    $(".popup_wrap #done2").css({ "opacity": '', "top": "" }).show().animate({ "top": "0px", "opacity": '1' }, 500) }) } else { $(".popup_wrap .background").fadeIn();
                $(".popup_wrap #done2").css({ 'bottom': '0', "position": "fixed" }).show().animate({ "top": "0px", "opacity": '1' }, 500) } timer = setTimeout(function() { $(".popup_wrap #done2").animate({ "top": "+=100px", "opacity": '0' }, 500, function() { $(this).hide().css("top", '');
                    $(".popup_wrap .background").fadeOut() }) }, 3000);
            $("form").trigger("reset") }); return !1 });
    $(".photos button").click(function() { event.preventDefault(); if (parseInt($(".popup_wrap .form").css('height')) > parseInt(window.innerHeight)) { $(".popup_wrap .form").css('position', 'absolute');
            $(".popup_wrap .background").fadeIn();
            $(".popup_wrap .form").show().css({ "bottom": "auto", "top": $(window).scrollTop() - 70, }).animate({ "top": $(window).scrollTop() + 30, "opacity": '1' }, 500) } else { $(".popup_wrap .background").fadeIn();
            $(".popup_wrap .form").css({ 'bottom': '0', "position": "fixed" }).show().animate({ "top": "0px", "opacity": '1' }, 500) } })
    $(".popup_wrap .background, .popup_wrap .close").click(function() { $("#done2").fadeOut();
        $(".popup_wrap .form").animate({ "top": "+=100px", "opacity": '0' }, 500, function() { $(this).hide().css("top", '');
            $(".popup_wrap .background").fadeOut() });
        clearTimeout(timer) });
		  $(".header .content .info_wrap .box1").hover(function() { $(".header .content .info_wrap .imgbox1").stop(!0).fadeIn(500);
        $(this).css("animation-play-state", "running") }, function() { $(".header .content .info_wrap .imgbox1").stop(!0).fadeOut(500) })
     $(".header .content .info_wrap .box4").hover(function() { $(".header .content .info_wrap .imgbox4").stop(!0).fadeIn(500);
        $(this).css("animation-play-state", "running") }, function() { $(".header .content .info_wrap .imgbox4").stop(!0).fadeOut(500) })
	 $(".header .content .info_wrap .box6").hover(function() { $(".header .content .info_wrap .imgbox6").stop(!0).fadeIn(500);
        $(this).css("animation-play-state", "running") }, function() { $(".header .content .info_wrap .imgbox6").stop(!0).fadeOut(500) })
    $(".header .content .info_wrap .box15").hover(function() { $(".header .content .info_wrap .imgbox15").stop(!0).fadeIn(500);
        $(this).css("animation-play-state", "running") }, function() { $(".header .content .info_wrap .imgbox15").stop(!0).fadeOut(500) })
    $(".header .content .box30").hover(function() { $(".header .content .info_wrap .imgbox30").stop(!0).fadeIn(500) }, function() { $(".header .content .info_wrap .imgbox30").stop(!0).fadeOut(500) });
	
     
    setTimeout(function() { $(".header .content .info_wrap .info").eq(0).css("animation", "1.5s tada"); var iteration = 1;
        setInterval(function() { iteration = iteration % 4;
            $(".header .content .info_wrap .info").css("animation", "").eq(iteration).css("animation", "1.5s tada");
            iteration++ }, 7000) }, 2000)
 $(".header .content .info_wrap .imgbox1").hover(function() { $(".header .content .info_wrap .imgbox1").stop(!0).fadeIn(500);
        $(this).css("animation-play-state", "running") }, function() { $(".header .content .info_wrap .imgbox1").stop(!0).fadeOut(500) })
 $(".header .content .info_wrap .imgbox4").hover(function() { $(".header .content .info_wrap .imgbox4").stop(!0).fadeIn(500);
        $(this).css("animation-play-state", "running") }, function() { $(".header .content .info_wrap .imgbox4").stop(!0).fadeOut(500) })
 $(".header .content .info_wrap .imgbox6").hover(function() { $(".header .content .info_wrap .imgbox6").stop(!0).fadeIn(500);
        $(this).css("animation-play-state", "running") }, function() { $(".header .content .info_wrap .imgbox6").stop(!0).fadeOut(500) })
 $(".header .content .info_wrap .imgbox15").hover(function() { $(".header .content .info_wrap .imgbox15").stop(!0).fadeIn(500);
        $(this).css("animation-play-state", "running") }, function() { $(".header .content .info_wrap .imgbox15").stop(!0).fadeOut(500) })
    $(".header .content .imgbox30").hover(function() { $(".header .content .info_wrap .imgbox30").stop(!0).fadeIn(500) }, function() { $(".header .content .info_wrap .imgbox30").stop(!0).fadeOut(500) });
	
	$(".imgbox button").click(function() { event.preventDefault(); if (parseInt($(".popup_wrap .form").css('height')) > parseInt(window.innerHeight)) { $(".popup_wrap .form").css('position', 'absolute');
            $(".popup_wrap .background").fadeIn();
            $(".popup_wrap .form").show().css({ "bottom": "auto", "top": $(window).scrollTop() - 70, }).animate({ "top": $(window).scrollTop() + 30, "opacity": '1' }, 500) } else { $(".popup_wrap .background").fadeIn();
            $(".popup_wrap .form").css({ 'bottom': '0', "position": "fixed" }).show().animate({ "top": "0px", "opacity": '1' }, 500) } })
});
(function() {
    var a, b, c, d, e, f = function(a, b) { return function() { return a.apply(b, arguments) } },
        g = [].indexOf || function(a) { for (var b = 0, c = this.length; c > b; b++)
                if (b in this && this[b] === a) return b; return -1 };
    b = function() {
        function a() {} return a.prototype.extend = function(a, b) { var c, d; for (c in b) d = b[c], null == a[c] && (a[c] = d); return a }, a.prototype.isMobile = function(a) { return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(a) }, a.prototype.createEvent = function(a, b, c, d) { var e; return null == b && (b = !1), null == c && (c = !1), null == d && (d = null), null != document.createEvent ? (e = document.createEvent("CustomEvent"), e.initCustomEvent(a, b, c, d)) : null != document.createEventObject ? (e = document.createEventObject(), e.eventType = a) : e.eventName = a, e }, a.prototype.emitEvent = function(a, b) { return null != a.dispatchEvent ? a.dispatchEvent(b) : b in (null != a) ? a[b]() : "on" + b in (null != a) ? a["on" + b]() : void 0 }, a.prototype.addEvent = function(a, b, c) { return null != a.addEventListener ? a.addEventListener(b, c, !1) : null != a.attachEvent ? a.attachEvent("on" + b, c) : a[b] = c }, a.prototype.removeEvent = function(a, b, c) { return null != a.removeEventListener ? a.removeEventListener(b, c, !1) : null != a.detachEvent ? a.detachEvent("on" + b, c) : delete a[b] }, a.prototype.innerHeight = function() { return "innerHeight" in window ? window.innerHeight : document.documentElement.clientHeight }, a }(), c = this.WeakMap || this.MozWeakMap || (c = function() {
        function a() { this.keys = [], this.values = [] } return a.prototype.get = function(a) { var b, c, d, e, f; for (f = this.keys, b = d = 0, e = f.length; e > d; b = ++d)
                if (c = f[b], c === a) return this.values[b] }, a.prototype.set = function(a, b) { var c, d, e, f, g; for (g = this.keys, c = e = 0, f = g.length; f > e; c = ++e)
                if (d = g[c], d === a) return void(this.values[c] = b); return this.keys.push(a), this.values.push(b) }, a }()), a = this.MutationObserver || this.WebkitMutationObserver || this.MozMutationObserver || (a = function() {
        function a() { "undefined" != typeof console && null !== console && console.warn("MutationObserver is not supported by your browser."), "undefined" != typeof console && null !== console && console.warn("WOW.js cannot detect dom mutations, please call .sync() after loading new content.") } return a.notSupported = !0, a.prototype.observe = function() {}, a }()), d = this.getComputedStyle || function(a) { return this.getPropertyValue = function(b) { var c; return "float" === b && (b = "styleFloat"), e.test(b) && b.replace(e, function(a, b) { return b.toUpperCase() }), (null != (c = a.currentStyle) ? c[b] : void 0) || null }, this }, e = /(\-([a-z]){1})/g, this.WOW = function() {
        function e(a) { null == a && (a = {}), this.scrollCallback = f(this.scrollCallback, this), this.scrollHandler = f(this.scrollHandler, this), this.resetAnimation = f(this.resetAnimation, this), this.start = f(this.start, this), this.scrolled = !0, this.config = this.util().extend(a, this.defaults), null != a.scrollContainer && (this.config.scrollContainer = document.querySelector(a.scrollContainer)), this.animationNameCache = new c, this.wowEvent = this.util().createEvent(this.config.boxClass) }
        return e.prototype.defaults = { boxClass: "wow", animateClass: "animated", offset: 0, mobile: !0, live: !0, callback: null, scrollContainer: null }, e.prototype.init = function() { var a; return this.element = window.document.documentElement, "interactive" === (a = document.readyState) || "complete" === a ? this.start() : this.util().addEvent(document, "DOMContentLoaded", this.start), this.finished = [] }, e.prototype.start = function() {
            var b, c, d, e;
            if (this.stopped = !1, this.boxes = function() { var a, c, d, e; for (d = this.element.querySelectorAll("." + this.config.boxClass), e = [], a = 0, c = d.length; c > a; a++) b = d[a], e.push(b); return e }.call(this), this.all = function() { var a, c, d, e; for (d = this.boxes, e = [], a = 0, c = d.length; c > a; a++) b = d[a], e.push(b); return e }.call(this), this.boxes.length)
                if (this.disabled()) this.resetStyle();
                else
                    for (e = this.boxes, c = 0, d = e.length; d > c; c++) b = e[c], this.applyStyle(b, !0);
            return this.disabled() || (this.util().addEvent(this.config.scrollContainer || window, "scroll", this.scrollHandler), this.util().addEvent(window, "resize", this.scrollHandler), this.interval = setInterval(this.scrollCallback, 50)), this.config.live ? new a(function(a) { return function(b) { var c, d, e, f, g; for (g = [], c = 0, d = b.length; d > c; c++) f = b[c], g.push(function() { var a, b, c, d; for (c = f.addedNodes || [], d = [], a = 0, b = c.length; b > a; a++) e = c[a], d.push(this.doSync(e)); return d }.call(a)); return g } }(this)).observe(document.body, { childList: !0, subtree: !0 }) : void 0
        }, e.prototype.stop = function() { return this.stopped = !0, this.util().removeEvent(this.config.scrollContainer || window, "scroll", this.scrollHandler), this.util().removeEvent(window, "resize", this.scrollHandler), null != this.interval ? clearInterval(this.interval) : void 0 }, e.prototype.sync = function() { return a.notSupported ? this.doSync(this.element) : void 0 }, e.prototype.doSync = function(a) { var b, c, d, e, f; if (null == a && (a = this.element), 1 === a.nodeType) { for (a = a.parentNode || a, e = a.querySelectorAll("." + this.config.boxClass), f = [], c = 0, d = e.length; d > c; c++) b = e[c], g.call(this.all, b) < 0 ? (this.boxes.push(b), this.all.push(b), this.stopped || this.disabled() ? this.resetStyle() : this.applyStyle(b, !0), f.push(this.scrolled = !0)) : f.push(void 0); return f } }, e.prototype.show = function(a) { return this.applyStyle(a), a.className = a.className + " " + this.config.animateClass, null != this.config.callback && this.config.callback(a), this.util().emitEvent(a, this.wowEvent), this.util().addEvent(a, "animationend", this.resetAnimation), this.util().addEvent(a, "oanimationend", this.resetAnimation), this.util().addEvent(a, "webkitAnimationEnd", this.resetAnimation), this.util().addEvent(a, "MSAnimationEnd", this.resetAnimation), a }, e.prototype.applyStyle = function(a, b) { var c, d, e; return d = a.getAttribute("data-wow-duration"), c = a.getAttribute("data-wow-delay"), e = a.getAttribute("data-wow-iteration"), this.animate(function(f) { return function() { return f.customStyle(a, b, d, c, e) } }(this)) }, e.prototype.animate = function() { return "requestAnimationFrame" in window ? function(a) { return window.requestAnimationFrame(a) } : function(a) { return a() } }(), e.prototype.resetStyle = function() { var a, b, c, d, e; for (d = this.boxes, e = [], b = 0, c = d.length; c > b; b++) a = d[b], e.push(a.style.visibility = "visible"); return e }, e.prototype.resetAnimation = function(a) { var b; return a.type.toLowerCase().indexOf("animationend") >= 0 ? (b = a.target || a.srcElement, b.className = b.className.replace(this.config.animateClass, "").trim()) : void 0 }, e.prototype.customStyle = function(a, b, c, d, e) { return b && this.cacheAnimationName(a), a.style.visibility = b ? "hidden" : "visible", c && this.vendorSet(a.style, { animationDuration: c }), d && this.vendorSet(a.style, { animationDelay: d }), e && this.vendorSet(a.style, { animationIterationCount: e }), this.vendorSet(a.style, { animationName: b ? "none" : this.cachedAnimationName(a) }), a }, e.prototype.vendors = ["moz", "webkit"], e.prototype.vendorSet = function(a, b) { var c, d, e, f;
            d = []; for (c in b) e = b[c], a["" + c] = e, d.push(function() { var b, d, g, h; for (g = this.vendors, h = [], b = 0, d = g.length; d > b; b++) f = g[b], h.push(a["" + f + c.charAt(0).toUpperCase() + c.substr(1)] = e); return h }.call(this)); return d }, e.prototype.vendorCSS = function(a, b) { var c, e, f, g, h, i; for (h = d(a), g = h.getPropertyCSSValue(b), f = this.vendors, c = 0, e = f.length; e > c; c++) i = f[c], g = g || h.getPropertyCSSValue("-" + i + "-" + b); return g }, e.prototype.animationName = function(a) { var b; try { b = this.vendorCSS(a, "animation-name").cssText } catch (c) { b = d(a).getPropertyValue("animation-name") } return "none" === b ? "" : b }, e.prototype.cacheAnimationName = function(a) { return this.animationNameCache.set(a, this.animationName(a)) }, e.prototype.cachedAnimationName = function(a) { return this.animationNameCache.get(a) }, e.prototype.scrollHandler = function() { return this.scrolled = !0 }, e.prototype.scrollCallback = function() { var a; return !this.scrolled || (this.scrolled = !1, this.boxes = function() { var b, c, d, e; for (d = this.boxes, e = [], b = 0, c = d.length; c > b; b++) a = d[b], a && (this.isVisible(a) ? this.show(a) : e.push(a)); return e }.call(this), this.boxes.length || this.config.live) ? void 0 : this.stop() }, e.prototype.offsetTop = function(a) { for (var b; void 0 === a.offsetTop;) a = a.parentNode; for (b = a.offsetTop; a = a.offsetParent;) b += a.offsetTop; return b }, e.prototype.isVisible = function(a) { var b, c, d, e, f; return c = a.getAttribute("data-wow-offset") || this.config.offset, f = this.config.scrollContainer && this.config.scrollContainer.scrollTop || window.pageYOffset, e = f + Math.min(this.element.clientHeight, this.util().innerHeight()) - c, d = this.offsetTop(a), b = d + a.clientHeight, e >= d && b >= f }, e.prototype.util = function() { return null != this._util ? this._util : this._util = new b }, e.prototype.disabled = function() { return !this.config.mobile && this.util().isMobile(navigator.userAgent) }, e
    }()
}).call(this);
! function(a, b, c, d) {
    function e(b, c) { this.settings = null, this.options = a.extend({}, e.Defaults, c), this.$element = a(b), this._handlers = {}, this._plugins = {}, this._supress = {}, this._current = null, this._speed = null, this._coordinates = [], this._breakpoint = null, this._width = null, this._items = [], this._clones = [], this._mergers = [], this._widths = [], this._invalidated = {}, this._pipe = [], this._drag = { time: null, target: null, pointer: null, stage: { start: null, current: null }, direction: null }, this._states = { current: {}, tags: { initializing: ["busy"], animating: ["busy"], dragging: ["interacting"] } }, a.each(["onResize", "onThrottledResize"], a.proxy(function(b, c) { this._handlers[c] = a.proxy(this[c], this) }, this)), a.each(e.Plugins, a.proxy(function(a, b) { this._plugins[a.charAt(0).toLowerCase() + a.slice(1)] = new b(this) }, this)), a.each(e.Workers, a.proxy(function(b, c) { this._pipe.push({ filter: c.filter, run: a.proxy(c.run, this) }) }, this)), this.setup(), this.initialize() } e.Defaults = { items: 3, loop: !1, center: !1, rewind: !1, mouseDrag: !0, touchDrag: !0, pullDrag: !0, freeDrag: !1, margin: 0, stagePadding: 0, merge: !1, mergeFit: !0, autoWidth: !1, startPosition: 0, rtl: !1, smartSpeed: 250, fluidSpeed: !1, dragEndSpeed: !1, responsive: {}, responsiveRefreshRate: 200, responsiveBaseElement: b, fallbackEasing: "swing", info: !1, nestedItemSelector: !1, itemElement: "div", stageElement: "div", refreshClass: "owl-refresh", loadedClass: "owl-loaded", loadingClass: "owl-loading", rtlClass: "owl-rtl", responsiveClass: "owl-responsive", dragClass: "owl-drag", itemClass: "owl-item", stageClass: "owl-stage", stageOuterClass: "owl-stage-outer", grabClass: "owl-grab" }, e.Width = { Default: "default", Inner: "inner", Outer: "outer" }, e.Type = { Event: "event", State: "state" }, e.Plugins = {}, e.Workers = [{ filter: ["width", "settings"], run: function() { this._width = this.$element.width() } }, { filter: ["width", "items", "settings"], run: function(a) { a.current = this._items && this._items[this.relative(this._current)] } }, { filter: ["items", "settings"], run: function() { this.$stage.children(".cloned").remove() } }, { filter: ["width", "items", "settings"], run: function(a) { var b = this.settings.margin || "",
                c = !this.settings.autoWidth,
                d = this.settings.rtl,
                e = { width: "auto", "margin-left": d ? b : "", "margin-right": d ? "" : b };!c && this.$stage.children().css(e), a.css = e } }, { filter: ["width", "items", "settings"], run: function(a) { var b = (this.width() / this.settings.items).toFixed(3) - this.settings.margin,
                c = null,
                d = this._items.length,
                e = !this.settings.autoWidth,
                f = []; for (a.items = { merge: !1, width: b }; d--;) c = this._mergers[d], c = this.settings.mergeFit && Math.min(c, this.settings.items) || c, a.items.merge = c > 1 || a.items.merge, f[d] = e ? b * c : this._items[d].width();
            this._widths = f } }, { filter: ["items", "settings"], run: function() { var b = [],
                c = this._items,
                d = this.settings,
                e = Math.max(2 * d.items, 4),
                f = 2 * Math.ceil(c.length / 2),
                g = d.loop && c.length ? d.rewind ? e : Math.max(e, f) : 0,
                h = "",
                i = ""; for (g /= 2; g--;) b.push(this.normalize(b.length / 2, !0)), h += c[b[b.length - 1]][0].outerHTML, b.push(this.normalize(c.length - 1 - (b.length - 1) / 2, !0)), i = c[b[b.length - 1]][0].outerHTML + i;
            this._clones = b, a(h).addClass("cloned").appendTo(this.$stage), a(i).addClass("cloned").prependTo(this.$stage) } }, { filter: ["width", "items", "settings"], run: function() { for (var a = this.settings.rtl ? 1 : -1, b = this._clones.length + this._items.length, c = -1, d = 0, e = 0, f = []; ++c < b;) d = f[c - 1] || 0, e = this._widths[this.relative(c)] + this.settings.margin, f.push(d + e * a);
            this._coordinates = f } }, { filter: ["width", "items", "settings"], run: function() { var a = this.settings.stagePadding,
                b = this._coordinates,
                c = { width: Math.ceil(Math.abs(b[b.length - 1])) + 2 * a, "padding-left": a || "", "padding-right": a || "" };
            this.$stage.css(c) } }, { filter: ["width", "items", "settings"], run: function(a) { var b = this._coordinates.length,
                c = !this.settings.autoWidth,
                d = this.$stage.children(); if (c && a.items.merge)
                for (; b--;) a.css.width = this._widths[this.relative(b)], d.eq(b).css(a.css);
            else c && (a.css.width = a.items.width, d.css(a.css)) } }, { filter: ["items"], run: function() { this._coordinates.length < 1 && this.$stage.removeAttr("style") } }, { filter: ["width", "items", "settings"], run: function(a) { a.current = a.current ? this.$stage.children().index(a.current) : 0, a.current = Math.max(this.minimum(), Math.min(this.maximum(), a.current)), this.reset(a.current) } }, { filter: ["position"], run: function() { this.animate(this.coordinates(this._current)) } }, { filter: ["width", "position", "items", "settings"], run: function() { var a, b, c, d, e = this.settings.rtl ? 1 : -1,
                f = 2 * this.settings.stagePadding,
                g = this.coordinates(this.current()) + f,
                h = g + this.width() * e,
                i = []; for (c = 0, d = this._coordinates.length; d > c; c++) a = this._coordinates[c - 1] || 0, b = Math.abs(this._coordinates[c]) + f * e, (this.op(a, "<=", g) && this.op(a, ">", h) || this.op(b, "<", g) && this.op(b, ">", h)) && i.push(c);
            this.$stage.children(".active").removeClass("active"), this.$stage.children(":eq(" + i.join("), :eq(") + ")").addClass("active"), this.settings.center && (this.$stage.children(".center").removeClass("center"), this.$stage.children().eq(this.current()).addClass("center")) } }], e.prototype.initialize = function() { if (this.enter("initializing"), this.trigger("initialize"), this.$element.toggleClass(this.settings.rtlClass, this.settings.rtl), this.settings.autoWidth && !this.is("pre-loading")) { var b, c, e;
            b = this.$element.find("img"), c = this.settings.nestedItemSelector ? "." + this.settings.nestedItemSelector : d, e = this.$element.children(c).width(), b.length && 0 >= e && this.preloadAutoWidthImages(b) } this.$element.addClass(this.options.loadingClass), this.$stage = a("<" + this.settings.stageElement + ' class="' + this.settings.stageClass + '"/>').wrap('<div class="' + this.settings.stageOuterClass + '"/>'), this.$element.append(this.$stage.parent()), this.replace(this.$element.children().not(this.$stage.parent())), this.$element.is(":visible") ? this.refresh() : this.invalidate("width"), this.$element.removeClass(this.options.loadingClass).addClass(this.options.loadedClass), this.registerEventHandlers(), this.leave("initializing"), this.trigger("initialized") }, e.prototype.setup = function() { var b = this.viewport(),
            c = this.options.responsive,
            d = -1,
            e = null;
        c ? (a.each(c, function(a) { b >= a && a > d && (d = Number(a)) }), e = a.extend({}, this.options, c[d]), "function" == typeof e.stagePadding && (e.stagePadding = e.stagePadding()), delete e.responsive, e.responsiveClass && this.$element.attr("class", this.$element.attr("class").replace(new RegExp("(" + this.options.responsiveClass + "-)\\S+\\s", "g"), "$1" + d))) : e = a.extend({}, this.options), this.trigger("change", { property: { name: "settings", value: e } }), this._breakpoint = d, this.settings = e, this.invalidate("settings"), this.trigger("changed", { property: { name: "settings", value: this.settings } }) }, e.prototype.optionsLogic = function() { this.settings.autoWidth && (this.settings.stagePadding = !1, this.settings.merge = !1) }, e.prototype.prepare = function(b) { var c = this.trigger("prepare", { content: b }); return c.data || (c.data = a("<" + this.settings.itemElement + "/>").addClass(this.options.itemClass).append(b)), this.trigger("prepared", { content: c.data }), c.data }, e.prototype.update = function() { for (var b = 0, c = this._pipe.length, d = a.proxy(function(a) { return this[a] }, this._invalidated), e = {}; c > b;)(this._invalidated.all || a.grep(this._pipe[b].filter, d).length > 0) && this._pipe[b].run(e), b++;
        this._invalidated = {}, !this.is("valid") && this.enter("valid") }, e.prototype.width = function(a) { switch (a = a || e.Width.Default) {
            case e.Width.Inner:
            case e.Width.Outer:
                return this._width;
            default:
                return this._width - 2 * this.settings.stagePadding + this.settings.margin } }, e.prototype.refresh = function() { this.enter("refreshing"), this.trigger("refresh"), this.setup(), this.optionsLogic(), this.$element.addClass(this.options.refreshClass), this.update(), this.$element.removeClass(this.options.refreshClass), this.leave("refreshing"), this.trigger("refreshed") }, e.prototype.onThrottledResize = function() { b.clearTimeout(this.resizeTimer), this.resizeTimer = b.setTimeout(this._handlers.onResize, this.settings.responsiveRefreshRate) }, e.prototype.onResize = function() { return this._items.length ? this._width === this.$element.width() ? !1 : this.$element.is(":visible") ? (this.enter("resizing"), this.trigger("resize").isDefaultPrevented() ? (this.leave("resizing"), !1) : (this.invalidate("width"), this.refresh(), this.leave("resizing"), void this.trigger("resized"))) : !1 : !1 }, e.prototype.registerEventHandlers = function() { a.support.transition && this.$stage.on(a.support.transition.end + ".owl.core", a.proxy(this.onTransitionEnd, this)), this.settings.responsive !== !1 && this.on(b, "resize", this._handlers.onThrottledResize), this.settings.mouseDrag && (this.$element.addClass(this.options.dragClass), this.$stage.on("mousedown.owl.core", a.proxy(this.onDragStart, this)), this.$stage.on("dragstart.owl.core selectstart.owl.core", function() { return !1 })), this.settings.touchDrag && (this.$stage.on("touchstart.owl.core", a.proxy(this.onDragStart, this)), this.$stage.on("touchcancel.owl.core", a.proxy(this.onDragEnd, this))) }, e.prototype.onDragStart = function(b) { var d = null;
        3 !== b.which && (a.support.transform ? (d = this.$stage.css("transform").replace(/.*\(|\)| /g, "").split(","), d = { x: d[16 === d.length ? 12 : 4], y: d[16 === d.length ? 13 : 5] }) : (d = this.$stage.position(), d = { x: this.settings.rtl ? d.left + this.$stage.width() - this.width() + this.settings.margin : d.left, y: d.top }), this.is("animating") && (a.support.transform ? this.animate(d.x) : this.$stage.stop(), this.invalidate("position")), this.$element.toggleClass(this.options.grabClass, "mousedown" === b.type), this.speed(0), this._drag.time = (new Date).getTime(), this._drag.target = a(b.target), this._drag.stage.start = d, this._drag.stage.current = d, this._drag.pointer = this.pointer(b), a(c).on("mouseup.owl.core touchend.owl.core", a.proxy(this.onDragEnd, this)), a(c).one("mousemove.owl.core touchmove.owl.core", a.proxy(function(b) { var d = this.difference(this._drag.pointer, this.pointer(b));
            a(c).on("mousemove.owl.core touchmove.owl.core", a.proxy(this.onDragMove, this)), Math.abs(d.x) < Math.abs(d.y) && this.is("valid") || (b.preventDefault(), this.enter("dragging"), this.trigger("drag")) }, this))) }, e.prototype.onDragMove = function(a) { var b = null,
            c = null,
            d = null,
            e = this.difference(this._drag.pointer, this.pointer(a)),
            f = this.difference(this._drag.stage.start, e);
        this.is("dragging") && (a.preventDefault(), this.settings.loop ? (b = this.coordinates(this.minimum()), c = this.coordinates(this.maximum() + 1) - b, f.x = ((f.x - b) % c + c) % c + b) : (b = this.settings.rtl ? this.coordinates(this.maximum()) : this.coordinates(this.minimum()), c = this.settings.rtl ? this.coordinates(this.minimum()) : this.coordinates(this.maximum()), d = this.settings.pullDrag ? -1 * e.x / 5 : 0, f.x = Math.max(Math.min(f.x, b + d), c + d)), this._drag.stage.current = f, this.animate(f.x)) }, e.prototype.onDragEnd = function(b) { var d = this.difference(this._drag.pointer, this.pointer(b)),
            e = this._drag.stage.current,
            f = d.x > 0 ^ this.settings.rtl ? "left" : "right";
        a(c).off(".owl.core"), this.$element.removeClass(this.options.grabClass), (0 !== d.x && this.is("dragging") || !this.is("valid")) && (this.speed(this.settings.dragEndSpeed || this.settings.smartSpeed), this.current(this.closest(e.x, 0 !== d.x ? f : this._drag.direction)), this.invalidate("position"), this.update(), this._drag.direction = f, (Math.abs(d.x) > 3 || (new Date).getTime() - this._drag.time > 300) && this._drag.target.one("click.owl.core", function() { return !1 })), this.is("dragging") && (this.leave("dragging"), this.trigger("dragged")) }, e.prototype.closest = function(b, c) { var d = -1,
            e = 30,
            f = this.width(),
            g = this.coordinates(); return this.settings.freeDrag || a.each(g, a.proxy(function(a, h) { return "left" === c && b > h - e && h + e > b ? d = a : "right" === c && b > h - f - e && h - f + e > b ? d = a + 1 : this.op(b, "<", h) && this.op(b, ">", g[a + 1] || h - f) && (d = "left" === c ? a + 1 : a), -1 === d }, this)), this.settings.loop || (this.op(b, ">", g[this.minimum()]) ? d = b = this.minimum() : this.op(b, "<", g[this.maximum()]) && (d = b = this.maximum())), d }, e.prototype.animate = function(b) { var c = this.speed() > 0;
        this.is("animating") && this.onTransitionEnd(), c && (this.enter("animating"), this.trigger("translate")), a.support.transform3d && a.support.transition ? this.$stage.css({ transform: "translate3d(" + b + "px,0px,0px)", transition: this.speed() / 1e3 + "s" }) : c ? this.$stage.animate({ left: b + "px" }, this.speed(), this.settings.fallbackEasing, a.proxy(this.onTransitionEnd, this)) : this.$stage.css({ left: b + "px" }) }, e.prototype.is = function(a) { return this._states.current[a] && this._states.current[a] > 0 }, e.prototype.current = function(a) { if (a === d) return this._current; if (0 === this._items.length) return d; if (a = this.normalize(a), this._current !== a) { var b = this.trigger("change", { property: { name: "position", value: a } });
            b.data !== d && (a = this.normalize(b.data)), this._current = a, this.invalidate("position"), this.trigger("changed", { property: { name: "position", value: this._current } }) } return this._current }, e.prototype.invalidate = function(b) { return "string" === a.type(b) && (this._invalidated[b] = !0, this.is("valid") && this.leave("valid")), a.map(this._invalidated, function(a, b) { return b }) }, e.prototype.reset = function(a) { a = this.normalize(a), a !== d && (this._speed = 0, this._current = a, this.suppress(["translate", "translated"]), this.animate(this.coordinates(a)), this.release(["translate", "translated"])) }, e.prototype.normalize = function(a, b) { var c = this._items.length,
            e = b ? 0 : this._clones.length; return !this.isNumeric(a) || 1 > c ? a = d : (0 > a || a >= c + e) && (a = ((a - e / 2) % c + c) % c + e / 2), a }, e.prototype.relative = function(a) { return a -= this._clones.length / 2, this.normalize(a, !0) }, e.prototype.maximum = function(a) { var b, c, d, e = this.settings,
            f = this._coordinates.length; if (e.loop) f = this._clones.length / 2 + this._items.length - 1;
        else if (e.autoWidth || e.merge) { for (b = this._items.length, c = this._items[--b].width(), d = this.$element.width(); b-- && (c += this._items[b].width() + this.settings.margin, !(c > d)););
            f = b + 1 } else f = e.center ? this._items.length - 1 : this._items.length - e.items; return a && (f -= this._clones.length / 2), Math.max(f, 0) }, e.prototype.minimum = function(a) { return a ? 0 : this._clones.length / 2 }, e.prototype.items = function(a) { return a === d ? this._items.slice() : (a = this.normalize(a, !0), this._items[a]) }, e.prototype.mergers = function(a) { return a === d ? this._mergers.slice() : (a = this.normalize(a, !0), this._mergers[a]) }, e.prototype.clones = function(b) { var c = this._clones.length / 2,
            e = c + this._items.length,
            f = function(a) { return a % 2 === 0 ? e + a / 2 : c - (a + 1) / 2 }; return b === d ? a.map(this._clones, function(a, b) { return f(b) }) : a.map(this._clones, function(a, c) { return a === b ? f(c) : null }) }, e.prototype.speed = function(a) { return a !== d && (this._speed = a), this._speed }, e.prototype.coordinates = function(b) { var c, e = 1,
            f = b - 1; return b === d ? a.map(this._coordinates, a.proxy(function(a, b) { return this.coordinates(b) }, this)) : (this.settings.center ? (this.settings.rtl && (e = -1, f = b + 1), c = this._coordinates[b], c += (this.width() - c + (this._coordinates[f] || 0)) / 2 * e) : c = this._coordinates[f] || 0, c = Math.ceil(c)) }, e.prototype.duration = function(a, b, c) { return 0 === c ? 0 : Math.min(Math.max(Math.abs(b - a), 1), 6) * Math.abs(c || this.settings.smartSpeed) }, e.prototype.to = function(a, b) { var c = this.current(),
            d = null,
            e = a - this.relative(c),
            f = (e > 0) - (0 > e),
            g = this._items.length,
            h = this.minimum(),
            i = this.maximum();
        this.settings.loop ? (!this.settings.rewind && Math.abs(e) > g / 2 && (e += -1 * f * g), a = c + e, d = ((a - h) % g + g) % g + h, d !== a && i >= d - e && d - e > 0 && (c = d - e, a = d, this.reset(c))) : this.settings.rewind ? (i += 1, a = (a % i + i) % i) : a = Math.max(h, Math.min(i, a)), this.speed(this.duration(c, a, b)), this.current(a), this.$element.is(":visible") && this.update() }, e.prototype.next = function(a) { a = a || !1, this.to(this.relative(this.current()) + 1, a) }, e.prototype.prev = function(a) { a = a || !1, this.to(this.relative(this.current()) - 1, a) }, e.prototype.onTransitionEnd = function(a) { return a !== d && (a.stopPropagation(), (a.target || a.srcElement || a.originalTarget) !== this.$stage.get(0)) ? !1 : (this.leave("animating"), void this.trigger("translated")) }, e.prototype.viewport = function() { var d; if (this.options.responsiveBaseElement !== b) d = a(this.options.responsiveBaseElement).width();
        else if (b.innerWidth) d = b.innerWidth;
        else { if (!c.documentElement || !c.documentElement.clientWidth) throw "Can not detect viewport width.";
            d = c.documentElement.clientWidth } return d }, e.prototype.replace = function(b) { this.$stage.empty(), this._items = [], b && (b = b instanceof jQuery ? b : a(b)), this.settings.nestedItemSelector && (b = b.find("." + this.settings.nestedItemSelector)), b.filter(function() { return 1 === this.nodeType }).each(a.proxy(function(a, b) { b = this.prepare(b), this.$stage.append(b), this._items.push(b), this._mergers.push(1 * b.find("[data-merge]").addBack("[data-merge]").attr("data-merge") || 1) }, this)), this.reset(this.isNumeric(this.settings.startPosition) ? this.settings.startPosition : 0), this.invalidate("items") }, e.prototype.add = function(b, c) { var e = this.relative(this._current);
        c = c === d ? this._items.length : this.normalize(c, !0), b = b instanceof jQuery ? b : a(b), this.trigger("add", { content: b, position: c }), b = this.prepare(b), 0 === this._items.length || c === this._items.length ? (0 === this._items.length && this.$stage.append(b), 0 !== this._items.length && this._items[c - 1].after(b), this._items.push(b), this._mergers.push(1 * b.find("[data-merge]").addBack("[data-merge]").attr("data-merge") || 1)) : (this._items[c].before(b), this._items.splice(c, 0, b), this._mergers.splice(c, 0, 1 * b.find("[data-merge]").addBack("[data-merge]").attr("data-merge") || 1)), this._items[e] && this.reset(this._items[e].index()), this.invalidate("items"), this.trigger("added", { content: b, position: c }) }, e.prototype.remove = function(a) { a = this.normalize(a, !0), a !== d && (this.trigger("remove", { content: this._items[a], position: a }), this._items[a].remove(), this._items.splice(a, 1), this._mergers.splice(a, 1), this.invalidate("items"), this.trigger("removed", { content: null, position: a })) }, e.prototype.preloadAutoWidthImages = function(b) { b.each(a.proxy(function(b, c) { this.enter("pre-loading"), c = a(c), a(new Image).one("load", a.proxy(function(a) { c.attr("src", a.target.src), c.css("opacity", 1), this.leave("pre-loading"), !this.is("pre-loading") && !this.is("initializing") && this.refresh() }, this)).attr("src", c.attr("src") || c.attr("data-src") || c.attr("data-src-retina")) }, this)) }, e.prototype.destroy = function() { this.$element.off(".owl.core"), this.$stage.off(".owl.core"), a(c).off(".owl.core"), this.settings.responsive !== !1 && (b.clearTimeout(this.resizeTimer), this.off(b, "resize", this._handlers.onThrottledResize)); for (var d in this._plugins) this._plugins[d].destroy();
        this.$stage.children(".cloned").remove(), this.$stage.unwrap(), this.$stage.children().contents().unwrap(), this.$stage.children().unwrap(), this.$element.removeClass(this.options.refreshClass).removeClass(this.options.loadingClass).removeClass(this.options.loadedClass).removeClass(this.options.rtlClass).removeClass(this.options.dragClass).removeClass(this.options.grabClass).attr("class", this.$element.attr("class").replace(new RegExp(this.options.responsiveClass + "-\\S+\\s", "g"), "")).removeData("owl.carousel") }, e.prototype.op = function(a, b, c) { var d = this.settings.rtl; switch (b) {
            case "<":
                return d ? a > c : c > a;
            case ">":
                return d ? c > a : a > c;
            case ">=":
                return d ? c >= a : a >= c;
            case "<=":
                return d ? a >= c : c >= a } }, e.prototype.on = function(a, b, c, d) { a.addEventListener ? a.addEventListener(b, c, d) : a.attachEvent && a.attachEvent("on" + b, c) }, e.prototype.off = function(a, b, c, d) { a.removeEventListener ? a.removeEventListener(b, c, d) : a.detachEvent && a.detachEvent("on" + b, c) }, e.prototype.trigger = function(b, c, d, f, g) { var h = { item: { count: this._items.length, index: this.current() } },
            i = a.camelCase(a.grep(["on", b, d], function(a) { return a }).join("-").toLowerCase()),
            j = a.Event([b, "owl", d || "carousel"].join(".").toLowerCase(), a.extend({ relatedTarget: this }, h, c)); return this._supress[b] || (a.each(this._plugins, function(a, b) { b.onTrigger && b.onTrigger(j) }), this.register({ type: e.Type.Event, name: b }), this.$element.trigger(j), this.settings && "function" == typeof this.settings[i] && this.settings[i].call(this, j)), j }, e.prototype.enter = function(b) { a.each([b].concat(this._states.tags[b] || []), a.proxy(function(a, b) { this._states.current[b] === d && (this._states.current[b] = 0), this._states.current[b]++ }, this)) }, e.prototype.leave = function(b) { a.each([b].concat(this._states.tags[b] || []), a.proxy(function(a, b) { this._states.current[b]-- }, this)) }, e.prototype.register = function(b) { if (b.type === e.Type.Event) { if (a.event.special[b.name] || (a.event.special[b.name] = {}), !a.event.special[b.name].owl) { var c = a.event.special[b.name]._default;
                a.event.special[b.name]._default = function(a) { return !c || !c.apply || a.namespace && -1 !== a.namespace.indexOf("owl") ? a.namespace && a.namespace.indexOf("owl") > -1 : c.apply(this, arguments) }, a.event.special[b.name].owl = !0 } } else b.type === e.Type.State && (this._states.tags[b.name] ? this._states.tags[b.name] = this._states.tags[b.name].concat(b.tags) : this._states.tags[b.name] = b.tags, this._states.tags[b.name] = a.grep(this._states.tags[b.name], a.proxy(function(c, d) { return a.inArray(c, this._states.tags[b.name]) === d }, this))) }, e.prototype.suppress = function(b) { a.each(b, a.proxy(function(a, b) { this._supress[b] = !0 }, this)) }, e.prototype.release = function(b) { a.each(b, a.proxy(function(a, b) { delete this._supress[b] }, this)) }, e.prototype.pointer = function(a) { var c = { x: null, y: null }; return a = a.originalEvent || a || b.event, a = a.touches && a.touches.length ? a.touches[0] : a.changedTouches && a.changedTouches.length ? a.changedTouches[0] : a, a.pageX ? (c.x = a.pageX, c.y = a.pageY) : (c.x = a.clientX, c.y = a.clientY), c }, e.prototype.isNumeric = function(a) { return !isNaN(parseFloat(a)) }, e.prototype.difference = function(a, b) { return { x: a.x - b.x, y: a.y - b.y } }, a.fn.owlCarousel = function(b) { var c = Array.prototype.slice.call(arguments, 1); return this.each(function() { var d = a(this),
                f = d.data("owl.carousel");
            f || (f = new e(this, "object" == typeof b && b), d.data("owl.carousel", f), a.each(["next", "prev", "to", "destroy", "refresh", "replace", "add", "remove"], function(b, c) { f.register({ type: e.Type.Event, name: c }), f.$element.on(c + ".owl.carousel.core", a.proxy(function(a) { a.namespace && a.relatedTarget !== this && (this.suppress([c]), f[c].apply(this, [].slice.call(arguments, 1)), this.release([c])) }, f)) })), "string" == typeof b && "_" !== b.charAt(0) && f[b].apply(f, c) }) }, a.fn.owlCarousel.Constructor = e }(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) { var e = function(b) { this._core = b, this._interval = null, this._visible = null, this._handlers = { "initialized.owl.carousel": a.proxy(function(a) { a.namespace && this._core.settings.autoRefresh && this.watch() }, this) }, this._core.options = a.extend({}, e.Defaults, this._core.options), this._core.$element.on(this._handlers) };
    e.Defaults = { autoRefresh: !0, autoRefreshInterval: 500 }, e.prototype.watch = function() { this._interval || (this._visible = this._core.$element.is(":visible"), this._interval = b.setInterval(a.proxy(this.refresh, this), this._core.settings.autoRefreshInterval)) }, e.prototype.refresh = function() { this._core.$element.is(":visible") !== this._visible && (this._visible = !this._visible, this._core.$element.toggleClass("owl-hidden", !this._visible), this._visible && this._core.invalidate("width") && this._core.refresh()) }, e.prototype.destroy = function() { var a, c;
        b.clearInterval(this._interval); for (a in this._handlers) this._core.$element.off(a, this._handlers[a]); for (c in Object.getOwnPropertyNames(this)) "function" != typeof this[c] && (this[c] = null) }, a.fn.owlCarousel.Constructor.Plugins.AutoRefresh = e }(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) { var e = function(b) { this._core = b, this._loaded = [], this._handlers = { "initialized.owl.carousel change.owl.carousel resized.owl.carousel": a.proxy(function(b) { if (b.namespace && this._core.settings && this._core.settings.lazyLoad && (b.property && "position" == b.property.name || "initialized" == b.type))
                    for (var c = this._core.settings, e = c.center && Math.ceil(c.items / 2) || c.items, f = c.center && -1 * e || 0, g = (b.property && b.property.value !== d ? b.property.value : this._core.current()) + f, h = this._core.clones().length, i = a.proxy(function(a, b) { this.load(b) }, this); f++ < e;) this.load(h / 2 + this._core.relative(g)), h && a.each(this._core.clones(this._core.relative(g)), i), g++ }, this) }, this._core.options = a.extend({}, e.Defaults, this._core.options), this._core.$element.on(this._handlers) };
    e.Defaults = { lazyLoad: !1 }, e.prototype.load = function(c) { var d = this._core.$stage.children().eq(c),
            e = d && d.find(".owl-lazy");!e || a.inArray(d.get(0), this._loaded) > -1 || (e.each(a.proxy(function(c, d) { var e, f = a(d),
                g = b.devicePixelRatio > 1 && f.attr("data-src-retina") || f.attr("data-src");
            this._core.trigger("load", { element: f, url: g }, "lazy"), f.is("img") ? f.one("load.owl.lazy", a.proxy(function() { f.css("opacity", 1), this._core.trigger("loaded", { element: f, url: g }, "lazy") }, this)).attr("src", g) : (e = new Image, e.onload = a.proxy(function() { f.css({ "background-image": "url(" + g + ")", opacity: "1" }), this._core.trigger("loaded", { element: f, url: g }, "lazy") }, this), e.src = g) }, this)), this._loaded.push(d.get(0))) }, e.prototype.destroy = function() { var a, b; for (a in this.handlers) this._core.$element.off(a, this.handlers[a]); for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null) }, a.fn.owlCarousel.Constructor.Plugins.Lazy = e }(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) { var e = function(b) { this._core = b, this._handlers = { "initialized.owl.carousel refreshed.owl.carousel": a.proxy(function(a) { a.namespace && this._core.settings.autoHeight && this.update() }, this), "changed.owl.carousel": a.proxy(function(a) { a.namespace && this._core.settings.autoHeight && "position" == a.property.name && this.update() }, this), "loaded.owl.lazy": a.proxy(function(a) { a.namespace && this._core.settings.autoHeight && a.element.closest("." + this._core.settings.itemClass).index() === this._core.current() && this.update() }, this) }, this._core.options = a.extend({}, e.Defaults, this._core.options), this._core.$element.on(this._handlers) };
    e.Defaults = { autoHeight: !1, autoHeightClass: "owl-height" }, e.prototype.update = function() { var b = this._core._current,
            c = b + this._core.settings.items,
            d = this._core.$stage.children().toArray().slice(b, c),
            e = [],
            f = 0;
        a.each(d, function(b, c) { e.push(a(c).height()) }), f = Math.max.apply(null, e), this._core.$stage.parent().height(f).addClass(this._core.settings.autoHeightClass) }, e.prototype.destroy = function() { var a, b; for (a in this._handlers) this._core.$element.off(a, this._handlers[a]); for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null) }, a.fn.owlCarousel.Constructor.Plugins.AutoHeight = e }(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) { var e = function(b) { this._core = b, this._videos = {}, this._playing = null, this._handlers = { "initialized.owl.carousel": a.proxy(function(a) { a.namespace && this._core.register({ type: "state", name: "playing", tags: ["interacting"] }) }, this), "resize.owl.carousel": a.proxy(function(a) { a.namespace && this._core.settings.video && this.isInFullScreen() && a.preventDefault() }, this), "refreshed.owl.carousel": a.proxy(function(a) { a.namespace && this._core.is("resizing") && this._core.$stage.find(".cloned .owl-video-frame").remove() }, this), "changed.owl.carousel": a.proxy(function(a) { a.namespace && "position" === a.property.name && this._playing && this.stop() }, this), "prepared.owl.carousel": a.proxy(function(b) { if (b.namespace) { var c = a(b.content).find(".owl-video");
                    c.length && (c.css("display", "none"), this.fetch(c, a(b.content))) } }, this) }, this._core.options = a.extend({}, e.Defaults, this._core.options), this._core.$element.on(this._handlers), this._core.$element.on("click.owl.video", ".owl-video-play-icon", a.proxy(function(a) { this.play(a) }, this)) };
    e.Defaults = { video: !1, videoHeight: !1, videoWidth: !1 }, e.prototype.fetch = function(a, b) { var c = function() { return a.attr("data-vimeo-id") ? "vimeo" : a.attr("data-vzaar-id") ? "vzaar" : "youtube" }(),
            d = a.attr("data-vimeo-id") || a.attr("data-youtube-id") || a.attr("data-vzaar-id"),
            e = a.attr("data-width") || this._core.settings.videoWidth,
            f = a.attr("data-height") || this._core.settings.videoHeight,
            g = a.attr("href"); if (!g) throw new Error("Missing video URL."); if (d = g.match(/(http:|https:|)\/\/(player.|www.|app.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com)|vzaar\.com)\/(video\/|videos\/|embed\/|channels\/.+\/|groups\/.+\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/), d[3].indexOf("youtu") > -1) c = "youtube";
        else if (d[3].indexOf("vimeo") > -1) c = "vimeo";
        else { if (!(d[3].indexOf("vzaar") > -1)) throw new Error("Video URL not supported.");
            c = "vzaar" } d = d[6], this._videos[g] = { type: c, id: d, width: e, height: f }, b.attr("data-video", g), this.thumbnail(a, this._videos[g]) }, e.prototype.thumbnail = function(b, c) { var d, e, f, g = c.width && c.height ? 'style="width:' + c.width + "px;height:" + c.height + 'px;"' : "",
            h = b.find("img"),
            i = "src",
            j = "",
            k = this._core.settings,
            l = function(a) { e = '<div class="owl-video-play-icon"></div>', d = k.lazyLoad ? '<div class="owl-video-tn ' + j + '" ' + i + '="' + a + '"></div>' : '<div class="owl-video-tn" style="opacity:1;background-image:url(' + a + ')"></div>', b.after(d), b.after(e) }; return b.wrap('<div class="owl-video-wrapper"' + g + "></div>"), this._core.settings.lazyLoad && (i = "data-src", j = "owl-lazy"), h.length ? (l(h.attr(i)), h.remove(), !1) : void("youtube" === c.type ? (f = "//img.youtube.com/vi/" + c.id + "/hqdefault.jpg", l(f)) : "vimeo" === c.type ? a.ajax({ type: "GET", url: "//vimeo.com/api/v2/video/" + c.id + ".json", jsonp: "callback", dataType: "jsonp", success: function(a) { f = a[0].thumbnail_large, l(f) } }) : "vzaar" === c.type && a.ajax({ type: "GET", url: "//vzaar.com/api/videos/" + c.id + ".json", jsonp: "callback", dataType: "jsonp", success: function(a) { f = a.framegrab_url, l(f) } })) }, e.prototype.stop = function() { this._core.trigger("stop", null, "video"), this._playing.find(".owl-video-frame").remove(), this._playing.removeClass("owl-video-playing"), this._playing = null, this._core.leave("playing"), this._core.trigger("stopped", null, "video") }, e.prototype.play = function(b) { var c, d = a(b.target),
            e = d.closest("." + this._core.settings.itemClass),
            f = this._videos[e.attr("data-video")],
            g = f.width || "100%",
            h = f.height || this._core.$stage.height();
        this._playing || (this._core.enter("playing"), this._core.trigger("play", null, "video"), e = this._core.items(this._core.relative(e.index())), this._core.reset(e.index()), "youtube" === f.type ? c = '<iframe width="' + g + '" height="' + h + '" src="//www.youtube.com/embed/' + f.id + "?autoplay=1&v=" + f.id + '" frameborder="0" allowfullscreen></iframe>' : "vimeo" === f.type ? c = '<iframe src="//player.vimeo.com/video/' + f.id + '?autoplay=1" width="' + g + '" height="' + h + '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>' : "vzaar" === f.type && (c = '<iframe frameborder="0"height="' + h + '"width="' + g + '" allowfullscreen mozallowfullscreen webkitAllowFullScreen src="//view.vzaar.com/' + f.id + '/player?autoplay=true"></iframe>'), a('<div class="owl-video-frame">' + c + "</div>").insertAfter(e.find(".owl-video")), this._playing = e.addClass("owl-video-playing")) }, e.prototype.isInFullScreen = function() { var b = c.fullscreenElement || c.mozFullScreenElement || c.webkitFullscreenElement; return b && a(b).parent().hasClass("owl-video-frame") }, e.prototype.destroy = function() { var a, b;
        this._core.$element.off("click.owl.video"); for (a in this._handlers) this._core.$element.off(a, this._handlers[a]); for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null) }, a.fn.owlCarousel.Constructor.Plugins.Video = e }(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) { var e = function(b) { this.core = b, this.core.options = a.extend({}, e.Defaults, this.core.options), this.swapping = !0, this.previous = d, this.next = d, this.handlers = { "change.owl.carousel": a.proxy(function(a) { a.namespace && "position" == a.property.name && (this.previous = this.core.current(), this.next = a.property.value) }, this), "drag.owl.carousel dragged.owl.carousel translated.owl.carousel": a.proxy(function(a) { a.namespace && (this.swapping = "translated" == a.type) }, this), "translate.owl.carousel": a.proxy(function(a) { a.namespace && this.swapping && (this.core.options.animateOut || this.core.options.animateIn) && this.swap() }, this) }, this.core.$element.on(this.handlers) };
    e.Defaults = { animateOut: !1, animateIn: !1 }, e.prototype.swap = function() { if (1 === this.core.settings.items && a.support.animation && a.support.transition) { this.core.speed(0); var b, c = a.proxy(this.clear, this),
                d = this.core.$stage.children().eq(this.previous),
                e = this.core.$stage.children().eq(this.next),
                f = this.core.settings.animateIn,
                g = this.core.settings.animateOut;
            this.core.current() !== this.previous && (g && (b = this.core.coordinates(this.previous) - this.core.coordinates(this.next), d.one(a.support.animation.end, c).css({ left: b + "px" }).addClass("animated owl-animated-out").addClass(g)), f && e.one(a.support.animation.end, c).addClass("animated owl-animated-in").addClass(f)) } }, e.prototype.clear = function(b) { a(b.target).css({ left: "" }).removeClass("animated owl-animated-out owl-animated-in").removeClass(this.core.settings.animateIn).removeClass(this.core.settings.animateOut), this.core.onTransitionEnd() }, e.prototype.destroy = function() { var a, b; for (a in this.handlers) this.core.$element.off(a, this.handlers[a]); for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null); }, a.fn.owlCarousel.Constructor.Plugins.Animate = e }(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) { var e = function(b) { this._core = b, this._timeout = null, this._paused = !1, this._handlers = { "changed.owl.carousel": a.proxy(function(a) { a.namespace && "settings" === a.property.name ? this._core.settings.autoplay ? this.play() : this.stop() : a.namespace && "position" === a.property.name && this._core.settings.autoplay && this._setAutoPlayInterval() }, this), "initialized.owl.carousel": a.proxy(function(a) { a.namespace && this._core.settings.autoplay && this.play() }, this), "play.owl.autoplay": a.proxy(function(a, b, c) { a.namespace && this.play(b, c) }, this), "stop.owl.autoplay": a.proxy(function(a) { a.namespace && this.stop() }, this), "mouseover.owl.autoplay": a.proxy(function() { this._core.settings.autoplayHoverPause && this._core.is("rotating") && this.pause() }, this), "mouseleave.owl.autoplay": a.proxy(function() { this._core.settings.autoplayHoverPause && this._core.is("rotating") && this.play() }, this), "touchstart.owl.core": a.proxy(function() { this._core.settings.autoplayHoverPause && this._core.is("rotating") && this.pause() }, this), "touchend.owl.core": a.proxy(function() { this._core.settings.autoplayHoverPause && this.play() }, this) }, this._core.$element.on(this._handlers), this._core.options = a.extend({}, e.Defaults, this._core.options) };
    e.Defaults = { autoplay: !1, autoplayTimeout: 5e3, autoplayHoverPause: !1, autoplaySpeed: !1 }, e.prototype.play = function(a, b) { this._paused = !1, this._core.is("rotating") || (this._core.enter("rotating"), this._setAutoPlayInterval()) }, e.prototype._getNextTimeout = function(d, e) { return this._timeout && b.clearTimeout(this._timeout), b.setTimeout(a.proxy(function() { this._paused || this._core.is("busy") || this._core.is("interacting") || c.hidden || this._core.next(e || this._core.settings.autoplaySpeed) }, this), d || this._core.settings.autoplayTimeout) }, e.prototype._setAutoPlayInterval = function() { this._timeout = this._getNextTimeout() }, e.prototype.stop = function() { this._core.is("rotating") && (b.clearTimeout(this._timeout), this._core.leave("rotating")) }, e.prototype.pause = function() { this._core.is("rotating") && (this._paused = !0) }, e.prototype.destroy = function() { var a, b;
        this.stop(); for (a in this._handlers) this._core.$element.off(a, this._handlers[a]); for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null) }, a.fn.owlCarousel.Constructor.Plugins.autoplay = e }(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) { "use strict"; var e = function(b) { this._core = b, this._initialized = !1, this._pages = [], this._controls = {}, this._templates = [], this.$element = this._core.$element, this._overrides = { next: this._core.next, prev: this._core.prev, to: this._core.to }, this._handlers = { "prepared.owl.carousel": a.proxy(function(b) { b.namespace && this._core.settings.dotsData && this._templates.push('<div class="' + this._core.settings.dotClass + '">' + a(b.content).find("[data-dot]").addBack("[data-dot]").attr("data-dot") + "</div>") }, this), "added.owl.carousel": a.proxy(function(a) { a.namespace && this._core.settings.dotsData && this._templates.splice(a.position, 0, this._templates.pop()) }, this), "remove.owl.carousel": a.proxy(function(a) { a.namespace && this._core.settings.dotsData && this._templates.splice(a.position, 1) }, this), "changed.owl.carousel": a.proxy(function(a) { a.namespace && "position" == a.property.name && this.draw() }, this), "initialized.owl.carousel": a.proxy(function(a) { a.namespace && !this._initialized && (this._core.trigger("initialize", null, "navigation"), this.initialize(), this.update(), this.draw(), this._initialized = !0, this._core.trigger("initialized", null, "navigation")) }, this), "refreshed.owl.carousel": a.proxy(function(a) { a.namespace && this._initialized && (this._core.trigger("refresh", null, "navigation"), this.update(), this.draw(), this._core.trigger("refreshed", null, "navigation")) }, this) }, this._core.options = a.extend({}, e.Defaults, this._core.options), this.$element.on(this._handlers) };
    e.Defaults = { nav: !1, navText: ["prev", "next"], navSpeed: !1, navElement: "div", navContainer: !1, navContainerClass: "owl-nav", navClass: ["owl-prev", "owl-next"], slideBy: 1, dotClass: "owl-dot", dotsClass: "owl-dots", dots: !0, dotsEach: !1, dotsData: !1, dotsSpeed: !1, dotsContainer: !1 }, e.prototype.initialize = function() { var b, c = this._core.settings;
        this._controls.$relative = (c.navContainer ? a(c.navContainer) : a("<div>").addClass(c.navContainerClass).appendTo(this.$element)).addClass("disabled"), this._controls.$previous = a("<" + c.navElement + ">").addClass(c.navClass[0]).html(c.navText[0]).prependTo(this._controls.$relative).on("click", a.proxy(function(a) { this.prev(c.navSpeed) }, this)), this._controls.$next = a("<" + c.navElement + ">").addClass(c.navClass[1]).html(c.navText[1]).appendTo(this._controls.$relative).on("click", a.proxy(function(a) { this.next(c.navSpeed) }, this)), c.dotsData || (this._templates = [a("<div>").addClass(c.dotClass).append(a("<span>")).prop("outerHTML")]), this._controls.$absolute = (c.dotsContainer ? a(c.dotsContainer) : a("<div>").addClass(c.dotsClass).appendTo(this.$element)).addClass("disabled"), this._controls.$absolute.on("click", "div", a.proxy(function(b) { var d = a(b.target).parent().is(this._controls.$absolute) ? a(b.target).index() : a(b.target).parent().index();
            b.preventDefault(), this.to(d, c.dotsSpeed) }, this)); for (b in this._overrides) this._core[b] = a.proxy(this[b], this) }, e.prototype.destroy = function() { var a, b, c, d; for (a in this._handlers) this.$element.off(a, this._handlers[a]); for (b in this._controls) this._controls[b].remove(); for (d in this.overides) this._core[d] = this._overrides[d]; for (c in Object.getOwnPropertyNames(this)) "function" != typeof this[c] && (this[c] = null) }, e.prototype.update = function() { var a, b, c, d = this._core.clones().length / 2,
            e = d + this._core.items().length,
            f = this._core.maximum(!0),
            g = this._core.settings,
            h = g.center || g.autoWidth || g.dotsData ? 1 : g.dotsEach || g.items; if ("page" !== g.slideBy && (g.slideBy = Math.min(g.slideBy, g.items)), g.dots || "page" == g.slideBy)
            for (this._pages = [], a = d, b = 0, c = 0; e > a; a++) { if (b >= h || 0 === b) { if (this._pages.push({ start: Math.min(f, a - d), end: a - d + h - 1 }), Math.min(f, a - d) === f) break;
                    b = 0, ++c } b += this._core.mergers(this._core.relative(a)) } }, e.prototype.draw = function() { var b, c = this._core.settings,
            d = this._core.items().length <= c.items,
            e = this._core.relative(this._core.current()),
            f = c.loop || c.rewind;
        this._controls.$relative.toggleClass("disabled", !c.nav || d), c.nav && (this._controls.$previous.toggleClass("disabled", !f && e <= this._core.minimum(!0)), this._controls.$next.toggleClass("disabled", !f && e >= this._core.maximum(!0))), this._controls.$absolute.toggleClass("disabled", !c.dots || d), c.dots && (b = this._pages.length - this._controls.$absolute.children().length, c.dotsData && 0 !== b ? this._controls.$absolute.html(this._templates.join("")) : b > 0 ? this._controls.$absolute.append(new Array(b + 1).join(this._templates[0])) : 0 > b && this._controls.$absolute.children().slice(b).remove(), this._controls.$absolute.find(".active").removeClass("active"), this._controls.$absolute.children().eq(a.inArray(this.current(), this._pages)).addClass("active")) }, e.prototype.onTrigger = function(b) { var c = this._core.settings;
        b.page = { index: a.inArray(this.current(), this._pages), count: this._pages.length, size: c && (c.center || c.autoWidth || c.dotsData ? 1 : c.dotsEach || c.items) } }, e.prototype.current = function() { var b = this._core.relative(this._core.current()); return a.grep(this._pages, a.proxy(function(a, c) { return a.start <= b && a.end >= b }, this)).pop() }, e.prototype.getPosition = function(b) { var c, d, e = this._core.settings; return "page" == e.slideBy ? (c = a.inArray(this.current(), this._pages), d = this._pages.length, b ? ++c : --c, c = this._pages[(c % d + d) % d].start) : (c = this._core.relative(this._core.current()), d = this._core.items().length, b ? c += e.slideBy : c -= e.slideBy), c }, e.prototype.next = function(b) { a.proxy(this._overrides.to, this._core)(this.getPosition(!0), b) }, e.prototype.prev = function(b) { a.proxy(this._overrides.to, this._core)(this.getPosition(!1), b) }, e.prototype.to = function(b, c, d) { var e;!d && this._pages.length ? (e = this._pages.length, a.proxy(this._overrides.to, this._core)(this._pages[(b % e + e) % e].start, c)) : a.proxy(this._overrides.to, this._core)(b, c) }, a.fn.owlCarousel.Constructor.Plugins.Navigation = e }(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) { "use strict"; var e = function(c) { this._core = c, this._hashes = {}, this.$element = this._core.$element, this._handlers = { "initialized.owl.carousel": a.proxy(function(c) { c.namespace && "URLHash" === this._core.settings.startPosition && a(b).trigger("hashchange.owl.navigation") }, this), "prepared.owl.carousel": a.proxy(function(b) { if (b.namespace) { var c = a(b.content).find("[data-hash]").addBack("[data-hash]").attr("data-hash"); if (!c) return;
                    this._hashes[c] = b.content } }, this), "changed.owl.carousel": a.proxy(function(c) { if (c.namespace && "position" === c.property.name) { var d = this._core.items(this._core.relative(this._core.current())),
                        e = a.map(this._hashes, function(a, b) { return a === d ? b : null }).join(); if (!e || b.location.hash.slice(1) === e) return;
                    b.location.hash = e } }, this) }, this._core.options = a.extend({}, e.Defaults, this._core.options), this.$element.on(this._handlers), a(b).on("hashchange.owl.navigation", a.proxy(function(a) { var c = b.location.hash.substring(1),
                e = this._core.$stage.children(),
                f = this._hashes[c] && e.index(this._hashes[c]);
            f !== d && f !== this._core.current() && this._core.to(this._core.relative(f), !1, !0) }, this)) };
    e.Defaults = { URLhashListener: !1 }, e.prototype.destroy = function() { var c, d;
        a(b).off("hashchange.owl.navigation"); for (c in this._handlers) this._core.$element.off(c, this._handlers[c]); for (d in Object.getOwnPropertyNames(this)) "function" != typeof this[d] && (this[d] = null) }, a.fn.owlCarousel.Constructor.Plugins.Hash = e }(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) {
    function e(b, c) { var e = !1,
            f = b.charAt(0).toUpperCase() + b.slice(1); return a.each((b + " " + h.join(f + " ") + f).split(" "), function(a, b) { return g[b] !== d ? (e = c ? b : !0, !1) : void 0 }), e }

    function f(a) { return e(a, !0) } var g = a("<support>").get(0).style,
        h = "Webkit Moz O ms".split(" "),
        i = { transition: { end: { WebkitTransition: "webkitTransitionEnd", MozTransition: "transitionend", OTransition: "oTransitionEnd", transition: "transitionend" } }, animation: { end: { WebkitAnimation: "webkitAnimationEnd", MozAnimation: "animationend", OAnimation: "oAnimationEnd", animation: "animationend" } } },
        j = { csstransforms: function() { return !!e("transform") }, csstransforms3d: function() { return !!e("perspective") }, csstransitions: function() { return !!e("transition") }, cssanimations: function() { return !!e("animation") } };
    j.csstransitions() && (a.support.transition = new String(f("transition")), a.support.transition.end = i.transition.end[a.support.transition]), j.cssanimations() && (a.support.animation = new String(f("animation")), a.support.animation.end = i.animation.end[a.support.animation]), j.csstransforms() && (a.support.transform = new String(f("transform")), a.support.transform3d = j.csstransforms3d()) }(window.Zepto || window.jQuery, window, document);;
(function($) { var CLOSE_EVENT = 'Close',
        BEFORE_CLOSE_EVENT = 'BeforeClose',
        AFTER_CLOSE_EVENT = 'AfterClose',
        BEFORE_APPEND_EVENT = 'BeforeAppend',
        MARKUP_PARSE_EVENT = 'MarkupParse',
        OPEN_EVENT = 'Open',
        CHANGE_EVENT = 'Change',
        NS = 'mfp',
        EVENT_NS = '.' + NS,
        READY_CLASS = 'mfp-ready',
        REMOVING_CLASS = 'mfp-removing',
        PREVENT_CLOSE_CLASS = 'mfp-prevent-close'; var mfp, MagnificPopup = function() {},
        _isJQ = !!(window.jQuery),
        _prevStatus, _window = $(window),
        _body, _document, _prevContentType, _wrapClasses, _currPopupType; var _mfpOn = function(name, f) { mfp.ev.on(NS + name + EVENT_NS, f); },
        _getEl = function(className, appendTo, html, raw) { var el = document.createElement('div');
            el.className = 'mfp-' + className; if (html) { el.innerHTML = html; } if (!raw) { el = $(el); if (appendTo) { el.appendTo(appendTo); } } else if (appendTo) { appendTo.appendChild(el); } return el; },
        _mfpTrigger = function(e, data) { mfp.ev.triggerHandler(NS + e, data); if (mfp.st.callbacks) { e = e.charAt(0).toLowerCase() + e.slice(1); if (mfp.st.callbacks[e]) { mfp.st.callbacks[e].apply(mfp, $.isArray(data) ? data : [data]); } } },
        _setFocus = function() {
            (mfp.st.focus ? mfp.content.find(mfp.st.focus).eq(0) : mfp.wrap).trigger('focus'); },
        _getCloseBtn = function(type) { if (type !== _currPopupType || !mfp.currTemplate.closeBtn) { mfp.currTemplate.closeBtn = $(mfp.st.closeMarkup.replace('%title%', mfp.st.tClose));
                _currPopupType = type; } return mfp.currTemplate.closeBtn; },
        _checkInstance = function() { if (!$.magnificPopup.instance) { mfp = new MagnificPopup();
                mfp.init();
                $.magnificPopup.instance = mfp; } },
        _checkIfClose = function(target) { if ($(target).hasClass(PREVENT_CLOSE_CLASS)) { return; } var closeOnContent = mfp.st.closeOnContentClick; var closeOnBg = mfp.st.closeOnBgClick; if (closeOnContent && closeOnBg) { return true; } else { if (!mfp.content || $(target).hasClass('mfp-close') || (mfp.preloader && target === mfp.preloader[0])) { return true; } if ((target !== mfp.content[0] && !$.contains(mfp.content[0], target))) { if (closeOnBg) { if ($.contains(document, target)) { return true; } } } else if (closeOnContent) { return true; } } return false; },
        supportsTransitions = function() { var s = document.createElement('p').style,
                v = ['ms', 'O', 'Moz', 'Webkit']; if (s['transition'] !== undefined) { return true; } while (v.length) { if (v.pop() + 'Transition' in s) { return true; } } return false; };
    MagnificPopup.prototype = { constructor: MagnificPopup, init: function() { var appVersion = navigator.appVersion;
            mfp.isIE7 = appVersion.indexOf("MSIE 7.") !== -1;
            mfp.isIE8 = appVersion.indexOf("MSIE 8.") !== -1;
            mfp.isLowIE = mfp.isIE7 || mfp.isIE8;
            mfp.isAndroid = (/android/gi).test(appVersion);
            mfp.isIOS = (/iphone|ipad|ipod/gi).test(appVersion);
            mfp.supportsTransition = supportsTransitions();
            mfp.probablyMobile = (mfp.isAndroid || mfp.isIOS || /(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent));
            _body = $(document.body);
            _document = $(document);
            mfp.popupsCache = {}; }, open: function(data) { var i; if (data.isObj === false) { mfp.items = data.items.toArray();
                mfp.index = 0; var items = data.items,
                    item; for (i = 0; i < items.length; i++) { item = items[i]; if (item.parsed) { item = item.el[0]; } if (item === data.el[0]) { mfp.index = i; break; } } } else { mfp.items = $.isArray(data.items) ? data.items : [data.items];
                mfp.index = data.index || 0; } if (mfp.isOpen) { mfp.updateItemHTML(); return; } mfp.types = [];
            _wrapClasses = ''; if (data.mainEl && data.mainEl.length) { mfp.ev = data.mainEl.eq(0); } else { mfp.ev = _document; } if (data.key) { if (!mfp.popupsCache[data.key]) { mfp.popupsCache[data.key] = {}; } mfp.currTemplate = mfp.popupsCache[data.key]; } else { mfp.currTemplate = {}; } mfp.st = $.extend(true, {}, $.magnificPopup.defaults, data);
            mfp.fixedContentPos = mfp.st.fixedContentPos === 'auto' ? !mfp.probablyMobile : mfp.st.fixedContentPos; if (mfp.st.modal) { mfp.st.closeOnContentClick = false;
                mfp.st.closeOnBgClick = false;
                mfp.st.showCloseBtn = false;
                mfp.st.enableEscapeKey = false; } if (!mfp.bgOverlay) { mfp.bgOverlay = _getEl('bg').on('click' + EVENT_NS, function() { mfp.close(); });
                mfp.wrap = _getEl('wrap').attr('tabindex', -1).on('click' + EVENT_NS, function(e) { if (_checkIfClose(e.target)) { mfp.close(); } });
                mfp.container = _getEl('container', mfp.wrap); } mfp.contentContainer = _getEl('content'); if (mfp.st.preloader) { mfp.preloader = _getEl('preloader', mfp.container, mfp.st.tLoading); } var modules = $.magnificPopup.modules; for (i = 0; i < modules.length; i++) { var n = modules[i];
                n = n.charAt(0).toUpperCase() + n.slice(1);
                mfp['init' + n].call(mfp); } _mfpTrigger('BeforeOpen'); if (mfp.st.showCloseBtn) { if (!mfp.st.closeBtnInside) { mfp.wrap.append(_getCloseBtn()); } else { _mfpOn(MARKUP_PARSE_EVENT, function(e, template, values, item) { values.close_replaceWith = _getCloseBtn(item.type); });
                    _wrapClasses += ' mfp-close-btn-in'; } } if (mfp.st.alignTop) { _wrapClasses += ' mfp-align-top'; } if (mfp.fixedContentPos) { mfp.wrap.css({ overflow: mfp.st.overflowY, overflowX: 'hidden', overflowY: mfp.st.overflowY }); } else { mfp.wrap.css({ top: _window.scrollTop(), position: 'absolute' }); } if (mfp.st.fixedBgPos === false || (mfp.st.fixedBgPos === 'auto' && !mfp.fixedContentPos)) { mfp.bgOverlay.css({ height: _document.height(), position: 'absolute' }); } if (mfp.st.enableEscapeKey) { _document.on('keyup' + EVENT_NS, function(e) { if (e.keyCode === 27) { mfp.close(); } }); } _window.on('resize' + EVENT_NS, function() { mfp.updateSize(); }); if (!mfp.st.closeOnContentClick) { _wrapClasses += ' mfp-auto-cursor'; } if (_wrapClasses) mfp.wrap.addClass(_wrapClasses); var windowHeight = mfp.wH = _window.height(); var windowStyles = {}; if (mfp.fixedContentPos) { if (mfp._hasScrollBar(windowHeight)) { var s = mfp._getScrollbarSize(); if (s) { windowStyles.paddingRight = s; } } } if (mfp.fixedContentPos) { if (!mfp.isIE7) { windowStyles.overflow = 'hidden'; } else { $('body, html').css('overflow', 'hidden'); } } var classesToadd = mfp.st.mainClass; if (mfp.isIE7) { classesToadd += ' mfp-ie7'; } if (classesToadd) { mfp._addClassToMFP(classesToadd); } mfp.updateItemHTML();
            _mfpTrigger('BuildControls');
            $('html').css(windowStyles);
            mfp.bgOverlay.add(mfp.wrap).prependTo(document.body);
            mfp._lastFocusedEl = document.activeElement;
            setTimeout(function() { if (mfp.content) { mfp._addClassToMFP(READY_CLASS);
                    _setFocus(); } else { mfp.bgOverlay.addClass(READY_CLASS); } _document.on('focusin' + EVENT_NS, function(e) { if (e.target !== mfp.wrap[0] && !$.contains(mfp.wrap[0], e.target)) { _setFocus(); return false; } }); }, 16);
            mfp.isOpen = true;
            mfp.updateSize(windowHeight);
            _mfpTrigger(OPEN_EVENT); }, close: function() { if (!mfp.isOpen) return;
            _mfpTrigger(BEFORE_CLOSE_EVENT);
            mfp.isOpen = false; if (mfp.st.removalDelay && !mfp.isLowIE && mfp.supportsTransition) { mfp._addClassToMFP(REMOVING_CLASS);
                setTimeout(function() { mfp._close(); }, mfp.st.removalDelay); } else { mfp._close(); } }, _close: function() { _mfpTrigger(CLOSE_EVENT); var classesToRemove = REMOVING_CLASS + ' ' + READY_CLASS + ' ';
            mfp.bgOverlay.detach();
            mfp.wrap.detach();
            mfp.container.empty(); if (mfp.st.mainClass) { classesToRemove += mfp.st.mainClass + ' '; } mfp._removeClassFromMFP(classesToRemove); if (mfp.fixedContentPos) { var windowStyles = { paddingRight: '' }; if (mfp.isIE7) { $('body, html').css('overflow', ''); } else { windowStyles.overflow = ''; } $('html').css(windowStyles); } _document.off('keyup' + EVENT_NS + ' focusin' + EVENT_NS);
            mfp.ev.off(EVENT_NS);
            mfp.wrap.attr('class', 'mfp-wrap').removeAttr('style');
            mfp.bgOverlay.attr('class', 'mfp-bg');
            mfp.container.attr('class', 'mfp-container'); if (mfp.st.showCloseBtn && (!mfp.st.closeBtnInside || mfp.currTemplate[mfp.currItem.type] === true)) { if (mfp.currTemplate.closeBtn) mfp.currTemplate.closeBtn.detach(); } if (mfp._lastFocusedEl) { $(mfp._lastFocusedEl).trigger('focus'); } mfp.currItem = null;
            mfp.content = null;
            mfp.currTemplate = null;
            mfp.prevHeight = 0;
            _mfpTrigger(AFTER_CLOSE_EVENT); }, updateSize: function(winHeight) { if (mfp.isIOS) { var zoomLevel = document.documentElement.clientWidth / window.innerWidth; var height = window.innerHeight * zoomLevel;
                mfp.wrap.css('height', height);
                mfp.wH = height; } else { mfp.wH = winHeight || _window.height(); } if (!mfp.fixedContentPos) { mfp.wrap.css('height', mfp.wH); } _mfpTrigger('Resize'); }, updateItemHTML: function() { var item = mfp.items[mfp.index];
            mfp.contentContainer.detach(); if (mfp.content) mfp.content.detach(); if (!item.parsed) { item = mfp.parseEl(mfp.index); } var type = item.type;
            _mfpTrigger('BeforeChange', [mfp.currItem ? mfp.currItem.type : '', type]);
            mfp.currItem = item; if (!mfp.currTemplate[type]) { var markup = mfp.st[type] ? mfp.st[type].markup : false;
                _mfpTrigger('FirstMarkupParse', markup); if (markup) { mfp.currTemplate[type] = $(markup); } else { mfp.currTemplate[type] = true; } } if (_prevContentType && _prevContentType !== item.type) { mfp.container.removeClass('mfp-' + _prevContentType + '-holder'); } var newContent = mfp['get' + type.charAt(0).toUpperCase() + type.slice(1)](item, mfp.currTemplate[type]);
            mfp.appendContent(newContent, type);
            item.preloaded = true;
            _mfpTrigger(CHANGE_EVENT, item);
            _prevContentType = item.type;
            mfp.container.prepend(mfp.contentContainer);
            _mfpTrigger('AfterChange'); }, appendContent: function(newContent, type) { mfp.content = newContent; if (newContent) { if (mfp.st.showCloseBtn && mfp.st.closeBtnInside && mfp.currTemplate[type] === true) { if (!mfp.content.find('.mfp-close').length) { mfp.content.append(_getCloseBtn()); } } else { mfp.content = newContent; } } else { mfp.content = ''; } _mfpTrigger(BEFORE_APPEND_EVENT);
            mfp.container.addClass('mfp-' + type + '-holder');
            mfp.contentContainer.append(mfp.content); }, parseEl: function(index) { var item = mfp.items[index],
                type = item.type; if (item.tagName) { item = { el: $(item) }; } else { item = { data: item, src: item.src }; } if (item.el) { var types = mfp.types; for (var i = 0; i < types.length; i++) { if (item.el.hasClass('mfp-' + types[i])) { type = types[i]; break; } } item.src = item.el.attr('data-mfp-src'); if (!item.src) { item.src = item.el.attr('href'); } } item.type = type || mfp.st.type || 'inline';
            item.index = index;
            item.parsed = true;
            mfp.items[index] = item;
            _mfpTrigger('ElementParse', item); return mfp.items[index]; }, addGroup: function(el, options) { var eHandler = function(e) { e.mfpEl = this;
                mfp._openClick(e, el, options); }; if (!options) { options = {}; } var eName = 'click.magnificPopup';
            options.mainEl = el; if (options.items) { options.isObj = true;
                el.off(eName).on(eName, eHandler); } else { options.isObj = false; if (options.delegate) { el.off(eName).on(eName, options.delegate, eHandler); } else { options.items = el;
                    el.off(eName).on(eName, eHandler); } } }, _openClick: function(e, el, options) { var midClick = options.midClick !== undefined ? options.midClick : $.magnificPopup.defaults.midClick; if (!midClick && (e.which === 2 || e.ctrlKey || e.metaKey)) { return; } var disableOn = options.disableOn !== undefined ? options.disableOn : $.magnificPopup.defaults.disableOn; if (disableOn) { if ($.isFunction(disableOn)) { if (!disableOn.call(mfp)) { return true; } } else { if (_window.width() < disableOn) { return true; } } } if (e.type) { e.preventDefault(); if (mfp.isOpen) { e.stopPropagation(); } } options.el = $(e.mfpEl); if (options.delegate) { options.items = el.find(options.delegate); } mfp.open(options); }, updateStatus: function(status, text) { if (mfp.preloader) { if (_prevStatus !== status) { mfp.container.removeClass('mfp-s-' + _prevStatus); } if (!text && status === 'loading') { text = mfp.st.tLoading; } var data = { status: status, text: text };
                _mfpTrigger('UpdateStatus', data);
                status = data.status;
                text = data.text;
                mfp.preloader.html(text);
                mfp.preloader.find('a').on('click', function(e) { e.stopImmediatePropagation(); });
                mfp.container.addClass('mfp-s-' + status);
                _prevStatus = status; } }, _addClassToMFP: function(cName) { mfp.bgOverlay.addClass(cName);
            mfp.wrap.addClass(cName); }, _removeClassFromMFP: function(cName) { this.bgOverlay.removeClass(cName);
            mfp.wrap.removeClass(cName); }, _hasScrollBar: function(winHeight) { return ((mfp.isIE7 ? _document.height() : document.body.scrollHeight) > (winHeight || _window.height())); }, _parseMarkup: function(template, values, item) { var arr; if (item.data) { values = $.extend(item.data, values); } _mfpTrigger(MARKUP_PARSE_EVENT, [template, values, item]);
            $.each(values, function(key, value) { if (value === undefined || value === false) { return true; } arr = key.split('_'); if (arr.length > 1) { var el = template.find(EVENT_NS + '-' + arr[0]); if (el.length > 0) { var attr = arr[1]; if (attr === 'replaceWith') { if (el[0] !== value[0]) { el.replaceWith(value); } } else if (attr === 'img') { if (el.is('img')) { el.attr('src', value); } else { el.replaceWith('<img src="' + value + '" class="' + el.attr('class') + '" />'); } } else { el.attr(arr[1], value); } } } else { template.find(EVENT_NS + '-' + key).html(value); } }); }, _getScrollbarSize: function() { if (mfp.scrollbarSize === undefined) { var scrollDiv = document.createElement("div");
                scrollDiv.id = "mfp-sbm";
                scrollDiv.style.cssText = 'width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;';
                document.body.appendChild(scrollDiv);
                mfp.scrollbarSize = scrollDiv.offsetWidth - scrollDiv.clientWidth;
                document.body.removeChild(scrollDiv); } return mfp.scrollbarSize; } };
    $.magnificPopup = { instance: null, proto: MagnificPopup.prototype, modules: [], open: function(options, index) { _checkInstance(); if (!options) options = {};
            options.isObj = true;
            options.index = index || 0; return this.instance.open(options); }, close: function() { return $.magnificPopup.instance.close(); }, registerModule: function(name, module) { if (module.options) { $.magnificPopup.defaults[name] = module.options; } $.extend(this.proto, module.proto);
            this.modules.push(name); }, defaults: { disableOn: 0, key: null, midClick: false, mainClass: '', preloader: true, focus: '', closeOnContentClick: false, closeOnBgClick: true, closeBtnInside: true, showCloseBtn: true, enableEscapeKey: true, modal: false, alignTop: false, removalDelay: 0, fixedContentPos: 'auto', fixedBgPos: 'auto', overflowY: 'auto', closeMarkup: '<button title="%title%" type="button" class="mfp-close">&times;</button>', tClose: 'Close (Esc)', tLoading: 'Loading...' } };
    $.fn.magnificPopup = function(options) { _checkInstance(); var jqEl = $(this); if (typeof options === "string") { if (options === 'open') { var items, itemOpts = _isJQ ? jqEl.data('magnificPopup') : jqEl[0].magnificPopup,
                    index = parseInt(arguments[1], 10) || 0; if (itemOpts.items) { items = itemOpts.items[index]; } else { items = jqEl; if (itemOpts.delegate) { items = items.find(itemOpts.delegate); } items = items.eq(index); } mfp._openClick({ mfpEl: items }, jqEl, itemOpts); } else { if (mfp.isOpen) mfp[options].apply(mfp, Array.prototype.slice.call(arguments, 1)); } } else { if (_isJQ) { jqEl.data('magnificPopup', options); } else { jqEl[0].magnificPopup = options; } mfp.addGroup(jqEl, options); } return jqEl; }; var INLINE_NS = 'inline',
        _hiddenClass, _inlinePlaceholder, _lastInlineElement, _putInlineElementsBack = function() { if (_lastInlineElement) { _inlinePlaceholder.after(_lastInlineElement.addClass(_hiddenClass)).detach();
                _lastInlineElement = null; } };
    $.magnificPopup.registerModule(INLINE_NS, { options: { hiddenClass: 'hide', markup: '', tNotFound: 'Content not found' }, proto: { initInline: function() { mfp.types.push(INLINE_NS);
                _mfpOn(CLOSE_EVENT + '.' + INLINE_NS, function() { _putInlineElementsBack(); }); }, getInline: function(item, template) { _putInlineElementsBack(); if (item.src) { var inlineSt = mfp.st.inline,
                        el = $(item.src); if (el.length) { var parent = el[0].parentNode; if (parent && parent.tagName) { if (!_inlinePlaceholder) { _hiddenClass = inlineSt.hiddenClass;
                                _inlinePlaceholder = _getEl(_hiddenClass);
                                _hiddenClass = 'mfp-' + _hiddenClass; } _lastInlineElement = el.after(_inlinePlaceholder).detach().removeClass(_hiddenClass); } mfp.updateStatus('ready'); } else { mfp.updateStatus('error', inlineSt.tNotFound);
                        el = $('<div>'); } item.inlineElement = el; return el; } mfp.updateStatus('ready');
                mfp._parseMarkup(template, {}, item); return template; } } }); var AJAX_NS = 'ajax',
        _ajaxCur, _removeAjaxCursor = function() { if (_ajaxCur) { _body.removeClass(_ajaxCur); } };
    $.magnificPopup.registerModule(AJAX_NS, { options: { settings: null, cursor: 'mfp-ajax-cur', tError: '<a href="%url%">The content</a> could not be loaded.' }, proto: { initAjax: function() { mfp.types.push(AJAX_NS);
                _ajaxCur = mfp.st.ajax.cursor;
                _mfpOn(CLOSE_EVENT + '.' + AJAX_NS, function() { _removeAjaxCursor(); if (mfp.req) { mfp.req.abort(); } }); }, getAjax: function(item) { if (_ajaxCur) _body.addClass(_ajaxCur);
                mfp.updateStatus('loading'); var opts = $.extend({ url: item.src, success: function(data, textStatus, jqXHR) { var temp = { data: data, xhr: jqXHR };
                        _mfpTrigger('ParseAjax', temp);
                        mfp.appendContent($(temp.data), AJAX_NS);
                        item.finished = true;
                        _removeAjaxCursor();
                        _setFocus();
                        setTimeout(function() { mfp.wrap.addClass(READY_CLASS); }, 16);
                        mfp.updateStatus('ready');
                        _mfpTrigger('AjaxContentAdded'); }, error: function() { _removeAjaxCursor();
                        item.finished = item.loadError = true;
                        mfp.updateStatus('error', mfp.st.ajax.tError.replace('%url%', item.src)); } }, mfp.st.ajax.settings);
                mfp.req = $.ajax(opts); return ''; } } }); var _imgInterval, _getTitle = function(item) { if (item.data && item.data.title !== undefined) return item.data.title; var src = mfp.st.image.titleSrc; if (src) { if ($.isFunction(src)) { return src.call(mfp, item); } else if (item.el) { return item.el.attr(src) || ''; } } return ''; };
    $.magnificPopup.registerModule('image', { options: { markup: '<div class="mfp-figure">' + '<div class="mfp-close"></div>' + '<div class="mfp-img"></div>' + '<div class="mfp-bottom-bar">' + '<div class="mfp-title"></div>' + '<div class="mfp-counter"></div>' + '</div>' + '</div>', cursor: 'mfp-zoom-out-cur', titleSrc: 'title', verticalFit: true, tError: '<a href="%url%">The image</a> could not be loaded.' }, proto: { initImage: function() { var imgSt = mfp.st.image,
                    ns = '.image';
                mfp.types.push('image');
                _mfpOn(OPEN_EVENT + ns, function() { if (mfp.currItem.type === 'image' && imgSt.cursor) { _body.addClass(imgSt.cursor); } });
                _mfpOn(CLOSE_EVENT + ns, function() { if (imgSt.cursor) { _body.removeClass(imgSt.cursor); } _window.off('resize' + EVENT_NS); });
                _mfpOn('Resize' + ns, mfp.resizeImage); if (mfp.isLowIE) { _mfpOn('AfterChange', mfp.resizeImage); } }, resizeImage: function() { var item = mfp.currItem; if (!item || !item.img) return; if (mfp.st.image.verticalFit) { var decr = 0; if (mfp.isLowIE) { decr = parseInt(item.img.css('padding-top'), 10) + parseInt(item.img.css('padding-bottom'), 10); } item.img.css('max-height', mfp.wH - decr); } }, _onImageHasSize: function(item) { if (item.img) { item.hasSize = true; if (_imgInterval) { clearInterval(_imgInterval); } item.isCheckingImgSize = false;
                    _mfpTrigger('ImageHasSize', item); if (item.imgHidden) { if (mfp.content) mfp.content.removeClass('mfp-loading');
                        item.imgHidden = false; } } }, findImageSize: function(item) { var counter = 0,
                    img = item.img[0],
                    mfpSetInterval = function(delay) { if (_imgInterval) { clearInterval(_imgInterval); } _imgInterval = setInterval(function() { if (img.naturalWidth > 0) { mfp._onImageHasSize(item); return; } if (counter > 200) { clearInterval(_imgInterval); } counter++; if (counter === 3) { mfpSetInterval(10); } else if (counter === 40) { mfpSetInterval(50); } else if (counter === 100) { mfpSetInterval(500); } }, delay); };
                mfpSetInterval(1); }, getImage: function(item, template) { var guard = 0,
                    onLoadComplete = function() { if (item) { if (item.img[0].complete) { item.img.off('.mfploader'); if (item === mfp.currItem) { mfp._onImageHasSize(item);
                                    mfp.updateStatus('ready'); } item.hasSize = true;
                                item.loaded = true;
                                _mfpTrigger('ImageLoadComplete'); } else { guard++; if (guard < 200) { setTimeout(onLoadComplete, 100); } else { onLoadError(); } } } },
                    onLoadError = function() { if (item) { item.img.off('.mfploader'); if (item === mfp.currItem) { mfp._onImageHasSize(item);
                                mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src)); } item.hasSize = true;
                            item.loaded = true;
                            item.loadError = true; } },
                    imgSt = mfp.st.image; var el = template.find('.mfp-img'); if (el.length) { var img = document.createElement('img');
                    img.className = 'mfp-img';
                    item.img = $(img).on('load.mfploader', onLoadComplete).on('error.mfploader', onLoadError);
                    img.src = item.src; if (el.is('img')) { item.img = item.img.clone(); } if (item.img[0].naturalWidth > 0) { item.hasSize = true; } } mfp._parseMarkup(template, { title: _getTitle(item), img_replaceWith: item.img }, item);
                mfp.resizeImage(); if (item.hasSize) { if (_imgInterval) clearInterval(_imgInterval); if (item.loadError) { template.addClass('mfp-loading');
                        mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src)); } else { template.removeClass('mfp-loading');
                        mfp.updateStatus('ready'); } return template; } mfp.updateStatus('loading');
                item.loading = true; if (!item.hasSize) { item.imgHidden = true;
                    template.addClass('mfp-loading');
                    mfp.findImageSize(item); } return template; } } }); var hasMozTransform, getHasMozTransform = function() { if (hasMozTransform === undefined) { hasMozTransform = document.createElement('p').style.MozTransform !== undefined; } return hasMozTransform; };
    $.magnificPopup.registerModule('zoom', { options: { enabled: false, easing: 'ease-in-out', duration: 300, opener: function(element) { return element.is('img') ? element : element.find('img'); } }, proto: { initZoom: function() { var zoomSt = mfp.st.zoom,
                    ns = '.zoom'; if (!zoomSt.enabled || !mfp.supportsTransition) { return; } var duration = zoomSt.duration,
                    getElToAnimate = function(image) { var newImg = image.clone().removeAttr('style').removeAttr('class').addClass('mfp-animated-image'),
                            transition = 'all ' + (zoomSt.duration / 1000) + 's ' + zoomSt.easing,
                            cssObj = { position: 'fixed', zIndex: 9999, left: 0, top: 0, '-webkit-backface-visibility': 'hidden' },
                            t = 'transition';
                        cssObj['-webkit-' + t] = cssObj['-moz-' + t] = cssObj['-o-' + t] = cssObj[t] = transition;
                        newImg.css(cssObj); return newImg; },
                    showMainContent = function() { mfp.content.css('visibility', 'visible'); },
                    openTimeout, animatedImg;
                _mfpOn('BuildControls' + ns, function() { if (mfp._allowZoom()) { clearTimeout(openTimeout);
                        mfp.content.css('visibility', 'hidden');
                        image = mfp._getItemToZoom(); if (!image) { showMainContent(); return; } animatedImg = getElToAnimate(image);
                        animatedImg.css(mfp._getOffset());
                        mfp.wrap.append(animatedImg);
                        openTimeout = setTimeout(function() { animatedImg.css(mfp._getOffset(true));
                            openTimeout = setTimeout(function() { showMainContent();
                                setTimeout(function() { animatedImg.remove();
                                    image = animatedImg = null;
                                    _mfpTrigger('ZoomAnimationEnded'); }, 16); }, duration); }, 16); } });
                _mfpOn(BEFORE_CLOSE_EVENT + ns, function() { if (mfp._allowZoom()) { clearTimeout(openTimeout);
                        mfp.st.removalDelay = duration; if (!image) { image = mfp._getItemToZoom(); if (!image) { return; } animatedImg = getElToAnimate(image); } animatedImg.css(mfp._getOffset(true));
                        mfp.wrap.append(animatedImg);
                        mfp.content.css('visibility', 'hidden');
                        setTimeout(function() { animatedImg.css(mfp._getOffset()); }, 16); } });
                _mfpOn(CLOSE_EVENT + ns, function() { if (mfp._allowZoom()) { showMainContent(); if (animatedImg) { animatedImg.remove(); } } }); }, _allowZoom: function() { return mfp.currItem.type === 'image'; }, _getItemToZoom: function() { if (mfp.currItem.hasSize) { return mfp.currItem.img; } else { return false; } }, _getOffset: function(isLarge) { var el; if (isLarge) { el = mfp.currItem.img; } else { el = mfp.st.zoom.opener(mfp.currItem.el || mfp.currItem); } var offset = el.offset(); var paddingTop = parseInt(el.css('padding-top'), 10); var paddingBottom = parseInt(el.css('padding-bottom'), 10);
                offset.top -= ($(window).scrollTop() - paddingTop); var obj = { width: el.width(), height: (_isJQ ? el.innerHeight() : el[0].offsetHeight) - paddingBottom - paddingTop }; if (getHasMozTransform()) { obj['-moz-transform'] = obj['transform'] = 'translate(' + offset.left + 'px,' + offset.top + 'px)'; } else { obj.left = offset.left;
                    obj.top = offset.top; } return obj; } } }); var IFRAME_NS = 'iframe',
        _emptyPage = '//about:blank',
        _fixIframeBugs = function(isShowing) { if (mfp.currTemplate[IFRAME_NS]) { var el = mfp.currTemplate[IFRAME_NS].find('iframe'); if (el.length) { if (!isShowing) { el[0].src = _emptyPage; } if (mfp.isIE8) { el.css('display', isShowing ? 'block' : 'none'); } } } };
    $.magnificPopup.registerModule(IFRAME_NS, { options: { markup: '<div class="mfp-iframe-scaler">' + '<div class="mfp-close"></div>' + '<iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe>' + '</div>', srcAction: 'iframe_src', patterns: { youtube: { index: 'youtube.com', id: 'v=', src: '//www.youtube.com/embed/%id%?autoplay=1' }, vimeo: { index: 'vimeo.com/', id: '/', src: '//player.vimeo.com/video/%id%?autoplay=1' }, gmaps: { index: '//maps.google.', src: '%id%&output=embed' } } }, proto: { initIframe: function() { mfp.types.push(IFRAME_NS);
                _mfpOn('BeforeChange', function(e, prevType, newType) { if (prevType !== newType) { if (prevType === IFRAME_NS) { _fixIframeBugs(); } else if (newType === IFRAME_NS) { _fixIframeBugs(true); } } });
                _mfpOn(CLOSE_EVENT + '.' + IFRAME_NS, function() { _fixIframeBugs(); }); }, getIframe: function(item, template) { var embedSrc = item.src; var iframeSt = mfp.st.iframe;
                $.each(iframeSt.patterns, function() { if (embedSrc.indexOf(this.index) > -1) { if (this.id) { if (typeof this.id === 'string') { embedSrc = embedSrc.substr(embedSrc.lastIndexOf(this.id) + this.id.length, embedSrc.length); } else { embedSrc = this.id.call(this, embedSrc); } } embedSrc = this.src.replace('%id%', embedSrc); return false; } }); var dataObj = {}; if (iframeSt.srcAction) { dataObj[iframeSt.srcAction] = embedSrc; } mfp._parseMarkup(template, dataObj, item);
                mfp.updateStatus('ready'); return template; } } }); var _getLoopedId = function(index) { var numSlides = mfp.items.length; if (index > numSlides - 1) { return index - numSlides; } else if (index < 0) { return numSlides + index; } return index; },
        _replaceCurrTotal = function(text, curr, total) { return text.replace('%curr%', curr + 1).replace('%total%', total); };
    $.magnificPopup.registerModule('gallery', { options: { enabled: false, arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>', preload: [0, 2], navigateByImgClick: true, arrows: true, tPrev: 'Previous (Left arrow key)', tNext: 'Next (Right arrow key)', tCounter: '%curr% of %total%' }, proto: { initGallery: function() { var gSt = mfp.st.gallery,
                    ns = '.mfp-gallery',
                    supportsFastClick = Boolean($.fn.mfpFastClick);
                mfp.direction = true; if (!gSt || !gSt.enabled) return false;
                _wrapClasses += ' mfp-gallery';
                _mfpOn(OPEN_EVENT + ns, function() { if (gSt.navigateByImgClick) { mfp.wrap.on('click' + ns, '.mfp-img', function() { if (mfp.items.length > 1) { mfp.next(); return false; } }); } _document.on('keydown' + ns, function(e) { if (e.keyCode === 37) { mfp.prev(); } else if (e.keyCode === 39) { mfp.next(); } }); });
                _mfpOn('UpdateStatus' + ns, function(e, data) { if (data.text) { data.text = _replaceCurrTotal(data.text, mfp.currItem.index, mfp.items.length); } });
                _mfpOn(MARKUP_PARSE_EVENT + ns, function(e, element, values, item) { var l = mfp.items.length;
                    values.counter = l > 1 ? _replaceCurrTotal(gSt.tCounter, item.index, l) : ''; });
                _mfpOn('BuildControls' + ns, function() { if (mfp.items.length > 1 && gSt.arrows && !mfp.arrowLeft) { var markup = gSt.arrowMarkup,
                            arrowLeft = mfp.arrowLeft = $(markup.replace('%title%', gSt.tPrev).replace('%dir%', 'left')).addClass(PREVENT_CLOSE_CLASS),
                            arrowRight = mfp.arrowRight = $(markup.replace('%title%', gSt.tNext).replace('%dir%', 'right')).addClass(PREVENT_CLOSE_CLASS); var eName = supportsFastClick ? 'mfpFastClick' : 'click';
                        arrowLeft[eName](function() { mfp.prev(); });
                        arrowRight[eName](function() { mfp.next(); }); if (mfp.isIE7) { _getEl('b', arrowLeft[0], false, true);
                            _getEl('a', arrowLeft[0], false, true);
                            _getEl('b', arrowRight[0], false, true);
                            _getEl('a', arrowRight[0], false, true); } mfp.container.append(arrowLeft.add(arrowRight)); } });
                _mfpOn(CHANGE_EVENT + ns, function() { if (mfp._preloadTimeout) clearTimeout(mfp._preloadTimeout);
                    mfp._preloadTimeout = setTimeout(function() { mfp.preloadNearbyImages();
                        mfp._preloadTimeout = null; }, 16); });
                _mfpOn(CLOSE_EVENT + ns, function() { _document.off(ns);
                    mfp.wrap.off('click' + ns); if (mfp.arrowLeft && supportsFastClick) { mfp.arrowLeft.add(mfp.arrowRight).destroyMfpFastClick(); } mfp.arrowRight = mfp.arrowLeft = null; }); }, next: function() { mfp.direction = true;
                mfp.index = _getLoopedId(mfp.index + 1);
                mfp.updateItemHTML(); }, prev: function() { mfp.direction = false;
                mfp.index = _getLoopedId(mfp.index - 1);
                mfp.updateItemHTML(); }, goTo: function(newIndex) { mfp.direction = (newIndex >= mfp.index);
                mfp.index = newIndex;
                mfp.updateItemHTML(); }, preloadNearbyImages: function() { var p = mfp.st.gallery.preload,
                    preloadBefore = Math.min(p[0], mfp.items.length),
                    preloadAfter = Math.min(p[1], mfp.items.length),
                    i; for (i = 1; i <= (mfp.direction ? preloadAfter : preloadBefore); i++) { mfp._preloadItem(mfp.index + i); } for (i = 1; i <= (mfp.direction ? preloadBefore : preloadAfter); i++) { mfp._preloadItem(mfp.index - i); } }, _preloadItem: function(index) { index = _getLoopedId(index); if (mfp.items[index].preloaded) { return; } var item = mfp.items[index]; if (!item.parsed) { item = mfp.parseEl(index); } _mfpTrigger('LazyLoad', item); if (item.type === 'image') { item.img = $('<img class="mfp-img" />').on('load.mfploader', function() { item.hasSize = true; }).on('error.mfploader', function() { item.hasSize = true;
                        item.loadError = true;
                        _mfpTrigger('LazyLoadError', item); }).attr('src', item.src); } item.preloaded = true; } } }); var RETINA_NS = 'retina';
    $.magnificPopup.registerModule(RETINA_NS, { options: { replaceSrc: function(item) { return item.src.replace(/\.\w+$/, function(m) { return '@2x' + m; }); }, ratio: 1 }, proto: { initRetina: function() { if (window.devicePixelRatio > 1) { var st = mfp.st.retina,
                        ratio = st.ratio;
                    ratio = !isNaN(ratio) ? ratio : ratio(); if (ratio > 1) { _mfpOn('ImageHasSize' + '.' + RETINA_NS, function(e, item) { item.img.css({ 'max-width': item.img[0].naturalWidth / ratio, 'width': '100%' }); });
                        _mfpOn('ElementParse' + '.' + RETINA_NS, function(e, item) { item.src = st.replaceSrc(item, ratio); }); } } } } });
    (function() { var ghostClickDelay = 1000,
            supportsTouch = 'ontouchstart' in window,
            unbindTouchMove = function() { _window.off('touchmove' + ns + ' touchend' + ns); },
            eName = 'mfpFastClick',
            ns = '.' + eName;
        $.fn.mfpFastClick = function(callback) { return $(this).each(function() { var elem = $(this),
                    lock; if (supportsTouch) { var timeout, startX, startY, pointerMoved, point, numPointers;
                    elem.on('touchstart' + ns, function(e) { pointerMoved = false;
                        numPointers = 1;
                        point = e.originalEvent ? e.originalEvent.touches[0] : e.touches[0];
                        startX = point.clientX;
                        startY = point.clientY;
                        _window.on('touchmove' + ns, function(e) { point = e.originalEvent ? e.originalEvent.touches : e.touches;
                            numPointers = point.length;
                            point = point[0]; if (Math.abs(point.clientX - startX) > 10 || Math.abs(point.clientY - startY) > 10) { pointerMoved = true;
                                unbindTouchMove(); } }).on('touchend' + ns, function(e) { unbindTouchMove(); if (pointerMoved || numPointers > 1) { return; } lock = true;
                            e.preventDefault();
                            clearTimeout(timeout);
                            timeout = setTimeout(function() { lock = false; }, ghostClickDelay);
                            callback(); }); }); } elem.on('click' + ns, function() { if (!lock) { callback(); } }); }); };
        $.fn.destroyMfpFastClick = function() { $(this).off('touchstart' + ns + ' click' + ns); if (supportsTouch) _window.off('touchmove' + ns + ' touchend' + ns); }; })(); })(window.jQuery || window.Zepto);
! function(a) { "function" == typeof define && define.amd ? define(["jquery"], a) : a("object" == typeof exports ? require("jquery") : jQuery) }(function(a) { var b, c = navigator.userAgent,
        d = /iphone/i.test(c),
        e = /chrome/i.test(c),
        f = /android/i.test(c);
    a.mask = { definitions: { 9: "[0-9]", a: "[A-Za-z]", "*": "[A-Za-z0-9]" }, autoclear: !0, dataName: "rawMaskFn", placeholder: "_" }, a.fn.extend({ caret: function(a, b) { var c; if (0 !== this.length && !this.is(":hidden")) return "number" == typeof a ? (b = "number" == typeof b ? b : a, this.each(function() { this.setSelectionRange ? this.setSelectionRange(a, b) : this.createTextRange && (c = this.createTextRange(), c.collapse(!0), c.moveEnd("character", b), c.moveStart("character", a), c.select()) })) : (this[0].setSelectionRange ? (a = this[0].selectionStart, b = this[0].selectionEnd) : document.selection && document.selection.createRange && (c = document.selection.createRange(), a = 0 - c.duplicate().moveStart("character", -1e5), b = a + c.text.length), { begin: a, end: b }) }, unmask: function() { return this.trigger("unmask") }, mask: function(c, g) { var h, i, j, k, l, m, n, o; if (!c && this.length > 0) { h = a(this[0]); var p = h.data(a.mask.dataName); return p ? p() : void 0 } return g = a.extend({ autoclear: a.mask.autoclear, placeholder: a.mask.placeholder, completed: null }, g), i = a.mask.definitions, j = [], k = n = c.length, l = null, a.each(c.split(""), function(a, b) { "?" == b ? (n--, k = a) : i[b] ? (j.push(new RegExp(i[b])), null === l && (l = j.length - 1), k > a && (m = j.length - 1)) : j.push(null) }), this.trigger("unmask").each(function() {
                function h() { if (g.completed) { for (var a = l; m >= a; a++)
                            if (j[a] && C[a] === p(a)) return;
                        g.completed.call(B) } }

                function p(a) { return g.placeholder.charAt(a < g.placeholder.length ? a : 0) }

                function q(a) { for (; ++a < n && !j[a];); return a }

                function r(a) { for (; --a >= 0 && !j[a];); return a }

                function s(a, b) { var c, d; if (!(0 > a)) { for (c = a, d = q(b); n > c; c++)
                            if (j[c]) { if (!(n > d && j[c].test(C[d]))) break;
                                C[c] = C[d], C[d] = p(d), d = q(d) }
                        z(), B.caret(Math.max(l, a)) } }

                function t(a) { var b, c, d, e; for (b = a, c = p(a); n > b; b++)
                        if (j[b]) { if (d = q(b), e = C[b], C[b] = c, !(n > d && j[d].test(e))) break;
                            c = e } }

                function u() { var a = B.val(),
                        b = B.caret(); if (o && o.length && o.length > a.length) { for (A(!0); b.begin > 0 && !j[b.begin - 1];) b.begin--; if (0 === b.begin)
                            for (; b.begin < l && !j[b.begin];) b.begin++;
                        B.caret(b.begin, b.begin) } else { for (A(!0); b.begin < n && !j[b.begin];) b.begin++;
                        B.caret(b.begin, b.begin) } h() }

                function v() { A(), B.val() != E && B.change() }

                function w(a) { if (!B.prop("readonly")) { var b, c, e, f = a.which || a.keyCode;
                        o = B.val(), 8 === f || 46 === f || d && 127 === f ? (b = B.caret(), c = b.begin, e = b.end, e - c === 0 && (c = 46 !== f ? r(c) : e = q(c - 1), e = 46 === f ? q(e) : e), y(c, e), s(c, e - 1), a.preventDefault()) : 13 === f ? v.call(this, a) : 27 === f && (B.val(E), B.caret(0, A()), a.preventDefault()) } }

                function x(b) { if (!B.prop("readonly")) { var c, d, e, g = b.which || b.keyCode,
                            i = B.caret(); if (!(b.ctrlKey || b.altKey || b.metaKey || 32 > g) && g && 13 !== g) { if (i.end - i.begin !== 0 && (y(i.begin, i.end), s(i.begin, i.end - 1)), c = q(i.begin - 1), n > c && (d = String.fromCharCode(g), j[c].test(d))) { if (t(c), C[c] = d, z(), e = q(c), f) { var k = function() { a.proxy(a.fn.caret, B, e)() };
                                    setTimeout(k, 0) } else B.caret(e);
                                i.begin <= m && h() } b.preventDefault() } } }

                function y(a, b) { var c; for (c = a; b > c && n > c; c++) j[c] && (C[c] = p(c)) }

                function z() { B.val(C.join("")) }

                function A(a) { var b, c, d, e = B.val(),
                        f = -1; for (b = 0, d = 0; n > b; b++)
                        if (j[b]) { for (C[b] = p(b); d++ < e.length;)
                                if (c = e.charAt(d - 1), j[b].test(c)) { C[b] = c, f = b; break }
                            if (d > e.length) { y(b + 1, n); break } } else C[b] === e.charAt(d) && d++, k > b && (f = b); return a ? z() : k > f + 1 ? g.autoclear || C.join("") === D ? (B.val() && B.val(""), y(0, n)) : z() : (z(), B.val(B.val().substring(0, f + 1))), k ? b : l } var B = a(this),
                    C = a.map(c.split(""), function(a, b) { return "?" != a ? i[a] ? p(b) : a : void 0 }),
                    D = C.join(""),
                    E = B.val();
                B.data(a.mask.dataName, function() { return a.map(C, function(a, b) { return j[b] && a != p(b) ? a : null }).join("") }), B.one("unmask", function() { B.off(".mask").removeData(a.mask.dataName) }).on("focus.mask", function() { if (!B.prop("readonly")) { clearTimeout(b); var a;
                        E = B.val(), a = A(), b = setTimeout(function() { B.get(0) === document.activeElement && (z(), a == c.replace("?", "").length ? B.caret(0, a) : B.caret(a)) }, 10) } }).on("blur.mask", v).on("keydown.mask", w).on("keypress.mask", x).on("input.mask paste.mask", function() { B.prop("readonly") || setTimeout(function() { var a = A(!0);
                        B.caret(a), h() }, 0) }), e && f && B.off("input.mask").on("input.mask", u), A() }) } }) });
(function($) { var $window = $(window); var windowHeight = $window.height();
    $window.resize(function() { windowHeight = $window.height(); });
    $.fn.parallax = function(xpos, speedFactor, outerHeight) { var $this = $(this); var getHeight; var firstTop; var paddingTop = 0;
        $this.each(function() { firstTop = $this.offset().top; }); if (outerHeight) { getHeight = function(jqo) { return jqo.outerHeight(true); }; } else { getHeight = function(jqo) { return jqo.height(); }; } if (arguments.length < 1 || xpos === null) xpos = "50%"; if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1; if (arguments.length < 3 || outerHeight === null) outerHeight = true;

        function update() { var pos = $window.scrollTop();
            $this.each(function() { var $element = $(this); var top = $element.offset().top; var height = getHeight($element); if (top + height < pos || top > pos + windowHeight) { return; } $this.css('backgroundPosition', xpos + " " + Math.round((firstTop - pos) * speedFactor) + "px"); }); } $window.bind('scroll', update).resize(update);
        update(); }; })(jQuery);;
(function($) { var l = location.href.replace(/#.*/, ''); var g = $.localScroll = function(a) { $('body').localScroll(a) };
    g.defaults = { duration: 1e3, axis: 'y', event: 'click', stop: true, target: window, reset: true };
    g.hash = function(a) { if (location.hash) { a = $.extend({}, g.defaults, a);
            a.hash = false; if (a.reset) { var e = a.duration;
                delete a.duration;
                $(a.target).scrollTo(0, a);
                a.duration = e } i(0, location, a) } };
    $.fn.localScroll = function(b) { b = $.extend({}, g.defaults, b); return b.lazy ? this.bind(b.event, function(a) { var e = $([a.target, a.target.parentNode]).filter(d)[0]; if (e) i(a, e, b) }) : this.find('a,area').filter(d).bind(b.event, function(a) { i(a, this, b) }).end().end();

        function d() { return !!this.href && !!this.hash && this.href.replace(this.hash, '') == l && (!b.filter || $(this).is(b.filter)) } };

    function i(a, e, b) { var d = e.hash.slice(1),
            f = document.getElementById(d) || document.getElementsByName(d)[0]; if (!f) return; if (a) a.preventDefault(); var h = $(b.target); if (b.lock && h.is(':animated') || b.onBefore && b.onBefore.call(b, a, f, h) === false) return; if (b.stop) h.stop(true); if (b.hash) { var j = f.id == d ? 'id' : 'name',
                k = $('<a> </a>').attr(j, d).css({ position: 'absolute', top: $(window).scrollTop(), left: $(window).scrollLeft() });
            f[j] = '';
            $('body').prepend(k);
            location = e.hash;
            k.remove();
            f[j] = d } h.scrollTo(f, b).trigger('notify.serialScroll', [f]) } })(jQuery);;
(function(root, factory) { if (typeof define === 'function' && define.amd) { define(['jquery'], factory); } else if (typeof exports === 'object') { module.exports = factory(require('jquery')); } else { factory(root.jQuery); } }(this, function($) { $.transit = { version: "0.9.12", propertyMap: { marginLeft: 'margin', marginRight: 'margin', marginBottom: 'margin', marginTop: 'margin', paddingLeft: 'padding', paddingRight: 'padding', paddingBottom: 'padding', paddingTop: 'padding' }, enabled: true, useTransitionEnd: false }; var div = document.createElement('div'); var support = {};

    function getVendorPropertyName(prop) { if (prop in div.style) return prop; var prefixes = ['Moz', 'Webkit', 'O', 'ms']; var prop_ = prop.charAt(0).toUpperCase() + prop.substr(1); for (var i = 0; i < prefixes.length; ++i) { var vendorProp = prefixes[i] + prop_; if (vendorProp in div.style) { return vendorProp; } } }

    function checkTransform3dSupport() { div.style[support.transform] = '';
        div.style[support.transform] = 'rotateY(90deg)'; return div.style[support.transform] !== ''; } var isChrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
    support.transition = getVendorPropertyName('transition');
    support.transitionDelay = getVendorPropertyName('transitionDelay');
    support.transform = getVendorPropertyName('transform');
    support.transformOrigin = getVendorPropertyName('transformOrigin');
    support.filter = getVendorPropertyName('Filter');
    support.transform3d = checkTransform3dSupport(); var eventNames = { 'transition': 'transitionend', 'MozTransition': 'transitionend', 'OTransition': 'oTransitionEnd', 'WebkitTransition': 'webkitTransitionEnd', 'msTransition': 'MSTransitionEnd' }; var transitionEnd = support.transitionEnd = eventNames[support.transition] || null; for (var key in support) { if (support.hasOwnProperty(key) && typeof $.support[key] === 'undefined') { $.support[key] = support[key]; } } div = null;
    $.cssEase = { '_default': 'ease', 'in': 'ease-in', 'out': 'ease-out', 'in-out': 'ease-in-out', 'snap': 'cubic-bezier(0,1,.5,1)', 'easeInCubic': 'cubic-bezier(.550,.055,.675,.190)', 'easeOutCubic': 'cubic-bezier(.215,.61,.355,1)', 'easeInOutCubic': 'cubic-bezier(.645,.045,.355,1)', 'easeInCirc': 'cubic-bezier(.6,.04,.98,.335)', 'easeOutCirc': 'cubic-bezier(.075,.82,.165,1)', 'easeInOutCirc': 'cubic-bezier(.785,.135,.15,.86)', 'easeInExpo': 'cubic-bezier(.95,.05,.795,.035)', 'easeOutExpo': 'cubic-bezier(.19,1,.22,1)', 'easeInOutExpo': 'cubic-bezier(1,0,0,1)', 'easeInQuad': 'cubic-bezier(.55,.085,.68,.53)', 'easeOutQuad': 'cubic-bezier(.25,.46,.45,.94)', 'easeInOutQuad': 'cubic-bezier(.455,.03,.515,.955)', 'easeInQuart': 'cubic-bezier(.895,.03,.685,.22)', 'easeOutQuart': 'cubic-bezier(.165,.84,.44,1)', 'easeInOutQuart': 'cubic-bezier(.77,0,.175,1)', 'easeInQuint': 'cubic-bezier(.755,.05,.855,.06)', 'easeOutQuint': 'cubic-bezier(.23,1,.32,1)', 'easeInOutQuint': 'cubic-bezier(.86,0,.07,1)', 'easeInSine': 'cubic-bezier(.47,0,.745,.715)', 'easeOutSine': 'cubic-bezier(.39,.575,.565,1)', 'easeInOutSine': 'cubic-bezier(.445,.05,.55,.95)', 'easeInBack': 'cubic-bezier(.6,-.28,.735,.045)', 'easeOutBack': 'cubic-bezier(.175, .885,.32,1.275)', 'easeInOutBack': 'cubic-bezier(.68,-.55,.265,1.55)' };
    $.cssHooks['transit:transform'] = { get: function(elem) { return $(elem).data('transform') || new Transform(); }, set: function(elem, v) { var value = v; if (!(value instanceof Transform)) { value = new Transform(value); } if (support.transform === 'WebkitTransform' && !isChrome) { elem.style[support.transform] = value.toString(true); } else { elem.style[support.transform] = value.toString(); } $(elem).data('transform', value); } };
    $.cssHooks.transform = { set: $.cssHooks['transit:transform'].set };
    $.cssHooks.filter = { get: function(elem) { return elem.style[support.filter]; }, set: function(elem, value) { elem.style[support.filter] = value; } }; if ($.fn.jquery < "1.8") { $.cssHooks.transformOrigin = { get: function(elem) { return elem.style[support.transformOrigin]; }, set: function(elem, value) { elem.style[support.transformOrigin] = value; } };
        $.cssHooks.transition = { get: function(elem) { return elem.style[support.transition]; }, set: function(elem, value) { elem.style[support.transition] = value; } }; } registerCssHook('scale');
    registerCssHook('scaleX');
    registerCssHook('scaleY');
    registerCssHook('translate');
    registerCssHook('rotate');
    registerCssHook('rotateX');
    registerCssHook('rotateY');
    registerCssHook('rotate3d');
    registerCssHook('perspective');
    registerCssHook('skewX');
    registerCssHook('skewY');
    registerCssHook('x', true);
    registerCssHook('y', true);

    function Transform(str) { if (typeof str === 'string') { this.parse(str); } return this; } Transform.prototype = { setFromString: function(prop, val) { var args = (typeof val === 'string') ? val.split(',') : (val.constructor === Array) ? val : [val];
            args.unshift(prop);
            Transform.prototype.set.apply(this, args); }, set: function(prop) { var args = Array.prototype.slice.apply(arguments, [1]); if (this.setter[prop]) { this.setter[prop].apply(this, args); } else { this[prop] = args.join(','); } }, get: function(prop) { if (this.getter[prop]) { return this.getter[prop].apply(this); } else { return this[prop] || 0; } }, setter: { rotate: function(theta) { this.rotate = unit(theta, 'deg'); }, rotateX: function(theta) { this.rotateX = unit(theta, 'deg'); }, rotateY: function(theta) { this.rotateY = unit(theta, 'deg'); }, scale: function(x, y) { if (y === undefined) { y = x; } this.scale = x + "," + y; }, skewX: function(x) { this.skewX = unit(x, 'deg'); }, skewY: function(y) { this.skewY = unit(y, 'deg'); }, perspective: function(dist) { this.perspective = unit(dist, 'px'); }, x: function(x) { this.set('translate', x, null); }, y: function(y) { this.set('translate', null, y); }, translate: function(x, y) { if (this._translateX === undefined) { this._translateX = 0; } if (this._translateY === undefined) { this._translateY = 0; } if (x !== null && x !== undefined) { this._translateX = unit(x, 'px'); } if (y !== null && y !== undefined) { this._translateY = unit(y, 'px'); } this.translate = this._translateX + "," + this._translateY; } }, getter: { x: function() { return this._translateX || 0; }, y: function() { return this._translateY || 0; }, scale: function() { var s = (this.scale || "1,1").split(','); if (s[0]) { s[0] = parseFloat(s[0]); } if (s[1]) { s[1] = parseFloat(s[1]); } return (s[0] === s[1]) ? s[0] : s; }, rotate3d: function() { var s = (this.rotate3d || "0,0,0,0deg").split(','); for (var i = 0; i <= 3; ++i) { if (s[i]) { s[i] = parseFloat(s[i]); } } if (s[3]) { s[3] = unit(s[3], 'deg'); } return s; } }, parse: function(str) { var self = this;
            str.replace(/([a-zA-Z0-9]+)\((.*?)\)/g, function(x, prop, val) { self.setFromString(prop, val); }); }, toString: function(use3d) { var re = []; for (var i in this) { if (this.hasOwnProperty(i)) { if ((!support.transform3d) && ((i === 'rotateX') || (i === 'rotateY') || (i === 'perspective') || (i === 'transformOrigin'))) { continue; } if (i[0] !== '_') { if (use3d && (i === 'scale')) { re.push(i + "3d(" + this[i] + ",1)"); } else if (use3d && (i === 'translate')) { re.push(i + "3d(" + this[i] + ",0)"); } else { re.push(i + "(" + this[i] + ")"); } } } } return re.join(" "); } };

    function callOrQueue(self, queue, fn) { if (queue === true) { self.queue(fn); } else if (queue) { self.queue(queue, fn); } else { self.each(function() { fn.call(this); }); } }

    function getProperties(props) { var re = [];
        $.each(props, function(key) { key = $.camelCase(key);
            key = $.transit.propertyMap[key] || $.cssProps[key] || key;
            key = uncamel(key); if (support[key]) key = uncamel(support[key]); if ($.inArray(key, re) === -1) { re.push(key); } }); return re; }

    function getTransition(properties, duration, easing, delay) { var props = getProperties(properties); if ($.cssEase[easing]) { easing = $.cssEase[easing]; } var attribs = '' + toMS(duration) + ' ' + easing; if (parseInt(delay, 10) > 0) { attribs += ' ' + toMS(delay); } var transitions = [];
        $.each(props, function(i, name) { transitions.push(name + ' ' + attribs); }); return transitions.join(', '); } $.fn.transition = $.fn.transit = function(properties, duration, easing, callback) { var self = this; var delay = 0; var queue = true; var theseProperties = $.extend(true, {}, properties); if (typeof duration === 'function') { callback = duration;
            duration = undefined; } if (typeof duration === 'object') { easing = duration.easing;
            delay = duration.delay || 0;
            queue = typeof duration.queue === "undefined" ? true : duration.queue;
            callback = duration.complete;
            duration = duration.duration; } if (typeof easing === 'function') { callback = easing;
            easing = undefined; } if (typeof theseProperties.easing !== 'undefined') { easing = theseProperties.easing;
            delete theseProperties.easing; } if (typeof theseProperties.duration !== 'undefined') { duration = theseProperties.duration;
            delete theseProperties.duration; } if (typeof theseProperties.complete !== 'undefined') { callback = theseProperties.complete;
            delete theseProperties.complete; } if (typeof theseProperties.queue !== 'undefined') { queue = theseProperties.queue;
            delete theseProperties.queue; } if (typeof theseProperties.delay !== 'undefined') { delay = theseProperties.delay;
            delete theseProperties.delay; } if (typeof duration === 'undefined') { duration = $.fx.speeds._default; } if (typeof easing === 'undefined') { easing = $.cssEase._default; } duration = toMS(duration); var transitionValue = getTransition(theseProperties, duration, easing, delay); var work = $.transit.enabled && support.transition; var i = work ? (parseInt(duration, 10) + parseInt(delay, 10)) : 0; if (i === 0) { var fn = function(next) { self.css(theseProperties); if (callback) { callback.apply(self); } if (next) { next(); } };
            callOrQueue(self, queue, fn); return self; } var oldTransitions = {}; var run = function(nextCall) { var bound = false; var cb = function() { if (bound) { self.unbind(transitionEnd, cb); } if (i > 0) { self.each(function() { this.style[support.transition] = (oldTransitions[this] || null); }); } if (typeof callback === 'function') { callback.apply(self); } if (typeof nextCall === 'function') { nextCall(); } }; if ((i > 0) && (transitionEnd) && ($.transit.useTransitionEnd)) { bound = true;
                self.bind(transitionEnd, cb); } else { window.setTimeout(cb, i); } self.each(function() { if (i > 0) { this.style[support.transition] = transitionValue; } $(this).css(theseProperties); }); }; var deferredRun = function(next) { this.offsetWidth;
            run(next); };
        callOrQueue(self, queue, deferredRun); return this; };

    function registerCssHook(prop, isPixels) { if (!isPixels) { $.cssNumber[prop] = true; } $.transit.propertyMap[prop] = support.transform;
        $.cssHooks[prop] = { get: function(elem) { var t = $(elem).css('transit:transform'); return t.get(prop); }, set: function(elem, value) { var t = $(elem).css('transit:transform');
                t.setFromString(prop, value);
                $(elem).css({ 'transit:transform': t }); } }; }

    function uncamel(str) { return str.replace(/([A-Z])/g, function(letter) { return '-' + letter.toLowerCase(); }); }

    function unit(i, units) { if ((typeof i === "string") && (!i.match(/^[\-0-9\.]+$/))) { return i; } else { return "" + i + units; } }

    function toMS(duration) { var i = duration; if (typeof i === 'string' && (!i.match(/^[\-0-9\.]+/))) { i = $.fx.speeds[i] || $.fx.speeds._default; } return unit(i, 'ms'); } $.transit.getTransitionValue = getTransition; return $; }));
(function(e, t) { "use strict";

    function l(t) { t = e.extend({}, a, t || {}); if (u === null) { u = e("body") } var n = e(this); for (var r = 0, i = n.length; r < i; r++) { c(n.eq(r), t) } return n }

    function c(t, r) { if (!t.hasClass("selecter-element")) { r = e.extend({}, r, t.data("selecter-options"));
            r.multiple = t.prop("multiple");
            r.disabled = t.is(":disabled"); if (r.external) { r.links = true } var i = t.find("[selected]").not(":disabled"),
                o = t.find("option").index(i); if (!r.multiple && r.label !== "") { t.prepend('<option value="" class="selecter-placeholder" selected>' + r.label + "</option>"); if (o > -1) { o++ } } else { r.label = "" } var u = t.find("option, optgroup"),
                a = u.filter("option"); if (!i.length) { i = a.eq(0) } var f = o > -1 ? o : 0,
                l = r.label !== "" ? r.label : i.text(),
                c = "div";
            r.tabIndex = t[0].tabIndex;
            t[0].tabIndex = -1; var d = "",
                v = "";
            v += "<" + c + ' class="selecter ' + r.customClass; if (s) { v += " mobile" } else if (r.cover) { v += " cover" } if (r.multiple) { v += " multiple" } else { v += " closed" } if (r.disabled) { v += " disabled" } v += '" tabindex="' + r.tabIndex + '">';
            v += "</" + c + ">"; if (!r.multiple) { d += '<span class="selecter-selected">';
                d += e("<span></span>").text(A(l, r.trim)).html();
                d += "</span>" } d += '<div class="selecter-options">';
            d += "</div>";
            t.addClass("selecter-element").wrap(v).after(d); var g = t.parent(".selecter"),
                y = e.extend({ $select: t, $allOptions: u, $options: a, $selecter: g, $selected: g.find(".selecter-selected"), $itemsWrapper: g.find(".selecter-options"), index: -1, guid: n++ }, r);
            h(y); if (!y.multiple) { N(f, y) } if (e.fn.scroller !== undefined) { y.$itemsWrapper.scroller() } y.$selecter.on("touchstart.selecter", ".selecter-selected", y, p).on("click.selecter", ".selecter-selected", y, m).on("click.selecter", ".selecter-item", y, w).on("close.selecter", y, b).data("selecter", y);
            y.$select.on("change.selecter", y, E); if (!s) { y.$selecter.on("focusin.selecter", y, S).on("blur.selecter", y, x);
                y.$select.on("focusin.selecter", y, function(e) { e.data.$selecter.trigger("focus") }) } } }

    function h(t) { var n = "",
            r = t.links ? "a" : "span",
            i = 0; for (var s = 0, o = t.$allOptions.length; s < o; s++) { var u = t.$allOptions.eq(s); if (u[0].tagName === "OPTGROUP") { n += '<span class="selecter-group'; if (u.is(":disabled")) { n += " disabled" } n += '">' + u.attr("label") + "</span>" } else { var a = u.val(); if (!u.attr("value")) { u.attr("value", a) } n += "<" + r + ' class="selecter-item'; if (u.hasClass("selecter-placeholder")) { n += " placeholder" } if (u.is(":selected")) { n += " selected" } if (u.is(":disabled")) { n += " disabled" } n += '" '; if (t.links) { n += 'href="' + a + '"' } else { n += 'data-value="' + a + '"' } n += ">" + e("<span></span>").text(A(u.text(), t.trim)).html() + "</" + r + ">";
                i++ } } t.$itemsWrapper.html(n);
        t.$items = t.$selecter.find(".selecter-item") }

    function p(e) { e.stopPropagation(); var t = e.data;
        t.touchStartEvent = e.originalEvent;
        t.touchStartX = t.touchStartEvent.touches[0].clientX;
        t.touchStartY = t.touchStartEvent.touches[0].clientY;
        t.$selecter.on("touchmove.selecter", ".selecter-selected", t, d).on("touchend.selecter", ".selecter-selected", t, v) }

    function d(e) { var t = e.data,
            n = e.originalEvent; if (Math.abs(n.touches[0].clientX - t.touchStartX) > 10 || Math.abs(n.touches[0].clientY - t.touchStartY) > 10) { t.$selecter.off("touchmove.selecter touchend.selecter") } }

    function v(e) { var t = e.data;
        t.touchStartEvent.preventDefault();
        t.$selecter.off("touchmove.selecter touchend.selecter");
        m(e) }

    function m(n) { n.preventDefault();
        n.stopPropagation(); var r = n.data; if (!r.$select.is(":disabled")) { e(".selecter").not(r.$selecter).trigger("close.selecter", [r]); if (!r.mobile && s && !o) { var i = r.$select[0]; if (t.document.createEvent) { var u = t.document.createEvent("MouseEvents");
                    u.initMouseEvent("mousedown", false, true, t, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
                    i.dispatchEvent(u) } else if (i.fireEvent) { i.fireEvent("onmousedown") } } else { if (r.$selecter.hasClass("closed")) { g(n) } else if (r.$selecter.hasClass("open")) { b(n) } } } }

    function g(e) { e.preventDefault();
        e.stopPropagation(); var t = e.data; if (!t.$selecter.hasClass("open")) { var n = t.$selecter.offset(),
                r = u.outerHeight(),
                i = t.$itemsWrapper.outerHeight(true),
                s = t.index >= 0 ? t.$items.eq(t.index).position() : { left: 0, top: 0 }; if (n.top + i > r) { t.$selecter.addClass("bottom") } t.$itemsWrapper.show();
            t.$selecter.removeClass("closed").addClass("open");
            u.on("click.selecter-" + t.guid, ":not(.selecter-options)", t, y);
            C(t) } }

    function y(t) { t.preventDefault();
        t.stopPropagation(); if (e(t.currentTarget).parents(".selecter").length === 0) { b(t) } }

    function b(e) { e.preventDefault();
        e.stopPropagation(); var t = e.data; if (t.$selecter.hasClass("open")) { t.$itemsWrapper.hide();
            t.$selecter.removeClass("open bottom").addClass("closed");
            u.off(".selecter-" + t.guid) } }

    function w(t) { t.preventDefault();
        t.stopPropagation(); var n = e(this),
            r = t.data; if (!r.$select.is(":disabled")) { if (r.$itemsWrapper.is(":visible")) { var i = r.$items.index(n); if (i !== r.index) { N(i, r);
                    k(r) } } if (!r.multiple) { b(t) } } }

    function E(t, n) { var r = e(this),
            i = t.data; if (!n && !i.multiple) { var s = i.$options.index(i.$options.filter("[value='" + O(r.val()) + "']"));
            N(s, i);
            k(i) } }

    function S(t) { t.preventDefault();
        t.stopPropagation(); var n = t.data; if (!n.$select.is(":disabled") && !n.multiple) { n.$selecter.addClass("focus").on("keydown.selecter-" + n.guid, n, T);
            e(".selecter").not(n.$selecter).trigger("close.selecter", [n]) } }

    function x(e, t, n) { e.preventDefault();
        e.stopPropagation(); var r = e.data;
        r.$selecter.removeClass("focus").off("keydown.selecter-" + r.guid); if (r.$selecter.hasClass("open")) { b(e);
            N(r.index, r) } k(r) }

    function T(t) { var n = t.data; if (t.keyCode === 13) { if (n.$selecter.hasClass("open")) { b(t);
                N(n.index, n) } k(n) } else if (t.keyCode !== 9 && !t.metaKey && !t.altKey && !t.ctrlKey && !t.shiftKey) { t.preventDefault();
            t.stopPropagation(); var r = n.$items.length - 1,
                s = n.index < 0 ? 0 : n.index; if (e.inArray(t.keyCode, i ? [38, 40, 37, 39] : [38, 40]) > -1) { s = s + (t.keyCode === 38 || i && t.keyCode === 37 ? -1 : 1); if (s < 0) { s = 0 } if (s > r) { s = r } } else { var o = String.fromCharCode(t.keyCode).toUpperCase(),
                    u, a; for (a = n.index + 1; a <= r; a++) { u = n.$options.eq(a).text().charAt(0).toUpperCase(); if (u === o) { s = a; break } } if (s < 0 || s === n.index) { for (a = 0; a <= r; a++) { u = n.$options.eq(a).text().charAt(0).toUpperCase(); if (u === o) { s = a; break } } } } if (s >= 0) { N(s, n);
                C(n) } } }

    function N(e, t) { var n = t.$items.eq(e),
            r = n.hasClass("selected"),
            i = n.hasClass("disabled"); if (!i) { if (t.multiple) { if (r) { t.$options.eq(e).prop("selected", null);
                    n.removeClass("selected") } else { t.$options.eq(e).prop("selected", true);
                    n.addClass("selected") } } else if (e > -1 && e < t.$items.length) { var s = n.html(),
                    o = n.data("value");
                t.$selected.html(s).removeClass("placeholder");
                t.$items.filter(".selected").removeClass("selected");
                t.$select[0].selectedIndex = e;
                n.addClass("selected");
                t.index = e } else if (t.label !== "") { t.$selected.html(t.label) } } }

    function C(t) { var n = t.$items.eq(t.index),
            r = t.index >= 0 && !n.hasClass("placeholder") ? n.position() : { left: 0, top: 0 }; if (e.fn.scroller !== undefined) { t.$itemsWrapper.scroller("scroll", t.$itemsWrapper.find(".scroller-content").scrollTop() + r.top, 0).scroller("reset") } else { t.$itemsWrapper.scrollTop(t.$itemsWrapper.scrollTop() + r.top) } }

    function k(e) { if (e.links) { L(e) } else { e.callback.call(e.$selecter, e.$select.val(), e.index);
            e.$select.trigger("change", [true]) } }

    function L(e) { var n = e.$select.val(); if (e.external) { t.open(n) } else { t.location.href = n } }

    function A(e, t) { if (t === 0) { return e } else { if (e.length > t) { return e.substring(0, t) + "..." } else { return e } } }

    function O(e) { return typeof e === "string" ? e.replace(/([;&,\.\+\*\~':"\!\^#$%@\[\]\(\)=>\|])/g, "\\$1") : e } var n = 0,
        r = t.navigator.userAgent || t.navigator.vendor || t.opera,
        i = /Firefox/i.test(r),
        s = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(r),
        o = i && s,
        u = null; var a = { callback: e.noop, cover: false, customClass: "", label: "", external: false, links: false, mobile: false, trim: 0 }; var f = { defaults: function(t) { a = e.extend(a, t || {}); return e(this) }, disable: function(t) { return e(this).each(function(n, r) { var i = e(r).parent(".selecter").data("selecter"); if (i) { if (typeof t !== "undefined") { var s = i.$items.index(i.$items.filter("[data-value=" + t + "]"));
                        i.$items.eq(s).addClass("disabled");
                        i.$options.eq(s).prop("disabled", true) } else { if (i.$selecter.hasClass("open")) { i.$selecter.find(".selecter-selected").trigger("click.selecter") } i.$selecter.addClass("disabled");
                        i.$select.prop("disabled", true) } } }) }, destroy: function() { return e(this).each(function(t, n) { var r = e(n).parent(".selecter").data("selecter"); if (r) { if (r.$selecter.hasClass("open")) { r.$selecter.find(".selecter-selected").trigger("click.selecter") } if (e.fn.scroller !== undefined) { r.$selecter.find(".selecter-options").scroller("destroy") } r.$select[0].tabIndex = r.tabIndex;
                    r.$select.find(".selecter-placeholder").remove();
                    r.$selected.remove();
                    r.$itemsWrapper.remove();
                    r.$selecter.off(".selecter");
                    r.$select.off(".selecter").removeClass("selecter-element").show().unwrap() } }) }, enable: function(t) { return e(this).each(function(n, r) { var i = e(r).parent(".selecter").data("selecter"); if (i) { if (typeof t !== "undefined") { var s = i.$items.index(i.$items.filter("[data-value=" + t + "]"));
                        i.$items.eq(s).removeClass("disabled");
                        i.$options.eq(s).prop("disabled", false) } else { i.$selecter.removeClass("disabled");
                        i.$select.prop("disabled", false) } } }) }, refresh: function() { return f.update.apply(e(this)) }, update: function() { return e(this).each(function(t, n) { var r = e(n).parent(".selecter").data("selecter"); if (r) { var i = r.index;
                    r.$allOptions = r.$select.find("option, optgroup");
                    r.$options = r.$allOptions.filter("option");
                    r.index = -1;
                    i = r.$options.index(r.$options.filter(":selected"));
                    h(r); if (!r.multiple) { N(i, r) } } }) } };
    e.fn.selecter = function(e) { if (f[e]) { return f[e].apply(this, Array.prototype.slice.call(arguments, 1)) } else if (typeof e === "object" || !e) { return l.apply(this, arguments) } return this };
    e.selecter = function(e) { if (e === "defaults") { f.defaults.apply(this, Array.prototype.slice.call(arguments, 1)) } } })(jQuery, window);
window.Modernizr = function(a, b, c) {
        function d(a) { t.cssText = a }

        function e(a, b) { return d(v.join(a + ";") + (b || "")) }

        function f(a, b) { return typeof a === b }

        function g(a, b) { return !!~("" + a).indexOf(b) }

        function h(a, b) { for (var d in a) { var e = a[d]; if (!g(e, "-") && t[e] !== c) return "pfx" == b ? e : !0 } return !1 }

        function i(a, b, d) { for (var e in a) { var g = b[a[e]]; if (g !== c) return d === !1 ? a[e] : f(g, "function") ? g.bind(d || b) : g } return !1 }

        function j(a, b, c) { var d = a.charAt(0).toUpperCase() + a.slice(1),
                e = (a + " " + x.join(d + " ") + d).split(" "); return f(b, "string") || f(b, "undefined") ? h(e, b) : (e = (a + " " + y.join(d + " ") + d).split(" "), i(e, b, c)) } var k, l, m, n = "2.8.3",
            o = {},
            p = !0,
            q = b.documentElement,
            r = "modernizr",
            s = b.createElement(r),
            t = s.style,
            u = ":)",
            v = ({}.toString, " -webkit- -moz- -o- -ms- ".split(" ")),
            w = "Webkit Moz O ms",
            x = w.split(" "),
            y = w.toLowerCase().split(" "),
            z = { svg: "http://www.w3.org/2000/svg" },
            A = {},
            B = [],
            C = B.slice,
            D = function(a, c, d, e) { var f, g, h, i, j = b.createElement("div"),
                    k = b.body,
                    l = k || b.createElement("body"); if (parseInt(d, 10))
                    for (; d--;) h = b.createElement("div"), h.id = e ? e[d] : r + (d + 1), j.appendChild(h); return f = ["&#173;", '<style id="s', r, '">', a, "</style>"].join(""), j.id = r, (k ? j : l).innerHTML += f, l.appendChild(j), k || (l.style.background = "", l.style.overflow = "hidden", i = q.style.overflow, q.style.overflow = "hidden", q.appendChild(l)), g = c(j, a), k ? j.parentNode.removeChild(j) : (l.parentNode.removeChild(l), q.style.overflow = i), !!g },
            E = {}.hasOwnProperty;
        m = f(E, "undefined") || f(E.call, "undefined") ? function(a, b) { return b in a && f(a.constructor.prototype[b], "undefined") } : function(a, b) { return E.call(a, b) }, Function.prototype.bind || (Function.prototype.bind = function(a) { var b = this; if ("function" != typeof b) throw new TypeError; var c = C.call(arguments, 1),
                d = function() { if (this instanceof d) { var e = function() {};
                        e.prototype = b.prototype; var f = new e,
                            g = b.apply(f, c.concat(C.call(arguments))); return Object(g) === g ? g : f } return b.apply(a, c.concat(C.call(arguments))) }; return d }), A.flexbox = function() { return j("flexWrap") }, A.flexboxlegacy = function() { return j("boxDirection") }, A.touch = function() { var c; return "ontouchstart" in a || a.DocumentTouch && b instanceof DocumentTouch ? c = !0 : D(["@media (", v.join("touch-enabled),("), r, ")", "{#modernizr{top:9px;position:absolute}}"].join(""), function(a) { c = 9 === a.offsetTop }), c }, A.history = function() { return !!a.history && !!history.pushState }, A.rgba = function() { return d("background-color:rgba(150,255,150,.5)"), g(t.backgroundColor, "rgba") }, A.multiplebgs = function() { return d("background:url(https://),url(https://),red url(https://)"), /(url\s*\(.*?){3}/.test(t.background) }, A.backgroundsize = function() { return j("backgroundSize") }, A.opacity = function() { return e("opacity:.55"), /^0.55$/.test(t.opacity) }, A.cssanimations = function() { return j("animationName") }, A.csscolumns = function() { return j("columnCount") }, A.cssgradients = function() { var a = "background-image:",
                b = "gradient(linear,left top,right bottom,from(#9f9),to(white));",
                c = "linear-gradient(left top,#9f9, white);"; return d((a + "-webkit- ".split(" ").join(b + a) + v.join(c + a)).slice(0, -a.length)), g(t.backgroundImage, "gradient") }, A.csstransforms = function() { return !!j("transform") }, A.csstransforms3d = function() { var a = !!j("perspective"); return a && "webkitPerspective" in q.style && D("@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}", function(b) { a = 9 === b.offsetLeft && 3 === b.offsetHeight }), a }, A.csstransitions = function() { return j("transition") }, A.generatedcontent = function() { var a; return D(["#", r, "{font:0/0 a}#", r, ':after{content:"', u, '";visibility:hidden;font:3px/1 a}'].join(""), function(b) { a = b.offsetHeight >= 3 }), a }, A.video = function() { var a = b.createElement("video"),
                c = !1; try {
                (c = !!a.canPlayType) && (c = new Boolean(c), c.ogg = a.canPlayType('video/ogg; codecs="theora"').replace(/^no$/, ""), c.h264 = a.canPlayType('video/mp4; codecs="avc1.42E01E"').replace(/^no$/, ""), c.webm = a.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/^no$/, "")) } catch (d) {} return c }, A.audio = function() { var a = b.createElement("audio"),
                c = !1; try {
                (c = !!a.canPlayType) && (c = new Boolean(c), c.ogg = a.canPlayType('audio/ogg; codecs="vorbis"').replace(/^no$/, ""), c.mp3 = a.canPlayType("audio/mpeg;").replace(/^no$/, ""), c.wav = a.canPlayType('audio/wav; codecs="1"').replace(/^no$/, ""), c.m4a = (a.canPlayType("audio/x-m4a;") || a.canPlayType("audio/aac;")).replace(/^no$/, "")) } catch (d) {} return c }, A.svg = function() { return !!b.createElementNS && !!b.createElementNS(z.svg, "svg").createSVGRect }; for (var F in A) m(A, F) && (l = F.toLowerCase(), o[l] = A[F](), B.push((o[l] ? "" : "no-") + l)); return o.addTest = function(a, b) { if ("object" == typeof a)
                for (var d in a) m(a, d) && o.addTest(d, a[d]);
            else { if (a = a.toLowerCase(), o[a] !== c) return o;
                b = "function" == typeof b ? b() : b, "undefined" != typeof p && p && (q.className += " " + (b ? "" : "no-") + a), o[a] = b } return o }, d(""), s = k = null, o._version = n, o._prefixes = v, o._domPrefixes = y, o._cssomPrefixes = x, o.testProp = function(a) { return h([a]) }, o.testAllProps = j, o.testStyles = D, q.className = q.className.replace(/(^|\s)no-js(\s|$)/, "$1$2") + (p ? " js " + B.join(" ") : ""), o }(this, this.document),
    function(a, b, c) {
        function d(a) { return "[object Function]" == q.call(a) }

        function e(a) { return "string" == typeof a }

        function f() {}

        function g(a) { return !a || "loaded" == a || "complete" == a || "uninitialized" == a }

        function h() { var a = r.shift();
            s = 1, a ? a.t ? o(function() {
                ("c" == a.t ? m.injectCss : m.injectJs)(a.s, 0, a.a, a.x, a.e, 1) }, 0) : (a(), h()) : s = 0 }

        function i(a, c, d, e, f, i, j) {
            function k(b) { if (!n && g(l.readyState) && (t.r = n = 1, !s && h(), l.onload = l.onreadystatechange = null, b)) { "img" != a && o(function() { v.removeChild(l) }, 50); for (var d in A[c]) A[c].hasOwnProperty(d) && A[c][d].onload() } } var j = j || m.errorTimeout,
                l = b.createElement(a),
                n = 0,
                q = 0,
                t = { t: d, s: c, e: f, a: i, x: j };
            1 === A[c] && (q = 1, A[c] = []), "object" == a ? l.data = c : (l.src = c, l.type = a), l.width = l.height = "0", l.onerror = l.onload = l.onreadystatechange = function() { k.call(this, q) }, r.splice(e, 0, t), "img" != a && (q || 2 === A[c] ? (v.insertBefore(l, u ? null : p), o(k, j)) : A[c].push(l)) }

        function j(a, b, c, d, f) { return s = 0, b = b || "j", e(a) ? i("c" == b ? x : w, a, b, this.i++, c, d, f) : (r.splice(this.i++, 0, a), 1 == r.length && h()), this }

        function k() { var a = m; return a.loader = { load: j, i: 0 }, a } var l, m, n = b.documentElement,
            o = a.setTimeout,
            p = b.getElementsByTagName("script")[0],
            q = {}.toString,
            r = [],
            s = 0,
            t = "MozAppearance" in n.style,
            u = t && !!b.createRange().compareNode,
            v = u ? n : p.parentNode,
            n = a.opera && "[object Opera]" == q.call(a.opera),
            n = !!b.attachEvent && !n,
            w = t ? "object" : n ? "script" : "img",
            x = n ? "script" : w,
            y = Array.isArray || function(a) { return "[object Array]" == q.call(a) },
            z = [],
            A = {},
            B = { timeout: function(a, b) { return b.length && (a.timeout = b[0]), a } };
        m = function(a) {
            function b(a) { var b, c, d, a = a.split("!"),
                    e = z.length,
                    f = a.pop(),
                    g = a.length,
                    f = { url: f, origUrl: f, prefixes: a }; for (c = 0; g > c; c++) d = a[c].split("="), (b = B[d.shift()]) && (f = b(f, d)); for (c = 0; e > c; c++) f = z[c](f); return f }

            function g(a, e, f, g, h) { var i = b(a),
                    j = i.autoCallback;
                i.url.split(".").pop().split("?").shift(), i.bypass || (e && (e = d(e) ? e : e[a] || e[g] || e[a.split("/").pop().split("?")[0]]), i.instead ? i.instead(a, e, f, g, h) : (A[i.url] ? i.noexec = !0 : A[i.url] = 1, f.load(i.url, i.forceCSS || !i.forceJS && "css" == i.url.split(".").pop().split("?").shift() ? "c" : c, i.noexec, i.attrs, i.timeout), (d(e) || d(j)) && f.load(function() { k(), e && e(i.origUrl, h, g), j && j(i.origUrl, h, g), A[i.url] = 2 }))) }

            function h(a, b) {
                function c(a, c) { if (a) { if (e(a)) c || (l = function() { var a = [].slice.call(arguments);
                            m.apply(this, a), n() }), g(a, l, b, 0, j);
                        else if (Object(a) === a)
                            for (i in h = function() { var b, c = 0; for (b in a) a.hasOwnProperty(b) && c++; return c }(), a) a.hasOwnProperty(i) && (!c && !--h && (d(l) ? l = function() { var a = [].slice.call(arguments);
                                m.apply(this, a), n() } : l[i] = function(a) { return function() { var b = [].slice.call(arguments);
                                    a && a.apply(this, b), n() } }(m[i])), g(a[i], l, b, i, j)) } else !c && n() } var h, i, j = !!a.test,
                    k = a.load || a.both,
                    l = a.callback || f,
                    m = l,
                    n = a.complete || f;
                c(j ? a.yep : a.nope, !!k), k && c(k) } var i, j, l = this.yepnope.loader; if (e(a)) g(a, 0, l, 0);
            else if (y(a))
                for (i = 0; i < a.length; i++) j = a[i], e(j) ? g(j, 0, l, 0) : y(j) ? m(j) : Object(j) === j && h(j, l);
            else Object(a) === a && h(a, l) }, m.addPrefix = function(a, b) { B[a] = b }, m.addFilter = function(a) { z.push(a) }, m.errorTimeout = 1e4, null == b.readyState && b.addEventListener && (b.readyState = "loading", b.addEventListener("DOMContentLoaded", l = function() { b.removeEventListener("DOMContentLoaded", l, 0), b.readyState = "complete" }, 0)), a.yepnope = k(), a.yepnope.executeStack = h, a.yepnope.injectJs = function(a, c, d, e, i, j) { var k, l, n = b.createElement("script"),
                e = e || m.errorTimeout;
            n.src = a; for (l in d) n.setAttribute(l, d[l]);
            c = j ? h : c || f, n.onreadystatechange = n.onload = function() {!k && g(n.readyState) && (k = 1, c(), n.onload = n.onreadystatechange = null) }, o(function() { k || (k = 1, c(1)) }, e), i ? n.onload() : p.parentNode.insertBefore(n, p) }, a.yepnope.injectCss = function(a, c, d, e, g, i) { var j, e = b.createElement("link"),
                c = i ? h : c || f;
            e.href = a, e.rel = "stylesheet", e.type = "text/css"; for (j in d) e.setAttribute(j, d[j]);
            g || (p.parentNode.insertBefore(e, p), o(c, 0)) } }(this, document), Modernizr.load = function() { yepnope.apply(window, [].slice.call(arguments, 0)) }, Modernizr.addTest("pointerevents", function() { var a, b = document.createElement("x"),
            c = document.documentElement,
            d = window.getComputedStyle; return "pointerEvents" in b.style ? (b.style.pointerEvents = "auto", b.style.pointerEvents = "x", c.appendChild(b), a = d && "auto" === d(b, "").pointerEvents, c.removeChild(b), !!a) : !1 });