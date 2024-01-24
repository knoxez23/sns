const path = sessionStorage.getItem("current_path");
const search = sessionStorage.getItem("current_search");

const fullPath = path + search;

const lastLocation = document.getElementById("last-location-input");
lastLocation.setAttribute("value", fullPath);