var _smallHeader = document.getElementById("smallHeader");
var _sectionHeader = document.getElementById("sectionHeader");
var _bgfooter = document.getElementById("bg-footer");
var _header = document.getElementById("header");
var _globalH = document.getElementById("globalH");
var _uploadFile = document.getElementById("uploadFile");
var _imagePreview = document.getElementById("imagePreview");
var _footerFooter = document.getElementById("footerFooter");

if (document.contains(_smallHeader)) {
  _header.style.backgroundImage = "url(' ')";
  _header.style.backgroundColor = "#000";
  _header.style.height = "100px";
  _globalH.style.height = "100px";
  _sectionHeader.style.display = "none";
  _bgfooter.style.display = "none";
  _footerFooter.style.display="none";

}   else {
    alert("test");
}
