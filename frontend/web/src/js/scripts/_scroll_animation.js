const animItems = document.querySelectorAll('.-js-animation');
if (animItems.length > 0) {
   window.addEventListener('scroll', animOnScroll);

   function animOnScroll(params) {
      for (let index = 0; index < animItems.length; index++) {
         const animItem = animItems[index];
         const animItemHights = animItem.offsetHeight;
         const animItemOffset = offset(animItem).top;
         const animStart = 4;

         let animItemPoint = window.innerHeight - animItemHights / animStart;

         if (animItemHights > window.innerHeight) {
            animItemPoint = window.innerHeight - window.innerHeight / animStart;
         }

         if ((pageYOffset > animItemOffset - animItemPoint) && pageYOffset < (animItemOffset + animItemHights)) {
            animItem.classList.add('-active');
         } else {
            animItem.classList.remove('-active');
         }
      }
   }

   function offset(el) {
      const rect = el.getBoundingClientRect(),
         scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
         scrollTop = window.pageXOffset || document.documentElement.scrollTop;
      return {
         top: rect.top + scrollTop,
         left: rect.left + scrollLeft
      }
   }

   setTimeout(() => {
      animOnScroll();
   }, 300);

}