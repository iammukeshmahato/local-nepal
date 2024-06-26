"use strict";
document.addEventListener("DOMContentLoaded", function () {
    !(function () {
        const e = document.querySelector(".app-chat-contacts .sidebar-body"),
            t = [].slice.call(
                document.querySelectorAll(
                    ".chat-contact-list-item:not(.chat-contact-list-item-title)"
                )
            ),
            a = document.querySelector(".chat-history-body"),
            c = document.querySelector(".app-chat-sidebar-left .sidebar-body"),
            r = document.querySelector(".app-chat-sidebar-right .sidebar-body"),
            l = [].slice.call(
                document.querySelectorAll(
                    ".form-check-input[name='chat-user-status']"
                )
            ),
            s = $(".chat-sidebar-left-user-about"),
            o = document.querySelector(".form-send-message"),
            n = document.querySelector(".message-input"),
            i = document.querySelector(".chat-search-input"),
            d = $(".speech-to-text"),
            u = {
                active: "avatar-online",
                offline: "avatar-offline",
                away: "avatar-away",
                busy: "avatar-busy",
            };
        function h() {
            a.scrollTo(0, a.scrollHeight);
        }
        function m(e, t, a, c) {
            e.forEach((e) => {
                let c = e.textContent.toLowerCase();
                a
                    ? -1 < c.indexOf(a)
                        ? (e.classList.add("d-flex"),
                            e.classList.remove("d-none"),
                            t++)
                        : e.classList.add("d-none")
                    : (e.classList.add("d-flex"),
                        e.classList.remove("d-none"),
                        t++);
            }),
                0 == t
                    ? c.classList.remove("d-none")
                    : c.classList.add("d-none");
        }
        e &&
            new PerfectScrollbar(e, {
                wheelPropagation: !1,
                suppressScrollX: !0,
            }),
            a &&
            new PerfectScrollbar(a, {
                wheelPropagation: !1,
                suppressScrollX: !0,
            }),
            c &&
            new PerfectScrollbar(c, {
                wheelPropagation: !1,
                suppressScrollX: !0,
            }),
            r &&
            new PerfectScrollbar(r, {
                wheelPropagation: !1,
                suppressScrollX: !0,
            }),
            h(),
            s.length &&
            s.maxlength({
                alwaysShow: !0,
                warningClass: "label label-success bg-success text-white",
                limitReachedClass: "label label-danger",
                separator: "/",
                validate: !0,
                threshold: 120,
            }),
            l.forEach((e) => {
                e.addEventListener("click", (e) => {
                    let t = document.querySelector(
                        ".chat-sidebar-left-user .avatar"
                    ),
                        a = e.currentTarget.value;
                    t.removeAttribute("class"),
                        Helpers._addClass("avatar avatar-xl " + u[a], t);
                    let c = document.querySelector(
                        ".app-chat-contacts .avatar"
                    );
                    c.removeAttribute("class"),
                        Helpers._addClass(
                            "flex-shrink-0 avatar " + u[a] + " me-3",
                            c
                        );
                });
            }),
            t.forEach((e) => {
                e.addEventListener("click", (e) => {
                    t.forEach((e) => {
                        e.classList.remove("active");
                    }),
                        e.currentTarget.classList.add("active");
                });
            }),
            i &&
            i.addEventListener("keyup", (e) => {
                let t = e.currentTarget.value.toLowerCase(),
                    a = document.querySelector(".chat-list-item-0"),
                    c = document.querySelector(".contact-list-item-0"),
                    r = [].slice.call(
                        document.querySelectorAll(
                            "#chat-list li:not(.chat-contact-list-item-title)"
                        )
                    ),
                    l = [].slice.call(
                        document.querySelectorAll(
                            "#contact-list li:not(.chat-contact-list-item-title)"
                        )
                    );
                m(r, 0, t, a), m(l, 0, t, c);
            }),
            o.addEventListener("submit", (e) => {
                // if ((e.preventDefault(), n.value)) {
                //     let e = document.createElement("div");
                //     (e.className = "chat-message-text mt-2"),
                //         (e.innerHTML =
                //             '<p class="mb-0 text-break">' + n.value + "</p>"),
                //         document
                //             .querySelector(
                //                 "li:last-child .chat-message-wrapper"
                //             )
                //             .appendChild(e),
                //         (n.value = ""),
                //         h();
                // }
            });
        let p = document.querySelector(
            ".chat-history-header [data-target='#app-chat-contacts']"
        ),
            f = document.querySelector(".app-chat-sidebar-left .close-sidebar");
        if (
            (p.addEventListener("click", (e) => {
                f.removeAttribute("data-overlay");
            }),
                d.length)
        ) {
            var v = v || webkitSpeechRecognition;
            if (null != v) {
                var b = new v(),
                    y = !1;
                d.on("click", function () {
                    const e = $(this);
                    (b.onspeechstart = function () {
                        y = !0;
                    }),
                        !1 === y && b.start(),
                        (b.onerror = function (e) {
                            y = !1;
                        }),
                        (b.onresult = function (t) {
                            e.closest(".form-send-message")
                                .find(".message-input")
                                .val(t.results[0][0].transcript);
                        }),
                        (b.onspeechend = function (e) {
                            (y = !1), b.stop();
                        });
                });
            }
        }
    })();
});
