/* Script from https://www.w3schools.com/howto/howto_js_navbar_hide_scroll.asp */
var prev_scroll_pos = get_current_scroll();

function navbar_scroll() {
    let current_scroll_pos = get_current_scroll();

    console.log(current_scroll_pos);

    if (current_scroll_pos > 1)
        document.getElementById("index-navbar").classList.add("nav-bg-black");
    else
        document.getElementById("index-navbar").classList.remove("nav-bg-black");

    if (current_scroll_pos < document.getElementById("index-carousel-travel").offsetHeight) {
        document.getElementById("index-navbar").style.top = "0";
        return;
    }

    if (prev_scroll_pos < current_scroll_pos)
        document.getElementById("index-navbar").style.top = `-${document.getElementById("index-navbar").offsetHeight}px`;
    else
        document.getElementById("index-navbar").style.top = "0";

    prev_scroll_pos = current_scroll_pos;
}

function get_current_scroll() {
    return window.pageYOffset || document.documentElement.scrollTop;
}

window.onscroll = navbar_scroll;
