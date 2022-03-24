import Toastify from "toastify-js";

const bgColors = [
    "linear-gradient(to right, #00b09b, #96c93d)",
    "linear-gradient(to right, #ff5f6d, #ffc371)",
    "linear-gradient(to left, #01b08b, #96c93d)",
    "linear-gradient(to left, #02b08b, #96c86d)",
];

let i = 0;

export function showToast(text) {
    i++;
    return Toastify({
        text: text,
        duration: 3000,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
        style: {
            background: bgColors[i % bgColors.length],
        },
        onClick: function() {}
    }).showToast();
}

export default showToast;