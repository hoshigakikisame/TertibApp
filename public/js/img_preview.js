// javascript for image preview
const inputProfileImage = document.querySelector("#input_profile_image");
const imgProfileImage = document.querySelector("#img_profile_image");
const labelProfileImage = document.querySelector("#label_profile_image");

inputProfileImage.addEventListener("change", (e) => {
  const file = e.target.files[0];
  const url = URL.createObjectURL(file);
  imgProfileImage.src = url;
});
