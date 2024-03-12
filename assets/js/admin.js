window.onload = () => {
  const messageSuccess = document.getElementById("message");

  if (messageSuccess) {
    setTimeout(() => {
      messageSuccess.setAttribute("style", "display: none");
    }, 1500);
  }
};
