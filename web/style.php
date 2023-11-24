* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
body {
  background-color: #0C356A;
}
.wrapper {
  width: min(100%, 90%);
  position: absolute;
  transform: translateX(-5%);
  top: 5em;
  left: 10%;
  background-color: #ffffff;
  padding: 2em 3em;
  border-radius: 0.5em;
  min-height: 700px;
}
.navku {
  width: min(100%, 90%);
  position: absolute;
  transform: translateX(-5%);
  top: -20px;
  left: 10%;
  padding: 2em 3em;
  border-radius: 0.5em;
}
.container {
  max-height: 1000px;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1em;
  border-radius: 7px;
}
.container .image-container,
.container .preview-container {
  width: 100%;
  max-height: 700px;
}
input[type="file"] {
  display: none;
}
label .upg{
  display: block;
  position: relative;
  background-color: #025bee;
  color: #ffffff;
  font-size: 16px;
  text-align: center;
  padding: 16px 0;
  border-radius: 0.3em;
  margin: 16px auto;
  cursor: pointer;
}

img {
  display: block;
  /* Important for cropper js*/
  max-width: 100%;
  max-height: 700px;
}
#preview-image{
  max-height: 400px;
}
.image-container {
  width: 60%;
  margin: 0 auto;
}
.options {
  justify-content: center;
  gap: 1em;
}
input[type="number"] {
  padding: 3px;
  max-width: 100px;
  margin: 4px;
  margin-left:15px ;
  border-radius: 0.3em;
  border: 2px solid #000000;
}
button .b{
  padding: 1em;
  margin: 2px;
  border-radius: 0.3em;
  border: 2px solid #025bee;
  background-color: #ffffff;
  color: #025bee;
}
.btns {
  display: block;
  justify-content: center;
  gap: 1em;
  margin-top: 1em;
}
.btns button {
  font-size: 1em;
}
.btns a .btn{
  border: 2px solid #025bee;
  background-color: #025bee;
  color: #ffffff;
  text-decoration: none;
  padding: 1em;
  font-size: 1em;
  border-radius: 0.3em;
}
.hide {
  display: none;
}