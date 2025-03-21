function styleToggle(str) {
    document.cookie = "theme=" + str + "; SameSite=lax; path=/;";
    let sheets= document.getElementsByTagName('link');
    sheets[0].href = str;
}

// function init_style() {
//     const style = document.cookie.split("; ").find((row) => row.startsWith("theme="))?.split("=")[1] ?? "/static/stylesheet.css";
//     switch (style) {
//         case "/static/stylesheet.css":
//             styleToggle('/static/stylesheet.css');
//             break;
//         case "/static/lush.css":
//             styleToggle('/static/lush.css');
//             break;
//         case "/static/mono.css":
//             styleToggle('/static/mono.css');
//             break;
//     }
// }