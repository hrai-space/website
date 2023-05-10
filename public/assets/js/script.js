const Events = () => {
    const e = document.getElementById("account-button"),
        t = document.getElementById("account-container");
    e.addEventListener("click", () => {
        t.classList.toggle("maximized");
    });
};
Events();
const initialisePageEvents = () => {
    const e = document.getElementById("notification-button"),
        t = document.getElementById("notification-container");
    e.addEventListener("click", () => {
        t.classList.toggle("maximized");
    });
};
initialisePageEvents();
const notRegistered = () => {
    const e = document.getElementById("account-button"),
        t = document.getElementById("not-registered-container");
    e.addEventListener("click", () => {
        t.classList.toggle("maximized");
    });
};
function dropDown() {
    var e = $(".dropdown-element"),
        t = document.getElementById("icon"),
        o = document.getElementById("text"),
        n = document.getElementById("triangle"),
        l = document.getElementById("side-nav");
    e.is(":visible")
        ? (e.slideUp(255),
          (t.style.color = ""),
          (o.style.color = ""),
          (n.style.color = ""),
          (n.style.transform = ""),
          (l.style.height = ""),
          (l.style.position = ""))
        : (e.slideDown(255),
          (t.style.color = "#598DE0"),
          (o.style.color = "#fff"),
          (n.style.color = "#fff"),
          (n.style.transform = "rotate(180deg)"),
          (l.style.height = "auto"));
}
function dropDownSecond() {
    var e = $(".dropdown-element-second"),
        t = document.getElementById("text-second"),
        o = document.getElementById("triangle-second"),
        n = document.getElementById("side-nav");
    e.is(":visible")
        ? (e.slideUp(255),
          (t.style.color = ""),
          (o.style.color = ""),
          (o.style.transform = ""),
          (n.style.height = ""))
        : (e.slideDown(255),
          (t.style.color = "#fff"),
          (o.style.color = "#fff"),
          (o.style.transform = "rotate(180deg)"),
          (n.style.height = "auto"));
}
function dropDownThird() {
    var e = $(".dropdown-element-third"),
        t = document.getElementById("text-third"),
        o = document.getElementById("triangle-third");
    document.getElementById("side-nav");
    e.is(":visible")
        ? (e.slideUp(255),
          (t.style.color = ""),
          (o.style.color = ""),
          (o.style.transform = ""))
        : (e.slideDown(255),
          (t.style.color = "#fff"),
          (o.style.color = "#fff"),
          (o.style.transform = "rotate(180deg)"));
}
function dropDownFourth() {
    var e = $(".dropdown-element-fourth"),
        t = document.getElementById("text-fourth"),
        o = document.getElementById("triangle-fourth"),
        n = document.getElementById("side-nav");
    e.is(":visible")
        ? (e.slideUp(255),
          (t.style.color = ""),
          (o.style.color = ""),
          (o.style.transform = ""),
          (n.style.height = "auto"))
        : (e.slideDown(255),
          (t.style.color = "#fff"),
          (o.style.color = "#fff"),
          (o.style.transform = "rotate(180deg)"),
          (n.style.height = "auto"));
}
function dropDownFifth() {
    var e = $(".dropdown-element-fifth"),
        t = document.getElementById("text-fifth"),
        o = document.getElementById("triangle-fifth");
    document.getElementById("side-nav");
    e.is(":visible")
        ? (e.slideUp(255),
          (t.style.color = ""),
          (o.style.color = ""),
          (o.style.transform = ""))
        : (e.slideDown(255),
          (t.style.color = "#fff"),
          (o.style.color = "#fff"),
          (o.style.transform = "rotate(180deg)"));
}
function dropDownSixth() {
    var e = $(".dropdown-element-sixth"),
        t = document.getElementById("text-sixth"),
        o = document.getElementById("triangle-sixth"),
        n = document.getElementById("side-nav");
    e.is(":visible")
        ? (e.slideUp(255),
          (t.style.color = ""),
          (o.style.color = ""),
          (o.style.transform = ""),
          (n.style.height = "auto"))
        : (e.slideDown(255),
          (t.style.color = "#fff"),
          (o.style.color = "#fff"),
          (o.style.transform = "rotate(180deg)"),
          (n.style.height = "auto"));
}
function dropdown() {
    var e = document.getElementById("dropdown"),
        t = document.getElementById("dropdown-triangle"),
        o = $(".ddown-menu");
    o.is(":visible")
        ? (o.hide(),
          (e.style.color = ""),
          (t.style.color = ""),
          (t.style.transform = ""))
        : (o.show(),
          (e.style.color = "#fff"),
          (t.style.color = "#fff"),
          (t.style.transform = "rotate(180deg)"));
}
function dropdownSecond() {
    var e = document.getElementById("dropdown-second"),
        t = document.getElementById("dropdown-triangle-second"),
        o = $(".dpdown-menu");
    o.is(":visible")
        ? (o.hide(),
          (e.style.color = ""),
          (t.style.color = ""),
          (t.style.transform = ""))
        : (o.show(),
          (e.style.color = "#fff"),
          (t.style.color = "#fff"),
          (t.style.transform = "rotate(180deg)"));
}
notRegistered(),
    jQuery(document).ready(function (e) {
        e(".popup-trigger").on("click", function (t) {
            t.preventDefault(), e(".popup").addClass("is-visible");
        }),
            e(".popup").on("click", function (t) {
                (e(t.target).is(".popup-close") || e(t.target).is(".popup")) &&
                    (t.preventDefault(), e(this).removeClass("is-visible"));
            }),
            e(document).keyup(function (t) {
                "27" == t.which && e(".popup").removeClass("is-visible");
            });
    }),
    jQuery(document).ready(function (e) {
        e(".pop-trigger").on("click", function (t) {
            t.preventDefault(), e(".pop").addClass("e-visible");
        }),
            e(".pop").on("click", function (t) {
                (e(t.target).is(".pop-close") || e(t.target).is(".pop")) &&
                    (t.preventDefault(), e(this).removeClass("e-visible"));
            }),
            e(document).keyup(function (t) {
                "27" == t.which && e(".pop").removeClass("e-visible");
            });
    }),
    jQuery(document).ready(function (e) {
        e(".up-trigger").on("click", function (t) {
            t.preventDefault(), e(".up").addClass("visible");
        }),
            e(".up").on("click", function (t) {
                (e(t.target).is(".up-close") || e(t.target).is(".up")) &&
                    (t.preventDefault(), e(this).removeClass("visible"));
            }),
            e(document).keyup(function (t) {
                "27" == t.which && e(".up").removeClass("visible");
            });
    }),
    jQuery(document).ready(function (e) {
        e(".ip-trigger").on("click", function (t) {
            t.preventDefault(), e(".ip").addClass("visible");
        }),
            e(".ip").on("click", function (t) {
                (e(t.target).is(".ip-close") || e(t.target).is(".ip")) &&
                    (t.preventDefault(), e(this).removeClass("visible"));
            }),
            e(document).keyup(function (t) {
                "27" == t.which && e(".ip").removeClass("visible");
            });
    });
var swiper = new Swiper(".blog-slider", {
    spaceBetween: 30,
    effect: "fade",
    loop: !0,
    mousewheel: { invert: !1 },
    pagination: { el: ".blog-slider__pagination", clickable: !0 },
});
function drop() {
    var e = document.getElementById("text"),
        t = document.getElementById("triangle"),
        o = $(".analytics-list-item-hidden");
    o.is(":visible")
        ? (o.hide(),
          (e.style.color = ""),
          (t.style.color = ""),
          (t.style.transform = ""))
        : (o.show(),
          (e.style.color = "#fff"),
          (t.style.color = "#fff"),
          (t.style.transform = "rotate(180deg)"));
}
function dropSecond() {
    var e = document.getElementById("text-second"),
        t = document.getElementById("triangle-second"),
        o = $(".analytics-list-item-hidden-second");
    o.is(":visible")
        ? (o.hide(),
          (e.style.color = ""),
          (t.style.color = ""),
          (t.style.transform = ""))
        : (o.show(),
          (e.style.color = "#fff"),
          (t.style.color = "#fff"),
          (t.style.transform = "rotate(180deg)"));
}
function dropyDown() {
    var e = $(".dropydown-element"),
        t = document.getElementById("texty"),
        o = document.getElementById("triangly");
    e.is(":visible")
        ? (e.slideUp(255),
          (t.style.color = ""),
          (o.style.color = ""),
          (o.style.transform = ""))
        : (e.slideDown(255),
          (t.style.color = "#fff"),
          (o.style.color = "#fff"),
          (o.style.transform = "rotate(180deg)"));
}
const ctx = document.getElementById("views");
new Chart(ctx, {
    type: "bar",
    data: {
        labels: ["Mar", "Apr", "May"],
        datasets: [
            {
                data: [400, 150, 200],
                borderWidth: 2,
                borderRadius: 20,
                backgroundColor: "#2351F4",
                hoverBorderColor: "#fff",
                minBarWidth: "180px",
                barThickness: 100,
            },
        ],
    },
    options: {
        responsive: !0,
        plugins: {
            legend: { display: !1 },
            title: {
                display: !0,
                text: "Views",
                color: "#fff",
                align: "start",
                font: {
                    family: "Public Sans, sans-serif",
                    style: "normal",
                    weight: "600",
                    size: "20px",
                },
                padding: 30,
            },
        },
        scales: {
            y: {
                beginAtZero: !0,
                border: { color: "#676B70", display: !1 },
                grid: { color: "#676B70", lineWidth: 1 },
                ticks: {
                    max: 25e3,
                    min: 0,
                    stepSize: 100,
                    beginAtZero: !0,
                    padding: 20,
                },
            },
            x: { grid: { display: !1 } },
        },
    },
});
const ct = document.getElementById("downloads");
new Chart(ct, {
    type: "bar",
    data: {
        labels: ["Mar", "Apr", "May"],
        datasets: [
            {
                data: [12, 34, 52],
                borderWidth: 2,
                borderRadius: 20,
                backgroundColor: "#1CC52D",
                hoverBorderColor: "#fff",
                minBarWidth: "180px",
                barThickness: 100,
            },
        ],
    },
    options: {
        responsive: !0,
        plugins: {
            legend: { display: !1 },
            title: {
                display: !0,
                text: "Downloads",
                color: "#fff",
                align: "start",
                font: {
                    family: "Public Sans, sans-serif",
                    style: "normal",
                    weight: "600",
                    size: "20px",
                },
                padding: 30,
            },
        },
        scales: {
            y: {
                beginAtZero: !0,
                border: { color: "#676B70", display: !1 },
                grid: { color: "#676B70", lineWidth: 1 },
                ticks: {
                    max: 25e3,
                    min: 0,
                    stepSize: 10,
                    beginAtZero: !0,
                    padding: 20,
                },
            },
            x: { grid: { display: !1 } },
        },
    },
});
