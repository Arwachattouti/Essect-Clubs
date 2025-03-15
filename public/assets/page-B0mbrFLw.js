import {j as e, A as s, c as a, M as t, u as r, i as n} from "./index-BXJBXD8C.js";
import {f as i} from "./resize-U8LdHv1U.js";
import {T as l} from "./Team-oqnt2B2h.js";
import {H as d} from "./hero-D9BSWDlw.js";
import "./vendor-Dorrp04q.js";
const m = "/assets/cs-FXXUunG5.png"
  , o = "/assets/ras-DnTH0Ota.png"
  , x = "/assets/embs-jpMOGv5A.png"
  , c = "/assets/wie-CdtaNspT.png"
  , g = "/assets/pes-ClC9o21V.png"
  , h = "/assets/pels-L-Ip5cj-.png"
  , p = "/assets/ias-7VtrR-Xq.png"
  , u = "/assets/sight-8zmSJXxD.png";
function j(s) {
    return e.jsx("div", {
        className: "p-6 md:p-10 bg-gray-100 rounded-lg dark:bg-slate-800 flex items-center justify-center",
        children: e.jsx("img", {
            className: "dark:brightness-0 dark:invert max-h-16 hover:invert-0 hover:brightness-100 transition-all",
            src: s.img,
            alt: "chapter logo"
        })
    })
}
function f() {
    return e.jsx(e.Fragment, {
        children: e.jsxs("div", {
            className: "max-w-[70rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto",
            children: [e.jsx("div", {
                className: "sm:w-1/2 xl:w-1/3 mx-auto text-center mb-6 md:mb-12",
                children: e.jsx("h2", {
                    className: "text-xl font-semibold md:text-2xl md:leading-tight text-gray-800 dark:text-gray-200",
                    children: "Find communities that share your interests."
                })
            }), e.jsx("div", {
                className: "grid grid-cols-2 sm:grid-cols-3 gap-3 lg:gap-6",
                children: [m, o, x, c, g, h, p, u].map(( (s, a) => e.jsx(j, {
                    img: s
                }, a)))
            })]
        })
    })
}
function b() {
    return e.jsx(e.Fragment, {
        children: e.jsxs("div", {
            className: "max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto",
            children: [e.jsx("div", {
                className: "max-w-xl mx-auto",
                children: e.jsxs("div", {
                    className: "text-center",
                    children: [e.jsx("h1", {
                        className: "text-3xl font-bold text-gray-800 sm:text-4xl dark:text-white",
                        children: "Contact us"
                    }), e.jsx("p", {
                        className: "mt-1 text-gray-600 dark:text-gray-400",
                        children: "We'd love to talk about how we can help you."
                    })]
                })
            }), e.jsx("div", {
                className: "mt-12 max-w-lg mx-auto",
                children: e.jsxs("div", {
                    className: "flex flex-col border rounded-xl p-4 sm:p-6 lg:p-8 dark:border-gray-700",
                    children: [e.jsx("h2", {
                        className: "mb-8 text-xl font-semibold text-gray-800 dark:text-gray-200",
                        children: "Fill in the form"
                    }), e.jsxs("form", {
                        action: "mailto:sb.insat@ieee.org",
                        method: "get",
                        encType: "text/plain",
                        children: [e.jsxs("div", {
                            className: "grid gap-4 lg:gap-6",
                            children: [e.jsx("div", {
                                className: "grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6",
                                children: e.jsxs("div", {
                                    className: "col-span-2",
                                    children: [e.jsx("label", {
                                        htmlFor: "hs-lastname-contacts-1",
                                        className: "block mb-2 text-sm text-gray-700 font-medium dark:text-white",
                                        children: "Full Name"
                                    }), e.jsx("input", {
                                        type: "text",
                                        name: "subject",
                                        id: "hs-lastname-contacts-1",
                                        className: "py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                    })]
                                })
                            }), e.jsx("div", {
                                className: "grid grid-cols-1",
                                children: e.jsxs("div", {
                                    children: [e.jsx("label", {
                                        htmlFor: "hs-email-contacts-1",
                                        className: "block mb-2 text-sm text-gray-700 font-medium dark:text-white",
                                        children: "Email"
                                    }), e.jsx("input", {
                                        type: "email",
                                        name: "email",
                                        id: "hs-email-contacts-1",
                                        autoComplete: "email",
                                        className: "py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                    })]
                                })
                            }), e.jsxs("div", {
                                children: [e.jsx("label", {
                                    htmlFor: "hs-about-contacts-1",
                                    className: "block mb-2 text-sm text-gray-700 font-medium dark:text-white",
                                    children: "Details"
                                }), e.jsx("textarea", {
                                    id: "hs-about-contacts-1",
                                    name: "body",
                                    rows: 4,
                                    className: "py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600",
                                    defaultValue: ""
                                })]
                            })]
                        }), e.jsx("div", {
                            className: "mt-6 grid",
                            children: e.jsx("button", {
                                type: "submit",
                                value: "Send",
                                className: "w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                                children: "Send inquiry"
                            })
                        }), e.jsx("div", {
                            className: "mt-3 text-center",
                            children: e.jsx("p", {
                                className: "text-sm text-gray-500",
                                children: "We'll get back to you in 1-2 business days."
                            })
                        })]
                    })]
                })
            })]
        })
    })
}
const y = ["379308983_699232112238311_6593868613536339885_n", "277567937_5124520917586436_749865808996775110_n", "308759235_5626405944064595_4280187281631351941_n", "307914948_5626411327397390_9061545839367157149_n", "308123513_5626414617397061_8721558825572103761_n", "311085290_5700927399945782_8404035943547899203_n", "73533029_2566861600019060_6667760358502957056_n", "71496451_2537542686284285_8724575674926366720_n", "380270954_705913101570212_7296121337325895432_n", "310510591_5648260515212471_8873098302929484764_n", "301612089_5545634048808452_610910868762487940_n", "362271252_673414291486760_3657211550306372738_n", "392773056_624771093186059_837371219729334812_n", "403716493_646135081049660_8206959095086502085_n", "403738844_737330878420425_419455848359247308_n", "382714953_703514568468723_3741342510071942574_n", "379044125_699232132238309_5847255879708829352_n", "408101702_743435554476624_3362218712223190038_n", "403898273_738397984980381_2922679499910348201_n", "405542241_648318527497982_5959675387640645963_n", "408109088_743437207809792_7234238279229121805_n", "408123409_743437341143112_5694356693641983891_n", "406608814_741355684684611_3857032896518395466_n", "408094226_743437657809747_7679562815047334500_n", "311594395_5700772696627919_310042677603182945_n"].map((e => a.image(e).resize(i().width(400).height(200))))
  , v = () => e.jsx("div", {
    className: "py-10 lg:py-14 mx-auto",
    children: e.jsxs("div", {
        className: "[--space:2rem] grid content-center justify-center overflow-hidden gap-6 w-full",
        children: [e.jsx("style", {
            children: _
        }), e.jsx(w, {
            children: e.jsx(N, {
                images: y.slice(0, y.length / 2)
            })
        }), e.jsx("div", {
            className: "border border-y-2 border-gray-200 dark:border-gray-700 py-2",
            children: e.jsx(w, {
                children: Array.from({
                    length: 3
                }).map(( (s, a) => e.jsx("div", {
                    className: "font-extrabold text-gray-400 dark:text-gray-700 text-4xl leading-none mb-1 align-middle uppercase",
                    children: "Creating memories since 2013"
                }, a)))
            })
        }), e.jsx(w, {
            reverse: !0,
            children: e.jsx(N, {
                images: y.slice(y.length / 2, y.length)
            })
        })]
    })
})
  , N = a => e.jsx(e.Fragment, {
    children: a.images.map(( (a, t) => e.jsx("div", {
        className: "max-w-[400px] max-h-[200px] overflow-hidden rounded-xl hover:filter-none transition-all",
        children: e.jsx(s, {
            cldImg: a.format("webp"),
            plugins: [],
            alt: `Group Photo ${t}`
        }, a.toString())
    }, a.toURL())))
})
  , w = s => e.jsxs("div", {
    className: "[--gap:var(--space)] flex overflow-x-hidden select-none gap-[30px] p-2  " + (s.fast ? "[--duration:20s]" : "[--duration:60s]"),
    children: [e.jsx("div", {
        className: `shrink-0 flex items-center justify-around gap-[30px] min-w-full animate-[scroll_var(--duration)_linear_infinite] ${s.reverse && " [animation-direction:reverse] [animation-delay:calc(10s_/_-2)]"}    `,
        children: s.children
    }), e.jsx("div", {
        className: `shrink-0 flex items-center justify-around gap-[30px] min-w-full animate-[scroll_var(--duration)_linear_infinite] ${s.reverse && " [animation-direction:reverse] [animation-delay:calc(10s_/_-2)]"}`,
        "aria-hidden": "true",
        children: s.children
    })]
})
  , _ = "\n\n  @media (prefers-reduced-motion: reduce) {\n    .marquee__group {\n      animation-play-state: paused;\n    }\n  }\n\n \n\n  @keyframes scroll {\n    from {\n      transform: translateX(0);\n    }\n\n    to {\n      transform: translateX(calc(-100% - var(--gap)));\n    }\n  }\n"
  , k = ["image 27", "image1", "image 86", "image13", "image 30", "image5", "image 29", "oorjus6ifo6ixhd7drdn 1", "image10", "image17", "image 32", "image8", "image19", "image9", "image 33", "image2", "image3", "image14", "image15", "image11", "image 34", "image7", "image18", "image20", "kifhqp7cbrlhxkrtjmlh 1", "image 87", "image4", "image6"]
  , E = () => e.jsx(e.Fragment, {
    children: e.jsxs("div", {
        className: "max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto",
        children: [e.jsx("div", {
            className: "w-2/3 sm:w-1/2 lg:w-1/3 mx-auto text-center mb-6",
            children: e.jsx("h2", {
                className: "text-gray-600 dark:text-gray-400",
                children: "Trusted by Public, Private, and Nonprofit Organizations"
            })
        }), e.jsx("div", {
            className: "flex justify-center gap-x-6 sm:gap-x-12 lg:gap-x-24 flex-wrap gap-y-10 ",
            children: k.map(( (t, r) => e.jsx(s, {
                cldImg: a.image(t).format("webp").resize(i().width(200).height(200)),
                className: "max-w-[8rem] max-h-[4rem] object-contain  dark:hover:filter-none hover:filter-none overflow-hidden transition-all sepia-[10%]  contrast-50 brightness-200 saturate-0  drop-shadow",
                alt: `Company Logo ${r}`
            }, t)))
        })]
    })
})
  , F = () => e.jsx(e.Fragment, {
    children: e.jsxs("div", {
        className: "max-w-[70rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto",
        children: [e.jsx("div", {
            className: "sm:w-1/2 xl:w-1/3 mx-auto text-center mb-6 md:mb-12 mt-3",
            children: e.jsx("h2", {
                className: "text-xl font-semibold md:text-2xl md:leading-tight text-gray-800 dark:text-gray-200",
                children: "Our Student Branch in numbers"
            })
        }), e.jsxs("div", {
            className: "grid gap-6 grid-cols-2 sm:gap-12 lg:grid-cols-3 lg:gap-8",
            children: [e.jsxs("div", {
                children: [e.jsx("h2", {
                    className: "text-lg sm:text-xl font-semibold text-gray-800 dark:text-gray-200",
                    children: "Members"
                }), e.jsx("p", {
                    className: "mt-2 sm:mt-3 text-4xl sm:text-6xl font-bold text-blue-600",
                    children: "530+"
                }), e.jsx("p", {
                    className: "mt-1 text-gray-500",
                    children: "as of November 2023"
                })]
            }), e.jsxs("div", {
                children: [e.jsx("h2", {
                    className: "text-lg sm:text-xl font-semibold text-gray-800 dark:text-gray-200",
                    children: "Technical Events"
                }), e.jsx("p", {
                    className: "mt-2 sm:mt-3 text-4xl sm:text-6xl font-bold text-blue-600",
                    children: "100+"
                }), e.jsx("p", {
                    className: "mt-1 text-gray-500",
                    children: "just this year"
                })]
            }), e.jsxs("div", {
                children: [e.jsx("h2", {
                    className: "text-lg sm:text-xl font-semibold text-gray-800 dark:text-gray-200",
                    children: "Non-Technical Events"
                }), e.jsx("p", {
                    className: "mt-2 sm:mt-3 text-4xl sm:text-6xl font-bold text-blue-600",
                    children: "10+"
                }), e.jsx("p", {
                    className: "mt-1 text-gray-500",
                    children: "this year alone"
                })]
            })]
        })]
    })
});
function S({src: s}) {
    return e.jsx("span", {
        className: "flex-shrink-0 inline-flex justify-center p-3 items-center w-[46px] h-[46px] rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm mx-auto dark:bg-slate-900 dark:border-gray-700 dark:text-gray-200",
        children: e.jsx("img", {
            src: s,
            alt: "icon",
            className: "w-full h-full object-contain inline saturate-0 brightness-125"
        })
    })
}
function T(s) {
    return e.jsxs("div", {
        className: "ms-5 sm:ms-8",
        children: [e.jsx("h3", {
            className: "text-base sm:text-lg font-semibold text-gray-800 dark:text-gray-200",
            children: s.title
        }), e.jsx("p", {
            className: "mt-1 text-gray-600 dark:text-gray-400",
            children: s.text
        })]
    })
}
function z() {
    return e.jsx(e.Fragment, {
        children: e.jsx("div", {
            className: "max-w-[70rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto",
            children: e.jsxs("div", {
                className: "grid md:grid-cols-2 gap-12",
                children: [e.jsxs("div", {
                    className: "lg:w-3/4",
                    children: [e.jsx("h2", {
                        className: "text-3xl text-gray-800 font-bold lg:text-4xl dark:text-white",
                        children: "Join a community of forward-thinking individuals"
                    }), e.jsx("p", {
                        className: "mt-3 text-gray-800 dark:text-gray-400",
                        children: "As an IEEE member, you'll be presented with new resources, valuable opportunities, and many discounts that will help you advance your career. You can find colleagues who share your vision and commitment—those who are moving technology forward today."
                    }), e.jsx("p", {
                        className: "mt-5",
                        children: e.jsxs("a", {
                            className: "inline-flex items-center gap-x-1 font-medium text-blue-600 dark:text-blue-500",
                            href: "https://www.ieee.org/membership",
                            children: ["Learn membership benefits now!", e.jsx("svg", {
                                className: "flex-shrink-0 w-4 h-4 transition ease-in-out group-hover:translate-x-1",
                                xmlns: "http://www.w3.org/2000/svg",
                                width: 24,
                                height: 24,
                                viewBox: "0 0 24 24",
                                fill: "none",
                                stroke: "currentColor",
                                strokeWidth: 2,
                                strokeLinecap: "round",
                                strokeLinejoin: "round",
                                children: e.jsx("path", {
                                    d: "m9 18 6-6-6-6"
                                })
                            })]
                        })
                    })]
                }), e.jsxs("div", {
                    className: "space-y-6 lg:space-y-10",
                    children: [e.jsxs("div", {
                        className: "flex",
                        children: [e.jsx(S, {
                            src: "https://res.cloudinary.com/dzgxf5tsm/image/upload/v1701464458/mtvotuw6znhjdjxpm7ha.png"
                        }), e.jsx(T, {
                            title: "Grow as a Leader",
                            text: "Between IEEE INSAT and the global organization, there are countless opportunities to take leadership positions in events, units and committees"
                        })]
                    }), e.jsxs("div", {
                        className: "flex",
                        children: [e.jsx(S, {
                            src: "https://res.cloudinary.com/dzgxf5tsm/image/upload/v1701464458/bjeeqcefrhuspt5p4xod.png"
                        }), e.jsx(T, {
                            text: "Being part of a global organization, IEEE INSAT connects you with students and professionals from across the globe",
                            title: "Grow your Network"
                        })]
                    }), e.jsxs("div", {
                        className: "flex",
                        children: [e.jsx(S, {
                            src: "https://res.cloudinary.com/dzgxf5tsm/image/upload/v1701464458/rw4hfm2ev8s5oecb8bc0.png"
                        }), e.jsx(T, {
                            text: "You’ll be in contact with various organizations and partners. You’ll receive unmatched exposure to the professional world",
                            title: "Grow Professionally"
                        })]
                    })]
                })]
            })
        })
    })
}
function I() {
    return e.jsxs(e.Fragment, {
        children: [e.jsx(d, {}), e.jsx(t, {}), e.jsx(z, {}), e.jsx(v, {}), e.jsx(F, {}), e.jsx(f, {}), e.jsx(E, {}), e.jsx(l, {}), e.jsxs("div", {
            className: "max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto",
            children: [e.jsx("div", {
                className: "max-w-xl mx-auto mb-12",
                children: e.jsxs("div", {
                    className: "text-center",
                    children: [e.jsx("h1", {
                        className: "text-3xl font-bold text-gray-800 sm:text-4xl dark:text-white",
                        children: "We're located in INSAT, Obviously!"
                    }), e.jsx("p", {
                        className: "mt-1 text-gray-600 dark:text-gray-400",
                        children: "Check if we're neighbours!"
                    })]
                })
            }), e.jsx("iframe", {
                src: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6386.042146056181!2d10.187460001337307!3d36.84197136062557!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12fd353f5b04ecad%3A0xca198eb19f6b148c!2sIEEE%20INSAT%20Student%20Branch!5e0!3m2!1sen!2stn!4v1701467665755!5m2!1sen!2stn",
                className: "rounded-2xl mx-auto w-[80%] aspect-video max-w-[70rem]",
                allowFullScreen: !0,
                loading: "lazy",
                title: "IEEE INSAT Student Branch Location",
                referrerPolicy: "no-referrer-when-downgrade"
            })]
        }), e.jsx(b, {})]
    })
}
function A() {
    const s = r();
    return n(s) ? e.jsxs("h1", {
        children: [s.status, " ", s.statusText]
    }) : e.jsx("h1", {
        children: JSON.stringify(s)
    })
}
export {I as Component, A as ErrorBoundary};
