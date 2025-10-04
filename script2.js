// 20 food items with local images
const foods = [
    { name: "Pizza", price: 250, img: "images/pizza.jpg" },
    { name: "Burger", price: 120, img: "images/burger.jpg" },
    { name: "Pasta", price: 200, img: "images/pasta.jpg" },
    { name: "Sandwich", price: 100, img: "images/sandwich.jpg" },
    { name: "French Fries", price: 80, img: "images/frenchfries.jpg" },
    { name: "Ice Cream", price: 70, img: "images/icecream.jpg" },
    { name: "Chicken Wings", price: 180, img: "images/chickenwings.jpg" },
    { name: "Salad", price: 90, img: "images/salad.jpg" },
    { name: "Chocolate Cake", price: 150, img: "images/chocolatecake.jpg" },
    { name: "Momos", price: 130, img: "images/momos.jpg" },
    { name: "Sushi", price: 300, img: "images/sushi.jpg" },
    { name: "Pancakes", price: 150, img: "images/pancakes.jpg" },
    { name: "Tacos", price: 180, img: "images/tacos.jpg" },
    { name: "Steak", price: 450, img: "images/steak.jpg" },
    { name: "Noodles", price: 120, img: "images/noodles.jpg" },
    { name: "Fried Rice", price: 140, img: "images/friedrice.jpg" },
    { name: "Cheese Burger", price: 160, img: "images/cheeseburger.jpg" },
    { name: "Veg Pizza", price: 220, img: "images/vegpizza.jpg" },
    { name: "Donut", price: 60, img: "images/donut.jpg" },
    { name: "Fruit Juice", price: 90, img: "images/fruitjuice.jpg" }
];

// Container element in HTML
const container = document.getElementById("food-container");

// Generate food cards dynamically
foods.forEach(food => {
    const card = document.createElement("div");
    card.classList.add("food-card");

    card.innerHTML = `
        <img src="${food.img}" alt="${food.name}" class="food-img" loading="lazy">
        <h3>${food.name}</h3>
        <p>Price: ₹${food.price}</p>
        <button>Add to Cart</button>
    `;

    container.appendChild(card);
});
