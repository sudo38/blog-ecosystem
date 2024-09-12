function get_title(title) {
   document.title = title;
}

function get_link(href) {
   var link = document.createElement('link');
   link.rel = 'stylesheet';
   link.type = 'text/css';
   link.href = href;
   document.head.appendChild(link);
}

function get_script(src) {
   var script = document.createElement('script');
   script.type = 'text/javascript';
   script.src = src;
   document.documentElement.appendChild(script);
}

