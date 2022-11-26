const hamburger = document.querySelector(".hamburger");
if (hamburger) {
	hamburger.addEventListener("click", function () {

		var width = window.innerWidth - document.body.clientWidth;
		let bodyTag = document.querySelector("body");

		bodyTag.classList.toggle("-scrollbar-width");
		bodyTag.classList.toggle("lock");

		if (bodyTag.classList.contains("-scrollbar-width")) {
			bodyTag.style.marginRight = width + "px";
		} else {
			bodyTag.style.marginRight = "auto";
		}
	});
}

