import {j as e, K as i, u as t, i as n, A as s, c as o, z as a} from "./index-BXJBXD8C.js";
import "./vendor-Dorrp04q.js";
const r = [{
    title: "INSAT: National Institute of Applied Science and Technology",
    description: "The National Institute of Applied Science and Technology (INSAT) is a Tunisian engineering school located in Tunis. It is one of the most prestigious engineering schools in Tunisia. INSAT is a public institution of higher education and scientific research. It is a member of the University of Carthage.",
    imgId: "u4wsa5owfj1jvxllj7ln",
    link: "https://insat.rnu.tn/",
    logoId: "wjmsh0yp3fv1uf1b8hxh",
    id: "insat"
}, {
    imgId: "vnx6irqvqqvldpc83qgz",
    title: "IEEE Tunisia Section",
    description: "Founded in 2008, the IEEE Tunisia Section is dedicated to spreading IEEE initiatives throughout Tunisia. This is achieved through educational and technical programs, networking opportunities, and the advancement of technology and its applications to address humanitarian challenges. The section actively supports chapters, special interest groups, student activities, and student awards. IEEE has firmly established its presence in the Tunisian engineering community, with over 43 Student Branches located across various engineering schools, faculties, and universities.",
    link: "https://ieee.tn/",
    logoId: "nnkdldlmt4fhfozuozbm",
    id: "ieee-tunisia-section"
}, {
    title: "IEEE Region 8",
    description: "IEEE Region 8 is the third largest region in IEEE. It comprises Europe, Middle East, and Africa. The region has 56 sections, 220+ student branches, and 1000+ student branch chapters. Region 8 is a vibrant region with a rich history of IEEE activities. It is home to many IEEE members, volunteers, and student members.",
    imgId: "emld8invotzu36dlboyf",
    link: "https://ieeer8.org/",
    logoId: "ccyfd67bbh42eb3ivmmh",
    id: "ieee-region-8"
}, {
    title: "IEEE: Institute of Electrical and Electronics Engineers",
    description: "IEEE is the world's largest technical professional organization dedicated to advancing technology for the benefit of humanity. IEEE and its members inspire a global community to innovate for a better tomorrow through its highly cited publications, conferences, technology standards, and professional and educational activities. IEEE is the trusted “voice” for engineering, computing, and technology information around the globe.",
    imgId: "gzv0uooekp6uuhqivih7",
    link: "https://ieee.org/",
    logoId: "wwdoovscwdipofq0l4vp",
    id: "ieee"
}]
  , l = () => {
    const t = i => e.jsx("span", {
        onClick: () => {
            var e;
            null == (e = document.querySelector(`#${i.id}`)) || e.scrollIntoView({
                behavior: "smooth",
                block: "center"
            })
        }
        ,
        className: a("font-bold py-px px-2 rounded-lg text-nowrap transition-all hover:brightness-[90%] cursor-pointer ", i.className),
        children: i.children
    })
      , n = e.jsx(t, {
        id: "ieee",
        className: "bg-blue-600 text-white",
        children: "IEEE"
    })
      , s = e.jsx(t, {
        id: "insat",
        className: "bg-rose-700 text-white",
        children: "INSAT"
    })
      , o = e.jsx(t, {
        id: "ieee-tunisia-section",
        className: "bg-amber-600 text-white",
        children: "IEEE Tunisia Section"
    })
      , l = e.jsx(t, {
        id: "ieee-region-8",
        className: "bg-cyan-600 text-white",
        children: "IEEE Region 8"
    });
    return e.jsxs(i, {
        title: "Who Are We?",
        description: "What is IEEE INSAT Student Branch? Who are we? What do we do? Find out more about us!",
        children: [e.jsxs("div", {
            className: "flex flex-col gap-3 h-fit items-start p-4",
            children: [e.jsx("div", {
                className: "dark:text-slate-200 font-black text-xl sm:text-left",
                children: "Click on highlighted words to learn more"
            }), e.jsxs("div", {
                className: "dark:text-white font-normal text-justify leading-relaxed relative before:w-0.5 before:h-full before:absolute before:-left-2 before:top-0 before:bg-slate-500",
                children: ["We are ", n, " ", s, " Student Branch, an energetic community devoted to technological advancement. Rooted in the renowned", " ", n, ", a global force for innovation, we're part of ", l, ", linking us to a vast network across Europe, Africa, and the Middle East. Locally, we're represented by the ", o, ", fostering collaboration and knowledge exchange. ", s, " provides the nurturing environment where our ideas flourish into meaningful projects. Together, we push boundaries and inspire the next generation of innovators."]
            })]
        }), r.map(( (i, t) => e.jsx(c, {
            flip: t % 2 == 0,
            ...i
        }, t)))]
    })
}
;
function d() {
    const i = t();
    return n(i) ? e.jsxs("h1", {
        children: [i.status, " ", i.statusText]
    }) : e.jsx("h1", {
        children: JSON.stringify(i)
    })
}
const c = i => e.jsx(e.Fragment, {
    children: e.jsx("div", {
        className: "relative ",
        id: i.id,
        children: e.jsx("div", {
            className: "w-full px-4 py-12 sm:px-6 lg:px-8 lg:py-16 mx-auto",
            children: e.jsxs("div", {
                className: "lg:grid lg:grid-cols-7 lg:gap-8 lg:items-center",
                children: [e.jsxs("div", {
                    className: "lg:col-span-4",
                    children: [e.jsxs("blockquote", {
                        children: [e.jsx(s, {
                            cldImg: o.image(i.logoId),
                            alt: "IEEE Tunisia Section",
                            className: "object-cover w-24 h-auto mb-4 brightness-0 invert"
                        }), e.jsx("h3", {
                            className: "text-xl font-extrabold text-gray-800 lg:text-2xl lg:leading-normal dark:text-gray-200",
                            children: i.title
                        }), e.jsx("p", {
                            className: " text-gray-800 lg:text-lg lg:leading-normal dark:text-gray-200",
                            children: i.description
                        })]
                    }), e.jsxs("a", {
                        href: i.link,
                        target: "_blank",
                        className: "inline-flex items-center gap-x-1 font-medium text-blue-600 dark:text-blue-500 my-2",
                        children: ["Learn More", " ", e.jsx("svg", {
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
                    })]
                }), e.jsx(s, {
                    cldImg: o.image(i.imgId),
                    alt: "IEEE Tunisia Section",
                    className: a("rounded-xl object-cover col-span-3 h-full w-full min-h-60 max-lg:mb-4 ", i.flip ? "row-start-1" : "")
                })]
            })
        })
    })
});
export {l as Component, d as ErrorBoundary};
