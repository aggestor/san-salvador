
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
  if (adminTimer) {
      adminTimer.textContent = `${time.getHours()} : ${time.getMinutes()}`;
  }
}
$(document).ready(() => {
  setInterval(() => timeHandler(), 10000);
     $("#hamburger").on("click", () => {
       $("#other").slideUp("slow");
       $("#mobile").slideDown("slow");
     });
     $("#times").on("click", () => {
       $("#mobile").slideUp("slow");
       $("#other").slideDown("slow");
     });
     $("#year").text(new Date().getFullYear().toString());
})

const imageUpload: HTMLInputElement | null = document.querySelector("#image");
$(".hide-b4-save").hide()
/**
 * Initializing cropper class
 */

var Cropper: any;
const cropper = new Cropper({
  width: 320,
  height: 320,
  onChange: function () {
    const image = this.getCroppedImage();
    const file = dataURLtoFile(image, "user");
    if (imageUpload && file && imageUpload.files) {
      const dataTransfer = new DataTransfer()
      dataTransfer.items.add(file)
      imageUpload.files = dataTransfer.files
    }
  },
});
type stringable = string | null
/**
 * Covert base64 data image to Javascript object File
 * @param dataUrl 
 * @param filename 
 * @returns {File | undefined}
 */
function dataURLtoFile(dataUrl:string, filename:string) : File | undefined {
  let array = dataUrl.split(",")
  if (array !== null) {
    const matchExtension: RegExpMatchArray | null = array[0].match(/data:(.*);/);
    const matchMimeType: RegExpMatchArray | null = array[0].match(/:(.*?);/);
    let extension: stringable
    let mime : stringable
    
    if (matchExtension !== null) {

      extension = matchExtension[1].split("/")[1];

      if (matchMimeType !== null) {

        mime = matchMimeType[1]

        let bstr = atob(array[1])
        let n = bstr.length
        let u8array : Uint8Array = new Uint8Array(n)
      
        while (n--) {
          u8array[n] = bstr.charCodeAt(n);
        }
        return new File([u8array], filename + "." + extension, { type: mime });
      }
    }
  }
}
const imageUploader: HTMLInputElement | null = document.querySelector("#imageToCrop")
imageUploader && imageUploader.addEventListener("change", (evt) => {
  if (evt.target !== null) {
    const target : any = evt.target
    const image = target.files[0];
    if (image) {
      const fileReader = new FileReader()
      fileReader.onload = function () {
        cropper.loadImage(fileReader.result).then(() : void =>{})
        $("#crop").slideDown()
        $("#crop").removeClass(".hidden")
        $(".hide-b4-save").slideDown();
      }
      fileReader.readAsDataURL(image)
    }
  }
});
document.querySelector("#crop") && cropper.render("#crop");
//Add user interactions stars here

const formStepsButtons: NodeListOf<HTMLButtonElement> | null = document.querySelectorAll(".form-user-btn")
formStepsButtons && formStepsButtons.forEach((button : HTMLButtonElement) => {
  const buttonName: string = button.name
  $(button).on("click", function (e : Event) {
    e.preventDefault()
    useFormButtons(buttonName)
  })

  const cameraBtn: HTMLButtonElement | null = document.querySelector("#camera")
  if(cameraBtn && imageUploader)
  cameraBtn.addEventListener("click", (e: Event) => {
    e.preventDefault()
    imageUploader.click()
    e.stopImmediatePropagation()
  })


  function useFormButtons(name: string): void{
    switch (name) {
      case "2":
        $(".form-1").slideUp()
        $("#register-title").text(
          "Ajouter votre photo en cliquant sur le bouton ci-bas"
        );
        $("#userIcon").slideUp();
        $(".form-2").slideDown()
        break;
      case "-2":
        $(".form-1").slideDown()
        $(".form-2").slideUp()
        break;
    }
  }
})

const userMenus = document.querySelectorAll("[data-path-user]")
console.log(userMenus)

userMenus.forEach(menu => {
  menu.addEventListener("click", function (): void{
    const path = menu.getAttribute("data-path-user")
    if (path) {
      window.location.pathname = path
    }
    
  })
})
/**
 * Pairing sides
 */
const paringSides  = document.querySelector("#pairing-sides");
const sides: NodeListOf<Element> | undefined = paringSides?.querySelectorAll("[data-side]")

sides?.forEach((side): void => {
  side.addEventListener("click", (e) => {
    const sideId = side.getAttribute("data-side")
    setActiveSide(side)
    
  })
})
function setActiveSide(side?: Element): void {
  $(side).attr(
    "class",
    "flex border border-gray-400 cursor-pointer bg-green-500 text-gray-900 rounded h-12 p-1 items-center w-4/12 justify-between"
  );
  $(side).siblings().attr("class", "flex border border-gray-400 cursor-pointer text-gray-300 rounded h-12 p-1 items-center w-4/12 justify-between")
  const sideCircle = side?.querySelector("span:nth-child(2)")
  $($(side).siblings().children()[1]).html("<i></i>")
  $(sideCircle).attr("class","h-7 w-7 rounded-full border border-gray-900 grid place-items-center bg-gray-900");
  $(sideCircle).html("<i class='fas fa-check-circle text-green-500'></i>");
   $("#valueToCopy").text(
     `https://usalvagetrade.com/register-${$(side).data("side")}-${$(
       "#valueToCopy"
     ).data("parent")}-${$("#valueToCopy").data("sponsor")}`
   );
  
}

$("#copy").click(() => {
  const valueToCopy = document.querySelector("#valueToCopy")
  
  
  
})



declare type animationType = "slide" | "fade"
declare type displayType = "hide" | "show";
/**
 * Helps to switch Jquery display for many elements
 * @param {Array<HTMLElement>} elements elements that will switch to another display
 * @param {displayType}display  display to give to the elements
 * @param {animationType} animation  display to give to the elements
 */
function displaySwitcher(elements : Array<HTMLElement>, display : displayType, animation : animationType) {
  elements.forEach(elt => {
    if (display === "hide" && animation === "slide") {
      $(elt).slideUp()
    } else if (display === "show" && animation === "slide") {
      $(elt).slideDown();
    }
     
  })
}
/**
 * Transactions buttons don't have nothing to do with admin transactions cheking
 * We are using these buttons to just switch between transaction sources
 * All these three buttons are used to just switch them
 */
const transactionBtns = document.querySelectorAll(".transaction-btn");
const defaultTransactionData : HTMLElement | null = document.querySelector(
  "#defaultTransactionData"
);
let AMTransactionData : HTMLElement | null = document.querySelector("#AMTransactionData");
let MPSTransactionData: HTMLElement | null = document.querySelector(
  "#MPSTransactionData"
);
let BTCTransactionData: HTMLElement | null = document.querySelector(
  "#BTCTransactionData"
);
transactionBtns.forEach((btn: Element) => {
  const dataTransType = btn.getAttribute("data-trans-type")
  $(btn).on("click", (e: Event) => {
    e.preventDefault()
    /**
     * There's still some issues about the design and css logic for the buttons
     * About functionnality the are working perfectly
     */
    let activeBtnClass = "w-4/12 transaction-btn hover:bg-blue-800 bg-blue-600 text-white hover:text-white rounded-l transition-all duration-150 cursor-pointer justify-center font-semibold text-center flex items-center"
    if (dataTransType === "btc") {
      console.log("ok ok")
      AMTransactionData &&
        MPSTransactionData &&
        displaySwitcher(
          [MPSTransactionData,AMTransactionData],
          "hide",
          "slide"
        );
      BTCTransactionData && displaySwitcher([BTCTransactionData], "show", "slide")
    } else if (dataTransType === "am") {
      activeBtnClass =
        "w-4/12 transaction-btn hover:bg-blue-800 bg-blue-600 text-white hover:text-white  transition-all duration-150 cursor-pointer justify-center font-semibold text-center flex items-center";
      BTCTransactionData &&
        MPSTransactionData &&
        displaySwitcher(
          [BTCTransactionData, MPSTransactionData],
          "hide",
          "slide"
        );
      AMTransactionData &&
        displaySwitcher([AMTransactionData], "show", "slide");
    } else if (dataTransType === "mps") {
       activeBtnClass =
        "w-4/12 transaction-btn hover:bg-blue-800 bg-blue-600 text-white hover:text-white rounded-r  transition-all duration-150 cursor-pointer justify-center font-semibold text-center flex items-center";
      BTCTransactionData &&
        AMTransactionData &&
        displaySwitcher(
          [BTCTransactionData, AMTransactionData],
          "hide",
          "slide"
        );
      MPSTransactionData && displaySwitcher([MPSTransactionData], "show", "slide")
    }
    defaultTransactionData && displaySwitcher([defaultTransactionData], "hide", "slide")
    $(btn)
      .attr(
        "class",
        activeBtnClass
      )
      .siblings()
      .attr(
        "class",
        "w-4/12 transaction-btn hover:bg-blue-600 hover:text-white transition-all duration-150 cursor-pointer justify-center font-semibold text-center flex items-center text-gray-300"
    );
  })
})