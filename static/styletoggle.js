function styleToggle(str) {
    let sheets= document.getElementsByTagName('link');
    sheets[0].href = str;
    document.cookie = "theme=" + str + "; SameSite=lax; path=/;";
}

function init_style() {
    const style = document.cookie.split("; ").find((row) => row.startsWith("theme="))?.split("=")[1];
    if (!document.cookie.startsWith("theme=")) {
        styleToggle('/static/stylesheet.css');
    } else {
        switch (style) {
            case "/static/stylesheet.css":
                styleToggle('/static/stylesheet.css');
                break;
            case "/static/lush.css":
                styleToggle('/static/lush.css');
                break;
            case "/static/mono.css":
                styleToggle('/static/mono.css');
                break;
        }
    }
}