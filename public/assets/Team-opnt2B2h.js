import {C as e, j as t, L as s, l as r, z as a, N as l, O as i, E as o, Q as n, R as d, F as c} from "./index-BXJBXD8C.js";
const m = "team"
  , x = async () => c.getEntries({
    content_type: m,
    order: "fields.order",
    "fields.order[lte]": 5
});
function h(e) {
    var s;
    const [c,m] = r.useState(!1)
      , x = () => m((e => !e));
    return t.jsxs("div", {
        className: "relative group text-center px-1 py-3 hover:bg-slate-300 dark:hover:bg-slate-700 rounded-lg overflow-hidden transition-all",
        onMouseEnter: x,
        onMouseLeave: x,
        children: [t.jsxs("div", {
            className: a("absolute top-0 left-0 w-full transition-all h-full p-2 flex flex-col justify-center gap-4 items-center z-30", c ? "opacity-100 backdrop-blur-lg backdrop-brightness-75" : "opacity-0"),
            children: [t.jsxs("div", {
                children: [t.jsx("div", {
                    className: "text-base font-bold text-white",
                    children: "Contacts"
                }), t.jsx("div", {
                    className: "text-sm font-medium text-white",
                    children: "Click on Email to copy to clipboard"
                })]
            }), t.jsxs("div", {
                className: "text-xs pr-2 flex cursor-pointer active:scale-105 transition-transform  w-[95%]  flex-row gap-1 items-center justify-start text-left bg-slate-950 rounded-3xl",
                onClick: () => {
                    navigator.clipboard.writeText(e.member.email),
                    n("Email copied to clipboard!", {
                        position: "bottom-center",
                        autoClose: 1e3,
                        hideProgressBar: !0,
                        closeOnClick: !0,
                        pauseOnHover: !0,
                        draggable: !1,
                        progress: void 0,
                        theme: "dark",
                        transition: d,
                        className: "bg-slate-900",
                        style: {
                            backgroundColor: "#1F2937",
                            borderRadius: "99px"
                        },
                        closeButton: !1
                    })
                }
                ,
                children: [t.jsx("span", {
                    className: "p-2 w-fit rounded-full bg-white inline-flex justify-between",
                    children: t.jsx(l, {
                        className: "text-white"
                    })
                }), t.jsx("div", {
                    className: "break-words text-white line-clamp-1 text-ellipsis",
                    children: e.member.name.split(" ").join("-").toLowerCase()
                })]
            }), t.jsxs("a", {
                className: "text-xs w-[95%] pr-2 flex flex-row gap-1 items-center justify-start text-left bg-slate-950 rounded-3xl",
                href: e.member.linkedin,
                target: "_blank",
                children: [t.jsx("span", {
                    className: "p-2 w-fit rounded-full bg-white inline-flex items-center justify-center",
                    children: t.jsx(i, {
                        color: "#000000"
                    })
                }), t.jsx("span", {
                    className: "break-words text-white line-clamp-1 text-ellipsis",
                    children: e.member.name.split(" ").join("-").toLowerCase()
                })]
            })]
        }), t.jsx("img", {
            src: o(null == (s = e.member.picture.fields.file) ? void 0 : s.url, "webp", 200, 200),
            alt: e.member.name,
            className: "object-cover rounded-full overflow-hidden w-24 h-24 mx-auto"
        }), t.jsxs("div", {
            className: "mt-2 sm:mt-4",
            children: [t.jsx("h3", {
                className: "font-medium text-gray-800 dark:text-gray-200",
                children: e.member.name
            }), t.jsx("p", {
                className: "text-sm text-gray-600 dark:text-gray-400",
                children: e.member.position
            })]
        })]
    })
}
const p = () => {
    const {data: r, error: a} = e({
        queryKey: ["team"],
        queryFn: x
    });
    return t.jsx(t.Fragment, {
        children: t.jsxs("div", {
            className: "relative max-w-5xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto",
            children: [t.jsxs("div", {
                className: "max-w-2xl mx-auto text-center mb-10 lg:mb-14",
                children: [t.jsx("h2", {
                    className: "text-2xl font-bold md:text-4xl md:leading-tight dark:text-white",
                    children: "Our team"
                }), t.jsx("p", {
                    className: "mt-1 text-gray-600 dark:text-gray-400",
                    children: "Hover to see contact info"
                })]
            }), a && t.jsxs("div", {
                className: "bg-red-500 text-sm text-white rounded-lg p-4 col-span-2",
                role: "alert",
                children: [t.jsx("span", {
                    className: "font-bold",
                    children: "Error"
                }), " We're sorry, an internal error has occured"]
            }), t.jsxs("div", {
                className: "grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8 md:gap-12",
                children: [r && r.items.map((e => t.jsx(h, {
                    member: e.fields
                }, e.sys.id))), r && t.jsxs(s, {
                    to: "/units",
                    className: "relative group text-center p-2 hover:bg-slate-300 dark:hover:bg-slate-700 rounded-lg transition-all justify-center items-center flex flex-col",
                    children: [t.jsx("div", {
                        className: "rounded-full overflow-hidden w-16 h-16 mx-auto text-slate-100 bg-slate-800 flex items-center justify-center",
                        children: t.jsx(u, {})
                    }), t.jsx("div", {
                        className: "mt-2 sm:mt-4 dark:text-slate-100",
                        children: "See the whole IEEE INSAT team"
                    })]
                })]
            }), " "]
        })
    })
}
  , u = () => t.jsx("svg", {
    xmlns: "http://www.w3.org/2000/svg",
    fill: "none",
    viewBox: "0 0 24 24",
    strokeWidth: 1.5,
    stroke: "currentColor",
    className: "w-6 h-6",
    children: t.jsx("path", {
        strokeLinecap: "round",
        strokeLinejoin: "round",
        d: "M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"
    })
});
export {p as T, h as a, m as b};
