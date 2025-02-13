const products = [
    {
        title: "Cruiser Backpack 23L",
        price: "₱9,600.00",
        image: "/CSS Exercise//public/img_1.webp",
        description:
            "Perfect for daily commutes or weekend adventures, this spacious backpack features water-repellent fabric and thoughtful organization.",
    },
    {
        title: "On My Level Barrel Duffle Bag 16L",
        price: "₱8,100.00",
        image: "/CSS Exercise//public/img_2.webp",
        description:
            "A versatile duffle bag designed for the gym and beyond, with durable fabric and multiple carrying options.",
    },
    {
        title: "New Crew Backpack 22L Logo",
        price: "₱6,600.00",
        image: "/CSS Exercise//public/img_3.webp",
        description:
            "Sleek and functional, this backpack combines style with practical features for your everyday needs.",
    },
    {
        title: "Boxy Tote Bag 10L",
        price: "₱8,100.00",
        image: "/CSS Exercise//public/img_4.webp",
        description:
            "A modern and stylish tote bag with a structured design, ideal for carrying essentials in a compact and organized way.",
    },
    {
        title: "Everywhere Backpack 22L",
        price: "₱6,100.00",
        image: "/CSS Exercise//public/img_5.webp",
        description:
            "A lightweight and durable backpack designed for daily use, featuring multiple compartments for easy organization.",
    },
];

function openDialog(index) {
    const product = products[index];
    document.getElementById("dialogImage").src = product.image;
    document.getElementById("dialogTitle").textContent = product.title;
    document.getElementById("dialogPrice").textContent = product.price;
    document.getElementById("dialogDescription").textContent =
        product.description;
    document.getElementById("dialogOverlay").classList.add("active");
    document.body.style.overflow = "hidden";
}

function closeDialog() {
    document.getElementById("dialogOverlay").classList.remove("active");
    document.body.style.overflow = "";
}

// Close dialog when clicking outside
document
    .getElementById("dialogOverlay")
    .addEventListener("click", function (e) {
        if (e.target === this) {
            closeDialog();
        }
    });

// Close dialog with Escape key
document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
        closeDialog();
    }
});
