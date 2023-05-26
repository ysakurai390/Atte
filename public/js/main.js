function clickBtn1() {
  if (document.getElementById("b1").disabled === true) {
    document.getElementById("b1").removeAttribute("disabled");
  } else {
    document.getElementById("b1").setAttribute("disabled", true);
  }
}