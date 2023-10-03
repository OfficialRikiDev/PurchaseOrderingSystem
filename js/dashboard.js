const container = document.querySelector("main");
const search = document.querySelector(".search label");
const expander = document.querySelector("main .menu .expander");
const current = document.querySelector(".current");
const menuItems = document.querySelectorAll("main .menu .primary .menu-item");
const mainCards = document.querySelectorAll("main .dashboard .random");
const weatherContent = document.querySelector(".side .weather .content");
const date = document.querySelector("main .side .date");
const time = document.querySelector("main .side .time");
const loc = document.querySelector("main .side .location");

// Fix :active touch on mobiles
document.addEventListener("touchstart", () => { }, true);

// Search Expand
search.addEventListener("click", () => container.classList.toggle("search"));

// Main Menu
menuItems.forEach((item) => {
    item.addEventListener("click", () => {
        current.innerText = item.querySelector(".desc").textContent;
        menuItems.forEach((item) => item.classList.remove("active"));
        item.classList.add("active");
    });
});

// Set Date, Time
const today = new Date();
const formatZero = (value) => value < 10 ? '0' + value : value;
const ampm = today.getHours() >= 12 ? 'pm' : 'am';
const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
date.innerText = `${today.getDate()} ${months[today.getMonth()]}, ${today.getFullYear()}`;
time.innerText = `${today.getHours()}:${formatZero(today.getMinutes())} ${ampm.toUpperCase()}`;

// Populate News
const dummyData = () => {
    mainCards.forEach((card, i) => {
        card.querySelector(".title").innerText =
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit.";
        card.querySelector(
            ".content"
        ).innerText = "Aliquam vitae laoreet purus. Vivamus tincidunt nibh rhoncus, varius libero dignissim, molestie odio. Aenean sit amet felis et lectus viverra elementum. In quis tortor dignissim, ultrices odio et, dignissim quam. Donec scelerisque lacinia dolor, a pulvinar enim auctor quis. Sed mollis faucibus lacus id sagittis. Nunc et fringilla ipsum, et dignissim erat. Vivamus leo lorem, iaculis tempor quam nec, malesuada ullamcorper ipsum...".slice(
            0,
            Math.round(Math.random() * -200)
        );
    });
};


function weather() {
    
    $.ajax({

        url: "http://ip-api.com/json/",
        type: "GET",
        success: function (response) {
            if (response) {
                weatherData(response);
            }  
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
};
// Weather Data for Athe    ns from open-meteo.com
function weatherData(location) {
    const latitude = location.lat;
    const longitude = location.lon;
    $.ajax({

        url: "https://api.open-meteo.com/v1/forecast?latitude="+latitude+"&longitude="+longitude+"&hourly=temperature_2m&current_weather=true",
        type: "GET",
        success: function (response) {
            //console.log(response);
            if (response) {
                weatherContent.innerHTML = `
            ${response.current_weather.temperature}<span class='celsius'>°C</span>
                
            `;
            loc.innerHTML = `<span class="iconoir-pin-alt"></span> ${location.city}, ${location.country}`;
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });   
}
dummyData();

weather();