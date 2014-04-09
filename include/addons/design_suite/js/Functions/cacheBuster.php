            function cacheBuster(url) {
		    return url.replace(/\?cacheBuster=\d*/, "") + "?cacheBuster=" + new Date().getTime().toString();
		}