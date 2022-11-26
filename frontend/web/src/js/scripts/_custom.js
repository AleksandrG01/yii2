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