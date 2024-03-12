window.onload = () => {
  const messageSuccess = document.getElementById("message");

  if (messageSuccess) {
    setTimeout(() => {
      messageSuccess.setAttribute(
        "style",
        "transition: all 0.2s ease-in-out; transform: translate(-100%, 0)",
      );
    }, 1500);
  }
};
