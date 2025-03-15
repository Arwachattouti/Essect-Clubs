import {T as i, U as t, V as e, W as a, X as s, Y as n, Z as o, $ as r, a0 as d} from "./index-BXJBXD8C.js";
function h(i) {
    const t = i.toString();
    if (t.match(/[A-Z]/gi))
        return t;
    if (t.length > 1 && "0" === t[0])
        return t;
    return !isNaN(parseFloat(t)) && -1 === t.indexOf(":") && -1 === t.indexOf(".") ? `${t}.0` : t
}
class c extends i {
}
class l extends t {
    constructor(i, t, s) {
        super(),
        this._actionModel = {
            dimensions: {}
        },
        this._actionModel.actionType = e[i] || i,
        this.addQualifier(new a("c",i)),
        t && this.width(t),
        s && this.height(s)
    }
    height(i) {
        return this._actionModel.dimensions.height = i,
        this.addQualifier(new a("h",i))
    }
    width(i) {
        return this._actionModel.dimensions.width = i,
        this.addQualifier(new a("w",i))
    }
    aspectRatio(i) {
        return i instanceof c ? (this._actionModel.dimensions.aspectRatio = `${i}`,
        this.addQualifier(new a("ar",i))) : "number" == typeof i || "string" == typeof i ? (this._actionModel.dimensions.aspectRatio = h(i),
        this.addQualifier(new a("ar",h(i)))) : i instanceof s ? (this._actionModel.dimensions.aspectRatio = `${i.qualifierValue}`,
        this.addFlag(i)) : void 0
    }
    relative() {
        return this._actionModel.relative = !0,
        this.addFlag(n())
    }
    regionRelative() {
        return this._actionModel.regionRelative = !0,
        this.addFlag(o())
    }
    static fromJson(i) {
        const {actionType: t, dimensions: e, relative: a, regionRelative: s} = i
          , {aspectRatio: n, width: o, height: h} = e
          , c = new this(r[t] || t,o,h);
        return n && c.aspectRatio("ignore_aspect_ratio" === n ? d() : n),
        a && c.relative(),
        s && c.regionRelative(),
        c
    }
}
function u(i, t) {
    return new l("fit",i,t)
}
export {u as f};
