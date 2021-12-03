
var $: any;
((): void => {
  const handler: HTMLElement | null = document.querySelector("#menuHandler");
  const menu: HTMLDivElement | null = document.querySelector("#menu");
  handler &&
      handler.addEventListener("click", (): void => {
        $("#menuContainer").css("padding", "15px")
        $(menu).slideToggle()

    });
})()

/**
 * All these lines bellow concern menu humberger
 */
const toggleButton: Element | null = document.getElementById("toggle-button");
if (toggleButton) {
  const iconButton: Element | null = toggleButton.querySelector(".fas");
  const navbar : Element | null = document.getElementById("navbar");

toggleButton.addEventListener("click", () => {
  navbar && navbar.classList.toggle("hidden");
  if (iconButton)
    if (iconButton.classList.contains("fa-bars")) {
      iconButton.classList.remove("fa-bars");
      iconButton.classList.add("fa-times");
    } else {
      iconButton.classList.remove("fa-times");
      iconButton.classList.add("fa-bars");
    }
});
}
//End of menu humberger code
/**
 * This function handles the admin time each minutes.
 */
const timeHandler = (): void => {
  const time: Date = new Date
  const adminTimer: Element | null = document.querySelector("#adminTimer");
  console.log(adminTimer)
  if (adminTimer) {
      adminTimer.textContent = `${time.getHours()} : ${time.getMinutes()}`;
  }
}
$(document).ready(() => {
  setInterval(() => timeHandler(), 10000);
})


