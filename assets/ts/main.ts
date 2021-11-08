const $ = window.$ || globalThis.$;

(():void =>  {
  const handler: HTMLElement | null = document.querySelector("#menuHandler");
  const menu: HTMLDivElement | null = document.querySelector("#menu");
  if (handler !== null) {
      handler.addEventListener("click", (): void => {
          console.log("kay")
        $(menu).slideToggle()
    });
  } else {
    console.warn(
      `impossibleClickEvent :  document.querySelector("#menuHandler") returns a null value, this maybe due to a wrong selectedElement or and undefined element `
    );
  }
})()
