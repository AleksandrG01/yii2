
//add vendor in \assets\src\vendor
//include('../../../../../../node_modules/jquery/dist/jquery.min.js')
//include('../../vendor/alpine.js')
//include('../../vendor/custom-scrollbar-plugin-master/jquery.mCustomScrollbar.js')
//include('../../vendor/jquery-mousewheel/jquery.mousewheel.js')
//include('../../vendor/fullPage/jquery.fullpage.min.js')
//include('../../plugins/nouislider/dist/nouislider.js')
//include('../../vendor/svg4everybody.js')
//include('../../vendor/velocity.js')
//include('_webp.js')

//include('../../vendor/swiper/swiper-bundle.min.js')
//include('../../vendor/sweetalert2/dist/sweetalert2.all.min.js')
//include('_dynamic_adaptation.js')
//include('_scroll_animation.js')
document.addEventListener('alpine:init', () => {
	Alpine.store('openForm', {
		on: false,
		close: false,

		toggle() {
			this.on = ! this.on;
		},

		closeForm() {
			this.close = true;
			this.on = false;
		}
	});

	Alpine.data('imgPreview', () => ({
		imgsrc:null,
		previewFile() {
			let file = this.$refs.myFile.files[0];
			if(!file || file.type.indexOf('image/') === -1) return;
			this.imgsrc = null;
			let reader = new FileReader();
	
			reader.onload = e => {
				this.imgsrc = e.target.result;
			}
	
			reader.readAsDataURL(file);
		
		},

		clearFile(){
			this.imgsrc = null;
		},

		showedImage(){
			if(this.imgsrc != null){
				return true;
			}
		}

	  }))
})