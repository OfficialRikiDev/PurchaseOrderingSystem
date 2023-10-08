const container = document.querySelector("main");
const search = document.querySelector(".search label");
const expander = document.querySelector("main .menu .expander");

const dashboard = document.querySelector(".dashboard");
const menuItems = document.querySelectorAll("main .menu .primary .menu-item");

const weatherContent = document.querySelector(".side .weather .content");
const date = document.querySelector("main .side .date");
const time = document.querySelector("main .side .time");
const loc = document.querySelector("main .side .location");

// Fix :active touch on mobiles
document.addEventListener("touchstart", () => { }, true);

// Search Expand
search.addEventListener("click", () => container.classList.toggle("search"));

function setInnerHTML(elm, html) {
    elm.innerHTML = html;
    
    Array.from(elm.querySelectorAll("script"))
    .forEach( oldScriptEl => {
        const newScriptEl = document.createElement("script");
        
        Array.from(oldScriptEl.attributes).forEach( attr => {
        newScriptEl.setAttribute(attr.name, attr.value) 
        });
        
        const scriptText = document.createTextNode(oldScriptEl.innerHTML);
        newScriptEl.appendChild(scriptText);
        
        oldScriptEl.parentNode.replaceChild(newScriptEl, oldScriptEl);
    });
}

var lastContent = "Dashboard";
// Main Menu
menuItems.forEach((item) => { 
    
    item.addEventListener("click", () => {
        var current = item.querySelector(".desc").textContent;
        var content = function() {
            var result;
            $.ajax({
                async: false,
                url:"backend/action.php",
                method: "POST",
                data:{getView : current},
                success: function(data){
                    result = data;
                }
            });
            return result;
        }();
        if(lastContent.toLowerCase() != current.toLowerCase()){
            document.querySelector(".current").innerHTML = current;
            if (current == "Dashboard") {
                setInnerHTML(dashboard, $(content).find(".dashboard").html());
                dummyData();
            }else{
                setInnerHTML(dashboard,content);
            }
            menuItems.forEach((item) => item.classList.remove("active"));
            item.classList.add("active");
            lastContent = current;
        }
    });
});

// Set Date, Time
const today = new Date();
const formatZero = (value) => value < 10 ? '0' + value : value;
var hours = today.getHours();
var minutes = today.getMinutes();
var ampm = hours >= 12 ? 'pm' : 'am';
hours = hours % 12;
hours = hours ? hours : 12; // the hour '0' should be '12'
minutes = minutes < 10 ? '' + minutes : minutes;
const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
date.innerText = `${today.getDate()} ${months[today.getMonth()]}, ${today.getFullYear()}`;
time.innerText = `${hours}:${formatZero(minutes)} ${ampm.toUpperCase()}`;

// Populate News
const dummyData = () => {
    const mainCards = document.querySelectorAll("main .dashboard .random");
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
            ${response.current_weather.temperature}<span class='celsius'>°C</span>`;
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