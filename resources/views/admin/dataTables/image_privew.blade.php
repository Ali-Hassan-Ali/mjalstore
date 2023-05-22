<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
.container .wrapper{
  position: relative;
  height: 300px;
  width: 100%;
  border-radius: 10px;
  background: #fff;
  border: 2px dashed #c2cdda;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}
.wrapper.active{
  border: none;
}
.wrapper .image{
  position: absolute;
  height: 100%;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.wrapper img{
  height: 100%;
  width: 100%;
  object-fit: cover;
}
.wrapper .icon{
  font-size: 100px;
  color: #9658fe;
}
.wrapper .text{
  font-size: 20px;
  font-weight: 500;
  color: #5B5B7B;
}
.wrapper #cancel-btn i{
  position: absolute;
  font-size: 20px;
  right: 15px;
  top: 15px;
  color: #9658fe;
  cursor: pointer;
  display: none;
}
.wrapper.active:hover #cancel-btn i{
  display: block;
}
.wrapper #cancel-btn i:hover{
  color: #e74c3c;
}
.wrapper .file-name{
  position: absolute;
  bottom: 0px;
  width: 100%;
  padding: 8px 0;
  font-size: 18px;
  color: #fff;
  display: none;
  background: linear-gradient(135deg,#3a8ffe 0%,#9658fe 100%);
}
.wrapper.active:hover .file-name{
  display: block;
}
.container #custom-btn{
  margin-top: 30px;
  display: block;
  width: 100%;
  height: 50px;
  border: none;
  outline: none;
  border-radius: 25px;
  color: #fff;
  font-size: 18px;
  font-weight: 500;
  letter-spacing: 1px;
  text-transform: uppercase;
  cursor: pointer;
  background: linear-gradient(135deg,#3a8ffe 0%,#9658fe 100%);
}
</style>

<div class="container">
 <div class="wrapper">
    <div class="image">
      @if(isset($imagepath))
       <img src="{{ $imagepath }}" alt="" id="image-privew">
      @else
       <img src="" alt="" id="image-privew">
      @endif
    </div>
    <div class="content">
       <div class="icon">
          <i class="fas fa-cloud-upload-alt"></i>
       </div>
       <div class="text">
          No file chosen, yet!
       </div>
    </div>
    <div id="cancel-btn">
       <i class="fas fa-times"></i>
    </div>
    <div class="file-name">
       File name here
    </div>
 </div>
 <button type="button" onclick="defaultBtnActive()" id="custom-btn">Choose a file</button>
 <input id="default-btn" type="file" hidden name="{{ $name }}">
</div>
<script>
 const wrapper = document.querySelector(".wrapper");
 const fileName = document.querySelector(".file-name");
 const defaultBtn = document.querySelector("#default-btn");
 const customBtn = document.querySelector("#custom-btn");
 const cancelBtn = document.querySelector("#cancel-btn i");
 const img = document.querySelector("img");
 let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;
 function defaultBtnActive(){
   defaultBtn.click();
 }
 defaultBtn.addEventListener("change", function(){
   const file = this.files[0];

   	let reader = new FileReader();
	reader.onload = function (event) {
	    $("#image-privew").attr("src", event.target.result);
	};
	reader.readAsDataURL(file);

   if(file){
     const reader = new FileReader();
     reader.onload = function(){
       const result = reader.result;
       img.src = result;
       wrapper.classList.add("active");
     }
     cancelBtn.addEventListener("click", function(){
       img.src = "";
       wrapper.classList.remove("active");
     })
     reader.readAsDataURL(file);
   }
   if(this.value){
     let valueStore = this.value.match(regExp);
     fileName.textContent = valueStore;
   }
 });
</script>